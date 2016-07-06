<?php

/*
    Multi-purpose template for USCC landing pages.
    This template displays content for all skuTypes,
    which might not neccessarily be true for all templates.
*/

// For Prepaid Presentations
if ($_POST['skuType'] == "prepaid") {
    $prepaidPrice = $device->skuData[1]->finalPrice;
    $pricePieces = explode(".", $prepaidPrice);
    ?>

    <div class="device" data-qv="<?php echo $device->productId ?>">
        <!-- PHONE -->
        <div class="image">
            <div class="qv-icon"><span>Quick View</span></div>
            <img src="<?php echo $device_image; ?>" alt="<?php echo $device->manufacturer." ".preg_replace('/ - .*/','', $device->displayName); ?>">
        </div>
        <!-- PRICING -->
        <div class="details">
            <div class="pricing">
                <div class="price-ss">$</div><?php echo $pricePieces[0]; ?><div class="price-ss"><?php echo $pricePieces[1]; ?></div>
            </div>
            <div class="name"><?php echo $device->manufacturer." ".preg_replace('/ - .*/','', $device->displayName); ?></div>
            <a href="#" class="cta fq_atc" data-prodid="<?php echo $device->productId; ?>" data-skuid="<?php echo $device->skuData[1]->skuId; ?>" data-skutype="<?php echo $_POST['skuType']; ?>">Add to Cart</a>
        </div>
    </div>

    <?php

    // For Postpaid Presentation
} elseif ($_POST['skuType'] == "postpaid") {
    $postpaidPrice = $device->skuData[0]->finalPrice;
    $pricePieces = explode(".", $postpaidPrice);
    ?>

    <div class="device" data-qv="<?php echo $device->productId ?>">
        <!-- PHONE -->
        <div class="image">
            <div class="qv-icon"><span>Quick View</span></div>
            <img src="<?php echo $device_image; ?>" alt="<?php echo $device->manufacturer." ".preg_replace('/ - .*/','', $device->displayName); ?>">
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

    <?php

    // For everything else (Financing30)
} else {

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
            <img src="<?php echo $device_image; ?>" alt="<?php echo $device->manufacturer." ".preg_replace('/ - .*/','', $device->displayName); ?>">
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

    <?php

}
?>