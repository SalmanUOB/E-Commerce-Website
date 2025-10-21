
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container" id="signup">
      <h1 class="form-title">Register</h1>
      <form method="post" action="register.php">
        <div class="input-group">
           <i class="fas fa-user"></i>
           <input type="text" name="user" id="fName" placeholder="Username">
           <label for="fname">Username</label>
        </div>
        <div class="input-group">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" id="email" placeholder="Email">
            <label for="email">Email</label>
        </div>
        <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="password" name="pass" id="password" placeholder="Password">
            <label for="password">Password</label>
        </div>
        <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="password" name="cpass" placeholder="Confirm Password">
            <label for="cpass">Confirm Password</label>
        </div>
       <input type="submit" class="btn" value="Sign Up" name="signUp">
      </form>
      <p class="or">
        ----------or--------
      </p>
      <div class="icons">
        <i class="fab fa-google"></i>
        <i class="fab fa-facebook"></i>
      </div>
      <div class="links">
        <p>Already Have Account ?</p>
        <button id="signInButton"><a href="login.php">Sign In</a></button>
      </div>
    </div>
    <script src="design.js"></script>
</body>
</html>
<?php 
include 'connect.php';

if(isset($_POST['signUp'])){
    $user=$_POST['user'];
    $email=$_POST['email'];
    $catag = "user";
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];
    $passcheck = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()\-_=+{};:,<.>])(?=.*[A-Za-z\d!@#$%^&*()\-_=+{};:,<.>])[\w!@#$%^&*()\-_=+{};:,<.>]{8,}$/';
    $emailcheck = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    if (trim($user)=="" || trim($email)=="" || trim($pass)=="" || trim($cpass)==""){
      echo ("<h3 style='color:red;text-align:center; font-family: Times New Roman;'>Missing information!</br></h3>");
  }
    elseif(!preg_match($passcheck,$pass)){
		echo "<h3 style='color:red;text-align:center; font-family: Times New Roman;'>Password must be at 
        least 8 characters long and contain at least one lowercase letter, one uppercase letter, one digit, and one special character.</br></h3>";
	  }
    
    elseif(!preg_match($emailcheck,$email))
    {
      echo"<h3 style='color:red;text-align:center;font-family: Times New Roman;'>Your email must include '@' and '.' for example: Super123@gmail.com</h3></br>";
    }
    elseif($pass!=$cpass){
      echo"<h3 style='color:red;text-align:center;font-family: Times New Roman;'>Password and Confirm Password are not identical.</h3></br>";
    }
     $checkuser="SELECT * From users where user='$user'";
     $result=$conn->query($checkuser);
    if($result->num_rows>0){
        echo "<h3 style='color:red;text-align:center;font-family: Times New Roman;'>Username Already Exists !</h3></br>";
     }
     $checkemail="SELECT * From users where email='$email'";
     $resulte=$conn->query($checkemail);
    if($resulte->num_rows>0){
        echo "<h3 style='color:red;text-align:center;font-family: Times New Roman;'>Email Already Exists !</h3></br>";
     }
     if(preg_match($passcheck,$pass) && preg_match($emailcheck,$email) && $resulte->num_rows===0 && $result->num_rows===0 && $pass==$cpass){
        $insertQuery="INSERT INTO users(id,email,user,pass,category)
                       VALUES (null,'$email','$user','$pass','$catag')";
            if($conn->query($insertQuery)==TRUE){
                header("location: login.php");
                exit();
            }
            else{
                echo "Error:".$conn->error;
                exit();
            }
     }
}
?>