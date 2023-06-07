<!-- Footer Area Start Here -->
        <footer>
            <div class="footer-area-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12 text-center-mb">
                            <p>Copyright © <?php echo $project_title; ?></p>
                        </div>

                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer Area End Here -->
    </div>
    
    <?php if($session->getFlashdata('success_response_for_sweet_alert')){ ?>
      <script type="text/javascript">
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: '<?php echo $session->getFlashdata('success_response_for_sweet_alert') ?>',
          
        });
      </script>
     <?php } ?>
     <?php if($session->getFlashdata('failed_response_for_sweet_alert')){ ?>
      <script type="text/javascript">
        Swal.fire({
          position: 'center',
          icon: 'error',
          title: '<?php echo $session->getFlashdata('failed_response_for_sweet_alert') ?>',
          // showConfirmButton: true,
          // timer: 2000
        });
      </script>
     <?php } ?>
    
    <script type="text/javascript">
        $(document).ready(function(){
            $("body").tooltip({ selector: '[data-toggle=tooltip]' });
             setTimeout(function(){
                $('.alert-for-dismiss').slideUp('slow')
             },8000);

             $(window).scroll(function () {
                if ($(this).scrollTop() > 50) {
                  $('#back-to-top').fadeIn();
                } else {
                  $('#back-to-top').fadeOut();
                }
              });
              // scroll body to 0px on click
              $('#back-to-top').click(function () {
                $('body,html').animate({
                  scrollTop: 0
                }, 400);
                return false;
              });
        })
    </script>
    <!-- jQuery Zoom -->
    <script src="<?php echo base_url(); ?>public/js/jquery.zoom.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/main.js"></script>
</body>

</html>