 <?php 
    session_start();
    include '../includes/connect.php';
    include '../functions/functions.php';
    $user_id=$_GET['user_id'];
    $count=-1;
    if(isset($_POST['submit'])){
        $locations=$_POST['location'];
        $pickUpDate=$_POST['pick_up_date'];
        $pickUpTime=$_POST['pick_up_time'];
        $returnDate=$_POST['return_date'];
        $returnTime=$_POST['return_time'];
        $pickUpDate="$pickUpDate $pickUpTime";
        $returnDate="$returnDate $returnTime";
        $date1=new DateTime("$pickUpDate");
        $date2=new DateTime("$returnDate");
        $count=0;
        if($date1<$date2 ){
            header('Location: ./cars.php?user_id='. $user_id.'&location='.$locations.'&pick_up_date='.$pickUpDate.'&return_date='.$returnDate.'');
            exit;
        }
        else if($date1>$date2){
            $count++;
        }
        else{
            $count+=2;
        }
        
    }
    // let's display cars according to locations
    $user_id=$_GET['user_id'];
    $query="SELECT DISTINCT location FROM agency_location";
    $result=mysqli_query($connect,$query);
    $cities=array();
    while($row=mysqli_fetch_assoc($result)){
        $cities[]=$row['location'];
    }
    
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
    <section class="w-full h-screen bg-cover bg-center bg-fixed bg-no-repeat" style="background-image: url('../videos/banner.jpg');">
        <!-- <img src="../videos/banner.jpg" alt="" class="w-full h-screen"> -->
        <?php
            include '../includes/header.php';
        ?>
        <!-- content -->
        <!-- content -->
        <div class="absolute top-1/2 left-1/2 w-full  transform translate-x-[-50%] translate-y-[-50%] flex justify-center items-center px-5">
            <!-- part 2 -->
            <div class="basis-[45%] bg-black opacity-90 p-5 text-white relative">
                <p class="text-md font-bold">Choose your vehicule</p>
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
                     <label for="countries" class="mt-2 block mb-2 text-sm font-medium text-orange">Select locations:</label>
                        <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 p-2" name="location" required>
                            <?php
                                $query="SELECT DISTINCT location FROM agency_location";
                                $result=mysqli_query($connect,$query);
                                while($line=mysqli_fetch_assoc($result)){
                                    echo '<option>'.$line['location'].'</option>';
                                }
                            ?>
                    </select>
                        <!-- pick up date and time -->
                        <p class="mt-4 text-md font-bold">Pick up Date and Time</p>
                        <div class="flex mt-2 items-center justify-between">
                            <div class="flex items-center basis-[45%] justify-between ">
                                <input type="text" name="pick_up_date"  placeholder="choose date" class="p-1 text-sm  bg-black outline-0 focus:outline-none input-date hidden" required>
                                <p class="p-1 text-md  text-orange font-black output-date">choose date</p>
                                 <i class="fa-solid fa-calendar text-white fa-2x cursor-pointer transition duration-210 hover:scale-110 hover:text-orange toggle-calendar block "></i>
                            </div>
                            <div  class="flex items-center basis-[45%] justify-between ">
                                <input type="text" name="pick_up_time" class="input-time ml-5 p-1 text-sm bg-black outline-0 focus:outline-none hidden" placeholder="choose time"  required>
                                <p class="p-1 text-md  text-orange font-black output-time">choose time</p>
                                 <select name="" class="text-black p-1 rounded-md hover:bg-orange hover:text-white cursor-pointer border-none select-options">
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
                        <p class="mt-4 text-md font-bold">Return Date and Time</p>
                        <div class="flex mt-2 items-center justify-between">
                            <div class="flex items-center basis-[45%] justify-between ">
                                <input type="text" name="return_date"  placeholder="choose date" class="p-1 text-sm  bg-black outline-0 focus:outline-none input-date2 hidden"  required>
                                <p class="p-1 text-md  text-orange font-black output-date2">choose date</p>
                                 <i class="fa-solid fa-calendar text-white fa-2x cursor-pointer transition duration-210 hover:scale-110 hover:text-orange toggle-calendar2 block "></i>
                            </div>
                            <div  class="flex items-center basis-[45%] justify-between ">
                                <input type="text" name="return_time" class="input-time2 ml-5 p-1 text-sm bg-black outline-0 focus:outline-none hidden" placeholder="choose time" required>
                                <p class="p-1 text-md  text-orange font-black output-time2">choose time</p>
                                 <select name="" class="text-black p-1 rounded-md hover:bg-orange hover:text-white cursor-pointer border-none select-options2">
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
                                <input type="submit" value="Search" name="submit" class="bg-orange px-4 py-1  text-white font-bold cursor-pointer transition duration-300 ease-in-out transform hover:scale-100 hover:bg-orange-600 hover:shadow-orange hover:shadow-2xl ">
                            </div>
                        </form>
                    <!-- calendar 1-->
                            <div class="absolute w-8/12 flex items-center justify-between flex-col bg- z-80 bg-grey   top-52 -left-8 text-black border-orange rounded-xl p-3 shadow-[rgba(50,50,93,0.25)_0px_6px_12px_-2px,_rgba(0,0,0,0.3)_0px_3px_7px_-3px] calendar hidden">
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
                        <div class="absolute w-8/12 flex items-center justify-between flex-col bg- z-80 bg-grey   top-72 -left-8 text-black border-orange rounded-xl p-3 shadow-[rgba(50,50,93,0.25)_0px_6px_12px_-2px,_rgba(0,0,0,0.3)_0px_3px_7px_-3px] calendar2 z-80 hidden">
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
        <!-- autoplay slider -->
        <div class="absolute w-full h-[55px] bg-white bottom-0 left-0  flex items-center px-5 overflow-hidden slide-track -z-10 "> </div>
        </div>
       </section>
       <!-- section view cars -->
       
      
       
      <!-- javascript -->
      <script src="../home_client.js"></script>
</body>
</html>