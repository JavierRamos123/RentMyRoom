<br><br><br><br>
        <!-- Search Area End Here -->
        <!-- Login Area Start Here -->
        <section class="s-space-bottom-full bg-accent-shadow-body">
            <div class="container">
                <div class="breadcrumbs-area">
                    <ul>
                        <li><a href="<?php echo base_url(); ?>">Home</a> -</li>
                        <li class="active">My Account Page</li>
                    </ul>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-12"></div>
                    <div class="col-lg-9 col-md-8 col-12">
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-12">
                        <div class="gradient-wrapper sidebar-item-box">
                            <ul class="nav tab-nav my-account-title">
                                <li class="nav-item"><a class="active" href="<?php echo base_url('/home/my_account'); ?>" data-toggle="tab" aria-expanded="false">Personal Information</a></li>
                                <li class="nav-item"><a href="<?php echo base_url('/home/my_ads'); ?>" >My Ads</a></li>
                                <li class="nav-item"><a href="<?php echo base_url('/home/my_reservations'); ?>" >My Reservations</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                        <div class="tab-content my-account-wrapper gradient-wrapper input-layout1">
                            <div role="tabpanel" class="gradient-padding tab-pane fade active show" id="personal">
                                <h2 class="title-section">Personal Information</h2>
                                    <?php echo form_open('', array( 'id' => 'personal_info_form', 'class' => '', 'autocomplete'=>'off', 'method' => 'post', 'enctype' => 'multipart/form-data' ));?>
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
                                    
                                    <div class="row">
                                            <div class="col-sm-3 col-12">
                                                <label class="control-label" for="seller_name">First Name<span> *</span></label>
                                            </div>
                                            <div class="col-sm-9 col-12">
                                                <div class="form-group">
                                                    <input type="text" id="seller_name" name="seller_first_name" class="form-control" placeholder="First Name" required="" value="<?php echo $profile_data->seller_first_name; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 col-sm-4 col-12">
                                            <label class="control-label" for="seller_last_name">Last Name</label>
                                        </div>
                                        <div class="col-lg-9 col-md-8 col-sm-8 col-12">
                                            <div class="form-group">
                                                <input type="text" name="seller_last_name" id="seller_last_name" class="form-control" value="<?php echo $profile_data->seller_last_name; ?>" placeholder="Last Name">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3 col-12">
                                            <label class="control-label" for="seller_email">Email<span> *</span></label>
                                        </div>
                                        <div class="col-sm-9 col-12">
                                            <div class="form-group">
                                                <input type="email" class="form-control" placeholder="Enter Your E-mail Address" disabled value="<?php echo $profile_data->seller_email; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 col-12">
                                            <label class="control-label" for="seller_phone">Phone<span> *</span></label>
                                        </div>
                                        <div class="col-sm-9 col-12">
                                            <div class="form-group">
                                                <input type="text" id="seller_phone" name="seller_phone" class="form-control" placeholder="Enter your phone number" required value="<?php echo $profile_data->seller_phone; ?>">
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 col-12">
                                            <label class="control-label" for="seller_phone">About Yourself</label>
                                        </div>
                                        <div class="col-sm-9 col-12">
                                            <div class="form-group">
                                                <textarea placeholder="Write here something about you" class="textarea form-control" name="about_seller" id="about_seller" rows="4" cols="20" data-error="This field is required" ><?php echo @$profile_data->about_seller ?></textarea>
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 col-sm-4 col-12"></div>
                                        <div class="col-lg-9 col-md-8 col-sm-8 col-12">
                                            <div class="form-group">
                                                <div class="checkbox checkbox-primary checkbox-circle">
                                                    <input id="change_my_pssword" type="checkbox">
                                                    <label for="change_my_pssword">Change password</label>
                                                </div>    
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="row password_row" style="display: none">
                                        <div class="col-lg-3 col-md-4 col-sm-4 col-12">
                                            <label class="control-label">Current Password</label>
                                        </div>
                                        <div class="col-lg-9 col-md-8 col-sm-8 col-12">
                                            <div class="form-group">
                                                <input type="password" id="current_password" name="current_password" class="form-control" placeholder="Type Your Current Password">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-4 col-12">
                                            <label class="control-label">New Password</label>
                                        </div>
                                        <div class="col-lg-9 col-md-8 col-sm-8 col-12">
                                            <div class="form-group">
                                                <input type="password" min="5" id="new_password" name="new_password" class="form-control" placeholder="Type Your New Password">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-4 col-12">
                                            <label class="control-label">Confirm Password</label>
                                        </div>
                                        <div class="col-lg-9 col-md-8 col-sm-8 col-12">
                                            <div class="form-group">
                                                <input type="password" min="5" id="cpassword" name="cpassword" class="form-control" placeholder="Type Your Password Again">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="ml-auto col-lg-9 col-md-8 col-sm-8 col-12 ml-none--mb">
                                            <div class="form-group">
                                                <input type="submit" name="save_personal_info" class="cp-default-btn-sm" value="Update Details!">
                                            </div>
                                        </div>
                                    </div>
                                <?php echo form_close();?>
                            </div>
                        </div>                       
                    </div>                    
                </div>
            </div>
        </section>
        <!-- Login Area End Here -->
        <script type="text/javascript">
            $(document).ready(function(){
                $('#change_my_pssword').on('click',function(){
                    $('#current_password').val('')
                    $('#new_password').val('')
                    $('#cpassword').val('')
                    if($(this).is(':checked')){
                        $('.password_row').slideDown()
                    } else{
                        $('.password_row').slideUp()
                    }
                })
                $("#personal_info_form").validate({
                    rules:{
                        current_password :{ required : function(){
                            return $("#new_password").val()!="";
                        } },
                        new_password :{ required : function(){
                            return $("#current_password").val()!="";
                        } },
                        cpassword :{ required : function(){
                            return $("#new_password").val()!="";
                        }, equalTo: '#new_password' }
                    },
                    errorElement: 'span',
                    errorPlacement: function (error, element) {
                        var elem = $(element);
                       if (elem.hasClass("select2-hidden-accessible")) {
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
                        form.submit();
                   }

                });

            })
        </script>