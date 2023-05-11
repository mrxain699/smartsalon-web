$(document).ready(function() {
    const ROOT_URL = 'http://localhost/smartsalon/public';
    const DEFAULT_IMAGE_ROOT = 'http://localhost/smartsalon/public/template/assets/images/faces';
    let empty_row = `<tr><td>No added Workers !</td></tr>`;

    function init(){
        $("#firstname").val("");
        $("#lastname").val("");
        $("#phone").val("");
        $("#file-upload-info").val("");
        $("#old_image").val("");
        $("#new_image").val("");
    }

    function new_row(workers, count){
        let row = '';
        const {id, firstname, lastname, image, phone} = workers;
       if(image === ""){
            image_path = DEFAULT_IMAGE_ROOT+"/default.png";
        }
        else{
            image_path = ROOT_URL+"/"+image;
        } 
        row += `
        <tr>
            <td>${count}</td>
            <td><img class="worker_image" src="${image_path}">${firstname.charAt(0).toUpperCase()+firstname.slice(1)+' '+lastname.charAt(0).toUpperCase()+lastname.slice(1)}</td>;
            <td>${phone}</td>
            <td>
            <span  class="update_worker" data-toggle="modal" data-target="#update_worker_modal" data-id="${id}"><i class="mdi mdi-pencil-circle text-success" style="font-size:18px; cursor:pointer;"></i></span>
            <span  class="delete_worker" data-id="${id}"><i class="mdi mdi-delete text-danger" style="font-size:18px; padding-top:2px; cursor:pointer;"></i></span>
            </td>
            </td>
        </tr>`;
        $("#worker_table").append(row); 
    }

    function load_workers(){
        $("#worker_table").html("");
        $.ajax({
            url: ROOT_URL+"/worker/all",
            type : "GET",
            success:function(data){
                if(data){
                    let workers = JSON.parse(data);
                    if(workers.length > 0){
                        for(let i = 0; i < workers.length; i++){
                            new_row(workers[i], i+1);
                        }
                    }
                    else{
                        $("#worker_table").append(empty_row);
                    }
                }
                
            }   
        });
    }


    

    function add_worker(firstname, lastname, phone, file, temp, salon_id){
        clear_errors();
        $.ajax({
            url: ROOT_URL+"/worker/add",
            type : "POST",
            data: {
                firstname:firstname,
                lastname:lastname,
                phone:phone,
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
                    let bs_modal = $('#add_worker_modal');
                    bs_modal.modal('hide');
                    init();
                    swal({
                        text: "Worker saved successfully",
                        icon: "success",
                        buttons: "Ok",
                    }).then((value) => {
                        if (value || value === null) {
                            load_workers();
                        } 
                    });
                }

            }
                
        });
    }

    function get_worker(worker_id){
        $.ajax({
            url: ROOT_URL+"/worker/getWorker",
            type : "POST",
            data: {
                id:worker_id,
            },
            success:function(data){
                if(data != 1){
                    let worker = JSON.parse(data);
                    $("#worker_id").val(worker[0]['id']);  
                    $("#update_firstname").val(worker[0]['firstname']);
                    $("#update_lastname").val(worker[0]['lastname']);
                    $("#update_phone").val(worker[0]['phone']);
                    $("#update_salon_id").val(worker[0]['salon_id']); 
                    $("#update_file-upload-info").val(worker[0]['image']);
                    $("#update_new_image").val(worker[0]['image']);
                    


                }        
            }   
        });
    }

    function update_worker(firstname, lastname, phone, file, temp, salon_id, id){
        clear_errors();
        $.ajax({
            url: ROOT_URL+"/worker/update",
            type : "POST",
            data: {
                id:id,
                firstname:firstname,
                lastname:lastname,
                phone:phone,
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
                    let bs_modal = $('#update_worker_modal');
                    bs_modal.modal('hide');
                    init();
                    swal({
                        text: "Worker update successfully",
                        icon: "success",
                        buttons: "Ok",
                    }).then((value) => {
                        if (value || value === null) {
                            load_workers();
                        } 
                    });
                }

            }   
        });
    }


    function delete_worker(worker_id){
        $.ajax({
            url: ROOT_URL+"/worker/delete",
            type : "POST",
            data: {
                id:worker_id,
            },
            success:function(data){
                if(data == 1){
                    swal({
                        text: "Worker deleted successfully",
                        icon: "success",
                        buttons: "Ok",
                    }).then((value) => {
                        if (value || value === null) {
                            load_workers();
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
        $("#worker_table").html("");
        data = {
            salon_id:salon_id,
            firstname:value,
        }
        $.ajax({
            url: ROOT_URL+"/worker/search",
            type : "POST",
            data: data,
            success:function(data){
                console.log(data);
                if(data != 0){
                    let workers = JSON.parse(data);
                    if(workers.length > 0){
                        for(let i = 0; i < workers.length; i++){
                            new_row(workers[i], i+1);
                        }
                    }

                }
                else{
                    $("#worker_table").append("<tr><td colspan='3'>No Worker found!</td></tr>");
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
             
    
    $("#add_worker_form").on('submit', function(e){
        e.preventDefault();
        let firstname = $("#firstname").val();
        let lastname = $("#lastname").val();
        let phone = $("#phone").val();
        let file = $("#new_image").val();
        let temp = $("#old_image").val();
        let salon_id = $("#salon_id").val();
        add_worker(firstname, lastname, phone, file, temp, salon_id);
    });

    $(document).on("click", ".delete_worker", function(e){
        let id = $(this).data('id');
        delete_worker(id);
    });

    $(document).on("click", ".update_worker", function(e){
        let id = $(this).data('id');
        get_worker(id);
    });

    $("#update_worker_form").on('submit', function(e){
        e.preventDefault();
        let id = $("#worker_id").val();
        let firstname = $("#update_firstname").val();
        let lastname = $("#update_lastname").val();
        let phone = $("#update_phone").val();
        let file = $("#update_new_image").val();
        let temp = $("#update_old_image").val();
        let salon_id = $("#update_salon_id").val();
        update_worker(firstname, lastname, phone, file, temp,  salon_id, id);
    });

    $("#search").on("keyup", function (e) {
        let value = $(this).val();
        let salon_id = $("#salon_id").val();
        if(value !== ""){
            search(value, salon_id);
        }
        else{
            load_workers();
        }
    });




});