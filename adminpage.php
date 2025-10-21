<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="adminstyle.css">
</head>
<body>
<h1 style='color:red;text-align:center;font-family: Times New Roman;'>Welcome Back Admin</h1>
<div class="container" id="signup">
      <h1 class="form-title">Create Accounts For Staff</h1>
      <form method="post" action="adminpage.php">
        <div class="input-group">
           <i class="fas fa-user"></i>
           <input type="text" name="user" id="fName" placeholder="Username">
           <label for="fname">Username</label>
        </div>
        <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="password" name="pass" id="password" placeholder="Password">
            <label for="password">Password</label>
        </div>
       <input type="submit" class="btn" value="Add Staff" name="AddStaff">
       <a class="linkk" href="logout.php">Logout</a>
      </form>
      
      </div>
</body>
</html>
<?php
include 'connect.php';
       if(isset($_POST['AddStaff'])){
       $user=$_POST['user'];
       $catag = "staff";
       $pass = $_POST['pass'];
       $passcheck = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()\-_=+{};:,<.>])(?=.*[A-Za-z\d!@#$%^&*()\-_=+{};:,<.>])[\w!@#$%^&*()\-_=+{};:,<.>]{8,}$/';
       if (trim($user)=="" || trim($pass)==""){
           echo ("<h3 style='color:red;text-align:center; font-family: Times New Roman;'>Missing information!</br></h3>");
       }
       elseif(!preg_match($passcheck,$pass)){
           echo "<h3 style='color:red;text-align:center; font-family: Times New Roman;'>Password must be at 
           least 8 characters long and contain at least one lowercase letter, one uppercase letter, one digit, and one special character.</br></h3>";
         }
       
        $checkuser="SELECT * From users where user='$user'";
        $result=$conn->query($checkuser);
        if($result->num_rows>0){
           echo "<h3 style='color:red;text-align:center;font-family: Times New Roman;'>Username Already Exists !</h3></br>";
        }
        if(preg_match($passcheck,$pass) && $result->num_rows===0){
           $insertQuery="INSERT INTO users(id,email,user,pass,category)
                          VALUES (null,'','$user','$pass','$catag')";
               if($conn->query($insertQuery)==TRUE){
                   echo"<h3 style='color:green;text-align:center;font-family: Times New Roman;'>$user has been added successfully!</h3></br>";
                   exit();
               }
               else{
                   echo "Error:".$conn->error;
                   exit();
               }
        }
   }
       ?>