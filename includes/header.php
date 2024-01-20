<?php
if(!isset($_SESSION['user_id'])){
    echo '<nav class="bg-black w-full text-white flex flex-row justify-between items-center opacity-100 px-5 sticky top-0 z-50">
            <div class="flex flex-col items-center">
            <img src="../images/logo.png" alt="logo" width="80px">
            <p class="italic">Rentaly</p>
            </div>
            <ul class="flex  justify-between items-center w-[40%] ml-20">
            <li class=" inline-block transition duration-300 ease-in-out transform hover:scale-110 hover:shadow-white">
                <a href="../landing_page.php" class="text-md  cursor-pointer transition-linear duration-100 hover:scale-105 font-bold">Home</a>
            </li>
           
                <li class=" inline-block transition duration-300 ease-in-out transform hover:scale-110"><a href="#" class="text-md  cursor-pointer font-bold">Our serivces</a></li>
                <li class=" inline-block transition duration-300 ease-in-out transform hover:scale-110"><a href="#" class="text-md  cursor-pointer font-bold">About Us</a></li>
                <li class="  inline-block transition duration-300 ease-in-out transform hover:scale-110"><a href="#" class="text-md  cursor-pointer font-bold">Contact Us</a></li>
            </ul>
            <div>
                <a href="./sign_up.php" class="text-md mx-1 inline-block cursor-pointer bg-blue-100 py-2 px-6  text-black transition duration-300 ease-in-out transform hover:scale-100 bg-white hover:shadow-grey hover:shadow-2xl font-bold">sign up</a>
                <a href="../others/login.php" class="text-md cursor-pointer bg-orange py-2 px-6  transition duration-300 ease-in-out transform hover:scale-100 hover:bg-orange-600 hover:shadow-orange hover:shadow-2xl font-bold">log in</a>
            </div>
        </nav>';
        }
        if(isset($_SESSION['user_id'])){
            $user_id=$_GET['user_id'];
            $query="SELECT first_name,last_name,profile_image FROM users WHERE user_id=$user_id";
            $result=mysqli_query($connect,$query);
            $result=mysqli_fetch_assoc($result);
            $image=$result['profile_image'];
            $firstName=$result['first_name'];
            $lastName=$result['last_name'];
            $query1 = "SELECT user_id FROM rental_operations WHERE user_id='$user_id' AND status_operation_rental='pending'";
            $result1 = mysqli_query($connect, $query1);
            $rows = mysqli_num_rows($result1);
            echo '<nav class="bg-black w-full text-white flex flex-row justify-between items-center opacity-100 px-5 sticky top-0 z-50">
            <div class="flex flex-col items-center">
            <img src="../images/logo.png" alt="logo" width="80px">
            <p class="italic">Rentaly</p>
            </div>
            <ul class="flex  justify-evenly items-center w-[40%] ml-20">
            <li class=" inline-block transition duration-300 ease-in-out transform hover:scale-110 hover:shadow-white">
                <a href="./home_client.php?user_id='.$user_id.'" class="text-md  cursor-pointer transition-linear duration-100 hover:scale-105 font-bold">Home</a>
            </li>
            <li class="inline-block transition duration-300 ease-in-out transform hover:scale-110 hover:shadow-white">
                <a href="" class="text-md  cursor-pointer transition-linear duration-100 hover:scale-105 font-bold">Our services</a>
            </li>
                
                <li class="inline-block transition duration-300 ease-in-out transform hover:scale-110"><a href="./bookings?user_id='.$user_id.'" class="text-md  cursor-pointer font-bold">Bookings <i class="cursor-pointer fa-solid fa-cart-shopping text-orange"><sup class="text-sm font-black">'.$rows.'<sup></i></a> </li>
                <li class=" inline-block transition duration-300 ease-in-out transform hover:scale-110"><a href="history_client.php?user_id='.$user_id.'" class="text-md  cursor-pointer font-bold">History</a></li>
            </ul>
            <div class="flex items-center justify-between w-[20%]">
                    <h1 class=" basis-[80%] mr-2 text-orange font-black  text-right">Welcome '.ucwords($firstName).' '.ucwords($lastName).'</h1>
                    <div class="bg-grey basis-[20%] rounded-full p-1 relative cursor-pointer" style="height:50px;" id="imageContainer">
                        <img src="../images_profile/'.$image.'" alt="" class="filter brightness-100 rounded-full object-cover h-full" width="100%" height="100%">
                        <div class="bg-black hidden absolute mt-2 mr-2 rounded-xl flex items-center justify-center cursor-pointer z-50 " style="width:200px;left:-300%;" id="logoutContainer">
                            <a href="../others/logout.php" class="text-orange p-2 font-black text-xl hover:text-white">Log out</a>
                        </div>
                    </div>
            </div>
            <script>
                var imageContainer = document.getElementById("imageContainer");
                var logoutContainer = document.getElementById("logoutContainer");
                imageContainer.addEventListener("click", function() {
                    logoutContainer.classList.toggle("hidden");
                });
            </script>
        </nav>';
        }