<?php
include("database.php");
if($_SERVER['REQUEST_METHOD']=="POST")
{
//    $name =$_POST['name'] ; 
   $email =$_POST['email'] ;
   $password =$_POST['password'] ;
   

}
if(!empty($email) && !empty($password))
{
    $query = "select * from form where name = '$email ' limit 1";
    $result = mysqli_query($conn,$query);


    if($result)
    {
        if($result && mysqli_num_rows($result)>0)
        {
             $u_data = mysqli_fetch_assoc($result);
             if($u_data['password']==$password)
             {
               echo "<script type='text/javascript'>alert('Login successfull' )</script>";
               header("location:index.html"); 
               die;
             }
        }
    } 
    echo "<script type='text/javascript'>alert('Email id and password does not match' )</script>";
}
else{
    echo "<script type='text/javascript'>alert('Email id does not exist,register first')</script>";

}


// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script type='text/javascript'>alert('Invalid email format' )</script>";
    exit;
}

// Validate age (minimum 10 years)
$dob =$_POST['dob'] ;
$currentDate = date('Y-m-d');
$ageLimitDate = date('Y-m-d', strtotime('-10 years', strtotime($currentDate)));
if ($dob >= $ageLimitDate) {
    echo "<script type='text/javascript'>alert('You must be at least 10 years old' )</script>";
    exit;
}