
        <!-- Search Area Start Here -->
        <section class="search-layout1 bg-body full-width-border-bottom fixed-menu-mt">
            <div class="container">
                <form id="cp-search-form">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="form-group search-input-area input-icon-location">
                                <select id="location" class="select2">
                                    <option class="first" value="0">Select Location</option>
                                    <option value="1">Paypal</option>
                                    <option value="2">Master Card</option>
                                    <option value="3">Visa Card</option>
                                    <option value="4">Scrill</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="form-group search-input-area input-icon-category">
                                <select id="categories" class="select2">
                                    <option class="first" value="0">Select Categories</option>
                                    <option value="1">Paypal</option>
                                    <option value="2">Master Card</option>
                                    <option value="3">Visa Card</option>
                                    <option value="4">Scrill</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="form-group search-input-area input-icon-keywords">
                                <input placeholder="Enter Keywords here ..." value="" name="key-word" type="text">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12 text-right text-left-mb">
                            <a href="#" class="cp-search-btn">
                                <i class="fa fa-search" aria-hidden="true"></i>Search
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <!-- Search Area End Here -->
        <!-- Category Grid View Start Here -->
        <section class="s-space-bottom-full bg-accent-shadow-body">
            <div class="container">
                <div class="breadcrumbs-area">
                    <ul>
                        <li><a href="#">Home</a> -</li>
                        <li class="active"><?php if($all_ads){ echo $all_ads[0]['cat_title']; } ?></li>
                    </ul>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="order-xl-2 order-lg-2 col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12">
                        <div class="gradient-wrapper item-mb">
                            <div class="gradient-title">
                                <div class="row">
                                    <div class="col-4">
                                        <h2><?php if($all_ads){ echo $all_ads[0]['cat_title']; } ?></h2>
                                    </div>
                                    <div class="col-8">
                                        <!-- <div class="layout-switcher">
                                            <ul>
                                                <li>
                                                    <div class="page-controls-sorting">
                                                        <button class="sorting-btn dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Sort By<i class="fa fa-sort" aria-hidden="true"></i></button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#">Date</a>
                                                            <a class="dropdown-item" href="#">Best Sale</a>
                                                            <a class="dropdown-item" href="#">Rating</a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li><a class="product-view-trigger" href="#" data-type="category-grid-layout2"><i class="fa fa-th-large"></i></a></li>
                                                <li class="active"><a href="#" data-type="category-list-layout2" class="product-view-trigger"><i class="fa fa-list"></i></a></li>
                                            </ul>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div id="category-view" class="category-list-layout2 gradient-padding zoom-gallery">
                                <div class="row">
                                    <?php if($all_ads){
                                            foreach ($all_ads as $key => $value) {
                                            $ad_id    = $value['id'];
                                            $ad_img   = $value['ad_picture_1'];
                                            $ad_img_2   = $value['ad_picture_2'];
                                            $ad_img_3   = $value['ad_picture_3'];
                                            $ad_title = $value['acc_name'];
                                            $ad_price = $value['ad_price'];
                                            $cat_title = $value['cat_title'];
                                            $add_date  = $value['add_date'];
                                            $seller_location  = $value['seller_location'];
                                        ?>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                           <div class="product-box item-mb zoom-gallery">
                                               <div class="item-mask-wrapper">
                                                   <div class="item-mask secondary-bg-box">
                                                    <img src="<?php echo base_url('public/my_images/').$ad_img ?>" alt="categories" class="img-fluid">
                                                    <?php if($ad_img_2 != ""){ ?>
                                                        <img style="display: none;" src="<?php echo base_url('public/my_images/').$ad_img_2 ?>" alt="categories" class="img-fluid">
                                                    <?php } ?>
                                                       <div class="trending-sign" data-tips="Featured"> <i class="fa fa-bolt" aria-hidden="true"></i> </div>
                                                       <div class="title-ctg"><?php echo $cat_title; ?></div>
                                                       <ul class="info-link">
                                                           <li><a href="<?php echo base_url('public/my_images/').$ad_img ?>" class="elv-zoom" data-fancybox-group="gallery" title="<?php echo $cat_title; ?>"><i class="fa fa-arrows-alt" aria-hidden="true"></i></a></li>
                                                           <li><a href="<?php echo base_url() ?>home/view_ad/<?php echo $ad_id; ?>"><i class="fa fa-link" aria-hidden="true"></i></a></li>
                                                       </ul>
                                                       <div class="symbol-featured"><img src="<?php echo base_url('public/') ?>img/banner/symbol-featured.png" alt="symbol" class="img-fluid"> </div>
                                                   </div>
                                               </div>
                                               <div class="item-content">
                                                   <div class="title-ctg"><?php echo $cat_title; ?></div>
                                                   <h3 class="short-title"><a href="<?php echo base_url() ?>home/view_ad/<?php echo $ad_id; ?>">Stylish Bracelet</a></h3>
                                                   <h3 class="long-title"><a href="<?php echo base_url() ?>home/view_ad/<?php echo $ad_id; ?>"><?php echo $ad_title; ?></a></h3>
                                                   <ul class="upload-info">
                                                       <li class="date"><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo date('d M, Y',strtotime($add_date)); ?></li>
                                                       <li class="place"><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $value['city'].', '.$value['country'] ?></li>
                                                       <li class="tag-ctg"><i class="fa fa-tag" aria-hidden="true"></i><?php echo $cat_title; ?></li>
                                                   </ul>
                                                   
                                                   <div class="price">&euro;<?php echo $ad_price; ?></div>
                                                   <a href="<?php echo base_url() ?>home/view_ad/<?php echo $ad_id; ?>" class="product-details-btn">Details</a>
                                               </div>
                                           </div>
                                       </div>
                                       <?php }} ?>
                                </div>
                            </div>
                        </div>
                        <div class="gradient-wrapper mb-60">
                            <ul class="cp-pagination">
                                <li class="disabled"><a href="#"><i class="fa fa-angle-double-left" aria-hidden="true"></i>Previous</a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#">6</a></li>
                                <li><a href="#">Next<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </section>
        <!-- Category Grid View End Here -->
        