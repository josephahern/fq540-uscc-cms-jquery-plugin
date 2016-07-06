<?php
/**
 * Default template for landing page modals
 * Note: Uses $device object and follows latest JSON Object hierarchy
 */
?>
<div class="modal fade" id="<?php echo $device->productId; ?>">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="modal-close close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
                <h4 class="modal-title"><?php echo $device->manufacturer; ?></h4>
                <h3 class="modal-subtitle"><?php echo preg_replace('/ - .*/','', $device->displayName); ?></h3>
                <?php if ($device->reviews->count) {?>
                <a href="#" target="_blank" class="modal-ratings">
                    <div class="star-ratings">
                        <div class="star-ratings-top" style="width: <?php echo (floatval($device->reviews->average)*20); ?>%;"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                        <div class="star-ratings-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                    </div>
                    <span class="star-rating"><?php echo $device->reviews->average . " / " . $device->reviews->range; ?></span>
                    <span class="total-reviews"><?php echo "(" . $device->reviews->count . " reviews)"; ?></span>
                    <div class="ratings-snapshot">
                        <span class="title">Ratings Snapshot</span>
                        <span class="num-reviews"><?php echo "(" . $device->reviews->count . " reviews)"; ?></span>
                        <div class="row">
                            <div class="star-ratings">
                                <div class="star-ratings-top five-star"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                                <div class="star-ratings-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                            </div>
                            <div class="parent-block"><div class="child-block" style="width:<?php echo floor(intval($device->reviews->distributions[0]->fivestar)/intval($device->reviews->count)*100);?>%;"></div></div>
                            <span class="review-count"><?php echo $device->reviews->distributions[0]->fivestar; ?></span>
                        </div>
                        <div class="row">
                            <div class="star-ratings">
                                <div class="star-ratings-top four-star"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                                <div class="star-ratings-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                            </div>
                            <div class="parent-block"><div class="child-block" style="width:<?php echo floor(intval($device->reviews->distributions[0]->fourstar)/intval($device->reviews->count)*100);?>%;"></div></div>
                            <span class="review-count"><?php echo $device->reviews->distributions[0]->fourstar; ?></span>
                        </div>
                        <div class="row">
                            <div class="star-ratings">
                                <div class="star-ratings-top three-star"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                                <div class="star-ratings-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                            </div>
                            <div class="parent-block"><div class="child-block" style="width:<?php echo floor(intval($device->reviews->distributions[0]->threestar)/intval($device->reviews->count)*100);?>%;"></div></div>
                            <span class="review-count"><?php echo $device->reviews->distributions[0]->threestar; ?></span>
                        </div>
                        <div class="row">
                            <div class="star-ratings">
                                <div class="star-ratings-top two-star"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                                <div class="star-ratings-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                            </div>
                            <div class="parent-block"><div class="child-block" style="width:<?php echo floor(intval($device->reviews->distributions[0]->twostar)/intval($device->reviews->count)*100);?>%;"></div></div>
                            <span class="review-count"><?php echo $device->reviews->distributions[0]->twostar; ?></span>
                        </div>
                        <div class="row">
                            <div class="star-ratings">
                                <div class="star-ratings-top one-star"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                                <div class="star-ratings-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                            </div>
                            <div class="parent-block"><div class="child-block" style="width:<?php echo floor(intval($device->reviews->distributions[0]->onestar)/intval($device->reviews->count)*100);?>%;"></div></div>
                            <span class="review-count"><?php echo $device->reviews->distributions[0]->onestar; ?></span>
                        </div>
                    </div>
                 </a>
                <?php } else { ?>
                <div class="modal-ratings none">
                    <div class="star-ratings">
                        <div class="star-ratings-top" style="width: 0%;"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                        <div class="star-ratings-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                    </div>
                    <span class="total-reviews">(0 reviews)</span>
                    <span style="display:block;">Write the first review</span>
                </div>
                <?php } ?>
                <img src="https://www.uscellular.com/uscellular/images/FreeShipping-stamp.gif" style="position:absolute; top: 25px; right: 15px;" alt="Free Shipping">
            </div>
            <div class="modal-body">
                <div class="modal-left-content">
                    <div class='carousel-container'>
                        <div class='left-scroll'></div>
                        <div class='carousel-inner'>
                            <ul class='carousel-ul'>
                                <?php
                                $jsonImages = json_decode($device->media);
                                foreach($jsonImages as $media){
                                    ?>
                                    <li><img src="<?php echo "https://uscellular.com" . $media->src; ?>"></li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                        <div class='right-scroll'></div>
                    </div>
                </div>
                <div class="modal-right-content">
                    <h4>Highlights</h4>
                    <?php echo $device->highlights; ?>
                    <hr>
                    <h4>Want To Know More?</h4>
                    <ul>
                        <li><a href="#" target="_blank">Overview</a></li>
                        <li><a href="#" target="_blank">Reviews</a></li>
                        <li><a href="#" target="_blank">Features</a></li>
                        <li><a href="#" target="_blank">Accessories</a></li>
                        <li><a href="#" target="_blank">Support</a></li>
                        <li><a href="#" target="_blank">Questions & Answers</a></li>
                    </ul>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->