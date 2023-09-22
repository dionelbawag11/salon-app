<?php

	use PHPMailer\PHPMailer\PHPMailer;

    require_once "../../sendphpmailer/PHPMailer.php";
    require_once "../../sendphpmailer/SMTP.php";
    require_once "../../sendphpmailer/Exception.php";

?>
<?php include '../connect.php'; ?>
<?php include '../Includes/functions/functions.php'; ?>


<?php
	

	if(isset($_POST['do']) && $_POST['do'] == "Cancel Appointment")
	{
		$appointment_id = $_POST['appointment_id'];
		$cancellation_reason =  test_input($_POST['cancellation_reason']);

        $stmt = $con->prepare("UPDATE appointments set canceled = 1, cancellation_reason = ? where appointment_id = ?");
        $stmt->execute(array($cancellation_reason, $appointment_id));  


        $stmt = $con->prepare("SELECT * FROM appointments where appointment_id = ?");
        $stmt->execute(array($appointment_id));
        $rows = $stmt->fetchAll();
        
        foreach($rows as $row){

           	$client_id = $row['client_id'];

	        $stmt = $con->prepare("SELECT * FROM clients where client_id = ?");
	        $stmt->execute(array($client_id));
	        $rows = $stmt->fetchAll();
        

	        foreach($rows as $row){

	           	$client_email = $row['client_email'];


           	    $mail = new PHPMailer();

		        $mail->isSMTP();
		        $mail->Host = "smtp.gmail.com";
		        $mail->SMTPAuth = true;
		        $mail->Username = "sorar384@gmail.com";
		        $mail->Password = 'ukjqeppzrfugeqgx';
		        $mail->Port = 587;
		        $mail->SMTPSecure = "tls";

		        $mail->isHTML(true);
		        $mail->setFrom('barbershop@email.com', 'Appointment Reservation');     
		        $mail->addAddress($client_email);
		        $mail->Subject = "Appointment Reservation";
		        $mail->Body    = '
		              <div style="text-align:center;font-size:24px;">
		              Good day!<br><br>
		             <div style="background-color:#c0db5c;width:500px;margin:auto;color:#000;font-size:24px;padding:20px 10px;">Your appointment have been cancelled</div></div>';
		        $mail->send();

            }
         }
	}
                             
	
?>