<?php

header('Access-Control-Allow-Origin: *');

if ( !empty($_POST) ) {

    $count = 0;

    // First and foremost, let's see what devices we're expected to return
    $data = json_decode($_POST['devices']);
    $device_images = json_decode($_POST['deviceImages']);

    // For each of devices listed in the $_POST['devices'] array stored in $data
    foreach ($data as $deviceProdId) {

        $device_image = $device_images[$count];

        // Let's gather each of the associated device details json file which is conveniently the productId of the device
        $phoneDetailsFile = "http://uscc-data.fq540.com/fq540cms/data/by_phone/".$deviceProdId.".json";
        $json = file_get_contents($phoneDetailsFile);
        $json = iconv('UTF-8', 'UTF-8//IGNORE', utf8_encode($json));

        // Since I passed the 'false' parameter, json_decode will store an OBJECT (vs. ARRAY)
        $device = json_decode($json, false);

        require("./templates/".$_POST['template']);
        require("./templates/default-modal.php");

        $count++;

    }

}


