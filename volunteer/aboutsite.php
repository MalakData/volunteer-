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
         <div class="aboutsite">
            
                   <div class="container">
                        <h1>عن الموقع </h1>

                        <p>هذا الموقع يعبر عن عمل خيري تابع لوزارة العمل و  التنمية  الاجتماعية  ويهدف إلى تنمية روح التعاون وحب التطوع في الأعمال الخيرية  مثل رعاية  الأطفال  اليتامى  والاهتمام  بتنمية مواهب وقدرات الشباب وتقديم  لهم البرامج  التطويرية والإستشارية الممكنة  
وكذلك رعاية المسنين وتقديم يدي المساعدة لهم  
وكذلك الاهتمام بإعمار المساجد والعناية بها     وغير ذلك من الأعمال الخيرية</p>

                   </div>
         </div>
   
     

  

    <?php
 
echo "</div>";//end of contaner 
include $tpl.'footer.php';
 
 
 
 
 