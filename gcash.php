
<!-- PHP INCLUDES -->

<?php

    include "connect.php";
    include "Includes/templates/header.php";
    include "Includes/templates/navbar.php";

?>

    

    <!-- PRICING SECTION  -->

    <section class="pricing_section" id="pricing">

        
        <div class="container">
            <?php

                    if(isset($_POST['uploadproof']))
                    {
                        $appointment_id = $_GET['appointment_id'];

                        $proof = $_FILES['proof']['name'];
                        move_uploaded_file($_FILES['proof']['tmp_name'], "images/".$proof);

                        $stmt = $con->prepare("UPDATE appointments SET proof = ? where appointment_id = '".$_GET['appointment_id']."' ");
                        $stmt->execute(array($proof));
                        
                            ?>

                            <div class="alert alert-success">
                                <button data-dismiss="alert" class="close close-sm" type="button">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <div class="messages">
                                    <div>Successfully Uplaod Proof</div>
                                </div>
                            </div>
                            <script>
                                setInterval(function(){
                                    location.href = 'myappointment.php'
                                },2000)
                            </script>>

                            <?php
                        
                    }

                ?>

            <div class="section_heading">
                <h2>Upload Gcash Proof</h2>
            </div>
            <div class="container">
                <form method="POST"  enctype="multipart/form-data">
        <div class="row">
              <div class="col-lg-12 mt-5">
                <div class="card border-0 bg-transparent">
                  <div class="card-body p-0">
                    <div class="each-rooms">
                      <div>
                        <div class="row payment">
                <div class="col-md-12">
                  <div class="form-group border p-5" style="height: 600px;">
                    <div class="m-auto bg-white position-relative border" style="width: 300px;height: 100%;">
                      <span class="text-muted" style="font-size: 5rem;position: absolute;top: 50%;left: 50%;transform: translate(-50%,-50%);"><i class="fas fa-cloud-upload-alt"></i></span>
                      <span class="text-muted font-weight-bold" style="font-size: 1.5rem;position: absolute;top: 65%;left: 50%;transform: translate(-50%,-65%);">PAYMENT</span>

                      <img id="uploadedImage" src="#" alt="Uploaded Image" accept="image/png, image/jpeg" style="display:none;position: absolute;top: 0;" width="100%" height="100%">
                      <input type="file" name="proof" id="proof" accept=".png" class="form-control border-0 h-100 w-100 position-absolute" style="opacity: 0;" required>
                    </div>
                    
                    
                  </div>
                </div>
        
              </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div>
              
              </div>
              
         
            <div class="border-0 mt-5 text-right w-100">
              <button type="submit" name="uploadproof" class="btn text-white rounded-0" style="background-color: #6d4c41;">Upload</button>
            </div>
        </div>
      </form>
            </div>
        </div>
    </section>

    

    <!-- WIDGET SECTION / FOOTER -->

    <section class="widget_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer_widget">
                        <img src="Design/images/logo.png" alt="Brand">
                        <p>
                        Hair salons provide men and women with services to clean, condition, strengthen, cut, style and color their hair. Opening a hair salon requires that you meet local, state and federal licensing and permit regulations, as well as registering your business as a legal entity, finding staff and marketing your salon.
                        </p>
                        <ul class="widget_social">
                            <li><a href="#" data-toggle="tooltip" title="Facebook"><i class="fab fa-facebook-f fa-2x"></i></a></li>
                            <li><a href="#" data-toggle="tooltip" title="Twitter"><i class="fab fa-twitter fa-2x"></i></a></li>
                            <li><a href="#" data-toggle="tooltip" title="Instagram"><i class="fab fa-instagram fa-2x"></i></a></li>
                            <li><a href="#" data-toggle="tooltip" title="LinkedIn"><i class="fab fa-linkedin fa-2x"></i></a></li>
                            <li><a href="#" data-toggle="tooltip" title="Google+"><i class="fab fa-google-plus-g fa-2x"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                     <div class="footer_widget">
                        <h3>Main Store</h3>
                        <p>
                        City Mall Tetuan, Zamboanga City, Philippines
                        </p>
                        <p>
                        09153513277
                            <br>
                            (62) 955 9520 
                        </p>
                     </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer_widget">
                        <h3>
                            Opening Hours
                        </h3>
                        <ul class="opening_time">
                            <li>Monday - Friday 11:30am - 2:008pm</li>
                            <li>Monday - Friday 11:30am - 2:008pm</li>
                            <li>Monday - Friday 11:30am - 2:008pm</li>
                            <li>Monday - Friday 11:30am - 2:008pm</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer_widget">
                        <h3>
                           Please Visit Us
                        </h3>
                        <ul class="opening_time">
                            <li>Monday - Friday 11:30am - 2:008pm</li>
                            <li>Monday - Friday 11:30am - 2:008pm</li>
                            <li>Monday - Friday 11:30am - 2:008pm</li>
                            <li>Monday - Friday 11:30am - 2:008pm</li>
                        </ul>
                    </div>
                </div>
               
            </div>
        </div>
    </section>

    <!-- FOOTER  -->

    <?php include "Includes/templates/footer.php"; ?>
    <script>
      document.getElementById('proof').addEventListener('change', function(){
      if (this.files[0] ) {
        var picture = new FileReader();
        picture.readAsDataURL(this.files[0]);
        picture.addEventListener('load', function(event) {
          document.getElementById('uploadedImage').setAttribute('src', event.target.result);
          document.getElementById('uploadedImage').style.display = 'block';
        });
        }
      });
    </script>