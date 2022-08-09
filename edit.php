<?php 
include('header.php');
include "db.php";

$firstNameErr = $lastNameErr = $emailErr = $mobileNumberErr = $addressErr = $countryErr = $genderErr = $imageErr =  "";  

    if (isset($_POST['update'])) {

        $id = $_POST['id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $mobile_number = $_POST['mobile_number'];
        $address = $_POST['address'];
        $country = $_POST['country'];
        $gender = $_POST['gender']; 

        // Hobbies Update
        $hobbies = $_POST['hobbies']; 
        $chk="";    
        foreach($hobbies as $chk1)
        {
        $chk .= $chk1.",";
        }
                 
        $ppic=$_FILES["image"]["name"];  
        $oldppic=$_POST['oldpic'];
        $oldprofilepic="images"."/".$oldppic;

        $extension = substr($ppic,strlen($ppic)-4,strlen($ppic));
        $allowed_extensions = array(".jpg","jpeg",".png",".gif");

        if(!in_array($extension,$allowed_extensions))
        {
        echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";        

        }else{        
        $imgnewfile=md5($imgfile).time().$extension;
        move_uploaded_file($_FILES["image"]["tmp_name"],"images/".$imgnewfile);
                               
        
        $sql = "UPDATE `users` SET `first_name`='$first_name',`last_name`='$last_name',`email`='$email',`mobile_number`='$mobile_number',`address`='$address',`country`='$country',`gender`='$gender',`hobbies`='$chk' ,`image`='$imgnewfile' WHERE `id`='$id'"; 

        $result = $con->query($sql); 

        if ($result == TRUE) {
            unlink($oldprofilepic);
            echo "<script>alert('You have successfully updated the data');</script>";
            echo "<script type='text/javascript'> document.location ='index.php'; </script>";

        }else{
            echo "Error:" . $sql . "<br>" . $con->error;
        }
    }

    } 

if (isset($_GET['id'])) {

    $id = $_GET['id']; 
    
    $sql = "SELECT * FROM `users` WHERE `id`='$id'";

    $result = $con->query($sql); 

    if ($result->num_rows > 0) {        

        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $email = $row['email'];
            $mobile_number  = $row['mobile_number'];
            $address = $row['address'];
            $country = $row['country'];
            $gender = $row['gender'];


            $hobbies = $row['hobbies'];            
            $repeat_array = explode(",", $hobbies);
            
            $image = $row['image'];
        } 

    ?>

       
<section class="h-100 h-custom" style="background-color: #8fc4b7;">
   <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
         <div class="col-lg-8 col-xl-6">
            <div class="card rounded-3">
               <h3 class="text-center">Edit User</h3>
               <div class="card-body p-4 p-md-5">
                  <form class="px-md-2" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                     <div class="form-outline mb-4">
                         <label class="form-label">First Name *</label>
                        <input type="text" class="form-control" name="first_name" value="<?php echo $first_name; ?>"/>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <span class="error" style="color: red;"><?php echo $firstNameErr; ?> </span>  
                     </div>

                     <div class="form-outline mb-4">
                         <label class="form-label">Last Name *</label>
                        <input type="text" class="form-control" name="last_name" value="<?php echo $last_name; ?>"/>
                        <span class="error" style="color: red;"><?php echo $lastNameErr; ?> </span>  
                     </div>

                     <div class="form-outline mb-4">
                         <label class="form-label">Email *</label>
                        <input type="email" class="form-control" name="email" value="<?php echo $email; ?>"/>
                        <span class="error" style="color: red;"><?php echo $emailErr; ?> </span>  
                     </div>

                     <div class="form-outline mb-4">
                         <label class="form-label">Mobile Number *</label>
                        <input type="text" class="form-control" name="mobile_number" value="<?php echo $mobile_number; ?>"/>
                        <span class="error" style="color: red;"><?php echo $mobileNumberErr; ?> </span>                          
                     </div>

                     <div class="form-outline mb-4">
                         <label class="form-label">Address</label>
                        <textarea name="address" cols="3" rows="2" class="form-control"><?php echo $address; ?></textarea>
                        <span class="error" style="color: red;"><?php echo $addressErr; ?> </span>                          
                     </div>

                     <div class="form-outline mb-4">
                         <label class="form-label">Select Country</label>
                        <select class="select form-control" name="country">
                           <option value="" >Please Select Country</option>
                           <option value="India"<?= $country == 'India' ? ' selected="selected"' : '';?>>India</option>
                           <option value="Australia"<?= $country == 'Australia' ? ' selected="selected"' : '';?>>Australia</option>
                           <option value="SriLanka"<?= $country == 'SriLanka' ? ' selected="selected"' : '';?>>SriLanka</option>
                           <option value="Other"<?= $country == 'Other' ? ' selected="selected"' : '';?>>Other</option>
                        </select>
                        <span class="error" style="color: red;"><?php echo $countryErr; ?> </span>  
                     </div>
                     
                     <div>
                        <div class="form-check-inline mb-4">            
                           <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="gender" value="Male"<?= ($gender == 'Male') ?  "checked" : "" ; ?>>Male
                           </label>
                        </div>
                        <div class="form-check-inline">
                              <label class="form-check-label">
                                 <input type="radio" class="form-check-input" name="gender" value="Female"<?= ($gender == 'Female') ?  "checked" : "" ; ?>>Female
                              </label>
                        </div>
                        <div class="form-check-inline disabled">
                              <label class="form-check-label">
                                 <input type="radio" class="form-check-input" name="gender" value="Other"<?= ($gender == 'Other') ?  "checked" : "" ; ?>>Other
                              </label>
                        </div>
                         <span class="error" style="color: red;"><?php echo $genderErr; ?> </span> 
                    </div> 
                     
                     <div class="form-outline mb-4">
                        <label class="form-label" for="form3Example1q">Select Hobbies : </label>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="hobbies[]" value="Cricket"<?php if (in_array('Cricket', $repeat_array)){ echo 'checked';} ?> />
                           <label class="form-check-label" for="inlineCheckbox1">Cricket</label>
                        </div>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="hobbies[]" value="Reading" <?php if (in_array('Reading', $repeat_array)){ echo 'checked';} ?> />
                           <label class="form-check-label" for="inlineCheckbox2">Reading</label>
                        </div>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="hobbies[]" value="Music" <?php if (in_array('Music', $repeat_array)){ echo 'checked';} ?> />
                           <label class="form-check-label" for="inlineCheckbox2">Music</label>
                        </div>
                     </div>
                     <div class="form-outline mb-4">
                        <label class="form-label" for="form3Example1q">Upload Image</label>
                        <input type="file" name="image" class="form-control">                        
                        <span class="error" style="color: red;"><?php echo $imageErr; ?> </span>  

                    </div>
                    <img src="images/<?php  echo $image;?>" width="80" height="80">
                    <input type="hidden" name="oldpic" value="<?php echo $image;?>">

                    <button type="submit" name="update" value="update" class="btn btn-success btn-sm float-right">Update</button>
                </form>
                <a href="index.php" class="btn btn-secondary btn-sm float-right">Back</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</section> 


    <?php

    } else{ 

        header('Location: view.php');

    } 

}

?> 