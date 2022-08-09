<?php 

include('header.php');
include('db.php');

$firstNameErr = $lastNameErr = $emailErr = $mobileNumberErr = $addressErr = $countryErr = $genderErr = $imageErr =  "";  


if(isset($_POST['submit']))
  { 

   if (empty($_POST["first_name"])) {  
      $firstNameErr = "FirstName is required";  
   }
   else {
      $first_name = $_POST['first_name'];
   }

   if (empty($_POST["last_name"])) {  
      $lastNameErr = "LastName is required";  
   }
   else {
      $last_name = $_POST['last_name'];
   } 
   
   if (empty($_POST["email"])) {  
      $emailErr = "Email is required";  
   } else {  
      $email = $_POST['email']; 
         // check that the e-mail address is well-formed  
         if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {  
            $emailErr = "Invalid email format";  
         }  
   }  

   //Number Validation  
   if (empty($_POST["mobile_number"])) {  
      $mobileNumberErr = "Mobile no is required";  
   } else {  
      $mobile_number = $_POST['mobile_number']; 
         // check if mobile no is well-formed  
         if (!preg_match ("/^[0-9]*$/", $mobile_number) ) {  
         $mobileNumberErr = "Only numeric value is allowed.";  
         }  
   //check mobile no length should not be less and greator than 10  
         if (strlen ($mobile_number) != 10) {  
            $mobileNumberErr = "Mobile no must contain 10 digits.";  
         }  
   } 
   
   
   if (empty($_POST["address"])) {  
      $addressErr = "Address is required";  
   }
   else {
    $address = $_POST['address'];      
   }


   if (empty($_POST["country"])) {  
      $countryErr = "Please Select Country";  
   }
   else {
      $country = $_POST['country'];       
   }


   if (empty($_POST["gender"])) {  
      $genderErr = "Please Choose Gender";  
   }
   else {
    $gender = $_POST['gender'];            
   }
        

    $checked_count = count($_POST['hobbies']);
    $checkbox1=$_POST['hobbies'];    
    $chk="";    
   
    foreach($checkbox1 as $chk1)
    {
    $chk .= $chk1.",";
    }
    
    
    $ppic=$_FILES["image"]["name"];
    
// get the image extension
$extension = substr($ppic,strlen($ppic)-4,strlen($ppic));

// allowed extensions
$allowed_extensions = array(".jpg","jpeg",".png",".gif");
// Validation for allowed extensions .in_array() function searches an array for a specific value.
if(!in_array($extension,$allowed_extensions) && empty($_POST["image"]))
{
$imageErr = "Invalid format. Only jpg / jpeg/ png /gif format allowed";
}
else
{
//rename the image file
$imgnewfile=md5($imgfile).time().$extension;
// Code for move image into directory
move_uploaded_file($_FILES["image"]["tmp_name"],"images/".$imgnewfile);

// Query for data insertion
$sql = mysqli_query($con, "INSERT INTO users (first_name, last_name, email, mobile_number, address, country, gender, hobbies, image) VALUES ('$first_name','$last_name', '$email', '$mobile_number','$address', '$country', '$gender', '$chk', '$imgnewfile' )");




if ($sql) {
echo "<script>alert('You have successfully inserted the data');</script>";
echo "<script type='text/javascript'> document.location ='index.php'; </script>";
} else{
echo "<script>alert('Something Went Wrong. Please try again');</script>";
}}
}
?>

<section class="h-100 h-custom" style="background-color: #8fc4b7;">
   <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
         <div class="col-lg-8 col-xl-6">
            <div class="card rounded-3">
               <h3 class="text-center">Create User</h3>
               <div class="card-body p-4 p-md-5">
                  <form class="px-md-2" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                     <div class="form-outline mb-4">
                         <label class="form-label">First Name *</label>
                        <input type="text" class="form-control" name="first_name" />
                        <span class="error" style="color: red;"><?php echo $firstNameErr; ?> </span>  
                     </div>

                     <div class="form-outline mb-4">
                         <label class="form-label">Last Name *</label>
                        <input type="text" class="form-control" name="last_name" />
                        <span class="error" style="color: red;"><?php echo $lastNameErr; ?> </span>  
                     </div>

                     <div class="form-outline mb-4">
                         <label class="form-label">Email *</label>
                        <input type="email" class="form-control" name="email" />
                        <span class="error" style="color: red;"><?php echo $emailErr; ?> </span>  
                     </div>

                     <div class="form-outline mb-4">
                         <label class="form-label">Mobile Number *</label>
                        <input type="text" class="form-control" name="mobile_number" />
                        <span class="error" style="color: red;"><?php echo $mobileNumberErr; ?> </span>                          
                     </div>

                     <div class="form-outline mb-4">
                         <label class="form-label">Address</label>
                        <textarea name="address" cols="3" rows="2" class="form-control"></textarea>
                        <span class="error" style="color: red;"><?php echo $addressErr; ?> </span>                          
                     </div>

                     <div class="form-outline mb-4">
                         <label class="form-label">Select Country</label>
                        <select class="select form-control" name="country">
                           <option value="" >Please Select Country</option>
                           <option value="India" >India</option>
                           <option value="Australia">Australia</option>
                           <option value="SriLanka">SriLanka</option>
                           <option value="Other">Other</option>
                        </select>
                        <span class="error" style="color: red;"><?php echo $countryErr; ?> </span>  
                     </div>
                     
                     <div>
                        <div class="form-check-inline mb-4">            
                           <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="gender" value="Male">Male
                           </label>
                        </div>
                        <div class="form-check-inline">
                              <label class="form-check-label">
                                 <input type="radio" class="form-check-input" name="gender" value="Female">Female
                              </label>
                        </div>
                        <div class="form-check-inline disabled">
                              <label class="form-check-label">
                                 <input type="radio" class="form-check-input" name="gender" value="Other">Other
                              </label>
                        </div>
                         <span class="error" style="color: red;"><?php echo $genderErr; ?> </span> 
                    </div> 
                     
                     <div class="form-outline mb-4">
                        <label class="form-label" for="form3Example1q">Select Hobbies : </label>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="hobbies[]" value="Cricket" />
                           <label class="form-check-label" for="inlineCheckbox1">Cricket</label>
                        </div>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="hobbies[]" value="Reading" />
                           <label class="form-check-label" for="inlineCheckbox2">Reading</label>
                        </div>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="hobbies[]" value="Music" />
                           <label class="form-check-label" for="inlineCheckbox2">Music</label>
                        </div>
                     </div>
                     <div class="form-outline mb-4">
                        <label class="form-label" for="form3Example1q">Upload Image</label>
                        <input type="file" name="image" class="form-control">
                        <span class="error" style="color: red;"><?php echo $imageErr; ?> </span>  

                     </div>
                     <a href="index.php" class="btn btn-secondary btn-sm float-left">Back</a>
                     <button type="submit" name="submit" value="submit" class="btn btn-success btn-sm float-right">Submit</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
