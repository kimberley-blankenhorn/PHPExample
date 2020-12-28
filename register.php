<?php
ob_start();
session_start(); // start a new session or continues the previous
if( isset($_SESSION['user'])!=""){
 header("Location: index.php" ); // redirects to index.php
} elseif(isset($_SESSION['admin'])!="") {
   header("Location: admin.php");
}
include_once 'actions/db_connect.php';
$error = false;
if (isset($_POST['btn-signup']) ) {
 
    // sanitize user input to prevent sql injection
    $name = trim($_POST['name']);
    //trim - strips whitespace (or other characters) from the beginning and end of a string
    $name = strip_tags($name);
    // strip_tags — strips HTML and PHP tags from a string
    $name = htmlspecialchars($name);
    // htmlspecialchars converts special characters to HTML entities
    
    $email = trim($_POST[ 'email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);

  // basic name validation
 if (empty($name)) {
  $error = true ;
  $nameError = "Please enter your full name.";
 } else if (strlen($name) < 3) {
  $error = true;
  $nameError = "Name must have at least 3 characters.";
 } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
  $error = true ;
  $nameError = "Name must contain alphabets and space.";
 }

 //basic email validation
  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
  $error = true;
  $emailError = "Please enter valid email address." ;
 } else {
  // checks whether the email exists or not
  $query = "SELECT userEmail FROM users WHERE userEmail='$email'";
  $result = mysqli_query($connect, $query);
  $count = mysqli_num_rows($result);
  if($count!=0){
   $error = true;
   $emailError = "Provided Email is already in use.";
  }
 }
 // password validation
  if (empty($pass)){
  $error = true;
  $passError = "Please enter password.";
 } else if(strlen($pass) < 6) {
  $error = true;
  $passError = "Password must have atleast 6 characters." ;
 }

 // password hashing for security
$password = hash('sha256' , $pass);


 // if there's no error, continue to signup
 if( !$error ) {
 
  $query = "INSERT INTO users(userName,userEmail,userPass) VALUES('$name','$email','$password')";
  $res = mysqli_query($connect, $query);
 
  if ($res) {
   $errTyp = "success";
   $errMSG = "Successfully registered, you may login now";
   unset($name);
    unset($email);
   unset($pass);
  } else  {
   $errTyp = "danger";
   $errMSG = "Something went wrong, try again later..." ;
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
<div class="container">
   <form method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  autocomplete="off" >
<!-- The $_SERVER["PHP_SELF"] is a super global variable that returns the filename of the currently executing script. -->
     
            <h2 class="text-center">Sign Up To View Our Furry Friends...</h2>
            <hr />
         
            <?php
   if ( isset($errMSG) ) {
 
   ?>
           <div class="alert alert-<?php echo $errTyp ?>" >
                         <?php echo $errMSG; ?>
       </div>

<?php
  }
  ?>
         
     
         

            <input type ="text"  name="name"  class="form-control mb-2"  placeholder="Enter Name" maxlength="50" value="<?php echo $name ?>"  />
     
               <span class="text-danger"> <?php echo $nameError; ?> </span>
         
   

            <input type="email" name="email" class="form-control mb-2" placeholder="Enter Your Email" maxlength="40" value ="<?php echo $email ?>"  />
   
               <span  class="text-danger"> <?php echo $emailError; ?> </span>
     
         
     
           
       
            <input type="password" name="pass" class="form-control mb-2" placeholder="Enter Password" maxlength="15"  />
           
               <span class="text-danger"> <?php echo $passError; ?> </span>
     
            <hr />

         
            <button type="submit" class="btn btn-block btn-info" name="btn-signup">Sign Up</button>
            <hr  />
         
            <a href="login.php" class="text-info">Sign in Here...</a>
   
 
   </form>
</div>

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>
<?php ob_end_flush(); ?>