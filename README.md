**$.fq540cms.js** | a jQuery Plugin
===================

This plugin was designed to consolidate existing implementations of the FQ540/USCC bridge into a single, manageable plugin.

> **Note:**

> - Since USCC is running an earlier build of jQuery - this plugin is designed for and assumes >= jQuery v1.4.2 & UI v1.8.1.


**File Locations:**
All dependencies are located on **uscc.dev.fq540.com**: 
 
```
/var/www/data/html/fq540cms/
```
https://uscc-data.fq540.com/fq540cms/jquery.fq540cms.js

How to use:
-------------
**$.fq540cms.js** is a simple instantiation designed to help accommodate even the most complex of pages.  

Below is an example of one of the simplest of instantiations:
```
<script src="jquery.fq540cms.js"></script>
<script>
$(function() {
	$( "el.div").fq540cms({
		// devices - Array | productID
	    devices: ["prod1234567", "prod1234568", "1234567"],
	    skuType: "financing30"
	});	
});
</script>
```
Options (and defaults):
-------------
> **Format:**

> // OptionName - Type | Options/Summary
>
>    OptionName: DefaultValue
```
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
```