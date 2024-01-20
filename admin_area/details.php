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

    $clientId=$_GET['client'];
    $query="SELECT first_name,last_name,profile_image,email,phone_number FROM users WHERE user_id=$clientId";
    $result=mysqli_query($connect,$query);
    $value=mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details operation</title>
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
                            <div class="bg-grey basis-[20%] rounded-full p-1" style="height:70px;">
                            <img src="<?php echo '../images_profile/' . $image; ?>" alt="" class="filter brightness-100 rounded-full object-cover h-full" width="100%" height="100%">
                        </div>
                        </div>
                    </div>
                </div>
            <!-- second part -->
                    <div class="w-full p-5 bg-white mt-5 rounded-xl text-black">
                        <div class="flex  w-full">
                            <!-- part1 -->
                            <div class=" flex flex-col items-center" style="flex-basis:30%;">
                            <div  style="height:12rem;width:60%" class="bg-orange p-1 rounded-full">
                                <img src="<?php echo $value['profile_image']?>" style="width:100%;height:100%;" class="block object-cover rounded-full">
                            </div>    
                                
                            </div>
                            <!-- part 2 -->
                            <div style="flex-basis:70%;" class="text-sm items-center ">
                                <p class="text-xl text-orange">Client informations:</p>
                                <div class=" flex mt-3 ">
                                    <div style="flex-basis:55%;" class="flex items-center">
                                        <p style="font-size:12px " class="text-blue font-black">First Name:</p>
                                        <p class="ml-2" style="font-size:12px;"><?php echo $value['first_name']?></p>
                                    </div>
                                    <div style="flex-basis:45%;" class="ml-2 flex items-center">
                                        <p style="font-size:12px " class="text-blue font-black">Last Name:</p>
                                        <p class="ml-1" style="font-size:12px;"><?php echo $value['last_name']?></p>
                                    </div>
                                </div>        
                                <div class=" flex mt-3 ">
                                    <div style="flex-basis:55%;" class="flex items-center">
                                        <p style="font-size:12px " class="text-blue font-black">email:</p>
                                        <p class="ml-1" style="font-size:12px;"><?php echo $value['email']?></p>
                                    </div>
                                    <div style="flex-basis:45%;" class="ml-2 flex items-center">
                                        <p style="font-size:12px " class="text-blue font-black">Phone number:</p>
                                        <p class="ml-2" style="font-size:12px;"><?php echo $value['phone_number']?></p>
                                    </div>
                                </div>        
                                <div class=" flex mt-3 ">
                                    <div style="flex-basis:55%;" class="flex items-center mt-3">
                                        <p  class="text-blue font-black text-xl">user rental History:</p>
                                    </div>
                                </div>
                                       <?php
                                        $client=$_GET['client'];
                                        $admin=$user_id;
                                        $query="SELECT start_date,end_date,global_price,reservation_date,car_id,confirmation_date,status_operation_rental FROM rental_operations  WHERE (status_operation_rental='confirm' OR status_operation_rental='expired') AND user_id='$client' AND agency_entreprise_id='$rentalAgencyId' ORDER BY rental_operations_id DESC";
                                        $result=mysqli_query($connect,$query);
                                        $rows=mysqli_num_rows($result);
                                        if($rows==0){
                                            echo '<div class="mt-4 text-xl font-black text-orange">there is no bookings from this user before</div>';
                                        }
                                        else{
                                            echo '<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 overflow-hidden mt-3">
                                                <thead class="text-xs text-orange uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            <tr>
                                                
                                                <th class="px-1 py-2 text-sm " >
                                                    <p class="text-sm ">pick Up date</p> 
                                                </th>
                                                <th class="px-1 py-2 text-sm ">
                                                    <p class="text-sm ">end date</p> 
                                                </th>
                                                <th class="px-1 py-2 text-sm ">
                                                    <p class="text-sm ">confirmation date</p> 
                                                </th>
                                               
                                                <th class="px-1 py-2 text-sm ">
                                                    <p class="text-sm ">Brand</p> 
                                                </th>
                                                <th class="px-1 py-2 text-sm " >
                                                    <p class="text-sm ">model</p> 
                                                </th>
                                                <th class="px-1 py-2 text-sm " >
                                                    <p class="text-sm ">location</p> 
                                                </th>
                                                <th class="px-1 py-2 text-sm " >
                                                    <p class="text-sm ">status</p> 
                                                </th>  
                                            </tr>
                                            </thead>';
                                            while($line=mysqli_fetch_assoc($result)){
                                                $car_id=$line['car_id'];
                                                $query2="SELECT brand,model,agence_location_id FROM cars WHERE car_id=$car_id";
                                                $result2=mysqli_query($connect,$query2);
                                                $row2=mysqli_fetch_assoc($result2);
                                                $query3="SELECT location FROM agency_location WHERE agence_location_id=$row2[agence_location_id];";
                                                $result3=mysqli_query($connect,$query3);
                                                $row3=mysqli_fetch_assoc($result3);
                                                $location=$row3['location'];
                                                echo '<tr>
                                                    <td class="px-1 py-2 text-sm "  style="width:1%;font-size:10px;">
                                                        <p class=" text-blue reservation-date w-full" style="width:100%;font-size:10px;">'.$line['start_date'].'</p> 
                                                    </td>
                                                    <td class="px-1 py-2 "  style="width:1%;">
                                                        <p class=" text-blue start-date w-full" style="width:100%;font-size:10px;">'.$line['end_date'].'</p> 
                                                    </td>
                                                    <td class="px-1 py-2 "  style="width:1%;">
                                                        <p class=" text-blue start-date w-full" style="width:100%;font-size:10px;">'.$line['confirmation_date'].'</p> 
                                                    </td>
                                                    <td class="px-1 py-2"  style="width:1%">
                                                        <p class=" text-blue w-full" style="width:100%;font-size:10px;">'.$row2['brand'].'</p> 
                                                    </td>
                                                    <td class=" py-2 "  style="width:1%;">
                                                        <p class=" text-blue start-date w-full" style="width:100%;font-size:10px;">'.$row2['model'].'</p> 
                                                    </td>
                                                    <td class="px-1 py-2"  style="width:1%">
                                                        <p class=" text-blue w-full" style="width:100%;font-size:10px;">'.$location.'</p> 
                                                    </td>
                                                    <td class="px-1 py-2 text-sm "  style="width:1%;font-size:10px;">
                                                        <p class=" text-blue reservation-date w-full" style="width:100%;font-size:10px;">'.$line['status_operation_rental'].'</p> 
                                                    </td></tr>';
                                            }
                                            echo '</table>';
                                        }
                                    ?> 
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- javascript -->
        <script ></script>
</body>
</html>


 