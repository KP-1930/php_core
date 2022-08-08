<?php
$con=mysqli_connect("localhost", "pmauser", "phpmyadmin", "phpcrud");
if(mysqli_connect_errno())
{
echo "Connection Fail".mysqli_connect_error();
}
else {
   // echo "Successfully";
}
?>