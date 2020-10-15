$(document).ajaxComplete(function(){
      // $(".add_new_bill .select_type_name_c .selectpicker ").on("change",function(){

      //       $(".supp_edit_form .type_sup_cat").fadeIn(1000)
             

      // });

      $(".subcat_m .sub_cat select").on("change",function(){

      	 
      	var value_selecy=$(this).val();
       
      	if (value_selecy == -1) {
				$(".subcat_m ._alert").html("يجب تحديد االفئة الفرعية ");//set error message to it
			    $(".subcat_m ._alert").fadeIn(1000).delay(2000).fadeOut(1000); 

           } 
      });
 
  
});//end of first line






 
    
   
 





