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





}); // Chargement du DOM