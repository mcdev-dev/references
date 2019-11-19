$(function() {

    function submitSearchBtn() 
    {
        $('.fa-search').click(() => 
        {
            $('#query').submit();
        });
    }
    submitSearchBtn();

    function viewProfileImage() 
    {
        $('.vich-image').after('<div id="view"></div>');

        $('#user_imageFile_file').on('change', (e) => {
            //$('.camera span').html(e.target.files[0].name);
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#view').html('<img src="'+ e.target.result +'" class="img-fluid">');
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    }
    viewProfileImage();

    function viewArticleImage() 
    {
        $('.vich-image').after('<div id="view"></div>');

        $('#article_imageFile_file').on('change', (e) => {
            //$('.camera span').html(e.target.files[0].name);
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#view').html('<img src="'+ e.target.result +'" class="img-fluid">');
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    }
    viewArticleImage();

    function confirmDelete() 
    {
        $('.confirm').click(() => 
        {
            return confirm('Êtes-vous certain de vouloir supprimer cet article ?');
        });
    }
    confirmDelete();

    function fabriqueUrbaine() 
    {
        let titre = $('.animate_fabrique_urbaine h3');
        let listElement = $('.animate_fabrique_urbaine ul li');

        titre.animate({
            opacity : 1
        }, 2000).animate({
            marginLeft : 0
        }, 1000, () => {
            listElement.animate({
                display : 'block',
            })
        });

    }
    fabriqueUrbaine();

    
    if($(window).width() > 992) 
    {
        function changeAngleRow() 
        {
            let angle = $('#angle');
            $('.ddToggle').mouseenter(() => {
                $(angle).addClass('angleDown');
            });
            $('.ddToggle').mouseleave(() => {
                $(angle).removeClass('angleDown');
            });
        }
        changeAngleRow();

        function srollBtn() 
        {
            $('.scroller').mouseenter(() => {
                $('.textScroll').fadeIn().animate({
                    top : '-40px',
                    opacity : 1,
                    pointerEvents: 'all'
                }, 250);
                $('.scroller i').css({
                    color : '#D9326F'
                });
            });
            $('.scroller').mouseleave(() => {
                $('.textScroll').animate({
                    top : '-10px',
                    opacity : 0,
                    pointerEvents: 'none'
                }, 125);
                $('.scroller i').css({
                    color : ''
                });
            });
            
            $('.scroller').click(() => 
            {
                let cible = $('html, body');
                $(cible).animate({
                    scrollTop : $(cible).offset().top
                }, 1000);
    
                $('.textScroll').fadeOut();
            });
    
            $(window).scroll(() => {
                if($(this).scrollTop() > 40) {
                    $('.scrollBtn').fadeIn('slow');
                } else {
                    $('.scrollBtn').fadeOut('slow');
                }
            });
    
        }
        srollBtn();

    }
    
    if($(window).width() < 992) 
    {
        function changeAngleRow() 
        {
            let angle = $('#angle');
            $('.ddToggle').click(() => {
                $(angle).toggleClass('angleDown');
            });
        }
        changeAngleRow();

        function srollBtn() 
        {
            $('.scroller').click(() => 
            {
                let cible = $('html, body');
                $(cible).animate({
                    scrollTop : $(cible).offset().top
                }, 1000);
            });
    
            $(window).scroll(() => {
                if($(this).scrollTop() > 40) {
                    $('.scrollBtn').fadeIn('slow');
                } else {
                    $('.scrollBtn').fadeOut('slow');
                }
            });
    
        }
        srollBtn();

        
        function burger() {

            // click on burger
            let burgerBtn = $('.burgerLine');
            let navLinks = $('.navigation');
            let iconeProfileBtn = $('.iconeProfile');
            let top = $('.top');

            burgerBtn.click(() => 
            {
                $(navLinks).toggleClass('navActive');
                $(burgerBtn).toggleClass('toggleBurger');
                $('body, html').toggleClass('flowY');
            });
            iconeProfileBtn.click(() => 
            {
                let element = $('#navBar');
                let bottom = element.offset().top + element.outerHeight();
                $(top).css({
                    top : bottom
                });

                $(top).toggleClass('topActive');
                $('.userCircle').toggleClass('toggleUser');
                $(iconeProfileBtn).toggleClass('toggleProfil');
                $('body, html').toggleClass('flowY');
            });
    
        }
        burger();

        function navbarFixed() 
        {
            //let navbarPosition = $('#navBar').offset().top;
            $(window).scroll(() => 
            {
                if($(window).scrollTop() > 116) {
                    $('#navBar').addClass('fixedTop');
                    $('body').css('paddingTop', '100px');
                } else {
                    $('#navBar').removeClass('fixedTop');
                    $('body').css('paddingTop', '');
                }
            });
        }
        navbarFixed();

        function burgerDeroulant() 
        {
            $('.submenu').hide();

            let menuNav = $('.navigation li div');
            
            $(menuNav).each((key, value) => 
            {
                $(value).click(() => {

                    if($(value).next('ul.submenu:visible').length != 0) 
                    {
                        $(value).next('ul.submenu').slideUp();
                    } else 
                    {
                        $('.navigation ul.submenu').slideUp();
                        $(value).next('ul.submenu').slideDown();
                    }
                });
            });
        }
        burgerDeroulant();



    } // $(window).width() < 992

    



    
    /*window.addEventListener('scroll', function() {
        let scrolled = this.scrollY;
        console.log(scrolled);
        
    });*/

}); // Chargement du DOM