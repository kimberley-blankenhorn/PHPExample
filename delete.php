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

if (isset($_GET['id'])) {
   $id = $_GET['id'];

   $sql = "SELECT * FROM pets WHERE petsId = {$id}" ;
   $result = $connect->query($sql);
   $data = $result->fetch_assoc();

   $connect->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
    
    <style>
       body{
       font-family: 'Merriweather', serif;
       }
    </style>    
</head>
<body>
<div class="bg-dark text-white" style="height:200px;">

<h3 class="py-5 mx-3">Do you really want to delete this pet?</h3>
<form action ="actions/a_delete.php" method="post">

   <input type="hidden" name= "id" value="<?php echo $data['petsId'] ?>" />
   <button type="submit" class="btn btn-info mb-4 mx-3 ">Yes, delete</button >
   <a href="admin.php"><button type="button" class="btn btn-info mb-4 mx-3">No, go back!</button ></a>
</form>

</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>

<?php
}
ob_end_flush(); ?>