jQuery(document).ready(function($) {    
    $('.menu-item-depth-1 .edit-menu-item-classes').attr( 'list','mos-menu-classes');
    $('#menu-to-edit').after('<datalist id="mos-menu-classes"><option value="open-right"><option value="open-left"></datalist>');
    $('.menu-item-depth-1 .edit-menu-item-classes').after("Choose a class from dropdown list or use your custom class.");
    $("button.open-window").live("click", function(e){
        e.preventDefault();
        var imageUploader = wp.media({
            'title'     : 'Upload Map Image',
            'button'    : {
                'text'  : 'Set the image'
            },
            'multiple'  : false
        });
        imageUploader.open();
        var button = $(this);
        imageUploader.on("select", function(){
            var image = imageUploader.state().get("selection").first().toJSON();
            var image_link = image.url;
            $("input.map_img_url").val(image_link);
            button.next('input.map_img_url').val(image_link);
            button.parent().siblings('div.map-img-wrapper').find('img').attr('src', image_link);
        })
    });
    $("button.remove-img").live("click", function(d){
        d.preventDefault();
        $(this).siblings('input.map_img_url').val('http://theme.belocal.today/images/google-maps-logo-480.jpg');
        $(this).parent().siblings('div.map-img-wrapper').find('img').attr('src', 'http://theme.belocal.today/images/google-maps-logo-480.jpg');
    })

    $("span.photo_upload_button").live("click", function(add){
        add.preventDefault();
        var imageUploader = wp.media({
            // 'title'     : 'Upload Image',
            // 'button'    : {
            //     'text'  : 'Set the image'
            // },
            'multiple'  : false
        });
        imageUploader.open();
        var button = $(this);
        imageUploader.on("select", function(){
            var image = imageUploader.state().get("selection").first().toJSON();
            var image_link = image.url;
            var thum_link = image.url;
            if (image.height > 150 || image.width > 150) { thum_link = image.sizes.thumbnail.url; }
            //console.log(image);
            //button.siblings('input.photo_url').val(image_link);
            //button..before('<div class="screenshot-photo"><a class="of-uploaded-photo" href="'+ image_link +'" target="_blank"><img class="redux-option-photo" src="'+ thum_link +'"></a></div>');;

            button.closest('.photo-container').siblings('.redux-slides-list').find('.photo').val(image_link);
            button.closest('.photo-container').siblings('.redux-slides-list').find('.photo-id').val(image.id);
            button.closest('.photo-container').siblings('.redux-slides-list').find('.photo-height').val(image.height);
            button.closest('.photo-container').siblings('.redux-slides-list').find('.photo-width').val(image.width);
            button.closest('.photo-container').siblings('.redux-slides-list').find('.photo-thumbnail').val(thum_link);
            button.siblings('div.screenshot-photo').removeClass('hide');
            button.siblings('span.remove-photo').removeClass('hide');
            button.siblings('div.screenshot-photo').find('.of-uploaded-photo').attr("href",image_link);
            button.siblings('div.screenshot-photo').find('img').attr('src', thum_link);
        })
    });
    $("span.remove-photo").live("click", function(del){
    	del.preventDefault();
        $(this).addClass('hide');

        $(this).closest('.photo-container').siblings('.redux-slides-list').find('.photo').val('');
        $(this).closest('.photo-container').siblings('.redux-slides-list').find('.photo-id').val('');
        $(this).closest('.photo-container').siblings('.redux-slides-list').find('.photo-height').val('');
        $(this).closest('.photo-container').siblings('.redux-slides-list').find('.photo-width').val('');
        $(this).closest('.photo-container').siblings('.redux-slides-list').find('.photo-thumbnail').val('');

        $(this).siblings('div.screenshot-photo').addClass('hide');
        $(this).siblings('div.screenshot-photo').find('.of-uploaded-photo').attr("href",'');
        $(this).siblings('div.screenshot-photo').find('img').attr('src', '');

    })

    
    var page_template = $('#page_template').val();
    show_meta_boxes (page_template);

    $('#page_template').change(function(){
        var page_template = $(this).val();
        show_meta_boxes(page_template);
    });

    function show_meta_boxes(page_template) {
        if(page_template == 'page-template/lightbox-gallery-page.php') {
            $('#_mosrokomari_gallery_details').show();
        } else {
           $('#_mosrokomari_gallery_details').hide();
        }
        if(page_template == 'page-template/lightbox-multy-gallery-page.php') {
            $('#_mosrokomari_multy_gallery_details').show();
        } else {
           $('#_mosrokomari_multy_gallery_details').hide(); 
        }
        if(page_template == 'page-template/offer-page.php') {
            $('#_mosrokomari_offer_details').show();
        } else {
           $('#_mosrokomari_offer_details').hide();
        }
        if(page_template == 'page-template/link-gallery-page.php') {
            $('#_mosrokomari_link_gallery_details').show();
        } else {
           $('#_mosrokomari_link_gallery_details').hide();
        }
        if(page_template == 'page-template/group-tab-page.php') {
            $('#_mosrokomari_tab_group_details').show();
        } else {
           $('#_mosrokomari_tab_group_details').hide(); 
        }
        if(page_template == 'page-template/home-page.php') {
            $('#_mosrokomari_page_settings').hide();
        } else {
           $('#_mosrokomari_page_settings').show();
        }
    }
}); 
