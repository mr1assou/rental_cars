<?php
    include '../includes/connect.php';
    $user_id=$_GET['user_id'];
    $carId=$_GET['car_id'];
    $rentalAgencyId=$_GET['rental_agency_id'];
    $queryDeleteCar = "UPDATE cars SET is_deleted='true' WHERE car_id =$carId;";
    $resultDeleteCar=mysqli_query($connect,$queryDeleteCar);
    header('Location:./cars.php?user_id='.$user_id.'&car_id='.$carId.'&rental_agency_id='.$rentalAgencyId.'');
?>