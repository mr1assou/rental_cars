<?php
    session_start();
    include '../includes/connect.php';
    include '../functions/functions.php';
    $user_id=$_GET['user_id'];
    $query="SELECT agency_entreprise_id FROM agency_entreprise WHERE leader=$user_id";
    $result=mysqli_query($connect,$query);
    $result=mysqli_fetch_assoc($result);
    $rentalAgencyId=$result['agency_entreprise_id'];
    $query="SELECT location FROM agency_location WHERE agency_entreprise_id=$rentalAgencyId";
    $result=mysqli_query($connect,$query);
    $array=array();
    while($row=mysqli_fetch_assoc($result)){
        $array[]=$row['location'];
    }
    $query="SELECT first_name,last_name,profile_image FROM users WHERE user_id=$user_id";
    $result=mysqli_query($connect,$query);
    $result=mysqli_fetch_assoc($result);
    $image=$result['profile_image'];
    $firstName=$result['first_name'];
    $lastName=$result['last_name'];
    if(isset($_POST['submit'])){
        echo "good";
        $brand=$_POST['brands'];
        $model=$_POST['model'];
        $kindOfVehicle=$_POST['kind'];
        $carRegistrationNumber=$_POST['car_registration_number'];
        $fuelType=$_POST['fuel_type'];
        $agencyLocation=$_POST['location'];
        $seatingSeat=$_POST['seating_seat'];
        $mileage=$_POST['mileage'];
        $year=$_POST['year'];
        $price=$_POST['price'];
        $numberOfHorses=$_POST['horses'];
        $query = "SELECT agence_location_id FROM agency_location WHERE agency_entreprise_id = $rentalAgencyId AND location = '$agencyLocation'";
        $result=mysqli_query($connect,$query);
        $row=mysqli_fetch_assoc($result);
        // ouarzazate 1 errachidia 2
        $agenceLocationId=$row['agence_location_id'];
        // push to databse
        $query = "INSERT INTO cars(model,brand,year,car_registration_number,fuel_type,seating_seat,mileage,price,number_of_horses,kind_of_vehicle,status,agence_location_id,is_deleted) VALUES('$model','$brand','$year','$carRegistrationNumber','$fuelType','$seatingSeat','$mileage','$price','$numberOfHorses','$kindOfVehicle','inactive','$agenceLocationId','false')";
        $result=mysqli_query($connect,$query);
        // images
        $image1=$_FILES['image1'];
        $image2=$_FILES['image2'];
        $image3=$_FILES['image3'];
        $image4=$_FILES['image4'];
        $image5=$_FILES['image5'];
        if(checkImageProfile($image1) && checkImageProfile($image2) && checkImageProfile($image3) && checkImageProfile($image4) && checkImageProfile($image5)){
            $query = "SELECT car_id FROM cars WHERE agence_location_id='$agenceLocationId' AND car_registration_number='$carRegistrationNumber'";
            $result=mysqli_query($connect,$query);
            $carId=mysqli_fetch_assoc($result);
            uploadToImagesFolder($image1,$carId['car_id'],$connect);
            uploadToImagesFolder($image2,$carId['car_id'],$connect);
            uploadToImagesFolder($image3,$carId['car_id'],$connect);
            uploadToImagesFolder($image4,$carId['car_id'],$connect);
            uploadToImagesFolder($image5,$carId['car_id'],$connect);
        }
    }

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
<body>
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
            <div class="text-white w-full  flex justify-center items-center mt-10">
                <form action="" method="post" class="bg-white p-5 rounded-md shadow-[-1px_-1px_5px_3px_#ffba6a] w-[70%]" enctype="multipart/form-data">
                    <p class="text-orange">Insert cars</p>
                    <div class="grid md:grid-cols-2 md:gap-6 mt-2 items-center justify-center">
                        <div class="w-full mb-5">
                        <label for="" class="text-gray-500 text-sm">Choose brand:</label>
                            <select class="mt-1 w-full bg-grey h-8 focus:outline-none  text-center text-orange brands" name="brands" required>
                            
                        
                            </select>
                        </div>
                        <div class="relative z-0 w-full mb-3 group">
                            <input type="text" name="model" id="model" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  required/>
                            <label for="model" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-white-600 peer-focus:dark:text-white-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Model</label>
                        </div>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6">
                      <div class="w-full mb-5">
                        <label for="" class="text-gray-500 text-sm">Kind of vehicle:</label>
                            <select class="w-full bg-grey h-8 focus:outline-none  text-center text-orange mt-1" name="kind" required>
                                <option value="Car" class="cursor-pointer hover:text-orange">Car</option>
                                <option value="Van" class="cursor-pointer hover:text-orange">Van</option>
                                <option value="Minibus" class="cursor-pointer hover:text-orange">Minibus</option>
                                <option value="Truck" class="cursor-pointer hover:text-orange">Truck</option>
                            </select>
                        </div>
                        <div class="relative z-0 w-full mt-3 group">
                            <input type="text" name="car_registration_number" id="car_registration_number" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  required/>
                            <label for="car_registration_number" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-white-600 peer-focus:dark:text-white-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Car registration number</label>
                        </div>
                    </div>
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="w-full mb-2">
                        <label for="" class="text-gray-500 text-sm ">Fuel type:</label>
                            <select class="w-full bg-grey h-8 focus:outline-none  text-center text-orange  mt-1" name="fuel_type" required>
                                <option value="Gasoline" class="cursor-pointer text-orange">Gasoline</option>
                                <option value="Diesel" class="cursor-pointer text-orange">Diesel</option>
                                <option value="Electricity" class="cursor-pointer text-orange">Electricity</option>
                                <option value="Hybrid" class="cursor-pointer text-orange">Hybrid</option>
                            </select>
                        </div>
                    <div class="w-full mb-2">
                        <label for="" class="text-gray-500 text-sm">Agency location:</label>
                            <select class="w-full bg-grey h-8 focus:outline-none  text-center text-orange mt-1" name="location" required>
                                <?php 
                                    foreach($array as $city){
                                        echo '<option value="'.$city.'" class="cursor-pointer hover:text-orange">'.$city.'</option>';
                                    }                       
                                ?>
                            </select>
                        </div>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6 mt-3">
                    <div class="relative z-0 w-full mb-3 group">
                        <input type="number"  name="seating_seat" id="seating_seat" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  required/>
                        <label for="seating_seat" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-white-600 peer-focus:dark:text-white-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Seating seat</label>
                    </div>
                    <div class="relative z-0 w-full mb-3 group">
                        <input type="number" name="mileage" id="milieage" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                        <label for="milieage" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-white-600 peer-focus:dark:text-white-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Mileage (Km)</label>
                    </div>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="number"  name="price" id="price" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                        <label for="price" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-white-600 peer-focus:dark:text-white-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Price per day</label>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="number" name="horses" id="horses" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  required/>
                        <label for="horses" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-white-600 peer-focus:dark:text-white-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">number of Horses</label>
                    </div>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6">
                     <div class="relative z-0 w-full mt-4 group">
                        <input type="number" name="year" id="year" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                        <label for="year" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-white-600 peer-focus:dark:text-white-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Year</label>
                    </div>
                    <div class="relative z-0 w-full mt-2 group">
                            <input type="file" name="image1" id="image1" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer mt-1" required/>
                            <label for="image1" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">image 1</label>
                    </div>
                     
                </div>
                <div class="grid md:grid-cols-2 md:gap-6">
                        <div class="relative z-0 w-full mt-3 group">
                            <input type="file" name="image2" id="image2" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer mt-1" required/>
                            <label for="image2" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">image 2</label>
                    </div>
                    <div class="relative z-0 w-full mt-3 group">
                            <input type="file" name="image3" id="image3" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer mt-1" required/>
                            <label for="image3" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">image 3</label>
                    </div>
                      
                    </div>
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 w-full mt-3 group">
                            <input type="file" name="image4" id="image4" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer mt-1" required/>
                            <label for="image4" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">image 4</label>
                    </div>
                    <div class="relative z-0 w-full mt-3 group">
                            <input type="file" name="image5" id="image5" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer mt-1" required/>
                            <label for="image5" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">image 5</label>
                    </div>
                    </div>
                    <div class="flex justify-end">
                        <input type="submit" name="submit" value="add car" class="mt-5 rounded-md text-white bg-orange px-3 py-2  cursor-pointer  block">
                    </div>
                </form>
            </div>
            <!-- end second part -->
                        </div>                    
                    </div>
            </div>
        </div>
        <!-- jaavscript -->
        <script src="../add_car.js"></script>
</body>
</html>


 