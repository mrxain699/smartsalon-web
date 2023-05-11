$(document).ready(function () {
    const ROOT_URL = "http://localhost/smartsalon/admin/public/";
    const DEFAULT_URL = "http://localhost/smartsalon/public/";
    let empty_row = '<tr><td colspan="6" class="text-center">No record found!</td></tr>';

    function customer_table(customer, index) {
        const { name, email, phone, address, city, image } = customer;
        let img = image != null && image != "" ? DEFAULT_URL+image : ROOT_URL+"assets/images/faces/default.png";
        let row = '<tr>';
        row += '<td>' + index + '</td>';
        row += '<td><img src="'+img+'" id="img"/>' + name.charAt(0).toUpperCase() + name.slice(1) + '</td>';
        row += '<td>' + email + '</td>';
        row += '<td>' + phone + '</td>';
        row += '<td>' + address + '</td>';
        row += '<td>' + city.charAt(0).toUpperCase() + city.slice(1) + '</td>';
        row += '</tr>';
        $("#customer_table").append(row);

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
                        $("#customer_table").html("");
                        let count = 0;
                        for (let i = 0; i < json_data.length; i++) {
                            console.log(json_data[i])
                            customer_table(json_data[i], count+=1);
                        }
                    }
                }
                else {
                    $("#customer_table").html("");
                    $("#customer_table").append(empty_row);
                }
            }

        });

    }


    $('#search').on('keyup', function () {
        let value = $(this).val();
        let method = "search";
        if (value !== "") {
            get_filtered_data(value, "customer", method);
        }
        else {
            get_filtered_data("all", "customer", "filter");
        }

    });




});