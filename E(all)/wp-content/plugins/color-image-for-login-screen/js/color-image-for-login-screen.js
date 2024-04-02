jQuery(document).ready(function($){
    $('input[name="option"]').on('change', function(){
        var selected = $(this).val();
        $('#form-color-image').find(`div[id="${selected}-group"]`).children().prop('disabled', false);

        var deselected = $('input[name="option"]:not(:checked)').val();
        $('#form-color-image').find(`div[id="${deselected}-group"]`).children().prop('disabled', true);
    }); 

    $('#btn-upload').on('click', function(e){
        e.preventDefault();
        var image = wp.media({
            title: 'Upload Image for Login Screen',
            multiple: false,
            library: {
                type: 'image'
            }
        }).open()
        .on('select', function(e){
            var uploaded_image = image.state().get('selection').first();
            $('#image').val(uploaded_image.attributes.filename);
        });
    });
    $('#color').wpColorPicker();

});