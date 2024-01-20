 <?php 
    session_start();
    include '../includes/connect.php';
    include '../functions/functions.php';
    // let's display cars according to locations
    $user_id=$_GET['user_id'];  
    $car_id=$_GET['car_id'];
    $entrepriseName=$_GET['entreprise_name'];
    $entrepriseId=$_GET['entreprise_id'];
    $query="SELECT model,brand,year,car_registration_number,fuel_type,seating_seat,mileage,price,number_of_horses,kind_of_vehicle FROM cars WHERE car_id=$car_id";
    $result=mysqli_query($connect,$query);
    $row=mysqli_fetch_assoc($result);
    $query2="SELECT image_name FROM images WHERE car_id=$car_id";
    $result2=mysqli_query($connect,$query2);
    $row2=mysqli_fetch_assoc($result2);
    // check if car in rental operation
    // $query5="SELECT start_date,end_date FROM rental_operations WHERE car_id=$car_id AND status_operation_rental='confirm' OR status_operation_rental='pending'";
    $query5 = "SELECT start_date, end_date FROM rental_operations WHERE car_id = $car_id AND (status_operation_rental = 'confirm' OR status_operation_rental = 'pending')";
    $result5=mysqli_query($connect,$query5);
    $row5=mysqli_num_rows($result5);
    $verifyUserDate=array();
    if($row5){
        while($lines=mysqli_fetch_assoc($result5)){
            $dates=array();
            $startDate=$lines['start_date'];
            $endDate=$lines['end_date'];
            $startDate=explode(' ',$startDate);
            $startDate=$startDate[0];
            $endDate=explode(' ',$endDate);
            $endDate=$endDate[0];
            // hadari
            echo '<p class="start_date hidden" style:"display:none">'.$startDate.'</p>';
            echo '<p class="end_date hidden" style:"display:none">'.$endDate.'</p>';
            $dates[]=$startDate;
            $dates[]=$endDate;
            $verifyUserDate[]=$dates;
        }
    }
    // code for submit
    $count=-1;
    if(isset($_POST['submit'])){
        $pickUpDate=$_POST['pick_up_date'];
        $pickUpTime=$_POST['pick_up_time'];
        $returnDate=$_POST['return_date'];
        $returnTime=$_POST['return_time'];
        $pickUpDate="$pickUpDate $pickUpTime";
        $returnDate="$returnDate $returnTime";
        $date1=new DateTime("$pickUpDate");
        $date2=new DateTime("$returnDate");
        $count=0;
        if($date1<$date2 && checkUserDate($pickUpDate,$returnDate,$verifyUserDate)){
            $interval=$date1->diff($date2);
            $daysDifference=$interval->days;
            $query="SELECT price FROM cars WHERE car_id=$car_id";
            $result=mysqli_query($connect,$query);
            $result=mysqli_fetch_assoc($result);
            $globalPrice=$daysDifference*$result['price'];
            $query="INSERT INTO rental_operations(user_id,car_id,start_date,end_date,global_price,reservation_date,status_operation_rental,agency_entreprise_id) VALUES ('$user_id','$car_id','$pickUpDate','$returnDate',$globalPrice,NOW(),'pending','$entrepriseId')"; 
            $result=mysqli_query($connect,$query);
              echo '<script>
                    setTimeout(() => {
                    window.location.href = "./rent.php?car_id=' . $car_id . '&user_id=' . $user_id . '&entreprise_name=' . $entrepriseName . '&entreprise_id=' . $entrepriseId . '";
                    }, 500);
                    </script>';
        }
        else if($date1>$date2){
            $count++;
        }
        else{
            $count+=2;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../output.css">
    <link rel="stylesheet" href="../style.css">
    <title>rent page</title>
    <!-- cdn font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- landing page -->
        <!-- <img src="../videos/banner.jpg" alt="" class="w-full h-screen"> -->

        <?php
            include '../includes/header.php';
        ?>
        <div class="flex w-full  bg-white gap-1 p-2 relative rounded-xl" style="min-height:calc( 100vh - 80px);">
            <div class="basis-[70%] bg-white flex p-2 gap-2 ">
            <!-- part 1 -->
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
            <!-- part 2 -->
            <div class="basis-[30%] bg-white p-5 shadow-[rgba(50,50,93,0.25)_0px_6px_12px_-2px,_rgba(0,0,0,0.3)_0px_3px_7px_-3px]">
                <p class="text-center"><span class="text-2xl font-black text-orange"><?php echo $row['brand'] ?></span> <span class="text-2xl font-black text-orange"><?php echo $row['model'] ?></span> <span class="text-1xl font-bold text-blue"><?php echo $row['year'] ?></span></p>
                <p class="text-blue text-2xl mt-2 text-center italic"><?php echo $entrepriseName; ?></p>
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
    <!-- content -->
            <div class="basis-[30%]  h-[100%]  rounded-xl" >
                <div class="basis-[45%] bg-black opacity-90 p-5  relative h-[80%]">
                <?php
                if($count==0){
                    echo '<p class="bg-white text-center p-3 rounded-xl text-1xl font-black aler hidden" style="color:green;">You are booking succefully</p> ';
                    echo '<script>const aler=document.querySelector(".aler");
                        function alertDanger(aler){
                            aler.classList.remove("hidden");
                            aler.classList.add("block");
                            setTimeout(()=>{
                                aler.classList.remove("block");
                                aler.classList.add("hidden");
                            },4000)
                        }
                       alertDanger(aler);
                    </script>';
                }
                else if($count==1){
                    echo '<p class="bg-white text-center p-3 rounded-xl text-1xl font-black aler" style="color:red;">choose return date after pick up date please</p> ';
                    echo '<script>const aler=document.querySelector(".aler");
                        function alertDanger(aler){
                            aler.classList.remove("hidden");
                            aler.classList.add("block");
                            setTimeout(()=>{
                                aler.classList.remove("block");
                                aler.classList.add("hidden");
                            },4000)
                        }
                       alertDanger(aler);
                    </script>';
                }
                else if($count==2){
                    echo '<p class="bg-white text-center p-3 rounded-xl text-1xl font-black aler" style="color:red;">Please choose available days</p>';
                    echo '<script>const aler=document.querySelector(".aler");
                        function alertDanger(aler){
                            aler.classList.remove("hidden");
                            aler.classList.add("block");
                            setTimeout(()=>{
                                aler.classList.remove("block");
                                aler.classList.add("hidden");
                            },4000)
                        }
                       alertDanger(aler);
                    </script>';
                }
                ?>
                <form action="" method="post">
                        <!-- pick up date and time -->
                        <p class="mt-4 text-md font-bold text-white">Pick up Date and Time</p>
                        <div class="flex mt-2 items-center justify-between">
                            <div class="flex items-center basis-[45%] justify-between ">
                                <input type="text" name="pick_up_date"  placeholder="choose date" class="p-1 text-sm  bg-black outline-0 focus:outline-none input-date hidden" required>
                                <p class="p-1 text-md  text-orange font-black output-date">choose date</p>
                                 <i class="fa-solid fa-calendar text-white fa-2x cursor-pointer transition duration-210 hover:scale-110 hover:text-orange toggle-calendar block "></i>
                            </div>
                            <div  class="flex items-center basis-[45%] justify-between h-24">
                                <input type="text" name="pick_up_time" class="input-time ml-5 p-1 text-sm bg-black outline-0 focus:outline-none hidden" placeholder="choose time" >
                                <p class="p-1 text-md  text-orange font-black output-time">choose time</p>
                                 <select name="" class="text-black p-1 rounded-md hover:bg-orange hover:text-white cursor-pointer border-none select-options z-50">
	                                <option value="8:00" class="option-time">8:00</option>
	                                <option value="8:30" class="option-time">8:30</option>
	                                <option value="9:00" class="option-time">9:00</option>
	                                <option value="9:30" class="option-time">9:30</option>
	                                <option value="10:00" class="option-time">10:00</option>
	                                <option value="10:30" class="option-time">10:30</option>
	                                <option value="11:00" class="option-time">11:00</option>
	                                <option value="11:30" class="option-time">11:30</option>
	                                <option value="12:00" class="option-time">12:00</option>
	                                <option value="12:30" class="option-time">12:30</option>
	                                <option value="1:00" class="option-time">1:00</option>
	                                <option value="1:30" class="option-time">1:30</option>
	                                <option value="2:00" class="option-time">2:00</option>
	                                <option value="2:30" class="option-time">2:30</option>
	                                <option value="3:00" class="option-time">3:00</option>
	                                <option value="3:30" class="option-time">3:30</option>
	                                <option value="4:00" class="option-time">4:00</option>
	                                <option value="4:30" class="option-time">4:30</option>
	                                <option value="5:00" class="option-time">5:00</option>
	                                <option value="5:30" class="option-time">5:30</option>
	                                <option value="6:00" class="option-time">6:00</option>
	                                <option value="6:30" class="option-time">6:30</option>
	                                <option value="7:00" class="option-time">7:00</option>
	                                <option value="7:30" class="option-time">7:30</option>
	                                <option value="8:00" class="option-time">8:00</option>
	                                <option value="9:00" class="option-time">8:30</option>
	                                <option value="9:00" class="option-time">9:00</option>
	                                <option value="9:30" class="option-time">9:30</option>
	                                <option value="10:00" class="option-time">10:00</option>
	                                <option value="10:30" class="option-time">10:30</option>
	                                <option value="11:00" class="option-time">11:00</option>
	                                <option value="11:30" class="option-time">11:30</option>
                                 </select>
                            </div>
                            </div>
                        <!-- return date and time -->
                        <p class="mt-4 text-md font-bold text-white">Return Date and Time</p>
                        <div class="flex mt-2 items-center justify-between">
                            <div class="flex items-center basis-[45%] justify-between ">
                                <input type="text" name="return_date"  placeholder="choose date" class="p-1 text-sm  bg-black outline-0 focus:outline-none input-date2 hidden" required>
                                <p class="p-1 text-md  text-orange font-black output-date2">choose date</p>
                                 <i class="fa-solid fa-calendar text-white fa-2x cursor-pointer transition duration-210 hover:scale-110 hover:text-orange toggle-calendar2 block "></i>
                            </div>
                            <div  class="flex items-center basis-[45%] justify-between h-24">
                                <input type="text" name="return_time" class="input-time2 ml-5 p-1 text-sm bg-black outline-0 focus:outline-none hidden" placeholder="choose time">
                                <p class="p-1 text-md  text-orange font-black output-time2">choose time</p>
                                 <select name="" class="text-black p-1 rounded-md hover:bg-orange hover:text-white cursor-pointer border-none select-options2 z-50">
	                                <option value="8:00" class="option-time2">8:00</option>
	                                <option value="8:30" class="option-time2">8:30</option>
	                                <option value="9:00" class="option-time2">9:00</option>
	                                <option value="9:30" class="option-time2">9:30</option>
	                                <option value="10:00" class="option-time2">10:00</option>
	                                <option value="10:30" class="option-time2">10:30</option>
	                                <option value="11:00" class="option-time2">11:00</option>
	                                <option value="11:30" class="option-time2">11:30</option>
	                                <option value="12:00" class="option-time">12:00</option>
	                                <option value="12:30" class="option-time2">12:30</option>
	                                <option value="1:00" class="option-time2">1:00</option>
	                                <option value="1:30" class="option-time2">1:30</option>
	                                <option value="2:00" class="option-time2">2:00</option>
	                                <option value="2:30" class="option-time2">2:30</option>
	                                <option value="3:00" class="option-time2">3:00</option>
	                                <option value="3:30" class="option-time2">3:30</option>
	                                <option value="4:00" class="option-time2">4:00</option>
	                                <option value="4:30" class="option-time2">4:30</option>
	                                <option value="5:00" class="option-time2">5:00</option>
	                                <option value="5:30" class="option-time2">5:30</option>
	                                <option value="6:00" class="option-time2">6:00</option>
	                                <option value="6:30" class="option-time2">6:30</option>
	                                <option value="7:00" class="option-time2">7:00</option>
	                                <option value="7:30" class="option-time2">7:30</option>
	                                <option value="8:00" class="option-time2">8:00</option>
	                                <option value="9:00" class="option-time2">8:30</option>
	                                <option value="9:00" class="option-time2">9:00</option>
	                                <option value="9:30" class="option-time2">9:30</option>
	                                <option value="10:00" class="option-time2">10:00</option>
	                                <option value="10:30" class="option-time2">10:30</option>
	                                <option value="11:00" class="option-time2">11:00</option>
	                                <option value="11:30" class="option-time2">11:30</option>
                                 </select>
                            </div>
                            </div>
                            <div class="flex justify-end w-full mt-5">
                                <input type="submit" value="book now" name="submit" class="bg-orange px-4 py-1  text-white font-bold cursor-pointer transition duration-300 ease-in-out transform hover:scale-100 hover:bg-orange-600 hover:shadow-orange hover:shadow-2xl ">
                            </div>
                        </form>
                    <!-- calendar 1-->
                            <div class="absolute w-full flex items-center justify-between flex-col bg- z-80 bg-grey   text-black border-orange rounded-xl p-3 shadow-[rgba(50,50,93,0.25)_0px_6px_12px_-2px,_rgba(0,0,0,0.3)_0px_3px_7px_-3px] calendar hidden z-50 " style="top:130px; left:-270px;">
                                <p class="alert w-full text-center bg-red-500 text-white p-2 m-1 rounded-full text-sm hidden">you can't choose this day</p>
                                <div class="w-full flex justify-between items-center mt-1">
                                
                                <p class="text-xl font-bold text-orange text-left w-full current-date"></p>
                                <div class="flex text-orange">
                                    <button class="text-4xl bg-white mr-2 rounded-full p-2 hover:bg-orange hover:text-white cursor-pointer prev"><</p>
                                    <button class="text-4xl bg-white rounded-full p-2 hover:bg-orange hover:text-white cursor-pointer next">></button>
                                </div>
                                </div>
                                <div class="grid grid-cols-7 gap-3 w-full mt-2">
                                    <p class=" text-brown font-bold w-[3rem]  col-span-1 text-center flex items-center justify-center ">Mon</p>
                                    <p class=" text-brown font-bold w-[3rem]  col-span-1 text-center flex items-center justify-center ">Thu</p>
                                    <p class=" text-brown font-bold w-[3rem]  col-span-1 text-center flex items-center justify-center ">wed</p>
                                    <p class=" text-brown font-bold w-[3rem]  col-span-1 text-center flex items-center justify-center ">Thu</p>
                                    <p class=" text-brown font-bold w-[3rem]  col-span-1 text-center flex items-center justify-center ">Fri</p>
                                    <p class=" text-brown font-bold w-[3rem]  col-span-1 text-center flex items-center justify-center ">Sat</p>
                                    <p class=" text-brown font-bold  w-[3rem]  col-span-1 text-center flex items-center justify-center ">Sun</p>
                                </div>           
                                <div class="grid grid-cols-7 gap-3 w-full justify-between items-center mt-2 days">
                                  
                                </div>           
                            </div>
                        <!-- calendar 2 -->
                        <div class="absolute w-full flex items-center justify-between flex-col bg- z-80 bg-grey   top-72 -left-8 text-black border-orange rounded-xl p-3 shadow-[rgba(50,50,93,0.25)_0px_6px_12px_-2px,_rgba(0,0,0,0.3)_0px_3px_7px_-3px] calendar2 z-80 hidden" style="top:270px; left:-270px;">
                                <p class="alert2 w-full text-center bg-red-500 text-white p-2 m-1 rounded-full text-sm hidden">you can't choose this day</p>
                                <div class="w-full flex justify-between items-center mt-1"> 
                                <p class="text-xl font-bold text-orange text-left w-full current-date2"></p>
                                <div class="flex text-orange">
                                    <button class="text-4xl bg-white mr-2 rounded-full p-2 hover:bg-orange hover:text-white cursor-pointer prev2"><</p>
                                    <button class="text-4xl bg-white rounded-full p-2 hover:bg-orange hover:text-white cursor-pointer next2">></button>
                                </div>
                                </div>
                                <div class="grid grid-cols-7 gap-3 w-full mt-2">
                                    <p class=" text-brown font-bold w-[3rem]  col-span-1 text-center flex items-center justify-center ">Mon</p>
                                    <p class=" text-brown font-bold w-[3rem]  col-span-1 text-center flex items-center justify-center ">Thu</p>
                                    <p class=" text-brown font-bold w-[3rem]  col-span-1 text-center flex items-center justify-center ">wed</p>
                                    <p class=" text-brown font-bold w-[3rem]  col-span-1 text-center flex items-center justify-center ">Thu</p>
                                    <p class=" text-brown font-bold w-[3rem]  col-span-1 text-center flex items-center justify-center ">Fri</p>
                                    <p class=" text-brown font-bold w-[3rem]  col-span-1 text-center flex items-center justify-center ">Sat</p>
                                    <p class=" text-brown font-bold  w-[3rem]  col-span-1 text-center flex items-center justify-center ">Sun</p>
                                </div>           
                                <div class="grid grid-cols-7 gap-3 w-full justify-between items-center mt-2 days2">
                                  
                                </div>           
                            </div>
                                <!-- end calendar -->
            </div>
            </div>
        </div>
      <!-- javascript -->
      <script src="../rent.js"></script>
      
</body>
</html>