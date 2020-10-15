<?php
session_start();
 
$pageTitle='Customers';
include "int.php";	
include "imp.php";

include "includs/temp/Navbar.php";
$do='';
$dir="admin/uploads/";
$target = 'uploads/';


 if (!isset($_SESSION['permission']) || $_SESSION['permission']==0 ) {
 
    header('location: index.php');
    exit();
 }



 

if ($_SERVER['REQUEST_METHOD']=="POST" && 
                                            isset($_POST['gov'])
                                         && 
                                           is_numeric($_POST['gov'])
                                         &&
                                           isset($_POST['name_sup'])
                                     
                                         && 
                                           is_numeric($_POST['name_sup'])
                                         
                                           
 
                                             ) {


 
          $gov=filter_var(trim($_POST['gov']),FILTER_SANITIZE_NUMBER_INT);

          $id=filter_var(trim($_POST['name_sup']),FILTER_SANITIZE_NUMBER_INT);

          


          $checkF=$cto_db->select("id,gov","requestsforvolition","id=? AND gov=?",null,array($id,$gov)); 


 
 

          if ($checkF>0) {

                  $se=array('rv','volunteer',"date");
                    $qfv="?,?,now()";

                    $value=array($id,$_SESSION['ID_user']);

                    $ins=$cto_db->insert("requestvolunteer",$se,$qfv,$value);

                    if($ins=="yes"){
                      $msg="<div class='_alert alert alert-success'>تم اضافة طلب التطوع </div>";
                      $url="back";
                      redirect($msg,$url,1);
                    }else{
                      $msg="<div class='_alert alert alert-danger'>حدث خطأ  يرجى المحاولة مرة أخرى</div>";
                      $url="back";
                      redirect($msg,$url,1);
                    }
          
          }else{

                    $msg="<div class='_alert alert alert-danger'>حدث خطأ  يرجى المحاولة مرة أخرى</div>";
                    $url="back";
                    redirect($msg,$url,1);
          }

        




    }


echo "<div class='container'>";

	if(isset($_GET['do']) and $_GET['do']=='rv'){

      


      $gov_=$cto_db->select("DISTINCT gov","requestsforvolition"," requestsforvolition.requestNumber < requestsforvolition.number","fetchAll");



	  ?>
      <div class='mainsignup'>
                  
              <form onsubmit="check(this.input)" id='signupd' class="signupd form-horizontal" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"> 


      
               <div class="form-group select_main_c">
                   <label for="formGroupExampleInput2"> المحافظة</label>
                      
                    <select class="selectpicker form-control" name="gov" value="">
                                <option value="0">--------</option>  
                             <?php 
                                    foreach ($gov_ as $value) {

                                      $goVM =$cto_db->select("id,name","govofsaudi","id='{$value['gov']}'","fetch");

                                      echo "<option value=".$goVM['id'].">".$goVM['name']."</option>";

                                    }
                                                         
                               ?>
                  </select>
          
            </div>

             <div class="form-group select_type_subcat">
                         
            </div>

            <div class="col-xs-3 pull-left"> 
                    <button type="submit" class="btn btn-primary btn-block">تطوع</button> 
                    </div> 
              </form>
       
                           </div>
                          <div id="dd">
                            
                          </div>

                   </div>
          

         </div>
    
<?php	} 
	
echo "</div>";//end of contaner 
include $tpl.'footer.php';

 