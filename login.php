<?php
require_once "config.php";
$username = $password = $confirm_password = "";
$username_err=$password_err=$confirm_password_err = "";
if($_SERVER['REQUEST_METHOD']=="POST"){
    $sql = "SELECT id FROM users WHERE username=?";
    $stmt = mysqli_prepare($conn,$sql);
    if($stmt){
      mysqli_stmt_bind_param($stmt,"s",$param_username);
      //set value
      $param_username=trim($_POST['username']);
      //try execute
      if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt)==1){
          $username_err="error";
        }
        else{
          $username=trim($_POST['username']);
        }
      }
  }
  mysqli_stmt_close($stmt);
//check pwd
$password=trim($_POST['password']);
//check
//no error
if(empty($username_err)){
  $sql="INSERT INTO users (username,password) VALUES(?,?)";
  $stmt=mysqli_prepare($conn,$sql);
  if($stmt){
    mysqli_stmt_bind_param($stmt,"ss",$param_username,$param_password);
    //set
    $param_username=$username;
    $param_password=$password;
    //TRY QUERY
    if(mysqli_stmt_execute($stmt)){
      header("location: email.php");
    }
    else{
      echo "Something went wrong.. cannot redirect!";
    }
  mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}
else{
  echo "Username is already taken";
}
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Medical Healthcare</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><H3>Medical Healthcare</h3></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact Us</a>
        </li>
    </div>
  </div>
</nav>
<div class="container mt-4">
<form class="row g-3" action="" method="post">
  <div class="col-md-6">
    <label for="inputemail4" class="form-label">Email</label>
    <input type="email" class="form-control" name="username" id="inputusername4" placeholder=Email>
  </div>
  <div class="col-md-4">
    <label for="inputPassword4" class="form-label">Mobile Number</label>
    <input type="text" class="form-control" name="password" id="inputPassword4" placeholder="Mobile Number">
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
</div>
  </body>
</html>