<?php
    session_start();
    include '../includes/connect.php';
    include '../functions/functions.php';
    $user_id=$_GET['user_id'];
    $rentalOperationId=$_GET['rental_operations_id'];
    $carId=$_GET['car_id'];
    $query="UPDATE rental_operations SET status_operation_rental = 'confirm' WHERE rental_operations_id='$rentalOperationId';";   
    $result=mysqli_query($connect,$query);
    $query="UPDATE rental_operations SET confirmation_date = Now() WHERE rental_operations_id='$rentalOperationId';";
    $result=mysqli_query($connect,$query);
    // $query="UPDATE cars SET status = 'actif' WHERE car_id='$carId ';";
    // $result=mysqli_query($connect,$query);
    header('Location: ./dashboard.php?user_id=' . $user_id);
?>