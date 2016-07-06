/*
 *  jquery.fq540cms.js - v1.0.0
 *
 *  A jQuery plugin to manage and support device details listings on
 *  U.S. Cellular landing pages.
 *
 *  Created by Joseph Ahern
 *  joe.ahern@fq540.com
 *
 *  Dependencies: jQuery & fq540cms.php
 *
 */

;( function( $, window, document, undefined ) {

	"use strict";

		var pluginName = "fq540cms",
			defaults = {
				// devices - Array | productID
				devices: null,
				// showDevices - Boolean | true, false
				showDevices: true,
				// skuType - String | "prepaid", "postpaid", "financing20", "financing24", "financing30"
				skuType: "financing30",
				// deviceImage - String | "left", "front", "right"
				deviceFace: "front",
				// addToCartButton - String | ex. ".add-to-cart" or "#add-to-cart"
				addToCartClass: ".fq_atc",
				// orderLTR - String | "high", "low"
				orderLTR: "high",
				// template - String | ex. "filename.php"
				template: "default-template.php",
				// templateRoot - String | ex. "/php/templates/css/"
				templateRoot: "https://uscc-data.fq540.com/fq540cms/templates/css/",
				// imageRoot - String | "https://www.uscellularmedia.com/bannerland/vendor/f/images/devices/+ {productId}/{productId}_{deviceFace}.png"
				imageRoot: "https://www.uscellularmedia.com/bannerland/vendor/f/images/devices/",
				// useJS - Boolean | ex. Load external Javascript dependencies
				useJS: false,
				// coreJS - Array of Strings | Javascript dependencies
				coreJS: [
					"https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.2/js/tether.min.js",
					"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js"
				],
				//cacheJS - Boolean | true, false
				cacheJS: true,
				// useCSS - Boolean | ex. Load external CSS dependencies
				useCSS: true,
				// coreCSS - Array of Strings | CSS dependencies
				coreCSS:[
					"https://www.uscellularmedia.com/bannerland/vendor/f/fonts/uscc-fonts.min.css",
					"https://uscc-data.fq540.com/fq540cms/templates/css/default-modal.css"
				]
			};

		// The actual plugin constructor
		function Plugin ( element, options ) {
			this.element = element;
			this.settings = $.extend( {}, defaults, options );
			this._defaults = defaults;
			this._name = pluginName;
			this.init();
		}

		// Avoid Plugin.prototype conflicts
		$.extend( Plugin.prototype, {
			init: function() {
				// Load CSS Assets
				this.loadCoreCSS();
				// Retrieve HTML from fq540cms.php
				if (this.settings.useJS){
					this.loadCoreJS();
				}
				if (this.settings.useCSS){
					//Use a template-specific CSS file
					this.getTemplateCSS();
				}
				if (this.settings.showDevices){
					// Get devices details in HTML form, pass quickViewCarousel function to be called onComplete
					this.getDeviceDetails(this.element, this.settings.devices, this.quickViewCarousel);
				}
				// Add event listener for Add To Cart buttons (they can be dynamically generated!!!)
				this.addToCart();
				this.quickView();
			},
			loadCoreCSS: function(){

				// Iterates through list of coreCSS URLS provided and appends them to the head (a sideloading technique)

				for(var i=0; i<this.settings.coreCSS.length; i++){
					$("<link/>", {
						rel: "stylesheet",
						type: "text/css",
						href: this.settings.coreCSS[i],
					}).appendTo("head");
				}
			},
			loadCoreJS: function() {

				// Ajax JS Caching

				if(this.settings.cacheJS) {
					$.ajaxSetup({
						cache: true
					});
				}

				// Iterates through list of coreJS URLS provided and loads them via $.getScript() (a sideloading technique)

				for(var i=0; i<this.settings.coreJS.length; i++) {
					$.getScript(this.settings.coreJS[i]);
				}
			},
			getTemplateCSS: function(){
				//Removes the ".php" from the template file
				var templateId = (this.settings.template).slice(0, -4);
				$("<link/>", {
					rel: "stylesheet",
					type: "text/css",
					href: this.settings.templateRoot + templateId + ".css"
				}).appendTo("head");
			},
			getDeviceDetails: function (el, devices, callback) {

				// Accepts the jQuery element, an array of devices, and a callback
				// This gets called in this.init() with the quickViewCarousel function as a callback.
				// Looking to decouple them someway - but its the only way I can guarantee the
				// devices are loaded on the page before I start reading them

				if($.isArray(devices) && devices.length){

					var deviceImages = this.generateImageURL(devices);

					$.post( "https://uscc-data.fq540.com/fq540cms/fq540cms.php", {
						devices: JSON.stringify(devices),
						deviceImages: JSON.stringify(deviceImages),
						skuType: this.settings.skuType,
						deviceFace: this.settings.deviceFace,
						quickView: this.settings.quickView,
						orderLTR: this.settings.orderLTR,
						template: this.settings.template
					}, function( data ) {
						$(el).html(data);
						//quickViewCarousel Callback
						if(typeof callback === "function"){
							callback();
						}
					});
				} else {
					return $.error("Error retrieving devices. Please check to see that you are submitting an array of product IDs.");
				}
			},
			generateImageURL: function(devices) {

				// Just a file location generator that assumes that the images are in a {imageRootDirectory}/{productid}/{productid}_{deviceFace}.png

				var deviceImages = [];
				for(var i=0; i < devices.length; i++) {
					deviceImages.push(this.settings.imageRoot + devices[i] + "/" + devices[i] + "_" + this.settings.deviceFace + ".png");
				}
				return deviceImages;
			},
			quickView: function(){
				$(document.body).on("click", ".qv-icon", function(e){
					e.preventDefault();
					console.log("clicked.");
					var productId = $(this).closest(".device").attr("data-qv"),
					title = $("#"+productId).find(".modal-header").html(),
					content = $("#"+productId).find(".modal-body").html();

					usc.mod['bs-modal-module'].buildView(title, content);
					$(".modal-footer").addClass("hide");
				});
			},
			quickViewCarousel: function(){
				var count = 0;
				$(".carousel-container").each(function() {
					$(this).attr("data-carousel", count);
					$(this).find('.carousel-ul li:first').before($(this).find('.carousel-ul li:last'));
					count++;
				});
				$(document.body).on("click", ".right-scroll", function(){
					var carouselId = '.bootstrap-iso .carousel-container[data-carousel="' + $(this).parent(".carousel-container").attr("data-carousel") + '"]',
						item_width = $(carouselId + ' .carousel-ul li').outerWidth() + 10,
						left_indent = parseInt($(carouselId + ' .carousel-ul').css('left')) - item_width;

					$(carouselId + ' .carousel-ul:not(:animated)').animate({'left' : left_indent},500,function(){

						$(carouselId + ' .carousel-ul li:last').after($(carouselId + ' .carousel-ul li:first'));
						$(carouselId + ' .carousel-ul').css({'left' : '-355px'});

					});
				});
				$(document.body).on("click", ".left-scroll", function(){
					var carouselId = '.bootstrap-iso .carousel-container[data-carousel="' + $(this).parent(".carousel-container").attr("data-carousel") + '"]',
						item_width = $(carouselId + ' .carousel-ul li').outerWidth() + 10,
						left_indent = parseInt($(carouselId + ' .carousel-ul').css('left')) + item_width;

					$(carouselId + ' .carousel-ul:not(:animated)').animate({'left' : left_indent},500,function(){

						$(carouselId + ' .carousel-ul li:first').before($(carouselId + ' .carousel-ul li:last'));
						$(carouselId + ' .carousel-ul').css({'left' : '-355px'});

					});
				});
			},
			addToCart: function() {
				$(document.body).on("click", this.settings.addToCartClass, function(e){
					e.preventDefault();

					var sUrl = '/uscellular/ByPassLandingPageServlet?transactionType=' + transactionType
						+ '&prodId=' + $(this).attr('data-prodid')
						+ '&skuId=' + $(this).attr('data-skuid')
						+ '&currency=' + 'dollars';

					if(this.settings.skuType === 'financing20'){
						sUrl += '&installments=' + '20';
					} else if (this.settings.skuType === 'financing24') {
						sUrl += '&installments=' + '24';
					} else if (this.settings.skuType === 'financing30') {
						sUrl += '&installments=' + '30';
					}

					console.log(sUrl);

					usc.mod['my-account'].showPleaseWait();
					$.ajax({
						type: 'get',
						url: sUrl,
						dataType: 'json',
						success: function(data){
							if ($('#simplemodal-overlay').length > 0) {
								usc.onModalClose = function() {
									usc.mod['myaccount-cart'].handleGetGuidingModalSuccess(data);
								};
								$.modal.close();
							}else {
								usc.mod['myaccount-cart'].handleGetGuidingModalSuccess(data);
							}
						}
					});

				});
			}
		});

		$.fn[ pluginName ] = function( options ) {
			return this.each( function() {
				if ( !$.data( this, "plugin_" + pluginName ) ) {
					$.data( this, "plugin_" +
						pluginName, new Plugin( this, options ) );
				}
			} );
		};

} )( jQuery, window, document );
