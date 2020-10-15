<?php
 
session_start();
if (isset($_SESSION['permission']) and ($_SESSION['permission']==0)   )//0for admin
{ 

 
include "int.php";  
include "imp.php";

include "includs/temp/Navbar.php";
$do='';
echo "<div class='container-fluid'>";
 
   
    ?>
           
                   <div class="dashboard-stats container text-center">
         
              <div class="row">
                    <div class=" col-xs-12 col-md-3">
                         <div class="stat members">
                          <i class="fa fa-users "></i>
                             <div class="info">
                                عدد المتطوعين 
                              <span> <?php echo  $cto_db->select("*","thevolunteer"); ?> </span>
                             </div>
                         </div>
                    </div>
                     <div class=" col-xs-12 col-md-3">
                         <div class="stat pending">
                             <i class="fa fa-user-plus"></i>
                               <div class="info">
                                  عدد  طلبات التطوع
                              <span> 
                                        <?php echo  $cto_db->select("*","requestvolunteer"); ?>
                                </span>
                               </div>
                         </div>
                    </div>
                     <div class="col-xs-12 col-md-3">
                         <div class="stat items">
                          <i class=" fa fa-tags"></i>
                               <div class="info">
                                  عدد  البرامج التطوعية
                              <span>  
                                        <?php echo   $cto_db->select("*","volunteertype");   ?>
                                    
                               </span>
                               </div>
                         </div>
                    </div>
                     <div class="col-xs-12 col-md-3">
                         <div class="stat comments">
                              اجمالي التبرعات
                                <div class="info"> 
                                   
                                   <span> <?php echo 520 ?>
                                                
                                    </span>
                                </div>
                         </div>
                    </div>
              </div>
         </div>

          
        




    <?php
 
echo "</div>";//end of contaner 
include $tpl.'footer.php';

if(!isset($join_all_in_one)){
  $sp=$cto_db->join_all_in();//to increase  
}
 }else{
  header('location:index.php');
    exit();
 }
 
 
 