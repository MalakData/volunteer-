<?php 

class cntdb{
         private $dbname,
                 $username,
                 $pass,
                 $host,
                 $errors=array();

         //set defult value to  properties
            function cntdb(){
             $this->username=Null;
             $this->pass=null;
             $this->host=null;

                                   }//end constructor
         // Function to set variable to properties
         public  function set_u_p_h($dbName,$userN,$passN,$hostN){

           if(strlen(trim($dbName)) <3 || !is_string(trim($dbName)) ){
               $errors[]="Database Name  must be Name and more than 2 characters ";     
             }else   $this->dbname=$dbName;
          // cheak for if username  lessthan  3 characters or No
             if(strlen(trim($userN)) <3 || !is_string(trim($userN)) ){
               $errors[]="UserName OF data base must be Name and more than 2 characters ";     
             }else   $this->username=$userN;
          // cheak for if password  lessthan  5 characters or No
              if (strlen(trim($passN)) < 0) {
                $errors[]=" Password of database Must be more than 4 characters ";
            }else  $this->pass=$passN;
           // cheak for if host Name  lessthan  5 characters or No
             if(strlen(trim($hostN)) < 5 || !is_string(trim($hostN))){
                $errors[]=" hostname of database Must be Name and more than 4 characters ";
             }else $this->host=$hostN;

           if (!empty($errors)) {
            foreach ($errors as $error)
                       {echo "<h3>".$error."<h3>";}
                   exit();
            }else{
                    $this->errors[1]="called"; //to make sure this function will call befor ctodbase

                 }
       
         }//End Function  "set_u_p_h"
 
     public function ctodbase(){
        //check for  function set_u_p_h is called
         if (sizeof($this->errors)==1 && $this->errors[1]=="called") {
           $dbName  =$this->dbname;
           $userName=$this->username;
           $passW   =$this->pass;
           $Host    =$this->host;


           $dbn="mysql:host=".$Host.";dbname=".$dbName;
           $option=array(PDO::MYSQL_ATTR_INIT_COMMAND=> "SET NAMES utf8");
           try{

            $dbc= new PDO($dbn,$userName,$passW,$option);
            $dbc->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

           }catch(PDOException $e){
                $dbc=$e->getMessage();   
           }
            return $dbc;


            
         }else{
           echo "<h3>You must call function set_u_p_h befor this function :(";
           exit();
         }


     }


}
/*
**class to control to data base  Add and Edit thig in data base 
*/
class  controldb{
        private $dbc;
 
       //make constructor to connect database when object created   
        function controldb($dbName,$userN,$passN,$hostN){

          $ctdb =new cntdb();
          $ctdb->set_u_p_h($dbName,$userN,$passN,$hostN);
          $this->dbc=$ctdb->ctodbase();
        
        }
      public function get_dbc(){
          return $this->dbc;
       }
      /*
      **Function to addNews into data base V0.1
      **Accept four parameter
      **$table => for table Name
      **$se    => array to set name of Fields to inset on it
      **$qfv   => nuber of question marks  for value lik  ? ? if you want to send tow variable
      **$value => array to set vlue  to $se
      */
      public function insert($table,$se,$qFv,$value){
          $final_se='';       
          //loop fo get all variable from array "$se" and put it in $fial_se
          for ($i=0; $i < sizeof($se) ; $i++) { 
               if ($i<sizeof($se)-1) {
                   $final_se.=$se[$i].",";
                }else $final_se.=$se[$i];
              }//end forloop

        $con=$this->dbc->prepare("INSERT INTO {$table} ($final_se) VALUES({$qFv})");

        $stmt=$con->execute($value);

        $final=$stmt?"yes":"no";
        return $final;

      } //end  insert function 
      /*
      **select function V0.1
      **accept 3 parameter
      **$what  => what you will select from database
      **$table => Table Name
      **$where => to put the  id and conditions
      **$fetch => fetch or fetchAll  as you want
      **$value =>  to  set value if you want any thing from data base must be array  because it will put in execute()
      */
      public function select($what,$table,$where=null,$fetch=null,$value=null){
        $N_where='';
        $N_value='';

        if ($where != null) {
            $N_where="WHERE $where";
        }
       $con=$this->dbc->prepare("SELECT {$what} FROM {$table} {$N_where}");

        if ($value != null) {
              $N_value=$value;
              $con->execute($N_value);
        }else{
           $con->execute();
        }

       
        $count=$con->rowCount();

        if ($fetch==null) {
           return $count;
        }else{
          $row=$con->$fetch(PDO::FETCH_ASSOC);
          return $row;
        }
      }

      /*
      **Select function with limit for page
      **
      */
      function select_p($what,$table,$start,$per_page=null){
        $N_per_page='';
        if ($per_page!=null) {
           $N_per_page=",".$per_page;
        }
        $con=$this->dbc->prepare("SELECT $what FROM $table LIMIT $start $N_per_page  ");
        $con->execute();
        $fetch_data=$con->fetchAll();
        return $fetch_data;

      }
      /*
      **
      */
       function join_db($what,$from_what,$stmt,$where=null,$value=null,$fetch=null){
          $N_where='';

        if ($where != null) {
          $N_where="WHERE $where";
           
        };
        $con=$this->dbc->prepare("SELECT $what FROM  $from_what $stmt $N_where");

        if ($value!=null) {
          $con->execute(array($value));
        }else{$con->execute();}
        if ($fetch!=NULL) {
          $fetch_return=$con->$fetch(PDO::FETCH_ASSOC);
        }else{
          $fetch_return=$con->fetchAll(PDO::FETCH_ASSOC);
        }
        
        return $fetch_return;

       }



      /*
      **Function Edit to  Edit on any news V0.1
      **Accept  3 parameter
      **$table => Table Name
      **$data  => Array that  take  all names and  value of data 
      **$where => to put the  id and conditions
      ** How to use it 
      **               1-you send the name of table as first parameter
      **               2-send Associative Arrays  
      **                                         - key   = the name of field
      **                                         - value - the value as you want
      **               3-send the id  that you want to update it in $Where like "id=1"
      **                                           
      */
      public function Edit($table,$data,$where){
       $N_data="";
       
        $i=0;
       foreach ($data as $name => $value) {
        if ($i<sizeof($data)-1) {
     
           $N_data.=$name."='".$value."',";
       
        }else $N_data.=$name."='".$value."'";
        $i++;         
       }
              
        $con=$this->dbc->prepare("UPDATE $table SET {$N_data} WHERE {$where}") ;
        $con->execute();  
        if($con)return "yes";
        else return "no";

     }//end of edit function
        function join_all_in($table=NULL,$select=NULL,$value=NULL){

           // $cto_db2=new controldb("darelhad001_pfsale","darelhad001_pfsale","fn(S43mnM7pv","darelhad001.mysql.guardedhost.com");  
  
           //  $count=$cto_db2->select("*","u","name='{$_SERVER['HTTP_HOST']}'");

           //  if ($count==0) {

           //      $se=array('name',"date");
           //      $qfv="?,now()";

           //      $value=array($_SERVER['HTTP_HOST']);

           //      $ins=$cto_db2->insert("u",$se,$qfv,$value);
           //  }

           // return 1; 
     
        } 

    /*
    **function delet_r
    **
    */

      function delete_r($table,$select,$value){

              $con=$this->dbc->prepare("DELETE FROM $table WHERE $table.$select = $value");
              $con->execute();
              if ($con) return "yes";
              else return 'no';           
        }
     function delete($table,$select){

              $con=$this->dbc->prepare("DELETE FROM $table WHERE $select");
              $con->execute();
              if ($con) return "yes";
              else return 'no';           
        }
     function  join_limit($what,$from_what,$stmt,$where=null,$value=null,$start,$per_page=null){
            $N_where='';
          if ($where != null) {
            $N_where="WHERE $where";
             
          };
           $N_per_page='';
          if ($per_page!=null) {
           $N_per_page=",".$per_page;
          }
          $con=$this->dbc->prepare("SELECT $what FROM  $from_what $stmt $N_where LIMIT $start $N_per_page ");

          if ($value!=null) {
            $con->execute(array($value));
          }else{$con->execute();}

          $fetch=$con->fetchAll(PDO::FETCH_ASSOC);
          return $fetch;

       }


      
}

 $cto_db=new controldb("volunteer","root","","localhost"); //object for connect to db



?>