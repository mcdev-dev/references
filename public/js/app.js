$(function () {

    function submitSearchBtn() {
        $('.fa-search').click(() => {
            $('#query').submit();
        });
    }
    submitSearchBtn();

    function viewProfileImage() {
        $('.vich-image').after('<div id="view"></div>');

        $('#user_imageFile_file').on('change', (e) => {
            //$('.camera span').html(e.target.files[0].name);
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#view').html('<img src="' + e.target.result + '" class="img-fluid">');
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    }
    viewProfileImage();

    function viewArticleImage() {
        $('.vich-image').after('<div id="view"></div>');

        $('#article_imageFile_file').on('change', (e) => {
            //$('.camera span').html(e.target.files[0].name);
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#view').html('<img src="' + e.target.result + '" class="img-fluid">');
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    }
    viewArticleImage();

    function confirmDelete() {
        $('.confirm').click(() => {
            return confirm('Êtes-vous certain de vouloir supprimer cet article ?');
        });
    }
    confirmDelete();

    function multiImagesUpload() {
        $('.add-another-collection-widget').click((e) => {
            let thisElement = '.add-another-collection-widget';
            var list = $($(thisElement).attr('data-list-selector'));
            // Try to find the counter of the list or use the length of the list
            var counter = list.data('widget-counter') | list.children().length;

            // grab the prototype template
            var newWidget = list.attr('data-prototype');
            // replace the "__name__" used in the id and name of the prototype
            // with a number that's unique to your emails
            // end name attribute looks like name="contact[emails][2]"
            newWidget = newWidget.replace(/__name__/g, counter);
            // Increase the counter
            counter++;
            // And store it, the length cannot be used if deleting widgets is allowed
            list.data('widget-counter', counter);

            // create a new list element and add it to the list
            var newElem = $(list.attr('data-widget-tags')).html(newWidget);
            newElem.appendTo(list);
        });
    }
    multiImagesUpload();


    if ($(window).width() > 992) {
        function changeAngleRow() {
            let angle = $('#angle');
            $('.ddToggle').mouseenter(() => {
                $(angle).addClass('angleDown');
            });
            $('.ddToggle').mouseleave(() => {
                $(angle).removeClass('angleDown');
            });
        }
        changeAngleRow();

        function srollBtn() {
            $('.scroller').mouseenter(() => {
                $('.textScroll').fadeIn().animate({
                    top: '-40px',
                    opacity: 1,
                    pointerEvents: 'all'
                }, 250);
                $('.scroller i').css({
                    color: '#D9326F'
                });
            });
            $('.scroller').mouseleave(() => {
                $('.textScroll').animate({
                    top: '-10px',
                    opacity: 0,
                    pointerEvents: 'none'
                }, 125);
                $('.scroller i').css({
                    color: ''
                });
            });

            $('.scroller').click(() => {
                let cible = $('html, body');
                $(cible).animate({
                    scrollTop: $(cible).offset().top
                }, 1000);

                $('.textScroll').fadeOut();
            });

            $(window).scroll(() => {
                if ($(this).scrollTop() > 40) {
                    $('.scrollBtn').fadeIn('slow');
                } else {
                    $('.scrollBtn').fadeOut('slow');
                }
            });

        }
        srollBtn();

    }

    if ($(window).width() < 992) {
        function changeAngleRow() {
            let angle = $('#angle');
            $('.ddToggle').click(() => {
                $(angle).toggleClass('angleDown');
            });
        }
        changeAngleRow();

        function srollBtn() {
            $('.scroller').click(() => {
                let cible = $('html, body');
                $(cible).animate({
                    scrollTop: $(cible).offset().top
                }, 1000);
            });

            $(window).scroll(() => {
                if ($(this).scrollTop() > 40) {
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
                $('body, html').toggleClass('flowY');
            });
            iconeProfileBtn.click(() => {
                let element = $('#navBar');
                let bottom = element.offset().top + element.outerHeight();
                $(top).css({
                    top: bottom
                });

                $(top).toggleClass('topActive');
                $('.userCircle').toggleClass('toggleUser');
                $(iconeProfileBtn).toggleClass('toggleProfil');
                $('body, html').toggleClass('flowY');
            });

        }
        burger();

        function navbarFixed() {
            //let navbarPosition = $('#navBar').offset().top;
            $(window).scroll(() => {
                if ($(window).scrollTop() > 116) {
                    $('#navBar').addClass('fixedTop');
                    $('body').css('paddingTop', '100px');
                } else {
                    $('#navBar').removeClass('fixedTop');
                    $('body').css('paddingTop', '');
                }
            });
        }
        navbarFixed();

        function burgerDeroulant() {
            $('.submenu').hide();

            let menuNav = $('.navigation li div');

            $(menuNav).each((key, value) => {
                $(value).click(() => {

                    if ($(value).next('ul.submenu:visible').length != 0) {
                        $(value).next('ul.submenu').slideUp();
                    } else {
                        $('.navigation ul.submenu').slideUp();
                        $(value).next('ul.submenu').slideDown();
                    }
                });
            });
        }
        burgerDeroulant();



    } // $(window).width() < 992

    function articleSearch() {

    }
    articleSearch();




    /*window.addEventListener('scroll', function() {
        let scrolled = this.scrollY;
        console.log(scrolled);
        
    });*/

}); // Chargement du DOM