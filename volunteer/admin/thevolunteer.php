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

	     $count_supp=$cto_db->select("*","thevolunteer");//get all row and count it


	     $endpage=is_float($count_supp/20)?intval($count_supp/20)+1:$count_supp/20;//numbers of pages

	     $page=isset($_GET['page'])&&is_numeric($_GET['page'])&&$_GET['page']>0&&$_GET['page']<=$endpage?$_GET['page']:1;
		 $page_next=$page+1;//the next page

		 $page_prev=$page-1;//the last page

		 $start_page=($page-1)*20; 

		 $fetch_limt_data=$cto_db->select_p("*","thevolunteer ORDER BY `thevolunteer`.`id` DESC",$start_page,20);


 


	     echo "<br> <h3 align='center'>المتطوعين</h3>";
		 echo "<div class='suppliers'>";
          ?>
				 
			 
          <?php
				 echo "<table class='table table-hover'>";
					echo "<thead>";
						echo "<tr>";
							echo"<th>الايميل</th>";
							echo"<th>اسم المتطوع</th>";
					 
							echo"<th>تاريخ التطوع</th>";

							echo"<th>التحكم</th>";
						echo "</tr>";
					echo "</thead>";
					echo "<tbody>";

				         foreach ($fetch_limt_data as $data) {
				         	$date=DateTime::createFromFormat(" Y-m-d H:i:s",$data['date']);

				            
				         	echo "<tr>";
					         	   echo "<td>".$data['email']."</td>";
					         	   echo "<td>".$data['name']."</td>";
					         
					         	 echo "<td>".$date->format("Y")."/".lang1($date->format("M"))."/".lang1($date->format("D"))."(".$date->format("d").")"."</td>";
					         	 echo "<td class='control'>";
					         	       
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
 
    elseif(isset($_GET['do']) and $_GET['do']==md5('delete')  and isset($_GET['id']) and is_numeric($_GET['id']) ){
			$id=$_GET['id'];


			$check=$cto_db->select("id","thevolunteer","id=$id");
			if ($check>0) {
				
			  $del=$cto_db->delete_r("thevolunteer","id",$id);
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