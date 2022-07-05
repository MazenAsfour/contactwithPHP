<?php 
$servername="localhost";
$userserver="root";
$passworddatabase="";
$usererror='';
$emailerr='';
$msgerror='';
$done=null;
$valid=0;
error_reporting(0);
$conn=mysqli_connect($servername,$userserver,$passworddatabase);
if($conn){
    //echo "connection done";
}else{
    echo "No connection".mysqli_connect_error($conn);
}

if(isset($_GET['submit'])){

    if(empty($_GET['name'])){
     $usererror="<h1 class='err'>You must write your name</h1>";
    
    }
    if(strlen($_GET['name'])<4){
        $usererror="<h1 class='err'>Your name is short</h1>";
       }
    else if(!(preg_match("/[a-z][A-Z]/i",$_GET['name']))){
    $usererror="<h1 class='err'>your name must be latters</h1>";

    }
    else{
    $username=filter_var($_GET['name'],FILTER_SANITIZE_STRING);
       $usererror=null; 
}

     if(empty($_GET['email'])){
        $emailerr="<h1 class='err'>You must write your email</h1>";
        
     }
     else if(!(filter_var($_GET['email'],FILTER_VALIDATE_EMAIL))){
        $emailerr="<h1 class='err'>your email not valid</h1>";
     }
     else{
        $email=filter_var($_GET['email'],FILTER_SANITIZE_EMAIL);
        $emailerr=null;
     }

     if(empty($_GET['msg'])){
        $msgerror="<h1 class='err'>You must write your massege</h1>";
       }
       
       else if(!(preg_match("/[a-z][A-Z]/i",$_GET['msg']))){
       $msgerror="<h1 class='err'>your massege must be latters</h1>";
       }
       else if(strlen($_GET['msg'])<7){
        $msgerror="<h1 class='err'>Your massege is short</h1>";
       }
       else{
       $msg=filter_var($_GET['msg'],FILTER_SANITIZE_STRING);
       $msgerror=null;
        }

        if($usererror==null && $emailerr==null &&$msgerror==null){
            $done="<h1 class='done'> your massege is sent sucssefully</h1>";
            $valid=1;
            $database=mysqli_select_db($conn,'contact');
            if($database){

            }else{
                echo "failed select database";
            }
            $sql="INSERT INTO contact(username,email,massege) VALUES('$username','
            $email','$msg') ";
            if(mysqli_query($conn,$sql)){

            }
            else{
                echo "query not execute".mysqli_error($conn);
            }
            //emil("mazenasfour6@gmail.com,"contact",$msg,$header)
            
        }
            else{
            $valid=0;
            }
            

        
        
};



?>


<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Contact</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <section class="contact">

        <div class="container">
            <h1 class="header">Contact Me</h1>
            <h1 class=""><?php if($valid==1){
            echo $done;}?></h1>
            <form action="<?php echo $_SERVER['PHP_SELF']?>" >
                <h1 class="name">Name</h1>
                <input type="text" name="name" id="">
                <div id="error"><?php echo $usererror?></div>
                <h1 class="name">Email </h1>
                <input type="text" name="email" id="">
                <div><?php echo $emailerr;?></div>
                <h1 class="name">Massege</h1>
                <input type="text " rows="5"  name="msg" id="msg">
                <div><?php echo $msgerror?></div>
                <input type="submit" value="send" id="submit" name="submit">
            </form>
        </div>
    </section>
</body>
</html>