$(document).ready(function () {

    var delete_href;
    var delete_href_splitted;
    var delete_id;
    var image_src;
    var image_src_splitted;
    var image_name;

    $(".modal_thumbnails").click(function () {

        $("#set_user_image").prop('disabled', false);
        $(this).addClass('selected');

        //prop gets everything from that attribute
        //getting id from edit_user.php using delete button id
        delete_href = $("#delete_id").prop('href');
        //alert(delete_href);
        delete_href_splitted = delete_href.split('=');
        //alert(delete_href_splitted);
        //splitting with = sign bcz there is only one = in delete_href
        delete_id = delete_href_splitted[delete_href_splitted.length -1];
        //length -1 gives value of id in href
        //alert(delete_id);

        image_src = $(this).prop("src");
        //alert(image_src);
        image_src_splitted = image_src.split("/");
        //alert(image_src_splitted);
        image_name = image_src_splitted[image_src_splitted.length -1];
        //alert(image_name);
    });

    $("#set_user_image").click(function () {

        $.ajax({

            url: "includes/ajax_code.php",
            data: {image_name: image_name, delete_id: delete_id},
            type: "POST",
            success: function (data) {

                if (!data.error){

                    // alert(data);
                    //location.reload(true);
                    $(".user_image_box a img").prop('src', data);
                    //replace the image with image that is coming from server
                }
            }
        });
    });

    tinymce.init({ selector:'textarea' });
});
