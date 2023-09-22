<?php 
    include 'connect.php';
  
    $stmt = $con->prepare("SELECT * FROM appointments where appointment_id = ?");
    $stmt->execute(array($_POST['appointment_id']));
    $rows = $stmt->fetchAll();

     foreach($rows as $row){ ?>
<img src="../images/<?php echo $row['proof'] ?>" width="100%">
     <?php }

?>