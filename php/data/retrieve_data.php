<?php

$deviceListingURL = "https://www.uscellular.com/uscellular/cell-phones/newDeviceListingJson.jsp";
$json = file_get_contents($deviceListingURL);
$data = json_decode(iconv('UTF-8', 'ISO-8859-1//IGNORE', $json));

foreach($data->devices as $device) {
    file_put_contents(dirname(__FILE__) .'/by_phone/' . $device->productId . '.json', json_encode($device));
}

// Retrieving showPlansJson.jsp with Referer set to show

$referer = 'https://www.uscellular.com/uscellular/plans/showPlans.jsp';
$plansListingURL = 'https://www.uscellular.com/uscellular/plans/showPlansJson.jsp';

$opts = array(
    'http'=>array(
        'method'=>"GET",
        'header'=>"Accept-language: en\r\n" .
            "Referer: $referer\r\n"
    )
);

$context = stream_context_create($opts);
$json = file_get_contents($plansListingURL, false, $context);
$data = json_decode(iconv('UTF-8', 'ISO-8859-1//IGNORE', $json));

foreach($data->plans as $plan) {
    foreach($plan->planList as $plans){
        file_put_contents(dirname(__FILE__) .'/by_plan/' . $plans->productId . '.json', json_encode($device));
    }
}

echo 'Success.';

?>