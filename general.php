<?php
ob_start();
session_start();
require_once 'actions/db_connect.php';

// if session is not set this will redirect to login page
if(isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit;
} elseif(!isset($_SESSION['user' ]) ) {
 header("Location: login.php");
 exit;
}
// select logged-in users details
$res=mysqli_query($connect, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
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
<body>
<header>
  <div class="text-center bg-info">
    <h1 class="text-white p-5">Adopt A Pet</h1>
    <h3 class="text-white p-2 pb-5">Find your new family member here...</h3>
  </div>
</header>


<div class ="container m-3 mx-auto">
  
Hi <?php echo $userRow['userName' ]; ?>
           
           <a  href="logout.php?logout">Sign Out</a>
   <h3 class="text-center">Here you will find our younger friends...</h3>
     <table class="table table-bordered mt-5 bg-info text-white">
       <thead>
           <tr>
               <th scope="col">image</th>
               <th scope="col">Age</th>
               <th scope="col">Name</th>
               <th scope="col">Description</th>
               <th scope="col">Hobbies</th>
               <th scope="col">Location</th>
           </tr>

       </thead>

       <tbody>

           
       <?php
           $sql = "SELECT * FROM pets WHERE age <= '9'";
           $result = $connect->query($sql);

            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo  "<tr>
                    <td><img src=". $row['image'] ." alt='image' class='img-thumbnail' style='width:200px; height:200px; object-fit:cover;'></td>
                    <td style='width:100px;'>" .$row['age']."</td>
                    <td>" .$row['name']."</td>
                    <td class='w-25'>" .$row['description']."</td>
                    <td>" .$row['hobbies']."</td>
                    <td>" .$row['location']."</td>
                      
                   </tr>" ;
               }
           } else  {
               echo  "<tr><td colspan='5'><center>No Data Avaliable</center></td></tr>";
           }
            ?>

       </tbody>
   </table>
   <a href= "index.php"><button type="button" class="btn btn-info">To our main page</button></a>
   <a href= "senior.php"><button type="button" class="btn btn-info">To our older buddies</button></a>
</div>

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>
<?php ob_end_flush(); ?>