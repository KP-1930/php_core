<?php 
include('header.php');
include "db.php";

if (isset($_GET['id'])) {

    $user_id = $_GET['id'];

    $sql = "DELETE FROM `users` WHERE `id`='$user_id'";

     $result = $con->query($sql);

     if ($result == TRUE) {
            echo "<script>alert('Record deleted successfully');</script>";
            echo "<script type='text/javascript'> document.location ='index.php'; </script>";

    }else{
        echo "Error:" . $sql . "<br>" . $con->error;
    }

} 

?>