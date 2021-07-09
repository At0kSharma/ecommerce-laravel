// $(document).ready(function(){
//     $("#banner-area .owl-carousel").owlCarousel({
//         loop:true,
//         dots:true,
//         items:1,
//         lazyLoad : true,
//         autoplay:true,
//         fluidSpeed:true,
//         autoplayTimeout:6000,
//         autoplayHoverPause:true
//     });


//     //top sale carousel
//     $("#new-arival .owl-carousel").owlCarousel({
//         loop:true,
//         nav:false,
//         dots:false,
//         autoplay:true,
//         autoplayTimeout:5000,
//         autoplayHoverPause:true,
//         responsive:{
//             0:{
//                 items:2
//             },
//             600:{
//                 items:3
//             },
//             1000:{
//                 items:4
//             }
//         }
//     });

//     //isotope
//     var $grid = $(".grid").isotope({
//         itemSelector:'.grid-item',
//         layoutMode:'fitRows'
//     });

//     //filter items on button
//     $(".button-group").on("click","button",function(){
//         var filterValue=$(this).attr('data-filter');
//         $grid.isotope({filter:filterValue});
//     });

//     //new arrival carousel
//     $("#type .owl-carousel").owlCarousel({
//         loop:true,
//         nav:false,
//         dots:false,
//         autoplay:true,
//         autoplayTimeout:5000,
//         autoplayHoverPause:true,
//         responsive:{
//             0:{
//                 items:1
//             },
//             600:{
//                 items:3
//             },
//             1000:{
//                 items:4
//             }
//         }
//     });

//     //product-image
//     $("#product-image .owl-carousel").owlCarousel({
//         loop:true,
//         dots:true,
//         items:1,
//         nav:true,
//         navText : ['<i class=" text-info fa fa-angle-left" aria-hidden="true"></i>','<i class=" text-info fa fa-angle-right" aria-hidden="true"></i>'],
//     });
// });

$(document).ready(function(){
    $('#imgsubmit').click(function(){
      var image_name = $('#banner-image').val();
      if(image_name == ''){
        alert("Please select Image");
      }
      else{
        var extension = $('#banner-image').val().split('.').pop().toLowerCase();
        if(jQuery.inArray(extension,['png','jgp','jpeg','webp'])==-1){
          alert("Invalid Image File");
          $('#banner-image').val('');
          return false;
        }
      }
    });
  });
$(document).ready(function(){
    $('#add-image-submit').click(function(){
      var image_name = $('#img').val();
      if(image_name == ''){
        alert("Please select Image");
      }
      // else{
      //   var extension = $('#img').val().split('.').pop().toLowerCase();
      //   if(jQuery.inArray(extension,['png','jgp','jpeg','webp'])==-1){
      //     alert("Invalid Image File");
      //     $('#img').val('');
      //     return false;
      //   }
      // }
    });
  });


// enable input feild
$(document).ready(function(){
  $("#edit-product-btn").click(function () {
    $("#product_name").removeAttr('disabled');
    $("#product_type").removeAttr('disabled');
    $("#product_price").removeAttr('disabled');
    $("#discount").removeAttr('disabled');
    $("#product_body1").removeAttr('disabled');
    $("#product_body2").removeAttr('disabled');
    $("#edit-product-submit").removeAttr('disabled');
  });
});
$(document).ready(function(){
  $("#edit-property-btn").click(function () {
    $("#about").removeAttr('disabled');
    $("#edit-property-submit").removeAttr('disabled');
    $("#fabric").removeAttr('disabled');
    $("#weight").removeAttr('disabled');
    $("#insulation").removeAttr('disabled');
    $("#sleeve").removeAttr('disabled');
    $("#closure").removeAttr('disabled');
    $("#pocket").removeAttr('disabled');
  });
});
$(document).ready(function(){
  $("#edit-feature-btn").click(function () {
    $("#edit-feature-submit").removeAttr('disabled');
    $("#mytext").removeAttr('disabled');
    $("#add_field_button").removeAttr('disabled');
  });
});

$(document).ready(function () {
  $('#sidebarCollapse').on('click', function () {
    $('#sidebar').toggleClass('active');
  });
});


//add feature input field in description
$(document).ready(function() {
	var max_fields      = 10; //maximum input boxes allowed
	var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
	var add_button      = $(".add_field_button"); //Add button ID
	
	var x = 1; //initlal text box count
	$(add_button).click(function(e){ //on add input button click
		e.preventDefault();
		if(x < max_fields){ //max input box allowed
			x++; //text box increment
			$(wrapper).append('<div class="d-flex"><input type="text" name="mytext[]" placeholder="Add More Features" class="form-control m-2"/><a href="#" class="remove_field"><i class="far fa-times-circle fa-2x m-2 text-danger"></i></a></div>'); //add input box
		}
	});
	
	$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x--;
	})
});

// $(document).ready(function(){
//   $("#thumbnail").click(function(){
//       // Change src attribute of image
//       $('#preview').attr("src", $('#thumbnail').getAttribute("src"));
//   });    
// });


$(document).ready(function()
{
  $('#term_of_service').change(function() 
  {
    if(this.checked == true)
    {
      $("#payment-complete").removeAttr('disabled');    
    }
    else{
      $("#payment-complete").setAttribute('disabled');
    }
  });   
});