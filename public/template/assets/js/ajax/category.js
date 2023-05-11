$(document).ready(function() {
    const ROOT_URL = 'http://localhost/smartsalon/public';
    let empty_row = `<tr><td>No Category added!</td></tr>`;

    function new_row(categories, count){
        let row = '';
        const {id, category} = categories;
        row += `
        <tr>
            <td>${count}</td>
            <td>${category}</td>
            <td>
            <span  class="update_category" data-toggle="modal" data-target="#update_category_modal" data-id="${id}"><i class="mdi mdi-pencil-circle text-success" style="font-size:18px; cursor:pointer;"></i></span>
            <span  class="delete_category" data-id="${id}"><i class="mdi mdi-delete text-danger" style="font-size:18px; padding-top:2px; cursor:pointer;"></i></span>
            </td>
            </td>
        </tr>`;
        $("#category_table").append(row); 
    }

    function load_categories(){
        $("#category_table").html("");
        $.ajax({
            url: ROOT_URL+"/category/all",
            type : "GET",
            success:function(data){
                if(data){
                    let categories = JSON.parse(data);
                    if(categories.length > 0){
                        for(let i = 0; i < categories.length; i++){
                            new_row(categories[i], i+1);
                        }
                    }
                    else{
                        $("#category_table").append(empty_row);
                    }
                }
                
            }   
        });
    }

   
    

    function add_category(category_name,  salon_id){
        clear_errors();
        $.ajax({
            url: ROOT_URL+"/category/add",
            type : "POST",
            data: {
                category:category_name,
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
                    let bs_modal = $('#add_category_modal');
                    $("#category").val("");
                    bs_modal.modal('hide');
                    swal({
                        text: "Category saved successfully",
                        icon: "success",
                        buttons: "Ok",
                    }).then((value) => {
                        if (value || value === null) {
                            load_categories();
                        } 
                    });
                }

            }   
        });
    }

    function get_category(category_id){
        $.ajax({
            url: ROOT_URL+"/category/get",
            type : "POST",
            data: {
                id:category_id,
            },
            success:function(data){
                if(data != 1){
                    let category = JSON.parse(data);
                    $("#category_id").val(category[0]['id']);  
                    $("#update_category").val(category[0]['category']);
                    $("#update_salon_id").val(category[0]['salon_id']);  

                }        
            }   
        });
    }

    function update_category(category_name,  category_id, salon_id){
        clear_errors();
        $.ajax({
            url: ROOT_URL+"/category/update",
            type : "POST",
            data: {
                id:category_id,
                category:category_name,
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
                    let bs_modal = $('#update_category_modal');
                    $("#update_category").val("");
                    bs_modal.modal('hide');
                    swal({
                        text: "Category update successfully",
                        icon: "success",
                        buttons: "Ok",
                    }).then((value) => {
                        if (value || value === null) {
                            load_categories();
                        } 
                    });
                }

            }   
        });
    }

    function delete_category(category_id){
        $.ajax({
            url: ROOT_URL+"/category/delete",
            type : "POST",
            data: {
                id:category_id,
            },
            success:function(data){
                if(data == 1){
                    swal({
                        text: "Category deleted successfully",
                        icon: "success",
                        buttons: "Ok",
                    }).then((value) => {
                        if (value || value === null) {
                            load_categories();
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
        $("#category_table").html("");
        data = {
            salon_id:salon_id,
            category:value,
        }
        $.ajax({
            url: ROOT_URL+"/category/search",
            type : "POST",
            data: data,
            success:function(data){
                if(data != 0){
                    let categories = JSON.parse(data);
                    if(categories.length > 0){
                        for(let i = 0; i < categories.length; i++){
                            new_row(categories[i], i+1);
                        }
                    }

                }
                else{
                    $("#category_table").append("<tr><td colspan='3'>No Category found!</td></tr>");
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
             
    
    $("#add_category_form").on('submit', function(e){
        e.preventDefault();
        let category = $("#category").val();
        let salon_id = $("#salon_id").val();
        add_category(category,  salon_id)
    });

    $(document).on("click", ".delete_category", function(e){
        let id = $(this).data('id');
        delete_category(id);
    });

    $(document).on("click", ".update_category", function(e){
        let id = $(this).data('id');
        get_category(id);
    });

    $("#update_category_form").on('submit', function(e){
        e.preventDefault();
        let category = $("#update_category").val();
        let id = $("#category_id").val();
        let salon_id = $("#update_salon_id").val();
        update_category(category,  id, salon_id);
    });

    $("#search").on("keyup", function (e) {
        let value = $(this).val();
        let salon_id = $("#salon_id").val();
        if(value !== ""){
            search(value, salon_id);
        }
        else{
            load_categories();
        }
    });




});