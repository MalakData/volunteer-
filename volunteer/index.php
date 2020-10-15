<?php
 
session_start();
 
 
$pageTitle='Dashboard';
include "int.php";  
include "imp.php";

include "includs/temp/Navbar.php";
$do='';

$dir="admin/uploads/";

echo "</div>";
 
 
   
    ?>
        <div class="main-slider">

                  <div class="container">
                     <div class="slider">
                  
                               
                                 <div class="item">
                                       <img     class=" " src="img/page1_img2.jpg"  >
                                 </div>
                                  <div class="item">
                                       <img    class=" " src="img/page1_img1.jpg"  >
                                 </div>
                                  <div class="item">
                                       <img    class=" " src="img/page1_img3.jpg"  >
                                 </div>
                                  <div class="item">
                                       <img    class=" " src="img/page4_img1.jpg"  >
                                 </div>
								  
								 
								 
								 
                                  
                                 
                                 
                                  
                   </div> 

                   </div>

        </div>





        
    

      <div class="Voluntaryprograms">


         <div class="container">
           
            <h1 class=""  align="center" style="margin:28px"> البرامج التطوعية</h1>

           <div class="rio-promos"> 
             

              
            
          <?php 


             $fetch_limt_data=$cto_db->select("*","volunteertype ORDER BY `volunteertype`.`id` DESC  LIMIT 5",null,"fetchAll");

             foreach ($fetch_limt_data as $value) {
               echo '<div class="item">';
                
               echo '<img class=" " src="'.$dir.$value['image'].'"  >';
               echo "<p>".$value['name']."</p>";
                 
               echo "</div>";
             }

             
          ?>
              
             
              
        </div>
         </div>
          

      </div>

 <div class="saidAboutus">

         <div class="container">
           

            <h1 class=""  align="center" style="margin:28px"> قالو عنا</h1>
           

        <div class="rio-promos-about-us"> 
             

              
          
                <div class="item"> 
                
                         <p> جمعية رعاية الاجيـــال الخيرية من الجمعيات الرائدة التـــي تعنى بالتأهيل المهاري والاجتماعي للشباب وتغرس فيهم القيم النبيلة والمعاني السامية من خلال برامج متعددة هادفة بما يرتقي بفكرهم ويجعلهم ســـواعد بناء فاعلة ، كمـــا انها تولي اهتماما خاصا ببعض فئات المجتمع الاخرى ، ومنها الأيتام ونزلاء دار الملاحظة و ذوي الاحتياجات الخاصة ، وتســـعى من خلال برامجها لبناء الجوانب الشخصية و الاجتماعية لديهم وتمكينهم من المهارات المتنوعة ، مما يجعلهم قادرين على النجاح والتأثير الإيجابي في المجتمع باذن الله .</p> 
                 
                 </div> 

                 <div class="item"> 
                
                         <p> جمعية رعاية الاجيال بجدة تقوم بنشاط وقفي على رعاية الأيتام و نزلاء دار الملاحظة و ذوي الاحتياجات الخاصة و تنمية الشباب و لهم وقف اسمه وقف الوالدين قيمة الوقف عشـــرون مليوناً بقي منها ثمان مليـــون تنتظر أهل الخير ودعم أهل الفضل والاحسان جعل الله ذلك في ميزان حسناتكم وتقبل منا ومنكم و بيض الله وجه من دعم ومن أعطى و جعله في ميزان حسناته وغفر له و لوالديه ولنا جميعاً .</p> 
                 
                 </div> 

                 <div class="item"> 
                
                         <p> صراحة نحن سعداء مما شـــاهدناه اليوم من عرض لبرامج الجمعية حيث تستهدف فئة هامة هذه الفئة التي يجب أن نركز ونهتم باحتياجاتها 24 إلى سن 13وهي فئة الشباب من سن ونطورها ونأهلها ونستغل جميع الطاقات والمواهب الموجودة فيهم ، كل الشكر لرئيس مجلس الإدارة الجمعية وأعضاء مجلس الإدارة عل جهودهم ونسأل الله أن يبارك لهم في عملهم.</p> 
                 
                 </div> 

                 <div class="item"> 
                
                         <p> جمعية رعاية الاجيـــال الخيرية من الجمعيات الرائدة التـــي تعنى بالتأهيل المهاري والاجتماعي للشباب وتغرس فيهم القيم النبيلة والمعاني السامية من خلال برامج متعددة هادفة بما يرتقي بفكرهم ويجعلهم ســـواعد بناء فاعلة ، كمـــا انها تولي اهتماما خاصا ببعض فئات المجتمع الاخرى ، ومنها الأيتام ونزلاء دار الملاحظة و ذوي الاحتياجات الخاصة ، وتســـعى من خلال برامجها لبناء الجوانب الشخصية و الاجتماعية لديهم وتمكينهم من المهارات المتنوعة ، مما يجعلهم قادرين على النجاح والتأثير الإيجابي في المجتمع باذن الله .</p> 
                 
                 </div> 

                 <div class="item"> 
                
                         <p> جمعية رعاية الاجيال بجدة تقوم بنشاط وقفي على رعاية الأيتام و نزلاء دار الملاحظة و ذوي الاحتياجات الخاصة و تنمية الشباب و لهم وقف اسمه وقف الوالدين قيمة الوقف عشـــرون مليوناً بقي منها ثمان مليـــون تنتظر أهل الخير ودعم أهل الفضل والاحسان جعل الله ذلك في ميزان حسناتكم وتقبل منا ومنكم و بيض الله وجه من دعم ومن أعطى و جعله في ميزان حسناته وغفر له و لوالديه ولنا جميعاً .</p> 
                 
                 </div> 
          

         </div>

             
  </div>
</div>



    <div class="cat_">
                
             <div class="container">
                        <div class="cat_body" style="direction:rtl;">
                            
                               
                             
                               <div class="col-xs-12 col-sm-5"> 
                                  <h5>برامج التطوع</h5>

                                  <ul > 

                                     <?php 
                                           $prog=$cto_db->select("*","volunteertype",null,"fetchAll");
                                         

                                           foreach ($prog as $value) {
                                              
                                              echo "<li><a  >". $value['name']."</a></li>";
                                           }

                                     ?>
                                       
                                  </ul>

                               </div>

                                <div class="col-xs-12 col-sm-7 "> 

                                      

                                       <div class="cat_bodyLogo col-xs-8">في إطار سعي الجمعية لتمكين الشباب  و لشابات  من خدمة مجتمعهم بشكل فعال ولتقديم أفضل الخدمات للشباب، أقيمت ورشة عمل لتأسيس فكرة مجلس شبابي لجمعية رعاية الأجيال يهدف إلى تمكين الشباب من المشاركة في الإشراف والتطوير لبرامج الجمعية وأنشطتها بحضور عدد من الشخصيات .. .

                                                      </div>

                                        <div class="cat_bodyLogo col-xs-4"><img src="img/logo.png"></div>

                                </div>
                        </div>

             </div>

    </div>


   
     

  

    <?php
 
echo "</div>";//end of contaner 
include $tpl.'footer.php';
 
 
 
 
 