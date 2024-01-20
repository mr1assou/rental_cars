 <?php 
    session_start();
    include '../includes/connect.php';
    include '../functions/functions.php';
    $user_id=$_GET['user_id'];
    $rentalOperationId=$_GET['rental_operations_id'];
    $query="DELETE FROM rental_operations WHERE rental_operations_id='$rentalOperationId'";
    $result=mysqli_query($connect,$query);
    header('Location: ./bookings.php?user_id=' . $user_id);
    exit(); 
?>
