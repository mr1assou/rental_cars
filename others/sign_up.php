<?php
    include '../functions/functions.php';
    include '../includes/connect.php';
    if(isset($_POST['submit'])){
        $firstName=$_POST['first_name'];
        $lastName=$_POST['last_name'];
        $phone=$_POST['phone'];
        $role=$_POST['role'];
        $email=$_POST['email'];
        $profile_image=$_FILES['profile_image'];
        $profile='../images_profile/'.$profile_image['name'];
        uploadFolderProfiles($profile_image);
        $username=$_POST['username'];
        $password=$_POST['password'];
        $repeatPassword=$_POST['repeat_password'];
        if(checkImageProfile($profile_image) && checkPassword($password,$repeatPassword)){
            $hashedPassword=password_hash($password,PASSWORD_DEFAULT);
            $query="INSERT INTO users(first_name,last_name,phone_number,role,email,profile_image,username,user_password,responsable_id) VALUES('$firstName','$lastName','$phone','$role','$email','$profile','$username','$hashedPassword',NULL)";
            $result=mysqli_query($connect,$query);
            // get last id before to enter to if statement
            $queryGetLastId="SELECT user_id FROM users WHERE first_name='$firstName' AND last_name='$lastName' AND phone_number='$phone' AND email='$email' AND username='$username'";
            $result=mysqli_query($connect,$queryGetLastId);
            $array=mysqli_fetch_assoc($result);
            $row=$array['user_id'];
            if(isset($_POST['entreprise_name'])){
            $entrepriseName=$_POST['entreprise_name'];
            $businessRegistrationNumberEntreprise=$_POST['business_registarion_number_entreprise'];
            $articlesOfIncorporationEntreprise=$_POST['articles_of_incorporation_entreprise'];
            $registrationCertificateEntreprise=$_POST['registration_certificate_entreprise'];
            $businessLiabilityInsurranceEntreprise=$_POST['business_liability_inssurance_entreprise'];
            $creditApplicationEntreprise=$_POST['credit_application_entreprise'];
            $billingInformationEntreprise=$_POST['billing_information_entreprise'];            
            if(checkImages($businessLiabilityInsurranceEntreprise) && checkImages($articlesOfIncorporationEntreprise) && checkImages($registrationCertificateEntreprise) && checkImages($businessLiabilityInsurranceEntreprise) && checkImages($creditApplicationEntreprise) && checkImages($billingInformationEntreprise)){
                $query="INSERT INTO agency_entreprise(agency_entreprise_name,business_registration_number,articles_of_incorporation,registration_certifcate,business_liability_inssurance,credit_application,billing_information,status_agency_entreprise,leader) VALUES('$entrepriseName','$businessRegistrationNumberEntreprise','$articlesOfIncorporationEntreprise','$registrationCertificateEntreprise','$businessLiabilityInsurranceEntreprise','$creditApplicationEntreprise','$billingInformationEntreprise',NULL,$row)";
                $result=mysqli_query($connect,$query);
            }
            }
            if(isset($_POST['agency_name'])){
            $agencyName=$_POST['agency_name'];
            $businessRegistrationNumber=$_POST['business_registarion_number'];
            $articlesOfIncorporation=$_FILES['articles_of_incorporation']['name'];
            $registrationCertificate=$_FILES['registration_certificate']['name'];
            $businessLiabilityInsurrance=$_FILES['business_liability_inssurance']['name'];
            $creditApplication=$_FILES['credit_application']['name'];
            $billingInformation=$_FILES['billing_information']['name'];
            $cities=$_POST['cities'];
            // here are adresses
            $numberOfAdresses=count($cities);
            $adresses=array();
            for($i=1;$i<=$numberOfAdresses;$i++){
                $adresses[]=$_POST["adress-$i"];
            }
            if(checkImages($articlesOfIncorporation) && checkImages($registrationCertificate) && checkImages($businessLiabilityInsurrance) && checkImages($creditApplication) && checkImages($billingInformation)){
                $query="INSERT INTO agency_entreprise(agency_entreprise_name,business_registration_number,articles_of_incorporation,registration_certifcate,business_liability_inssurance,credit_application,billing_information,status_agency_entreprise,leader) VALUES('$agencyName','$businessRegistrationNumber','$articlesOfIncorporation','$registrationCertificate','$businessLiabilityInsurrance','$creditApplication','$billingInformation','pending',$row)";
                $result=mysqli_query($connect,$query);
                $queryRentalAgencyId="SELECT agency_entreprise_id FROM agency_entreprise WHERE leader='$row'";
                $result=mysqli_query($connect,$queryRentalAgencyId);
                $array=mysqli_fetch_assoc($result);
                $row = $array['agency_entreprise_id'];
                $count = 0;
                foreach ($cities as $city) {
                    $query = "INSERT INTO agency_location(location, agency_entreprise_id, adress) VALUES ('$city', $row, '$adresses[$count]')";
                    $result = mysqli_query($connect, $query);
                    $count++;
                }
            }
            }
        }
        // echo "<script>window.open('./sign_up.php','_self');</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../output.css">
    <title>sign up</title>
</head>
<body>
    <section class="w-full min-h-screen bg-grey">
        <?php  
            include '../includes/header.php';
        ?>
        <div class="flex  items-center  justify-center  mt-5 py-8 px-3">
            <div class="flex rounded-md items-center  justify-center  w-[40%] relative  shadow-[-1px_-1px_5px_3px_#ffba6a]">
                <form class="rounded-md w-full bg-white overflow-hidden border-orange border-3" action="" method="post" enctype="multipart/form-data">
                <!-- wrapper -->
                <div class="flex w-full items-center justify-between relative">
                <p class="text-sm text-orange absolute top-3 left-7 ">Sign up</p>
                <!--part 1  -->
                <div class="shrink-0 form-section  flex-grow w-full p-20 transition duration-300 ">             
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" name="first_name" id="first_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  required/>
                        <label for="first_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">First name</label>
                    </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="last_name" id="last_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  required/>
                    <label for="last_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Last name</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="phone" id="phone" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  required/>
                    <label for="phone" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Phone number (123-456-7890)</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="email" name="email" id="email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  required/>
                        <label for="email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">email</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="file" name="profile_image" id="profile_image" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required/>
                    <label for="profile_image" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">profile image</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="username" id="username" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  required/>
                    <label for="username" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">username</label>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="password"  name="password" id="password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                        <label for="password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="password" name="repeat_password" id="repeat_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  required/>
                        <label for="repeat_password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Repeat Password</label>
                    </div>
                </div>
                <div class="flex gap-10 items-center mb-5">
                    <div class="flex text-gray-500 bg-transparent">
                       <p>Customer</p>
                       <input name="role" type="radio" class="ml-1 role" value="customer" required/>
                    </div>
                    <div class="flex ml-2 text-gray-500 bg-transparent">
                       <p>Entreprise</p>
                       <input name="role" type="radio" class="ml-1 role" value="entreprise"/>
                    </div>
                    <div class="flex ml-2 text-gray-500 bg-transparent">
                       <p>Rental agency</p>
                       <input name="role" type="radio" class="ml-1 role" value="rental agency"/>
                    </div>
                </div>
                </div>
                <!-- part2 added with js-->
                <div class="shrink-0 form-section  flex-grow w-full px-10 transition duration-300 part-2">             
                    <!-- part2 content by js -->
                </div>
    </div>
                <div class="-z-1 bg-orange text-center text-black px-10 absolute w-full bottom-5 left-0 mt-10">
                    <input type="submit" name="submit" class=" text-white bg-orange px-1 py-2  cursor-pointer  block " value="submit">
                </div>
                </form>
                <div class="absolute bottom-2 mb-4 right-0 ">
                    <button class="text-white bg-orange mx-3 py-1 px-3 cursor-pointer mt-2 prev-btn">prev</button>
                    <button class="text-white bg-orange mx-3 py-1 px-3 cursor-pointer mt-2 next-btn ">next</button>
                </div>
                </div>
            </div>
    </section>
    <!-- javascript -->
    <script src="../sign_up.js"></script>
</body>
</html>