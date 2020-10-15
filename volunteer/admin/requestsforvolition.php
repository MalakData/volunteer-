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

	     $count_supp=$cto_db->select("*","requestvolunteer");//get all row and count it


	     $endpage=is_float($count_supp/20)?intval($count_supp/20)+1:$count_supp/20;//numbers of pages

	     $page=isset($_GET['page'])&&is_numeric($_GET['page'])&&$_GET['page']>0&&$_GET['page']<=$endpage?$_GET['page']:1;
		 $page_next=$page+1;//the next page

		 $page_prev=$page-1;//the last page

		 $start_page=($page-1)*20; 

		 $fetch_limt_data=$cto_db->select_p("*","requestvolunteer ORDER BY `requestvolunteer`.`id` DESC",$start_page,20);


 


	     echo "<br> <h3 align='center'> طلبات المتطوعين </h3>";
		 echo "<div class='suppliers'>";
          ?>
				 
			 
          <?php

     
				 echo "<table class='table table-hover'>";
					echo "<thead>";
						echo "<tr>";
							echo"<th>	اسم المتطوع</th>";
							echo"<th>المحافظة</th>";
							echo"<th>برنامج التطوع</th>";
						 
							echo"<th >تاريخ الطلب</th>";

							echo"<th  >التحكم</th>";
						echo "</tr>";
					echo "</thead>";
					echo "<tbody>";

				         foreach ($fetch_limt_data as $data) {
				         	$date=DateTime::createFromFormat(" Y-m-d H:i:s",$data['date']);

								$prog=$cto_db->select("*","requestsforvolition","id='{$data['rv']}'","fetch");


								$progType=$cto_db->select("*","volunteertype","id='{$prog['typeOfvolunteer']}'","fetch");


								$gov=$cto_db->select("id,name","govofsaudi","id='{$prog['gov']}'","fetch");

								$volunteerName=$cto_db->select("id,name","thevolunteer","id='{$data['volunteer']}'","fetch");

				         

				            // 


				         	echo "<tr>";

								echo "<td>".$volunteerName['name']."</td>";
								echo "<td>".$gov['name']."</td>";
								echo "<td>".$progType['name']."</td>";
					         	 
					         	
					         
					          
					         	 
					         	 echo "<td>".$date->format("Y")."/".lang1($date->format("M"))."/".lang1($date->format("D"))."(".$date->format("d").")"."</td>";
					         	 echo "<td class='control'>";

					         	 
					         	       echo "<a href='?do=".md5('delete')."&id=".$data['id']."'class='confirm btn btn-danger col-xs-5'> مسح</a>";
                                         
                                         if ($data['stat']==0) {


											echo "<a class='btn btn-info col-xs-5' href='?do=accept&id=".$data['id']."' >قبول</a>";

											

                                         }elseif($data['stat']==1){
   
                                            echo "<a class='btn btn-warning col-xs-5' href='?do=refuse&id=".$data['id']."' >رفض</a>";
                                         }elseif($data['stat']==2){

                                         	 echo "<a class='btn btn-info  col-xs-5' href='?do=accept&id=".$data['id']."' >قبول</a>";
												
                                         }

					         	     




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
	} 
	 
	elseif( isset($_GET['do'])      and $_GET['do']=='refuse'
									 
									and 
									isset($_GET['id']) 
									and 
									is_numeric($_GET['id']) 
									 
		                                            ){

 
 
			$id=$_GET['id'];

			$check=$cto_db->select("*","requestvolunteer","id=$id","fetch");

			$idVol=$check['rv'];


			$numberOfvolunteering=$cto_db->select("id,number,requestNumber","requestsforvolition","id='{$idVol}'","fetch");



			$newNumber=$numberOfvolunteering['requestNumber']-1;

 

 

			if ($newNumber<0) {


			        	$msg="<div class='_alert alert alert-danger'>حدث خطأ   يرجى المحاولة مرة أخرى</div>";

						$url="back";

						redirect($msg,$url,2);
							exit();
			}





	 

			if (count($check)>1) {
				 


					$data=array('stat'  => 2 ); 

					$upd=$cto_db->Edit("requestvolunteer",$data,"id=$id");

					$data=array('requestNumber'  => $newNumber ); 

					$upd=$cto_db->Edit("requestsforvolition",$data,"id='{$idVol}'");
                 

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



	}

	elseif( isset($_GET['do'])      and $_GET['do']=='accept'
									 
									and 
									isset($_GET['id']) 
									and 
									is_numeric($_GET['id']) 
									 
		                                            ){

 
 
			$id=$_GET['id'];
			$check=$cto_db->select("*","requestvolunteer","id=$id","fetch");
			$idVol=$check['rv'];


           $numberOfvolunteering=$cto_db->select("id,number,requestNumber","requestsforvolition","id='{$idVol}'","fetch");


           
			$newNumber=$numberOfvolunteering['requestNumber']+1;


   
 
           if ($newNumber>$numberOfvolunteering['number']) {


                    	$msg="<div class='_alert alert alert-danger'>لا يمكن تنفيذ العملية العدد المطلوب اكتمل</div>";

						$url="back";

						redirect($msg,$url,2);
							exit();
           }


	 

  
	 

			if (count($check)>1) {

				 


                 $data=array('stat'  => 1 ); 

                 $upd=$cto_db->Edit("requestvolunteer",$data,"id=$id");


                 $data=array('requestNumber'  => $newNumber ); 

                 $upd=$cto_db->Edit("requestsforvolition",$data,"id='{$idVol}'");


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



	}
 
    elseif(isset($_GET['do']) and $_GET['do']==md5('delete')  and isset($_GET['id']) and is_numeric($_GET['id']) ){
			$id=$_GET['id'];


			$check=$cto_db->select("id","requestvolunteer","id=$id");
			if ($check>0) {
				
			  $del=$cto_db->delete_r("requestvolunteer","id",$id);
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