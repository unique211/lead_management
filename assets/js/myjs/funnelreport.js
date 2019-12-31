$(document).ready(function() {
    var table_name = "category_type";
    var validate = 0;



    getMasterSelect('user_creation', '#salesrepresentive');

    function getMasterSelect(table_name, selecter) {
        var userid = '';
        $.ajax({
            type: "POST",
            url: base_url + "Quotation_Estimate/getdropdown",
            data: {
                table_name: table_name,
            },
            dataType: "JSON",
            async: false,
            success: function(data) {
                console.log(data);
                html = '';
                var name = '';
                //					
                html += '<option selected disabled value="" >Select</option>';
                //						}
                for (var i = 0; i < data.length; i++) {
                    var id = '';

                    name = data[i].first_name + " " + data[i].last_name;
                    id = data[i].id;



                    if (i == 0) {
                        userid = id;
                    }


                    //alert(name);

                    if (usertype == "SalesRepresentative") {
                        // if (id == useruniqueid) {
                        //     html += '<option selected value="' + id + '" >' + name + '</option>';
                        // } else {
                        //     html += '<option value="' + id + '" >' + name + '</option>';
                        // }
                    } else {
                        if (i == 0) {
                            html += '<option selected value="' + id + '" >' + name + '</option>';
                            // // getfinicialamt(id);
                            userid = id;
                        } else {
                            html += '<option value="' + id + '" >' + name + '</option>'; //last changes here
                        }
                    }



                }
                $(selecter).html(html);

            }
        });

    }

    if (usertype == "SalesRepresentative" && userrole == "Sales") {




        $.ajax({
            type: 'POST',
            url: base_url + "Quotation_Estimate/get_salespername",
            async: false,
            data: {
                useruniqueid: useruniqueid,
            },
            dataType: 'json',
            success: function(data) {

                $('#salesrepresentive1').val(data[0].first_name + "" + data[0].last_name);
            }
        });

    }



});