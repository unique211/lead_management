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
                getlossdata(userid);
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
        getlossdata(useruniqueid);

    }
    $(document).on('change', '#salesrepresentive', function() {

        var userid = $(this).val();
        getlossdata(userid);
    });

    function getlossdata(uid) {

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

        $('#btnExport').val(uid + "_" + statdate);

        $.ajax({
            type: 'POST',
            url: base_url + "Wonreport/getloss",
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
                $("#loserep_tbody").html('');

                var sr = 0;
                var statusinfo = '';
                for (i = 0; i < data.length; i++) {

                    sr = sr + 1;


                    summargin = (parseFloat(summargin) + parseFloat(data[i].magin)).toFixed(2);
                    sumtop = (parseFloat(sumtop) + parseFloat(data[i].totalordvalue)).toFixed(2);

                    if (data[i].status == 1) {
                        statusinfo = 'Pending';
                    } else if (data[i].status == 2) {
                        statusinfo = 'Confirm';
                    } else {
                        statusinfo = 'Cancle';
                    }
                    var totalordvalue = parseFloat(data[i].totalordvalue).toFixed(2);
                    var magin = parseFloat(data[i].magin).toFixed(2);

                    totalordvalue = (parseFloat(totalordvalue) / 100000).toFixed(2);
                    magin = (parseFloat(magin) / 100000).toFixed(2);

                    html = '<tr id="lossrep_' + sr + '">' +
                        '<td  style="white-space:nowrap;text-align:left;padding:10px 10px;"></td>' +
                        '<td  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].customer_name + '</td>' +
                        '<td  style="white-space:nowrap;text-align:left;padding:10px 10px;"></td>' +
                        '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].product + '<button class="productinfo pull-right" name="' + sr + '" style="color:blue" id=' + data[i].qid1 + '>View More</button></td>' +
                        '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].orderdate + '</td>' +
                        '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + totalordvalue + '</td>' +
                        '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + magin + '</td>' +
                        '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].probability + '%</td>' +
                        '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].order_due_date + '</td>' +
                        '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + statusinfo + '</td>' +

                        '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].description + '</td>' +
                        '</tr><tr style="display:none;" id="productinfo_' + data[i].qid1 + '"></tr>';

                    $("#loserep_tbody").append(html);

                }
                summargin = (parseFloat(summargin) / 100000).toFixed(2);
                sumtop = (parseFloat(sumtop) / 100000).toFixed(2);
                $('#totaltop').html(sumtop);
                $('#totalmargin').html(summargin);




            }


        });
    }
    //for getting product view information--start
    var proid = 0;
    $(document).on("click", ".productinfo", function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        var sr = $(this).attr('name');
        var text = $(this).text();
        console.log(sr);

        $('#productinfo_' + id).show();

        if (text == "View More") {

            if (proid > 0) {
                $("#dis_" + proid).remove();
                $('#' + proid).text('View More');
            }

            $.ajax({
                type: 'POST',
                url: base_url + "Wonreport/getlossproductinfo",
                async: false,
                data: {
                    id: id,

                },
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    $('#productinfo_' + id).html('');
                    if (data.length > 0) {
                        html += '<tr id="dis_' + id + '"><td colspan="11"><table class="table table-bordered table-hover" id="productinformation">' +

                            '<thead>' +
                            '<tr>' +
                            '<th width="20%">Description</th>' +
                            '<th>Qty</th>' +
                            '<th>UnitTransfer Price</th>' +
                            '<th>Total Transfer Price</th>' +
                            '<th>Tax (%)</th>' +
                            '<th>Tax (Rs)</th>' +
                            '<th>Total Transfer Price With Inc Tax	</th>' +
                            '<th>Unit Ord Value</th>' +
                            '<th>Total Ord Value</th>' +
                            '<th>Tax %</th>' +
                            '<th>Tax (Value)</th>' +
                            '<th>Total Ord Val With Tax</th>' +
                            '<th>Margin</th>' +
                            '</tr>' +
                            '</thead>' +
                            '<tbody>';
                        for (var i = 0; i < data.length; i++) {

                            var totaltransforprice = parseFloat(data[i].qty) * parseFloat(data[i].unit_transfor_price);
                            var taxrs = parseFloat(totaltransforprice) * parseFloat(data[i].transfor_tax);
                            var totaltpricewithtax = parseFloat(totaltransforprice) + parseFloat(taxrs);

                            var totalordvalue = parseFloat(data[i].unit_order_value) * parseFloat(data[i].qty);
                            var otaxrs = parseFloat(totalordvalue) * parseFloat(data[i].order_tax) / 100;
                            var totalowithtax = parseFloat(totalordvalue) + parseFloat(otaxrs);


                            var margin = parseFloat(totalordvalue) - parseFloat(totaltransforprice);

                            totaltransforprice = (parseFloat(totaltransforprice) / 100000).toFixed(2);
                            taxrs = (parseFloat(taxrs) / 100000).toFixed(2);
                            totaltpricewithtax = (parseFloat(totaltpricewithtax) / 100000).toFixed(2);
                            totalordvalue = (parseFloat(totalordvalue) / 100000).toFixed(2);
                            otaxrs = (parseFloat(otaxrs) / 100000).toFixed(2);
                            totalowithtax = (parseFloat(totalowithtax) / 100000).toFixed(2);
                            margin = (parseFloat(margin) / 100000).toFixed(2);


                            html += '<tr><td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].product_name + '</td>' +
                                '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].qty + '</td>' +
                                '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + data[i].unit_transfor_price + '</td>' +
                                '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + totaltransforprice + '</td>' +
                                '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + data[i].transfor_tax + '</td>' +
                                '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + taxrs + '</td>' +
                                '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + totaltpricewithtax + '</td>' +
                                '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + data[i].unit_order_value + '</td>' +
                                '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + totalordvalue + '</td>' +
                                '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + data[i].order_tax + '</td>' +
                                '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + otaxrs + '</td>' +
                                '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + totalowithtax + '</td>' +
                                '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + margin + '</td>' +
                                '</tr>';


                        }


                        '</tbody>' +
                        '</table></td></tr>';

                        $('#loserep_tbody tr:eq(' + sr + ')').after(html);

                        proid = id;
                        // $('#lossrep_' + id).prepend(html);

                        // $('#' + id + ' .innerDiv').after(html);

                        //$('#productinfo_' + id).html(html);
                    }


                }
            });
            $('#' + id).text('View Less');
        } else {
            $('#' + id).text('View More');
            $("#dis_" + proid).remove();
        }




    });


});