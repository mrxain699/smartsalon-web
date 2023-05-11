$(document).ready(function() {
    const ROOT_URL = 'http://localhost/smartsalon/public';
    let empty_row = `<tr><td>No added Service !</td></tr>`;
    function init(){
        $("#service_name").val("");
        $("#service_price").val("");
        $("#service_category").val("");
        $("#service_duration").val("");
    }
    function new_row(services, count){
        let row = '';
        const {id, name, price, category, duration} = services;
        row += `
        <tr>
            <td>${count}</td>
            <td>${name}</td>
            <td>${price}</td>
            <td>${duration}</td>
            <td>${category}</td>
            <td>
            <span  class="update_service" data-toggle="modal" data-target="#update_service_modal" data-id="${id}"><i class="mdi mdi-pencil-circle text-success" style="font-size:18px; cursor:pointer;"></i></span>
            <span  class="delete_service" data-id="${id}"><i class="mdi mdi-delete text-danger" style="font-size:18px; padding-top:2px; cursor:pointer;"></i></span>
            </td>
            </td>
        </tr>`;
        $("#service_table").append(row); 
    }

    function load_services(){
        $("#service_table").html("");
        $.ajax({
            url: ROOT_URL+"/service/all",
            type : "GET",
            success:function(data){
                if(data){
                    let services = JSON.parse(data);
                    if(services.length > 0){
                        for(let i = 0; i < services.length; i++){
                            new_row(services[i], i+1);
                        }
                    }
                    else{
                        $("#service_table").append(empty_row);
                    }
                }
                
            }   
        });
    }

 
    

    function add_service(service_name, service_price, service_category, service_duration, salon_id){
        clear_errors();
        $.ajax({
            url: ROOT_URL+"/service/add",
            type : "POST",
            data: {
                name:service_name,
                price:service_price,
                category:service_category,
                duration:service_duration,
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
                    let bs_modal = $('#add_service_modal');
                    bs_modal.modal('hide');
                    init();
                    swal({
                        text: "Service saved successfully",
                        icon: "success",
                        buttons: "Ok",
                    }).then((value) => {
                        if (value || value === null) {
                            load_services();
                        } 
                    });
                }

            }
                
        });
    }

    function get_service(service_id){
        $.ajax({
            url: ROOT_URL+"/service/get",
            type : "POST",
            data: {
                id:service_id,
            },
            success:function(data){
                if(data != 1){
                    let service = JSON.parse(data);
                    $("#service_id").val(service[0]['id']);  
                    $("#update_service_name").val(service[0]['name']);
                    $("#update_service_price").val(service[0]['price']);
                    $("#update_service_category").val(service[0]['category']);
                    $("#update_service_duration").val(service[0]['duration']);
                    $("#update_salon_id").val(service[0]['salon_id']);    

                }        
            }   
        });
    }

    function update_service(service_name, service_price, service_category, service_duration, salon_id, id){
        clear_errors();
        $.ajax({
            url: ROOT_URL+"/service/update",
            type : "POST",
            data: {
                id:id,
                name:service_name,
                price:service_price,
                category:service_category,
                duration:service_duration,
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
                    let bs_modal = $('#update_service_modal');
                    bs_modal.modal('hide');
                    init();
                    swal({
                        text: "Service update successfully",
                        icon: "success",
                        buttons: "Ok",
                    }).then((value) => {
                        if (value || value === null) {
                            load_services();
                        } 
                    });
                }

            }   
        });
    }


    function delete_service(service_id){
        $.ajax({
            url: ROOT_URL+"/service/delete",
            type : "POST",
            data: {
                id:service_id,
            },
            success:function(data){
                if(data == 1){
                    swal({
                        text: "Service deleted successfully",
                        icon: "success",
                        buttons: "Ok",
                    }).then((value) => {
                        if (value || value === null) {
                            load_services();
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
        $("#service_table").html("");
        data = {
            salon_id:salon_id,
            name:value,
        }
        $.ajax({
            url: ROOT_URL+"/service/search",
            type : "POST",
            data: data,
            success:function(data){
                if(data != 0){
                    let services = JSON.parse(data);
                    if(services.length > 0){
                        for(let i = 0; i < services.length; i++){
                            new_row(services[i], i+1);
                        }
                    }

                }
                else{
                    $("#service_table").append("<tr><td colspan='3'>No Service found!</td></tr>");
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
             
    
    $("#add_service_form").on('submit', function(e){
        e.preventDefault();
        let service_name = $("#service_name").val();
        let service_price = $("#service_price").val();
        let service_category = $("#service_category").val();
        let service_duration = $("#service_duration").val();
        let salon_id = $("#salon_id").val();
        add_service(service_name, service_price, service_category, service_duration, salon_id);
    });

    $(document).on("click", ".delete_service", function(e){
        let id = $(this).data('id');
        delete_service(id);
    });

    $(document).on("click", ".update_service", function(e){
        let id = $(this).data('id');
        get_service(id);
    });

    $("#update_service_form").on('submit', function(e){
        e.preventDefault();
        let service_name = $("#update_service_name").val();
        let service_price = $("#update_service_price").val();
        let service_category = $("#update_service_category").val();
        let service_duration = $("#update_service_duration").val();
        let id = $("#service_id").val();
        let salon_id = $("#update_salon_id").val();
        update_service(service_name, service_price, service_category, service_duration, salon_id, id);
    });

    $("#search").on("keyup", function (e) {
        let value = $(this).val();
        let salon_id = $("#salon_id").val();
        if(value !== ""){
            search(value, salon_id);
        }
        else{
            load_services();
        }
    });




});