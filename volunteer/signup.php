<?php 

session_start();
 
 
$pageTitle='Sign up';
include "int.php";  
include "imp.php";
include "includs/temp/Navbar.php";
 
$do='';



 if (isset($_SESSION['permission'])and $_SESSION['permission']==1 ) {
 
    header('location: index.php');
    exit();
 }

 
echo "<div class='most-viewed'><div class='container-fluid'>";

if (!isset($_SESSION['user']['id'])) {


  if ($_SERVER['REQUEST_METHOD']=="POST" && 
                                            isset($_POST['name'])
                                     
                                         && 
                                            isset($_POST['email'])
                                         && 
                                            isset($_POST['pass'])  
                                         && 
                                            isset($_POST['Phone'])  

 
                                             ) {


 

    $name=filter_var(trim($_POST['name']),FILTER_SANITIZE_STRING);

    $email=filter_var(trim($_POST['email']),FILTER_SANITIZE_EMAIL);
    $pass1=filter_var(trim($_POST['pass']),FILTER_SANITIZE_STRING);
    $Phone=filter_var(trim($_POST['Phone']),FILTER_SANITIZE_NUMBER_INT);
 
    $error=array();
    $array_success=array();
    $count_email=$cto_db->select("email","thevolunteer","email=?",null,array($email)); 
 


 
 
     if ($count_email>0) {
        $error['email_f']="<div  aclass='err_a alert alert-danger col-sm-12  > هذا الايميل مسجل من قبل </div>";

       }
     
      
      if (strlen($name)<3) {
         $error['name_less']="<div class='err_a alert alert-danger col-sm-12'>  الاسم يجب أن يكون أكثر من 3 أحرف </div>";
      }
      if (strlen($name)>25) {
          $error['name_more']="<div class='err_a alert alert-danger  col-sm-12'>  الاسم يجب أن يكون أقل من 25 حرفًا </div>";
      }
      
      if (strlen($email)<10 || strlen($email)>50 ) {
         $error['email_er']="<div class='err_a alert alert-danger col-sm-12'>الرجاء كتابة الايميل صحيح</div>";
      }

      // if ($pass1==$pass2) {
        if (strlen($pass1)<8) {
           $error['pass1_less']="<div class='err_a alert alert-danger col-sm-12'> كلمة المرور يجب أن تكون أكثر من 8 أحرف </div>";
                   }
             
 
 
 

      if (empty($error)) {

 
      $se=array('name','pass','email','mobile',"date");

      $qfv="?,?,?,?,now()";

      $value=array($name,md5($pass1),$email,$Phone); 

      $ins=$cto_db->insert("thevolunteer",$se,$qfv,$value);

      if($ins=="yes"){
                header("Location:login.php");
                exit();
       
      }else{
       

      }


      }else{

           $array_success["no"]="<div class='err_a alert alert-danger col-sm-12 col-xs-12 col-md-12 col-lg-12'>حدث خطأ يرجى المحاولة مرة أخرى </div>";


      }

  }
 

 

 
?>
         

 
         <div class='mainsignup'>
                  
              <form onsubmit="check(this.input)" id='signupd' class="signupd form-horizontal" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"> 





                  <h1 class="center" style="padding-bottom:0"  align="center"> إنشاء حساب للمتطوعين</h1><br>



                   <div class="form-group"> 

                       
                        <div class="col-sm-12"> 


                          <input  autocomplete="off" type="text" required class="form-control" name="name" 
                           placeholder="الاسم"> 
   
                       
  
                   



                     <?php 
                                             if (isset($error['name_less'])) {
                                                echo $error['name_less'];
                                             }
                                            if (isset($error['name_more'])) {
                                                echo $error['name_more'];
                                             }

                                             
                                          ?>

                        </div> 
                    </div> 
              
                    <div class="form-group"> 

                       <div class="col-sm-12"> 


                          <input  autocomplete="off" type="email" required class="form-control" name="email" placeholder="الايميل" 
                           > 
   
                       </div> 
  
                     

                    </div> 


                 <div class="form-group"> 
                   
                    <div class="col-sm-12"> 
                    <input  autocomplete="off" type="password" required class="form-control" name="pass" 
                    placeholder="الرقم السري "   autocomplete="off"> 
                   

 
                    <?php 
                                               if (isset($error['pass1_less'])) {
                                                echo $error['pass1_less'];
                                                }
                                                if (isset($error['pass1_more'])) {
                                                echo $error['pass1_more'];
                                                }
                                              
                                         ?>
                  </div> 
                </div> 

                 <div class="form-group"> 
 

                      <div class="col-sm-12"> 
                        <input  autocomplete="off"  type="number" onblur="mobile_check(this.value)" required="" class="form-control" name="Phone"  
                        placeholder="رقم الهاتف"   > 
                      </div> 

                    </div> 
                  <div class="form-group"> 


                    <div class="  col-sm-12"> 
                    <button type="submit" class="btn btn-primary btn-block">إنشاء حساب </button> 
                    </div> 
                  </div> 
              </form>
       
                           </div>
                          <div id="dd">
                            
                          </div>

                   </div>
          

         </div>
         <br><br>

 
<?php
}else{
  header("Location: index.php");
  exit();
}
echo "</div></div>";//end of contaner 
include $tpl.'footer.php';




 
