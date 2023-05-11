$(document).ready(function(){

    const ROOT_URL = 'http://localhost/smartsalon/public';
    function empty_div(images){
        const {id, image} = images;
        let result = `
        <div class="col-lg-4 col-md-12 mb-4 mb-lg-0 p-0 gallery_image_container" style="overflow:hidden;">
            <img src="${image}" class="w-100 shadow-1-strong  mb-0" style="position:relative !important; overflow:hidden;" />
            <div class="gallery_image_overlay"><i class="mdi mdi-delete gallery-item-icon" data-id="${id}"></i></div>
        </div>`;
        $("#gallery_row").append(result);
    }

    function fetch_gallery_image(){
        $("#gallery_row").html("");
        $.ajax({
            url: ROOT_URL+"/gallery/all",
            type : "GET",
            success:function(data){
                if(data != 0){
                    let images = JSON.parse(data);
                    if(images.length > 0){
                        for(let i = 0; i < images.length; i++){
                            empty_div(images[i]);
                        }
                    }
                }
                else{
                    swal({
                        text: "Sorry, Something went wrong!",
                        icon: "error",
                        buttons: "Ok",
                    }) 
                }
                
            }   
        });
    }

    function delete_gallery_image(image_id){
        $.ajax({
            url: ROOT_URL+"/gallery/delete",
            type : "POST",
            data: {
                id:image_id,
            },
            success:function(data){
                if(data == 1){
                    swal({
                        text: "Image deleted successfully",
                        icon: "success",
                        buttons: "Ok",
                    }).then((value) => {
                        fetch_gallery_image();
                    });
                }
                else{
                    swal({
                        text: "Sorry, Something went wrong!",
                        icon: "error",
                        buttons: "Ok",
                    }) 
                }
                
            }   
        });
    };

    $(document).on('click', ".gallery-item-icon", function(){
        image_id  = $(this).data('id');
        delete_gallery_image(image_id);
    });
});