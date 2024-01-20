 <?php 
    session_start();
    include '../includes/connect.php';
    include '../functions/functions.php';
    // let's display cars according to locations
    $user_id=$_GET['user_id']; 
    $count=0;
    if(isset($_GET['location'])){
        $city=$_GET['location'];
        $count++;
    }
    $pick=$_GET['pick_up_date'];
    $return=$_GET['return_date'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../output.css">
    <link rel="stylesheet" href="../style.css">
    <title>home page</title>
    <!-- cdn font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- landing page -->
        <!-- <img src="../videos/banner.jpg" alt="" class="w-full h-screen"> -->
        <?php
            include '../includes/header.php';
        ?>
        <div class="flex w-full min-h-screen bg-white gap-1 px-2 relative">
    <!-- sidebar -->
        <div class="w-[20%] bg-black h-full fixed  top-0 mt-20 opacity-70 -z-50 "> 
                 <div class="py-2 w-full px-2 ">
                    <a href="./cars.php?location=<?php echo $_GET['location'];?>&user_id=<?php echo $user_id;?>&pick_up_date=<?php echo $pick;?>&return_date=<?php echo $return;?>" class="mt-2 inline-block w-full bg-orange text-white p-2 text-sm transition duration-300 ease-in-out hover:bg-white hover:text-orange text-center cursor-pointer">See All Vehicles</a>       
                </div>
            <form method="post" action="">
                <div class="py-2 w-full px-2 mt-1">
                        <label for="countries" class="block mb-2 text-orange text-sm font-medium  dark:text-white">Select brand:</label> 
                        <select id="countries" name="brand" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full py-2 px-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 brand">
                            <option>Choose Brand</option>
                            <?php
                                $queryBrands="SELECT DISTINCT brand FROM cars";
                                $resultQueryBrands=mysqli_query($connect,$queryBrands);
                                while($line=mysqli_fetch_assoc($resultQueryBrands)){
                                    echo '<option value="'.$line['brand'].'" >'.$line['brand'].'</option>';
                                }
                            ?>
                        </select>
                </div>
                <div class="py-2 w-full px-2 ">
                       
                </div>
                <div class="py-2 w-full px-2 ">
                        <label for="countries" class="block mb-2 text-orange text-sm font-medium  dark:text-white">Kind of vehicle:</label> 
                        <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full py-2 px-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 kind_of_vehicle" name="kind_of_vehicle">
                            <option>kind of Vehicle</option>
                            <?php
                                $queryKindOfvehicle="SELECT DISTINCT kind_of_vehicle FROM cars";
                                $resultQueryVehicle=mysqli_query($connect,$queryKindOfvehicle);
                                while($line=mysqli_fetch_assoc($resultQueryVehicle)){
                                    echo '<option value="'.$line['kind_of_vehicle'].'">'.$line['kind_of_vehicle'].'</option>';
                                }
                            ?>
                        </select>
                </div>
                <div class="py-2 w-full px-2 flex">
                        <div class="mb-4">
                            <label for="minPrice" class="block text-orange">Min Price:</label>
                                <input type="number" id="minPrice" name="min-price" class="w-[70%] border rounded-md py-2 px-3 min_price" placeholder="Enter Min Price" required value="0" class="min_price">
                            </div>
                            <div class="mb-4">
                                <label for="maxPrice" class="block text-orange">Max Price:</label>
                                <input type="number" id="maxPrice" name="max-price" class="w-[70%] border rounded-md py-2 px-3 max_price" placeholder="Enter Max Price" required value="0">
                            </div>
                </div>
                </form>
            </div>
    <!-- content -->
            <div class="w-[80%]  h-[100%] flex flex-wrap justify-evenly " style="margin-left: 270px;">
                <?php
                    if($count==1){
                        displayCarsAndCities($connect,$city,$user_id);
                    }
                    if($count==0){
                        displayCarsForGuest($connect);
                    }
                ?>
            </div>
        </div>
     
      <!-- javascript -->
      <script src="../vehicle.js"></script>
</body>
</html>