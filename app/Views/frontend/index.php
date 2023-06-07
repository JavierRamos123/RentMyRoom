<style type="text/css">
    #owl-demo .item img {
        display: block;
        width: 100%;
        height: 650px !important;
    }

    .owl-nav {
        display: none;
    }

    .owl-carousel .owl-stage {
        display: flex;
    }

    .overlay {
        width: auto;
        height: auto;
        position: absolute;
        top: 40%;
        left: 31%;
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;

    }

    .title1 {
        font-family: 'Arial', sans-serif;
        font-size: 7em;
        text-transform: uppercase;
        letter-spacing: 2px;
        background: linear-gradient(to bottom, #76e976, #e5bb6f);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .info {
        color: white;
        font-family: sans-serif;
        letter-spacing: 1px;
    }

    .image3 {
        filter: brightness(30%) opacity(0.8);
    }
</style>
<!-- Header Area End Here -->
<!-- Map Area Start Here -->
<section class="full-width-container">
    <div class="container-fluid">
        <div id="owl-demo" class="owl-carousel owl-theme">
            <div>
                <img class="image3" src="<?php echo base_url() . 'public/carousel_images/21.jpg' ?>" alt="1">
                <div class="overlay">
                    <div style="text-align: center;">
                        <h1 class="title1">Rent My Room</h1>
                    </div>
                </div>
            </div>

            <div>
                <img src="<?php echo base_url() . 'public/carousel_images/22.jpg' ?>" alt="1">
                <div class="overlay">
                    <div>
                        <h1 class="title1" style="font-family: 'Arial', sans-serif;
        font-size: 60px;
        color: #000;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: bold;"></h1>
                        <p class="info">
                        </p>
                    </div>
                </div>
            </div>

            <div>
                <img src="<?php echo base_url() . 'public/carousel_images/23.jpg' ?>" alt="1">
                <div class="overlay">
                    <div>
                        <h1 class="title1"></h1>
                        <p class="info">
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Map Area End Here -->
<!-- Search Area Start Here -->
<section class="search-layout1 bg-accent">
    <div class="search-layout1-holder">
        <div class="container">
            <form id="cp-search-form" class="bg-body search-layout2-inner">
                <div class="row">

                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="form-group search-input-area input-icon-category">
                            <select id="categories" class="select2" name="flt_category_id">
                                <option value="All">--Select Category--</option>
                                <?php if ($all_ad_categories) {
                                    foreach ($all_ad_categories as $key => $cat) { ?>
                                        <option value="<?php echo $cat['id'] ?>"><?php echo $cat['cat_title'] ?></option>
                                <?php }
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="form-group search-input-area input-icon-keywords">
                            <input placeholder="Enter Keywords here ..." value="" name="flt_keywords" type="text">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12 text-right text-left-mb">
                        <button class="cp-search-btn"><i class="fa fa-search" aria-hidden="true"></i>Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Search Area End Here -->
<!-- Service Area Start Here -->
<section class="service-layout1 bg-accent s-space-custom3">
    <div class="container">
        <div class="section-title-dark">
            <h1>Welcome To <?php echo $project_title ?></h1>
            <p>Browse Our Top Categories</p>
        </div>
        <div class="row">
            <?php if ($all_ad_categories) {
                foreach ($all_ad_categories as $key => $cat) { ?>
                    <div class="col-lg-3 col-md-5 col-sm-5 col-12 item-mb">
                        <div class="service-box1 bg-body text-center">

                            <h3 class="title-medium-dark mb-none">
                                <a href="<?php echo base_url() . 'home/category/' . $cat['id'] ?>"><?php echo $cat['cat_title'] ?></a>
                            </h3>
                            <div class="view"></div>
                            <p><?php echo $cat['cat_desc']; ?></p>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>
    </div>
</section>
<!-- Service Area End Here -->
<!-- Products Area Start Here -->
<section class="products-layout1 bg-body s-space-default">
    <div class="container">
        <div class="section-title-dark">
            <h2>Top accommodations </h2>
        </div>
    </div>
    <div class="container menu-list-wrapper">
        <div class="row menu-list category-grid-layout2 zoom-gallery">
            <?php if ($all_ads) {
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
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12 menu-item">
                        <div class="product-box item-mb zoom-gallery">
                            <div class="item-mask-wrapper">
                                <div class="item-mask bg-box"><img src="<?php echo base_url('public/my_images/') . $ad_img ?>" alt="categories" class="img-fluid">
                                    <div class="trending-sign" data-tips="Featured"> <i class="fa fa-bolt" aria-hidden="true"></i> </div>
                                    <div class="title-ctg"><?php echo $cat_title ?></div>
                                    <ul class="info-link">
                                        <li><a href="<?php echo base_url('public/my_images/') . $ad_img ?>" class="elv-zoom" data-fancybox-group="gallery" title="Title Here"><i class="fa fa-arrows-alt" aria-hidden="true"></i></a></li>
                                        <li><a href="<?php echo base_url() . 'home/view_ad/' . $ad_id; ?>"><i class="fa fa-link" aria-hidden="true"></i></a></li>
                                    </ul>
                                    <div class="symbol-featured"><img src="<?php echo base_url(); ?>public/img/banner/symbol-featured.png" alt="symbol" class="img-fluid"> </div>
                                </div>
                            </div>
                            <div class="item-content">
                                <div class="title-ctg"><?php echo $cat_title ?></div>
                                <h3 class="short-title"><a href="<?php echo base_url() . 'home/view_ad/' . $ad_id; ?>"><?php echo $value['acc_name'] ?></a></h3>
                                <ul class="upload-info">
                                    <li class="date"><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo date('d M, Y', strtotime($add_date)); ?></li>
                                    <li class="place"><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $value['city'] . ', ' . $value['country'] ?></li>
                                    <li class="tag-ctg"><i class="fa fa-tag" aria-hidden="true"></i><?php echo $cat_title ?></li>
                                </ul>
                                <!-- <p>Eimply dummy text of the printing and typesetting industrym has been the industry's standard dummy.</p> -->
                                <div class="price">&euro;<?php echo $ad_price; ?></div>
                                <a href="<?php echo base_url() . 'home/view_ad/' . $ad_id; ?>" class="product-details-btn">Details</a>
                            </div>
                        </div>
                    </div>
            <?php }
            } ?>

        </div>
        <!-- <div class="loadmore text-center item-mt">
                    <a href="#" class="cp-default-btn-primary">See All Album</a>
                </div> -->
    </div>
</section>


<!-- Subscribe Area End Here -->
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '.item-mask-wrapper', function() {
            var url = $(this).parent().find('.product-details-btn').attr('href');
            window.location.replace(url)
        })
        $("#owl-demo").owlCarousel({

            navigation: false, // Show next and prev buttons

            slideSpeed: 300,
            paginationSpeed: 400,

            items: 1,
            itemsDesktop: true,
            itemsDesktopSmall: true,
            itemsTablet: true,
            itemsMobile: true

        });
    })
</script>