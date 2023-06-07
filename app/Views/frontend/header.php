<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $project_title ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>public/img/favicon.png">
    <!-- Bootstrap CSS -->
    
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.min.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/animate.min.css">
    <!-- Font-awesome CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/font-awesome.min.css">
    <!-- Owl Caousel CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/vendor/OwlCarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/vendor/OwlCarousel/owl.theme.default.min.css">
    <!-- Main Menu CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/meanmenu.min.css">
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/select2.min.css">
    <!-- Magnific CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/magnific-popup.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/style.css">


    <script src="<?php echo base_url(); ?>public/js/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="<?php echo base_url(); ?>public/js/popper.js"></script>
    <!-- Bootstrap js -->
    <script src="<?php echo base_url(); ?>public/js/bootstrap.min.js "></script>
    <!-- Owl Cauosel JS -->
    <script src="<?php echo base_url(); ?>public/vendor/OwlCarousel/owl.carousel.min.js "></script>
    <!-- Meanmenu Js -->
    <script src="<?php echo base_url(); ?>public/js/jquery.meanmenu.min.js "></script>
    <!-- Srollup js -->
    <script src="<?php echo base_url(); ?>public/js/jquery.scrollUp.min.js "></script>
    <!-- jquery.counterup js -->
    <script src="<?php echo base_url(); ?>public/js/jquery.counterup.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/waypoints.min.js"></script>
    <!-- Select2 Js -->
    <script src="<?php echo base_url(); ?>public/js/select2.min.js"></script>
    <!-- Isotope js -->
    <script src="<?php echo base_url(); ?>public/js/isotope.pkgd.min.js "></script>
    <!-- Magnific Popup -->
    <script src="<?php echo base_url(); ?>public/js/jquery.magnific-popup.min.js"></script>
    <!-- Google Map js -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtmXSwv4YmAKtcZyyad9W7D4AC08z0Rb4"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/public/sweetalert2/dist/sweetalert2.min.css">
   <script src="<?php echo base_url(); ?>/public/sweetalert2/dist/sweetalert2.all.min.js"></script>

    <script src="<?php echo base_url() ?>public/js/jquery.validate.min.js"></script>
    <script src="<?php echo base_url() ?>public/js/additional-methods.min.js"></script>

    <!-- GRID PHP -->
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('/public'); ?>/gridphp/lib/js/themes/redmond/jquery-ui.custom.css">
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('/public'); ?>/gridphp/lib/js/jqgrid/css/ui.jqgrid.css">
    <script src="<?php echo base_url('/public'); ?>/gridphp/lib/js/jqgrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
   <script src="<?php echo base_url('/public'); ?>/gridphp/lib/js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>
   <script src="<?php echo base_url('/public'); ?>/gridphp/lib/js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>

    <script type="text/javascript">const base_url = "<?php echo base_url(); ?>";</script>
    <style type="text/css">
        .swal2-container ul {
         list-style-type: none !important;
      }
      .item-mask-wrapper {
        cursor: pointer;
      }

/*      for gridphp*/
      .ui-widget-header {
          border: 1px solid #0e9a7a !important;
          background: #0e9a7a !important;
      }
      .ui-state-default, .ui-widget-content .ui-state-default {
        color: #0e9a7a !important
      }

.nav-item.dropdown.active, .nav-item.active {
    background-color: #e5e5eb;
    border-bottom: 3px solid #700f1a;
}

.nav-item.dropdown.active > .nav-link, .nav-item.active > .nav-link {
   color: #700f1a;
    text-decoration: none;
}

.nav-item.dropdown:hover, .nav-item:hover {
    background-color: #e5e5eb;
    border-bottom: 3px solid #700f1a;
}
.nav-item.dropdown:hover .dropdown-toggle, .nav-item:hover .nav-link {
   color: #700f1a;
    text-decoration: none;
}

.horizontal-topnav .navbar-nav .dropdown-item:hover, .horizontal-topnav .navbar-nav .dropdown-item:focus {
    color: #700f1a;
}


    </style>
</head>

<body>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="title-default-bold mb-none">Login</div>
                </div>
                <div class="modal-body">
                    <div class="login-form">
                        <div class="login_response"></div>
                        <?php echo form_open('', array( 'id' => 'login_form', 'class' => '', 'autocomplete'=>'off', 'method' => 'post', 'enctype' => 'multipart/form-data' ));?>

                            <div class="form-group">
                                <label>Email address *</label>
                                <input type="text" name="seller_email" placeholder="E-mail" required autofocus />
                            </div>
                            <div class="form-group">
                                <label>Password *</label>
                                <input type="password" placeholder="Password" name="password" required />    
                            </div>
                            
                            <!-- <div class="checkbox checkbox-primary">
                                <input id="checkbox1" type="checkbox">
                                <label for="checkbox1">Remember Me</label>
                            </div> -->

                            <button class="default-big-btn" type="submit" value="Login">Login</button>
                            <button class="default-big-btn form-cancel" type="button" data-dismiss="modal">Cancel</button>
                            <label class="lost-password"><a href="#">Forgot your password?</a></label>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal2" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="title-default-bold mb-none">Login</div>
                </div>
                <div class="modal-body">
                    <div class="login-form">
                        <div class="login_response"></div>
                        <?php echo form_open('', array( 'id' => 'login_form2', 'class' => '', 'autocomplete'=>'off', 'method' => 'post', 'enctype' => 'multipart/form-data' ));?>
                            <input type="hidden" name="login_redirect_url" value="<?php echo base_url().'home/post_ad' ?>">
                            <div class="form-group">
                                <label>Email address *</label>
                                <input type="text" name="seller_email" placeholder="E-mail" required autofocus />
                            </div>
                            <div class="form-group">
                                <label>Password *</label>
                                <input type="password" placeholder="Password" name="password" required />    
                            </div>
                            

                            <button class="default-big-btn" type="submit" value="Login">Login</button>
                            <button class="default-big-btn form-cancel" type="button" data-dismiss="modal">Cancel</button>
                            <label class="lost-password"><a href="#">Forgot your password?</a></label>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="preloader"></div>
    <div id="wrapper">
        <header>
            <div id="header-three" class="header-style1 header-fixed">
                <div class="header-top-bar top-bar-style1">
                    <div class="container">
                        <div class="row no-gutters">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-8">
                                <div class="top-bar-left">
                                    <a href="<?php echo base_url() ?>" class="cp-default-btn d-lg-none">Post Your Ad</a>
                                    <p class="d-none d-lg-block">
                                        <i class="fa fa-life-ring" aria-hidden="true"></i>Copyright © Rent My Room
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-4">
                                <div class="top-bar-right">
                                    <ul>
                                        <?php if(!$session->has('seller_id')){ ?>
                                        <li>
                                            <button type="button" class="login-btn" data-toggle="modal" data-target="#myModal">
                                                <i class="fa fa-lock" aria-hidden="true"></i>Login
                                            </button>
                                        </li>
                                        
                                        <li class="hidden-mb">
                                            <a class="login-btn" href="<?php echo base_url('home/signup'); ?>" id="">
                                                <i class="fa fa-user" aria-hidden="true"></i>Create an account
                                            </a>
                                        </li>
                                        <?php } else { ?>
                                            <li class="">
                                                <a class="login-btn" title="Logout" href="<?php echo base_url('home/logout'); ?>" >
                                                    <i class="fa fa-user" aria-hidden="true"></i><?php echo $session->get('full_name_home'); ?>&nbsp;&nbsp;<i class="fa fa-power-off" aria-hidden="true"></i>
                                                </a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-menu-area bg-primary" id="sticker">
                    <div class="container">
                        <div class="row no-gutters d-flex align-items-center">
                            <div class="col-lg-2 col-md-2 col-sm-3">
                                <div class="logo-area">
                                    <a href="<?php echo base_url() ?>" class="img-fluid">
                                        <img src="<?php echo base_url(); ?>public/img/logo23.png" alt="logo">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-6 possition-static">
                                <div class="cp-main-menu">
                                    <nav>
                                        <ul>
                                            <li><a href="<?php echo base_url(); ?>">Home</a></li>
                                            <li><a href="<?php echo base_url('home/about'); ?>">About Us</a></li>
                                            
                                            <li><a href="<?php echo base_url('home/contact'); ?>">Contact Us</a></li>
                                            <?php if($session->has('seller_id')){ ?>
                                                 <li><a href="<?php echo base_url('home/my_account'); ?>">My Account</a></li>
                                            <?php } ?>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-3 text-right">
                                <?php if(!$session->has('seller_id')){ ?>
                                    
                                    <a data-toggle="modal" data-target="#myModal2" href="javascript:void(0)" class="cp-default-btn">Post Your Ad</a>
                                <?php } else { ?>
                                    <a href="<?php echo base_url('home/post_ad'); ?>" class="cp-default-btn">Post Your Ad</a>
                                <?php } ?>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mobile-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mobile-menu">
                                <nav id="dropdown">
                                    <ul>
                                         <ul>
                                        <li><a href="<?php echo base_url(); ?>">Home</a></li>
                                        <li><a href="<?php echo base_url('home/about'); ?>">About Us</a></li>
                                        <li><a href="<?php echo base_url('home/contact'); ?>">Contact Us</a></li>
                                        <?php if($session->has('isLoggedin_home')){ ?>
                                             <li><a href="<?php echo base_url('home/my_account'); ?>">My Account</a></li>
                                        <?php } ?>
                                    </ul>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#login_form').validate({
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
                        var seller_email = $('#login_form input[name="seller_email"]').val();
                        var password = $('#login_form input[name="password"]').val();
                        var dataJson = { seller_email : seller_email, password: password,[csrfName]: csrfHash };
                        $.ajax({
                                type: "POST",  
                                url: base_url+"home/login_valid",
                                data: dataJson,
                                dataType: "json",
                                success: function(res){  
                                $('input[name="' + csrfName + '"]').val(res.token);
                                if(res.success){
                                    window.location.replace(res.redirect_url);
                                } else {
                                    $(document).find('#myModal .login_response').html(res.msg);
                                    $(document).find('#myModal2 .login_response').html(res.msg);
                                    return false;
                                }
                                return false;
                                },
                                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                                  $(document).find('#myModal .login_response').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">Erorr occured.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                                  $(document).find('#myModal2 .login_response').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">Erorr occured.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                                  return false;
                                }
                         });
                    }

                });
                $('#login_form2').validate({
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
                        var seller_email = $('#login_form2 input[name="seller_email"]').val();
                        var password = $('#login_form2 input[name="password"]').val();
                        var login_redirect_url = $('#login_form2 input[name="login_redirect_url"]').val();

                        var dataJson = { seller_email : seller_email, password: password,login_redirect_url:login_redirect_url,[csrfName]: csrfHash };
                        $.ajax({
                                type: "POST",  
                                url: base_url+"home/login_valid",
                                data: dataJson,
                                dataType: "json",
                                success: function(res){  
                                $('input[name="' + csrfName + '"]').val(res.token);
                                if(res.success){
                                    window.location.replace(res.redirect_url);
                                } else {
                                    $(document).find('#myModal2 .login_response').html(res.msg);
                                    return false;
                                }
                                return false;
                                },
                                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                                  $(document).find('#myModal2 .login_response').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">Erorr occured.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                                  return false;
                                }
                         });
                    }

                });
            })
        </script>
