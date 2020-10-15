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

	     $count_supp=$cto_db->select("*","govofsaudi");//get all row and count it


	     $endpage=is_float($count_supp/20)?intval($count_supp/20)+1:$count_supp/20;//numbers of pages

	     $page=isset($_GET['page'])&&is_numeric($_GET['page'])&&$_GET['page']>0&&$_GET['page']<=$endpage?$_GET['page']:1;
		 $page_next=$page+1;//the next page

		 $page_prev=$page-1;//the last page

		 $start_page=($page-1)*20; 

		 $fetch_limt_data=$cto_db->select_p("*","govofsaudi ORDER BY `govofsaudi`.`id` DESC",$start_page,20);


 


	     echo "<br> <h3 align='center'>محافظات التطوع</h3>";
		 echo "<div class='suppliers'>";
          ?>
				<div class="btn_for_add_suppliers">
					<a href="?do=<?php echo md5('add_d'); ?>" class="btn btn-primary ">اضافة  محافظة <span class="	glyphicon glyphicon-plus"></span></a>
				</div>	
				<br>
			 
          <?php
				 echo "<table class='table table-hover'>";
					echo "<thead>";
						echo "<tr>";
							echo"<th>الاسم</th>";
					 
							echo"<th>تاريخ الانشاء</th>";

							echo"<th>التحكم</th>";
						echo "</tr>";
					echo "</thead>";
					echo "<tbody>";

				         foreach ($fetch_limt_data as $data) {
				         	$date=DateTime::createFromFormat(" Y-m-d H:i:s",$data['date']);

				            
				         	echo "<tr>";
					         	 
					         	   echo "<td>".$data['name']."</td>";
					         
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
		   $check=$cto_db->select("id","govofsaudi","id=$id");
		   if ($check>0) 
		   {
		   	 $get_info_byid=$cto_db->select("*","govofsaudi","id=$id","fetch");

		   	  

 
 
		     ?> 
		       ,
		       <h3 align='center'> التعديل على المحافة </h3>
				  <div class="supp_edit_form">      
					<form  action="<?php echo $_SERVER['PHP_SELF']."?do=edit_d" ?>" method="POST">
					    
				      <div class="form-group">

						<label for=" ">الاسم</label>

						<input class="form-control" type='text' name="name"  placeholder="الاسم" value="<?php echo $get_info_byid['name'] ?>" >    

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
			 redirect($msg,$url,1);
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
		                                         isset($_POST['name']) 
		                                       
		                                      
		                                            ){

 

			$id=$_POST['id'];
			$check=$cto_db->select("id","govofsaudi","id=$id");
            

			if ($check>0) {

				 $name=filter_var(trim($_POST['name']),FILTER_SANITIZE_STRING);


				 



                 $data=array('name'  => $name); 

                 $upd=$cto_db->Edit("govofsaudi",$data,"id=$id");

                 if($upd=="yes"){
						$msg="<div class='_alert alert alert-success'>Done</div>";
						$url="back";
						redirect($msg,$url,1);
				 }else{
					$msg="<div class='_alert alert alert-danger'>Error</div>";
					$url="back";
					redirect($msg,$url,1);
				 }
	            

			}else{
		   	 $msg="<div class='_alert alert alert-danger'>ERROR NO ID LIKE THIS </div>";
		   	 echo $msg;
		      } 



	}//end of elseif($_SERVER['REQUEST_METHOD']=="POST"

	elseif(isset($_GET['do']) and $_GET['do']==md5('add_d')) {
              $getall_prog=$cto_db->select("id,name","volunteertype",null,"fetchAll");
		     $gov_ =$cto_db->select("id,name","govofsaudi",null,"fetchAll");
		   
		     ?>  <h3 align="center">اضافة  محافظة  </h3>
				  <div class="supp_edit_form">      

					<form  action="<?php echo $_SERVER['PHP_SELF']."?do=".md5('add_dd') ?>" method="POST">
					    <div class="form-group">
							<label for=" ">الاسم</label>
							<input class="form-control" type='text' name="name" placeholder="الاسم"  >     
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
											     	isset($_POST['name'])   )
		       {
	 
						$name=filter_var(trim($_POST['name']),FILTER_SANITIZE_STRING);

 
            
							$se=array('name',"date");
							$qfv="?,now()";

							$value=array($name);

							$ins=$cto_db->insert("govofsaudi",$se,$qfv,$value);

							if($ins=="yes"){
								$msg="<div class='_alert alert alert-success'>Done</div>";
								$url="back";
								redirect($msg,$url,1);
							}else{
								$msg="<div class='_alert alert alert-danger'>Error</div>";
								$url="back";
								redirect($msg,$url,1);
							}
                 

	}//end of elseif($_SERVER['REQUEST_METHOD']=="POST"
    elseif(isset($_GET['do']) and $_GET['do']==md5('delete')  and isset($_GET['id']) and is_numeric($_GET['id']) ){
			$id=$_GET['id'];


			$check=$cto_db->select("id","govofsaudi","id=$id");
			if ($check>0) {
				
			  $del=$cto_db->delete_r("govofsaudi","id",$id);
			  if($del=="yes"){
							$msg="<div class='_alert alert alert-success'>Done</div>";
							$url="back";
							redirect($msg,$url,1);
			  }else{
						$msg="<div class='_alert alert alert-danger'>Error</div>";
						$url="back";
						redirect($msg,$url,1);
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