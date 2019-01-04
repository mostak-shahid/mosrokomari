jQuery(document).ready(function($) {
	var loader = $('#loader-status').val();
	if (loader == 1) {
		$('body').css({"height": "100%", "overflow": "hidden"})
		$(window).load(function() {
			// Animate loader off screen
			$('body').removeAttr("style");
			$(".se-pre-con").fadeOut("slow");
		});
	}
	//goto top
	
	$(window).scroll(function(){
		if ($(this).scrollTop() > 100) {
			$('.scrollup').fadeIn();
		} else {
			$('.scrollup').fadeOut();
		}
	}); 
	$('.scrollup').click(function(){
		$("html, body").animate({ scrollTop: 0 }, 600);
		return false;
	});	
    $(".small-menu").click(function() {
        $("ul.mobile-menu").toggleClass('open');
    });
	$(".mobile-menu li:has('ul')").prepend("<span class='drop_down_icon fa fa-angle-down'></span>");
    
    $(".drop_down_icon").click(function() {
        $(this).siblings("ul").slideToggle();
    });	

    
    $(".video-icon").click(function() {
    	var id = $(this).attr('id');
        $(this).parent().empty().after('<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'+id+'?autoplay=1" allowfullscreen></iframe></div>');
    });    
    $(".img-video-icon").click(function() {
    	var url = $(this).data('url');
        $(this).parent().empty().after('<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="'+url+'"></iframe></div>');
    });
	$("div.holder").jPages({
        containerID: "itemContainer",
        perPage: 6,
        previous: "prev",
        next: "next",
    });	
    var holder_elements = $(".holder").find('a').length;
    if (holder_elements <= 3) {$("div.holder").hide()}

    $("[data-fancybox]").fancybox({
    	loop : true,
    });
    $(".lazy").Lazy();
    $(window).load(function(){
		$(".sticky_menu").sticky({ topSpacing: 0 });
		var img_height = $("#section-whowe .img-whowe").height();
		$('#section-whowe .flex').css('min-height', img_height);
	});
	new WOW().init();
	var sec_slider = $('.sec-slider');
	sec_slider.owlCarousel({
	    loop:true,
	    nav:true,
	    dots: true,
	    margin:0,
	    items:1,	    
	    lazyLoad: true,
	    autoplay:true,
	    autoplayTimeout:6000,
	    autoplayHoverPause:true,
		animateOut: 'fadeOut',
		animateIn: 'fadeIn',
	});	
	//Woocommerce
	var woocommerce_result_view;
    $(".woocommerce-result-view a").click(function(link){
    	link.preventDefault();
        woocommerce_result_view = $(this).data('id');
        $(this).siblings().removeClass('active');
        $(this).addClass('active');
        setCookie('woocommerce_result_view',woocommerce_result_view,30);
		$('.archive ul.products > li').removeClass('grid-view').removeClass('list-view').addClass(woocommerce_result_view);
    });
    if (getCookie('woocommerce_result_view')) {
		$('.archive ul.products > li').removeClass('grid-view').removeClass('list-view').addClass(getCookie('woocommerce_result_view'));
		$('.' + getCookie('woocommerce_result_view')).addClass('active');
	} else {
		$(".woocommerce-result-view a.grid-view").addClass('active');
	}
});
function setCookie(cname,cvalue,exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}