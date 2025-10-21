<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container" id="signIn">
        <h1 class="form-title">Sign In</h1>
        <form method="post" action="login.php">
          <div class="input-group">
              <i class="fas fa-user"></i>
              <input type="text" name="user" id="email" placeholder="Username">
              <label for="user">Username</label>
          </div>
          <div class="input-group">
              <i class="fas fa-lock"></i>
              <input type="password" name="password" id="password" placeholder="Password">
              <label for="password">Password</label>
          </div>
          <p class="recover">
            <a href="#">Recover Password</a>
          </p>
         <input type="submit" class="btn" value="Sign In" name="signIn">
        </form>
        <p class="or">
          ----------or--------
        </p>
        <div class="icons">
          <i class="fab fa-google"></i>
          <i class="fab fa-facebook"></i>
        </div>
        <div class="links">
          <p>Don't have account yet?</p>
          <button id="signInButton"><a href="register.php">Sign Up</a></button>
        </div>
      </div>
      <script src="design.js"></script>
</body>
</html>
<?php
include 'connect.php';
$categ = "staff";
if(isset($_POST['signIn'])){
   $user=$_POST['user'];
   $password=$_POST['password'];
   $sql="SELECT * FROM users WHERE user='$user' and pass='$password'";
   $result=$conn->query($sql);
   if (trim($user)=="" || trim($password)==""){
    echo ("<h3 style='color:red;text-align:center; font-family: Times New Roman;'>Missing information!</br></h3>");
    }
    else if($result->num_rows===0){
      echo "<h3 style='color:red;text-align:center; font-family: Times New Roman;'>Incorrect Username or Password</h3></br>";
     }
  

   if($user =="admin" && $password=="abc123"){
    session_start();
    $row=$result->fetch_assoc();
    $_SESSION['user']=$row['user'];
    header("Location: adminpage.php");
    exit();
   }
   $query = "SELECT category FROM users WHERE user = '$user' AND pass = '$password'";
   $stmt = mysqli_prepare($conn, $query);
   mysqli_stmt_execute($stmt);
   mysqli_stmt_bind_result($stmt, $category);
   if (mysqli_stmt_fetch($stmt)) {
       if ($category == 'staff') {
        session_start();
        header("Location: add_products.php");
        exit();
       }
      }
  if($result->num_rows>0){
    session_start();
    $row=$result->fetch_assoc();
    $_SESSION['user']=$row['user'];
    header("Location: shop_products.php");
    exit();
   }
}
?>