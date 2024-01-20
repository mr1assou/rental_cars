 <?php 
    include './includes/connect.php';
    $count=-1;
    if(isset($_POST['submit'])){
        $locations=$_POST['location'];
        $pickUpDate=$_POST['pick_up_date'];
        $pickUpTime=$_POST['pick_up_time'];
        $returnDate=$_POST['return_date'];
        $returnTime=$_POST['return_time'];
        $pickUp="$pickUpDate $pickUpTime";
        $return="$returnDate $returnTime";
        $date1=new DateTime("$pickUpDate");
        $date2=new DateTime("$returnDate");
        $count=0;
        if($date1<$date2 ){
            header('location:./others/vehicles.php?location='.$locations.'&pick_up_date='.$pickUp.'&return_date='.$return.'');
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
    <link rel="stylesheet" href="./output.css">
    <link rel="stylesheet" href="./style.css">
    <title>home page</title>
    <!-- cdn font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- landing page -->
    <section class="w-full h-screen relative ">
        <video class="w-full h-full object-cover top-0 left-0 absolute -z-30 filter brightness-50" muted autoplay loop>
            <source src="./videos/video1.mp4" type="video/mp4"/>
        </video>
        
        <?php
            echo '<nav class="bg-black w-full text-white flex flex-row justify-between items-center opacity-100 px-5 ">
                <div class="flex flex-col items-center">
                <img src="./images/logo.png" alt="logo" width="80px">
                <p class="italic">Rentaly</p>
                </div>
            <ul class="flex  justify-between items-center w-[40%] ml-14">
            <li class=" inline-block transition duration-300 ease-in-out transform hover:scale-110 hover:shadow-white">
                <a href="#" class="text-md  cursor-pointer transition-linear duration-100 hover:scale-105 font-bold">Home</a>
            </li>
            <li class="inline-block transition duration-300 ease-in-out transform hover:scale-110 hover:shadow-white">
                <a href="#" class="text-md  cursor-pointer transition-linear duration-100 hover:scale-105 font-bold">About us</a>
            </li>
                <li class=" inline-block transition duration-300 ease-in-out transform hover:scale-110"><a href="#" class="text-md  cursor-pointer font-bold">Our Serivces</a></li>
                <li class=" inline-block transition duration-300 ease-in-out transform hover:scale-110"><a href="#" class="text-md  cursor-pointer font-bold">Contact Us</a></li>
            </ul>
            <div>
                <a href="./others/sign_up.php" class="text-md mx-1 inline-block cursor-pointer bg-blue-100 py-2 px-6  text-black transition duration-300 ease-in-out transform hover:scale-100 bg-white hover:shadow-grey hover:shadow-2xl font-bold">sign up</a>
                <a href="./others/login.php" class="text-md cursor-pointer bg-orange py-2 px-6  transition duration-300 ease-in-out transform hover:scale-100 hover:bg-orange-600 hover:shadow-orange hover:shadow-2xl font-bold ">log in</a>
            </div>
        </nav>';
        ?>
        <!-- content -->
        <div class="absolute top-1/2 left-1/2 w-full  transform translate-x-[-50%] translate-y-[-50%] flex justify-between items-center px-5">
            <!-- part 1 -->
            <div class="basis-[55%]  text-white p-3">
                <p class="text-md text-black font-black">Fast and Easy way to Rent a Car</p>
                <p class="text-4xl font-black mt-3 w-full"><span>Explore</span> <span><a href="" class="typewrite text-orange" data-period="2000" data-type='[ "Convenience and Comfort.", "Quick Booking Process.", "Seamless Rental .", "Smooth Vehicle Rentals." ]'>
            <span class="wrap"></span>
        </a>
        </span></p>
           <p class="text-md  font-extraligt text-stone-400 font-bold mt-4">Set forth on extraordinary adventures and unveil the world in unsurpassed luxury and style, accompanied by our fleet of exceptionally comfortable rental cars.</p>
            </div>
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
                                 <i class="fa-solid fa-calendar text-white fa-2x cursor-pointer transition duration-200 hover:scale-110 hover:text-orange toggle-calendar block "></i>
                            </div>
                            <div  class="flex items-center basis-[45%] justify-between ">
                                <input type="text" name="pick_up_time" class="input-time ml-5 p-1 text-sm bg-black outline-0 focus:outline-none hidden" placeholder="choose time" required>
                                <p class="p-1 text-md  text-orange font-black output-time">choose time</p>
                                 <select name="" class="text-black p-1 rounded-md hover:bg-orange hover:text-white cursor-pointer border-none select-options" required>
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
                                 <i class="fa-solid fa-calendar text-white fa-2x cursor-pointer transition duration-200 hover:scale-110 hover:text-orange toggle-calendar2 block "></i>
                            </div>
                            <div  class="flex items-center basis-[45%] justify-between ">
                                <input type="text" name="return_time" class="input-time2 ml-5 p-1 text-sm bg-black outline-0 focus:outline-none hidden" placeholder="choose time">
                                <p class="p-1 text-md  text-orange font-black output-time2">choose time</p>
                                 <select name="" class="text-black p-1 rounded-md hover:bg-orange hover:text-white cursor-pointer border-none select-options2" required>
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
                                <input type="submit" value="search" name="submit" class="bg-orange px-4 py-1  text-white font-bold cursor-pointer transition duration-300 ease-in-out transform hover:scale-100 hover:bg-orange-600 hover:shadow-orange hover:shadow-2xl ">
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
        <div class="absolute w-full h-[55px] bg-white bottom-0 left-0  flex items-center px-5 overflow-hidden slide-track -z-10 "> </div>
        </div>
       </section>
       <!-- <section>
            <h1 class="text-center mt-5 text-blue text-5xl ">Our Vehicule Fleet</h1>
            <p class="text-center mt-3 text-grey">Embark on unforgettable journeys as we turn your dreams into reality with our exceptional fleet of versatile vehicles.</p>
            <div class="px-5 flex mt-10  items-center  relative overflow-x-hidden mb-10">
                <div class="basis-[24%]  shadow-[rgba(50,50,93,0.25)_0px_6px_12px_-2px,_rgba(0,0,0,0.3)_0px_3px_7px_-3px] p-3 shrink-0 mx-2 car  transition duration-300 ease-in-out mb-3 mt-3">
            <div class="relative max-w-full overflow-hidden bg-cover bg-no-repeat rounded-md ">
                <img src="./images/ferrari1.jpg" class="w-full cursor-pointer  transition duration-300 ease-in-out hover:scale-110 rounded-md filter brightness-100 h-64 object-cover" alt="mercedes" />
            </div>
                    <div class="relative max-w-xs overflow-hidden bg-cover bg-no-repeat">
                    <div class="flex justify-between mt-3 items-center">
                        <p class="mx-2 text-orange text-lg">Mercedes</p>
                        <p class="mx-2  text-sm text-blue">Amg-360</p>
                    </div>
                    <div class="flex w-full items-center mt-3">                    
                        <div class="mx-2 flex items-center"><i class="fa-solid fa-user text-orange"></i><span class="mx-2 text-blue">5</span></div>
                        <div class="mx-2 flex items-center"><i class="fa-sharp fa-solid fa-door-closed text-orange"></i><span class="mx-2 text-blue">4</span></div>
                        <div class="mx-2 flex items-center"><i class="fa-solid fa-car text-orange"></i><span class="text-sm mx-2 text-blue">Sedan</span></div>
                    </div>
                    <p class="mt-3 border-b-2 border-grey mx-2 pb-2">Daily Rent</p>
                    <div class="mt-3 flex justify-between items-center my-2 ">
                        <p class="mx-2 text-orange font-black text-2xl">200$</p>
                        <div class="mx-2 flex items-center">
                            <a href="#" class="inline-block bg-black text-white mx-2 p-2 text-sm transition duration-300 ease-in-out hover:scale-110 rounded-md">view more</a>
                            <a href="#" class="inline-block bg-orange text-white p-2 text-sm transition duration-300 ease-in-out hover:scale-110 rounded-md">rent now</a>
                        </div>
                    </div>
                </div>
            </div>
             <div class="p-3 rounded-full  bg-black absolute top-1/2 text-white translate-x-[-50%] 
    cursor-pointer  transition duration-300 ease-in-out hover:bg-white hover:text-black prev-btn ">
            <i class="fas fa-solid fa-arrow-left fa-2x rouned-full"></i>
            </div>
             <div class="p-3 rounded-full  bg-black absolute top-1/2 right-0 text-white 
    cursor-pointer  transition duration-300 ease-in-out hover:bg-white hover:text-black next-btn">
            <i class="fa-sharp fa-solid fa-arrow-right fa-2x rounded-full"></i>
            </div>
        </div>
       </section> -->
       
      <!-- javascript -->
      <script src="./app.js"></script>
</body>
</html>