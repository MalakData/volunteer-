<?php
session_start();    //  start this session
session_unset();    // unset  the data   
session_destroy();
 header("location:index.php");
exit();