$(document).ready(function () {
    const ROOT_URL = "http://localhost/smartsalon/admin/public/";
    let empty_row = '<tr><td colspan="7" class="text-center">No record found!</td></tr>';
    const u_id = user_id;
    var u_role = ''
    function user_table(user, index) {
        const { id, firstname, lastname, email, phone, rank, status } = user;
        let status_class = status == "active" ? 'success' : 'danger';
        let icon = status == "block" ? "mdi-account" : "mdi-account-off";
        let url = status == "block" ? ROOT_URL + "user/unblock/" + id : ROOT_URL + "user/block/" + id;
        let row = '<tr>';
        row += '<td>' + `${index}` + '</td>';
        row += '<td>' + firstname.charAt(0).toUpperCase() + firstname.slice(1) + ' ' + lastname.charAt(0).toUpperCase() + lastname.slice(1) + '</td>';
        row += '<td>' + email + '</td>';
        row += '<td>' + phone + '</td>';
        row += '<td>' + rank.charAt(0).toUpperCase() + rank.slice(1) + '</td>';
        row += '<td>';
        row += '<label class="badge badge-' + status_class + '">' + status.charAt(0).toUpperCase() + status.slice(1) + '</label>';
        row += '</td>';
        if(u_role == "admin"){
            row += '<td>';
            row += '<a href="' + url + '" title="Block User"><i class="mdi ' + icon + ' text-warning" style="font-size:18px;"></i></a>';
            row += '<a href="' + ROOT_URL + '/user/update/' + id + '" title="Update User"><i class="mdi mdi-pencil-circle text-success" style="font-size:18px;"></i></a>';
            row += '<a href="' + ROOT_URL + '/user/delete/' + id + '" title="Delete User"><i class="mdi mdi-delete text-danger" style="font-size:18px; padding-top:2px;"></i></a>';
            row += '</td>';
        }
        row += '</tr>';
        $("#user_table").append(row);

    }

    function getUserRank(u_id, controller, method){
        $.ajax({
            url: ROOT_URL + "/" + controller + "/" + method +"/"+ u_id,
            type: "GET",
            success: function (data) {
                if (data != 0) {
                    let json_data = JSON.parse(data);
                    u_role = json_data.rank;
                }
                else {
                    console.log(data);
                }
            }

        });
    }

    getUserRank(u_id, "user", "get_rank");

    


    function get_filtered_data(value, controller, method) {
        $.ajax({
            url: ROOT_URL + "/" + controller + "/" + method,
            type: "POST",
            data: { value: value },
            success: function (data) {
                if (data != 0) {
                    let json_data = JSON.parse(data);
                    if (json_data.length > 0) {
                        $("#user_table").html("");
                        let count = 0;
                        for (let i = 0; i < json_data.length; i++) {
                          if(u_id != Number(json_data[i].id)){
                            user_table(json_data[i], count+=1);
                          }
                          
                        }
                    }
                }
                else {
                    $("#user_table").html("");
                    $("#user_table").append(empty_row);
                }
            }

        });

    }


    $('#filter').on('change', function () {
        let value = $(this).val();
        let method = "filter";
        if (value !== "") {
            get_filtered_data(value, "user", method);
        }
    });


    $('#search').on('keyup', function () {
        let value = $(this).val();
        let method = "search";
        if (value !== "") {
            get_filtered_data(value, "user", method);
        }
        else {
            get_filtered_data("all", "user", "filter");
        }

    });




});