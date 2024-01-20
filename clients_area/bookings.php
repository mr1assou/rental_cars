 <?php 
    session_start();
    include '../includes/connect.php';
    include '../functions/functions.php';
    // let's display cars according to locations
    $user_id=$_GET['user_id'];  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../output.css">
    <link rel="stylesheet" href="../style.css">
    <title>bookings</title>
    <!-- cdn font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- landing page -->
        <!-- <img src="../videos/banner.jpg" alt="" class="w-full h-screen"> -->

        <?php
            include '../includes/header.php';
        ?>
        <section class="py-4 px-4">
            <?php
                $query="SELECT * FROM rental_operations WHERE user_id=$user_id AND status_operation_rental='pending' ORDER BY rental_operations_id DESC";
                $result=mysqli_query($connect,$query);
                $row=mysqli_num_rows($result);
                if($row){
                    while($line=mysqli_fetch_assoc($result)){
                        if($line['status_operation_rental']=='pending'){
                            displayBookings($connect,$line,$user_id);
                        }
                    }
                }
                else{
                    echo '<div class="text-blue text-center text-5xl font-black mt-5"> no bookings in your account</div>';
                }
            ?>
        </section>
      <!-- javascript -->
      <script src="../booking.js"></script>
      
</body>
</html>