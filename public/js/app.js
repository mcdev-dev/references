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

    if($(window).width() > 992) 
    {
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
            burgerBtn.click(() => {
                $(navLinks).toggleClass('navActive');
                $(burgerBtn).toggleClass('toggleBurger');
            });
            iconeProfileBtn.click(() => {
                $(top).toggleClass('topActive');
                $('.userCircle').toggleClass('toggleUser');
                $(iconeProfileBtn).toggleClass('toggleProfil');
            });
    
        }
        burger();
    



    }





}); // Chargement du DOM