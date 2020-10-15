<?php
session_start();
 
$pageTitle='Customers';
include "int.php";	
include "imp.php";

include "includs/temp/Navbar.php";
$do='';
$dir="admin/uploads/";
$target = 'uploads/';

echo "<div class='container miancont'>";

	if(isset($_GET['do']) and $_GET['do']=='rv'){

	     $count_supp=$cto_db->select("*","volunteertype");//get all row and count it


	     $endpage=is_float($count_supp/20)?intval($count_supp/20)+1:$count_supp/20;//numbers of pages

	     $page=isset($_GET['page'])&&is_numeric($_GET['page'])&&$_GET['page']>0&&$_GET['page']<=$endpage?$_GET['page']:1;
		 $page_next=$page+1;//the next page

		 $page_prev=$page-1;//the last page

		 $start_page=($page-1)*20; 

		 $fetch_limt_data=$cto_db->select_p("*","volunteertype ORDER BY `volunteertype`.`id` DESC",$start_page,20);


 


	     echo "<br> <h3 align='center'>البرامج التطوعية</h3>";
		 echo "<div class='listVolunteerPrograms'>";
                       echo "<ul>"; 

                               foreach ($fetch_limt_data as  $value) {
                               	    echo "<li class='col-xs-12 col-sm-3 '>";
										echo '<img class=" " src="'.$dir.$value['image'].'"  >';
										echo "<p>".$value['name']."</p>";
                               	    echo "</li>";
                               }

                       echo "</ul>";
				  
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
	
echo "</div>";//end of contaner 
include $tpl.'footer.php';

 