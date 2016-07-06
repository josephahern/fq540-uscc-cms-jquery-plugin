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