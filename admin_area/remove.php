<?php
    session_start();
    include '../includes/connect.php';
    include '../functions/functions.php';
    $user_id=$_GET['user_id'];
    $rentalOperationId=$_GET['rental_operations_id'];
    $query="UPDATE rental_operations SET status_operation_rental = 'expired' WHERE rental_operations_id='$rentalOperationId';";   
    $resul=mysqli_query($connect,$query);
    header('Location: ./dashboard.php?user_id=' . $user_id);
?>