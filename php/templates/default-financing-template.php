<?php

/*
    Multi-purpose template for USCC landing pages.
    This template displays content for all skuTypes,
    which might not necessarily be true for all templates.
*/

// For Financing Presentations
if ($_POST['skuType'] == "financing20") {
    $financingPrice = $device->skuData[2]->finalPrice;
    $pricePieces = explode(".", $financingPrice);
    $skuId = $device->skuData[3]->skuId;
} elseif ($_POST['skuType'] == "financing24") {
    $financingPrice = $device->skuData[3]->finalPrice;
    $pricePieces = explode(".", $financingPrice);
    $skuId = $device->skuData[3]->skuId;
} else {
    $financingPrice = $device->skuData[4]->finalPrice;
    $pricePieces = explode(".", $financingPrice);
    $skuId = $device->skuData[3]->skuId;
}
?>

<div class="device" data-qv="<?php echo $device->productId ?>">
    <!-- PHONE -->
    <div class="image">
        <div class="qv-icon"><span>Quick View</span></div>
        <?php if (getimagesize($device_image) !== false) { ?>
            <img src="<?php echo $device_image; ?>" alt="<?php echo $device->manufacturer." ".preg_replace('/ - .*/','', $device->displayName); ?>">
        <?php } else { ?>
            <img src="https://placeholdit.imgix.net/~text?txtsize=33&txt=No%20Device%20Image%20Available&w=140&h=240">
        <?php } ?>
    </div>
    <!-- PRICING -->
    <div class="details">
        <div class="starting-at">starting<br />at</div>
        <div class="pricing">
            <div class="price-ss">$</div><?php echo $pricePieces[0]; ?><div class="duration">/mo.</div>
        </div>
        <div class="name"><?php echo $device->manufacturer." ".preg_replace('/ - .*/','', $device->displayName); ?></div>
        <a href="#" class="cta fq_atc" data-prodid="<?php echo $device->productId; ?>" data-skuid="<?php echo $skuId; ?>" data-skutype="<?php echo $_POST['skuType']; ?>">Add to Cart</a>
    </div>
</div>