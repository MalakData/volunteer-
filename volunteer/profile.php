<?php 

session_start();
 
 
$pageTitle='تعديل الملف الشخصي';
include "int.php";  
include "imp.php";
include "includs/temp/Navbar.php";
 
$do='';



 if (!isset($_SESSION['permission'])and $_SESSION['permission']==0 ) {
 
    header('location: index.php');
    exit();
 }

 
echo "<div class='most-viewed'><div class='container-fluid'>";
 
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
    $count_email=$cto_db->select("email","thevolunteer","email=? AND id != '{$_SESSION['ID_user']}'" ,null,array($email)); 

  
 

 
 
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

      if (strlen($pass1)<8 && strlen($pass1)>1 ) {
           $error['pass1_less']="<div class='err_a alert alert-danger col-sm-12'> كلمة المرور يجب أن تكون أكثر من 8 أحرف </div>";
                   }


 

 

      if (empty($error)) {

        if (strlen($pass1)>1) {

      
                 $data=array('name'  => $name,
                             'pass'  => md5($pass1),
                             'email' => $email,
                             'mobile'=> $Phone); 

                 $upd=$cto_db->Edit("thevolunteer",$data,"id='{$_SESSION['ID_user']}'");
        }else{
         
                $data=array('name'  => $name,
                            'email' => $email,
                            'mobile'=> $Phone); 

                $upd=$cto_db->Edit("thevolunteer",$data,"id='{$_SESSION['ID_user']}'");
        }
    

      

      

        if($upd=="yes"){
            $_SESSION['username']=$name; 

            $msg="<div class='_alert alert alert-success'>تم</div>";
            $url="back";
            redirect($msg,$url,1);
        }else{
            $msg="<div class='_alert alert alert-danger'>حدث خط  يرجى المحاولة مرة أخرى</div>";
            $url="back";
            redirect($msg,$url,1);
        }


      }else{

           $array_success["no"]="<div class='err_a alert alert-danger col-sm-12 col-xs-12 col-md-12 col-lg-12'>حدث خطأ يرجى المحاولة مرة أخرى </div>";


      }

  }
 


  $thevolunteer=$cto_db->select("*","thevolunteer","id='{$_SESSION['ID_user']}'","fetch");


  
 
?>
         

 
         <div class='mainsignup'>
                  
              <form onsubmit="check(this.input)" id='signupd' class="signupd form-horizontal" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"> 





                  <h1 class="center" style="padding-bottom:0"  align="center"> تعديل الملف الشخصي</h1><br>



                   <div class="form-group"> 

                       
                        <div class="col-sm-12"> 


                          <input  autocomplete="off" type="text" required class="form-control" name="name" 
                           placeholder="الاسم" value="<?php echo $thevolunteer['name']; ?>"> 
   
                       
  
                   



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


                          <input  autocomplete="off" type="email" required class="form-control" name="email" placeholder="الايميل" value="<?php echo $thevolunteer['email']; ?>"> 
   
                       </div> 
  
                     

                    </div> 


                 <div class="form-group"> 
                   
                    <div class="col-sm-12"> 
                    <input  autocomplete="off" type="password"   class="form-control" name="pass" 
                    placeholder="الرقم السري "   autocomplete="off" > 


                   
                   
                   

 
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
                        <input  autocomplete="off"  type="number" onblur="mobile_check(this.value)" required="" class="form-control" name="Phone" placeholder="رقم الهاتف"   value="<?php echo $thevolunteer['mobile']; ?>" > 
                      </div> 

                    </div> 
                  <div class="form-group"> 


                    <div class="  col-sm-4"> 
                    <button type="submit" class="btn btn-primary btn-block">تعديل </button> 
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
 
echo "</div></div>";//end of contaner 
include $tpl.'footer.php';




 
