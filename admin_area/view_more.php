<?php
    session_start();
    include '../includes/connect.php';
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
    $car_id=$_GET['car_id'];
    $query="SELECT model,brand,year,car_registration_number,fuel_type,seating_seat,mileage,price,number_of_horses,kind_of_vehicle FROM cars WHERE car_id=$car_id";
    $result=mysqli_query($connect,$query);
    $row=mysqli_fetch_assoc($result);
    $query2="SELECT image_name FROM images WHERE car_id=$car_id";
    $result2=mysqli_query($connect,$query2);
    $row2=mysqli_fetch_assoc($result2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>view more</title>
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
        <div class="basis-[85%]  h-[100%]">
            <!-- first part -->
            <div class="bg-white text-right py-2 px-3 rounded-xl">
                <div class="flex justify-between items-center">
                     <h1 class="text-orange text-xl font-black">Dashboard Overview</h1>
                    <div class="flex items-center justify-between w-[30%]">
                        <?php
                            echo'<h1 class=" basis-[80%] mr-2 text-blue font-black">Welcome '.ucwords($firstName).' '.ucwords($lastName).'</h1>';
                        ?>
                        <div class="bg-grey basis-[20%] rounded-full p-1" style="min-height:70px;">
                            <img src="<?php echo '../images_profile/' . $image; ?>" alt="" class="filter brightness-100 rounded-full object-cover h-full" width="100%" height="100%">
                        </div>

                    </div>
                </div>
            </div>
            <!-- second part -->
                <div class="flex justify-between  py-7 px-10 mt-3 relative">
                    <div class="basis-[70%]">
                        <div class="basis-[70%] rounded-xl">
                        <div class="w-full  rounded-xl" style="height:400px">
                            <img src="<?php echo $row2['image_name'];?>" alt="" class="h-full w-full object-cover rounded-xl parent_image">
                        </div>
                        <div class="w-full mt-2 flex justify-between items-center gap-2" style="height:145px">
                            <div class="h-full basis-[20%] cursor-pointer rounded-xl images">
                        <img src="<?php echo $row2['image_name'];?>" alt="" class="h-full w-full object-cover rounded-xl filter brightness-50 hover:brightness-125">
                    </div>
                    <?php
                        while($row2=mysqli_fetch_assoc($result2)){
                            echo '<div class="h-full basis-[20%] cursor-pointer rounded-xl images">
                        <img src="'.$row2["image_name"].'" alt="" class="h-full w-full object-cover rounded-xl filter brightness-50 hover:brightness-125">
                    </div>';
                        }
                    ?>
                    </div>
                    </div>
                    </div>
                    <!-- calendar -->
                    <div class="basis-[30%] bg-white p-5 shadow-[rgba(50,50,93,0.25)_0px_6px_12px_-2px,_rgba(0,0,0,0.3)_0px_3px_7px_-3px]">
                 <p class="text-center"><span class="text-2xl font-black text-orange"><?php echo $row['brand'] ?></span> <span class="text-2xl font-black text-orange"><?php echo $row['model'] ?></span> <span class="text-1xl font-bold text-blue"><?php echo $row['year'] ?></span></p>
                <p class="mt-2"></p>
                <div class="flex items-center border-b-2 w-full mt-4">
                    <p class="text-black font-bold basis-1/2 text-right">model</p>
                    <p class="text-blue basis-1/2 text-center"><?php echo $row['model'];?></p>
                </div>
                <div class="flex items-center border-b-2 w-full mt-4">
                    <p class="text-black font-bold basis-1/2 text-right">brand</p>
                    <p class="text-blue basis-1/2 text-center"><?php echo $row['brand'];?></p>
                </div>
                <div class="flex items-center border-b-2 w-full mt-4">
                    <p class="text-black font-bold basis-1/2 text-right">year</p>
                    <p class="text-blue basis-1/2 text-center"><?php echo $row['year'];?></p>
                </div>
                <div class="flex items-center border-b-2 w-full mt-4">
                    <p class="text-black font-bold basis-1/2 text-right">registration number</p>
                    <p class="text-blue basis-1/2 text-center"><?php echo $row['car_registration_number'];?></p>
                </div>
                <div class="flex items-center border-b-2 w-full mt-4">
                    <p class="text-black font-bold basis-1/2 text-right">fuel type</p>
                    <p class="text-blue basis-1/2 text-center"><?php echo $row['fuel_type'];?></p>
                </div>
                <div class="flex items-center border-b-2 w-full mt-4">
                    <p class="text-black font-bold basis-1/2 text-right">kind of vehicle</p>
                    <p class="text-blue basis-1/2 text-center"><?php echo $row['kind_of_vehicle'];?></p>
                </div>
                <div class="flex items-center border-b-2 w-full mt-4">
                    <p class="text-black font-bold basis-1/2 text-right">number of horses</p>
                    <p class="text-blue basis-1/2 text-center"><?php echo $row['number_of_horses'];?></p>
                </div>
                <div class="flex items-center border-b-2 w-full mt-4">
                    <p class="text-black  basis-1/2 text-right font-black text-2xl">Price</p>
                    <p class="text-blue basis-1/2 text-center font-black text-2xl"><?php echo $row['price'];?>$</p>
                </div>
            </div>
                </div>
                </div>
            </div>
        </div>
        <!-- javascript -->
        <script src="../view_more.js"></script>
</body>
</html>


 