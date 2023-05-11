$(document).ready(function() {
    const ROOT_URL = 'http://localhost/smartsalon/public';
    const DEFAULT_IMAGE_ROOT = 'http://localhost/smartsalon/public/template/assets/images/faces';
    let empty_row = `<tr><td>No added Products !</td></tr>`;

    function init(){
        $("#name").val("");
        $("#price").val("");
        $("#quantity").val("");
        $("#description").val("");
        $("#file-upload-info").val("");
        $("#old_image").val("");
        $("#new_image").val("");
    }

    function new_row(products, count){
        let row = '';
        const {id, name, p_desc, price, quantity, image, salon_id } = products;
       if(image === ""){
            image_path = DEFAULT_IMAGE_ROOT+"/default.png";
        }
        else{
            image_path = ROOT_URL+"/"+image;
        } 
        row += `
        <tr>
            <td>${count}</td>
            <td><img class="product_image" src="${image_path}"></td>
            <td>${name.charAt(0).toUpperCase()+name.slice(1)}</td>
            <td>${p_desc}</td>
            <td>${price}</td>
            <td>${quantity}</td>
            <td>
            <span  class="update_product" data-toggle="modal" data-target="#update_product_modal" data-id="${id}"><i class="mdi mdi-pencil-circle text-success" style="font-size:18px; cursor:pointer;"></i></span>
            <span  class="delete_product" data-id="${id}"><i class="mdi mdi-delete text-danger" style="font-size:18px; padding-top:2px; cursor:pointer;"></i></span>
            </td>
            </td>
        </tr>`;
        $("#product_table").append(row); 
    }

    function load_products(){
        $("#product_table").html("");
        $.ajax({
            url: ROOT_URL+"/product/get",
            type : "GET",
            success:function(data){
                if(data){
                    let products = JSON.parse(data);
                    if(products.length > 0){
                        for(let i = 0; i < products.length; i++){
                            new_row(products[i], i+1);
                        }
                    }
                    else{
                        $("#product_table").append(empty_row);
                    }
                }
                
            }   
        });
    }


    

    function add_product(name, desc, price, quantity,  file, temp, salon_id){
        clear_errors();
        $.ajax({
            url: ROOT_URL+"/product/add",
            type : "POST",
            data: {
                name:name,
                p_desc:desc,
                price:price,
                quantity:quantity,
                image: file,
                temp: temp,
                salon_id:salon_id
            },
            success:function(data){
                if(data != 1){
                    let errors = JSON.parse(data);
                    for(const error in errors){
                        $("#error_"+error).html(errors[error]);
                    }
                }
                else if(data == 1){
                    let bs_modal = $('#add_product_modal');
                    bs_modal.modal('hide');
                    init();
                    swal({
                        text: "Product saved successfully",
                        icon: "success",
                        buttons: "Ok",
                    }).then((value) => {
                        if (value || value === null) {
                            load_products();
                        } 
                    });
                }

            }
                
        });
    }

    function get_product(product_id){
        $.ajax({
            url: ROOT_URL+"/product/getById/"+product_id,
            type : "GET",
            success:function(data){
                if(data != 0){
                    let product = JSON.parse(data);
                    $("#product_id").val(product[0]['id']);  
                    $("#update_name").val(product[0]['name']);
                    $("#update_description").val(product[0]['p_desc']);
                    $("#update_price").val(product[0]['price']);
                    $("#update_quantity").val(product[0]['quantity']);
                    $("#update_salon_id").val(product[0]['salon_id']); 
                    $("#update_file-upload-info").val(product[0]['image']);
                    $("#update_new_image").val(product[0]['image']);
                }        
            }   
        });
    }

    function update_product(name, desc, price, quantity,  file, temp, salon_id,id){
        clear_errors();
        $.ajax({
            url: ROOT_URL+"/product/update",
            type : "POST",
            data: {
                id:id,
                name:name,
                p_desc:desc,
                price:price,
                quantity:quantity,
                image:file,
                temp:temp,
                salon_id:salon_id
            },
            success:function(data){
                if(data != 1){
                    let errors = JSON.parse(data);
                    for(const error in errors){
                        $("#update_error_"+error).html(errors[error]);
                    }
                }
                else if(data == 1){
                    let bs_modal = $('#update_product_modal');
                    bs_modal.modal('hide');
                    init();
                    swal({
                        text: "product update successfully",
                        icon: "success",
                        buttons: "Ok",
                    }).then((value) => {
                        if (value || value === null) {
                            load_products();
                        } 
                    });
                }

            }   
        });
    }


    function delete_product(product_id){
        console.log(product_id);
        $.ajax({
            url: ROOT_URL+"/product/delete",
            type : "POST",
            data: {
                id:product_id,
            },
            success:function(data){
                if(data == 1){
                    swal({
                        text: "product deleted successfully",
                        icon: "success",
                        buttons: "Ok",
                    }).then((value) => {
                        if (value || value === null) {
                            load_products();
                        } 
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
    }

    function search(value, salon_id){
        $("#product_table").html("");
        data = {
            salon_id:salon_id,
            name:value,
        }
        $.ajax({
            url: ROOT_URL+"/product/search",
            type : "POST",
            data: data,
            success:function(data){
                console.log(data);
                if(data != 0){
                    let products = JSON.parse(data);
                    if(products.length > 0){
                        for(let i = 0; i < products.length; i++){
                            new_row(products[i], i+1);
                        }
                    }

                }
                else{
                    $("#product_table").append("<tr><td colspan='3'>No product found!</td></tr>");
                }         
            }   
        });
    }

    function clear_errors(){
        let errors = $(".error");
        let err_length = errors.length;
        for(let i = 0; i < err_length; i++) {
            if($(errors[i]).html() !== ""){
                $(errors[i]).html("");
            }
        }
    }
             
    
    $("#add_product_form").on('submit', function(e){
        e.preventDefault();
        let name = $("#name").val();
        let desc = $("#description").val();
        let price = $("#price").val();
        let quantity = $("#quantity").val();
        let file = $("#new_image").val();
        let temp = $("#old_image").val();
        let salon_id = $("#salon_id").val();
        add_product(name, desc, price, quantity,  file, temp, salon_id);
    });

    $(document).on("click", ".delete_product", function(e){
        let id = $(this).data('id');
        delete_product(id);
    });

    $(document).on("click", ".update_product", function(e){
        let id = $(this).data('id');
        get_product(id);
    });

    $("#update_product_form").on('submit', function(e){
        e.preventDefault();
        let id = $("#product_id").val();
        let name = $("#update_name").val();
        let desc = $("#update_description").val();
        let price = $("#update_price").val();
        let quantity = $("#update_quantity").val();
        let file = $("#update_new_image").val();
        let temp = $("#update_old_image").val();
        let salon_id = $("#update_salon_id").val();
        update_product(name, desc, price, quantity,  file, temp, salon_id,id);
    });

    $("#search").on("keyup", function (e) {
        let value = $(this).val();
        let salon_id = $("#salon_id").val();
        if(value !== ""){
            search(value, salon_id);
        }
        else{
            load_products();
        }
    });




});