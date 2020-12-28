/* ~~~~~~~~~~ sticky header ~~~~~~~~~~ */
jQuery("document").ready(function() {
    jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > 100) {
            jQuery('header').addClass("sticky-header")
        } else {
            jQuery('header').removeClass("sticky-header")
        }
    })
});
/* ~~~~~~~~~~ sticky header ~~~~~~~~~~ */

/* ~~~~~~~~~~ header search and menu toggle ~~~~~~~~~~ */
jQuery(document).ready(function() {
    jQuery('.icon').click(function() {
        jQuery('.long-nav-holder').toggleClass('expanded');
    });
    jQuery('.hamburger-nav, .mobile-menu ul li a').click(function() {
      jQuery('.header-section').toggleClass('mobile-menu-open');
    });
});

    

    
jQuery(document).ready(function(){ 

    
jQuery("a.modal-btn").fancybox();

//jQuery(".fancybox").fancybox({
//   'type' : 'iframe',
//        'scrolling' : 'no',
//        'fitToView': true,
//        'iframe' : {
//                    'scrolling' : 'no',
//                    'preload'   : false
//                } 
//});    
      
//    
//jQuery('#banner-carousel').owlCarousel({
//    loop:true,
//    margin:0,
//    nav:true,
//    /*navText:['<i class="fa fa-chevron-left" aria-hidden="true"></i>','<i class="fa fa-chevron-right" aria-hidden="true"></i>'],*/
//    dots:false,
//    items:1,
//    responsive:{
//            0:{
//            items:1,
//            nav:false,
//            dots:true,
//           },
//            768:{
//            items:1,
//            nav:true,
//            dots:false,
//           },
//            992:{
//            items:1,
//            nav:true,
//            dots:false,
//          },
//          1200:{
//            items:1,
//            nav:true,
//            dots:false,
//          }
//        }
//   });  
//    
//    
//jQuery('#testi-carousel').owlCarousel({
//    loop:true,
//    margin:0,
//    nav:false,
//    /*navText:['<i class="fa fa-chevron-left" aria-hidden="true"></i>','<i class="fa fa-chevron-right" aria-hidden="true"></i>'],*/
//    dots:false,
//    items:1,
//    responsive:{
//            0:{
//            items:1,
//            nav:false,
//            dots:false,
//           },
//            768:{
//            items:1,
//            nav:false,
//            dots:false,
//           },
//            992:{
//            items:1,
//            nav:false,
//            dots:false,
//          },
//          1200:{
//            items:1,
//            nav:false,
//            dots:false,
//          }
//        }
//   }); 
//    
//    
//    
//    jQuery('#team-review').owlCarousel({
//    loop:true,
//    margin:0,
//    nav:false,
//    /*navText:['<i class="fa fa-chevron-left" aria-hidden="true"></i>','<i class="fa fa-chevron-right" aria-hidden="true"></i>'],*/
//    dots:false,
//    items:1,
//    responsive:{
//            0:{
//            items:1,
//            nav:false,
//            dots:false,
//           },
//            768:{
//            items:1,
//            nav:false,
//            dots:false,
//           },
//            992:{
//            items:1,
//            nav:false,
//            dots:false,
//          },
//          1200:{
//            items:1,
//            nav:false,
//            dots:false,
//          }
//        }
//   }); 
   

//    
//    
//        // Helper function for add element box list in WOW
//        WOW.prototype.addBox = function(element) {
//        this.boxes.push(element);
//        };
//           wow = new WOW(
//                      {
//                      boxClass:     'wow',      // default
//                      animateClass: 'animated', // default
//                      offset:       0,          // default
//                      mobile:       true,       // default
//                      live:         true        // default
//                    }
//                    )
//                    wow.init();
//        
//         // Attach scrollSpy to .wow elements for detect view exit events,
//          // then reset elements and add again for animation
//          jQuery('.wow').on('scrollSpy:exit', function() {
//            jQuery(this).css({
//              'visibility': 'hidden',
//              'animation-name': 'none'
//            }).removeClass('animated');
//            wow.addBox(this);
//          });     
    
    
    var countDownDate = Date.parse(parseDateString(weaversAjax.TimerDate));

    // Update the count down every 1 second
    var x = setInterval(function() {

      // Get today's date and time
      var now = new Date().getTime();
        
      // Find the distance between now and the count down date
      var distance = countDownDate - now;
        
      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
      // Output the result in an element with id="demo"
      // document.getElementById("demo").innerHTML = days + "d " + hours + "h "+ minutes + "m " + seconds + "s ";
      jQuery('.countdown-timer').html(('0' + days).slice(-2) + " : " + ('0' + hours).slice(-2) + " : "+ ('0' + minutes).slice(-2) + " : " + ('0' + seconds).slice(-2) );

      // If the count down is over, write some text 
      if (distance < 0) {
        clearInterval(x);
        // document.getElementById("demo").innerHTML = "EXPIRED";
        jQuery('.countdown-timer').html("EXPIRED");
      }
    }, 1000);
    
	// jQuery(".smoothscroll > a").click(function(e) {
	// 	e.preventDefault();
 //    var url = jQuery(this).attr('href');
	// 	var hash = url.substring(url.indexOf('#')+1);
	// 	jQuery('html, body').animate({
	// 		scrollTop: jQuery('#'+hash).offset().top-100
	// 	}, 500);
 //    jQuery(this).parent().removeClass('mobile-menu-open');
	// });

  jQuery(document).on('click', ".smoothscroll > a", function(event) {
    event.preventDefault();
      var hash = this.hash;
      console.log(hash);
      jQuery(this).parent().removeClass('mobile-menu-open');
      hashRedirect(hash);
  });
});    

function hashRedirect(hash) {
    var baseUrl = window.location.protocol + "//" + window.location.host;
    if (jQuery('body').hasClass( "home" )) {
        event.preventDefault(); // Prevent default anchor click behavior  
        var offSet = 100;
        var obj = jQuery(hash).offset();
        var targetOffset = obj.top - offSet;    
        jQuery("html, body").animate({
            scrollTop: targetOffset
        }, 500);
    } else {
        window.location.href = baseUrl + "/" + hash;
    }
} 

function parseDateString (dateString) {
    var matchers = [];
    matchers.push(/^[0-9]*$/.source);
    matchers.push(/([0-9]{1,2}\/){2}[0-9]{4}( [0-9]{1,2}(:[0-9]{2}){2})?/.source);
    matchers.push(/[0-9]{4}([\/\-][0-9]{1,2}){2}( [0-9]{1,2}(:[0-9]{2}){2})?/.source);
    matchers = new RegExp(matchers.join("|"));
    if (dateString instanceof Date) {
        return dateString;
    }
    if (String(dateString).match(matchers)) {
        if (String(dateString).match(/^[0-9]*$/)) {
            dateString = Number(dateString);
        }
        if (String(dateString).match(/\-/)) {
            dateString = String(dateString).replace(/\-/g, "/");
        }
        return new Date(dateString);
    } else {
        throw new Error("Couldn't cast `" + dateString + "` to a date object.");
    }
}   











