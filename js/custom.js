jQuery(document).ready(function($){
	
    /** navigation menu */
    var menuItems1 = document.querySelectorAll('.main-navigation li.menu-item-has-children');
    var menuItems2 = document.querySelectorAll('.main-navigation li.page_item_has_children');

    if( $('.page_item_has_children').length > 0 ){ 
        var menuItems = menuItems2;

        Array.prototype.forEach.call(menuItems, function(el, i){
            var activatingA = el.querySelector('a');
            var btn = '<button class="btn-submenu" aria-expanded="false"></button>';
            activatingA.insertAdjacentHTML('afterend', btn);
            el.querySelector('button').parentNode.querySelector('a').setAttribute('aria-expanded', "false");
            el.querySelector('button').addEventListener("click",  function(event){
                
                if ( !( this.parentNode.classList.contains( "open" ) ) ) {
                    //this.parentNode.className = "menu-item-has-children open";
                    this.parentNode.classList.add('open');
                    this.parentNode.querySelector('a').setAttribute('aria-expanded', "true");
                    this.parentNode.querySelector('button').setAttribute('aria-expanded', "true");
                } else {
                    this.parentNode.classList.remove('open');
                    //this.parentNode.className = "menu-item-has-children";
                    this.parentNode.querySelector('a').setAttribute('aria-expanded', "false");
                    this.parentNode.querySelector('button').setAttribute('aria-expanded', "false");
                }
                event.preventDefault();
            });
        });

    }else if(  $('.menu-item-has-children').length > 0  ){
        var menuItems = menuItems1;
            Array.prototype.forEach.call(menuItems, function(el, i){
            var activatingA = el.querySelector('a');
            var btn = '<button class="btn-submenu" aria-expanded="false"></button>';
            activatingA.insertAdjacentHTML('afterend', btn);
            el.querySelector('button').parentNode.querySelector('a').setAttribute('aria-expanded', "false");
            el.querySelector('button').addEventListener("click",  function(event){
                
                if ( !( this.parentNode.classList.contains( "open" ) ) ) {
                    //this.parentNode.className = "menu-item-has-children open";
                    this.parentNode.classList.add('open');
                    this.parentNode.querySelector('a').setAttribute('aria-expanded', "true");
                    this.parentNode.querySelector('button').setAttribute('aria-expanded', "true");
                } else {
                    this.parentNode.classList.remove('open');
                    //this.parentNode.className = "menu-item-has-children";
                    this.parentNode.querySelector('a').setAttribute('aria-expanded', "false");
                    this.parentNode.querySelector('button').setAttribute('aria-expanded', "false");
                }
                event.preventDefault();
            });
        });
    }


    /** Variables from Customizer for Slider settings */
    if( bakery_shop_data.auto == '1' ){
        var slider_auto = true;
    }else{
        slider_auto = false;
    }
    
    if( bakery_shop_data.loop == '1' ){
        var slider_loop = true;
    }else{
        var slider_loop = false;
    }
    
    if( bakery_shop_data.pager == '1' ){
        var slider_control = true;
    }else{
        slider_control = false;
    }


    if( bakery_shop_data.animation == 'fade' ){
        var slider_animation = 'fade';
    }else{
        slider_animation = '';
    }
    
   
    /** Home Page  Banner Slider */
   
	$('.fadeout').owlCarousel({
		items: 1,
		animateOut: slider_animation,// animation
		loop: slider_loop, // loop
		margin: 10,
		nav: true,
		navText:["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
		autoplay: slider_auto, //auto play
		dots:  slider_control, //slider control
		slideSpeed       : bakery_shop_data.speed,
		autoplayTimeout: bakery_shop_data.pause
	});

    
    $('.featured-slider').owlCarousel({
        loop: true, // loop
        margin: 10,
        nav: true,
        navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
        autoplay: true, //auto play
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:true
            },
            480:{
                items:2,
                nav:false
            },
            768:{
                items:4,
                nav:true,
                loop:false
            }
        }
    });

    $('.testimonial-slider').owlCarousel({
        thumbs: true,
        loop: true, // loop
        margin: 10,
        nav: true,
        navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
        autoplay: true, //auto play
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:true
            },
            480:{
                items:1,
                nav:false
            },
            768:{
                items:2,
                nav:true,
                loop:false
            }
        }
    });

    // responsive menu

    $('#responsive-menu-button').sidr({
        name: 'sidr-main',
        source: '#site-navigation',
        side: 'right'
    });
        
});