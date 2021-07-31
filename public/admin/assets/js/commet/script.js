(function($){
    $(document).ready(function(){
        // CK Editor

        CKEDITOR.replace('post_editor1');
        CKEDITOR.replace('post_editor2');

        // Data Table Add

        $('table.data_table').DataTable();

        // Logout manage

        $(document).on('click','a#logout_button', function(e){
            e.preventDefault();

            $('form#logout_form').submit();
        });

        // Category Edit

        $(document).on('click', 'a#category_edit_id', function(e){
            e.preventDefault();

            let id = $(this).attr('edit_id');

            $.ajax({
                url     : 'post-category-edit/' + id,
                dataType: 'json',
                success : function(data){
                    $('div#category_modal_update form input[name="name"]').val(data.name);
                    $('div#category_modal_update form input[name="id"]').val(data.id);
                }
            });
        });

        // Tag Edit

        $(document).on('click', 'a#tag_edit_id', function(e){
            e.preventDefault();

            let id = $(this).attr('edit_id');

            $.ajax({
                url: 'post-tag-edit/' + id,
                success: function(data){
                    $('div#tag_modal_update form input[name="name"]').val(data.name);
                    $('div#tag_modal_update form input[name="id"]').val(data.id);
                }
            });
        });

        // Post Edit

        $(document).on('click', 'a#post_edit_id', function(event){
            event.preventDefault();
            let id = $(this).attr('edit_id');
            $('div#post_modal_update').modal('show');
            $.ajax({
                url: 'post-edit/' + id,
                dataType: 'json',
                success: function(data){
                    $('#post_modal_update input[name="title"]').val(data.title);
                    $('#post_modal_update img#post_featured_image_load').attr('src', 'media/posts/' + data.image);
                    $('#post_modal_update div.post_cat_list').html(data.cat_list);
                    $('#post_modal_update textarea[name="content"]').text(data.content);
                    $('#post_modal_update input[name="id"]').val(data.id);
                    $('div#post_modal_update').modal('show');
                }
            });
        });

        // Post image load

        $(document).on('change', 'input#post_fimage', function(event){
            event.preventDefault();
            let post_image_url = URL.createObjectURL(event.target.files[0]);
            $('img#post_featured_image_load').attr('src', post_image_url);
        });

        $(document).on('change', 'input#post_fimage_update', function(event){
            event.preventDefault();
            let post_image_url = URL.createObjectURL(event.target.files[0]);
            $('img#post_featured_image_load_update').attr('src', post_image_url);
        });
        // logo load
        $(document).on('change', 'input#logo-lite', function(event){
            event.preventDefault();
            let post_image_url = URL.createObjectURL(event.target.files[0]);
            $('img#logo-dark-load').attr('src', post_image_url);
            $('img#logo-dark-load').css({
                'width'        : '250px',
                'height'       : '82px',
                'display'      : 'block',
                'margin-bottom': '20px',
            });
        });

        // Commet Slider Scriptss

        $(document).on('click', 'button#commet-add-slide', function(e){
            e.preventDefault();
            let rand = Math.floor(Math.random() * 1000);
            $('.commet-slider-container').append('<div class="card" id="slider-card-'+rand+'">'+
            '<div style="cursor: pointer" data-toggle="collapse" data-target="#slider-'+rand+'" class="card-header"><h5>#Slider-'+rand+' <button id="commet-slide-remove-btn" remove-id="'+rand+'" class="close">&times;</button></h5></div>'+
            '<div class="collapse" id="slider-'+rand+'">'+
            '<div class="card-body">'+
            '<div class="form-group">'+
            '<label for="">Sub Title</label>'+
            '<input type="hidden" name="slide_code[]" value="'+rand+'" name="subtitle[]" type="text" class="form-control">'+
            '<input type="text" name="subtitle[]" type="text" class="form-control">'+
            '</div>'+
            '<div class="form-group">'+
            '<label for="">Title</label>'+
            '<input name="title[]" type="text" class="form-control">'+
            '</div>'+
            '<div class="form-group">'+
            '<label for="">Button 1 Title</label>'+
            '<input name="btn1_title[]" type="text" class="form-control">'+
            '</div>'+
            '<div class="form-group">'+
            '<label for="">Button 1 Link</label>'+
            '<input name="btn1_link[]" type="text" class="form-control">'+
            '</div>'+
            '<div class="form-group">'+
            '<label for="">Button 2 Title</label>'+
            '<input name="btn2_title[]" type="text" class="form-control">'+
            '</div>'+
            '<div class="form-group">'+
            '<label for="">Button 2 LInk</label>'+
            '<input name="btn2_link[]" type="text" class="form-control">'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>');
        });
        // slider remove

        $(document).on('click', '#commet-slide-remove-btn', function(e){
            e.preventDefault();
            let remove_id = $(this).attr('remove-id');
            $('#slider-card-'+remove_id).remove()
        });

    });
})(jQuery)
