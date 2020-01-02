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
                getcustomerdata(userid);
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
        getcustomerdata(useruniqueid);

    }
    $(document).on('change', '#salesrepresentive', function() {

        var userid = $(this).val();
        getcustomerdata(userid);
    });

    function getcustomerdata(uid) {
        var today = new Date();
        var fyear = today.getFullYear().toString();
        if ((today.getMonth() + 1) <= 3) {



            fiscalyear = (parseInt(fyear) - parseInt(1)) + "-" + fyear;

        } else {
            fiscalyear = parseInt(fyear) + "-" + (parseInt(fyear) + parseInt(1));
            //fiscalyear=  fiscalyear.toString().substr(-2);
        }

        fiscalyear = fiscalyear.split('-');
        var statdate = fiscalyear[0] + "-" + "04" + "-" + "01";

        $.ajax({
            type: 'POST',
            url: base_url + "Wonreport/getinvoicewone",
            async: false,
            data: {
                uid: uid,
                statdate: statdate,
            },
            dataType: 'json',
            success: function(data) {
                var summargin = 0;
                var sumtop = 0;
                var html = '';
                $("#wonrep_tbody").html('');
                var sr = 0;
                for (i = 0; i < data.length; i++) {
                    sr = sr + 1;

                    summargin = (parseFloat(summargin) + parseFloat(data[i].magin)).toFixed(2);
                    sumtop = (parseFloat(sumtop) + parseFloat(data[i].totalordvalue)).toFixed(2);
                    html = '<tr>' +
                        '<td  style="white-space:nowrap;text-align:left;padding:10px 10px;"></td>' +
                        '<td  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].customer_name + '</td>' +
                        '<td  style="white-space:nowrap;text-align:left;padding:10px 10px;"></td>' +
                        '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].product + '</td>' +
                        '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].orderdate + '</td>' +
                        '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + parseFloat(data[i].totalordvalue).toFixed(2) + '</td>' +
                        '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].magin + '</td>' +
                        '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].poorder_date + '</td>' +
                        '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].status + '</td>' +
                        '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].description + '</td>' +
                        '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].order_no + '</td>' +
                        '</tr>';

                    $("#wonrep_tbody").append(html);
                }
                $('#totaltop').html(sumtop);
                $('#totalmargin').html(summargin);




            }


        });
    }



});