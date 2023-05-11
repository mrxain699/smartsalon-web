$(document).ready(function () {
    const ROOT_URL = "http://localhost/smartsalon/admin/public/";
    const DEFAULT_URL = "http://localhost/smartsalon/public/";
    let empty_row = '<tr><td colspan="9" class="text-center">No record found!</td></tr>';


    function salon_table(salon, index) {
        const { name, barber_name, email, phone, address, city, certificate, barber_image, verified, cancelled } = salon;
        let img = barber_image != null && barber_image != "" ? DEFAULT_URL+barber_image : ROOT_URL+"assets/images/faces/default.png";
        let status_class = '';
        let status = '';
        if(verified == 1){
            status_class = "success";
            status = "Verified";
        }
        else if (cancelled == 1){
            status_class = "danger";
            status = "Cancelled";
        }
        else{
            status_class = "warning";
            status = "Pending";
        }
        let row = '<tr>';
        row += '<td>' + `${index}` + '</td>';
        row += '<td><img src="'+img+'" id="img"/>' + barber_name.charAt(0).toUpperCase() + barber_name.slice(1) + '</td>';
        row += '<td>' + name.charAt(0).toUpperCase() + name.slice(1) + '</td>';
        row += '<td>' + email + '</td>';
        row += '<td>' + phone + '</td>';
        row += '<td>' + address + '</td>';
        row += '<td>' + city.charAt(0).toUpperCase() + city.slice(1) + '</td>';
        row += '<td><a href="'+ROOT_URL+'/salon/view_certificate/'+certificate+'" target="_blank">';
        row+= certificate != null && certificate != "" ? certificate : "No certificate provided";+'</a>';
        row+='</td>';
        row += '<td>';
        row += '<label class="badge badge-' + status_class + '">' + status.charAt(0).toUpperCase() + status.slice(1) + '</label>';
        row += '</td>';
        row += '</tr>';
        $("#salon_table").append(row);

    }



    function get_filtered_data(value, controller, method) {
        $.ajax({
            url: ROOT_URL + "/" + controller + "/" + method,
            type: "POST",
            data: { value: value },
            success: function (data) {
                if (data != 0) {
                    let json_data = JSON.parse(data);
                    if (json_data.length > 0) {
                        $("#salon_table").html("");
                        let count = 0;
                        for (let i = 0; i < json_data.length; i++) {
                            console.log(json_data[i])
                            salon_table(json_data[i], count+=1);
                        }
                    }
                }
                else {
                    $("#salon_table").html("");
                    $("#salon_table").append(empty_row);
                }
            }

        });

    }


    $('#filter').on('change', function () {
        let value = $(this).val();
        let method = "filter";
        if (value !== "") {
            console.log(value);
            get_filtered_data(value, "salon", method);
        }
    });


   




});