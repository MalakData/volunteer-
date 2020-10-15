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
                  <a href="contactus.php?do=rv">
              
                    <span class="">الرسائل </span>
                  </a>
              </li>
               <li> 
                  <a href="donation.php?do=rv">
              
                    <span class="  ">التبرعات</span>
                  </a>
              </li>
               <li> 
                  <a href="Governoratesofvolunteerism.php?do=rv">
              
                    <span class="  ">محافظات التطوع</span>
                  </a>
              </li>
              
                <li> 
               
               <a href="requestsforvolition.php?do=rv">طلبات المتطوعين </a>
                
              </li>


               <li> 
                  <a href="VolunteerPrograms.php?do=rv">
              
                    <span class="  ">البرامج التطوعية</span>
                  </a>
              </li>

               <li> 
               
                    <a href="thevolunteer.php?do=rv">المتطوعين</a>
                
              </li>
              <li> 
               
               <a href="volunteering.php?do=rv">  التطوع </a>
                
              </li>
              
              <li> 
                  <a href="dashboard.php">
                     
                    <span class="">الصفحة الرئيسية</span>
                  </a>
              </li>
     
             <!--  <li><a href=" comment.php"><span class=" user_u glyphicon glyphicon-cloud"></span></a></li>  -->
      </ul>
     
      <ul class="nav navbar-nav navbar-left">
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['username']  ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="members.php?do=Edit&userid=<?php echo $_SESSION['ID']  ?>" >تعديل الملف الشخصي</a></li>
            
            <li><a href="Logout.php">تسجيل الخروج</a></li>
            
          </ul>
        </li>
      </ul>
    </div>
 
</nav>