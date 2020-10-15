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
                                            isset($_POST['prog']) 

                                          && 
                                            is_numeric($_POST['prog']) 
                                         && 
                                            isset($_POST['amount']) 

                                        && 
                                            is_numeric($_POST['amount']) 
                    
 
                                             ) {



      $name=filter_var(trim($_POST['name']),FILTER_SANITIZE_STRING);

      $email=filter_var(trim($_POST['email']),FILTER_SANITIZE_EMAIL);


      $prog=filter_var(trim($_POST['prog']),FILTER_SANITIZE_NUMBER_INT);


      $amount=filter_var(trim($_POST['amount']),FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);



      $Phone=trim($_POST['Phone']);




 

      if (strlen($Phone)>11) {

          $errorPhone="<div class='_alert alert alert-danger'>رقم الهاتف لا يجب ان يكون اكثر من 11 حرف</div>";

      }else{
              $se=array('name','email','Phone','prog','amount',"date");

              $qfv="?,?,?,?,?,now()";

              $value=array($name,$email,$Phone,$prog,$amount); 

              $ins=$cto_db->insert("donation",$se,$qfv,$value);

              if($ins=="yes"){

               echo "<div class='err_a alert alert-success col-sm-12 col-xs-12 col-md-12 col-lg-12'>تم الارسال  </div>";

              }else{
               

              }

      }

      
 
     

  }

    $g_=$cto_db->select("*","volunteertype",null,"fetchAll");

   
    ?>
     
      <div class="ContactUs">
                <form id="contact" action="" method="post">
                    <h3 align="center">تبرع</h3>
                     
                    <fieldset>
                         <input  placeholder="الاسم" type="text" tabindex="1" name="name" required autofocus>
                    </fieldset>
                    <fieldset>
                    <input  placeholder="الايميل" type="email" tabindex="2" name="email" required>
                    </fieldset>
                    <fieldset>
                    <input placeholder="رقم الهاتف" type="tel" tabindex="3" name="Phone" required>

                      <?php

                                   if (isset($errorPhone)) {
                                      echo $errorPhone;
                                   }
                       ?>
                    </fieldset>
                   



                    


                    <fieldset>
                          <input  placeholder="المبلغ" type="number" tabindex="2" name="amount" required>
                    </fieldset>



                    <fieldset>

                    <label for="formGroupExampleInput2"> البرامج المتاحة</label>
                          <select class="selectpicker form-control" name="prog" value="">
                                <option value="0">--------</option>  
                             <?php 
                                    foreach ($g_ as $value) {

                                      echo "<option value=".$value['id'].">".$value['name']."</option>";

                                    }
                                                         
                               ?>
                  </select>
                    </fieldset>




                    <fieldset>
                       <button name="submit"  class="col-xs-12 col-sm-6" type="submit" id="contact-submit"  >تبرع</button>
                    </fieldset>
                     
                </form>

      </div>
  

    <?php
 
echo "</div>";//end of contaner 
include $tpl.'footer.php';
 
 
 
 
 