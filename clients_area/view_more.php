 <?php 
    session_start();
    include '../includes/connect.php';
    include '../functions/functions.php';
    if(isset($_GET['user_id'])){
        $user_id=$_GET['user_id'];
    }
    $car_id=$_GET['car_id'];
    $query="SELECT agence_location_id FROM cars WHERE car_id=$car_id";
    $result=mysqli_query($connect,$query);
    $result=mysqli_fetch_assoc($result);
    $AgencyLocationId=$result['agence_location_id'];
    $query="SELECT location,agency_entreprise_id FROM agency_location WHERE agence_location_id='$AgencyLocationId'";
    $result=mysqli_query($connect,$query);
    $result=mysqli_fetch_assoc($result);
    // 
    $city=$result['location'];
    $entrepriseId=$result['agency_entreprise_id'];
    $query="SELECT agency_entreprise_name FROM agency_entreprise WHERE agency_entreprise_id='$entrepriseId'";
    $result=mysqli_query($connect,$query);
    $result=mysqli_fetch_assoc($result);
    // 
    $entrepriseName=$result['agency_entreprise_name'];
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
    <link rel="stylesheet" href="../output.css">
    <link rel="stylesheet" href="../style.css">
    <title>view more client</title>
    <!-- cdn font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- landing page -->
    <section class="w-full h-screen bg-cover bg-center bg-fixed bg-no-repeat">
        <?php
            include '../includes/header.php';
        ?>
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
                    <div class="basis-[30%] bg-white p-5 shadow-[rgba(50,50,93,0.25)_0px_6px_12px_-2px,_rgba(0,0,0,0.3)_0px_3px_7px_-3px]">
                 <p class="text-center"><span class="text-2xl font-black text-orange"><?php echo $row['brand'] ?></span> <span class="text-2xl font-black text-orange"><?php echo $row['model'] ?></span> <span class="text-1xl font-bold text-blue"><?php echo $row['year'] ?></span></p>
                <p class="mt-2"></p>
                <div class="flex items-center border-b-2 w-full mt-4">
                    <p class="text-black font-bold basis-1/2 text-right">City</p>
                    <p class="text-blue basis-1/2 text-center"><?php echo $city;?></p>
                </div>
                <div class="flex items-center border-b-2 w-full mt-4">
                    <p class="text-black font-bold basis-1/2 text-right">Agency</p>
                    <p class="text-blue basis-1/2 text-center"><?php echo $entrepriseName;?></p>
                </div>
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
                    <p class="text-black  basis-1/2 text-right font-black text-2xl">Price Per Day</p>
                    <p class="text-blue basis-1/2 text-center font-black text-2xl"><?php echo $row['price'];?>$</p>
                </div>
                <div class="w-full text-center">
                <?php
                    echo '<a href="./rent.php?car_id='.$car_id.'&user_id='.$user_id.'&entreprise_name='.$entrepriseName.'&entreprise_id='.$entrepriseId.'" class="mt-2 inline-block bg-orange text-white p-2 text-sm transition duration-300 ease-in-out hover:scale-110 w-[70%] ">rent now</a>';
                    ?>
                </div>
                    </div>
                </div>
        
       </section>
      <!-- javascript -->
      <script src="../view_more.js"></script>
</body>
</html>