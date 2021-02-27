
// window.axios = require('axios');

// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

// let token = document.head.querySelector('meta[name="csrf-token"]');

// if (token) {
//     window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
// } else {
//     console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
// }

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });

import './lightslider';
import './lightcase';
import './cs-select';
import './slick';
import './sticky';
import './blazy';
import './yt';

/*
if(!document.__defineGetter__) {
	Object.defineProperty(document, 'cookie', {
	    get: function(){return ''},
	    set: function(){return true},
	});
} else {
    document.__defineGetter__("cookie", function() { return '';} );
    document.__defineSetter__("cookie", function() {} );
}
*/

$(document).ready(function() {
	
	$("body").removeClass("preload");
	$("#load__overlay").addClass("hidden");
	
	if ($.isFunction(window["Blazy"])) {
	    var bLazy = new Blazy();
	} else {
	    //alert("not a function");
	}
	
	//STICKY NAV
	$(function() {
		
		function stickNav(){
			var st = $(window).scrollTop();
	        if (st > $('body').offset().top + 100) {
	            $("header").addClass("sticky");
	        } else {
	            $("header").removeClass("sticky");
	        }
		};
		
	    $(window).scroll(function() {
	        stickNav();
	    });
	    
	    stickNav();
	});
	
	
	
	
	$("header .fa-bars").click(function() {
		$("nav").toggleClass("active");
		$(".mobile-overlay").toggleClass("active");
	});
	
	$(".mobile-overlay").click(function() {
		$("nav").toggleClass("active");
		$(".mobile-overlay").toggleClass("active");
	});
	
	function backgroundSlider(action, slide){
		var slides = $("#header .background img");
		var count = slides.length;
		
		$("#background__slider-nav").empty();
		
		slides.each(function(index){
			$(this).attr("data-id", index+1);
		});
		
		if(typeof action === 'undefined' || !action){
			$("#header .background img[data-id='1']").addClass("active");
			var title = $("#header .background img[data-id='1']").attr("data-title");
			var link = $("#header .background img[data-id='1']").attr("data-link");
			
			$("#header-bar h6").html(title);
			$("#header-bar a").attr('href',link);
		}
		
		if(action === "next"){
			var id = parseInt($("#header .background img.active").attr("data-id"));
			id++;
			
			slides.removeClass("active");
			
			if(id > count){
				$("#header .background img[data-id='1']").addClass("active");
				$("#header .background img[data-id='"+count+"']").removeClass("hidden");
				var title = $("#header .background img[data-id='1']").attr("data-title");
				var link = $("#header .background img[data-id='1']").attr("data-link");
				
				$("#header-bar h6").html(title);
				$("#header-bar a").attr('href',link);
			}else{
				$("#header .background img[data-id='"+id+"']").addClass("active");
				$("#header .background img[data-id='"+count+"']").removeClass("hidden");
				var title = $("#header .background img[data-id='"+id+"']").attr("data-title");
				var link = $("#header .background img[data-id='"+id+"']").attr("data-link");
				
				$("#header-bar h6").html(title);
				$("#header-bar a").attr('href',link);
			}
		}
		
		if(action === "prev"){
			var id = parseInt($("#header .background img.active").attr("data-id"));
			id--;
			
			slides.removeClass("active");
			
			if(id === 0){
				$("#header .background img[data-id='"+count+"']").addClass("active");
				$("#header .background img[data-id='"+count+"']").removeClass("hidden");
				var title = $("#header .background img[data-id='"+count+"']").attr("data-title");
				var link = $("#header .background img[data-id='"+count+"']").attr("data-link");
				
				$("#header-bar h6").html(title);
				$("#header-bar a").attr('href',link);
			}else{
				$("#header .background img[data-id='"+id+"']").addClass("active");
				$("#header .background img[data-id='"+count+"']").removeClass("hidden");
				var title = $("#header .background img[data-id='"+id+"']").attr("data-title");
				var link = $("#header .background img[data-id='"+id+"']").attr("data-link");
				
				$("#header-bar h6").html(title);
				$("#header-bar a").attr('href',link);
			}
		}	
/*
		var bLazy = new Blazy();
		bLazy.revalidate();
*/
	};
	
	backgroundSlider();

	var interval = setInterval(function(){backgroundSlider("next");},7000);
	
	$("#next").click(function() {
		backgroundSlider("next");
		window.clearInterval(interval);
		interval = setInterval(function(){backgroundSlider("next");},7000);
	});
	
	$("#prev").click(function() {
		backgroundSlider("prev");
		window.clearInterval(interval);
		interval = setInterval(function(){backgroundSlider("prev");},7000);
	});
	
	//YT video
	$('#video-home').YTPlayer({
	    fitToBackground: true,
	    videoId: 'GXPdpj7MU6A',
	    start: 12,
	    startSeconds: 12
	});
	
	//RECAPTHCA
	function isCaptchaChecked() {
	  return grecaptcha && grecaptcha.getResponse().length !== 0;
	}
	
	//FORM AJAX
	
	$("form").submit(function(e) {
		
		var errorMsg = $(this).attr('data-error');
		var count = 0;
		var valCount = 0;
		
		$(this).find(".form-group").each(function(index){
			var input = $(this).find('input, textarea');
			
			if(input.prop('required')){
				count++;
				if(input.val().length > 3){
					valCount++;
					input.parent().removeClass('error');
				}else{
					input.parent().addClass('error');
				}
			}
		});
		
		if(count == valCount){
			//console.log('done');
			return;
		}
		
		e.preventDefault();
	});
/*
	$("#form__post").click(function() {
		
		warnings = 0;
		
		$("form .input").each(function(index){
			if($(this).find('input:checkbox:not(:checked)').length > 0){
				$(this).find('.input-error').html('Oeps, een veldje vergeten!');
				$(this).find(':input').addClass('warning');
				$(this).addClass('warning');
			}else{
				if( !$($(this).find(":input")).val() || $($(this).find(":input")).val().length < 2 && $(this).find(":input").prop('required') ) {
			        $(this).find('.input-error').html('Oeps, een veldje vergeten!');
			        $(this).find(':input').addClass('warning');
			        warnings++;
			    }
			}	
		});
		
		//REMOVE WARNING WHEN VALUE IS CLICKED (checkbox, radio and file)
		$(".warning, .checkbox-custom-label").change(function(){
			if( $(this).val() || $($(this).find(":input")).val().length > 2 && $(this).prop('required') ) {
		        $(this).parent().find('.input-error').html('');
		        $(this).parent().removeClass('warning');
		        $(this).removeClass('warning');
		    }
		});
		
		//REMOVE WARNING WHEN VALUE IS TYPED (type inputs)
		$(".warning, .checkbox-custom-label").keyup(function(){
			if( $(this).val() || $($(this).find(":input")).val().length > 2 && $(this).prop('required') ) {
		        $(this).parent().find('.input-error').html('');
		        $(this).parent().removeClass('warning');
		        $(this).removeClass('warning');
		    }
		});
		
		//captcha check
		if (isCaptchaChecked()) {
		  	$(".input-error-recaptcha").html('');
		}else{
			$(".input-error-recaptcha").html('Oeps, een veldje vergeten!');
			warnings++;
		}
		
		//FILE SIZE CHECK
		file_size_check();
		
		//CHECK IF FORM IS READY TO SUBMIT
		if(warnings == 0 && fileSize == true){
			$("form").submit();
		}
		
		return false;
		e.preventDefault();
	});
	
	$("form").submit(function(e) {
		
		$("form .btn").css("width","50px");
		$("form .btn").attr("id","");
		$("form .btn span").addClass("hidden");
		$("form .btn .form__loader").removeClass("hidden");
		
		//
		var files = e.target.files;
		
		e.stopPropagation();
	    e.preventDefault();
	    
		var data = new FormData($(this)[0]);

		//
		
		var url = "/functions/submit_form.php"; //reCAPTCHA placeholder element must be empty
	    $.ajax({
			type: "POST",
			url: url,
			
	 		//data: $("form").serialize(), // serializes the form's elements.
			
			data: data,
			cache: false,
			processData: false,
			contentType: false,
			
			success: function(data)
			{
				
				if(data == "1"){
					$("form").find(".grid").remove();
					$("form").html("<p class='text--green'>Uw bericht is verstuurd! Wij nemen spoedig contact met u op.</p>");
				}else{
					$("form").find(".grid").remove();
					$("form").html("<p class='text--red'>Oeps er is iets fout gelopen! Ververs de pagina en probeer opnieuw.</p>");
				}
			},
	        error: function() {
		        console.log(data);
				$("form").find(".grid").remove();
				$("form").html("<p class='text--red'>Oeps er is iets fout gelopen! Ververs de pagina en probeer opnieuw.</p>");
	        }
	    });
	    return false; // avoid to execute the actual submit of the form.
	});
*/
	
});

/*==========  Slick  ==========*/

$('.slider').slick({
	infinite: true,
	prevArrow: $('.slider-prev'),
	nextArrow: $('.slider-next')
});

/*==========  Map  ==========*/
var geocoder;
var map;
function initialize_full_width_map() {
	if ($('#map-footer').length) {
		var myLatLng = new google.maps.LatLng(51.3473044, 4.6432419999999865);
		var mapOptions = {
			zoom: 15,
			center: myLatLng,
			scrollwheel: false,
			panControl: false,
			zoomControl: false,
			scaleControl: false,
			mapTypeControl: false,
			streetViewControl: false,
			styles: [{"featureType":"landscape","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"stylers":[{"hue":"#00aaff"},{"saturation":-100},{"gamma":1.15},{"lightness":10}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"lightness":50}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":30}]}]
		};
		map = new google.maps.Map(document.getElementById('map-footer'), mapOptions);
		var marker = new google.maps.Marker({
			position: myLatLng,
			map: map,
			title: 'Provad',
			icon: '/public/images/mapmarker.png'
		});
		
		if ($('#map-project').length) {
			
			map = new google.maps.Map(document.getElementById('map-project'), mapOptions);
			
			var geocoder = new google.maps.Geocoder();

		   geocoder.geocode({
		      'address': $('#map-project').attr("data-address")
		   },
		   function(results, status) {
		      if(status == google.maps.GeocoderStatus.OK) {
		         new google.maps.Marker({
		            position: results[0].geometry.location,
		            map: map,
					title: 'Provad',
					icon: '/public/images/mapmarker.png'
		         });
		         map.setCenter(results[0].geometry.location);
		      }
		   });
			
/*
			map = new google.maps.Map(document.getElementById('map-project'), mapOptions);
			var marker = new google.maps.Marker({
				position: myLatLng,
				map: map,
				title: 'Provad',
				icon: '/public/images/mapmarker.png'
			});
*/
			
			
		}
	} else {
		return false;
	}
	return false;
}
google.maps.event.addDomListener(window, 'load', initialize_full_width_map);