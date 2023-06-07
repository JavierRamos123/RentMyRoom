        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <?php if(isset($form_data)) extract($form_data); ?>
        <!-- Signup Area Start Here -->
        <section class="s-space-bottom-full bg-accent-shadow-body">
            <div class="container">
                <div class="breadcrumbs-area">
                    <ul>
                        <li><a href="<?php echo base_url() ?>">Home</a> -</li>
                        <li class="active">Create Account</li>
                    </ul>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12">
                        <div class="gradient-wrapper mb--sm">
                            <div class="gradient-title">
                                <h2>Create An Account</h2>
                            </div>
                            <div class="input-layout1 gradient-padding">
                                <div class="for-errors">
                                    
                                </div>
                                <?php if(isset($errors)): ?>
                                    <div class="alert alert-danger solid alert-dismissible fade show"><button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button><?php echo $errors; ?></div>
                                <?php endif; ?>
                                <!-- <div class="row"> -->
                                  <div class="form-group">
                                    <?php if($session->getFlashdata('response')){ echo $session->getFlashdata('response'); } ?>  
                                  </div>
                                <!-- <form id="signup_form"> -->
                                <?php echo form_open('', array( 'id' => 'signup_form', 'class' => '', 'autocomplete'=>'off', 'method' => 'post', 'enctype' => 'multipart/form-data' ));?>
                                        <div class="row" style="display: none;">
                                            <div class="col-sm-3 col-12">
                                                <label class="control-label possition-top" for="seller_type">Account <span>*</span></label>
                                            </div>
                                            <div class="col-sm-9 col-12">
                                                <div class="form-group">
                                                    <div class="radio radio-primary radio-inline">
                                                        <input <?php echo (@$seller_type == 'Individual') ? 'checked' : ''; ?> type="radio" id="Individual" value="Individual" name="seller_type" >
                                                        <label for="Individual">Individual</label>
                                                    </div>
                                                    <div class="radio radio-primary radio-inline">
                                                        <input type="radio" <?php echo (@$seller_type == 'Business') ? 'checked' : ''; ?> id="Business" value="Business" name="seller_type">
                                                        <label for="Business"> Business </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 col-12">
                                                <label class="control-label" for="seller_name">First Name<span> *</span></label>
                                            </div>
                                            <div class="col-sm-9 col-12">
                                                <div class="form-group">
                                                    <input type="text" value="<?php echo @$seller_first_name ?>" id="seller_first_name" name="seller_first_name" class="form-control" placeholder="First Name" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 col-12">
                                                <label class="control-label" for="seller_last_name">Last Name<span> *</span></label>
                                            </div>
                                            <div class="col-sm-9 col-12">
                                                <div class="form-group">
                                                    <input type="text" id="seller_last_name" value="<?php echo @$seller_last_name ?>" name="seller_last_name" class="form-control" placeholder="Last Name" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 col-12">
                                                <label class="control-label possition-top" for="gender">Gender </label>
                                            </div>
                                            <div class="col-sm-9 col-12">
                                                <div class="form-group">
                                                    <div class="radio radio-primary radio-inline">
                                                        <input <?php echo (@$gender == 'Male') ? 'checked' : ''; ?> type="radio" id="male" value="Male" name="gender" >
                                                        <label for="male">Male</label>
                                                    </div>
                                                    <div class="radio radio-primary radio-inline">
                                                        <input type="radio" id="female"  <?php echo (@$gender == 'Female') ? 'checked' : ''; ?> value="Female" name="gender">
                                                        <label for="female">Female</label>
                                                    </div>
                                                    <div class="radio radio-primary radio-inline">
                                                        <input type="radio" id="other" <?php echo (@$gender == 'Other') ? 'checked' : ''; ?> value="Other" name="gender">
                                                        <label for="other">Other</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 col-12">
                                                <label class="control-label" for="seller_phone">Phone Number<span>*</span></label>
                                            </div>
                                            <div class="col-sm-9 col-12">
                                                <div class="form-group">
                                                    <input type="text" id="seller_phone" name="seller_phone" value="<?php echo @$seller_phone ?>" class="form-control" placeholder="Enter your phone number" required>
                                                    <div class="checkbox checkbox-primary checkbox-circle" style="display: none;">
                                                        <input id="hide_seller_phone" <?php echo (@$hide_seller_phone == '1') ? 'checked' : ''; ?> name="hide_seller_phone" value="1" type="checkbox" >
                                                        <label for="hide_seller_phone">Hide the phone number</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 col-12">
                                                <label class="control-label">About Yourself</label>
                                            </div>
                                            <div class="col-sm-9 col-12">
                                                <div class="form-group">
                                                    <textarea placeholder="Write here something about you" class="textarea form-control" name="about_seller" id="about_seller" rows="4" cols="20" data-error="This field is required" ><?php echo @$about_seller ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 col-12">
                                                <label class="control-label" for="seller_email">Email<span> *</span></label>
                                            </div>
                                            <div class="col-sm-9 col-12">
                                                <div class="form-group">
                                                    <input type="email" value="<?php echo @$seller_email ?>" id="seller_email" name="seller_email" class="form-control" placeholder="Enter Your E-mail Address" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-3 col-12">
                                                <label class="control-label" for="password">Password<span> *</span></label>
                                            </div>
                                            <div class="col-sm-9 col-12">
                                                <div class="form-group">
                                                    <input type="password" id="password" name="password" class="form-control" placeholder="" required>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    <div class="row">
                                        <div class="ml-auto col-sm-9 col-12 ml-none--mb">
                                            <div class="form-group">
                                                <button type="submit" class="cp-default-btn-sm">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                <!-- </form> -->
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Signup Area End Here -->
        <script type="text/javascript">
            $(document).ready(function(){
                $("#signup_form").validate({
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
                        var csrfName = '<?php echo csrf_token(); ?>';
                        var csrfHash = $('input[name="' + csrfName + '"]').val();
                        var form_data = $('#signup_form').serialize();                        
                        $.ajax({
                                type: "POST",  
                                url: base_url+"home/save_account",
                                data: form_data,
                                dataType: "json",
                                success: function(res){  
                                    $('input[name="' + csrfName + '"]').val(res.token);
                                    if(res.success){
                                        window.location.replace(base_url);
                                    } else {
                                        Swal.fire({
                                          icon: 'error',
                                          title: '',
                                          html: res.msg
                                        })
                                      return false;
                                    }
                                    return false;
                                },
                                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                                    Swal.fire({
                                       icon: 'error',
                                       title: '',
                                       html: 'An error occured'
                                    })
                                    return false;
                                }
                         });
                   }

                });
            })
        </script>
        