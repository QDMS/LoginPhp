<?php

$con = mysqli_connect('localhost', 'root', 'root', 'crazy endless flight');

if (mysqli_errno()){
    echo ("1");
    exit();
}

$appkey = $_POST["apppassword"];
if ($appkey != "tismhouse") {
    exit();
}

$username = $_POST["username"];
$usernameClean = filter_var($username, FILTER_SANITIZE_EMAIL);
$password = $_POST["password"];

$usernamecheckquery = "SELECT * FROM players WHERE username = '". $usernameClean ."';";
$usernamecheckresult = mysqli_query($con, $usernamecheckquery) or die ("2");

if ($usernamecheckresult->num_rows != 1){
    echo ("3");
    exit();
}else{
   $fetchedpassword = mysqli_fetch_assoc($usernamecheckresult)["password"];
   if (password_verify(($password), $fetchedpassword)){
       echo ("Successfully Logged In!");
   }else{
       echo ("4");
   }
}

//Error Codes
//1 - Database Connection Error;
//2 - Username query error;
//3 - Username not existing or there is more than 1 in the table
//4 - Password was not able to be verified

