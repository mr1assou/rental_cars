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
    // logic of historical data
    $month=$_GET['month'];
    $year=$_GET['year'];
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
            <div class="w-full py-2 px-3 bg-white rounded-xl mt-4">
                <div class="flex justify-end mr-2">
                        <select id="countryDropdown" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2 ">
                            <option selected disabled>Choose a date</option>
                            <!-- <option value="US" data-link="./dashboard.php?user_id=<?php echo $user_id; ?>">United States</option> -->
                            <?php
                                $query="SELECT DISTINCT YEAR(confirmation_date) AS year, MONTH(confirmation_date) AS month FROM rental_operations WHERE status_operation_rental='confirm';";
                                $result=mysqli_query($connect,$query);
                                $numberOfRows=mysqli_num_rows($result);
                                if($numberOfRows>0){
                                    $line=mysqli_fetch_assoc($result);
                                    if($result){
                                        echo '<option  data-link="./historical_data.php?user_id='.$user_id.'&year='.$line['year'].'&month='.$line['month'].'">'.$line['year'].'-'.$line['month'].'</option>';
                                    }
                                    else{
                                        echo "<option>not good</option>";
                                    }
                                }
                            ?>
                        </select>
                </div>
                <div>
                    <div class="w-full  flex items-center justify-between px-2 py-7 bg-white rounded-xl">
                            <div class="basis-[30%]  flex flex-col justify-between items-center">
                                <div class="flex items-center">
                                    <!-- <i class="fa-solid fa-car block fa-4x text-orange"></i> -->
                                    <i class="fa-regular fa-user text-orange fa-2x"></i>
                                    <p class="ml-3 font-black">Clients</p>
                                </div>
                                <p class="mt-3 font-bold text-sm text-orange">Number of clients: <span><?php 
                                    $queryBookings="SELECT DISTINCT user_id FROM rental_operations WHERE status_operation_rental='confirm' AND MONTH(confirmation_date)=$month AND YEAR(confirmation_date)=$year AND  agency_entreprise_id=$rentalAgencyId";
                                    $resultBookings=mysqli_query($connect,$queryBookings);
                                    $valueBookings=mysqli_num_rows($resultBookings);
                                    echo $valueBookings;
                                ?></span></p>
                            </div>
                            <div class="basis-[30%] flex flex-col justify-between items-center">
                                <div class="flex items-center">
                                    <i class="fa-solid fa-money-bill-1-wave fa-2x text-orange"></i>
                                    <p class="ml-3 font-black">Income</p>
                                </div>
                                <p class="mt-3 font-bold text-sm text-orange">Income of this month: <span><?php 
                                    $queryIncome="SELECT SUM(global_price) FROM rental_operations WHERE status_operation_rental='confirm' AND MONTH(confirmation_date)=$month AND YEAR(confirmation_date)=$year  AND  agency_entreprise_id=$rentalAgencyId";
                                    $resultIncome=mysqli_query($connect,$queryIncome);
                                    $valueIncome=mysqli_fetch_assoc($resultIncome);
                                    echo $valueIncome['SUM(global_price)'];
                                ?>$</span></p>
                            </div>
                            <div class="basis-[30%] flex flex-col justify-between items-center">
                                <div class="flex items-center">
                                    <i class="fa-solid fa-cart-shopping fa-2x text-orange"></i>
                                    <p class="ml-3 font-black">Bookings</p>
                                </div>
                                <p class="mt-3 font-bold text-sm   text-orange">Bookings of this month: <span><?php 
                                    $queryBookings="SELECT rental_operations_id FROM rental_operations WHERE status_operation_rental='confirm' AND MONTH(confirmation_date)=$month AND YEAR(confirmation_date)=$year  AND  agency_entreprise_id=$rentalAgencyId";
                                    $resultBookings=mysqli_query($connect,$queryBookings);
                                    $valueBookings=mysqli_num_rows($resultBookings);
                                    echo $valueBookings;
                                ?></span></p>
                            </div>
                        </div>
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 overflow-hidden">
                                <thead class="text-xs text-orange uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-2 py-3 text-sm"  style="width:1%;" colspan="2">
                                    <p class="text-sm w-1/2 " style="width:100%;">Client name</p> 
                                </th>
                                <th class="px-10 py-3 text-sm "  style="width:1%;" >
                                    <p class="text-sm w-1/2 " style="width:100%;">Brand</p> 
                                </th>
                                <th class="px-1 py-2 text-sm "  style="width:1%;">
                                    <p class="text-sm w-1/2 " style="width:100%;">model</p> 
                                </th>
                                <th class="px-1 py-2 text-sm "  style="width:1%;">
                                    <p class="text-sm w-1/2 " style="width:100%;">location</p> 
                                </th>
                                <th class="px-1 py-2 text-sm "  style="width:1%;">
                                    <p class="text-sm w-1/2 " style="width:100%;">reservation date</p> 
                                </th>
                                <th class="px-1 py-2 text-sm "  style="width:2%;">
                                    <p class="text-sm w-1/2 " style="width:100%;">pick Up date</p> 
                                </th>
                                <th class="px-1 py-2 text-sm "  style="width:2%;">
                                    <p class="text-sm w-1/2 " style="width:100%;">end date</p> 
                                </th>
                                <th class="px-1 py-2 text-sm "  style="width:2%;">
                                    <p class="text-sm w-1/2 " style="width:100%;">Global price</p> 
                                </th>
                                <th class="px-1 py-2 text-sm "  style="width:2%;">
                                    <p class="text-sm w-1/2 " style="width:100%;">status</p> 
                                </th>
                                <th class="px-1 py-2 text-sm "  style="width:2%;">
                                    <p class="text-sm w-1/2 " style="width:100%;">Phone number</p> 
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                displayHistoricalData($connect,$month,$year,$rentalAgencyId);
                            ?>
                        </tbody>
                </table>
                </div>
            </div>                    
                </div>                    
            </div>
        </div>
    </div>
        <!-- jaavscript -->
        <script src="../data_historical.js"></script>
</body>
</html>


 