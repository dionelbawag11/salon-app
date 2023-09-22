
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

                    if(isset($_POST['signin-button']))
                    {
                        $username = $_POST['username'];
                        $password = $_POST['password'];
                        $hashedPass = sha1($password);

                        //Check if User Exist In database

                        $stmt = $con->prepare("SELECT * from clients where username = ? and password = ?");
                        $stmt->execute(array($username,$hashedPass));
                        $row = $stmt->fetch();
                        $count = $stmt->rowCount();

                        // Check if count > 0 which mean that the database contain a record about this username

                        if($count > 0)
                        {
                            $_SESSION['client_id'] = $row['client_id'];
                            echo "<script>window.location.href='index.php';</script>";
                            die();
                        }
                        else
                        {
                            ?>

                            <div class="alert alert-danger">
                                <button data-dismiss="alert" class="close close-sm" type="button">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <div class="messages">
                                    <div>Username and/or password are incorrect!</div>
                                </div>
                            </div>

                            <?php
                        }
                    }

                ?>

            <div class="section_heading">
                <h2>My Appontment</h2>
            </div>
            <div class="container">
                <div class="table-responsive">
                    <table class="table table-bordered tabcontent" id="Upcoming" style="display:table" width="100%" cellspacing="0">
                        <thead>
                                <tr>
                                    <th>
                                        Start Time
                                    </th>
                                    <th>
                                        Booked Services
                                    </th>
                                    <th>
                                        End Time Expected
                                    </th>
                                    <th>
                                        Client
                                    </th>
                                    <th>
                                        Employee
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                    $stmt = $con->prepare("SELECT * 
                                                    FROM appointments a , clients c
                                                    where start_time >= ?
                                                    and a.client_id = c.client_id
                                                    and 
                                                    a.client_id = '".$_SESSION['client_id']."'
                                                    order by start_time;
                                                    ");
                                    $stmt->execute(array(date('Y-m-d H:i:s')));
                                    $rows = $stmt->fetchAll();
                                    $count = $stmt->rowCount();
                                    
                                    

                                    if($count == 0)
                                    {

                                        echo "<tr>";
                                            echo "<td colspan='5' style='text-align:center;'>";
                                                echo "List of your upcoming bookings will be presented here";
                                            echo "</td>";
                                        echo "</tr>";
                                    }
                                    else
                                    {

                                        foreach($rows as $row)
                                        {
                                            echo "<tr>";
                                                echo "<td>";
                                                    echo $row['start_time'];
                                                echo "</td>";
                                                echo "<td>";
                                                    $stmtServices = $con->prepare("SELECT service_name
                                                            from services s, services_booked sb
                                                            where s.service_id = sb.service_id
                                                            and appointment_id = ?");
                                                    $stmtServices->execute(array($row['appointment_id']));
                                                    $rowsServices = $stmtServices->fetchAll();
                                                    foreach($rowsServices as $rowsService)
                                                    {
                                                        echo "- ".$rowsService['service_name'];
                                                        if (next($rowsServices)==true)  echo " <br> ";
                                                    }
                                                echo "</td>";
                                                echo "<td>";
                                                    echo $row['end_time_expected'];
                                            
                                                echo "</td>";
                                                echo "<td>";
                                                    echo "<a href = #>";
                                                        echo $row['client_id'];
                                                    echo "</a>";
                                                echo "</td>";
                                                echo "<td>";
                                                    $stmtEmployees = $con->prepare("SELECT first_name,last_name
                                                            from employees e, appointments a
                                                            where e.employee_id = a.employee_id
                                                            and a.appointment_id = ?");
                                                    $stmtEmployees->execute(array($row['appointment_id']));
                                                    $rowsEmployees = $stmtEmployees->fetchAll();
                                                    foreach($rowsEmployees as $rowsEmployee)
                                                    {
                                                        echo $rowsEmployee['first_name']." ".$rowsEmployee['last_name'];
                                                        
                                                    }
                                                echo "</td>";


                                                echo "<td>";
                                                if ($row['canceled'] == 1) {
                                                    echo "Cancelled";
                                                }
                                                echo "</td>";

                                                echo "<td>";
                                                echo "<a href='gcash.php?appointment_id=".$row['appointment_id']."'>Gcash Upload</a>";
                                                echo "</td>";
                                                    ?>
                                                

                                                    <?php
                                            echo "</tr>";
                                        }
                                    }

                                ?>

                            </tbody>
                    </table>
                </div>
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