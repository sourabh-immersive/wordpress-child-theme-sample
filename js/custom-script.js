$=jQuery;
jQuery(document).ready(function(){
  var days = 1; 
  var now = new Date().getTime();
  var setupTime = localStorage.getItem('setupTime');
  var notification = localStorage.getItem('notification');
  if (localStorage.setupTime) {
    if(now-setupTime > days*24*60*60*1000) {
      localStorage.removeItem('notification');
      localStorage.removeItem('setupTime');
    }
  }
  if (notification == 'hide') {
    jQuery('.notification-bar').hide();
  } else {
    jQuery('.notification-bar').show();
  }
  jQuery('.notification-close').on('click',function(){
		jQuery('.notification-bar').hide();
    localStorage.notification = "hide";
    localStorage.setItem('setupTime', now);
	})
  jQuery('body').on('mouseover','li.mega-menu-item-has-children a',function () {
    jQuery('main').addClass("result_hover");
  });
  jQuery('body').on('mouseout','li.mega-menu-item-has-children a',function () {
    jQuery('main').removeClass("result_hover");
  });
  if ($("#mcatswiper").length > 0) {
    var mobileswiper2 = new Swiper("#mcatswiper", {
        slidesPerView: 1.3,
        spaceBetween: 10,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        breakpoints: {
          // when window width is <= 499px
          768: {
              slidesPerView: 2.3,
          }
        }
    });
  }
  /*if ($("#dcatswiper").length > 0) {
	 var swiper2 = new Swiper("#dcatswiper", {
        slidesPerView: 1.3,
        spaceBetween: 10,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
          nextEl: ".swiper-button-next_new",
          prevEl: ".swiper-button-prev_new",
        },
        breakpoints: {
          // when window width is <= 499px
          767: {
              slidesPerView: 1,
          }
        }
      });
  }*/
  if ($("#mbestproductswiper").length > 0) {
      var swiper3 = new Swiper("#mbestproductswiper", {
        slidesPerView: 1.3,
        spaceBetween: 10,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        breakpoints: {
          // when window width is <= 499px
          768: {
              slidesPerView: 2.3,
          }
        }
      });
  }
  if ($("#mdbestproductswiper").length > 0) {
      var swiper3 = new Swiper("#mdbestproductswiper", {
        slidesPerView: 1.0,
        spaceBetween: 10,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        breakpoints: {
          // when window width is <= 499px
          768: {
              slidesPerView: 1,
          }
        }
      });
  }
 
      var addonproductswiper = new Swiper(".addonproductswiper", {
        slidesPerView: 1,
        spaceBetween: 10,        
        navigation: {
          nextEl: ".swiperNextaddon",
          prevEl: ".swiperPrevaddon",
        },
        breakpoints: {
          // when window width is <= 499px
          499: {
              slidesPerView: 3,
          }
        }
      });
      /*function reinitSwiper(catswapswiper) {
        setTimeout(function () {
         catswapswiper.reInit();
        }, 500);
      }
      reinitSwiper(catswapswiper);*/   
      /*
        on: {
          beforeInit: function () {
            let numOfSlides = this.wrapperEl.querySelectorAll(".swiper-slide").length;
            if (numOfSlides >= 12) {
              $('.swiperNextcats,.swiperPrevcats').show();
            }
          }
        }*/  
  
      var relatedproductswiper = new Swiper(".relatedproductswiper", {
        slidesPerView: 1,
        spaceBetween: 10,
        navigation: {
          nextEl: ".swiper-button-next1",
          prevEl: ".swiper-button-prev1",
        },
         breakpoints: {
          // when window width is <= 499px
          499: {
              slidesPerView: 2,
          },
          768: {
              slidesPerView: 3,
          },
          980: {
              slidesPerView: 4,
          }
        }
      });
  
      var productfeaturedgalleryswiper = new Swiper(".productfeaturedgalleryswiper", {
        slidesPerView: 1,
        spaceBetween: 10,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
          nextEl: ".swiperNextFeatured",
          prevEl: ".swiperPrevFeatured",
        },
      });
      var catswapswipernav = new Swiper(".catswapswipernav", {
        slidesPerView: 3,
        spaceBetween: 0, 
        slidesPerGroup: 3,
        loop: false,
        loopFillGroupWithBlank: true,
        navigation: {
              nextEl: ".swiperNextcats1",
              prevEl: ".swiperPrevcats1",
            }, 

        breakpoints: {
          // when window width is <= 499px
          499: {
            slidesPerView: 3,
            slidesPerGroup: 3,
          },
          768: {
            slidesPerView: 7,
            slidesPerGroup: 7,
          },       
          1024: {
            slidesPerView:  9,
            slidesPerGroup: 9, 
          },
          1200: {
            slidesPerView:  12,
            slidesPerGroup: 12, 
          }
        },
        on: {
          beforeInit: function () {
            let numOfSlides = this.wrapperEl.querySelectorAll(".swiper-slide").length;
            
            if (numOfSlides >= 12) {
              /*console.log(this.wrapperEl.className);*/             
              $(this.wrapperEl).addClass('swipercenter');
            }
          }
        }
      });
jQuery(document).on('click','.mega-menu-item-has-children a.mega-menu-link',function(){
      nextelm = jQuery(this).parent().find('.catswapswiper')
      console.log(nextelm,344)
      if(nextelm !=null){
        catnavslider(nextelm);
      }

});
jQuery(document).on('click','.mega-menu-item-has-children span.mega-indicator',function(){
      nextelm = jQuery(this).parents('.mega-menu-item-has-children').find('.catswapswiper')
      console.log(nextelm,344)
      if(nextelm !=null){
        catnavslider(nextelm);
      }

});
function catnavslider(nextelm){
      if(nextelm !=null){
        var id = nextelm[0].id

        var catswapswiper = new Swiper('.catswapswiper-'+id, {
        slidesPerView: 3,
        spaceBetween: 10, 
        navigation: {
              nextEl: ".catswapswiper-"+id+" .swiperNextcats",
              prevEl: ".catswapswiper-"+id+" .swiperPrevcats",
            }, 

        breakpoints: {
          // when window width is <= 499px
          499: {
             slidesPerView: 3,
            
          },
          768: {
              slidesPerView: 6,
          },
          981: {
              slidesPerView: 12,
          }
        },
      });
      }
}



      /** Grid View List View JS **/
      $('#changeviewcs .switchToList').click(function(){
        $(this).addClass('active');
        $('#changeviewcs .switchToGrid').removeClass('active');
        $('ul.products').addClass('cslist-view');
      });
      $('#changeviewcs .switchToGrid').click(function(){
        $('ul.products').removeClass('cslist-view');
        $(this).addClass('active');        
        $('#changeviewcs .switchToList').removeClass('active');
      });
       /** Grid View List View JS **/
      /*jQuery("#mob-filter .wpfMainWrapper .wpfCheckbox input").on('click',function(){
        jQuery("#mob-filter").hide();
      });*/

      jQuery("#mob-filter .wpfFilterButtons .wpfButton").on('click',function(){
          jQuery("#mob-filter").hide("slow");
      })
      jQuery("#desktop-filter .wpfFilterButtons .wpfButton").on('click',function(){
        jQuery("#desktop-filter").hide("slow");
      })

      jQuery("#filter_btn").on('click',function(){ 
        jQuery("#mob-filter").show(500);     
        var $slider = jQuery("#mob-filter");
        $slider.animate({
          right: parseInt($slider.css('right'),10) == 0 ?
           0 : 0
        });
      });
      jQuery("#filter_btn_desk").on('click',function(){ 
        jQuery("#desktop-filter").show(500);     
        var $slider = jQuery("#desktop-filter");
        $slider.animate({
          right: parseInt($slider.css('right'),10) == 0 ?
           0 : 0
        });
      });
      jQuery("#close-mobfilter").on('click',function(){
        jQuery("#mob-filter").hide();
      })
  });
	jQuery(window).scroll(function() {
	    //var scroll = jQuery(window).scrollTop();
      var sticky = jQuery('.main-header.desktop'),
      scroll = jQuery(window).scrollTop();

      if (scroll > 150) {
        sticky.addClass('scroll_header');
        jQuery(".main-header.mobileNav .notification-bar").addClass("scroll_header");
        jQuery(".main-header.mobileNav .search-bar-section").addClass("scrollheader");
      }
      if (scroll < 200) { 
        sticky.removeClass('scroll_header'); 
        jQuery(".main-header.mobileNav .notification-bar").removeClass("scroll_header");
        jQuery(".main-header.mobileNav .search-bar-section").removeClass("scrollheader");
      }

	    /*if (scroll > 200) {
	        jQuery(".main-header.desktop").addClass("scroll_header");
          jQuery(".main-header.mobileNav .notification-bar").addClass("scroll_header");
          jQuery(".main-header.mobileNav .search-bar-section").addClass("scrollheader");
	    } else if (scroll < 198) {
	        jQuery(".main-header.desktop").removeClass("scroll_header");
          jQuery(".main-header.mobileNav .notification-bar").removeClass("scroll_header");
          jQuery(".main-header.mobileNav .search-bar-section").removeClass("scrollheader");
	    }*/
	});

  



jQuery(window).scroll(function() {
		var scrollDistance = jQuery(window).scrollTop();

		// Assign active class to nav links while scolling
		jQuery('.page-section').each(function(i) {
				if (jQuery(this).position().top <= scrollDistance) {
						jQuery('.navigation a.mdactive').removeClass('mdactive');
						jQuery('.navigation a').eq(i).addClass('mdactive');
				}
		});
}).scroll();