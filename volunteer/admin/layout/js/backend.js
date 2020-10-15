$(window).load(function() {
		// Animate loader off screen
		//$(".se-pre-con").fadeOut("slow");
 

	});
// $(document).keydown(function(e){

//     if(e.keyCode==123){
//     return false;
//    }
 
// });

 

// $(document).on("contextmenu",function(e){        
//    e.preventDefault();
// });


$(document).ready(function(){
 

 $('.confirm').click(function(){return  confirm('Are you sure ?');});

 


num_only=function(t){
 
    if(isNaN(t.value)){
      alert_("شروط","يجب كتابة ارقام فقط");
      t.value=t.value;
    }
}

 
 
function alert_(m_mes,desc_mes){
		$(".pop_up_alert ").fadeIn(100);
		$(".pop_up_alert .upper .content h3").html(m_mes);
		$(".pop_up_alert .upper .content p").html(desc_mes);
		$(".pop_up_alert .upper").fadeIn(100);
		$(".cost_per_unit").fadeOut(1000);
}


});//end of  code

