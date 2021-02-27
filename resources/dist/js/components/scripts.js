//STICKY NAV
$(function() {
	
	var height = $(".nav-sticky").height();
	
	$( window ).resize(function() {
		height = $(".nav-sticky").height();
	});
	
	function stickNav(height){
		var st = $(window).scrollTop();
		if($(".nav-sticky").length){
			if (st > $('body').offset().top + height) {
	            $(".nav-sticky .bar").addClass("pos-fixed").addClass("bar--mobile-sticky");
	            $("main").css('padding-top',height);
	        } else {
	            $(".nav-sticky .bar").removeClass("pos-fixed").removeClass("bar--mobile-sticky");
	            $("main").css('padding-top',0);
	        }
		}
	}
	
    $(window).scroll(function() {
        stickNav(height);
    });
    
    stickNav(height);
});

function loadSliders(){
	$('.slider').each(function(index){
        var slider = $(this);
		var sliderClasses = slider.attr("class").replace('slider ','');
		
		if(sliderClasses == "slider"){
			var sliderClasses = slider.attr("data-classes");
		}else{
			slider.attr("data-classes",sliderClasses);
		}
		
        var themeDefaults = {
	        infinite: true,
            dots: false,
            arrows: false,
            fade: false,
            autoplay: false,
            autoplaySpeed: 5000,
            adaptiveHeight: true,
            centerMode: false,
            slidesToShow: 1,
            centerPadding: '0px',
            loadInvisible: true, //loads all images to prevent lazyload
            mobileFirst: true,
        }; 
        // Attribute Overrides - options that are overridden by data attributes on the slider element
        var ao = {};
        ao.infinite = themeDefaults.infinite;
        ao.dots = (slider.attr('data-paging') === 'true' && slider.find('div').length > 1) ? true : themeDefaults.dots;
        ao.arrows = (slider.attr('data-arrows') === 'true' && slider.find('div').length > 1) ? true : themeDefaults.arrows;
        ao.fade = slider.attr('data-fade') === "true" ? true: themeDefaults.fade;
        ao.autoplay = slider.attr('data-autoplay') === 'true'? true: themeDefaults.autoplay;
        ao.centerMode = slider.attr('data-centermode') === "true" ? true: themeDefaults.centerMode;
        ao.autoplaySpeed = slider.attr('data-autospeed') ? parseInt(slider.attr('data-autospeed')): themeDefaults.autoplaySpeed;
        ao.adaptiveHeight = slider.attr('data-adaptheight') === "true" ? true: themeDefaults.adaptiveHeight;
        ao.slidesToShow = slider.attr('data-slidestoshow') ? parseInt(slider.attr('data-slidestoshow')): themeDefaults.slidesToShow;
        ao.centerPadding = (slider.attr('data-centerpadding') && slider.attr('data-centerpadding').length > 1) ? slider.attr('data-centerpadding') : themeDefaults.centerPadding;
        
        if(parseInt(ao.slidesToShow) > 1){
	        ao.responsive = [
                {
                  breakpoint: 992,
                  settings: {
                    slidesToShow: ao.slidesToShow,
                    slidesToScroll: 1
                  }
                },
                {
                  breakpoint: 768,
                  settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                  }
                },
                {
                  breakpoint: 550,
                  settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                  }
                }
            ];
        }
        
        if(parseInt(ao.slidesToShow) > 3){
	        ao.responsive = [
		        {
                  breakpoint: 1000,
                  settings: {
                    slidesToShow: ao.slidesToShow,
                    slidesToScroll: 1
                  }
                },
                {
                  breakpoint: 992,
                  settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                  }
                },
                {
                  breakpoint: 768,
                  settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                  }
                },
                {
                  breakpoint: 550,
                  settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                  }
                }
            ];
        }
        
        
        $(this).slick(ao);
        
        if(sliderClasses !== undefined){
	        sliderClasses = sliderClasses.split(" ");
		
			var arrayLength = sliderClasses.length;
			for (var i = 0; i < arrayLength; i++) {
			    slider.removeClass(sliderClasses[i]);
			    slider.find(".slick-list").addClass(sliderClasses[i]);
	/*
			    setTimeout(function(){
			    	slider.find("div").addClass(sliderClasses[i]);
			    }, 2000);
	*/
			    
			    //console.log(slider.find("img"));
			}
        }
        
        //if background-image-holder is parent
        
        
    });
};

function loadLightcase(){
	if($('script[src*="lightcase"]').length){
		$('a[data-rel^=lightcase]').lightcase();
	}
}

function loadBackgrounds(){
	$('.background-image-holder').each(function() {
        var imgSrc = $(this).children('img').attr('src');
        $(this).css('background', 'url("' + imgSrc + '")').css('background-position', 'initial').css('opacity','1');
    });
}

function loadParallax(){
	mr = (function (mr, $, window, document){
			
		"use strict";
	    
	    mr.parallax = mr.parallax || {};
	
	    mr.parallax.documentReady = function($){
	        
	        var $window      = $(window); 
	        var windowWidth  = $window.width();
	        var windowHeight = $window.height();
	        var navHeight    = $('nav').outerHeight(true);
	
	        if (windowWidth > 768) {
	            var parallaxHero = $('.parallax:nth-of-type(1)'),
	                parallaxHeroImage = $('.parallax:nth-of-type(1) .background-image-holder');
	
	            parallaxHeroImage.css('top', -(navHeight));
	            if(parallaxHero.outerHeight(true) === windowHeight){
	                parallaxHeroImage.css('height', windowHeight + navHeight);
	            }
	        }
	    };     
	    
	    mr.parallax.update = function(){
	        if(typeof mr_parallax !== typeof undefined){
	            mr_parallax.profileParallaxElements();
	            mr_parallax.mr_parallaxBackground();
	        }
	    };
	
	    mr.components.documentReady.push(mr.parallax.documentReady);
	    return mr;
    }(mr, jQuery, window, document));
};

function loadYTBGvideo(){
	//////////////// Youtube Background

	if($('.youtube-background').length){
		$('.youtube-background').each(function(){


			var player = $(this),
			
			themeDefaults = {
				containment: "self",
				autoPlay: true,
				mute: true,
				opacity: 1
			}, ao = {};

  // Attribute overrides - provides overrides to the global options on a per-video basis
			ao.videoURL = $(this).attr('data-video-url');
			ao.startAt = $(this).attr('data-start-at')? parseInt($(this).attr('data-start-at'), 10): undefined;


			player.closest('.videobg').append('<div class="loading-indicator"></div>');
			player.YTPlayer(jQuery.extend({}, themeDefaults, mr.video.options.ytplayer, ao));
			player.on("YTPStart",function(){
		  		player.closest('.videobg').addClass('video-active');
			});	

		});
	}

	if($('.videobg').find('video').length){
		$('.videobg').find('video').closest('.videobg').addClass('video-active');
	} 

	//////////////// Video Cover Play Icons

	$('.video-cover').each(function(){
	    var videoCover = $(this);
	    if(videoCover.find('iframe[src]').length){
	        videoCover.find('iframe').attr('data-src', videoCover.find('iframe').attr('src'));
	        videoCover.find('iframe').attr('src','');
	    }
	});

	$('.video-cover .video-play-icon').on("click", function(){
	    var playIcon = $(this);
	    var videoCover = playIcon.closest('.video-cover');
	    if(videoCover.find('video').length){
	        var video = videoCover.find('video').get(0);
	        videoCover.addClass('reveal-video');
	        video.play();
	        return false;
	    }else if(videoCover.find('iframe').length){
	        var iframe = videoCover.find('iframe');
	        iframe.attr('src',iframe.attr('data-src'));
	        videoCover.addClass('reveal-video');
	        return false;
	    }
	});
};

function loadMasonry(){
	    mr.masonry = mr.masonry || {};

    mr.masonry.documentReady = function($){

        mr.masonry.updateFilters();

        $(document).on('click touchstart', '.masonry__filters li:not(.js-no-action)', function(){
            var masonryFilter = $(this);
            var masonryContainer = masonryFilter.closest('.masonry').find('.masonry__container');
            var filterValue = '*';
            if(masonryFilter.attr('data-masonry-filter') !== '*'){
                filterValue = '.filter-'+masonryFilter.attr('data-masonry-filter');
            }
            masonryFilter.siblings('li').removeClass('active');
            masonryFilter.addClass('active');
            masonryContainer.removeClass('masonry--animate');
            masonryContainer.on('layoutComplete',function(){
                $(this).addClass('masonry--active');
                if(typeof mr_parallax !== typeof undefined){
                    setTimeout(function(){ mr_parallax.profileParallaxElements(); },100);
                }
            });
            masonryContainer.isotope({ filter: filterValue });
            
        });
        
    };

    mr.masonry.windowLoad = function(){

        $('.masonry').each(function(){
            var masonry       = $(this).find('.masonry__container'),
                masonryParent = $(this),
                defaultFilter = '*',
                themeDefaults, ao = {};

            themeDefaults = {
                itemSelector: '.masonry__item',
                filter: '*',
                masonry: {
                  columnWidth: '.masonry__item'
                }
            };

            // Check for a default filter attribute
            if(masonryParent.is('[data-default-filter]')){
                defaultFilter = masonryParent.attr('data-default-filter').toLowerCase();
                defaultFilter = '.filter-'+defaultFilter;
                masonryParent.find('li[data-masonry-filter]').removeClass('active');
                masonryParent.find('li[data-masonry-filter="'+masonryParent.attr("data-default-filter").toLowerCase()+'"]').addClass('active');
            }

            // Use data attributes to override the default settings and provide a per-masonry customisation where necessary.
            ao.filter = defaultFilter !== '*' ? defaultFilter : undefined;

            masonry.on('layoutComplete',function(){
                masonry.addClass('masonry--active');
                if(typeof mr_parallax !== typeof undefined){
                    setTimeout(function(){ mr_parallax.profileParallaxElements(); },100);
                }
            });

            
            masonry.isotope(jQuery.extend({}, themeDefaults, mr.masonry.options, ao));

        });
    };

    mr.masonry.updateFilters = function(masonry){

        // If no argument is supplied, just apply the update to all masonry sets on the page.
        masonry = typeof masonry !== typeof undefined ? masonry : '.masonry';
        
        var $masonry = $(masonry);
        
        $masonry.each(function(){
            var $masonry         = $(this),
                masonryContainer = $masonry.find('.masonry__container'),
                filters          = $masonry.find('.masonry__filters'),
                // data-filter-all-text can be used to set the word for "all"
                filterAllText    = typeof filters.attr('data-filter-all-text') !== typeof undefined ? filters.attr('data-filter-all-text') : "All",
                filtersList;
            
            // Ensure we are working with a .masonry element
            if($masonry.is('.masonry')){
                // If a filterable masonry item exists
                if(masonryContainer.find('.masonry__item[data-masonry-filter]').length){
                    
                    // Create empty ul for filters
                    filtersList = filters.find('> ul');

                    if(!filtersList.length){
                        filtersList = filters.append('<ul></ul>').find('> ul');
                    }

                    // To avoid cases where user leave filter attribute blank
                    // only take items that have filter attribute
                    masonryContainer.find('.masonry__item[data-masonry-filter]').each(function(){
                        var masonryItem  = $(this),
                            filterString = masonryItem.attr('data-masonry-filter'),
                            filtersArray = [];

                        // If not undefined or empty
                        if(typeof filterString !== typeof undefined && filterString !== ""){
                            // Split tags from string into array 
                            filtersArray = filterString.split(',');
                        }
                        $(filtersArray).each(function(index, tag){

                            // Slugify the tag

                            var slug = mr.util.slugify(tag);

                            // Add the filter class to the masonry item

                            masonryItem.addClass('filter-'+slug);

                            // If this tag does not appear in the list already, add it
                            if(!filtersList.find('[data-masonry-filter="'+slug+'"]').length){
                                filtersList.append('<li data-masonry-filter="'+slug+'">'+tag+'</li>');
                                
                            }
                        }); 
                    });
                    
                    // Remove any unnused filter options in list
                    filtersList.find('[data-masonry-filter]').each(function(){
                        var $this  = $(this),
                            filter = $this.text();
                        
                        if($(this).attr('data-masonry-filter') !== "*"){
                            if(!$masonry.find('.masonry__item[data-masonry-filter*="'+filter+'"]').length){
                                $this.remove();
                            }
                        }
                    });

                    mr.util.sortChildrenByText($(this).find('.masonry__filters ul'));
                    // Add a filter "all" option
                    if(!filtersList.find('[data-masonry-filter="*"]').length){
                        filtersList.prepend('<li class="active" data-masonry-filter="*">'+filterAllText+'</li>');
                    }

                }
                //End of "if filterable masonry item exists"
            }
            //End of "if $masonry is .masonry"
        });

    };

    mr.masonry.updateLayout = function(masonry){
        
        // If no argument is supplied, just apply the update to all masonry sets on the page.
        masonry = typeof masonry !== typeof undefined ? masonry : '.masonry';

        var $masonry = $(masonry);
        

        $masonry.each(function(){
            var collection       = $(this),
                newItems         = collection.find('.masonry__item:not([style])'),
                masonryContainer = collection.find('.masonry__container');

            if(collection.is('.masonry')){
                if(newItems.length){
                    masonryContainer.isotope('appended', newItems).isotope( 'layout');
                }
                
                masonryContainer.isotope('layout');
            }
        });
    };
}

function loadBlazy(){
	var bLazy = new Blazy({
        success: function(e){
	        if($('.masonry__container').data('isotope')){
		        mr.masonry.updateLayout();
		        
	        }
        }
    });
    
    $('.slider').on('beforeChange', function(event, slick, currentSlide, nextSlide){
		bLazy.revalidate();
	});
};

function loadParticals(){
	
	window.requestAnimFrame =
	window.requestAnimationFrame ||
	window.webkitRequestAnimationFrame ||
	window.mozRequestAnimationFrame ||
	window.oRequestAnimationFrame ||
	window.msRequestAnimationFrame ||
	function(callback) {
	    window.setTimeout(callback, 1000 / 60);
	};
	
	var canvas = document.getElementById('c');
	var ctx = canvas.getContext('2d');
	
	canvas.width = window.innerWidth;
	canvas.height = window.innerHeight;
	
	var settings = {
	
	    'basic': {
	
	        'emission_rate': 2,
	        'min_life': 6,
	        'life_range': 8,
	        'min_angle': 0,
	        'angle_range': 360,
	        'min_speed': 25,
	        'speed_range': 20,
	        'min_size': 3,
	        'size_range': 6,
	        'start_colours': [
	            [220, 220, 220, 0.8],
	            [220, 220, 220, 0.8]
	        ],
	        'end_colours': [
	            [220, 220, 220, 0],
	            [220, 220, 220, 0]
	        ]
	    }
	};
	
	var Particle = function(x, y, angle, speed, life, size, start_colour, colour_step) {
	
	    /* the particle's position */
	
	    this.pos = {
	
	        x: x || 0,
	        y: y || 0
	    };
	
	    /* set specified or default values */
	
	    this.speed = speed || 5;
	
	    this.life = life || 1;
	
	    this.size = size || 2;
	
	    this.lived = 0;
	
	    /* the particle's velocity */
	
	    var radians = angle * Math.PI / 180;
	
	    this.vel = {
	
	        x: Math.cos(radians) * speed,
	        y: -Math.sin(radians) * speed
	    };
	
	    /* the particle's colour values */
	    this.colour = start_colour;
	    this.colour_step = colour_step;
	};
	
	var ParticleEmoji = function(x, y, angle, speed, life, size){
		/* the particle's position */
	
	    this.pos = {
	
	        x: x || 0,
	        y: y || 0
	    };
	
	    /* set specified or default values */
	
	    this.speed = speed || 5;
	
	    this.life = life || 1;
	
	    this.size = size || 2;
	
	    this.lived = 0;
	
	    /* the particle's velocity */
	
	    var radians = angle * Math.PI / 180;
	
	    this.vel = {
	
	        x: Math.cos(radians) * speed,
	        y: -Math.sin(radians) * speed
	    };
	    
	    var array = ['😂', '😍', '😜','👍']; 
	    this.emoji  = array[Math.floor(Math.random() * array.length)];
	}
	
	var Emitter = function(x, y, settings) {
	
	    /* the emitter's position */
	
	    this.pos = {
	
	        x: x,
	        y: y
	    };
	
	    /* set specified values */
	
	    this.settings = settings;
	
	    /* How often the emitter needs to create a particle in milliseconds */
	
	    this.emission_delay = 1000 / settings.emission_rate;
	
	    /* we'll get to these later */
	
	    this.last_update = 0;
	
	    this.last_emission = 0;
	
	    /* the emitter's particle objects */
	
	    this.particles = [];
	};
	
	Emitter.prototype.update = function() {
	
	    /* set the last_update variable to now if it's the first update */
	
	    if (!this.last_update) {
	
	        this.last_update = Date.now();
	
	        return;
	    }
	
	    /* get the current time */
	
	    var time = Date.now();
	
	    /* work out the milliseconds since the last update */
	
	    var dt = time - this.last_update;
	
	    /* add them to the milliseconds since the last particle emission */
	
	    this.last_emission += dt;
	
	    /* set last_update to now */
	
	    this.last_update = time;
	
	    /* check if we need to emit a new particle */
	
	    if (this.last_emission > this.emission_delay) {
	
	        /* find out how many particles we need to emit */
	
	        var i = Math.floor(this.last_emission / this.emission_delay);
	
	        /* subtract the appropriate amount of milliseconds from last_emission */
	
	        this.last_emission -= i * this.emission_delay;
	
	        while (i--) {
	
	            /* calculate the particle's properties based on the emitter's settings */
	
	            var start_colour = this.settings.start_colours[Math.floor(this.settings.start_colours.length * Math.random())];
	
	            var end_colour = this.settings.end_colours[Math.floor(this.settings.end_colours.length * Math.random())];
	
	            var life = this.settings.min_life + Math.random() * this.settings.life_range;
	
	            var colour_step = [
	                (end_colour[0] - start_colour[0]) / life, /* red */
	                (end_colour[1] - start_colour[1]) / life, /* green */
	                (end_colour[2] - start_colour[2]) / life, /* blue */
	                (end_colour[3] - start_colour[3]) / life  /* alpha */
	            ];
				
				//random chooses between 2 type of particles
				if(Math.floor((Math.random() * 4) + 1) == 1){
	                var nP = new Particle(
	                    0,
	                    0,
	                    this.settings.min_angle + Math.random() * this.settings.angle_range,
	                    this.settings.min_speed + Math.random() * this.settings.speed_range,
	                    life,
	                    this.settings.min_size + Math.random() * this.settings.size_range,
	                    start_colour.slice(),
	                    colour_step
	                )
	            }else{
	                var nP = new ParticleEmoji(
	                    0,
	                    0,
	                    this.settings.min_angle + Math.random() * this.settings.angle_range,
	                    this.settings.min_speed + Math.random() * this.settings.speed_range,
	                    life,
	                    this.settings.min_size + Math.random() * this.settings.size_range
	                )
	            }
				
	            this.particles.push(nP);
	        }
	    }
	
	    /* convert dt to seconds */
	
	    dt /= 1000;
	
	    /* loop through the existing particles */
	
	    var i = this.particles.length;
	
	    while (i--) {
	
	        var particle = this.particles[i];
	
	        /* skip if the particle is dead */
	
	        if (particle.dead) {
	
	            /* remove the particle from the array */
	
	            this.particles.splice(i, 1);
	
	            continue;
	        }
	
	        /* add the seconds passed to the particle's life */
	
	        particle.lived += dt;
	
	        /* check if the particle should be dead */
	
	        if (particle.lived >= particle.life) {
	
	            particle.dead = true;
	
	            continue;
	        }
	
	        /* calculate the particle's new position based on the seconds passed */
	
	        particle.pos.x += particle.vel.x * dt;
	        particle.pos.y += particle.vel.y * dt;
			
			var x = this.pos.x + particle.pos.x;
		    var y = this.pos.y + particle.pos.y;
			
	        /* draw the particle */
			if(particle.colour !== undefined){
				//if it is not an emoji
				particle.colour[0] += particle.colour_step[0] * dt;
		        particle.colour[1] += particle.colour_step[1] * dt;
		        particle.colour[2] += particle.colour_step[2] * dt;
		        particle.colour[3] += particle.colour_step[3] * dt;
		
		        ctx.fillStyle = 'rgba(' +
		            Math.round(particle.colour[0]) + ',' +
		            Math.round(particle.colour[1]) + ',' +
		            Math.round(particle.colour[2]) + ',' +
		            particle.colour[3] + ')';
				
		        ctx.beginPath();
		        ctx.arc(x, y, particle.size, 0, Math.PI * 2);
		        ctx.fill();
			}else{
				ctx.globalAlpha = particle.lived * 10;
				//ctx.rotate(Math.PI*2/(x*6));
				ctx.font = (particle.size * 5) + "px arial";
				ctx.fillText(particle.emoji, x, y);
			}
	        
	
	    }
	};
	
	var emitter = new Emitter(canvas.width / 2, canvas.height / 2, settings.basic);
	
	function loop() {
	
	    ctx.clearRect(0, 0, canvas.width, canvas.height);
	
	    emitter.update();
	
	    requestAnimFrame(loop);
	}
	
	loop();
}

//loadParticals();

/*
function deleteAllCookies() {
    var cookies = document.cookie.split(";");

    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        var eqPos = cookie.indexOf("=");
        var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
        document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
    }
}

deleteAllCookies();
*/

//Smooth Scrolling
// Select all links with hashes
$('a[href*="#"]')
// Remove links that don't actually link to anything
.not('[href="#"]')
.not('[href="#0"]')
.click(function(event) {
// On-page links
if (
  location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
  && 
  location.hostname == this.hostname
) {
  // Figure out element to scroll to
  var target = $(this.hash);
  target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
  // Does a scroll target exist?
  if (target.length) {
    // Only prevent default if animation is actually gonna happen
    event.preventDefault();
    $('html, body').animate({
      scrollTop: target.offset().top
    }, 750, function() {
      // Callback after animation
      // Must change focus!
      var $target = $(target);
      $target.focus();
      if ($target.is(":focus")) { // Checking if the target was focused
        return false;
      } else {
        $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
        $target.focus(); // Set focus again
      };
    });
	event.preventDefault();
  }
}
});

window.mr = window.mr || {};

mr = (function (mr, $, window, document){
    "use strict";

    mr = mr || {};

    var components = {documentReady: [],documentReadyDeferred: [], windowLoad: [], windowLoadDeferred: []};

    mr.status = {documentReadyRan: false, windowLoadPending: false};

    $(document).ready(documentReady);
    $(window).on("load", windowLoad);

    function documentReady(context){
        
        context = typeof context === typeof undefined ? $ : context;
        components.documentReady.concat(components.documentReadyDeferred).forEach(function(component){
           	component(context);
        });
        mr.status.documentReadyRan = true;
        if(mr.status.windowLoadPending){
            windowLoad(mr.setContext());
        }
    }

    function windowLoad(context){
        if(mr.status.documentReadyRan){
            mr.status.windowLoadPending = false;
            context = typeof context === "object" ? $ : context;
            components.windowLoad.concat(components.windowLoadDeferred).forEach(function(component){
               component(context);
            });
        }else{
            mr.status.windowLoadPending = true;
        }
    }

    mr.setContext = function (contextSelector){
        var context = $;
        if(typeof contextSelector !== typeof undefined){
            return function(selector){
                return $(contextSelector).find(selector);
            };
        }
        return context;
    };

    mr.components    = components;
    mr.documentReady = documentReady;
    mr.windowLoad    = windowLoad;

    return mr;
}(window.mr, jQuery, window, document));


//////////////// Utility Functions
mr = (function (mr, $, window, document){
    "use strict";
    mr.util = {};

    mr.util.requestAnimationFrame    = window.requestAnimationFrame || 
                                       window.mozRequestAnimationFrame || 
                                       window.webkitRequestAnimationFrame ||
                                       window.msRequestAnimationFrame;

    mr.util.documentReady = function($){
        var today = new Date();
        var year = today.getFullYear();
        $('.update-year').text(year);
    };

    mr.util.windowLoad = function($){
        $('[data-delay-src]').each(function(){
            var $el = $(this);
            $el.attr('src', $el.attr('data-delay-src'));
            $el.removeAttr('data-delay-src');
        });
    };

    mr.util.getURLParameter = function(name) {
        return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search) || [undefined, ""])[1].replace(/\+/g, '%20')) || null;
    };


    mr.util.capitaliseFirstLetter = function(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    };

    mr.util.slugify = function(text, spacesOnly){
        if(typeof spacesOnly !== typeof undefined){
            return text.replace(/ +/g, '');
        }else{
            return text
                .toLowerCase()
                .replace(/[\~\!\@\#\$\%\^\&\*\(\)\-\_\=\+\]\[\}\{\'\"\;\\\:\?\/\>\<\.\,]+/g, '')
                .replace(/ +/g, '-');
        }
    };

    mr.util.sortChildrenByText = function(parentElement, reverse){
        var $parentElement = $(parentElement);
        var items          = $parentElement.children().get();
        var order          = -1;
        var order2         = 1;
        if(typeof reverse !== typeof undefined){order = 1; order2 = -1;}

        items.sort(function(a,b){
          var keyA = $(a).text();
          var keyB = $(b).text();

          if (keyA < keyB) return order;
          if (keyA > keyB) return order2;
          return 0;
        });
        
        // Append back into place
        $parentElement.empty();
        $(items).each(function(i, itm){
          $parentElement.append(itm);
        });
    };
    
    // Set data-src attribute of element from src to be restored later
    mr.util.idleSrc = function(context, selector){
        
            selector  = (typeof selector !== typeof undefined) ? selector : '';
            var elems = context.is(selector+'[src]') ? context : context.find(selector+'[src]');

        elems.each(function(index, elem){
            elem           = $(elem);
            var currentSrc = elem.attr('src'),
                dataSrc    = elem.attr('data-src');

            // If there is no data-src, save current source to it
            if(typeof dataSrc === typeof undefined){
                elem.attr('data-src', currentSrc);
            }

            // Clear the src attribute
            elem.attr('src', '');    
            
        });
    };

    // Set src attribute of element from its data-src where it was temporarily stored earlier
    mr.util.activateIdleSrc = function(context, selector){
        
        selector     = (typeof selector !== typeof undefined) ? selector : '';
        var elems    = context.is(selector+'[data-src]') ? context : context.find(selector+'[data-src]');

        elems.each(function(index, elem){
            elem = $(elem);
            var dataSrc    = elem.attr('data-src');

            // Write the 'src' attribute using the 'data-src' value
            elem.attr('src', dataSrc);
        });
    };

    mr.util.pauseVideo = function(context){
        var elems = context.is('video') ? context : context.find('video');

        elems.each(function(index, video){
            var playingVideo = $(video).get(0);
            playingVideo.pause();
        });
    };

    // Take a text value in either px (eg. 150px) or vh (eg. 65vh) and return a number in pixels.
    mr.util.parsePixels = function(text){
        var windowHeight = $(window).height(), value;
        
        // Text text against regular expression for px value.
        if(/^[1-9]{1}[0-9]*[p][x]$/.test(text)){
            return parseInt(text.replace('px', ''),10);
        }
        // Otherwise it is vh value.
        else if(/^[1-9]{1}[0-9]*[v][h]$/.test(text)){
            value = parseInt(text.replace('vh', ''),10);
            // Return conversion to percentage of window height.
            return windowHeight * (value/100);
        }else{
            // If it is not proper text, return -1 to indicate bad value.
            return -1;
        }
    };

    mr.util.removeHash = function() { 
        // Removes hash from URL bar without reloading and without losing search query
        history.pushState("", document.title, window.location.pathname + window.location.search);
    }

    mr.components.documentReady.push(mr.util.documentReady);
    mr.components.windowLoad.push(mr.util.windowLoad);
    return mr;

}(mr, jQuery, window, document));

//////////////// Window Functions
mr = (function (mr, $, window, document){
    "use strict";

    mr.window = {};
    mr.window.height = $(window).height();
    mr.window.width = $(window).width();

    $(window).on('resize',function(){
        mr.window.height = $(window).height();
        mr.window.width = $(window).width();
    });

    return mr;
}(mr, jQuery, window, document));


//////////////// Scroll Functions
mr = (function (mr, $, window, document){
    "use strict";

    
    mr.scroll           = {};
    var raf             = window.requestAnimationFrame || 
                          window.mozRequestAnimationFrame || 
                          window.webkitRequestAnimationFrame ||
                          window.msRequestAnimationFrame;
    mr.scroll.listeners = [];
    mr.scroll.busy      = false;
    mr.scroll.y         = 0;
    mr.scroll.x         = 0;
    
    var documentReady = function($){

        //////////////// Capture Scroll Event and fire scroll function
        jQuery(window).off('scroll.mr');    
        jQuery(window).on('scroll.mr', function(evt) {
                if(mr.scroll.busy === false){
                    
                    mr.scroll.busy = true;
                    raf(function(evt){  
                        mr.scroll.update(evt);
                    });
                    
                }
                if(evt.stopPropagation){
                    evt.stopPropagation();
                }
        });
        
    };

    mr.scroll.update = function(event){
        
        // Loop through all mr scroll listeners
        var parallax = typeof window.mr_parallax !== typeof undefined ? true : false;
        mr.scroll.y = (parallax ? mr_parallax.mr_getScrollPosition() : window.pageYOffset);
        mr.scroll.busy = false;
        if(parallax){
            mr_parallax.mr_parallaxBackground();
        }


        if(mr.scroll.listeners.length > 0){
            for (var i = 0, l = mr.scroll.listeners.length; i < l; i++) {
               mr.scroll.listeners[i](event);
            }
        }
        
    };

    mr.scroll.documentReady = documentReady;

    mr.components.documentReady.push(documentReady);

    return mr;

}(mr, jQuery, window, document));


//////////////// Scroll Class Modifier
mr = (function (mr, $, window, document){
    "use strict";

    mr.scroll.classModifiers = {};
    // Globally accessible list of elements/rules
    mr.scroll.classModifiers.rules = [];

    mr.scroll.classModifiers.parseScrollRules = function(element){
        var text  = element.attr('data-scroll-class'),
            rules = text.split(";");

        rules.forEach(function(rule){
            var ruleComponents, scrollPoint, ruleObject = {};
            ruleComponents = rule.replace(/\s/g, "").split(':');
            if(ruleComponents.length === 2){
                scrollPoint = mr.util.parsePixels(ruleComponents[0]);
                if(scrollPoint > -1){
                    ruleObject.scrollPoint = scrollPoint;
                    if(ruleComponents[1].length){
                        var toggleClass = ruleComponents[1];
                        ruleObject.toggleClass = toggleClass;
                        // Set variable in object to indicate that element already has class applied
                        ruleObject.hasClass = element.hasClass(toggleClass);
                        ruleObject.element = element.get(0);
                        mr.scroll.classModifiers.rules.push(ruleObject);
                    }else{
                        // Error: toggleClass component does not exist.
                        //console.log('Error - toggle class not found.');
                        return false;
                    }
                }else{
                    // Error: scrollpoint component was malformed
                    //console.log('Error - Scrollpoint not found.');
                    return false;
                }
            }   
        });
        
        if(mr.scroll.classModifiers.rules.length){
            return true;
        }else{
            return false;
        }
    };

    mr.scroll.classModifiers.update = function(event){
        var currentScroll = mr.scroll.y,
            scrollRules   = mr.scroll.classModifiers.rules,
            l             = scrollRules.length,
            currentRule;
        
        // Given the current scrollPoint, check for necessary changes 
        while(l--) {
            
            currentRule = scrollRules[l];
            
            if(currentScroll > currentRule.scrollPoint && !currentRule.hasClass){
                // Set local copy and glogal copy at the same time;
                currentRule.element.classList.add(currentRule.toggleClass);
                currentRule.hasClass = mr.scroll.classModifiers.rules[l].hasClass = true;
            }
            if(currentScroll < currentRule.scrollPoint && currentRule.hasClass){
                // Set local copy and glogal copy at the same time;
                currentRule.element.classList.remove(currentRule.toggleClass);
                currentRule.hasClass = mr.scroll.classModifiers.rules[l].hasClass = false;
            }
        }
    };

    var fixedElementSizes = function(){
        $('.main-container [data-scroll-class*="pos-fixed"]').each(function(){
            var element = $(this);
            element.css('max-width',element.parent().outerWidth());
            element.parent().css('min-height',element.outerHeight());
        });
    };

    var documentReady = function($){
        // Collect info on all elements that require class modification at load time
        // Each element has data-scroll-class with a formatted value to represent class to add/remove at a particular scroll point.
        $('[data-scroll-class]').each(function(){
            var element  = $(this);
                
            // Test the rules to be added to an array of rules.
            if(!mr.scroll.classModifiers.parseScrollRules(element)){
                console.log('Error parsing scroll rules on: '+element);
            }
        });

        // For 'position fixed' elements, give them a max-width for correct fixing behaviour
        fixedElementSizes();
        $(window).on('resize', fixedElementSizes);
        
        // If there are valid scroll rules add classModifiers update function to the scroll event processing queue.
        if(mr.scroll.classModifiers.rules.length){
            mr.scroll.listeners.push(mr.scroll.classModifiers.update);
        }
    };

    mr.components.documentReady.push(documentReady);
    mr.scroll.classModifiers.documentReady = documentReady;    

    

    return mr;

}(mr, jQuery, window, document));


//////////////// Accordions
mr = (function (mr, $, window, document){
    "use strict";

    mr.accordions = mr.accordions || {};
    
    mr.accordions.documentReady = function($){
        $('.accordion__title').on('click', function(){
            mr.accordions.activatePanel($(this));
        });

        $('.accordion').each(function(){
            var accordion = $(this);
            var minHeight = accordion.outerHeight(true);
            accordion.css('min-height',minHeight);
        });

        if(window.location.hash !== '' && window.location.hash !== '#' && window.location.hash.match(/#\/.*/) === null){
            if($('.accordion > li > .accordion__title'+window.location.hash).length){
                 mr.accordions.activatePanelById(window.location.hash, true);
            }
        }

        jQuery(document).on('click', 'a[href^="#"]:not(a[href="#"])', function(){
             
             if($('.accordion > li > .accordion__title'+$(this).attr('href')).length){
                mr.accordions.activatePanelById($(this).attr('href'), true);
             }
        });
    };

    

    mr.accordions.activatePanel = function(panel, forceOpen){
        
        var $panel    = $(panel),
            accordion = $panel.closest('.accordion'),
            li        = $panel.closest('li'),
            openEvent = document.createEvent('Event'),
            closeEvent = document.createEvent('Event');
            
            openEvent.initEvent('panelOpened.accordions.mr', true, true);
            closeEvent.initEvent('panelClosed.accordions.mr', true, true);
        


        if(li.hasClass('active')){
            
            if(forceOpen !== true){
                
                li.removeClass('active');
                $panel.trigger('panelClosed.accordions.mr').get(0).dispatchEvent(closeEvent);
            }
        }else{
            
            if(accordion.hasClass('accordion--oneopen')){
                
                var wasActive = accordion.find('li.active');
                if(wasActive.length){
                    wasActive.removeClass('active');
                    wasActive.trigger('panelClosed.accordions.mr').get(0).dispatchEvent(closeEvent);
                }
                li.addClass('active');
                li.trigger('panelOpened.accordions.mr').get(0).dispatchEvent(openEvent);
                
            }else{
                
                if(!li.is('.active')){
                    li.trigger('panelOpened.accordions.mr').get(0).dispatchEvent(openEvent);
                }
                li.addClass('active');
            }
        }
    };

    mr.accordions.activatePanelById = function(id, forceOpen){
        var panel;
       
        if(id !== '' && id !== '#' && id.match(/#\/.*/) === null){
            panel = $('.accordion > li > .accordion__title#'+id.replace('#', ''));
            if(panel.length){
                $('html, body').stop(true).animate({
                    scrollTop: (panel.offset().top - 50)
                }, 1200);
                
                mr.accordions.activatePanel(panel, forceOpen);
            }
        }
    };

    mr.components.documentReady.push(mr.accordions.documentReady);
    return mr;

}(mr, jQuery, window, document));


//////////////// Alerts
mr = (function (mr, $, window, document){
    "use strict";

    mr.alerts = mr.alerts || {};
    
    mr.alerts.documentReady = function($){
        $('.alert__close').on('click touchstart', function(){
            jQuery(this).closest('.alert').addClass('alert--dismissed');
        });
    };

    mr.components.documentReady.push(mr.alerts.documentReady);
    return mr;

}(mr, jQuery, window, document));


//////////////// Backgrounds
mr = (function (mr, $, window, document){
    "use strict";
    
    mr.backgrounds = mr.backgrounds || {};
    
    mr.backgrounds.documentReady = function($){
        
        //////////////// Append .background-image-holder <img>'s as CSS backgrounds
	    loadBackgrounds();
    };

    mr.components.documentReady.push(mr.backgrounds.documentReady);
    return mr;

}(mr, jQuery, window, document));

//////////////// Bars
mr = (function (mr, $, window, document){
    "use strict";
    
    mr.bars = mr.bars || {};
    
    mr.bars.documentReady = function($){
        $('.nav-container .bar[data-scroll-class*="fixed"]:not(.bar--absolute)').each(function(){
            var bar = $(this),
                barHeight = bar.outerHeight(true);
            bar.closest('.nav-container').css('min-height',barHeight);
        });
    };

    mr.components.documentReady.push(mr.bars.documentReady);
    return mr;

}(mr, jQuery, window, document));

//////////////// Cookies
mr = (function (mr, $, window, document){
    "use strict";
    
    mr.cookies = {

        getItem: function (sKey) {
            if (!sKey) { return null; }
            return decodeURIComponent(document.cookie.replace(new RegExp("(?:(?:^|.*;)\\s*" + encodeURIComponent(sKey).replace(/[\-\.\+\*]/g, "\\$&") + "\\s*\\=\\s*([^;]*).*$)|^.*$"), "$1")) || null;
        },
        setItem: function (sKey, sValue, vEnd, sPath, sDomain, bSecure) {
            if (!sKey || /^(?:expires|max\-age|path|domain|secure)$/i.test(sKey)) { return false; }
                var sExpires = "";
                if (vEnd) {
                  switch (vEnd.constructor) {
                    case Number:
                      sExpires = vEnd === Infinity ? "; expires=Fri, 31 Dec 9999 23:59:59 GMT" : "; max-age=" + vEnd;
                      break;
                    case String:
                      sExpires = "; expires=" + vEnd;
                      break;
                    case Date:
                      sExpires = "; expires=" + vEnd.toUTCString();
                      break;
                }
            }
            document.cookie = encodeURIComponent(sKey) + "=" + encodeURIComponent(sValue) + sExpires + (sDomain ? "; domain=" + sDomain : "") + (sPath ? "; path=" + sPath : "") + (bSecure ? "; secure" : "");
            return true;
        },
        removeItem: function (sKey, sPath, sDomain) {
            if (!this.hasItem(sKey)) { return false; }
            document.cookie = encodeURIComponent(sKey) + "=; expires=Thu, 01 Jan 1970 00:00:00 GMT" + (sDomain ? "; domain=" + sDomain : "") + (sPath ? "; path=" + sPath : "");
            return true;
        },
        hasItem: function (sKey) {
            if (!sKey) { return false; }
            return (new RegExp("(?:^|;\\s*)" + encodeURIComponent(sKey).replace(/[\-\.\+\*]/g, "\\$&") + "\\s*\\=")).test(document.cookie);
        },
        keys: function () {
            var aKeys = document.cookie.replace(/((?:^|\s*;)[^\=]+)(?=;|$)|^\s*|\s*(?:\=[^;]*)?(?:\1|$)/g, "").split(/\s*(?:\=[^;]*)?;\s*/);
            for (var nLen = aKeys.length, nIdx = 0; nIdx < nLen; nIdx++) { aKeys[nIdx] = decodeURIComponent(aKeys[nIdx]); }
            return aKeys;
        }
    };

    return mr;

}(mr, jQuery, window, document));

//////////////// Countdown
mr = (function (mr, $, window, document){
    "use strict";
    
    mr.countdown = mr.countdown || {};
    mr.countdown.options = mr.countdown.options || {};

    mr.countdown.documentReady = function($){

        $('.countdown[data-date]').each(function(){
            var element      = $(this),
                date         = element.attr('data-date'),
                daysText     = typeof element.attr('data-days-text') !== typeof undefined ? '%D '+element.attr('data-days-text')+' %H:%M:%S': '%D days %H:%M:%S',
                daysText     = typeof mr.countdown.options.format !== typeof undefined ? mr.countdown.options.format : daysText,
                dateFormat   = typeof element.attr('data-date-format') !== typeof undefined ? element.attr('data-date-format'): daysText,
                
                fallback;

            if(typeof element.attr('data-date-fallback') !== typeof undefined){
                fallback = element.attr('data-date-fallback') || "Timer Done";
            }

            element.countdown(date, function(event) {
                if(event.elapsed){
                    element.text(fallback);
                }else{
                    element.text(
                      event.strftime(dateFormat)
                    );
                }
            });
        });
        
    };

    mr.components.documentReadyDeferred.push(mr.countdown.documentReady);
    return mr;

}(mr, jQuery, window, document));

//////////////// Datepicker
mr = (function (mr, $, window, document){
    "use strict";
    
    mr.datepicker = mr.datepicker || {};

    var options = mr.datepicker.options || {};
    
    mr.datepicker.documentReady = function($){
        if($('.datepicker').length){
            $('.datepicker').pickadate(options);
        }
    };

    mr.components.documentReadyDeferred.push(mr.datepicker.documentReady);
    return mr;

}(mr, jQuery, window, document));

//////////////// Dropdowns
mr = (function (mr, $, window, document){
    "use strict";
    
    mr.dropdowns = mr.dropdowns || {};

    mr.dropdowns.done = false;
    
    mr.dropdowns.documentReady = function($){

        var rtl = false;

        if($('html[dir="rtl"]').length){
            rtl = true;
        }

        if(!mr.dropdowns.done){
            jQuery(document).on('click','body:not(.dropdowns--hover) .dropdown, body.dropdowns--hover .dropdown.dropdown--click',function(event){
                var dropdown = jQuery(this);
                if(jQuery(event.target).is('.dropdown--active > .dropdown__trigger')){
                    dropdown.siblings().removeClass('dropdown--active').find('.dropdown').removeClass('dropdown--active');
                    dropdown.toggleClass('dropdown--active');
                }else{
                    $('.dropdown--active').removeClass('dropdown--active');
                    dropdown.addClass('dropdown--active');
                }
            });
            jQuery(document).on('click touchstart', 'body:not(.dropdowns--hover)', function(event){
                if(!jQuery(event.target).is('[class*="dropdown"], [class*="dropdown"] *')){
                    $('.dropdown--active').removeClass('dropdown--active');
                }
            });
            jQuery('body.dropdowns--hover .dropdown').on('click', function(event){
                event.stopPropagation();
                var hoverDropdown = jQuery(this);
                hoverDropdown.toggleClass('dropdown--active');
            });

            // Append a container to the body for measuring purposes
            jQuery('body').append('<div class="container containerMeasure" style="opacity:0;pointer-events:none;"></div>');

            
        

            // Menu dropdown positioning
            if(rtl === false){
                mr.dropdowns.repositionDropdowns($);
                jQuery(window).on('resize', function(){mr.dropdowns.repositionDropdowns($);});
            }else{
                mr.dropdowns.repositionDropdownsRtl($);
                jQuery(window).on('resize', function(){mr.dropdowns.repositionDropdownsRtl($);});
            }

            mr.dropdowns.done = true;
        }
    };

    mr.dropdowns.repositionDropdowns = function($){
        $('.dropdown__container').each(function(){
            var container, containerOffset, masterOffset, menuItem, content;

                jQuery(this).css('left', '');

                container       = jQuery(this);  
                containerOffset = container.offset().left;
                masterOffset    = jQuery('.containerMeasure').offset().left;
                menuItem        = container.closest('.dropdown').offset().left;
                content         = null;
                
                container.css('left',((-containerOffset)+(masterOffset)));

                if(container.find('.dropdown__content:not([class*="lg-12"])').length){
                    content = container.find('.dropdown__content');
                    content.css('left', ((menuItem)-(masterOffset)));
                }
                
        });
        $('.dropdown__content').each(function(){
            var dropdown, offset, width, offsetRight, winWidth, leftCorrect;

                dropdown    = jQuery(this);
                offset      = dropdown.offset().left;
                width       = dropdown.outerWidth(true);
                offsetRight = offset + width;
                winWidth    = jQuery(window).outerWidth(true);
                leftCorrect = jQuery('.containerMeasure').outerWidth() - width;

            if(offsetRight > winWidth){
                dropdown.css('left', leftCorrect);
            }

        });
    };

    mr.dropdowns.repositionDropdownsRtl = function($){

        var windowWidth = jQuery(window).width();

        $('.dropdown__container').each(function(){
            var container, containerOffset, masterOffset, menuItem, content;
 
                jQuery(this).css('left', '');

                container   = jQuery(this);
                containerOffset = windowWidth - (container.offset().left + container.outerWidth(true));
                masterOffset    = jQuery('.containerMeasure').offset().left;
                menuItem        = windowWidth - (container.closest('.dropdown').offset().left + container.closest('.dropdown').outerWidth(true));
                content         = null;
                
                container.css('right',((-containerOffset)+(masterOffset)));

                if(container.find('.dropdown__content:not([class*="lg-12"])').length){
                    content = container.find('.dropdown__content');
                    content.css('right', ((menuItem)-(masterOffset)));
                }
        });
        $('.dropdown__content').each(function(){
            var dropdown, offset, width, offsetRight, winWidth, rightCorrect;

                dropdown    = jQuery(this);
                offset      = windowWidth - (dropdown.offset().left + dropdown.outerWidth(true));
                width       = dropdown.outerWidth(true);
                offsetRight = offset + width;
                winWidth    = jQuery(window).outerWidth(true);
                rightCorrect = jQuery('.containerMeasure').outerWidth() - width;

            if(offsetRight > winWidth){
               dropdown.css('right', rightCorrect);
            }

        });
    };
    

    mr.components.documentReady.push(mr.dropdowns.documentReady);
    return mr;

}(mr, jQuery, window, document));

//////////////// Forms

mr = (function (mr, $, window, document){
    "use strict";
    
    mr.forms                 = mr.forms || {};
    mr.forms.captcha         = {};
    mr.forms.captcha.widgets = [];
    mr.forms.captcha.done    = false;

    mr.forms.documentReady = function($){

        mr.forms.captcha.widgets = [];

        /// Checkbox & Radio Inputs

        $('.input-checkbox input[type="checkbox"], .input-radio input[type="radio"]').each(function(index){
            var input = $(this),
                label = input.siblings('label'),
                id    = "input-assigned-"+index;
            if(typeof input.attr('id') === typeof undefined || input.attr('id') === ""){
                input.attr('id',id);
                label.attr('for',id);
            }else{
                id = input.attr('id');
                label.attr('for',id);
            }
        });

        //////////////// Number Inputs

        $('.input-number__controls > span').off('click.mr').on('click.mr',function(){
            var control = jQuery(this),
                parent   = control.closest('.input-number'),
                input    = parent.find('input[type="number"]'),
                max      = input.attr('max'),
                min      = input.attr('min'),
                step     = 1,
                current  = parseInt(input.val(),10);

            if(parent.is('[data-step]')){
                step = parseInt(parent.attr('data-step'),10);
            }

            if(control.hasClass('input-number__increase')){
                if((current+step) <= max){
                    input.val(current+step);
                }
            }else{
                if((current-step) >= min){
                    input.val(current-step);
                }
            }
        });


        //////////////// File Uploads

        $('.input-file .btn').off('click.mr').on('click.mr',function(){
            $(this).siblings('input').trigger('click');
            return false;
        });
        
        //////////////// Handle Form Submit

        $('form.form-email, form.form-checkout:not(.form-valid), form[action*="list-manage.com"], form[action*="createsend.com"]').attr('novalidate', true).off('submit').on('submit', mr.forms.submit);

        //////////////// Handle Form Submit
        $(document).on('change, input, paste, keyup, click', '.attempted-submit .field-error, .attempted-submit .input-checkbox.field-error', function(){
            $(this).removeClass('field-error');
        });

         //////////////// Check forms for Google reCaptcha site keys

        $('form[data-recaptcha-sitekey]:not([data-recaptcha-sitekey=""])').each(function(){
            var $thisForm    = jQuery(this),
                $captchaDiv  = $thisForm.find('div.recaptcha'),
                $insertBefore, $column, widgetObject,  $script, scriptSrc, widgetColourTheme, widgetSize;

            widgetColourTheme = $thisForm.attr('data-recaptcha-theme');
            widgetColourTheme = typeof widgetColourTheme !== typeof undefined ? widgetColourTheme : '';

            widgetSize = $thisForm.attr('data-recaptcha-size');
            widgetSize = typeof widgetSize !== typeof undefined ? widgetSize : '';

            // Store the site key for later use
            mr.forms.captcha.sitekey = $thisForm.attr('data-recaptcha-sitekey');

            if($captchaDiv.length){
                // If a div.recaptcha was already present on this form, do nothing at this stage,
                // It will be populated with a captcha widget later.
            }else{
                // Create a captcha div and insert it before the submit button.
                $insertBefore = $thisForm.find('button[type=submit]').closest('[class*="col-"]');
                $captchaDiv   = jQuery('<div>').addClass('recaptcha');
                $column       = jQuery('<div>').addClass('col-12').append($captchaDiv);
                $column.insertBefore($insertBefore);
            }

       
            // Add the widget div to the widgets array
            widgetObject = {
                element:    $captchaDiv.get(0),
                parentForm: $thisForm,
                theme:      widgetColourTheme,
                size:       widgetSize,
            };

          

            mr.forms.captcha.widgets.push(widgetObject);

            // mr.forms.captcha.done indicates whether the api script has been appended yet.
            if(mr.forms.captcha.done === false){
                if(!jQuery('script[src*="recaptcha/api.js"]').length){
                    $script   = jQuery('<script async defer>');
                    scriptSrc = 'https://www.google.com/recaptcha/api.js?onload=mrFormsCaptchaInit&render=explicit';
                    $script.attr('src', scriptSrc);
                    jQuery('body').append($script);
                    mr.forms.captcha.done = true;
                }
            }else{
                if(typeof grecaptcha !== typeof undefined){
                    mr.forms.captcha.renderWidgets();    
                }
            }

        });


    };
    
    mr.forms.submit = function(e){
        // return false so form submits through jQuery rather than reloading page.
        if (e.preventDefault) e.preventDefault();
        else e.returnValue = false;

        var body          = $('body'),
            thisForm      = $(e.target).closest('form'),
            formAction    = typeof thisForm.attr('action') !== typeof undefined ? thisForm.attr('action') : "",
            submitButton  = thisForm.find('button[type="submit"], input[type="submit"]'),
            error         = 0,
            originalError = thisForm.attr('original-error'),
            captchaUsed   = thisForm.find('div.recaptcha').length ? true:false,
            successRedirect, formError, formSuccess, errorText, successText;

        body.find('.form-error, .form-success').remove();
        submitButton.attr('data-text', submitButton.text());
        errorText = thisForm.attr('data-error') ? thisForm.attr('data-error') : "Please fill all fields correctly";
        successText = thisForm.attr('data-success') ? thisForm.attr('data-success') : "Thanks, we'll be in touch shortly";
        body.append('<div class="form-error" style="display: none;">' + errorText + '</div>');
        body.append('<div class="form-success" style="display: none;">' + successText + '</div>');
        formError = body.find('.form-error');
        formSuccess = body.find('.form-success');
        thisForm.addClass('attempted-submit');

        // Do this if the form is intended to be submitted to MailChimp or Campaign Monitor
        if (formAction.indexOf('createsend.com') !== -1 || formAction.indexOf('list-manage.com') !== -1 ) {

            console.log('Mail list form signup detected.');
            if (typeof originalError !== typeof undefined && originalError !== false) {
                formError.html(originalError);
            }
            
            // validateFields returns 1 on error;
            if (mr.forms.validateFields(thisForm) !== 1) {
               
                thisForm.removeClass('attempted-submit');

                // Hide the error if one was shown
                formError.fadeOut(200);
                // Create a new loading spinner in the submit button.
                submitButton.addClass('btn--loading');
                
                try{
                    $.ajax({
                        url: thisForm.attr('action'),
                        crossDomain: true,
                        data: thisForm.serialize(),
                        method: "GET",
                        cache: false,
                        dataType: 'json',
                        contentType: 'application/json; charset=utf-8',
                        success: function(data){
                            // Request was a success, what was the response?

                            if (data.result !== "success" && data.Status !== 200) {
                                
                                // Got an error from Mail Chimp or Campaign Monitor

                                // Keep the current error text in a data attribute on the form
                                formError.attr('original-error', formError.text());
                                // Show the error with the returned error text.
                                formError.html(data.msg).stop(true).fadeIn(1000);
                                formSuccess.stop(true).fadeOut(1000);

                                submitButton.removeClass('btn--loading');
                            } else {
                                
                                // Got success from Mail Chimp or Campaign Monitor
                                
                                submitButton.removeClass('btn--loading');

                                successRedirect = thisForm.attr('data-success-redirect');
                                // For some browsers, if empty `successRedirect` is undefined; for others,
                                // `successRedirect` is false.  Check for both.
                                if (typeof successRedirect !== typeof undefined && successRedirect !== false && successRedirect !== "") {
                                    window.location = successRedirect;
                                }else{
                                    mr.forms.resetForm(thisForm);
                                    mr.forms.showFormSuccess(formSuccess, formError, 1000, 5000, 500);
                                }
                            }
                        }
                    });
                }catch(err){
                    // Keep the current error text in a data attribute on the form
                    formError.attr('original-error', formError.text());
                    // Show the error with the returned error text.
                    formError.html(err.message);
                    mr.forms.showFormError(formSuccess, formError, 1000, 5000, 500);

                    submitButton.removeClass('btn--loading');
                }
            

                
            } else {
                // There was a validation error - show the default form error message
                mr.forms.showFormError(formSuccess, formError, 1000, 5000, 500);
            }
        } else {
            // If no MailChimp or Campaign Monitor form was detected then this is treated as an email form instead.
            if (typeof originalError !== typeof undefined && originalError !== false) {
                formError.text(originalError);
            }

            error = mr.forms.validateFields(thisForm);

            if (error === 1) {
                mr.forms.showFormError(formSuccess, formError, 1000, 5000, 500);
            } else {

                thisForm.removeClass('attempted-submit');

                // Hide the error if one was shown
                formError.fadeOut(200);
                
                // Create a new loading spinner in the submit button.
                submitButton.addClass('btn--loading');
				
				if(thisForm.hasClass('form-checkout') && thisForm.hasClass('form-valid')) {
					thisForm.off('submit', mr.forms.submit).on('submit');
					thisForm.submit();
				    return false;
				}
				
                jQuery.ajax({
                    type: "POST",
                    url: (formAction !== "" ? formAction : "mail/mail.php"),
                    data: thisForm.serialize()+"&url="+window.location.href+"&captcha="+captchaUsed,
                    success: function(response) {
                        // Swiftmailer always sends back a number representing number of emails sent.
                        // If this is numeric (not Swift Mailer error text) AND greater than 0 then show success message.

                        submitButton.removeClass('btn--loading');

                        if ($.isNumeric(response)) {
                            if (parseInt(response,10) > 0) {
                                // For some browsers, if empty 'successRedirect' is undefined; for others,
                                // 'successRedirect' is false.  Check for both.
                                successRedirect = thisForm.attr('data-success-redirect');
                                if (typeof successRedirect !== typeof undefined && successRedirect !== false && successRedirect !== "") {
                                    window.location = successRedirect;
                                }

                                mr.forms.resetForm(thisForm);
                                mr.forms.showFormSuccess(formSuccess, formError, 1000, 5000, 500);
                                mr.forms.captcha.resetWidgets();
                            }
                        }
                        // If error text was returned, put the text in the .form-error div and show it.
                        else {
                            // Keep the current error text in a data attribute on the form
                            formError.attr('original-error', formError.text());
                            // Show the error with the returned error text.
                            formError.text(response).stop(true).fadeIn(1000);
                            formSuccess.stop(true).fadeOut(1000);
                        }
                    },
                    error: function(errorObject, errorText, errorHTTP) {
                        // Keep the current error text in a data attribute on the form
                        formError.attr('original-error', formError.text());
                        // Show the error with the returned error text.
                        formError.text(errorHTTP).stop(true).fadeIn(1000);
                        formSuccess.stop(true).fadeOut(1000);
                        submitButton.removeClass('btn--loading');
                    }
                });
            }
        }
        return false;
    };
    
    mr.forms.validateFields = function(form) {
        var body = $(body),
            error = false,
            originalErrorMessage,
            name,
            thisElement;

            form = $(form);

        form.find('.validate-required[type="checkbox"]').each(function() {
            var checkbox = $(this);
            if (!$('[name="' + $(this).attr('name') + '"]:checked').length) {
                error = 1;
                name = $(this).attr('data-name') ||  'check';
                checkbox.parent().addClass('field-error');
                //body.find('.form-error').text('Please tick at least one ' + name + ' box.');
            }
        });

        form.find('.validate-required, .required, [required]').not('input[type="checkbox"]').each(function() {
            if ($(this).val() === '') {
                $(this).addClass('field-error');
                error = 1;
            } else {
                $(this).removeClass('field-error');
            }
        });

        form.find('.validate-email, .email, [name*="cm-"][type="email"]').each(function() {
            if (!(/(.+)@(.+){2,}\.(.+){2,}/.test($(this).val()))) {
                $(this).addClass('field-error');
                error = 1;
            } else {
                $(this).removeClass('field-error');
            }
        });

        form.find('.validate-number-dash').each(function() {
            if (!(/^[0-9][0-9-]+[0-9]$/.test($(this).val()))) {
                $(this).addClass('field-error');
                error = 1;
            } else {
                $(this).removeClass('field-error');
            }
        });

        // Validate recaptcha
        if(form.find('div.recaptcha').length && typeof form.attr('data-recaptcha-sitekey') !== typeof undefined){
            thisElement = $(form.find('div.recaptcha'));
    
            if(grecaptcha.getResponse(form.data('recaptchaWidgetID')) !== ""){
                thisElement.removeClass('field-error');
            }else{
                thisElement.addClass('field-error');
                error = 1;
            }
        }

        if (!form.find('.field-error').length) {
            body.find('.form-error').fadeOut(1000);
            form.addClass('form-valid');
        }else{
            form.removeClass('form-valid');
            var firstError = $(form).find('.field-error:first');
            
            if(firstError.length){
                $('html, body').stop(true).animate({
                    scrollTop: (firstError.offset().top - 100)
                }, 1200, function(){firstError.focus();});
            }
        }



        return error;
    };

    mr.forms.showFormSuccess = function(formSuccess, formError, fadeOutError, wait, fadeOutSuccess){
        
        formSuccess.stop(true).fadeIn(fadeOutError);

        formError.stop(true).fadeOut(fadeOutError);
        setTimeout(function() {
            formSuccess.stop(true).fadeOut(fadeOutSuccess);
        }, wait);
    };

    mr.forms.showFormError = function(formSuccess, formError, fadeOutSuccess, wait, fadeOutError){
        
        formError.stop(true).fadeIn(fadeOutSuccess);

        formSuccess.stop(true).fadeOut(fadeOutSuccess);
        setTimeout(function() {
            formError.stop(true).fadeOut(fadeOutError);
        }, wait);
    };

    // Reset form to empty/default state.
    mr.forms.resetForm = function(form){
        form = $(form);
        form.get(0).reset();
        form.find('.input-radio, .input-checkbox').removeClass('checked');
        form.find('[data-default-value]').filter('[type="text"],[type="number"],[type="email"],[type="url"],[type="search"],[type="tel"]').each(function(){
            var elem = jQuery(this);
            elem.val(elem.attr('data-default-value'));
        });

    };

    // Defined on the window scope as the recaptcha js api seems not to be able to call function in mr scope
    window.mrFormsCaptchaInit = function(){
        mr.forms.captcha.renderWidgets();
    };

    mr.forms.captcha.renderWidgets = function(){
        mr.forms.captcha.widgets.forEach(function(widget){
            if(widget.element.innerHTML.replace(/[\s\xA0]+/g,'') === ''){
                widget.id = grecaptcha.render(widget.element, {
                    'sitekey' : mr.forms.captcha.sitekey,
                    'theme' : widget.theme,
                    'size' : widget.size,
                    'callback' : mr.forms.captcha.setHuman
                });
                widget.parentForm.data('recaptchaWidgetID', widget.id);
            }
        });
    };

    mr.forms.captcha.resetWidgets = function(){
        mr.forms.captcha.widgets.forEach(function(widget){
            grecaptcha.reset(widget.id);
        });
    };

    mr.forms.captcha.setHuman = function(){
        jQuery('div.recaptcha.field-error').removeClass('field-error');
    };

    mr.components.documentReadyDeferred.push(mr.forms.documentReady);
    return mr;

}(mr, jQuery, window, document));

//SELECT REQUESTS

mr = (function (mr, $, window, document){
    "use strict";
    
    mr.selectRequest = mr.selectGroup || {};
    
    mr.selectRequest.documentReady = function($){
	    $('body').on( "change", ".select-request", function(e) {
		    let $this = $(this);
		    let url = window.location.href.split("?");
		    
		    //maybe some part which filters out the other parameters
		    
		    window.location.replace(url[0]+'?o='+$this.find('select').val());
	    });
    };
    
    mr.components.documentReadyDeferred.push(mr.selectRequest.documentReady);
    return mr;

}(mr, jQuery, window, document));

//selectGroupInit

mr = (function (mr, $, window, document){
    "use strict";
    
    mr.selectGroup = mr.selectGroup || {};
    
    mr.selectGroup.documentReady = function($){
	    mr.selectGroup.init();

	    $('body').on( "click", ".select-group .select-item", function(e) {
		    var $this = $(this);
		    var parent = $this.closest(".select-group");
		    var group = parent.attr("data-group");
		    
		    //deselect other items within groups
		    $(".select-group[data-group='"+group+"'] .select-item.active").removeClass('active');
		    $(".select-group[data-group='"+group+"'] .select-item input[type='radio']").prop("checked", false);
		    
		    $this.addClass('active');
		    $this.find("input[type='radio']").prop("checked", true);
		    
		    mr.cartButton.construct();
		    
		    if(typeof $this.attr('data-ca') !== typeof undefined && $this.attr('data-ca') !== false){
			    mr.cart.submit( $this );
		    }
	    });
    };
    
    mr.selectGroup.init = function(e){
	    $(".select-item.active").find("input[type='radio']").prop("checked", true);
    };
    
    mr.components.documentReadyDeferred.push(mr.selectGroup.documentReady);
    return mr;

}(mr, jQuery, window, document));

//construct cart button
mr = (function (mr, $, window, document){
    "use strict";
    
    mr.cartButton = mr.cartButton || {};
    
    mr.cartButton.documentReady = function($){
	    mr.cartButton.construct();
    };

    mr.cartButton.construct = function(){
	    
	    if($(".btn.btn--cart").length > 0){
		    $(".btn.btn--cart").each(function(index){
		    	let val = '';
			    let sku = '';
			    let quantity = 0;
			    let price = 0;
			    let btn = $(this);
		    	
		    	let json = JSON.parse(btn.attr('data-stock'));
			    let addToCartText= btn.attr('data-atc') ? btn.attr('data-atc') : "Add to cart";
		        let outOfStockText = btn.attr('data-oos') ? btn.attr('data-oos') : "Out of stock";
		
			    $(".select-group").each(function(index){
			    	val += $(this).find("input[type='radio']:checked").val();
			    });
			    
			    if(Object.keys(json).length > 1 && typeof json[val] !== 'undefined'){
				    sku = json[val].sku;
				    quantity = json[val].quantity;
				    price = json[val].price;
				    if(price % 1 != 0){
					    price = price.toFixed(2).toString().replace('.', ',');
				    }else{
					    price = price.toString().replace('.', ',');
				    }
			    }else{
				    var key = Object.keys(json)[0];
				    sku = json[key].sku;
				    quantity = json[key].quantity;
				    price = json[key].price;
				    if(price % 1 != 0){
					    price = price.toFixed(2).toString().replace('.', ',');
				    }else{
					    price = price.toString().replace('.', ',');
				    }
			    }
			    $('.product-price').text(price);
			    
			    if(quantity !== 0){
				    btn.find('.btn__icon').html('<i class="fa fa-plus mr-2"></i>');
				    btn.find('.btn__text').text(addToCartText);
				    btn.attr("data-ca","store");
				    btn.attr("data-sku",sku);
				    btn.removeClass('btn--disable');
			    }else{
				    btn.find('.btn__icon').html('<i class="fas fa-exclamation-triangle mr-2"></i>');
				    btn.find('.btn__text').text(outOfStockText);
				    btn.attr("data-ca","");
				    btn.attr("data-sku",'');
				    btn.addClass('btn--disable');
			    }
		    	
		    });
	    } 
    };
    
    mr.components.documentReadyDeferred.push(mr.cartButton.documentReady);
    return mr;

}(mr, jQuery, window, document));

//////////////// Cart Ajax

mr = (function (mr, $, window, document){
    "use strict";
    
    mr.cart = mr.cart || {};
    
    mr.cart.documentReady = function($){
		$("body").on( "click", ".btn[data-ca*='e']:not(.btn--disable)", function() {
		    mr.cart.submit( $(this) );
		});
	    
		$('body').on( "click", ".btn-number", function(e) {
			e.preventDefault();
			
			var type = $(this).attr('data-type');
			var input = $(this).closest(".input-quantity").find("input[name='quantity']");
			var currentVal = parseInt(input.val());
			
			if (!isNaN(currentVal)) {
			    if(type == 'minus') {
			        if(currentVal > input.attr('min')) {
			            input.val(currentVal - 1).change();
			        } 
			        if(parseInt(input.val()) == input.attr('min')) {
			            $(this).attr('disabled', true);
			        }
			    } else if(type == 'plus') {
			        if(currentVal < input.attr('max')) {
			            input.val(currentVal + 1).change();
			        }
			        if(parseInt(input.val()) == input.attr('max')) {
			            $(this).attr('disabled', true);
			        }
			    }
			}else{
			    input.val(1);
			}
		});
		
		$('body').on( "change", '.input-number', function() {
			mr.cart.quantityChange( $(this) );
		});
		
		$('body').on( "change", ":input[data-ca*='e']", function() {
			mr.cart.submit( $(this) );
		});
    };
    
    mr.cart.quantityChange = function(e){
        var minValue =  parseInt(e.attr('min'));
		var maxValue =  parseInt(e.attr('max'));
		var valueCurrent = parseInt(e.val());
		var name = e.attr('name');
		
		if(valueCurrent > minValue) {
		    e.closest(".input-quantity").find(".btn-number[data-type='minus']").removeAttr('disabled');
		} else {
		    //alert('Sorry, the minimum value was reached');
		}
		if(valueCurrent < maxValue) {
		    e.closest(".input-quantity").find(".btn-number[data-type='plus']").removeAttr('disabled');
		    e.closest(".cart-item").find(".alert").removeClass("d-block").addClass("d-none");
		} else {
			e.closest(".cart-item").find(".alert").removeClass("d-none").addClass("d-block");
		    //alert('Sorry, the maximum value was reached');
		}

		mr.cart.submit(e.closest(".cart-item"), valueCurrent);
    };
    
    mr.cart.reloadCartResult = function(){
	    
    };
    
    mr.cart.isJson = function(str) {
	    try {
	        JSON.parse(str);
	    } catch (e) {
	        return false;
	    }
	    return true;
	}
    
    //replaces the .data() function. The data retrieved from data() is stored once if it is getting called. Which doesn't provide live data if one of the attributes is being updated after being initialy stored. This function should get rid of that problem because its calling the live values and removing "data-" from the key
    mr.cart.getDataAttributes = function(node) {
	    var d = "", //{} 
	        re_dataAttr = /^data\-(.+)$/;
	
	    $.each(node.get(0).attributes, function(index, attr) {
	        if (re_dataAttr.test(attr.nodeName)) {
	            var key = attr.nodeName.match(re_dataAttr)[1];
	            //d[key] = attr.nodeValue;
	            
	            if(key == "ca"){
					d += '"action":"' + attr.nodeValue + '",';
				}else{
					//makes sure no json objects are parsed as value
					if(!mr.cart.isJson(attr.nodeValue)){
						d += '"' + key + '":"' + attr.nodeValue + '",';
					}
				}
	        }
	    });
	    return d;
	}

    mr.cart.submit = function(e,v){
	    $(".cart").addClass("element-loading");
	    
        // return false so form submits through jQuery rather than reloading page.
        if (e.preventDefault) e.preventDefault();
        else e.returnValue = false;
		
        var body = $('body'),
            successRedirect, formError, formSuccess, errorText, successText;

        body.find('.form-error, .form-success').remove();
        var status = 0;
        var value = v ? v : e.attr('data-value');
        var action = e.attr('data-ca').replace(/ /g,'');
        var input = e.attr('data-input') ? e.attr('data-input') : null;
        var errorText = e.attr('data-error') ? e.attr('data-error') : "Oeps! Er is iets misgelopen.";
        var successText = e.attr('data-success') ? e.attr('data-success') : "Winkelmandje bijgewerkt!";
        body.append('<div class="form-error" style="display: none;">' + errorText + '</div>');
        body.append('<div class="form-success" style="display: none;">' + successText + '</div>');
        var formError = body.find('.form-error');
        var formSuccess = body.find('.form-success');
		
		//set value through input if data-input isset
		if(input !== null){
			switch($(input).attr('type')) {
			  case "radio":
			  	value = $(input+':checked').val();
			    break;
			  default:
			  	value = $(input).val();
			}
		}
		
		//construct data
		let data = "{"
		
		if(value !== null){
			data += '"value":"' + value + '",';
		}
		
		//loop through attributes and make json array with it
		data += mr.cart.getDataAttributes(e);

		//remove last comma
		data = data.substring(0, data.length - 1);
		
		data += '}';

		data = $.parseJSON(data);
		
        $.ajax({
            url: '/cart/'+action,
            data: data,
            method: "POST",
            headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
            success: function(response, textStatus, xhr){
                
                switch(xhr.status) {
				  case 200:
				  	//success
				    mr.cart.showFormSuccess(formSuccess, formError, 1000, 5000, 500);
				    status = 1;
				    break;
				  case 419:
				    //no valid csrf - page too long open
				    location.reload(true);
				    break;
				  default:
				  	//error
				    formError.html(data.msg).stop(true).fadeIn(1000);
                    formSuccess.stop(true).fadeOut(1000);
				}
                
                if( $(".cart").length && status == 1) {
				    $(".cart").load(location.href + " .cart>*", function() {
					    //reinit select groups
					    mr.selectGroup.init();
					    
						$(".cart").removeClass("element-loading");
						
						if(action == "redeem-coupon" && response == false){
							$('.coupon-alert').removeClass('d-none').addClass('d-block');
							$('.cart-coupon').val(data.value);
						}  
					});
				}       
            }
        });
        
        return false;
    };

    mr.cart.showFormSuccess = function(formSuccess, formError, fadeOutError, wait, fadeOutSuccess){
        
        formSuccess.stop(true).fadeIn(fadeOutError);

        formError.stop(true).fadeOut(fadeOutError);
        setTimeout(function() {
            formSuccess.stop(true).fadeOut(fadeOutSuccess);
        }, wait);
    };

    mr.cart.showFormError = function(formSuccess, formError, fadeOutSuccess, wait, fadeOutError){
        
        formError.stop(true).fadeIn(fadeOutSuccess);

        formSuccess.stop(true).fadeOut(fadeOutSuccess);
        setTimeout(function() {
            formError.stop(true).fadeOut(fadeOutError);
        }, wait);
    };

    mr.components.documentReadyDeferred.push(mr.cart.documentReady);
    return mr;

}(mr, jQuery, window, document));

//////////////// Granim
mr = (function (mr, $, window, document){
    "use strict";
    
    mr.granim = mr.granim || {};
	
    mr.granim.documentReady = function($){
    	$('[data-gradient-bg]').each(function(index,element){
	    	if($(this).attr('data-gradient-bg').length > 0){
	    		var granimParent = $(this),
	    			granimID 	 = 'granim-'+index+'',
					colours 	 = granimParent.attr('data-gradient-bg'),
					pairs        = [],
					tempPair     = [],
	                ao           = {},
					count,
					passes,
					i,
	                themeDefaults,
	                
	                options;
	
				// Canvas element forms the gradient background
				granimParent.prepend('<canvas id="'+granimID+'"></canvas>');
	
	            // Regular expression to match comma separated list of hex colour values
	            passes = /^(#[0-9|a-f|A-F]{6,8}){1}([ ]*,[ ]*#[0-9|a-f|A-F]{6,8})*$/.test(colours);
	
	            if(passes === true){
	            	colours = colours.replace(' ','');
	            	colours = colours.split(',');
	            	count = colours.length;
	            	// If number of colours is odd - duplicate last colour to make even array
	            	if(count%2 !== 0){
	            		colours.push(colours[count-1]);
	            	}
	            	for(i = 0; i < (count/2); i++){
	                    tempPair = [];
	                    tempPair.push(colours.shift());
	                    tempPair.push(colours.shift());
	                    pairs.push(tempPair);
	            	}
	                
	                // attribute overrides - allows per-gradient override of global options.
	                ao.states = {
	                    "default-state": {
	                        gradients: pairs,
	                        transitionSpeed: 5000,
							loop: true
	                    }
	                }
	            }
	
	            themeDefaults = {
	                element: '#'+granimID,
	                name: 'basic-gradient',
	                direction: 'left-right',
	                opacity: [1, 1],
	                isPausedWhenNotInView: true,
	                scrollDebounceThreshold: 300,
	                stateTransitionSpeed: 1000,
	                states : {
	                    "default-state": {
	                        gradients: pairs,
	                        transitionSpeed: 5000,
							loop: true
	                    }
	                }
	            };
	            
	            options = jQuery.extend({}, themeDefaults, mr.granim.options, ao);
	            $(this).data('gradientOptions', options);
	    		var granimElement = $(this);
	    		var granimInstance = new Granim(options);
    		}
    	});        
    };

    mr.components.documentReadyDeferred.push(mr.granim.documentReady);
    return mr;

}(mr, jQuery, window, document));

//////////////// Instagram
/*
mr = (function (mr, $, window, document){
    "use strict";
    
    mr.instagram = mr.instagram || {};

    mr.instagram.documentReady = function($){

        var themeDefaults, options, ao = {};
        
        if($('.instafeed').length){

            // Replace with your own Access Token and Client ID
            var token  = '4079540202.b9b1d8a.1d13c245c68d4a17bfbff87919aaeb14',
                client = 'b9b1d8ae049d4153b24a6332f0088686',
                elementToken, elementClient;

            if($('.instafeed[data-access-token][data-client-id]').length){
                elementToken = $('.instafeed[data-access-token][data-client-id]').first().attr('data-access-token');
                elementClient = $('.instafeed[data-access-token][data-client-id]').first().attr('data-client-id');

                if(elementToken !== ""){token = elementToken;}
                if(elementClient !== ""){client = elementClient;}
            }

            jQuery.fn.spectragram.accessData = {
                accessToken: token,
                clientID: client
            };  
        }

        $('.instafeed').each(function(){
            var feed   = $(this),
                feedID = feed.attr('data-user-name'),
                fetchNumber = 12;
            
            themeDefaults = {
                query: 'mediumrarethemes',
                max: 12
            };

            // Attribute Overrides taken from data attributes allow for per-feed customization
            ao.max = feed.attr('data-amount')
            ao.query = feed.attr('data-user-name');

            options = jQuery.extend({}, themeDefaults, mr.instagram.options, ao);

            feed.append('<ul></ul>');
            feed.children('ul').spectragram('getUserFeed', options);
        });
    };

    mr.components.documentReadyDeferred.push(mr.instagram.documentReady);
    return mr;

}(mr, jQuery, window, document));
*/

//////////////// Maps
function loadMaps(){
	mr.maps = mr.maps || {};
    mr.maps.options = mr.maps.options || {};
	
	mr.maps.documentReady = function($){
        // Interact with Map once the user has clicked (to prevent scrolling the page = zooming the map

        $('.map-holder').on('click', function() {
            $(this).addClass('interact');
        }).removeClass('interact');
        
        var mapsOnPage = $('.map-container[data-maps-api-key]');
        if(mapsOnPage.length){
            mapsOnPage.addClass('gmaps-active');
            mr.maps.initAPI($);
            mr.maps.init();
        }
        
    };

    mr.maps.initAPI = function($){
        // Load Google MAP API JS with callback to initialise when fully loaded
        if(document.querySelector('[data-maps-api-key]') && !document.querySelector('.gMapsAPI')){
            if($('[data-maps-api-key]').length){
                var script = document.createElement('script');
                var apiKey = $('[data-maps-api-key]:first').attr('data-maps-api-key');
                apiKey = typeof apiKey !== typeof undefined ? apiKey : ''; 
                if(apiKey !== ''){
                    script.type = 'text/javascript';
                    script.src = 'https://maps.googleapis.com/maps/api/js?key='+apiKey+'&callback=mr.maps.init';
                    script.className = 'gMapsAPI';
                    document.body.appendChild(script);  
                }
            } 
        }
    };

    mr.maps.init = function(){
        if(typeof window.google !== "undefined"){
            if(typeof window.google.maps !== "undefined"){

                mr.maps.instances = [];

                
                jQuery('.gmaps-active').each(function(){
                    var mapElement      = this,
                        mapInstance     = jQuery(this),
                        isDraggable     = jQuery(document).width() > 766 ? true : false,
                        showZoomControl = typeof mapInstance.attr('data-zoom-controls') !== typeof undefined ? true : false,
                        zoomControlPos  = typeof mapInstance.attr('data-zoom-controls') !== typeof undefined ? mapInstance.attr('data-zoom-controls'): false,
                        latlong         = typeof mapInstance.attr('data-latlong') !== typeof undefined ? mapInstance.attr('data-latlong') : false,
                        latitude        = latlong ? 1 *latlong.substr(0, latlong.indexOf(',')) : false,
                        longitude       = latlong ? 1 * latlong.substr(latlong.indexOf(",") + 1) : false,
                        geocoder        = new google.maps.Geocoder(),
                        address         = typeof mapInstance.attr('data-address') !== typeof undefined ? mapInstance.attr('data-address').split(';'): [""],
                        map, marker, markerDefaults,mapDefaults,mapOptions, markerOptions, mapAo = {}, markerAo = {}, mapCreatedEvent;

                        mapCreatedEvent    = document.createEvent('Event');
                        mapCreatedEvent.initEvent('mapCreated.maps.mr', true, true);

                        
                    

                    mapDefaults = {
                        disableDefaultUI: true,
                        draggable: isDraggable,
                        scrollwheel: false,
                        styles: [{"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":-25},{"saturation":-100}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]}],
                        zoom: 17,
                        zoomControl: false,    
                    };

                    // Attribute overrides - allows data attributes on the map to override global options
                    mapAo.styles             = typeof mapInstance.attr('data-map-style') !== typeof undefined ? JSON.parse(mapInstance.attr('data-map-style')): undefined;
                    mapAo.zoom               = mapInstance.attr('data-map-zoom') ? parseInt(mapInstance.attr('data-map-zoom'),10) : undefined;
                    mapAo.zoomControlOptions = zoomControlPos !== false ? {position: google.maps.ControlPosition[zoomControlPos]} : undefined;

                    markerDefaults = {
                        icon: {url:( typeof mr_variant !== typeof undefined ? '../': '' )+'images/marker/standard.png?raw=true', scaledSize: new google.maps.Size(50,50)},
                        title: '',
                        optimised: false
                    };

                    markerAo.icon = typeof mapInstance.attr('data-marker-image') !== typeof undefined ? {url: window.location.origin + mapInstance.attr('data-marker-image')+'?raw=true', scaledSize: new google.maps.Size(50,50)} : undefined;
                    markerAo.title = mapInstance.attr('data-marker-title');
                    
                    mapOptions = jQuery.extend({}, mapDefaults, mr.maps.options.map, mapAo);
                    markerOptions = jQuery.extend({}, markerDefaults, mr.maps.options.marker, markerAo);

                    if(address !== undefined && address[0] !== ""){
                            geocoder.geocode( { 'address': address[0].replace('[nomarker]','')}, function(results, status) {
                                if (status === google.maps.GeocoderStatus.OK) {
                                map = new google.maps.Map(mapElement, mapOptions);


                                mr.maps.instances.push(map);
                                jQuery(mapElement).trigger('mapCreated.maps.mr').get(0).dispatchEvent(mapCreatedEvent);
                                map.setCenter(results[0].geometry.location);
                                
                                address.forEach(function(address){
                                    var markerGeoCoder;

                                    if(/(\-?\d+(\.\d+)?),\s*(\-?\d+(\.\d+)?)/.test(address) ){
                                        var latlong = address.split(','),
                                        marker = new google.maps.Marker(jQuery.extend({}, markerOptions, {
                                            position: { lat: 1*latlong[0], lng: 1*latlong[1] },
                                            map: map,
                                        }));
                                                    
                                    }
                                    else if(address.indexOf('[nomarker]') < 0){
                                        markerGeoCoder = new google.maps.Geocoder();
                                        markerGeoCoder.geocode( { 'address': address.replace('[nomarker]','')}, function(results, status) {
                                            if (status === google.maps.GeocoderStatus.OK) {
                                                marker = new google.maps.Marker(jQuery.extend({}, markerOptions, {
                                                    map: map,
                                                    position: results[0].geometry.location,
                                                }));
                                            }
                                            else{
                                                console.log('Map marker error: '+status);
                                            }
                                        });
                                    }
									
                                });
                            } else {
                                console.log('There was a problem geocoding the address.');
                            }
                        });
                    }
                    else if(typeof latitude !== typeof undefined && latitude !== "" && latitude !== false && typeof longitude !== typeof undefined && longitude !== "" && longitude !== false ){
                        
                        mapOptions.center   = { lat: latitude, lng: longitude};
                        map                 = new google.maps.Map(mapElement, mapOptions); 
                        marker              = new google.maps.Marker(jQuery.extend({}, markerOptions, {
                                                    position: { lat: latitude, lng: longitude },
                                                    map: map }));
                        
                        mr.maps.instances.push(map);
                        jQuery(mapElement).trigger('mapCreated.maps.mr').get(0).dispatchEvent(mapCreatedEvent);


                    }
                }); 
            }
        }
    };
};

mr = (function (mr, $, window, document){
    "use strict";

	loadMaps();

    mr.components.documentReady.push(mr.maps.documentReady);
    return mr;

}(mr, jQuery, window, document));


//////////////// Masonry
mr = (function (mr, $, window, document){
    "use strict";
    
	loadMasonry();

    mr.components.documentReady.push(mr.masonry.documentReady);
    mr.components.windowLoad.push(mr.masonry.windowLoad);
    return mr;

}(mr, jQuery, window, document));


//////////////// Modals
mr = (function (mr, $, window, document){
    "use strict";
    
    mr.modals = mr.modals || {};

    mr.modals.documentReady = function($){
        var allPageModals = "<div class=\"all-page-modals\"></div>",
            mainContainer = $('div.main-container');

        if(mainContainer.length){
            jQuery(allPageModals).insertAfter(mainContainer);
            mr.modals.allModalsContainer = $('div.all-page-modals');
        }
        else{
            jQuery('body').append(allPageModals);
            mr.modals.allModalsContainer = jQuery('body div.all-page-modals');
        }

        $('.modal-container').each(function(){

            // Add modal close if none exists

            var modal        = $(this),
                $window      = $(window),
                modalContent = modal.find('.modal-content');
                
            
            if(!modal.find('.modal-close').length){
                modal.find('.modal-content').append('<div class="modal-close modal-close-cross"></div>');
            }

            // Set modal height
            
            if(modalContent.attr('data-width') !== undefined){
                var modalWidth = modalContent.attr('data-width').substr(0,modalContent.attr('data-width').indexOf('%')) * 1;
                modalContent.css('width',modalWidth + '%');
            }
            if(modalContent.attr('data-height') !== undefined){
                var modalHeight = modalContent.attr('data-height').substr(0,modalContent.attr('data-height').indexOf('%')) * 1;
                modalContent.css('height',modalHeight + '%');
            }

            // Set iframe's src to data-src to stop autoplaying iframes
            mr.util.idleSrc(modal, 'iframe');

        });


        $('.modal-instance').each(function(index){
            var modalInstance = $(this);
            var modal = modalInstance.find('.modal-container');
            var modalContent = modalInstance.find('.modal-content');
            var trigger = modalInstance.find('.modal-trigger');
            
            // Link modal with modal-id attribute
            
            trigger.attr('data-modal-index',index);
            modal.attr('data-modal-index',index);
            
            // Set unique id for multiple triggers
            
            if(typeof modal.attr('data-modal-id') !== typeof undefined){
                trigger.attr('data-modal-id', modal.attr('data-modal-id'));
            }
            

            // Attach the modal to the body            
            modal = modal.detach();
            mr.modals.allModalsContainer.append(modal);
        });
        

        $('.modal-trigger').on('click', function(){

            var modalTrigger = $(this);
            var uniqueID, targetModal;
            // Determine if the modal id is set by user or is set programatically
   
            if(typeof modalTrigger.attr('data-modal-id') !== typeof undefined){
                uniqueID = modalTrigger.attr('data-modal-id');
                targetModal = mr.modals.allModalsContainer.find('.modal-container[data-modal-id="'+uniqueID+'"]');    
            }else{
                uniqueID = $(this).attr('data-modal-index');
                targetModal = mr.modals.allModalsContainer.find('.modal-container[data-modal-index="'+uniqueID+'"]');
            }
            
            mr.util.activateIdleSrc(targetModal, 'iframe');
            mr.modals.autoplayVideo(targetModal);

            mr.modals.showModal(targetModal);

            return false;
        });

        jQuery(document).on('click', '.modal-close', mr.modals.closeActiveModal);

        jQuery(document).keyup(function(e) {
            if (e.keyCode === 27) { // escape key maps to keycode `27`
                mr.modals.closeActiveModal();
            }
        });

        $('.modal-container:not(.modal--prevent-close)').on('click', function(e) { 
            if( e.target !== this ) return;
            mr.modals.closeActiveModal();
        });

        // Trigger autoshow modals
        $('.modal-container[data-autoshow]').each(function(){
            var modal = $(this);
            var millisecondsDelay = modal.attr('data-autoshow')*1;

            mr.util.activateIdleSrc(modal);
            mr.modals.autoplayVideo(modal);

            // If this modal has a cookie attribute, check to see if a cookie is set, and if so, don't show it.
            if(typeof modal.attr('data-cookie') !== typeof undefined){
                if(!mr.cookies.hasItem(modal.attr('data-cookie'))){
                    mr.modals.showModal(modal, millisecondsDelay);
                }
            }else{
                mr.modals.showModal(modal, millisecondsDelay);
            }
        });

        // Exit modals
        $('.modal-container[data-show-on-exit]').each(function(){
            var modal        = jQuery(this),
                exitSelector = modal.attr('data-show-on-exit'),
                delay = 0;

            if(modal.attr('data-delay')){
                delay = parseInt(modal.attr('data-delay'), 10) || 0;  
            } 

            // If a valid selector is found, attach leave event to show modal.
            if($(exitSelector).length){
                modal.prepend($('<i class="ti-close close-modal">'));
                jQuery(document).on('mouseleave', exitSelector, function(){
                    if(!$('.modal-active').length){
                        if(typeof modal.attr('data-cookie') !== typeof undefined){
                            if(!mr.cookies.hasItem(modal.attr('data-cookie'))){
                                mr.modals.showModal(modal, delay);
                            }
                        }else{
                            mr.modals.showModal(modal, delay);
                        }
                    }
                });
            }
        });


        // Autoshow modal by ID from location href
        if(window.location.href.split('#').length === 2){
            var modalID = window.location.href.split('#').pop();
            if($('[data-modal-id="'+modalID+'"]').length){
                mr.modals.closeActiveModal();
                mr.modals.showModal($('[data-modal-id="'+modalID+'"]'));
            }  
        }

        jQuery(document).on('click','a[href^="#"]', function(){
            var modalID = $(this).attr('href').replace('#', '');
            if($('[data-modal-id="'+modalID+'"]').length){    
                mr.modals.closeActiveModal();
                setTimeout(mr.modals.showModal, 500,'[data-modal-id="'+modalID+'"]', 0);
            }
        });

        // Make modal scrollable
        jQuery(document).on('wheel mousewheel scroll','.modal-content, .modal-content .scrollable', function(evt){
            if(evt.preventDefault){evt.preventDefault();}
            if(evt.stopPropagation){evt.stopPropagation();}
            this.scrollTop += (evt.originalEvent.deltaY); 
        });
    };
    ////////////////
    //////////////// End documentReady
    ////////////////

    mr.modals.showModal = function(modal, millisecondsDelay){
        
        var delay = (typeof millisecondsDelay !== typeof undefined) ? (1*millisecondsDelay) : 0, $modal = $(modal);
            
        if($modal.length){
            setTimeout(function(){
                var openEvent = document.createEvent('Event');
                openEvent.initEvent('modalOpened.modals.mr', true, true);
                $(modal).addClass('modal-active').trigger('modalOpened.modals.mr').get(0).dispatchEvent(openEvent);

            },delay);
        }
    };

    mr.modals.closeActiveModal = function(){
        var modal      = jQuery('body div.modal-active'), 
            closeEvent = document.createEvent('Event');

        mr.util.idleSrc(modal, 'iframe');
        mr.util.pauseVideo(modal);

        // If this modal requires to be closed permanently using a cookie, set the cookie now.
        if(typeof modal.attr('data-cookie') !== typeof undefined){
            mr.cookies.setItem(modal.attr('data-cookie'), "true", Infinity, '/');
        }

        if(modal.length){
            // Remove hash from URL bar if this modal was opened via url bar ID
            if(modal.is('[data-modal-id]') && window.location.hash === '#'+modal.attr('data-modal-id')){
                mr.util.removeHash();
            }
            closeEvent.initEvent('modalClosed.modals.mr', true, true);
            modal.removeClass('modal-active').trigger('modalClosed.modals.mr').get(0).dispatchEvent(closeEvent);
        }
    };

    mr.modals.autoplayVideo = function(modal){
        // If modal contains HTML5 video with autoplay, play the video
        if(modal.find('video[autoplay]').length){
            var video = modal.find('video').get(0);
            video.play();
        }
    };

    mr.components.documentReady.push(mr.modals.documentReady);
    return mr;

}(mr, jQuery, window, document));

//////////////// Lightcase
mr = (function (mr, $, window, document){
    "use strict";
    
    mr.lightcase = mr.lightcase || {};
    
    mr.lightcase.documentReady = function($){
        
        //////////////// Append .background-image-holder <img>'s as CSS backgrounds
	    loadLightcase();
    };

    mr.components.documentReady.push(mr.lightcase.documentReady);
    return mr;

}(mr, jQuery, window, document));

//////////////// Newsletter Providers
mr = (function (mr, $, window, document){
    "use strict";
    
    mr.newsletters = mr.newsletters || {};

    mr.newsletters.documentReady = function($){
  
  	var form,checkbox,label,id,parent,radio;
    
    // Treat Campaign Monitor forms
    $('form[action*="createsend.com"]').each(function(){
    	form = $(this);

        // Override browser validation and allow us to use our own
        form.attr('novalidate', 'novalidate');

    	// Give each text input a placeholder value

    	if(!form.is('.form--no-placeholders')){
            form.find('input:not([checkbox]):not([radio])').each(function(){
                var $input = $(this);
                if(typeof $input.attr('placeholder') !== typeof undefined){
                    if($input.attr('placeholder') === ""){
                        if($input.siblings('label').length){
                            $input.attr('placeholder', $input.siblings('label').first().text());
                            if(form.is('.form--no-labels')){   
                                $input.siblings('label').first().remove();
                            }
                        }
                    }
                }else if($input.siblings('label').length){
                    $input.attr('placeholder', $input.siblings('label').first().text()); 
                    if(form.is('.form--no-labels')){
                        $input.siblings('label').first().remove();
                    }
                }
                if($input.parent().is('p')){
                    $input.unwrap();
                }
            });
        }else{
            form.find('input[placeholder]').removeAttr('placeholder');
        }


    	// Wrap select elements in template code

    	form.find('select').wrap('<div class="input-select"></div>');

    	// Wrap radios elements in template code

    	form.find('input[type="radio"]').wrap('<div class="input-radio"></div>');

    	// Wrap checkbox elements in template code

    	form.find('input[type="checkbox"]').each(function(){
    		checkbox = $(this);
    		id = checkbox.attr('id');
    		label = form.find('label[for='+id+']');
            if(!label.length){
                label = $('<label for="'+id+'"></label>');
            }
    		
    		checkbox.before('<div class="input-checkbox" data-id="'+id+'"></div>');
    		$('.input-checkbox[data-id="'+id+'"]').prepend(checkbox);
    		$('.input-checkbox[data-id="'+id+'"]').prepend(label);
    	});

    	form.find('button[type="submit"]').each(function(){
            var button = $(this);
            button.addClass('btn');
            if(button.parent().is('p')){
                button.unwrap();
            }
        });
        
        form.find('[required]').attr('required', 'required').addClass('validate-required');

        form.addClass('form--active');

        mr.newsletters.prepareAjaxAction(form);


    });

    // Treat MailChimp forms
    $('form[action*="list-manage.com"]').each(function(){
    	form = $(this);

        // Override browser validation and allow us to use our own
        form.attr('novalidate', 'novalidate');

    	// Give each text input a placeholder value
        if(!form.is('.form--no-placeholders')){
        	form.find('input:not([checkbox]):not([radio])').each(function(){
        		var $input = $(this);
                if(typeof $input.attr('placeholder') !== typeof undefined){
                    if($input.attr('placeholder') === ""){
                        if($input.siblings('label').length){
                            $input.attr('placeholder', $input.siblings('label').first().text());
                            if(form.is('.form--no-labels')){   
                                $input.siblings('label').first().remove();
                            }
                        }
                    }
                }else if($input.siblings('label').length){
                    $input.attr('placeholder', $input.siblings('label').first().text()); 
                    if(form.is('.form--no-labels')){
                        $input.siblings('label').first().remove();
                    }
                }
        	});
        }else{
            form.find('input[placeholder]').removeAttr('placeholder');
        }

        if(form.is('.form--no-labels')){
            form.find('input:not([checkbox]):not([radio])').each(function(){
                var $input = $(this);
                if($input.siblings('label').length){
                    $input.siblings('label').first().remove();
                }
            });
        }

    	// Wrap select elements in template code

    	form.find('select').wrap('<div class="input-select"></div>');

    	// Wrap checboxes elements in template code

    	form.find('input[type="checkbox"]').each(function(){
    		checkbox = jQuery(this);
    		parent = checkbox.parent();
    		label = parent.find('label');
            if(!label.length){
                label = jQuery('<label>');
            }
    		checkbox.before('<div class="input-checkbox"></div>');
    		parent.find('.input-checkbox').append(checkbox);
    		parent.find('.input-checkbox').append(label);
    	});

    	// Wrap radio elements in template code

    	form.find('input[type="radio"]').each(function(){
    		radio = jQuery(this);
    		parent = radio.closest('li');
    		label = parent.find('label');
            if(!label.length){
                label = jQuery('<label>');
            }
    		radio.before('<div class="input-radio"></div>');
    		parent.find('.input-radio').prepend(radio);
    		parent.find('.input-radio').prepend(label);
    	});

        // Convert MailChimp input[type="submit"] to div.button

        form.find('input[type="submit"]').each(function(){
            var submit = $(this);
            
            var newButton = jQuery('<button/>').attr('type','submit').attr('class', submit.attr('class')).addClass('btn').text(submit.attr('value'));
            
            if(submit.parent().is('div.clear')){
                submit.unwrap();
            }

            newButton.insertBefore(submit);
            submit.remove();
        });

        form.find('input').each(function(){
            var input = $(this);
            if(input.hasClass('required')){
                input.removeClass('required').addClass('validate-required');
            }
        });

        form.find('input[type="email"]').removeClass('email').addClass('validate-email');

        form.find('#mce-responses').remove();

        form.find('.mc-field-group').each(function(){
            $(this).children().first().unwrap();
        });

        form.find('[required]').attr('required', 'required').addClass('validate-required');

        form.addClass('form--active');

        mr.newsletters.prepareAjaxAction(form);

    }); 

	// Reinitialize the forms so interactions work as they should

	mr.forms.documentReady(mr.setContext('form.form--active'));
		
  };

  mr.newsletters.prepareAjaxAction = function(form){
        var action = $(form).attr('action');

        // Alter action for a Mail Chimp-compatible ajax request url.
        if(/list-manage\.com/.test(action)){
           action = action.replace('/post?', '/post-json?') + "&c=?";
           if(action.substr(0,2) === "//"){
               action = 'http:' + action;
           }
        }

        // Alter action for a Campaign Monitor-compatible ajax request url.
        if(/createsend\.com/.test(action)){
           action = action + '?callback=?';
        }

        // Set action on the form
        $(form).attr('action', action);

    };



  mr.components.documentReady.push(mr.newsletters.documentReady);
  return mr;

}(mr, jQuery, window, document));

//////////////// Notifications
mr = (function (mr, $, window, document){
    "use strict";
    
    mr.notifications = mr.notifications || {};

    mr.notifications.documentReady = function($){
        
        $('.notification').each(function(){
            var notification = $(this);
            if(!notification.find('.notification-close').length){
                notification.append('<div class="notification-close-cross notification-close"></div>');
            }
        });
    

        $('.notification[data-autoshow]').each(function(){
            var notification = $(this);
            var millisecondsDelay = parseInt(notification.attr('data-autoshow'),10);

            // If this notification has a cookie attribute, check to see if a cookie is set, and if so, don't show it.
            if(typeof notification.attr('data-cookie') !== typeof undefined){
                if(!mr.cookies.hasItem(notification.attr('data-cookie'))){
                    mr.notifications.showNotification(notification, millisecondsDelay);
                }
            }else{
                mr.notifications.showNotification(notification, millisecondsDelay);
            }
        });

        $('[data-notification-link]:not(.notification)').on('click', function(){
            var notificationID = jQuery(this).attr('data-notification-link');
            var notification = $('.notification[data-notification-link="'+notificationID+'"]');
            jQuery('.notification--reveal').addClass('notification--dismissed');
            notification.removeClass('notification--dismissed');
            mr.notifications.showNotification(notification, 0);
            return false;
        });

        $('.notification-close').on('click', function(){
            var closeButton = jQuery(this);
            // Pass the closeNotification function a reference to the close button
            mr.notifications.closeNotification(closeButton);

            if(closeButton.attr('href') === '#'){
                return false;
            }
        });

        $('.notification .inner-link').on('click', function(){
            var notificationLink = jQuery(this).closest('.notification').attr('data-notification-link');
            mr.notifications.closeNotification(notificationLink);
        });
    
    };


    mr.notifications.showNotification = function(notification, millisecondsDelay){
        var $notification = jQuery(notification),
            delay         = (typeof millisecondsDelay !== typeof undefined) ? (1*millisecondsDelay) : 0,
            openEvent     = document.createEvent('Event');
            
        setTimeout(function(){
            openEvent.initEvent('notificationOpened.notifications.mr', true, true);
            $notification.addClass('notification--reveal').trigger('notificationOpened.notifications.mr').get(0).dispatchEvent(openEvent);
            $notification.closest('nav').addClass('notification--reveal');
            if($notification.find('input').length){
                $notification.find('input').first().focus();
            }
            


        },delay);
        // If notification has autohide attribute, set a timeout 
        // for the autohide time plus the original delay time in case notification was called
        // on page load
        if(notification.is('[data-autohide]')){
            var hideDelay = parseInt(notification.attr('data-autohide'),10);
            setTimeout(function(){
                mr.notifications.closeNotification(notification);
            },hideDelay+delay);
        }
    };

    mr.notifications.closeNotification = function(notification){
        var $notification = jQuery(notification),
            closeEvent    = document.createEvent('Event');
        notification = $notification.is('.notification') ? 
                       $notification :
                       $notification.is('.notification-close') ? 
                       $notification.closest('.notification') : 
                       $('.notification[data-notification-link="'+notification+'"]');
        
        closeEvent.initEvent('notificationClosed.notifications.mr', true, true);
        notification.addClass('notification--dismissed').trigger('notificationClosed.notifications.mr').get(0).dispatchEvent(closeEvent);
        notification.closest('nav').removeClass('notification--reveal');

        // If this notification requires to be closed permanently using a cookie, set the cookie now.
        if(typeof notification.attr('data-cookie') !== typeof undefined){
            mr.cookies.setItem(notification.attr('data-cookie'), "true", Infinity, '/');
        }
    };

    mr.components.documentReady.push(mr.notifications.documentReady);
    return mr;

}(mr, jQuery, window, document));

//////////////// Parallax
loadParallax();

//////////////// Progress Horizontal (bars)
mr = (function (mr, $, window, document){
    "use strict";
    
    mr.progressHorizontal = mr.progressHorizontal || {};

    mr.progressHorizontal.documentReady = function($){

        var progressBars = [];

        $('.progress-horizontal').each(function(){
            var bar       = jQuery(this).find('.progress-horizontal__bar'),
                barObject = {},
                progress  = jQuery('<div class="progress-horizontal__progress"></div>');

                bar.prepend(progress);

                barObject.element = bar;
                barObject.progress = progress;
                barObject.value = parseInt(bar.attr('data-value'),10)+"%";
                barObject.offsetTop = bar.offset().top;
                barObject.animate = false;

                if(jQuery(this).hasClass('progress-horizontal--animate')){
                    barObject.animate = true;
                }else{
                    progress.css('width',barObject.value);
                }
                progressBars.push(barObject);
        });
    };

    mr.components.documentReady.push(mr.progressHorizontal.documentReady);
    return mr;

}(mr, jQuery, window, document));

//////////////// EasyPiecharts
mr = (function (mr, $, window, document){
	  "use strict";

		mr.easypiecharts = mr.easypiecharts || {};
		mr.easypiecharts.pies = [];
		mr.easypiecharts.options = mr.easypiecharts.options || {};

		mr.easypiecharts.documentReady = function($){

		  	$('.radial').each(function(){
		  		var chart              = jQuery(this),
		  			  value              = 0,
		  			  color              = '#000000',
		  			  time               = 2000,
		  			  pieSize            = 110,
		  			  barWidth           = 3,
		  			  defaults           = {},
		  			  attributeOverrides = {},
		  			  options;

		  		defaults = {
		  			animate: ({duration: time, enabled: true}),
		  			barColor: color,
		  			scaleColor: false,
		  			size: pieSize,
		  			lineWidth: barWidth
		  		};

		  		if(typeof mr.easypiecharts.options.size !== typeof undefined){
            pieSize = mr.easypiecharts.options.size;
		  		}
		  		if(typeof chart.attr('data-timing') !== typeof undefined){
		  			attributeOverrides.animate = {duration: parseInt(chart.attr('data-timing'), 10), enabled: true};
		  		}
		  		if(typeof chart.attr('data-color') !== typeof undefined){
		  			attributeOverrides.barColor = chart.attr('data-color');
		  		}
		  		if(typeof chart.attr('data-size') !== typeof undefined){
		  			pieSize = attributeOverrides.size = parseInt(chart.attr('data-size'), 10);
		  		}
		  		if(typeof chart.attr('data-bar-width') !== typeof undefined){
		  			attributeOverrides.lineWidth = parseInt(chart.attr('data-bar-width'), 10);
		  		}

		  		chart.css('height',pieSize).css('width',pieSize);

          

		  		if(typeof mr.easypiecharts.options === 'object'){
            options = jQuery.extend({}, defaults, mr.easypiecharts.options, attributeOverrides);
		  		}

		  		chart.easyPieChart(options);
		  		chart.data('easyPieChart').update(0);
		  	});

		  	if($('.radial').length){
		  		mr.easypiecharts.init($);
		  		mr.easypiecharts.activate();
		  		mr.scroll.listeners.push(mr.easypiecharts.activate);
		  	}

	  };

	  mr.easypiecharts.init = function($){

			mr.easypiecharts.pies = [];
          
			$('.radial').each(function(){
			  var pieObject  = {},
				  currentPie = jQuery(this);

				  pieObject.element = currentPie;
				  pieObject.value = parseInt(currentPie.attr('data-value'),10);
				  pieObject.top = currentPie.offset().top;
				  pieObject.height = currentPie.height()/2;
				  pieObject.active = false;
				  mr.easypiecharts.pies.push(pieObject);
			});
		};

		mr.easypiecharts.activate = function(){
			mr.easypiecharts.pies.forEach(function(pie){
				if(Math.round((mr.scroll.y + mr.window.height)) >= Math.round(pie.top+pie.height)){
					if(pie.active === false){
						
	                	pie.element.data('easyPieChart').enableAnimation();
	                	pie.element.data('easyPieChart').update(pie.value);
	                	pie.element.addClass('radial--active');
	                	pie.active = true;
					}
	            }
        	});
		};

	  mr.components.documentReadyDeferred.push(mr.easypiecharts.documentReady);
	  return mr;

}(mr, jQuery, window, document));

//////////////// Flickity
/*
mr = (function (mr, $, window, document){
    "use strict";
    
    mr.sliders = mr.sliders || {};

    mr.sliders.documentReady = function($){

        $('.slider').each(function(index){
            
            var slider = $(this);
            var sliderInitializer = slider.find('ul.slides');
            sliderInitializer.find('>li').addClass('slide');
            var childnum = sliderInitializer.find('li').length;
            
            var themeDefaults = {
                cellSelector: '.slide',
                cellAlign: 'left',
                wrapAround: true,
                pageDots: false,
                prevNextButtons: false,
                autoPlay: true,
                draggable: (childnum < 2 ? false: true),
                imagesLoaded: true,
                accessibility: true,
                rightToLeft: false,
                initialIndex: 0,
                freeScroll: true,
                wrapAround: true,
                fade: true, //the slider behaves very strange with ltr animations
                adaptiveHeight: true
            }; 

            // Attribute Overrides - options that are overridden by data attributes on the slider element
            var ao = {};
            ao.pageDots = (slider.attr('data-paging') === 'true' && sliderInitializer.find('li').length > 1) ? true : undefined;
            ao.prevNextButtons = slider.attr('data-arrows') === 'true'? true: undefined;
            ao.draggable = slider.attr('data-draggable') === 'false'? false : undefined;
            ao.autoPlay = slider.attr('data-autoplay') === 'false'? false: (slider.attr('data-timing') ? parseInt(slider.attr('data-timing'), 10): undefined);
            ao.accessibility = slider.attr('data-accessibility') === 'false'? false : undefined;
            ao.rightToLeft = slider.attr('data-rtl') === 'true'? true : undefined;
            ao.initialIndex = slider.attr('data-initial') ? parseInt(slider.attr('data-initial'), 10) : undefined;
            ao.freeScroll = slider.attr('data-freescroll') === "true" ? true: undefined;
            ao.wrapAround = slider.attr('data-wrap')  === "true" ? true: undefined;
            ao.fade = slider.attr('data-fade') === "true" ? true: undefined;
            ao.adaptiveHeight = slider.attr('data-adaptive-height') === "true" ? true: undefined;

            // Set data attribute to inidicate the number of children in the slider
            slider.attr('data-children',childnum);

            
            $(this).data('sliderOptions', jQuery.extend({}, themeDefaults, mr.sliders.options, ao));

            $(sliderInitializer).flickity($(this).data('sliderOptions'));

			
            $(sliderInitializer).on( 'scroll.flickity', function( event, progress ) {
              if(slider.find('.is-selected').hasClass('controls--dark')){
                slider.addClass('controls--dark');
              }else{
                slider.removeClass('controls--dark'); 
              }
            });
        });

        if(mr.parallax.update){ mr.parallax.update(); }
        
    };

    mr.components.documentReadyDeferred.push(mr.sliders.documentReady);
    return mr;

}(mr, jQuery, window, document));
*/

//////////////// Slick

mr = (function (mr, $, window, document){
    "use strict";
    
    mr.sliders = mr.sliders || {};

    mr.sliders.documentReady = function($){

        loadSliders();

        if(mr.parallax.update){ mr.parallax.update(); }
        
    };

    mr.components.documentReadyDeferred.push(mr.sliders.documentReady);
    return mr;

}(mr, jQuery, window, document));

//////////////// Blazy
(function(q,m){"function"===typeof define&&define.amd?define(m):"object"===typeof exports?module.exports=m():q.Blazy=m()})(this,function(){function q(b){var c=b._util;c.elements=E(b.options);c.count=c.elements.length;c.destroyed&&(c.destroyed=!1,b.options.container&&l(b.options.container,function(a){n(a,"scroll",c.validateT)}),n(window,"resize",c.saveViewportOffsetT),n(window,"resize",c.validateT),n(window,"scroll",c.validateT));m(b)}function m(b){for(var c=b._util,a=0;a<c.count;a++){var d=c.elements[a],e;a:{var g=d;e=b.options;var p=g.getBoundingClientRect();if(e.container&&y&&(g=g.closest(e.containerClass))){g=g.getBoundingClientRect();e=r(g,f)?r(p,{top:g.top-e.offset,right:g.right+e.offset,bottom:g.bottom+e.offset,left:g.left-e.offset}):!1;break a}e=r(p,f)}if(e||t(d,b.options.successClass))b.load(d),c.elements.splice(a,1),c.count--,a--}0===c.count&&b.destroy()}function r(b,c){return b.right>=c.left&&b.bottom>=c.top&&b.left<=c.right&&b.top<=c.bottom}function z(b,c,a){if(!t(b,a.successClass)&&(c||a.loadInvisible||0<b.offsetWidth&&0<b.offsetHeight))if(c=b.getAttribute(u)||b.getAttribute(a.src)){c=c.split(a.separator);var d=c[A&&1<c.length?1:0],e=b.getAttribute(a.srcset),g="img"===b.nodeName.toLowerCase(),p=(c=b.parentNode)&&"picture"===c.nodeName.toLowerCase();if(g||void 0===b.src){var h=new Image,w=function(){a.error&&a.error(b,"invalid");v(b,a.errorClass);k(h,"error",w);k(h,"load",f)},f=function(){g?p||B(b,d,e):b.style.backgroundImage='url("'+d+'")';x(b,a);k(h,"load",f);k(h,"error",w)};p&&(h=b,l(c.getElementsByTagName("source"),function(b){var c=a.srcset,e=b.getAttribute(c);e&&(b.setAttribute("srcset",e),b.removeAttribute(c))}));n(h,"error",w);n(h,"load",f);B(h,d,e)}else b.src=d,x(b,a)}else"video"===b.nodeName.toLowerCase()?(l(b.getElementsByTagName("source"),function(b){var c=a.src,e=b.getAttribute(c);e&&(b.setAttribute("src",e),b.removeAttribute(c))}),b.load(),x(b,a)):(a.error&&a.error(b,"missing"),v(b,a.errorClass))}function x(b,c){v(b,c.successClass);c.success&&c.success(b);b.removeAttribute(c.src);b.removeAttribute(c.srcset);l(c.breakpoints,function(a){b.removeAttribute(a.src)})}function B(b,c,a){a&&b.setAttribute("srcset",a);b.src=c}function t(b,c){return-1!==(" "+b.className+" ").indexOf(" "+c+" ")}function v(b,c){t(b,c)||(b.className+=" "+c)}function E(b){var c=[];b=b.root.querySelectorAll(b.selector);for(var a=b.length;a--;c.unshift(b[a]));return c}function C(b){f.bottom=(window.innerHeight||document.documentElement.clientHeight)+b;f.right=(window.innerWidth||document.documentElement.clientWidth)+b}function n(b,c,a){b.attachEvent?b.attachEvent&&b.attachEvent("on"+c,a):b.addEventListener(c,a,{capture:!1,passive:!0})}function k(b,c,a){b.detachEvent?b.detachEvent&&b.detachEvent("on"+c,a):b.removeEventListener(c,a,{capture:!1,passive:!0})}function l(b,c){if(b&&c)for(var a=b.length,d=0;d<a&&!1!==c(b[d],d);d++);}function D(b,c,a){var d=0;return function(){var e=+new Date;e-d<c||(d=e,b.apply(a,arguments))}}var u,f,A,y;return function(b){if(!document.querySelectorAll){var c=document.createStyleSheet();document.querySelectorAll=function(a,b,d,h,f){f=document.all;b=[];a=a.replace(/\[for\b/gi,"[htmlFor").split(",");for(d=a.length;d--;){c.addRule(a[d],"k:v");for(h=f.length;h--;)f[h].currentStyle.k&&b.push(f[h]);c.removeRule(0)}return b}}var a=this,d=a._util={};d.elements=[];d.destroyed=!0;a.options=b||{};a.options.error=a.options.error||!1;a.options.offset=a.options.offset||100;a.options.root=a.options.root||document;a.options.success=a.options.success||!1;a.options.selector=a.options.selector||".b-lazy";a.options.separator=a.options.separator||"|";a.options.containerClass=a.options.container;a.options.container=a.options.containerClass?document.querySelectorAll(a.options.containerClass):!1;a.options.errorClass=a.options.errorClass||"b-error";a.options.breakpoints=a.options.breakpoints||!1;a.options.loadInvisible=a.options.loadInvisible||!1;a.options.successClass=a.options.successClass||"b-loaded";a.options.validateDelay=a.options.validateDelay||25;a.options.saveViewportOffsetDelay=a.options.saveViewportOffsetDelay||50;a.options.srcset=a.options.srcset||"data-srcset";a.options.src=u=a.options.src||"data-src";y=Element.prototype.closest;A=1<window.devicePixelRatio;f={};f.top=0-a.options.offset;f.left=0-a.options.offset;a.revalidate=function(){q(a)};a.load=function(a,b){var c=this.options;void 0===a.length?z(a,b,c):l(a,function(a){z(a,b,c)})};a.destroy=function(){var a=this._util;this.options.container&&l(this.options.container,function(b){k(b,"scroll",a.validateT)});k(window,"scroll",a.validateT);k(window,"resize",a.validateT);k(window,"resize",a.saveViewportOffsetT);a.count=0;a.elements.length=0;a.destroyed=!0};d.validateT=D(function(){m(a)},a.options.validateDelay,a);d.saveViewportOffsetT=D(function(){C(a.options.offset)},a.options.saveViewportOffsetDelay,a);C(a.options.offset);l(a.options.breakpoints,function(a){if(a.width>=window.screen.width)return u=a.src,!1});setTimeout(function(){q(a)})}});

mr = (function (mr, $, window, document){
    "use strict";
    
    mr.sliders = mr.sliders || {};

    mr.sliders.documentReady = function($){
        // Initialize
        loadBlazy();
    };

    mr.components.documentReadyDeferred.push(mr.sliders.documentReady);
    return mr;

}(mr, jQuery, window, document));

//////////////// Smoothscroll
mr = (function (mr, $, window, document){
    "use strict";
    
    mr.smoothscroll = mr.smoothscroll || {};
    mr.smoothscroll.sections = [];
    
    mr.smoothscroll.init = function(){
        mr.smoothscroll.sections = [];

       

        $('a.inner-link').each(function(){
            var sectionObject = {},
                link          = $(this),
                href          = link.attr('href'),
                validLink     = new RegExp('^#[^\r\n\t\f\v\#\.]+$','gm');
                            
            if(validLink.test(href)){
                
                if($('section'+href).length){

                    sectionObject.id     = href;
                    sectionObject.top = Math.round($(href).offset().top);
                    sectionObject.height = Math.round($(href).outerHeight());
                    sectionObject.link   = link.get(0);
                    sectionObject.active = false;

                    mr.smoothscroll.sections.push(sectionObject);
                }
            }
        });

        mr.smoothscroll.highlight();
    };

    mr.smoothscroll.highlight = function(){
        mr.smoothscroll.sections.forEach(function(section){
            if(mr.scroll.y >= section.top && mr.scroll.y < (section.top + section.height)){
                if(section.active === false){
                    section.link.classList.add("inner-link--active");
                    section.active = true;
                }
            }else{
                section.link.classList.remove("inner-link--active");
                section.active = false;
            }
        });
    };

    mr.scroll.listeners.push(mr.smoothscroll.highlight);

    mr.smoothscroll.documentReady = function($){
        // Smooth scroll to inner links
        var innerLinks = $('a.inner-link'), offset, themeDefaults, ao = {};

        themeDefaults = {
            selector: '.inner-link',
            selectorHeader: null,
            speed: 750,
            easing: 'easeInOutCubic',
            offset: 0
        };

        if(innerLinks.length){
            innerLinks.each(function(index){
                var link          = $(this),
                    href          = link.attr('href');
                if(href.charAt(0) !== "#"){
                    link.removeClass('inner-link');
                }
            });

            mr.smoothscroll.init();
            $(window).on('resize', mr.smoothscroll.init);

            offset = 0;
            if($('body[data-smooth-scroll-offset]').length){
                offset = $('body').attr('data-smooth-scroll-offset');
                offset = offset*1;
            }

            ao.offset = offset !== 0 ? offset: undefined; 
            
            smoothScroll.init(jQuery.extend({}, themeDefaults, mr.smoothscroll.options, ao));
        }
    };

    mr.components.documentReady.push(mr.smoothscroll.documentReady);
    mr.components.windowLoad.push(mr.smoothscroll.init);
    return mr;

}(mr, jQuery, window, document));

//////////////// Tabs
mr = (function (mr, $, window, document){
    "use strict";

    mr.tabs = mr.tabs || {};
    
    mr.tabs.documentReady = function($){
        $('.tabs').each(function(){
            var tabs = $(this);
            tabs.after('<ul class="tabs-content">');
            tabs.find('li').each(function(){
                var currentTab      = $(this),
                    tabContent      = currentTab.find('.tab__content').wrap('<li></li>').parent(),
                    tabContentClone = tabContent.clone(true,true);
                tabContent.remove();
                currentTab.closest('.tabs-container').find('.tabs-content').append(tabContentClone);
            });
        });
        
        $('.tabs > li').on('click', function(){
            var clickedTab = $(this), hash;
            mr.tabs.activateTab(clickedTab);

            // Update the URL bar if the currently clicked tab has an ID
            if(clickedTab.is('[id]')){
                // Create the hash from the tab's ID
                hash = '#'+ clickedTab.attr('id');
                // Check we are in a newish browser with the history API
                if(history.pushState) {
                    history.pushState(null, null, hash);
                }
                else {
                    location.hash = hash;
                }
            }
        });

        $('.tabs li.active').each(function(){
            mr.tabs.activateTab(this);
        });

        if(window.location.hash !== ''){
            mr.tabs.activateTabById(window.location.hash);
        }

        $('a[href^="#"]').on('click', function(){
            mr.tabs.activateTabById($(this).attr('href'));
        });

    };

    mr.tabs.activateTab = function(tab){
        var clickedTab    = $(tab),
            tabContainer  = clickedTab.closest('.tabs-container'),
            activeIndex   = (clickedTab.index()*1)+(1),
            activeContent = tabContainer.find('> .tabs-content > li:nth-of-type('+activeIndex+')'),
            openEvent     = document.createEvent('Event'),
            iframe, radial;

            openEvent.initEvent('tabOpened.tabs.mr', true, true);


        tabContainer.find('> .tabs > li').removeClass('active');
        tabContainer.find('> .tabs-content > li').removeClass('active');
        
        clickedTab.addClass('active').trigger('tabOpened.tabs.mr').get(0).dispatchEvent(openEvent);
        activeContent.addClass('active');

        

        // If there is an <iframe> element in the tab, reload its content when the tab is made active.
        iframe = activeContent.find('iframe');
        if(iframe.length){
            iframe.attr('src', iframe.attr('src'));
        }
    };



    mr.tabs.activateTabById = function(id){
        if(id !== '' && id !== '#' && id.match(/#\/.*/) === null){
            if($('.tabs > li#'+id.replace('#', '')).length){
                $('.tabs > li#'+id.replace('#', '')).click();
            }
        }
    };

    mr.components.documentReady.push(mr.tabs.documentReady);
    return mr;

}(mr, jQuery, window, document));

//////////////// Toggle Class
mr = (function (mr, $, window, document){
    "use strict";
    
    mr.toggleClass = mr.toggleClass || {};
    
    mr.toggleClass.documentReady = function($){
        $('[data-toggle-class]').each(function(){
        	var element = $(this),
                data    = element.attr('data-toggle-class').split("|");
        		

            $(data).each(function(){
                var candidate     = element,
                    dataArray     = [],
            	    toggleClass   = '',
            	    toggleElement = '',
                    dataArray = this.split(";");

            	if(dataArray.length === 2){
            		toggleElement = dataArray[0];
            		toggleClass   = dataArray[1];
            		$(candidate).on('click',function(){
                        if(!candidate.hasClass('toggled-class')){
                            candidate.toggleClass('toggled-class');
                        }else{
                            candidate.removeClass('toggled-class');
                        }
            			$(toggleElement).toggleClass(toggleClass);
            			return false;
            		});
            	}else{
            		console.log('Error in [data-toggle-class] attribute. This attribute accepts an element, or comma separated elements terminated witha ";" followed by a class name to toggle');
            	}
            });
        });
    };

    mr.components.documentReady.push(mr.toggleClass.documentReady);
    return mr;

}(mr, jQuery, window, document));

//////////////// Typed Headline Effect
mr = (function (mr, $, window, document){
    "use strict";
    
    mr.typed = mr.typed || {};
    

    mr.typed.documentReady = function($){
        $('.typed-text').each(function(){
            var text = $(this);
            var strings = text.attr("data-typed-strings") ? text.attr("data-typed-strings").split(",") : [],
                themeDefaults = {
                    strings: [],
                    typeSpeed: 100,
                    loop: true,
                    showCursor: false
                }, ao = {};

            ao.strings = text.attr("data-typed-strings") ? text.attr("data-typed-strings").split(",") : undefined;

            $(text).typed(jQuery.extend({}, themeDefaults, mr.typed.options, ao));
            
        });
    };

    mr.components.documentReady.push(mr.typed.documentReady);
    return mr;

}(mr, jQuery, window, document));

//////////////// Twitter Feeds
mr = (function (mr, $, window, document){
    "use strict";
    
    mr.twitter = mr.twitter || {};
    mr.twitter.options = mr.twitter.options || {};

    mr.twitter.documentReady = function($){
        $('.tweets-feed').each(function(index) {
            $(this).attr('id', 'tweets-' + index);
        }).each(function(index) {
            var element = $('#tweets-' + index);
            
            var TweetConfig = {
               "domId": '',
               "maxTweets": 6,
               "enableLinks": true,
               "showUser": true,
               "showTime": true,
               "dateFunction": '',
               "showRetweet": false,
               "customCallback": handleTweets
            };

            TweetConfig = jQuery.extend(TweetConfig, mr.twitter.options);
           


            if(typeof element.attr('data-widget-id') !== typeof undefined){
                TweetConfig.id = element.attr('data-widget-id');
            }else if(typeof element.attr('data-feed-name') !== typeof undefined && element.attr('data-feed-name') !== ""){
                TweetConfig.profile = {"screenName": element.attr('data-feed-name').replace('@', '')};
            }else if(typeof mr.twitter.options.profile !== typeof undefined){
                TweetConfig.profile = {"screenName": mr.twitter.options.profile.replace('@', '')};
            }else{
                TweetConfig.profile = {"screenName": 'twitter'};
            }

            TweetConfig.maxTweets = element.attr('data-amount') ? element.attr('data-amount'): TweetConfig.maxTweets; 

            if(element.closest('.twitter-feed--slider').length){
                element.addClass('slider');
            }

            function handleTweets(tweets) {
                var x = tweets.length;
                var n = 0;
                var html = '<ul class="slides">';
                while (n < x) {
                    html += '<li>' + tweets[n] + '</li>';
                    n++;
                }
                html += '</ul>';
                element.html(html);
                
                // Initialize twitter feed slider
                if(element.closest('.slider').length){
                    mr.sliders.documentReady(mr.setContext());
                     
                    return html;
                }
            }
            twitterFetcher.fetch(TweetConfig);
        });
    };

    mr.components.documentReady.push(mr.twitter.documentReady);
    return mr;

}(mr, jQuery, window, document));

//////////////// Video
mr = (function (mr, $, window, document){
    "use strict";
    
    mr.video = mr.video || {};
    mr.video.options = mr.video.options || {};
    mr.video.options.ytplayer = mr.video.options.ytplayer || {};
    
	  mr.video.documentReady = function($){
	      loadYTBGvideo();
	  };

	  mr.components.documentReady.push(mr.video.documentReady);
	  return mr;

}(mr, jQuery, window, document));

//////////////// Wizard
mr = (function (mr, $, window, document){
    "use strict";
    
    mr.wizard = mr.wizard || {};

	  mr.wizard.documentReady = function($){

			$('.wizard').each(function(){
				var wizard = jQuery(this), themeDefaults = {};
 
        themeDefaults = {
					headerTag: "h5",
				  bodyTag: "section",
					transitionEffect: "slideLeft",
					autoFocus: true
				}      
				

				if(!wizard.is('[role="application"][id^="steps-uid"]')){  	
						wizard.steps(jQuery.extend({}, themeDefaults, mr.wizard.options));
		
		   	    wizard.addClass('active');
		    }
				
		  });
		};

	  mr.components.documentReady.push(mr.wizard.documentReady);
	  return mr;

}(mr, jQuery, window, document));