<?php
session_start();
$pageTitle='Login';
include "int.php";  
include "imp.php";

 
$do='';
echo "<div class='container'>";


 if (isset($_SESSION['permission'])and $_SESSION['permission']==1 ) {
 
    header('location: index.php');
    exit();
 }
 

 if ($_SERVER['REQUEST_METHOD']=='POST'and isset($_POST['user']) and isset($_POST['pass']) ) {
  
$user=filter_var(trim($_POST['user']),FILTER_SANITIZE_STRING);
$pass=filter_var(trim($_POST['pass']),FILTER_SANITIZE_STRING);
$hashpass=md5($pass);

  
   $get_users=$cto_db->select("*","thevolunteer","email=? AND pass=?","fetch",array($user,$hashpass));

   if (count($get_users) > 3) {

      
              $_SESSION['username']=$get_users['name']; 
              $_SESSION['ID_user']=$get_users['id']; 
              $_SESSION['permission']=1;
              header('location:index.php');
              exit(); 
     
   }
   else
   {
     $r="يرجى التأكد من صحة البريد الإلكتروني او الرقم السري";
   }
 }
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>LogIn</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<div class="hidden-sm logInBody">

   
    <form  class="   logind login" role="form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method='POST'> 
            <h2 class="title">تسجيل الدخول للمتطوعين </h2>
      <input autocomplete="off" class="form-control" type='text' name="user" placeholder="الايميل"  >         
      <input  class="form-control" type='password' name="pass" placeholder="الرقم السري"  >
        <div class="wrongmsg"><?php if(isset($r)){echo $r;}  ?></div>
       <input type="submit" class="btn btn-primary btn-block" value="تسجيل الدخول ">
      

     </form>

</div>  
 

<?php
echo "</div>";//end of contaner 
include $tpl.'footer.php';
