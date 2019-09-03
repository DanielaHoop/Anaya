

$(document).ready(function(){
	// console.log("hay js 2");
	var activado = 0;

	$('.silder-imgs').slick({
	  	infinite: true,
  		slidesToShow: 3,
  		slidesToScroll: 1,
  		arrows: true,
  		  responsive: [{
		      breakpoint: 1200,
		      settings: {
		        slidesToShow: 2,
		        slidesToScroll: 1,
		        infinite: true,
		      }
		    },
		    {
		      breakpoint: 768,
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1,
		        infinite: true,
		      }
		    }
		    // You can unslick at a given breakpoint now by adding:
		    // settings: "unslick"
		    // instead of a settings object
		  ]	

	});
	

	// // EVENTO SCROLL
	// $('.section-full').scroll(function() {
	// 	// console.log("scroll");

	// 	// Valor del pixel bottom de la ventana principal
	// 	var pixelWindow = $('.section-full').offset().top + $('.section-full').height();
		
	// 	// Valor Del pixel del fondo del div del contador 
	// 	var pixelBottomCounter = $('.numeros-js').offset().top + $('.numeros-js').height();

	// 	// console.log("tam ", pixelTop);

	// 	(pixelBottomCounter < pixelWindow && activado == 0 $('.numeros-js').length > 0) ?
	// 	(function(){
	// 		// console.log("ACTIV: ", activado);
	// 		$('.count').each(function () {
	// 		    $(this).prop('Counter',0).animate({
	// 		        Counter: $(this).attr('data-count')
	// 		    }, {
	// 		        duration: 5000,
	// 		        easing: 'swing',
	// 		        step: function (now) {
	// 		            $(this).text(Math.ceil(now));
	// 		        }
	// 		    });
	// 		});
	// 		activado = 1;
	// 	})() : '';


	// });

});


