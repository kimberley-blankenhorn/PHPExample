<?php
ob_start();
session_start();
require_once 'actions/db_connect.php';

// if session is not set this will redirect to login page
if( !isset($_SESSION['user' ]) && !isset($_SESSION["admin"]) ) {
    header("Location: login.php");
    exit;
   } elseif(isset($_SESSION["user"])){
     header("Location: index.php");
   }
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">

    <title>Welcome - <?php echo $userRow['userName' ]; ?></title>
<style>
h1, h3 {
    font-family: 'Dancing Script', cursive;
}
body{
    font-family: 'Merriweather', serif;
 }
</style>
</head>

<fieldset >
<h2 class="m-5 text-center ">Add Pets</h2>

   <form  action="actions/a_create.php" method= "post" enctype="multipart/form-data">
   <table  class="table table-bordered bg-dark text-white w-75 mx-auto">
           <tr>
               <th>Image</th >
               <td><input  type="text" name= "image"></td>
           </tr>    
              
           <tr>
               <th>Age</th>
               <td><input  type="text" name= "age"/></td>
           </tr>
           <tr>
               <th>Name</th>
               <td><input  type="text" name= "name"/></td>
           </tr>
           <tr>
               <th>Description</th>
               <td><input  type="text" name= "description"/></td>
           </tr>
           <tr>
               <th>hobbies</th>
               <td><input  type="text" name= "hobbies"/></td>
           </tr>
           <tr>
               <th>Location</th>
               <td><input  type="text" name= "location"/></td>
           </tr>
           <tr>
                <td><a href= "admin.php"><button type="button" class="btn btn-info">Back</button></a></td>
                <td><button type="submit" class="btn btn-info">Add New Pet</button></td>
           </tr >
       </table>
   </form>

</fieldset >

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>
<?php ob_end_flush(); ?>
