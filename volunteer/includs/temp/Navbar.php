<nav class="navbar  ">
 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
       
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">


              <li> 
               
                   <a href="donation.php?do=rv">تبرع</a>
                
              </li>


             
              <li> 
               
                   <a href="contactus.php">تواصل معنا </a>
                
              </li>

                <li> 
                           
                                <a href="VolunteerPrograms.php?do=rv">البرامج التطوعية</a>
                         
                         

               </li> 

             
              <li> 
               
               <a href="aboutsite.php">  نبذة عن الموقع </a>
                
              </li>
              
              <li> 
                  <a href="index.php">
                     
                    <span class="">الصفحة الرئيسية</span>
                  </a>
              </li>
     
             <!--  <li><a href=" comment.php"><span class=" user_u glyphicon glyphicon-cloud"></span></a></li>  -->
      </ul>
     
      <ul class="nav navbar-nav navbar-left">

       <?php 

       if (isset($_SESSION['username'] )) {
          ?>
               
                      <li class="dropdown">
 
                   
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['username']  ?> <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                    <li><a href="profile.php" >تعديل الملف الشخصي</a></li>

                                        <li class=" "> 

                                        
                                        <a  href="volunteer.php?do=rv" class=" ">تطوع</a> 

                                        
                                        </li>

                                    <li> <a href="Logout.php">تسجيل الخروج</a> </li>
                        <li>
          <?php
          }else{

          ?>
                      

                      <li class="signup">

                          <div class="out">
                          <a href="signup.php" class=" ">إنشاء حساب</a>
                          </div>

                      </li>

                      <li class="login_"> 

                          <div class="out">
                                <a  href="login.php" class=" ">تسجيل الدخول</a> 
                               
                          </div>
                      </li>
                     
             <?php

          }
          ?>
         
           
          </ul>


        </li>
      </ul>
    </div>
 
</nav>