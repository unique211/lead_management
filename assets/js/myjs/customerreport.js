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

        $('#btnExport').val(uid);
        $.ajax({
            type: 'POST',
            url: base_url + "Customerreport/getcustomerreportdasta",
            async: false,
            data: {
                uid: uid,
            },
            dataType: 'json',
            success: function(data) {
                // alert(data);
                var html = '';
                $("#customer_tbody").html('');
                var sr = 0;
                for (i = 0; i < data.length; i++) {
                    sr = sr + 1;
                    flag = 0;
                    html = '<tr>' +
                        '<td  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + sr + '</td>' +
                        '<td  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].custname + '</td>' +
                        '<td  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].customertype + '</td>' +
                        '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].no_of_employee + '</td>';
                    if (data[i].contactdata.length > 0) {


                    }
                    for (j = 0; j < data[i].contactdata.length; j++) {
                        if (j > 0) {
                            html += '<td colspan="4"></td>';
                        }
                        html += '<td  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].contactdata[j].contact_name + '</td>' +
                            '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].contactdata[j].designation + '</td>' +
                            '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].contactdata[j].email_id + '</td>' +
                            '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].contactdata[j].mobile_no + '</td>';
                        if (data[i].contactdata.length > 0) {

                            html += '<td  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].remark + '</td>';
                            if (flag == 0) {
                                html += '<td  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].qutationcount + '</td>' +

                                    '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].ordercount + '</td>' +
                                    '<td  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].qutationamt + '</td>' +
                                    '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].orderamt + '</td>';
                                flag = 1;
                            } else {
                                html += '<td colspan="4"  style="white-space:nowrap;text-align:center;padding:10px 10px;">-</td>';
                            }
                            html += '</tr>';


                        }

                    }


                    $("#customer_tbody").append(html);
                }

            }
        });
    }



});