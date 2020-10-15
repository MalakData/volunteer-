<?php 

 session_start();
 include "imp.php";
 $Func ='includs/funcation/';
 include $Func .'Func.php';

 if ($_SERVER["REQUEST_METHOD"]=="POST") {


			if( isset($_POST['main_cat']) and is_numeric($_POST['main_cat'])){




			            $id=filter_var(trim($_POST['main_cat']),FILTER_SANITIZE_NUMBER_INT);



			       
			            $check=$cto_db->select("id,name","govofsaudi","id='{$id}'","fetch");

			                if (count($check)>1) {
			                         //get all subcat by id if main cat 
			                   $get_sup_cat=$cto_db->select("*","requestsforvolition","gov='{$id}' AND requestNumber < number","fetchAll");

			                    

 
	                                  echo ' <label for="formGroupExampleInput2">البرامج التطوعية فى '.$check['name'].'</label> <br>';
	                                  echo '<select class="selectpicker form-control" name="name_sup" value="">';
	                                  echo '<option value="-1">--------</option>';
	                                  foreach ($get_sup_cat as $data) {
									  $date=DateTime::createFromFormat(" Y-m-d H:i:s",$data['date']);

	                                  $progType=$cto_db->select("*","volunteertype","id='{$data['typeOfvolunteer']}'","fetch");


	                                  echo '<option value="'.$data['id'].'">'.$progType['name'].'</option>';

	                                  }                     
// ''.$date->format("Y")."/".lang1($date->format("M"))."/".lang1($date->format("D"))."(".$date->format("d").")" .
	                                  echo "</select>";
			                       

			                      
			                      }else{
			                       echo "<div class='_alert alert alert-danger'>ERROR NO ID LIKE THIS</div>";
			                      }

			           
			        
			            
			        }//to return subcat


 }

?>