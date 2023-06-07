<link rel="stylesheet" href="<?php echo base_url() ?>public/jquery-ui/jquery-ui.css">
<link rel="stylesheet" href="<?php echo base_url() ?>public/jquery-ui/jquery.comiseo.daterangepicker.css">
  
  <script src="<?php echo base_url() ?>public/jquery-ui/jquery-ui.min.js"></script>
  <script src="<?php echo base_url() ?>public/jquery-ui/moment.min.js"></script>
  <script src="<?php echo base_url() ?>public/jquery-ui/jquery.comiseo.daterangepicker.min.js"></script>
  <style type="text/css">
      .comiseo-daterangepicker-triggerbutton.ui-button {
        min-width: 100%;
      }
      .comiseo-daterangepicker-triggerbutton.ui-button {
        padding: 9px 16px;
      }
  </style>
<br><br><br><br><br><br><br>
        <!-- Product Area Start Here -->
        <section class="s-space-bottom-full bg-accent-shadow-body">
            <div class="container">
                <div class="breadcrumbs-area">
                    <ul>
                        <li><a href="<?php echo base_url(); ?>">Home</a> -</li>
                        <li><a href="<?php echo base_url(); ?>"><?php echo $ad_detail['cat_title'] ?></a> -</li>
                        <li class="active"><?php echo $ad_detail['acc_name'] ?></li>
                    </ul>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12">
                        <form id="ad-booking-form" method="post" enctype="multipart/form-data">
                        <input type="hidden" class="csrfname_field" name="<?php echo csrf_token() ?>" value="<?php echo csrf_hash() ?>" />
                         <input type="hidden" name="form_name" value="book_ad">
                         <input type="hidden" name="ad_id" value="<?php echo $ad_id ?>">
                            <div class="gradient-wrapper item-mb">
                                <div class="gradient-title">
                                    <h2><?php echo $ad_detail['acc_name'] ?></h2>
                                </div>
                                <div class="gradient-padding reduce-padding">
                                    <div class="single-product-img-layout1 item-mb">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="tab-content">
                                                    <span class="price" style="background-image: none !important">&euro;<?php echo $ad_detail['ad_price'] ?></span>
                                                    <div role="tabpanel" class="tab-pane fade active show" id="ad_picture_1">
                                                        <a href="#" class="zoom ex1"><img alt="single" src="<?php echo base_url('public/my_images/').$ad_detail['ad_picture_1'] ?>" class="img-fluid"></a>
                                                    </div>
                                                    <?php if($ad_detail['ad_picture_2'] != ""){ ?>
                                                        <div role="tabpanel" class="tab-pane" id="ad_picture_2">
                                                            <a href="#" class="zoom ex1"><img alt="single" src="<?php echo base_url('public/my_images/').$ad_detail['ad_picture_2'] ?>" class="img-fluid"></a>
                                                        </div>
                                                    <?php }?>
                                                    <?php if($ad_detail['ad_picture_3'] != ""){ ?>
                                                        <div role="tabpanel" class="tab-pane" id="ad_picture_3">
                                                            <a href="#" class="zoom ex1"><img alt="single" src="<?php echo base_url('public/my_images/').$ad_detail['ad_picture_3'] ?>" class="img-fluid"></a>
                                                        </div>
                                                    <?php }?>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">                                            
                                                <ul class="nav tab-nav tab-nav-inline cp-carousel nav-control-middle" data-loop="true" data-items="6" data-margin="15" data-autoplay="true" data-autoplay-timeout="5000" data-smart-speed="2000" data-dots="false" data-nav="true" data-nav-speed="false" data-r-x-small="2" data-r-x-small-nav="true" data-r-x-small-dots="false" data-r-x-medium="4" data-r-x-medium-nav="true" data-r-x-medium-dots="false" data-r-small="3" data-r-small-nav="true" data-r-small-dots="false" data-r-medium="4" data-r-medium-nav="true" data-r-medium-dots="false" data-r-Large="6" data-r-Large-nav="true" data-r-Large-dots="false">
                                                    <li class="nav-item">
                                                        <a class="active" href="#ad_picture_1" data-toggle="tab" aria-expanded="false"><img alt="<?php echo $ad_detail['acc_name'] ?>" src="<?php echo base_url('public/my_images/').$ad_detail['ad_picture_1'] ?>" class="img-fluid"></a>
                                                    </li>
                                                    <?php if($ad_detail['ad_picture_2'] != ""){ ?>
                                                    <li class="nav-item">
                                                        <a href="#ad_picture_2" data-toggle="tab" aria-expanded="false"><img alt="<?php echo $ad_detail['acc_name'] ?>" src="<?php echo base_url('public/my_images/').$ad_detail['ad_picture_2'] ?>" class="img-fluid"></a>
                                                    </li>
                                                    <?php }?>
                                                    <?php if($ad_detail['ad_picture_3'] != ""){ ?>
                                                    <li class="nav-item">
                                                        <a href="#ad_picture_3" data-toggle="tab" aria-expanded="false"><img alt="<?php echo $ad_detail['acc_name'] ?>" src="<?php echo base_url('public/my_images/').$ad_detail['ad_picture_3'] ?>" class="img-fluid"></a>
                                                    </li>
                                                    <?php }?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if($ad_detail['ad_desc'] != ""){ ?>
                                        <div class="section-title-left-dark child-size-xl title-bar item-mb">
                                            <h3>Details:</h3><?php echo $ad_detail['ad_desc'] ?>
                                        </div>
                                    <?php } ?>
                                    <?php if($ad_services_offered){ ?>
                                        <div class="section-title-left-dark child-size-xl title-bar item-mb">
                                            <h3>Services offered:</h3>
                                            <ul style="list-style-type: circle;">
                                            <?php foreach ($ad_services_offered as $key => $value) { ?>
                                                <li><strong><i><?php echo $value->service_desc; ?></i></strong></li>
                                            <?php } ?>
                                            </ul>
                                        </div>
                                    <?php } ?>
                                    
                                    
                                    <div class="section-title-left-dark child-size-xl title-bar item-mb">
                                        <h3>Dates available:<?php echo $required_span; ?></h3>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="text" name="choose_dates" id="dates_for_booking" class="form-control form-control-sm" required>    
                                            </div>
                                        </div>
                                    </div>
                                    <?php if($my != "y"){ ?>
                                        <button type="submit" class="btn btn-success">Book Dates Now</button>
                                    <?php } ?>
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12">
                        <div class="sidebar-item-box">
                            <div class="gradient-wrapper">
                                <div class="gradient-title">
                                    <h3>Seller Information</h3>
                                </div>
                                <ul class="sidebar-seller-information">
                                    <li>
                                        <div class="media">
                                            
                                            <div class="media-body">
                                                <span>Posted By</span>
                                                <h4><?php echo $ad_detail['seller_first_name'].' '.$ad_detail['seller_last_name'] ?></h4>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="media">
                                            
                                            <div class="media-body">
                                                <span>Location</span>
                                                <h4><?php echo $ad_detail['address'].', '.$ad_detail['city'].', '.$ad_detail['country'] ?></h4>
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="media">
                                            <div class="media-body">
                                                <span>Email</span>
                                                <h4><?php echo $ad_detail['seller_email']; ?></h4>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="media">
                                            <div class="media-body">
                                                <span>Contact No.</span>
                                                <h4><?php echo $ad_detail['seller_phone']; ?></h4>
                                            </div>
                                        </div>
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>
        <!-- Product Area End Here -->
        <script type="text/javascript">

            $(document).ready(function(){
                var startdate = '<?php echo strtotime($ad_dates_array[0]); ?>'
                var ad_dates = '<?php echo json_encode($ad_dates_array) ?>';
                var end_of_date = '<?php $end = end($ad_dates_array);echo date('m/d/Y',strtotime($end)); ?>'
                
                date_d = $.parseJSON(ad_dates);

                function addZ(n) {
                    return (n < 10? '0' : '') + n;
                  }
              

              $('#dates_for_booking').daterangepicker({
                    presetRanges: [],
                     "dateFormat": "dd-mm-yy",
                     initialText : 'Select date(s)...',
                     rangeSplitter: ' TO ',
                     autoFitCalendars: true,
                     datepickerOptions: {
                        showOtherMonths: true,
                        numberOfMonths : 3,
                        autoSize: true,
                        minDate: startdate,
                        maxDate: new Date(new Date().setMonth(new Date(end_of_date).getMonth() + 2)),
                        beforeShowDay: function(date){
                            dmy = addZ(date.getDate()) + "-" + addZ((date.getMonth()+1)) + "-" + date.getFullYear();

                            if ($.inArray(dmy, date_d) !== -1) {
                              return [true,"","available"];

                            } else {
                              return [false, "","unavailable"];
                            }
                        },
                        // minDate: new Date()
                     }
                });

              //  $('#dates_for_booking').datepicker({
              //     dateFormat: 'dd/mm//yy',
              //     beforeShowDay: available
              // });

            })
            $("#ad-booking-form").validate({
                    rules: {
                        cat_id: "required",
                    },
                    errorElement: 'span',
                    errorPlacement: function (error, element) {
                        var elem = $(element);
                       if (elem.hasClass("select2-hidden-accessible")) {
                        error.addClass('invalid-feedback');
                           element = $("#select2-" + elem.attr("id") + "-container").parent();
                           error.insertAfter(element);
                       } else {
                        error.addClass('invalid-feedback');
                        element.closest('.form-group').append(error);
                       }
                      
                    },
                    highlight: function (element, errorClass, validClass) {
                      $(element).addClass('is-invalid');
                    },
                    unhighlight: function (element, errorClass, validClass) {
                      $(element).removeClass('is-invalid');
                    },
                    submitHandler: function(form) {
                        $('#ad-booking-form button[type="submit"]').prop('disabled',true);
                        //// check if any date is selected or not
                        
                        var formd = $('#ad-booking-form')[0];
                        var formData = new FormData(formd);
                        
                        $.ajax({
                           type: "POST",  
                           url: base_url+"home/save_ajax_data",
                           data: formData,
                           processData: false,
                            contentType: false,
                            cache: false,
                            enctype: 'multipart/form-data',
                           dataType: "json",
                           success: function(res){  
                               $('.csrfname_field').val(res.token);
                                if(res.success){
                                   window.open(base_url+'home/my_reservations','_self');
                                } else {
                                    $('#ad-booking-form button[type="submit"]').prop('disabled',false);
                                    Swal.fire({
                                      icon: 'error',
                                      title: 'Attention',
                                      html: res.message
                                    })
                                  return false;
                                }
                           },
                           error: function(XMLHttpRequest, textStatus, errorThrown) {
                                $('#ad-booking-form button[type="submit"]').prop('disabled',false);
                                Swal.fire({
                                   icon: 'error',
                                   title: 'Attention',
                                   html: 'An occured'
                                })
                                return false;
                           }
                       });
                    return false;
                    }

                });
        </script>