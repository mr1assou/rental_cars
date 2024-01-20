<?php
    session_start();
    include '../includes/connect.php';
    include '../functions/functions.php';
    if(isset($_GET['user_id'])){
        $user_id=$_GET['user_id'];
    }
    $query="SELECT agency_entreprise_id FROM agency_entreprise WHERE leader=$user_id";
    $result=mysqli_query($connect,$query);
    $result=mysqli_fetch_assoc($result);
    $rentalAgencyId=$result['agency_entreprise_id'];
    $query="SELECT first_name,last_name,profile_image FROM users WHERE user_id=$user_id";
    $result=mysqli_query($connect,$query);
    $result=mysqli_fetch_assoc($result);
    $image=$result['profile_image'];
    $firstName=$result['first_name'];
    $lastName=$result['last_name'];
    // barrier
    $query="SELECT * FROM rental_operations WHERE agency_entreprise_id='$rentalAgencyId' AND status_operation_rental='pending' ORDER BY rental_operations_id DESC";
    $result=mysqli_query($connect,$query);
    $row=mysqli_num_rows($result);
    // select all cars deleted
    $queryLocation= "SELECT agence_location_id FROM agency_location WHERE agency_entreprise_id=$rentalAgencyId ORDER BY agence_location_id DESC";
    $resultLocation=mysqli_query($connect,$queryLocation);
    $locationsId=array();
    while($locations=mysqli_fetch_assoc($resultLocation)){
        $locationsId[]=$locations['agence_location_id'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard admin</title>
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
            <div class="bg-white text-right py-2 px-3 rounded-xl sticky top-0 right-0 z-50 w-full">
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
            <!-- first 2 -->
            <?php
                foreach($locationsId as $id){
                    $query="SELECT location FROM agency_location WHERE agence_location_id=$id";
                    $result=mysqli_query($connect,$query);
                    $location=mysqli_fetch_assoc($result)['location'];
                    $queryCarsDeleted="SELECT * FROM cars WHERE agence_location_id=$id AND is_deleted='true' ORDER BY car_id DESC";
                    $resultCarsDeleted=mysqli_query($connect,$queryCarsDeleted);
                    while($resultCar=mysqli_fetch_assoc($resultCarsDeleted)){
                        $carId=$resultCar['car_id'];
                        $queryImage="SELECT image_name FROM images WHERE car_id=$carId";
                        $resultImage=mysqli_query($connect,$queryImage);
                        $image=mysqli_fetch_assoc($resultImage);
                        echo '<div class="flex w-full items-center mt-5 justify-evenly shadow-[rgba(50,50,93,0.25)_0px_6px_12px_-2px,_rgba(0,0,0,0.3)_0px_3px_7px_-3px] parent bg-white rounded-xl">
                <div class="basis-[30%]  bg-white h-64 rounded-xl p-3">
                    <img src="../images/'.$image['image_name'].'" alt="'.$image['image_name'].'" class="w-full h-24 rounded-xl object-cover" style="height:100%;width:100%;">
                </div>
                <div class="basis-[70%]">
                    <p class="text-black"><span>'.$resultCar['brand'].'</span><span class="ml-2">'.$resultCar['model'].'</span><span class="ml-2">'.$resultCar['year'].'</span></p>
                    <div class="flex w-full items-center mt-3 flex-wrap">                    
                        <div class="mx-2 flex items-center"><i class="fa-solid fa-user text-orange"></i><span class="mx-2 text-blue">'.$resultCar['seating_seat'].'</span></div>
                        <div class="mx-2 flex items-center"><i class="fa-solid fa-route text-orange"></i><span class="mx-2 text-blue ">'.$resultCar['mileage'].'</span></div>
                        <div class="mx-2 flex items-center"><i class="fa-solid fa-car text-orange"></i><span class="text-sm mx-2 text-blue">'.$resultCar['kind_of_vehicle'].'</span></div>
                    </div>
                    <div class="flex mt-5 flex-wrap">
                        <div class="ml-2 basis-[25%]" style="margin-left:10px;">
                            <p class="text-orange text-xl font-bold" style="font-size:13px;">fuel type:</p>
                            <p class="text-sm reservation-date text-black">'.$resultCar['fuel_type'].'</p>
                        </div>
                        <div class="ml-2 basis-[25%]" style="margin-left:10px;">
                            <p class="text-orange text-xl font-bold" style="font-size:13px;">Location:</p>
                            <p class="text-sm reservation-date text-black">'.$location.'</p>
                        </div>
                        <div class="ml-2 basis-[25%]" style="margin-left:10px;">
                            <p class="text-orange text-xl font-bold" style="font-size:13px;">Registration Number:</p>
                            <p class="text-sm reservation-date text-black">'.$resultCar['car_registration_number'].'</p>
                        </div>
                        <div class="ml-2 basis-[25%]" style="margin-left:10px;">
                            <p class="text-orange text-xl font-bold" style="font-size:13px;">Number of horses:</p>
                            <p class="text-sm reservation-date text-black">'.$resultCar['number_of_horses'].'</p>
                        </div>
                    </div>
                </div>
                <div class="basis-[20%] flex flex-col items-center justify-between font-black text-blue" style="height:100%;">
                    <p class="bg-green text-2xl">Price:<span>'.$resultCar['price'].'</span>$</p>
                </div>
            </div>';
                    }
                }
            ?>
            </div>
        </div>
        <!-- javascript -->
        <script src="../dashboard.js"></script>
</body>
</html>


 