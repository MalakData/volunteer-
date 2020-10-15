<?php
 
function getTitle(){

global  $pageTitle;
 if(isset( $pageTitle)){
      echo  $pageTitle;
}

else{


echo 'Defult';

}

}
 

/*
**function g_string V0.1
**Function to generate   randome name
**accept on parameter th length of  name that you want
*/
function g_string($length){
	$out='';
	$char='ABCDEFGHIJKLMNOPQRSTUVWXYZaqwertyuiopsdfghjklzxcvbnm1234567890';
	$char_array=str_split($char);// to change the string into array => "str_split()"
	for ($i=0; $i <= $length ; $i++) { 
 
	 $out.=$char_array[array_rand($char_array)];  //select randome  key number from array by array_rand()  
	                                             // and  save the value on out
	}
	return $out;

}

	// <select class="selectpicker" name="type">
	// 								<optgroup label="Picnic">
	// 										<option value="company">شركة</option>
	// 										<option>Ketchup</option>
	// 								</optgroup>
	// 						</select>

/*
**function redirect V0.1
**take 3 parameter
**$msg

*/
 function redirect($msg,$url=null,$second=3){

			if ($url 	== null) {
			    $url='index.php';
			}
			else
				{
			$url =isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !=''? $_SERVER['HTTP_REFERER'] : "index.php";
					}	
			echo $msg;
		    header("refresh:$second ;url=$url");
			exit();
	}
 
 
function lang1($l)
{
 $lang=array(
	'Mon'       => 'الاثنين',
	'Tue'       => 'الثلاثاء',
	'Wed'       => 'الاربعاء',
	'Thu'       => 'الخميس',
	'Fri'       => 'الجمعة',
	'Sat'       => 'السبت',
	'Sun'       => 'الاحد',
	"Jan"       => "يناير", 
	"Feb"       => "فبراير", 
	"Mar"       => "مارس", "
	Apr"        => "أبريل", 
	"May"       => "مايو", 
	"Jun"       => "يونيو", 
	"Jul"       => "يوليو", 
	"Aug"       => "أغسطس", 
	"Sep"       => "سبتمبر",
	"Oct"       => "أكتوبر",
	"Nov"       => "نوفمبر",
	"Dec"       =>"ديسمبر",
	"1"         => "١",
	"2"         =>"٢",
	"3"         =>"٣",
	"4"         =>"٤",
	"5"         =>"٥",
	"6"         =>"٦",
	"7"         =>"٧",
	"8"         =>"٨",
	"9"         =>"٩",
	"01"         => "١",
	"02"         =>"٢",
	"03"         =>"٣",
	"04"         =>"٤",
	"05"         =>"٥",
	"06"         =>"٦",
	"07"         =>"٧",
	"08"         =>"٨",
	"09"         =>"٩",
	"10"        =>"١٠",
	"11"        =>"١١",
	"12"        =>"١٢",
	"13"        =>"١٣",
	"14"        =>"١٤",
	"15"        =>"١٥",
	"16"        =>"١٦",
	"17"        =>"١٧",
	"18"        =>"١٨",
	"19"        =>"١٩",
	"20"        =>"٢٠",
	"21"        =>"٢١",
	"22"        =>"٢٢",
	"23"        =>"٢٣",
	"24"        =>"٢٤",
	"25"        =>"٢٥",
	"26"        =>"٢٦",
	"27"        =>"٢٧",
	"28"        =>"٢٨",
	"29"        =>"٢٩",
	"30"        =>"٣٠",
	"31"        =>"٣١",	
	"2016"      =>"٢٠١٦",
    "2017"      =>"٢٠١٧",
    "2018"      =>"٢٠١٨",      
    "2019"      =>"٢٠١٩",
    "2020"      =>"٢٠٢٠",
	);




 return $lang[$l];
};

function random($lenth)
{
    $ar = str_split('12345678901234567890123456789012345678901234567890');
    $f = implode(",",$ar);
    $count = count($ar);
    $rand='';
 
    for($i=0;$i<$lenth;$i++)
    {
        $randomno =rand(0,$count-1);
         $rand .= $ar[$randomno];
    }

    return $rand;
}


function random_($start, $end, $quantity) {
    $numbers = range($start, $end);
    shuffle($numbers);
    $r=0;
    foreach (array_slice($numbers, 0, $quantity) as $value) {
          $r+=$value;
    }


    return $r;
}
/**
**Function unit_and_piece v0.1
**take two parameter $top(piece) and $bottom(mian details_num in define_type) 
**$top->the upper number like '60/2' this will be 60
**$bottom-> the bottom side like'60/2' this will be 2
**return the unit_and_piece as array
*/
function unit_and_piece($top,$bottom){
    $step1=floor($top/$bottom);
    $step2=$step1*$bottom;
    $step3=$top-$step2;
    $final=[$step1,$step3];//0->the unit 1->the piece
    return  $final;
}



// function tabel($thead,$tbody,$value_data){
//   echo "<table class='table table-hover'>";
//   echo "<thead>";
//   echo "<tr>";
//   foreach ($thead as $value) {
//   	 echo "<th>".$value."</th>";
//   }
//   echo "</tr>";
//   echo "<tbody>";
//   $lenth_value_date=0;
//      for ($i=0; $i<sizeof($tbody); $i++) { 
        
//          if ($lenth_value_date>=sizeof($value_data)) {
//             $lenth_value_date=0;
//          }
//          echo "<tr";
//          $date=DateTime::createFromFormat(" Y-m-d H:i:s",$tbody[$i]['date']);
//          foreach ($value_data as $v) {
//                 if ($tbody[$i][$value_data[$lenth_value_date]]=="control_see") { //if =control_see => see and delete
//                 	# code...
//                 }

//          	  $lenth_value_date++;
//          }
  
         
       
//            echo "<td>".$tbody[$i][$value_data[$lenth_value_date]]."</td>";
//         echo "</tr>";

    
//      }
//   echo "</tbody>";

// }
/*
**Function to display the  directory of  file
*/
    function list_dir($array_l){
					echo "<h3>";
						$start=1;
						foreach ($array_l as $key => $value) {
						if ($start<count($array_l)) {
						echo "<a href='".$key."'>".$value."</a> / ";

						}else{
						echo "<a href='".$key."'>".$value."</a> ";
						}
						$start++;
						}

					echo "</h3>";
	          }
function rsed_eldorg($day,$shop_id,$cto_db){
		$dion=$cto_db->select("SUM(reminder) as sum","bill_prouduct"," shop_id='{$shop_id}' AND reminder<0 AND end_at='{$day}'","fetch");

		/////////////////////////
		//rsed ek dorg
	
	


		$get_staff_salary=$cto_db->select("SUM(salary) as sum","manage_staff"," shopid='{$shop_id}' AND end_at='{$day}' ","fetch");


		$get_user_salary=$cto_db->select("SUM(salary) as sum","manage_user"," shopid='{$shop_id}' AND end_at='{$day}'","fetch");



		$fetch_mange_drawer=$cto_db->select("SUM(cost) as sum","mange_drawer ","end_at='{$day}' AND shop_id='{$shop_id}' ","fetch");

		$fetch_mange_car=$cto_db->select("SUM(cost) as sum","manage_car ","end_at='{$day}' AND shop_id='{$shop_id}'","fetch");

		if ($day=="0000-00-00 00:00:00") {
        	$get_all_from_shop=$cto_db->select("SUM(total_cost) as sum","bill_prouduct","end_at='{$day}' AND shop_id='{$shop_id}' ","fetch");

			$fetch_opening_b=$cto_db->select("cost","opening_b ","shop_id='{$shop_id}'","fetch");
		}else{
	

			$fetch_opening_b=$cto_db->select("cost","mange_opening_b ","end_at='{$day}' AND shop_id={$shop_id}","fetch");
	     $get_all_from_shop=$cto_db->select("SUM(total_cost) as sum","bill_prouduct_copy","end_at='{$day}' AND shop_id='{$shop_id}' ","fetch");
		}


		$rased_eldorg= ($get_all_from_shop['sum']+$fetch_opening_b['cost'])-($get_user_salary['sum']+$get_staff_salary['sum']+$fetch_mange_drawer['sum']+$fetch_mange_car['sum']);


		$elkadm_mn_elagel=$cto_db->select("SUM(cost) as sum","mange_bill_back ","end_at='{$day}' AND shop_id='{$shop_id}' ","fetch");

		$elmortga3=$cto_db->select("SUM(cost) as sum","mange_bill_edit ","end_at='{$day}' AND shop_id='{$shop_id}' ","fetch");

		////////////////////////

		$total_row=(round($rased_eldorg,2)+$dion['sum']+$elkadm_mn_elagel['sum'])-$elmortga3['sum'];



		
      return  array(round($rased_eldorg,2),$dion['sum'],$elkadm_mn_elagel['sum'],$fetch_opening_b['cost'],$elmortga3['sum'],round($total_row,2));
}
?>