<?php
 
session_start();
 
 
$pageTitle='Dashboard';
include "int.php";  
include "imp.php";

include "includs/temp/Navbar.php";
$do='';

$dir="admin/uploads/";
echo "<div class='container-fluid miancont'>";
 
  if ($_SERVER['REQUEST_METHOD']=="POST" && 
                                            isset($_POST['name'])
                                     
                                         && 
                                            isset($_POST['email'])
                                          
                                         && 
                                            isset($_POST['Phone'])  

                                         && 
                                            isset($_POST['note'])  
                       
 
                                             ) {



      $name=filter_var(trim($_POST['name']),FILTER_SANITIZE_STRING);

      $email=filter_var(trim($_POST['email']),FILTER_SANITIZE_EMAIL);

      $note=filter_var(trim($_POST['note']),FILTER_SANITIZE_STRING);

      $Phone=trim($_POST['Phone']);




     

      if (strlen($Phone)>11) {
          $errorPhone="<div class='_alert alert alert-danger'>رقم الهاتف لا يجب ان يكون اكثر من 11 حرف</div>";
      }else{
              $se=array('name','email','Phone','note',"date");

              $qfv="?,?,?,?,now()";

              $value=array($name,$email,$Phone,$note); 

              $ins=$cto_db->insert("contactus",$se,$qfv,$value);

              if($ins=="yes"){

               echo "<div class='err_a alert alert-success col-sm-12 col-xs-12 col-md-12 col-lg-12'>تم الارسال شكراً لك على التواصل معنا</div>";

              }else{
               

              }

      }

      
 
     

  }

   
    ?>
     
      <div class="ContactUs">
                <form id="contact" action="" method="post">
                    <h3 align="center">تواصل معنا</h3>
                     
                    <fieldset>
                         <input  placeholder="الاسم" type="text" tabindex="1" name="name" required autofocus>
                    </fieldset>
                    <fieldset>
                    <input  placeholder="الايميل" type="email" tabindex="2" name="email" required>
                    </fieldset>
                    <fieldset>
                    <input placeholder="رقم الهاتف (اختياري)" type="tel" tabindex="3" name="Phone">

                      <?php

                                   if (isset($errorPhone)) {
                                      echo $errorPhone;
                                   }
                       ?>
                    </fieldset>
                   
                    <fieldset>
                    <textarea required="" placeholder="اكتب رسالتك هنا....." tabindex="5" name="note" required></textarea>
                    </fieldset>
                    <fieldset>
                       <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">ارسال</button>
                    </fieldset>
                     
                </form>

      </div>
  

    <?php
 
echo "</div>";//end of contaner 
include $tpl.'footer.php';
 
 
 
 
 