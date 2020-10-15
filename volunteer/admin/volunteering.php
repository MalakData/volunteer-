<?php
session_start();
if (isset($_SESSION['permission']) and $_SESSION['permission']==0)//0for admin
 { 
$pageTitle='Customers';
include "int.php";	
include "imp.php";

include "includs/temp/Navbar.php";
$do='';

echo "<div class='container'>";

	if(isset($_GET['do']) and $_GET['do']=='rv'){

	     $count_supp=$cto_db->select("*","requestsforvolition");//get all row and count it


	     $endpage=is_float($count_supp/20)?intval($count_supp/20)+1:$count_supp/20;//numbers of pages

	     $page=isset($_GET['page'])&&is_numeric($_GET['page'])&&$_GET['page']>0&&$_GET['page']<=$endpage?$_GET['page']:1;
		 $page_next=$page+1;//the next page

		 $page_prev=$page-1;//the last page

		 $start_page=($page-1)*20; 

		 $fetch_limt_data=$cto_db->select_p("*","requestsforvolition ORDER BY `requestsforvolition`.`id` DESC",$start_page,20);


 


	     echo "<br> <h3 align='center'>  التطوع</h3>";
		 echo "<div class='suppliers'>";
          ?>
				<div class="btn_for_add_suppliers">
					<a href="?do=<?php echo md5('add_d'); ?>" class="btn btn-primary ">اضافة  طلب تطوع <span class="	glyphicon glyphicon-plus"></span></a>
				</div>	
				<br>
			 
          <?php

          // echo "<pre>";
          //    print_r($fetch_limt_data);
          // echo "</pre>";
				 echo "<table class='table table-hover'>";
					echo "<thead>";
						echo "<tr>";
							echo"<th>برنامج التطوع </th>";
							echo"<th>المحافظة</th>";
							echo"<th>العدد المطلوب</th>";
							echo"<th>عدد الطلبات</th>";
							echo"<th>تاريخ الانشاء</th>";

							echo"<th>التحكم</th>";
						echo "</tr>";
					echo "</thead>";
					echo "<tbody>";

				         foreach ($fetch_limt_data as $data) {
				         	$date=DateTime::createFromFormat(" Y-m-d H:i:s",$data['date']);

				            $progType=$cto_db->select("id,name","volunteertype","id='{$data['typeOfvolunteer']}'","fetch");

				            $gov=$cto_db->select("id,name","govofsaudi","id='{$data['gov']}'","fetch");


				          
             

				         	echo "<tr>";
					         	 echo "<td>".$progType['name']."</td>";
					         	 
					         	 echo "<td>".$gov['name']."</td>";
					         
					         	   echo "<td>".$data['number']."</td>";


					         	   echo "<td>".$data['requestNumber']."</td>";
					         	 echo "<td>".$date->format("Y")."/".lang1($date->format("M"))."/".lang1($date->format("D"))."(".$date->format("d").")"."</td>";
					         	 echo "<td class='control'>";
					         	       echo "<a href='?do=edit&id=".$data['id']."' ><span class='glyphicon glyphicon-pencil'></span></a>";
					         	       echo "<a href='?do=".md5('delete')."&id=".$data['id']."'class='confirm'><span class='glyphicon glyphicon-remove'></span></a>";
					         	 echo "</td>";
				         	echo "</tr>";
				         	 
				         }
		        echo "</tbody>";
		        echo "</table>";
        echo "</div>";

        ?>

 
      <div class="list-bar">
 	               
 	               	   	    <?php 
                                     echo'<span class="menu-bar pull-left"><a href="?do=rv&page=1">1</a></span>'; 

                                      for ($i=$page-3; $i <= $page+3 ; $i++) { 
                                      	     
                                      	     if ($i > 1 && $i <$endpage ) {
                                      	     	  if ($i != $page) {
                                      	     	  	  echo'<span class="menu-bar"><a href="?do=rv&page='.$i.'">'.$i.'</a></span>';
                                      	     	  }else{
                                      	     	  	echo "<span class='selectted_m'>".$i."</span>";
                                      	     	  }
                                      	     }
                                      }
                                     if ($page != $endpage && $endpage>0) {
                                     	   echo'<span class="menu-bar pull-right"><a href="?do=rv&page='.$endpage .'">'.$endpage .'</a></span>';
                                     }
                                  
 	               	   	     ?>
 	               	 
 	    </div>
	 
	     
     	   
    
<?php
	}//end of $_Get['do'] line 12
	//start customers edit page   "GET"
	elseif(isset($_GET['do']) and $_GET['do']=='edit' and isset($_GET['id']) and is_numeric($_GET['id'])) {
		   $id=$_GET['id'];
		   $check=$cto_db->select("id","requestsforvolition","id=$id");
		   if ($check>0) 
		   {
		   	 $get_info_byid=$cto_db->select("*","requestsforvolition","id=$id","fetch");

		   	 $getall_prog=$cto_db->select("id,name","volunteertype",null,"fetchAll");
		     $gov_ =$cto_db->select("id,name","govofsaudi",null,"fetchAll");

 
 
		     ?> 
		       ,
		       <h3 align='center'> التعديل على طلب  التطوع </h3>
				  <div class="supp_edit_form">      
					<form  action="<?php echo $_SERVER['PHP_SELF']."?do=edit_d" ?>" method="POST">
					    
				        <div class="form-group">
							<label for=" ">المحافظة	</label>
							<?php
                                   
			                      echo '<select class="selectpicker form-control" name="name_gov" value="">';
			                      echo '<option value="0">--------</option>';
			                      foreach ($gov_ as $data) {

			                         if ($data['id']==$get_info_byid['gov']) {
			                         	 echo '<option selected value="'.$data['id'].'">'.$data['name'].'</option>';
			                         }else{
			                         	  echo '<option value="'.$data['id'].'">'.$data['name'].'</option>';
			                         }

			                       }                     

			                      echo "</select>";

                             ?>
						</div>

						<div class="form-group">
							<label for=" ">برنامج التطوع	</label>
							 
            
							<?php
                                   
			                      echo '<select class="selectpicker form-control" name="typeOfvolunteer" value="">';
			                      echo '<option value="0">--------</option>';
			                      foreach ($getall_prog as $data) {

			                         if ($data['id']==$get_info_byid['typeOfvolunteer']) {
			                         	 echo '<option selected value="'.$data['id'].'">'.$data['name'].'</option>';
			                         }else{
			                         	  echo '<option value="'.$data['id'].'">'.$data['name'].'</option>';
			                         }

			                       }                     

			                      echo "</select>";

                             ?>
        
						</div>

						<div class="form-group">

							<label for=" ">العدد	</label>
							<input onkeyup="num_only(this)" type="number" class="form-control" name="number" id="formGroupExampleInput" value="<?php echo $get_info_byid['number'] ?>">

							<input  class="btn btn-primary pull-left" type="hidden" name='id' value="<?php echo $get_info_byid['id'] ?>">
						</div>

					 
					 
						<input  class="btn btn-primary pull-left" type="submit" value="تعديل">
					</form>
				</div>
			<?php         
		   }//end of if ($check>0)  line 86
		   else{
		   	 $msg="<div class='_alert alert alert-danger'>ERROR NO ID LIKE THIS </div>";
			 $url="back";
			 redirect($msg,$url,2);
		   } 
	 
	}
	//start customers edit get POST request from customers.php?do=edit&id=?
	elseif($_SERVER['REQUEST_METHOD']=="POST" and 
		                                         isset($_GET['do']) 
		                                      and 
		                                         isset($_POST['id']) 
		                                      and   
		                                         is_numeric($_POST['id']) 
		                                      and   
		                                         $_GET['do']=='edit_d'
		                                      and 
		                                         isset($_POST['name_gov']) 
		                                       
		                                      and 
		                                         isset($_POST['typeOfvolunteer'])
		                                      and 
		                                         isset($_POST['number'])
		                                      and   
		                                         is_numeric($_POST['number'])
		                                            ){

 

			$id=$_POST['id'];
			$check=$cto_db->select("id","requestsforvolition","id=$id");
            

			if ($check>0) {

				 $typeOfvolunteer=filter_var(trim($_POST['typeOfvolunteer']),FILTER_SANITIZE_NUMBER_INT);


				 $gov=filter_var(trim($_POST['name_gov']),FILTER_SANITIZE_NUMBER_INT);


				 $number=filter_var(trim($_POST['number']),FILTER_SANITIZE_NUMBER_INT);



                 $data=array('typeOfvolunteer'  => $typeOfvolunteer , 
                 	         "gov"=> $gov,
                 	         "number" => $number); 

                 $upd=$cto_db->Edit("requestsforvolition",$data,"id=$id");

                 if($upd=="yes"){
						$msg="<div class='_alert alert alert-success'>Done</div>";
						$url="back";
						redirect($msg,$url,2);
				 }else{
					$msg="<div class='_alert alert alert-danger'>Error</div>";
					$url="back";
					redirect($msg,$url,2);
				 }
	            

			}else{
		   	 $msg="<div class='_alert alert alert-danger'>ERROR NO ID LIKE THIS </div>";
		   	 echo $msg;
		      } 



	}//end of elseif($_SERVER['REQUEST_METHOD']=="POST"

	elseif(isset($_GET['do']) and $_GET['do']==md5('add_d')) {
              $getall_prog=$cto_db->select("id,name","volunteertype",null,"fetchAll");
		     $gov_ =$cto_db->select("id,name","govofsaudi",null,"fetchAll");
		   
		     ?> 

		     <h3 align="center">اضافة  طلب تطوع </h3>
				  <div class="supp_edit_form">      
					<form  action="<?php echo $_SERVER['PHP_SELF']."?do=".md5('add_dd') ?>" method="POST">
					    <div class="form-group">
							<label for=" ">المحافظة	</label>
							<?php
                                   
			                      echo '<select   class="selectpicker form-control" name="name_gov" required>';
			                      echo '<option value="0">--------</option>';
			                      foreach ($gov_ as $data) {

			                   
			                         	  echo '<option value="'.$data['id'].'">'.$data['name'].'</option>';
			                       

			                       }                     

			                      echo "</select>";

                             ?>
						</div>

						<div class="form-group">
							<label for=" ">برنامج التطوع	</label>
							 
            
							<?php
                                   
			                      echo '<select   class="selectpicker form-control" name="typeOfvolunteer" required>';
			                      echo '<option  >--------</option>';
			                      foreach ($getall_prog as $data) {

			                     
			                         	  echo '<option value="'.$data['id'].'">'.$data['name'].'</option>';
			                      

			                       }                     

			                      echo "</select>";

                             ?>
        
						</div>

						<div class="form-group">

							<label for=" ">العدد	</label>
							<input required onkeyup="num_only(this)" type="number" class="form-control" name="number" id="formGroupExampleInput" value="<?php echo $get_info_byid['number'] ?>">

						 
						</div>
					 
						<input  class="btn btn-primary pull-left" type="submit" value="اضافة ">
					</form>
				</div>
			<?php         
		    
	 
	}//end of elseif(isset($_GET['do']) and $_GET['do']=='add')
	 elseif($_SERVER['REQUEST_METHOD']=="POST" and 
		                                             isset($_GET['do']) 
			                                      and   
			                                         $_GET['do']==md5('add_dd')
			                                      and 
												isset($_POST['name_gov']) 

												and 
												isset($_POST['typeOfvolunteer'])
												and 
												isset($_POST['number'])
												and   
												is_numeric($_POST['number'])   )
		       {
	 
						$typeOfvolunteer=filter_var(trim($_POST['typeOfvolunteer']),FILTER_SANITIZE_NUMBER_INT);


						$gov=filter_var(trim($_POST['name_gov']),FILTER_SANITIZE_NUMBER_INT);


						$number=filter_var(trim($_POST['number']),FILTER_SANITIZE_NUMBER_INT);

			             


            
							$se=array('typeOfvolunteer',"gov",'number',"date");
							$qfv="?,?,?,now()";

							$value=array($typeOfvolunteer,$gov, $number);

							$ins=$cto_db->insert("requestsforvolition",$se,$qfv,$value);

							if($ins=="yes"){
								$msg="<div class='_alert alert alert-success'>Done</div>";
								$url="back";
								redirect($msg,$url,2);
							}else{
								$msg="<div class='_alert alert alert-danger'>Error</div>";
								$url="back";
								redirect($msg,$url,2);
							}
                 

	}//end of elseif($_SERVER['REQUEST_METHOD']=="POST"
    elseif(isset($_GET['do']) and $_GET['do']==md5('delete')  and isset($_GET['id']) and is_numeric($_GET['id']) ){
			$id=$_GET['id'];


			$check=$cto_db->select("id","requestsforvolition","id=$id");
			if ($check>0) {
				
			  $del=$cto_db->delete_r("requestsforvolition","id",$id);
			  if($del=="yes"){
							$msg="<div class='_alert alert alert-success'>Done</div>";
							$url="back";
							redirect($msg,$url,2);
			  }else{
						$msg="<div class='_alert alert alert-danger'>Error</div>";
						$url="back";
						redirect($msg,$url,2);
			  }
			}else{
		   	 $msg="<div class='_alert alert alert-danger'>ERROR NO ID LIKE THIS </div>";
		   	 echo $msg;}

    } 
	
echo "</div>";//end of contaner 
include $tpl.'footer.php';

 }else{
 	header('location:index.php');
    exit();
 }