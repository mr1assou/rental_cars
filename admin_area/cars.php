<?php
    session_start();
    include '../includes/connect.php';
    include '../functions/functions.php';
    $user_id=$_GET['user_id'];
    $rentalAgencyId=$_GET['rental_agency_id'];
    $query="SELECT location,agence_location_id,adress FROM agency_location WHERE agency_entreprise_id=$rentalAgencyId";
    $result=mysqli_query($connect,$query);
    $idLocation=array();
    $locations=array();
    $adresses=array();
    while($row=mysqli_fetch_assoc($result)){
        $idLocation[]=$row['agence_location_id'];
        $locations[]=$row['location'];
        $adresses[]=$row['adress'];
    }
    $query="SELECT first_name,last_name,profile_image FROM users WHERE user_id=$user_id";
    $result=mysqli_query($connect,$query);
    $result=mysqli_fetch_assoc($result);
    $image=$result['profile_image'];
    $firstName=$result['first_name'];
    $lastName=$result['last_name'];
    $rentalAgencyId=$_GET['rental_agency_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert cars</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../output.css">
     <!-- cdn font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body class="text-white">
    <div class="flex w-full min-h-screen bg-black gap-2 p-2 relative">
    <!-- sidebar -->
        <div class="basis-[15%] bg-black h-[100%] pt-2 rounded-xl sticky top-0 left-0 bottom-0">
            <div class="flex flex-col items-center">
                <img src="../images/logo.png" alt="logo" width="80px">
                <p class="italic text-orange font-bold">Rentaly</p>
            </div>
            <a href="<?php echo './dashboard.php?user_id='.$user_id.''?>" class="block mt-5">
                    <div class="flex items-center w-full justify-center text-orange">
                        <i class="fa-solid fa-table block mr-2"></i>
                        <p class="font-bold transition duration-300 hover:scale-110 hover:bg-orange rounded-xl px-2 hover:text-white">Dashboard</p>
                    </div>
            </a>
            <div class="flex flex-col items-center my-20 w-full justify-center px-2">
                 <a href="./historical_data.php?user_id=<?php echo $user_id;?>&month=<?php $currentMonth=date('n');echo $currentMonth;?>&year=<?php $currentYear=date('Y'); echo $currentYear;?>" class="block mt-5 w-full  text-white text-center font-medium text-md transition duration-300 hover:scale-110 hover:bg-white hover:text-black rounded-xl">Historical Data</a>
                <a href="<?php echo './cars.php?user_id='.$user_id.'&rental_agency_id='.$rentalAgencyId.' '?>" class="block mt-5 w-full text-white text-center font-medium text-md transition duration-300 hover:scale-110 hover:bg-white hover:text-black rounded-xl">Your vehicles</a>
                <a href="<?php echo './add_cars.php?user_id='.$user_id.''?>" class="block mt-5 w-full text-white text-center font-medium text-md transition duration-300 hover:scale-110 hover:bg-white hover:text-black rounded-xl">Add Vehicle</a>
                <a href="<?php echo './deleted-vehicles.php?user_id='.$user_id.'&rental_agency='.$rentalAgencyId.''?>" class="block mt-5 w-full text-white text-center font-medium text-md transition duration-300 hover:scale-110 hover:bg-white hover:text-black rounded-xl">deleted vehicles</a>
            </div>
            <div class="flex flex-col items-center mt-20 w-full justify-center mb-2">
                <a href="#" class="block mt-4 w-full text-white text-center font-medium text-md transition duration-300 hover:scale-110 hover:bg-white hover:text-black rounded-xl"><i class="fa-solid fa-gear mr-2"></i>settings</a>
                <a href="../others/logout.php" class="block mt-4 w-full text-white text-center font-medium text-md transition duration-300 hover:scale-110 hover:bg-white hover:text-black rounded-xl"><i class="fa-solid fa-arrow-right-from-bracket mr-2"></i>Log out</a>
            </div>
        </div>
    <!-- content -->
        <div class="basis-[85%]">
            <!-- first part -->
                <div class="bg-white text-right py-2 px-3 rounded-xl sticky top-0 right-0 z-50 ">
                <div class="flex justify-between items-center">
                     <h1 class="text-orange text-xl font-black">Dashboard Overview</h1>
                    <div class="flex items-center justify-between w-[30%]">
                        <?php
                            echo'<h1 class=" basis-[80%] mr-2 text-blue font-black">Welcome '.ucwords($firstName).' '.ucwords($lastName).'</h1>';
                        ?>
                        <div class="bg-grey basis-[20%] rounded-full p-1" style="height:70px;">
                            <img src="<?php echo '../images_profile/' . $image; ?>" alt="" class="filter brightness-100 rounded-full object-cover h-full" width="100%" height="100%">
                        </div>

                    </div>
                </div>
            </div>
            <!-- second part -->
            <div class="w-full bg-white mt-10 rounded-xl">
                <div class="p-3">
                    <?php
                    $count=0;
                        foreach($idLocation as $id){
                            echo '<div class="flex items-center gap-2"><p class="text-blue font-black ml-10 text-2xl">'.$locations[$count].'</p><p class="text-orange font-bold ml-5 text-sm mt-1">'.$adresses[$count].'</p></div>';
                            $query = "SELECT car_id FROM cars WHERE agence_location_id='$id' ORDER BY car_id DESC";
                            $result=mysqli_query($connect,$query);
                            echo '<div class="flex flex-wrap  justify-evenly w-full overflow-hidden gap-1 mt-4">';
                            while($row=mysqli_fetch_assoc($result)){
                                displayCars($connect,$row['car_id'],$user_id,$rentalAgencyId);
                            }
                            echo '</div>';
                            $count++;
                        }
                    ?>
                  </div>
            </div>  
            <!-- end second part -->
                </div>                    
            </div>
        <!-- jaavscript -->
        <script src="../add_car.js"></script>
</body>
</html>


 