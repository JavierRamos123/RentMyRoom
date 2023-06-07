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
                                <li class="nav-item"><a  href="<?php echo base_url('/home/my_account'); ?>" >Personal Information</a></li>
                                <li class="nav-item"><a href="<?php echo base_url('/home/my_ads'); ?>" class="active">My Ads</a></li>
                                <li class="nav-item"><a href="<?php echo base_url('/home/my_reservations'); ?>" >My Reservations</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                        <div class="tab-content my-account-wrapper gradient-wrapper input-layout1" style="width: fit-content !important;">
                            
                            
                            <div role="tabpanel" class="tab-pane fade  active show" id="my-add">
                               <div class="row">
                                   <div class="col-lg-12">
                                       <div class="gradient-wrapper item-mb border-none" style="width: fit-content !important;">
                                           <div class="gradient-title">
                                               <div class="row no-gutters">
                                                   <div class="col-4 text-center-mb">
                                                       <h2 class="mb10--mb">My Ad List</h2>
                                                   </div>
                                                   <div class="col-8">
                                                       <div class="layout-switcher float-none-mb text-center-mb mb10--mb">
                                                           <ul>
                                                               <li style="display: none;">
                                                                   <div class="page-controls-sorting">
                                                                       <div class="dropdown">
                                                                           <button class="btn sorting-btn dropdown-toggle" type="button" data-toggle="dropdown">Sort By<i class="fa fa-sort" aria-hidden="true"></i></button>
                                                                           <ul class="dropdown-menu">
                                                                               <li><a href="#">Date</a></li>
                                                                               <li><a href="#">Best Sale</a></li>
                                                                               <li><a href="#">Rating</a></li>
                                                                           </ul>
                                                                       </div>
                                                                   </div>
                                                               </li>
                                                               <li class="active"><a href="#" data-type="category-list-layout3" class="product-view-trigger"><i class="fa fa-th-large"></i></a></li>
                                                               <li><a href="#" data-type="category-grid-layout3" class="product-view-trigger"><i class="fa fa-list"></i></a></li>
                                                           </ul>
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>
                                           <div id="category-view" class="category-list-layout3 gradient-padding zoom-gallery">
                                               <div class="row">
                                                    <div class="col-lg-12">
                                                        <?php echo $ad_grid_out; ?>
                                                    </div>
                                               </div>
                                           </div>
                                       </div>
                                      
                                   </div>
                               </div>
                            </div>
                            
                        </div>                       
                    </div>                    
                </div>
            </div>
        </section>
        <form id="" method="post">
   <input type="hidden" class="csrfname_field" name="<?php echo csrf_token() ?>" value="<?php echo csrf_hash() ?>" />
</form>
        <!-- Login Area End Here -->
        <script type="text/javascript">
            function grid_onload(ids){
                $(document).find('.delete_my_ad').each(function(){
                    var bookings = $(this).data('bookings')
                    if(bookings > 0) $(this).remove();
                })
            }

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
            function delete_my_ad(e){
                var record_id = $(e).data('id');
                if(record_id == "") return false;
                 const swalWithBootstrapButtons = Swal.mixin({
                   customClass: {
                     confirmButton: 'btn btn-success',
                     cancelButton: 'btn btn-danger'
                   },
                   buttonsStyling: true
                 })

                 if(record_id == ""){
                     Swal.fire({
                        icon: 'error',
                        title: 'Attention',
                        html: 'Error occured'
                      })
                     return false;
                 }
                 swalWithBootstrapButtons.fire({
                   title: 'Are you sure?',
                   text: "You won't be able to revert this!",
                   icon: 'warning',
                   showCancelButton: true,
                   confirmButtonText: 'Yes, delete my ad!',
                   cancelButtonText: 'No, cancel!',
                   reverseButtons: true
                 }).then((result) => {
                   /* Read more about isConfirmed, isDenied below */
                   if (result.isConfirmed) {
                     var csrfName = $('.csrfname_field').attr('name')
                     var csrfHash = $('.csrfname_field').val()
                     var dataJson = { [csrfName]: csrfHash, record_id: record_id,form_name: 'delete_my_ad'};
                     $.ajax({
                         type: "POST",  
                         url: base_url+"/home/save_ajax_data",
                         data: dataJson,
                         beforeSend: function() {
                           $('#loader').show();
                         },
                         dataType: "json",
                         success: function(res){  
                           $('.csrfname_field').val(res.token);
                           if(res.success){
                              location.reload();
                           } else {
                              Swal.fire({
                                 icon: 'error',
                                 title: 'Attention',
                                 html: res.message
                               })
                              return false;
                           }
                         },
                         error: function(XMLHttpRequest, textStatus, errorThrown) {
                           $('#loader').hide();
                           Swal.fire({
                              icon: 'error',
                              title: 'Attention',
                              html: 'An occured'
                           })
                           return false;
                         }
                     });
                   } else if (result.isDenied) {
                     
                     // Swal.fire('Changes are not saved', '', 'info')
                   }
                 })
            }

        </script>