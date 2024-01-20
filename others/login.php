<?php
    include '../includes/connect.php';
    if(isset($_POST['submit'])){
        $username=$_POST['username'];
        $password=$_POST['password'];
        $query="SELECT user_id,role,user_password FROM users WHERE username='$username'";
        $result=mysqli_query($connect,$query);
        $row=mysqli_fetch_assoc($result);
        $id;
        $role;
        if($row && password_verify($password,$row['user_password'])){
            session_start(); 
            $_SESSION['user_id']=$row['user_id'];
            $_SESSION['role']=$row['role'];
            $id=$_SESSION['user_id'];
            $role=$_SESSION['role'];
        }
        if($role=='rental agency'){
            header("location:../admin_area/dashboard.php?user_id=$id&role=$role");
        }
        else if($role=='customer' || $role=='entreprise'){
            header("location:../clients_area/home_client.php?user_id=$id&role=$role");
        }
        else{
            header("location:./login.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../output.css">
    <title>log in</title>
</head>
<body>
    <section class="w-full min-h-screen bg-grey">
        <?php  
            include '../includes/header.php';
        ?>
        <div class="flex  items-center  justify-center  mt-5 py-8 px-3">
            <div class="flex rounded-md items-center  justify-center  w-[40%] relative  shadow-[-1px_-1px_5px_3px_#ffba6a]">
                <form class="rounded-md w-full bg-white overflow-hidden border-orange border-3" action="" method="post">
                <!-- wrapper -->
                <div class="flex w-full items-center justify-between relative">
                <p class="text-sm text-orange absolute top-3 left-7 ">log in</p>
                <!--part 1  -->
                <div class="shrink-0 form-section  flex-grow w-full p-20 transition duration-300 ">             
                    
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="username" id="username" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  required/>
                    <label for="username" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">username</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="password" name="password" id="password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  autocomplete-off required/>
                    <label for="password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">password</label>
                </div>
                <a href="./sign_up.php" class="text-sm text-orange">go to sign up</a>
                <!-- part2 added with js-->
                <div class="shrink-0 form-section  flex-grow w-full px-10 transition duration-300 part-2">             
                    <!-- part2 content by js -->
                </div>
             </div>
                <div class="-z-1 bg-orange text-center text-black  absolute w-full  right-0 bottom-5">
                            <input type="submit" name="submit" class=" text-orange bg-white px-1 py-2  cursor-pointer  block text-center w-full hover:bg-orange hover:text-white transition duration-300 ease-in-out hover:scale-110" value="log in">
                        </div>
                    </form>
                </div>
            </div>
            </div>
    </section>
    <!-- javascript -->
</body>
</html>