
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

                    if(isset($_POST['signup-button']))
                    {
                        $username = $_POST['username'];
                        $client_email = $_POST['client_email'];
                        $password = $_POST['password'];
                        $first_name = $_POST['first_name'];
                        $last_name = $_POST['last_name'];
                        $hashedPass = sha1($password);

                        //Check if User Exist In database

                        $stmt = $con->prepare("SELECT * from clients where username = ?");
                        $stmt->execute(array($username));
                        $row = $stmt->fetch();
                        $count = $stmt->rowCount();

                        // Check if count > 0 which mean that the database contain a record about this username

                        if($count > 0)
                        { ?>
                            <div class="alert alert-danger">
                                <button data-dismiss="alert" class="close close-sm" type="button">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <div class="messages">
                                    <div>Already Exist Account</div>
                                </div>
                            </div>
                        <?php }
                        else
                        {

                            $stmt = $con->prepare("INSERT INTO clients (first_name,last_name,client_email,username,password) VALUES (?,?,?,?,?)");
                            $stmt->execute(array($first_name,$last_name,$client_email,$username,$hashedPass));
                            ?>

                            <div class="alert alert-success">
                                <button data-dismiss="alert" class="close close-sm" type="button">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <div class="messages">
                                    <div>Successfully Create Account</div>
                                </div>
                                <script>
                                    setInterval(function(){
                                        location.href = 'login.php'
                                    },1500)
                                </script>
                            </div>

                            <?php
                        }
                    }

                ?>

            <div class="section_heading">
                <h2>Sign up</h2>
            </div>
            <div style="max-width: 500px;" class="container">
                <form method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Firstname*</label>
                                <input type="text" name="first_name" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Lastname*</label>
                                <input type="text" name="last_name" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Email*</label>
                                <input type="text" name="client_email" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Username*</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Password*</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" name="signup-button" class="btn btn-dark w-100 rounded-0" style="padding: 12px 0px;" required>Signup</button>
                            </div>
                        </div>
                    </div>
                </form>
                <a href="login.php">Already have an account?</a>
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