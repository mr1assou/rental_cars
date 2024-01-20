
<?php
    function checkImages($document){
        $fileInfo=pathinfo($document);
        $extension=$fileInfo['extension'];
        if($extension==='png' || $extension==='pdf' || $extension==='jpeg' || $extension==='jpg'){
            return true;
        }
        else{
            return false;
        }
    }
    function checkImageProfile($image){
        $fileInfo=pathinfo($image['name']);
        $extension=$fileInfo['extension'];
        if($extension=='png' || $extension=='jpeg' || $extension=='jpg'){
            return true;
        }
        else{
            return false;
        }
    }
    function checkPassword($password,$repeatPassword){
            if($password===$repeatPassword){
                return true;
            }
            else{
                return false;
            }
    }
    function uploadToImagesFolder($image,$carId,$connect){
        $path = '../images/' . $image['name'];  // Corrected the path concatenation
        move_uploaded_file($image['tmp_name'], $path);
        $query = "INSERT INTO images(image_name,car_id) VALUES ('$path','$carId')";
        $result=mysqli_query($connect,$query);
    }
    function uploadFolderProfiles($image){
        $name=$image['name'];
        $path = '../images_profile/'.$name;
        move_uploaded_file($image['tmp_name'], $path);
    }
    function displayCars($connect,$carId,$user_id,$rentalAgencyId){
        $query="SELECT model,brand,year,car_registration_number,fuel_type,seating_seat,mileage,price,number_of_horses,kind_of_vehicle,status FROM cars WHERE car_id=$carId AND is_deleted='false'";
        $result=mysqli_query($connect,$query);
        $num=mysqli_num_rows($result);
        if($num>0){
        $result=mysqli_fetch_assoc($result);
        $model=$result['model'];
        $brand=$result['brand'];
        $kindOfVehicle=$result['kind_of_vehicle'];
        $year=$result['year'];
        $car_registration_number=$result['car_registration_number'];
        $fuel_type=$result['fuel_type'];
        $seating_seat=$result['seating_seat'];
        $mileage=$result['mileage'];
        $price=$result['price'];
        $number_of_horses=$result['number_of_horses'];
        $status=$result['status'];
        $query="SELECT image_name FROM images WHERE car_id=$carId";
        $result=mysqli_query($connect,$query);
        $result=mysqli_fetch_assoc($result);
        echo '<div class="basis-[30%]  shadow-[rgba(50,50,93,0.25)_0px_6px_12px_-2px,_rgba(0,0,0,0.3)_0px_3px_7px_-3px] p-3 shrink-0 mx-2 car  transition duration-300 ease-in-out mb-3 mt-3">
            <div class="relative max-w-full overflow-hidden bg-cover bg-no-repeat rounded-md ">
                <img src="'.$result['image_name'].'" class="w-full cursor-pointer  transition duration-300 ease-in-out hover:scale-110 rounded-md filter brightness-100 h-64 object-cover" alt="'.$model.'" />
            </div>
                    <div class="relative max-w-xs overflow-hidden bg-cover bg-no-repeat">
                    <div class="flex justify-between mt-3 items-center">
                        <p class="mx-2 text-orange text-lg">'.$brand.'</p>
                        <p class="mx-2  text-sm text-blue">'.$model.'</p>
                    </div>
                    <div class="flex w-full items-center mt-3 flex-wrap justify-between">                    
                        <div class="mx-2 flex items-center"><i class="fa-solid fa-user text-orange"></i><span class="mx-2 text-blue">'.$seating_seat.'</span></div>
                        <div class="mx-2 flex items-center"><i class="fa-solid fa-route text-orange"></i><span class="mx-2 text-blue text-sm">'.$mileage.'km</span></div>
                        <div class="mx-2 flex items-center"><i class="fa-solid fa-car text-orange"></i><span class="text-sm mx-2 text-blue">'.$kindOfVehicle.'</span></div>
                    </div>
                    <p class="mt-2 text-orange px-2 font-black">'.$status.'</p>
                    <p class="mt-3 border-b-2 border-grey mx-2 pb-2 text-blue font-black">Daily Rent</p>
                    <div class="mt-3 flex justify-between items-center my-2 ">
                        <p class="mx-2 text-orange font-black text-2xl">'.$price.'$</p>
                        <div class="mx-2 flex items-center">
                            <a href="./view_more.php?car_id='.$carId.'&user_id='.$user_id.'" class="inline-block bg-black text-white mx-2 p-2 text-sm transition duration-300 ease-in-out hover:scale-110 rounded-md">view more</a>
                            <a href="./delete_car.php?car_id='.$carId.'&user_id='.$user_id.'&rental_agency_id='.$rentalAgencyId.'" class="inline-block bg-orange text-white p-2 text-sm transition duration-300 ease-in-out hover:scale-110 rounded-md">delete car</a>
                        </div>
                    </div>
                </div>
            </div>';
        }
    }
    // display cars according to cities
    function displayCarsAndCities($connect,$city,$user_id){
        // date
        $pickUpDate=$_GET['pick_up_date'];
        $returnDate=$_GET['return_date'];
        $pickUpDate=explode(' ',$pickUpDate);
        $returnDate=explode(' ',$returnDate);
        // end
        $query = "SELECT agence_location_id,agency_entreprise_id FROM agency_location WHERE location='$city'";
        $result=mysqli_query($connect,$query);
        echo '<div class="w-full">
                <p class="ml-5 text-4xl text-blue font-black mt-3">'.$city.'</p>
                 <div class="px-5 flex mt-10  items-center justify-evenly flex-wrap w-full">';
        while($row=mysqli_fetch_assoc($result)){
            $agencyLocationId=$row['agence_location_id'];
            $query = "SELECT car_id,model, brand, seating_seat,kind_of_vehicle,mileage, price FROM cars WHERE agence_location_id='$agencyLocationId' AND is_deleted='false'  ORDER BY RAND()";
            $check2=mysqli_query($connect,$query);
            while($car=mysqli_fetch_assoc($check2)){
                $que = "SELECT image_name FROM images WHERE car_id='" . $car['car_id'] . "'";
                $re=mysqli_query($connect,$que);
                $image=mysqli_fetch_assoc($re);
                $qu="SELECT agency_entreprise_id,adress FROM agency_location WHERE agence_location_id='$agencyLocationId'";
                $r=mysqli_query($connect,$qu);
                $result2=mysqli_fetch_assoc($r);
                $qu2 = "SELECT agency_entreprise_name FROM agency_entreprise WHERE agency_entreprise_id='" . $result2['agency_entreprise_id'] . "'";
                $r2=mysqli_query($connect,$qu2);
                $result3=mysqli_fetch_assoc($r2);
                echo '<div class="basis-[30%]  shadow-[rgba(50,50,93,0.25)_0px_6px_12px_-2px,_rgba(0,0,0,0.3)_0px_3px_7px_-3px] p-3  car  transition duration-300 ease-in-out mb-3 mt-3 parent block">
                         <div class="relative max-w-full overflow-hidden bg-cover bg-no-repeat rounded-md ">
                             <img src="'.$image['image_name'].'" class="w-full cursor-pointer  transition duration-300 ease-in-out hover:scale-110 rounded-md filter brightness-100 h-64 object-cover" alt="mercedes" />
                         </div>
                         <div class="relative max-w-xs overflow-hidden bg-cover bg-no-repeat">
                             <div class="flex justify-between mt-3 items-center">
                                 <p class="mx-2 text-orange text-lg brandCar">'.$car['brand'].'</p>
                                <p class="mx-2  text-sm text-blue">'.$car['model'].'</p>
                         </div>
                             <div class="flex w-full items-center mt-3">                    
                                <div class="mx-2 flex items-center"><i class="fa-solid fa-user text-orange"></i><span class="mx-2 text-blue">'.$car['seating_seat'].'</span></div>
                                 <div class="mx-2 flex items-center"><i class="fa-solid fa-route text-orange"></i><span class="mx-2 text-blue text-sm">'.$car['mileage'].'km</span></div>
                                 <div class="mx-2 flex items-center"><i class="fa-solid fa-car text-orange"></i><span class="text-sm mx-2 text-blue kind">'.$car['kind_of_vehicle'].'</span></div>
                            </div>
                    <div class="flex justify-between">
                     <p class="mt-3 border-b-2 border-grey mx-2 pb-2 text-sm text-blue font-black">Daily Rent</p>
                     <p class="mt-3 border-b-2 border-grey mx-2 pb-2 text-blue font-black text-sm"><span class="text-blue">agency:</span> <span class="text-orange">'.$result3['agency_entreprise_name'].'</span></p>
                     <p class="mt-3 border-b-2 border-grey mx-2 pb-2 text-blue font-black text-sm"<span class="text-blue">address:</span> <span class="text-orange">'.$result2['adress'].'</span></p>
                    </div>
                     <div class="mt-3 flex justify-between items-center my-2 ">
                         <p class="mx-2 text-orange font-black text-2xl price">'.$car['price'].'$</p>
                         <div class="mx-2 flex items-center">
                            <a href="./view_more.php?car_id='.$car['car_id'].'&user_id='.$user_id.'" class="inline-block bg-black text-white mx-2 p-2 text-sm transition duration-300 ease-in-out hover:scale-110 rounded-md"  target="_blank">view more</a>
                             <a href="./rent.php?car_id='.$car['car_id'].'&user_id='.$user_id.'&entreprise_name='.$result3['agency_entreprise_name'].'&entreprise_id='.$result2['agency_entreprise_id'].'&pick_up_date='.$pickUpDate[0].'&pick_up_time='.$pickUpDate[1].'&return_date='.$returnDate[0].'&return_time='.$returnDate[1].'" class="inline-block bg-orange text-white p-2 text-sm transition duration-300 ease-in-out hover:scale-110 rounded-md "  target="_blank">rent now</a>
                            </div>
                         </div>
                     </div>
                 </div>';
            }
        }
        echo '</div>
                 </div>';
    }
    function displayAllcars($connect,$user_id){
        if(isset($_GET['user_id']) && isset($_GET['brand']) &&  isset($_GET['kind_of_vehicle']) && isset($_GET['seating_seat'])){
            $brand=$_GET['brand'];
            $kindOfVehicle=$_GET['kind_of_vehicle'];
            $minPrice=$_GET['min_price'];
            $maxPrice=$_GET['max_price'];
            $query = "SELECT car_id,model, brand,kind_of_vehicle,mileage, price,agence_location_id FROM cars WHERE is_deleted='false' AND brand='$brand'  AND kind_of_vehicle='$kindOfVehicle'  AND price>=$minPrice AND price<=$maxPrice  ORDER BY car_id DESC";
            $result=mysqli_query($connect,$query);
            $numberOfrows=mysqli_num_rows($result);
            if($numberOfrows>0){
                while($car=mysqli_fetch_assoc($result)){
                    $agenceLocationId=$car['agence_location_id'];
                    $query2= "SELECT image_name FROM images WHERE car_id='" . $car['car_id'] . "'";
                    $result2=mysqli_query($connect,$query2);
                    $image=mysqli_fetch_assoc($result2);
                    $query3="SELECT agency_entreprise_id,location,adress FROM agency_location WHERE agence_location_id='$agenceLocationId'";
                    $result3=mysqli_query($connect,$query3);
                    $agenceEntrepriseId=mysqli_fetch_assoc($result3);
                    $query4 = "SELECT agency_entreprise_name FROM agency_entreprise WHERE agency_entreprise_id='" . $agenceEntrepriseId['agency_entreprise_id'] . "'";
                    $result4=mysqli_query($connect,$query4);
                    $nameEntreprise=mysqli_fetch_assoc($result4);
                    echo '<div class="basis-[30%]  shadow-[rgba(50,50,93,0.25)_0px_6px_12px_-2px,_rgba(0,0,0,0.3)_0px_3px_7px_-3px] p-3  car transition duration-300 ease-in-out mb-3 mt-3">
                            <div class="relative max-w-full overflow-hidden bg-cover bg-no-repeat rounded-md ">
                                 <img src="'.$image['image_name'].'" class="w-full cursor-pointer  transition duration-300 ease-in-out hover:scale-110 rounded-md filter brightness-100 h-64 object-cover" alt="mercedes" />
                            </div>
                             <div class="relative max-w-xs overflow-hidden bg-cover bg-no-repeat">
                                 <div class="flex justify-between mt-3 items-center">
                                     <p class="mx-2 text-orange text-lg brand">'.$car['brand'].'</p>
                                    <p class="mx-2  text-sm text-blue">'.$car['model'].'</p>
                                </div>
                             <div class="flex w-full items-center mt-3">                    
                                <div class="mx-2 flex items-center "><i class="fa-solid fa-user text-orange"></i><span class="mx-2 text-blue">'.$car['seating_seat'].'</span></div>
                                 <div class="mx-2 flex items-center "><i class="fa-solid fa-route text-orange"></i><span class="mx-2 text-blue text-sm">'.$car['mileage'].'km</span></div>
                                 <div class="mx-2 flex items-center "><i class="fa-solid fa-car text-orange"></i><span class="text-sm mx-2 text-blue">'.$car['kind_of_vehicle'].'</span></div>
                            </div>
                            <div class="flex justify-between items-center">
                                <p class="mt-3  border-b-2 mx-2 pb-2 text-blue font-black">address: <span class="text-orange "style="font-size:11px;">'.$agenceEntrepriseId['adress'].'</span></p>
                                <div class="flex">
                                    <p class="mt-3 border-b-2  mx-2 pb-2 text-blue font-black ">city: <span class="text-orange "style="font-size:11px;">'.$agenceEntrepriseId['location'].'</span></p>
                                    <p class="mt-3 border-b-2 border-grey mx-2 pb-2 text-blue font-black ">agency: <span class="text-orange "style="font-size:11px;">'.$nameEntreprise['agency_entreprise_name'].'</span></p>
                                </div>
                                </div>
                            <div class="mt-3 flex justify-between items-center my-2 ">
                                <p class="mx-2 text-orange font-black text-2xl">'.$car['price'].'$</p>
                            <div class="mx-2 flex items-center">
                                <a href="./view_more.php?car_id='.$car['car_id'].'&user_id='.$user_id.'" class="inline-block bg-black text-white mx-2 p-2 text-sm transition duration-300 ease-in-out hover:scale-110 rounded-md">view more</a>
                                <a href="./rent.php?car_id='.$car['car_id'].'&user_id='.$user_id.'&entreprise_name='.$nameEntreprise['agency_entreprise_name'].'&entreprise_id='.$agenceEntrepriseId['agency_entreprise_id'].'" class="inline-block bg-orange text-white p-2 text-sm transition duration-300 ease-in-out hover:scale-110 rounded-md">rent now</a>
                                </div>
                             </div>
                        </div>
                    </div>';
                    }
                }
                else{
                    echo '<p class="text-blue font-black text-4xl mt-5 w-full text-center">No cars matching the specified characteristics were found.</p>';
                }
                // the end
            }
        if(isset($_GET['user_id']) && !isset($_GET['brand'])){
            $query = "SELECT car_id,model, brand, seating_seat,kind_of_vehicle,mileage, price,agence_location_id FROM cars WHERE is_deleted='false' ORDER BY car_id DESC";
            $result=mysqli_query($connect,$query);
                while($car=mysqli_fetch_assoc($result)){
                    $agenceLocationId=$car['agence_location_id'];
                    $query2= "SELECT image_name FROM images WHERE car_id='" . $car['car_id'] . "'";
                    $result2=mysqli_query($connect,$query2);
                    $image=mysqli_fetch_assoc($result2);
                    $query3="SELECT agency_entreprise_id,location,adress FROM agency_location WHERE agence_location_id='$agenceLocationId'";
                    $result3=mysqli_query($connect,$query3);
                    $agenceEntrepriseId=mysqli_fetch_assoc($result3);
                    $query4 = "SELECT agency_entreprise_name FROM agency_entreprise WHERE agency_entreprise_id='" . $agenceEntrepriseId['agency_entreprise_id'] . "'";
                    $result4=mysqli_query($connect,$query4);
                    $nameEntreprise=mysqli_fetch_assoc($result4);
                    echo '<div class="basis-[30%]  shadow-[rgba(50,50,93,0.25)_0px_6px_12px_-2px,_rgba(0,0,0,0.3)_0px_3px_7px_-3px] p-3  car transition duration-300 ease-in-out mb-3 mt-3">
                            <div class="relative max-w-full overflow-hidden bg-cover bg-no-repeat rounded-md ">
                                 <img src="'.$image['image_name'].'" class="w-full cursor-pointer  transition duration-300 ease-in-out hover:scale-110 rounded-md filter brightness-100 h-64 object-cover" alt="mercedes" />
                            </div>
                             <div class="relative max-w-xs overflow-hidden bg-cover bg-no-repeat">
                                 <div class="flex justify-between mt-3 items-center">
                                     <p class="mx-2 text-orange text-lg brand">'.$car['brand'].'</p>
                                    <p class="mx-2  text-sm text-blue">'.$car['model'].'</p>
                                </div>
                             <div class="flex w-full items-center mt-3">                    
                                <div class="mx-2 flex items-center "><i class="fa-solid fa-user text-orange"></i><span class="mx-2 text-blue">'.$car['seating_seat'].'</span></div>
                                 <div class="mx-2 flex items-center "><i class="fa-solid fa-route text-orange"></i><span class="mx-2 text-blue text-sm">'.$car['mileage'].'km</span></div>
                                 <div class="mx-2 flex items-center "><i class="fa-solid fa-car text-orange"></i><span class="text-sm mx-2 text-blue">'.$car['kind_of_vehicle'].'</span></div>
                            </div>
                            <div class="flex justify-between items-center">
                                <p class="mt-3  border-b-2 mx-2 pb-2 text-blue font-black">address: <span class="text-orange "style="font-size:11px;">'.$agenceEntrepriseId['adress'].'</span></p>
                                <div class="flex">
                                    <p class="mt-3 border-b-2  mx-2 pb-2 text-blue font-black ">city: <span class="text-orange "style="font-size:11px;">'.$agenceEntrepriseId['location'].'</span></p>
                                    <p class="mt-3 border-b-2 border-grey mx-2 pb-2 text-blue font-black ">agency: <span class="text-orange "style="font-size:11px;">'.$nameEntreprise['agency_entreprise_name'].'</span></p>
                                </div>
                                </div>
                                 <p class="mt-3 mx-2 pb-2 text-blue font-black ">Daily Rent</p>
                            <div class="mt-3 flex justify-between items-center my-2 ">
                                <p class="mx-2 text-orange font-black text-2xl">'.$car['price'].'$</p>
                            <div class="mx-2 flex items-center">
                                <a href="./view_more.php?car_id='.$car['car_id'].'&user_id='.$user_id.'" class="inline-block bg-black text-white mx-2 p-2 text-sm transition duration-300 ease-in-out hover:scale-110 rounded-md">view more</a>
                                <a href="./rent.php?car_id='.$car['car_id'].'&user_id='.$user_id.'&entreprise_name='.$nameEntreprise['agency_entreprise_name'].'&entreprise_id='.$agenceEntrepriseId['agency_entreprise_id'].'" class="inline-block bg-orange text-white p-2 text-sm transition duration-300 ease-in-out hover:scale-110 rounded-md">rent now</a>
                                </div>
                             </div>
                        </div>
                    </div>';
                }
            }
        }
        function checkUserDate($pickUpDate, $returnDate, $verifyUserDate) {
                foreach ($verifyUserDate as $date) {
                    $date1 = new DateTime($date[0]);
                    $date2 = new DateTime($date[1]);
                    $pickUpDateObject = new DateTime($pickUpDate);
                    $returnDateObject = new DateTime($returnDate);
                    // Check if pickup date is inside any reservation period
                    if (($pickUpDateObject >= $date1 && $pickUpDateObject <= $date2) ||
                        ($returnDateObject >= $date1 && $returnDateObject <= $date2) ||
                        ($pickUpDateObject <= $date1 && $returnDateObject >= $date2)){
                        return false;
                    }
                }
                return true;
        }
        function substractTwoDates($reservationDate,$startDate){
            $date1=new DateTime($reservationDate);
            $date2=new DateTime($startDate);
            $interval=$date1->diff($date2);
            $difference=$interval->days;
            return $difference;
        }
        function displayBookings($connect,$line,$user_id){
            $startDate=$line['start_date'];
            $startDate=explode(' ',$startDate);
            $startDate=$startDate[0];   
            $endDate=$line['end_date'];
            $endDate=explode(' ',$endDate);
            $endDate=$endDate[0];   
            $reservationDate=$line['reservation_date'];
            $reservationDate=explode(' ',$reservationDate);
            $reservationDate=$reservationDate[0];
            $difference=substractTwoDates($reservationDate,$startDate);
            // barrier   
            $carId=$line['car_id'];
            $query="SELECT image_name FROM images WHERE car_id='$carId'";
            $result=mysqli_query($connect,$query);
            $image=mysqli_fetch_assoc($result);
            $query2="SELECT brand,model,year,seating_seat,mileage,kind_of_vehicle FROM cars WHERE car_id='$carId'";
            $result2=mysqli_query($connect,$query2);
            $car=mysqli_fetch_assoc($result2);
            echo '<div class="flex w-full items-center mt-5 justify-evenly shadow-[rgba(50,50,93,0.25)_0px_6px_12px_-2px,_rgba(0,0,0,0.3)_0px_3px_7px_-3px] parent">
                <div class="basis-[30%]  bg-white h-64 rounded-xl p-3">
                    <img src="'.$image['image_name'].'" alt="'.$image['image_name'].'" class="w-full h-24 rounded-xl object-cover" style="height:100%;width:100%;">
                </div>
                <div class="basis-[30%]">
                    <p><span> '.$car['brand'].' </span><span>'.$car['model'].'</span><span> '.$car['year'].' </span></p>
                    <div class="flex w-full items-center mt-3 flex-wrap">                    
                        <div class="mx-2 flex items-center"><i class="fa-solid fa-user text-orange"></i><span class="mx-2 text-blue">'.$car['seating_seat'].'</span></div>
                        <div class="mx-2 flex items-center"><i class="fa-solid fa-route text-orange"></i><span class="mx-2 text-blue text-sm">'.$car['mileage'].'</span></div>
                        <div class="mx-2 flex items-center"><i class="fa-solid fa-car text-orange"></i><span class="text-sm mx-2 text-blue">'.$car['kind_of_vehicle'].'</span></div>
                    </div>
                    <div class="flex mt-5">
                        <div>
                            <p class="text-orange basis-[25%] text-xl font-bold">start date:</p>
                            <p class="text-sm start-date">'.$startDate.'</p>
                            <p class="text-sm start-date difference hidden">'.$difference.'</p>
                            </div>
                        <div class="ml-3 basis-[25%]" style="margin-left:10px;">
                            <p class="text-orange text-xl font-bold">end date:</p>
                            <p class="text-sm">'.$endDate.'</p>
                        </div>
                        <div class="ml-3 basis-[25%]" style="margin-left:10px;">
                            <p class="text-orange text-xl font-bold">reservation date:</p>
                            <p class="text-sm reservation-date">'.$reservationDate.'</p>
                        </div>
                        <div class="ml-3 basis-[25%]" style="margin-left:10px;">
                            <p class="text-orange text-xl font-bold">status:</p>
                            <p class="text-sm">'.$line['status_operation_rental'].'</p>
                        </div>
                    </div>
                    <p class="mt-5 text-xl text-orange font-bold">Duration for billing:</p>
                    <p class="mt-2 text-2xl message"><span class="days">00</span>days<span class="ml-5 hours">00</span>hrs<span class="ml-5 minutes">00</span>min<span class="ml-5 secondes">00</span>s</p>
                </div>
                <div class="basis-[40%] flex flex-col items-center justify-between font-black text-blue" style="height:100%;">
                    <p class="bg-green text-2xl">Global Price: <span>'.$line['global_price'].'</span>$</p>
                    <div class="flex gap-2">
                        <a href="./remove.php?user_id='.$user_id.'&car_id='.$carId.'&rental_operations_id='.$line['rental_operations_id'].'" class="block mt-5  bg-orangenge text-white bg-orange px-3 py-2  transition duration-100 ease-in-out hover:scale-110">remove</a>
                        <a href="./view_more.php?user_id='.$user_id.'&car_id='.$carId.'" class="block mt-5  bg-orangenge text-white bg-blue px-3 py-2 transition duration-100 ease-in-out hover:scale-110">view more</a>
                    </div>
                </div>
            </div>';
        }
        function dashboardInformations($connect,$line,$admin_id,$rentalAgencyId){
            $reservationDate=$line['reservation_date'];
            $startDate=$line['start_date'];
            $reservationDate=explode(' ',$reservationDate)[0];
            $startDate=explode(' ',$startDate)[0];
            $date1=new DateTime($reservationDate);
            $date2=new DateTime($startDate);
            $dateDifference=$date1->diff($date2);
            $differenceOfDays=$dateDifference->days;
            $client_id=$line['user_id'];
            $query="SELECT first_name,last_name,profile_image FROM users WHERE user_id=$client_id";
            $result=mysqli_query($connect,$query);
            $informationsClient=mysqli_fetch_assoc($result);
            $car_id=$line['car_id'];
            $query="SELECT brand,model,agence_location_id FROM cars WHERE car_id=$car_id";
            $result=mysqli_query($connect,$query);
            $informationsCars=mysqli_fetch_assoc($result);
            $id=$informationsCars['agence_location_id'];
            $query="SELECT location FROM agency_location WHERE agence_location_id=$id";
            $result=mysqli_query($connect,$query);
            $city=mysqli_fetch_assoc($result);
            echo '
            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 parent">
                                <th scope="row" class="px-2 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" colspan="2">
                                    <div class="w-full flex items-center gap-1">
                                        <img src="'.$informationsClient['profile_image'].'" alt="" style="width:50px;height:50px;" class="rounded-full basis-[30%]  object-center filter brightness-200">
                                        <p class="mr-2">'.$informationsClient['first_name'].' '.$informationsClient['last_name'].'</p>
                                    </div>
                                </th>
                                <td class="px-10 py-3 text-sm "  style="width:1%;">
                                    <p class="text-sm text-blue ml-1 " style="width:100%;">'.$informationsCars['brand'].'</p> 
                                </td>
                                <td class="px-1 py-2 text-sm "  style="width:1%;">
                                    <p class=" text-blue" style="width:100%;font-size:10px;">'.$informationsCars['model'].'</p> 
                                </td>
                                <td class="px-1 py-2 text-sm "  style="width:1%;">
                                    <p class=" text-blue" style="width:100%;font-size:10px;">'.$city['location'].'</p> 
                                </td>
                                <td class="px-1 py-2 text-sm "  style="width:1%;font-size:10px;">
                                    <p class=" difference text-4xl bg-orange hidden">'.$differenceOfDays.'</p>
                                    <p class=" text-blue reservation-date w-full" style="width:100%;font-size:10px;">'.$reservationDate.'</p> 
                                </td>
                                <td class=" py-2 "  style="width:1%;">
                                    <p class=" text-blue start-date w-full" style="width:100%;font-size:10px;">'.$startDate.'</p> 
                                </td>
                                <td class="px-1 py-2"  style="width:1%">
                                    <p class=" text-blue w-full" style="width:100%;font-size:10px;">'.$line['end_date'].'</p> 
                                </td>
                                <td class="px-1 py-2"  style="width:1%">
                                    <p class=" text-blue w-full" style="width:100%;font-size:10px;">'.$line['global_price'].'$</p> 
                                </td>
                                <td class="px-1 py-2 text-sm "  style="width:2%;">
                                   <p class=" message w-full"><span class="days font-black text-md text-blue">00</span>d<span class="hours ml-1 font-black text-md text-blue">00</span>h<span class="minutes ml-1 font-black text-md text-blue">00</span>m<span class="secondes ml-1 font-black text-md text-blue">00</span>s</p>
                                </td>
                                <td class="px-2 py-3 text-sm "  style="width:1%;" colspan="3">
                                  <div class="flex  w-full justify-evenly">
                                    <a href="./remove.php?rental_operations_id='.$line['rental_operations_id'].'&user_id='.$admin_id.'" class="block px-3 py-2  text-white bg-orange   transition duration-100 ease-in-out hover:scale-110">Remove</a>
                                    <a href="./details.php?client='.$line['user_id'].'&user_id='.$admin_id.'&car_id='.$car_id.'&rental_agency_id='.$rentalAgencyId.'" class="block  px-3 py-2 text-white bg-blue  transition duration-100 ease-in-out hover:scale-110">Details</a>
                                    <a href="./confirmation.php?rental_operations_id='.$line['rental_operations_id'].'&car_id='.$car_id.'&user_id='.$admin_id.'" class="block  px-3 py-2 text-white   transition duration-100 ease-in-out hover:scale-110" style="background-color:green">Confirm</a>
                                    </div>
                                </td>
                            </tr>';
        }
        function displayHistoricalData($connect,$month,$year,$rentalAgencyId){
            $query="SELECT user_id,car_id,reservation_date,start_date,end_date,global_price,status_operation_rental FROM rental_operations WHERE status_operation_rental IN ('confirm','expired') AND agency_entreprise_id=$rentalAgencyId ORDER BY rental_operations_id DESC";
            $result=mysqli_query($connect,$query);
            while($line=mysqli_fetch_assoc($result)){
                $client_id=$line['user_id'];
                $query1="SELECT first_name,last_name,profile_image,phone_number FROM users WHERE user_id=$client_id";
                $result1=mysqli_query($connect,$query1);
                $informationsClient=mysqli_fetch_assoc($result1);
                // car
                $car_id=$line['car_id'];
                $query2="SELECT brand,model,agence_location_id FROM cars WHERE car_id=$car_id";
                $result2=mysqli_query($connect,$query2);
                $informationsCars=mysqli_fetch_assoc($result2);
                $id=$informationsCars['agence_location_id'];
                $query3="SELECT location FROM agency_location WHERE agence_location_id=$id";
                $result3=mysqli_query($connect,$query3);
                $city=mysqli_fetch_assoc($result3);
                // end car
                $globalPrice=$line['global_price'];
                $startDate=$line['start_date'];
                $endDate=$line['end_date'];
                $reservationDate=$line['reservation_date'];
                $status=$line['status_operation_rental'];
                echo '
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 parent">
                                <th scope="row" class="px-2 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" colspan="2">
                                    <div class="w-full flex items-center gap-1">
                                        <img src="'.$informationsClient['profile_image'].'" alt="" style="width:50px;height:50px;" class="rounded-full basis-[30%]  object-center filter brightness-200">
                                        <p class="mr-2">'.$informationsClient['first_name'].' '.$informationsClient['last_name'].'</p>
                                    </div>
                                </th>
                                <td class="px-10 py-3 text-sm "  style="width:1%;">
                                    <p class="text-sm text-blue ml-1 " style="width:100%;">'.$informationsCars['brand'].'</p> 
                                </td>
                                
                                <td class="px-1 py-2 text-sm "  style="width:1%;">
                                    <p class=" text-blue" style="width:100%;font-size:10px;">'.$informationsCars['model'].'</p> 
                                </td>
                                <td class="px-1 py-2 text-sm "  style="width:1%;">
                                    <p class=" text-blue" style="width:100%;font-size:10px;">'.$city['location'].'</p> 
                                </td>
                                <td class="px-1 py-2 text-sm "  style="width:1%;font-size:10px;">
                                    <p class=" text-blue reservation-date w-full" style="width:100%;font-size:10px;">'.$reservationDate.'</p> 
                                </td>
                                <td class="px-1 py-2 "  style="width:1%;">
                                    <p class=" text-blue start-date w-full" style="width:100%;font-size:10px;">'.$startDate.'</p> 
                                </td>
                                <td class="px-1 py-2"  style="width:1%">
                                    <p class=" text-blue w-full" style="width:100%;font-size:10px;">'.$endDate.'</p> 
                                </td>
                                <td class="px-1 py-2"  style="width:1%">
                                    <p class=" text-blue w-full" style="width:100%;font-size:10px;">'.$globalPrice.'$</p> 
                                </td>
                                <td class="px-1 py-2"  style="width:1%">
                                    <p class=" text-blue w-full" style="width:100%;font-size:10px;">'.$status.'</p> 
                                </td>
                                <td class="px-1 py-2"  style="width:1%">
                                    <p class=" text-blue w-full" style="width:100%;font-size:10px;">'.$informationsClient['phone_number'].'</p> 
                                </td>
                            </tr>';
            }
        }
        function historyClients($connect,$line,$user_id){
            $startDate=$line['start_date'];
            $startDate=explode(' ',$startDate);
            $startDate=$startDate[0];   
            $endDate=$line['end_date'];
            $endDate=explode(' ',$endDate);
            $endDate=$endDate[0];   
            $reservationDate=$line['reservation_date'];
            $reservationDate=explode(' ',$reservationDate);
            $reservationDate=$reservationDate[0];
            $difference=substractTwoDates($reservationDate,$startDate);
            // barrier   
            $carId=$line['car_id'];
            $query="SELECT image_name FROM images WHERE car_id='$carId'";
            $result=mysqli_query($connect,$query);
            $image=mysqli_fetch_assoc($result);
            $query2="SELECT brand,model,year,seating_seat,mileage,kind_of_vehicle FROM cars WHERE car_id='$carId'";
            $result2=mysqli_query($connect,$query2);
            $car=mysqli_fetch_assoc($result2);
            echo '<div class="flex w-full items-center mt-5 justify-evenly shadow-[rgba(50,50,93,0.25)_0px_6px_12px_-2px,_rgba(0,0,0,0.3)_0px_3px_7px_-3px] parent">
                <div class="basis-[30%]  bg-white h-64 rounded-xl p-3">
                    <img src="'.$image['image_name'].'" alt="'.$image['image_name'].'" class="w-full h-24 rounded-xl object-cover" style="height:100%;width:100%;">
                </div>
                <div class="basis-[30%]">
                    <p><span> '.$car['brand'].' </span><span>'.$car['model'].'</span><span> '.$car['year'].' </span></p>
                    <div class="flex w-full items-center mt-3 flex-wrap">                    
                        <div class="mx-2 flex items-center"><i class="fa-solid fa-user text-orange"></i><span class="mx-2 text-blue">'.$car['seating_seat'].'</span></div>
                        <div class="mx-2 flex items-center"><i class="fa-solid fa-route text-orange"></i><span class="mx-2 text-blue text-sm">'.$car['mileage'].'</span></div>
                        <div class="mx-2 flex items-center"><i class="fa-solid fa-car text-orange"></i><span class="text-sm mx-2 text-blue">'.$car['kind_of_vehicle'].'</span></div>
                    </div>
                    <div class="flex mt-5">
                        <div>
                            <p class="text-orange basis-[25%] text-xl font-bold">start date:</p>
                            <p class="text-sm start-date">'.$startDate.'</p>
                            <p class="text-sm start-date difference hidden">'.$difference.'</p>
                            </div>
                        <div class="ml-3 basis-[25%]" style="margin-left:10px;">
                            <p class="text-orange text-xl font-bold">end date:</p>
                            <p class="text-sm">'.$endDate.'</p>
                        </div>
                        <div class="ml-3 basis-[25%]" style="margin-left:10px;">
                            <p class="text-orange text-xl font-bold">reservation date:</p>
                            <p class="text-sm reservation-date">'.$reservationDate.'</p>
                        </div>
                        <div class="ml-3 basis-[25%]" style="margin-left:10px;">
                            <p class="text-orange text-xl font-bold">status:</p>
                            <p class="text-sm">'.$line['status_operation_rental'].'</p>
                        </div>
                    </div>
                </div>
                <div class="basis-[40%] flex flex-col items-center justify-between font-black text-blue" style="height:100%;">
                    <p class="bg-green text-2xl">Global Price: <span>'.$line['global_price'].'</span>$</p>
                    <div class="flex gap-2">
                       
                    </div>
                </div>
            </div>';
        }
        function displayForGuest($connect,$city,$user_id){
        // date
        $pickUpDate=$_GET['pick_up_date'];
        $returnDate=$_GET['return_date'];
        $pickUpDate=explode(' ',$pickUpDate);
        $returnDate=explode(' ',$returnDate);
        // end
        $query = "SELECT agence_location_id,agency_entreprise_id FROM agency_location WHERE location='$city'";
        $result=mysqli_query($connect,$query);
        echo '<div class="w-full">
                <p class="ml-5 text-4xl text-blue font-black mt-3">'.$city.'</p>
                 <div class="px-5 flex mt-10  items-center justify-evenly flex-wrap w-full">';
        while($row=mysqli_fetch_assoc($result)){
            $agencyLocationId=$row['agence_location_id'];
            $query = "SELECT car_id,model, brand, seating_seat,kind_of_vehicle,mileage, price FROM cars WHERE agence_location_id='$agencyLocationId' AND is_deleted='false'  ORDER BY RAND()";
            $check2=mysqli_query($connect,$query);
            while($car=mysqli_fetch_assoc($check2)){
                $que = "SELECT image_name FROM images WHERE car_id='" . $car['car_id'] . "'";
                $re=mysqli_query($connect,$que);
                $image=mysqli_fetch_assoc($re);
                $qu="SELECT agency_entreprise_id,adress FROM agency_location WHERE agence_location_id='$agencyLocationId'";
                $r=mysqli_query($connect,$qu);
                $result2=mysqli_fetch_assoc($r);
                $qu2 = "SELECT agency_entreprise_name FROM agency_entreprise WHERE agency_entreprise_id='" . $result2['agency_entreprise_id'] . "'";
                $r2=mysqli_query($connect,$qu2);
                $result3=mysqli_fetch_assoc($r2);
                echo '<div class="basis-[30%]  shadow-[rgba(50,50,93,0.25)_0px_6px_12px_-2px,_rgba(0,0,0,0.3)_0px_3px_7px_-3px] p-3  car  transition duration-300 ease-in-out mb-3 mt-3 parent block">
                         <div class="relative max-w-full overflow-hidden bg-cover bg-no-repeat rounded-md ">
                             <img src="'.$image['image_name'].'" class="w-full cursor-pointer  transition duration-300 ease-in-out hover:scale-110 rounded-md filter brightness-100 h-64 object-cover" alt="mercedes" />
                         </div>
                         <div class="relative max-w-xs overflow-hidden bg-cover bg-no-repeat">
                             <div class="flex justify-between mt-3 items-center">
                                 <p class="mx-2 text-orange text-lg brandCar">'.$car['brand'].'</p>
                                <p class="mx-2  text-sm text-blue">'.$car['model'].'</p>
                         </div>
                             <div class="flex w-full items-center mt-3">                    
                                <div class="mx-2 flex items-center"><i class="fa-solid fa-user text-orange"></i><span class="mx-2 text-blue">'.$car['seating_seat'].'</span></div>
                                 <div class="mx-2 flex items-center"><i class="fa-solid fa-route text-orange"></i><span class="mx-2 text-blue text-sm">'.$car['mileage'].'km</span></div>
                                 <div class="mx-2 flex items-center"><i class="fa-solid fa-car text-orange"></i><span class="text-sm mx-2 text-blue kind">'.$car['kind_of_vehicle'].'</span></div>
                            </div>
                    <div class="flex justify-between">
                     <p class="mt-3 border-b-2 border-grey mx-2 pb-2 text-sm text-blue font-black">Daily Rent</p>
                     <p class="mt-3 border-b-2 border-grey mx-2 pb-2 text-blue font-black text-sm"><span class="text-blue">agency:</span> <span class="text-orange">'.$result3['agency_entreprise_name'].'</span></p>
                     <p class="mt-3 border-b-2 border-grey mx-2 pb-2 text-blue font-black text-sm"<span class="text-blue">address:</span> <span class="text-orange">'.$result2['adress'].'</span></p>
                    </div>
                     <div class="mt-3 flex justify-between items-center my-2 ">
                         <p class="mx-2 text-orange font-black text-2xl price">'.$car['price'].'$</p>
                         <div class="mx-2 flex items-center">
                            <a href="./login.php" class="inline-block bg-black text-white mx-2 p-2 text-sm transition duration-300 ease-in-out hover:scale-110 rounded-md">view more</a>
                             <a href="./login.php" class="inline-block bg-orange text-white p-2 text-sm transition duration-300 ease-in-out hover:scale-110 rounded-md">rent now</a>
                            </div>
                         </div>
                     </div>
                 </div>';
            }
        }
        echo '</div>
                 </div>';
    }