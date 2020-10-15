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

//to get sub cat from main cat
$(".select_main_c .selectpicker").on("change",function(){

	   var this_val=$(this).val();


	  if (this_val<="0") {
	  	$(".add_new_bill .d_err").text("يجب اختيار الفئات الرئيسية للصنف");
	  	$(".add_new_bill .d_err").fadeIn(1000).delay(2000).fadeOut(1000);
	  }else{
 
	  	      var data={main_cat:this_val}          
				$.ajax({  
				url:"check_type.php",  
				method:"POST",  
				data:data,  
				success:function(data)  
				{  

					 console.log(data)
				   $(' .select_type_subcat').fadeOut(1000)	
				   $(' .select_type_subcat').html(data)
				   $(' .select_type_subcat').fadeIn(1000)
				     
				}  

				});  
			 
	  }

});

 
$(".slider").slick({
        dots: false,
        infinite: true,
        speed: 500,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        arrows: true,
        adaptiveHeight: true,
        
        responsive: [{
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        },
        {
           breakpoint: 400,
           settings: {
              arrows: false,
              slidesToShow: 1,
              slidesToScroll: 1
           }
        }]
    });




 $(".rio-promos") .slick({
        dots: false,
        infinite: true,
        speed: 500,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 2000,
        arrows: true,

        responsive: [{
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        },
        {
           breakpoint: 400,
           settings: {
              arrows: false,
              slidesToShow: 1,
              slidesToScroll: 1
           }
        }]
    });
 
 $(".rio-promos-about-us") .slick({
        dots: false,
        infinite: true,
        speed: 500,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        arrows: false,

       
    });



 

});//end of  code

