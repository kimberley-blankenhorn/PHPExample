<?php
ob_start();
session_start();
require_once 'actions/db_connect.php';

// it will never let you open index(login) page if session is set
if ( isset($_SESSION['user' ])!="" ) {
 header("Location: index.php");
 exit; // why is exit needed here?
} elseif(isset($_SESSION['admin'])!="") {
  header("Location: admin.php");
  exit;
}

$error = false;

if( isset($_POST['btn-login']) ) {

  // prevent sql injections/ clear user invalid inputs
 $email = trim($_POST['email']);
 $email = strip_tags($email);
 $email = htmlspecialchars($email);

 $pass = trim($_POST[ 'pass']);
 $pass = strip_tags($pass);
 $pass = htmlspecialchars($pass);
 // prevent sql injections / clear user invalid inputs

 if(empty($email)){
  $error = true;
  $emailError = "Please enter your email address.";
 } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
  $error = true;
  $emailError = "Please enter valid email address.";
 }

 if (empty($pass)){
  $error = true;
  $passError = "Please enter your password." ;
 }

 // if there's no error, continue to login
 if (!$error) {
 
  $password = hash( 'sha256', $pass); // password hashing

  $res=mysqli_query($connect, "SELECT userId, userName, userPass, userType FROM users WHERE userEmail='$email'" );
  $row=mysqli_fetch_array($res, MYSQLI_ASSOC);
  $count = mysqli_num_rows($res); // if uname/pass is correct it returns must be 1 row

  if( $count == 1 && $row['userPass' ]==$password ) {
    if ($row['userType']=="user") {
      $_SESSION['user'] = $row['userId'];
      header( "Location: index.php");
    } elseif($row['userType']=="admin") {
      $_SESSION['admin'] = $row['userId'];
      header( "Location: admin.php");
    } else {
      $errMSG = "userType in database invalid";
    }

  } else {
   $errMSG = "Incorrect Credentials, Try again..." ;
  }
 
 }

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
h1, h3, h2 {
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
<div class="container pb-5 bg-dark p-5 text-white">
 <div class="m-5">
 <img src="https://cdn.pixabay.com/photo/2016/01/19/17/41/friends-1149841_1280.jpg" alt="furryFriends" style="height: 300px; width: auto;" class="mx-auto d-block">
 </div>
   <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete= "off">
 
   
            <h2 class="text-center">Please sign in here to view our pets</h2>
            <hr />
           
            <?php
  if ( isset($errMSG) ) {
echo  $errMSG; ?>
             
               <?php
  }
  ?>
           
         
           
            <input type="email" name="email" class="form-control mb-2" placeholder="Your Email" value="<?php echo $email; ?>"  maxlength="40" />
       
            <span class="text-danger"><?php echo $emailError; ?></span>
 
         
            <input type="password" name="pass"  class="form-control mb-2" placeholder="Your Password" maxlength="15"  />
       
           <span class="text-danger"><?php echo $passError; ?></span>
            <hr />
            <button type="submit" name="btn-login" class="btn btn-block btn-info mb-2">Sign In</button>
         
         
            <hr />
            <h3 class='text-center'>Don't have an account?</h3>
            <a href="register.php" class="text-info justify-center">Sign Up Here...</a>
     
         
   </form>
  
</div>
<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>
<?php ob_end_flush();?>