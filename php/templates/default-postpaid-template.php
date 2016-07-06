<?php

/*
    Multi-purpose template for USCC landing pages.
    This template displays content for all skuTypes,
    which might not necessarily be true for all templates.
*/

// For Postpaid Presentations
$postpaidPrice = $device->skuData[0]->finalPrice;
$pricePieces = explode(".", $postpaidPrice);
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
        <div class="pricing">
            <div class="price-ss">$</div><?php echo $pricePieces[0]; ?><div class="price-ss"><?php echo $pricePieces[1]; ?></div>
        </div>
        <div class="name"><?php echo $device->manufacturer." ".preg_replace('/ - .*/','', $device->displayName); ?></div>
        <a href="#" class="cta fq_atc" data-prodid="<?php echo $device->productId; ?>" data-skuid="<?php echo $device->skuData[0]->skuId; ?>" data-skutype="<?php echo $_POST['skuType']; ?>">Add to Cart</a>
    </div>
</div>