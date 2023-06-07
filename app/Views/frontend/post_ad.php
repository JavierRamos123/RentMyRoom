
<link rel="stylesheet" href="<?php echo base_url() ?>public/jquery-ui/jquery-ui.css">
<link rel="stylesheet" href="<?php echo base_url() ?>public/jquery-ui/jquery.comiseo.daterangepicker.css">
  
  <script src="<?php echo base_url() ?>public/jquery-ui/jquery-ui.min.js"></script>
  <script src="<?php echo base_url() ?>public/jquery-ui/moment.min.js"></script>
  <script src="<?php echo base_url() ?>public/jquery-ui/jquery.comiseo.daterangepicker.min.js"></script>
  <style type="text/css">
      .ui-state-highlight {
      border: 0 !important;
    }
 
    .ui-state-highlight a {
      background: #363636 !important;
      color: #fff !important;
    }
    
    .comiseo-daterangepicker-triggerbutton.ui-button {
        min-width: 100%;
      }
      .comiseo-daterangepicker-triggerbutton.ui-button {
        padding: 9px 16px;
      }
  </style><br><br><br><br><br><br><br>
        <!-- Post Ad Page Start Here -->
        <section class="s-space-bottom-full bg-accent-shadow-body">
            <div class="container">
                <div class="breadcrumbs-area">
                    <ul>
                        <li><a href="<?php echo base_url(); ?>">Home</a> -</li>
                        <li class="active">Post A Add</li>
                    </ul>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-12 col-sm-12 col-12 mb--sm">
                        <div class="gradient-wrapper">
                            <div class="gradient-title">
                                <h2>Post A Free Ad</h2>
                            </div>
                            <div class="input-layout1 gradient-padding post-ad-page">
                                <!-- <form id="post-ad-form" method="post"> -->
                                    <?php //echo form_open('', array( 'id' => 'post-ad-form', 'class' => '', 'autocomplete'=>'off', 'method' => 'post', 'enctype' => 'multipart/form-data' ));?>
                                    <form id="post-ad-form" method="post" enctype="multipart/form-data">
                                        <input type="hidden" class="csrfname_field" name="<?php echo csrf_token() ?>" value="<?php echo csrf_hash() ?>" />
                                    <input type="hidden" name="form_name" value="save_ad">
                                    <input type="hidden" name="ad_id" value="<?php echo $ad_id ?>">
                                    <?php if(@$errors){ ?>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="alert alert-danger">
                                                    <?php echo $errors; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                         <?php if($session->getFlashdata('response')){ echo $session->getFlashdata('response'); } ?>
                                        </div>
                                    </div>
                                    <div class="">
                                        
                                        <div class="row">
                                            <div class="col-sm-4 col-12">
                                                <label class="control-label">Type of accommodation:<span> *</span></label>
                                            </div>
                                            <div class="col-sm-8 col-12">
                                                <div class="form-group">
                                                    <select name="cat_id" class='select2 form-control' id="cat_id">
                                                        <option value="">Select Type of accommodation</option>
                                                        <?php if($all_ad_categories){ 
                                                            foreach ($all_ad_categories as $key => $value) {
                                                                
                                                        ?>
                                                        <option <?php echo ($ad_detail && $ad_detail['cat_id'] == $value['id']) ? 'selected' : '' ?> value="<?php echo $value['id'] ?>"><?php echo $value['cat_title']; ?></option>
                                                        <?php }} ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-sm-4 col-12">
                                                <label class="control-label" for="ad_title">Accommodation Name <span> *</span></label>
                                            </div>
                                            <div class="col-sm-8 col-12">
                                                <div class="form-group">
                                                    <input type="text" id="acc_name" name="acc_name" class="form-control" placeholder="Accommodation Name" required value="<?php echo ($ad_detail) ? $ad_detail['acc_name'] : ''; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4 col-12">
                                                <label class="control-label">Country<span> *</span></label>
                                            </div>
                                            <div class="col-sm-8 col-12">
                                                <div class="form-group">
                                                    <select name="country" class="form-control select2" id="country" required>
                                                        <option value="">Select country</option>
                                                        <?php if($countries){ 
                                                            foreach ($countries as $key => $value) {
                                                        ?>
                                                        <option <?php echo ($ad_detail && $ad_detail['country'] == $value->country_name) ? 'selected' : '' ?> value="<?php echo $value->country_name ?>"><?php echo $value->country_name ?></option>
                                                        <?php }} ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4 col-12">
                                                <label class="control-label">Address: (Street and number)<span> *</span></label>
                                            </div>
                                            <div class="col-sm-8 col-12">
                                                <div class="form-group">
                                                    <textarea name="address" class="form-control" required><?php echo ($ad_detail) ? $ad_detail['address'] : ''; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4 col-12">
                                                <label class="control-label">City:<span> *</span></label>
                                            </div>
                                            <div class="col-sm-8 col-12">
                                                <div class="form-group">
                                                    <input type="text" name="city" class="form-control" required value="<?php echo ($ad_detail) ? $ad_detail['city'] : ''; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4 col-12">
                                                <label class="control-label">Postal Code:<span> *</span></label>
                                            </div>
                                            <div class="col-sm-8 col-12">
                                                <div class="form-group">
                                                    <input type="text" name="postal_code" class="form-control" required value="<?php echo ($ad_detail) ? $ad_detail['postal_code'] : ''; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4 col-12">
                                                <label class="control-label" for="ad_price">Select dates <span> *</span></label>
                                            </div>
                                            <div class="col-sm-8 col-12">
                                                <div class="form-group">
                                                    <input type="text" required id="datePick" name="dates" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4 col-12">
                                                <label class="control-label" for="ad_price">Set Price <span> *</span></label>
                                            </div>
                                            <div class="col-sm-8 col-12">
                                                <div class="form-group">
                                                    <input type="number" min="1" id="ad_price" name="ad_price" class="form-control " placeholder="Set your Price Here" required="" value="<?php echo ($ad_detail) ? $ad_detail['ad_price'] : ''; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4 col-12">
                                                <label class="control-label">Further deails:</label>
                                            </div>
                                            <div class="col-sm-8 col-12">
                                                <div class="form-group">
                                                    <textarea name="ad_desc" rows="4" class="form-control"><?php echo ($ad_detail) ? $ad_detail['ad_desc'] : ''; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4 col-12">
                                                <label class="control-label" for="">Feature Picture<?php if($ad_dates == ""){ echo '<span> *</span>'; } ?><br><?php if($ad_dates){ ?>
                                                        <img src="<?php echo base_url() ?>public/my_images/thumbnail/<?php echo $ad_detail['ad_picture_1'] ?>">
                                                    <?php } ?></label>

                                            </div>
                                            <div class="col-sm-8 col-12">
                                                <div class="form-group">
                                                    <input <?php if($ad_dates == ""){ echo 'required'; }?> type="file" id="ad_picture_1" name="ad_picture_1" class="form-control">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4 col-12">
                                                <label class="control-label" for="">Upload Picture 2 <br><?php if($ad_dates && $ad_detail['ad_picture_2'] != "" ){ ?>
                                                        <img src="<?php echo base_url() ?>public/my_images/thumbnail/<?php echo $ad_detail['ad_picture_2'] ?>">
                                                    <?php } ?></label>
                                            </div>
                                            <div class="col-sm-8 col-12">
                                                <div class="form-group">
                                                    <input type="file" id="ad_picture_2" name="ad_picture_2" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4 col-12">
                                                <label class="control-label" for="">Upload Picture 3<br><?php if($ad_dates && $ad_detail['ad_picture_3'] != "" ){ ?>
                                                        <img src="<?php echo base_url() ?>public/my_images/thumbnail/<?php echo $ad_detail['ad_picture_3'] ?>">
                                                    <?php } ?></label> 
                                            </div>
                                            <div class="col-sm-8 col-12">
                                                <div class="form-group">
                                                    <input  type="file" id="ad_picture_3" name="ad_picture_3" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 col-12">
                                            <label class="control-label">Services offered</label>
                                        </div>
                                        <div class="col-sm-8 col-12">
                                            <?php if($services_list){
                                                foreach ($services_list as $key => $value) {
                                                    $checked = '';
                                                    if(in_array($value->id, $ad_services_offered)) $checked = 'checked';
                                            ?>
                                                <div class="form-check">
                                                  <input <?php echo $checked ?> class="form-check-input fields_checkbox" style="margin-left: 0;" type="checkbox" name="services_offered[]" id="inlineCheckbox<?php echo $key ?>" value="<?php echo $value->id.' --- '.$value->service_desc ?>">
                                                  <label class="form-check-label" for="inlineCheckbox<?php echo $key ?>"><?php echo $value->service_desc ?></label>
                                                </div>
                                            <?php }} ?>
                                        </div>
                                    </div>
                                <div class="row">
                                    <div class="col-sm-9 col-12">
                                        
                                    </div>
                                    <div class="col-sm-3 col-12">
                                        <button type="submit" class="cp-default-btn-sm pull-right">Submit Now!</button>
                                    </div>
                                    
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Post Ad Page End Here -->
        <script type="text/javascript">
            $(document).ready(function(){
                var ad_id = '<?php echo $ad_id ?>'
                var base_url = '<?php echo base_url(); ?>'
                $('#datePick').daterangepicker({
                    presetRanges: [],
                     "dateFormat": "dd-mm-yy",
                     initialText : 'Select date(s)...',
                     rangeSplitter: ' TO ',
                     autoFitCalendars: false,
                     datepickerOptions: {
                        autoSize: true,
                        minDate: 0,
                        maxDate: null
                     }
                });
                if(ad_id != ""){
                    $("#datePick").daterangepicker("setRange", {
                      start: new Date('<?php echo $ad_dates->min_date ?>'),
                      end:   new Date('<?php echo $ad_dates->max_date ?>')
                    });
                }
                
                $('#post-ad-form select.select2').select2({
                    theme: 'classic',
                    dropdownAutoWidth: true,
                    width: '100%'
                });

                $('#post-ad-form select.select2').select2({
                    theme: 'classic',
                    dropdownAutoWidth: true,
                    width: '100%'
                });

                $("#post-ad-form").validate({
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
                        $('#post-ad-form button[type="submit"]').prop('disabled',true);
                        var formd = $('#post-ad-form')[0];
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
                                   window.open(base_url+'home/my_account','_self');
                                } else {
                                    $('#post-ad-form button[type="submit"]').prop('disabled',false);
                                    Swal.fire({
                                      icon: 'error',
                                      title: 'Attention',
                                      html: res.message
                                    })
                                  return false;
                                }
                           },
                           error: function(XMLHttpRequest, textStatus, errorThrown) {
                                $('#post-ad-form button[type="submit"]').prop('disabled',false);
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

            })
        </script>