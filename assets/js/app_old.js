$(function () {

    function submitSearchBtn() {
        $('.glassIcon').click(() => {
            $('#search').submit();
        });
    }
    submitSearchBtn();

    function addFormAttribute() 
    {
        $('#user_password_first').attr('placeholder', 'Mot de passe');
        $('#user_password_second').attr('placeholder', 'Confirmation du mot de passe');
    }
    addFormAttribute();

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
        $('#view').after('<span id="fileName"></span>');

        $('#ref_logements_imageFile_file').on('change', (e) => {
            //$('.camera span').html(e.target.files[0].name);
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#view').html('<img src="' + e.target.result + '" class="img-fluid">');
            }
            reader.readAsDataURL(e.target.files[0]);
        });

        $('#article_imageFile_file').on('change', (e) => {
            //$('.camera span').html(e.target.files[0].name);
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#view').html('<img src="' + e.target.result + '" class="img-fluid">');
            }
            reader.readAsDataURL(e.target.files[0]);
        });

        $('#article_actu_imageFile_file').on('change', (e) => {
            //$('.camera span').html(e.target.files[0].name);
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#view').html('<img src="' + e.target.result + '" class="img-fluid">');
            }
            reader.readAsDataURL(e.target.files[0]);
        });

        $('#article_multi_images_0_imageFile_file').on('change', (e) => {
            //$('.camera span').html(e.target.files[0].name);
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#view').html('<img src="' + e.target.result + '" class="img-fluid">');
            }
            reader.readAsDataURL(e.target.files[0]);
        });

        $('#article_multi_images_1_imageFile_file').on('change', (e) => {
            //$('.camera span').html(e.target.files[0].name);
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#view').html('<img src="' + e.target.result + '" class="img-fluid">');
            }
            reader.readAsDataURL(e.target.files[0]);
        });

        $('#article_multi_images_2_imageFile_file').on('change', (e) => {
            //$('.camera span').html(e.target.files[0].name);
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#view').html('<img src="' + e.target.result + '" class="img-fluid">');
            }
            reader.readAsDataURL(e.target.files[0]);
        });

        $('#article_multi_images_3_imageFile_file').on('change', (e) => {
            //$('.camera span').html(e.target.files[0].name);
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#view').html('<img src="' + e.target.result + '" class="img-fluid">');
            }
            reader.readAsDataURL(e.target.files[0]);
        });

        $('#article_multi_images_4_imageFile_file').on('change', (e) => {
            //$('.camera span').html(e.target.files[0].name);
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#view').html('<img src="' + e.target.result + '" class="img-fluid">');
            }
            reader.readAsDataURL(e.target.files[0]);
        });

        $('#article_multi_images_5_imageFile_file').on('change', (e) => {
            //$('.camera span').html(e.target.files[0].name);
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#view').html('<img src="' + e.target.result + '" class="img-fluid">');
            }
            reader.readAsDataURL(e.target.files[0]);
        });

        $('#join_us_cvFile_file').on('change', (e) => {
            $('#join_us_cvFile_file').after(e.target.files[0].name);
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#join_us_cvFile_file').after('<div class="mt-3 mb-2"><img src="' + e.target.result + '" class="img-fluid"></div>');
            }
            reader.readAsDataURL(e.target.files[0]);
        });

        $('#join_us_lettreMotivationFile_file').on('change', (e) => {
            $('#join_us_lettreMotivationFile_file').after(e.target.files[0].name);
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#join_us_lettreMotivationFile_file').after('<div class="mt-3 mb-2"><img src="' + e.target.result + '" class="img-fluid"></div>');
            }
            reader.readAsDataURL(e.target.files[0]);
        });

        $('#join_us_bookFile_file').on('change', (e) => {
            $('#join_us_bookFile_file').after(e.target.files[0].name);
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#join_us_bookFile_file').after('<div class="mt-3 mb-2"><img src="' + e.target.result + '" class="img-fluid"></div>');
            }
            reader.readAsDataURL(e.target.files[0]);
        });

    }
    viewArticleImage();

    function confirmDelete() 
    {
        $('.confirm__user__js').click(() => 
        {
            return confirm('Êtes-vous certain de vouloir supprimer cet utilisateur ?');
        });

        $('.confirm').click(() => 
        {
            return confirm('Êtes-vous certain de vouloir supprimer cet article ?');
        });

        $('.confirm__candidature__del').click(() => 
        {
            return confirm('Êtes-vous certain de vouloir supprimer cette candidature ?');
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

    function viewOtherPhotos() {
        let large = $('#large');
        let thumbnail = $('.thumbnailImg');

        thumbnail.each((key, value) => {
            $(value).click((e) => {
                e.preventDefault();
                let src = $(value).attr('src');
                //console.log(src);
                $(large).attr('src', src);
                $(large).parent().attr('href', src);
            });
        });
    }
    viewOtherPhotos();


    if ($(window).width() > 992) 
    {
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
            let errors = false;
            let burgerBtn = $('.burgerLine');
            let navLinks = $('.navigation');
            let iconeProfileBtn = $('.iconeProfile');
            let top = $('#top');
            let topPos = $('#top').offset().left;
            let navigationPos = $('.navigation').offset().left;

            console.log(topPos);
            console.log(navigationPos);

            burgerBtn.click(() => 
            {
                $(navLinks).toggleClass('navActive');
                $(burgerBtn).toggleClass('toggleBurger');
                $('body, html').toggleClass('flowY');
                
                topToggle();
            });

            iconeProfileBtn.click(() => 
            {
                $(top).toggleClass('topActive');
                $('.userCircle').toggleClass('toggleUser');
                $(iconeProfileBtn).toggleClass('toggleProfil');
                $('body, html').toggleClass('flowY');
                
                navigationToggle();
            });

        }
        burger();

        function topToggle() 
        {
            $('#top').removeClass('topActive');
            $('.userCircle').removeClass('toggleUser');
            $('.iconeProfile').removeClass('toggleProfil');
        }
        topToggle();

        function navigationToggle() 
        {
            $('.navigation').removeClass('navActive');
            $('.burgerLine').removeClass('toggleBurger');
            $('body, html').removeClass('flowY');
        }
        navigationToggle();

        function navbarFixed() {
            //let navbarPosition = $('#navBar').offset().top;
            $(window).scroll(() => {
                if ($(window).scrollTop() > 116) {
                    $('#navBar').addClass('fixedTop');
                    $('#navBar').css('boxShadow', '0 2px 6px grey');
                    $('body').css('paddingTop', '100px');

                    $('.top').css({
                        top: $('#navBar').offset().top + 14+'px',
                    });
                } else {
                    $('#navBar').removeClass('fixedTop');
                    $('#navBar').css('boxShadow', '');
                    $('body').css('paddingTop', '');

                    $(top).css({
                        top: '',
                    });
                }
            });
        }
        navbarFixed();

        function burgerDeroulant() 
        {
            let errors = false;

            let menuNav = $('#subMenu__elevator');
            
            menuNav.click(() => 
            {
                if(errors !== true) 
                {
                    $('#submenu').stop().slideDown('slow');
                    $('.icon-down').attr('class', 'icon-up');
                    errors = true;
                } 
                else 
                {
                    $('#submenu').stop().slideUp('slow');
                    $('.icon-up').attr('class', 'icon-down');
                    errors = false;
                }
            });
        }
        burgerDeroulant();



    } // $(window).width() < 992

    function articleSearch() {
        let searchBar = $('#search-input');
        let affResult = $('#result');

        searchBar.on('keyup', () => {
            affResult.fadeIn();
            let saisie = $(searchBar).val();
            let url = $('#search').attr('action');
            let data = $('#search').serialize();

            $.ajax({
                method: 'post',
                url: url,
                data: data,
                dataType: 'json',
                success: (response) => {
                    //console.log(response);
                    if (response.errors) {
                        $(affResult).html('<div class="alert alert-danger">' + response.errors + '</div>');
                    } else {
                        $(affResult).html(response.results);
                    }

                }
            });
        });

        searchBar.on('blur', () => {
            affResult.fadeOut();
        });
    }
    articleSearch();

    function progressBarCandidature() 
    {
        //jquery Time
        var current_fs, next_fs, previous_fs; // fieldsets
        var left, opacity, scale; // propriétés du fieldset qui seront animées
        var animating;

        $('.next').each((key, value) => 
        {
            $(value).click(() => 
            {
                current_fs = $(value).parent().parent(); // fieldset courant
                next_fs = $(value).parent().parent().next();
                //console.log(next_fs); prochain fieldset

                // Activez l'étape suivante sur la barre de progression à l'aide de l'index de next_fs
                $('#progressbar li').eq($('fieldset').index(next_fs)).addClass('active');

                // Afficher le fieldset suivant
                next_fs.fadeIn();

                // Masquer le fieldset actuel
                current_fs.fadeOut();

            });
        });

        $('.previous').each((key, value) => 
        {
            $(value).click(() => 
            {
                current_fs = $(value).parent().parent();
                previous_fs = $(value).parent().parent().prev();
                //console.log(previous_fs);

                // Désactiver l'étape en cours sur la barre de progression
                $('#progressbar li').eq($('fieldset').index(current_fs)).removeClass('active');

                // Afficher le fieldset précédent
                previous_fs.fadeIn();

                // Masquer le fieldset actuel
                current_fs.fadeOut();

            });
        });

    }
    progressBarCandidature();

    function userProfile() 
    {
        $('.uibChild:not(#infos_perso)').hide();
        
        $('.menuUserInfos a').each((key, element) => 
        {
            $(element).click((e) => 
            {
                e.preventDefault();
                $('.menuUserInfos a').not(this).removeClass('menuUserInfosActive');
                $(element).addClass('menuUserInfosActive');

                let link = $(element).attr('href');
                console.log(link);
                $('.uibChild:not('+ link +')').fadeOut();
                $(link).fadeIn();
                
            });
        });
    }
    //userProfile();

    function dashboard() 
    {
        if($(window).width() > 992) 
        {
            $('.searchDash__js').click(() => 
            {
                $('.dashboard__modal').css({
                    opacity         : 1,
                    pointerEvents   : 'all',
                });
    
                $('.modal__left').css({
                    transform: 'translateX(0)',
                });
            });
            
            $('.modal__right').click(() => 
            {
                $('.dashboard__modal').css({
                    opacity: 0,
                    pointerEvents: 'none',
                });
                $('.modal__left').css({
                    transform: 'translateX(-400px)',
                });
            });
    
            $('.userDash__js').mouseenter(() => 
            {
                $('.dash__user__profile').css({
                    opacity: 1,
                    pointerEvents: 'all',
                    transform: 'translateY(0)',
                });
            });
            $('.userDash__js').mouseleave(() => 
            {
                $('.dash__user__profile').css({
                    opacity: 0,
                    pointerEvents: 'none',
                    transform: 'translateY(-20px)',
                });
            });
        }

    }
    dashboard();



    /*window.addEventListener('scroll', function() {
        let scrolled = this.scrollY;
        console.log(scrolled);
        
    });*/

}); // Chargement du DOM