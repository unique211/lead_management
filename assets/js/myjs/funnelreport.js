$(document).ready(function() {
    var table_name = "category_type";
    var validate = 0;
    var cuser = 0;





    getMasterSelect('user_creation', '#salesrepresentive');

    /*---for get all representative*/
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
                html += '<option selected  value="All" >All</option>';
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
                            html += '<option  value="' + id + '" >' + name + '</option>';
                            // // getfinicialamt(id);
                            userid = id;
                        } else {
                            html += '<option value="' + id + '" >' + name + '</option>'; //last changes here
                        }
                    }



                }
                $(selecter).html(html);

                //funnelreport(userid);
            }
        });

    }
    /*---for login of sales Representative-*/
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

        //funnelreport(useruniqueid);

    }

    /*-for change event of dropdown--*/
    $(document).on('change', '#salesrepresentive', function() {

        var userid = $(this).val();

        // funnelreport(userid);
    });

    //for getting all funnel report table ---*/
    function funnelreport(uid) {
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
        // $('#btnExport').val(uid + "_" + statdate);

        $.ajax({
            type: 'POST',
            url: base_url + "Funnelreport/getfunnelreportdata",
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


                sr = sr + 1;




                $("#funnelrep_tbody").html('');
                var sr = 0;
                for (var i = 0; i < data.length; i++) {
                    sr = sr + 1;

                    summargin = (parseFloat(summargin) + parseFloat(data[i].magin)).toFixed(2);
                    sumtop = (parseFloat(sumtop) + parseFloat(data[i].totalordvalue)).toFixed(2);


                    if (data[i].status == 1) {
                        statusinfo = 'Pending';
                    } else if (data[i].status == 2) {
                        statusinfo = 'Confirm';
                    } else if (data[i].status == 3) {
                        statusinfo = 'Cancle';
                    } else {
                        statusinfo = 'Invoice Generated';
                    }

                    var totalordvalue = parseFloat(data[i].totalordvalue).toFixed(2);
                    var magin1 = parseFloat(data[i].magin).toFixed(2);

                    totalordvalue = (parseFloat(totalordvalue) / 100000).toFixed(2);
                    magin1 = (parseFloat(magin1) / 100000).toFixed(2);


                    html += '<tr id="lossrep_' + sr + '">' +
                        '<td  style="white-space:nowrap;text-align:left;padding:10px 10px;"></td>' +
                        '<td  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].customer_name + '</td>' +
                        '<td  style="white-space:nowrap;text-align:left;padding:10px 10px;"></td>' +
                        '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].product + '<button class="productinfo pull-right" name="' + sr + '" style="color:blue" id=' + data[i].qid1 + '>View More</button></td>' +
                        '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].orderdate + '</td>' +
                        '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + totalordvalue + '</td>' +
                        '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + magin1 + '</td>' +
                        '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].probability + '%</td>' +
                        '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].order_due_date + '</td>' +
                        '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + statusinfo + '</td>' +

                        '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].description + '</td>' +
                        '</tr>';

                    html += '<tr id="productinfo_' + data[i].qid1 + '" style="display:none;" ><td colspan="11"><div><table class="table table-bordered table-hover" id="productinformation">' +

                        '<thead>' +
                        '<tr>' +
                        '<td width="20%">Description</td>' +
                        '<td>Qty</td>' +
                        '<td>UnitTransfer Price</td>' +
                        '<td>Total Transfer Price</td>' +
                        '<td>Tax (%)</td>' +
                        '<td>Tax (Rs)</td>' +
                        '<td>Total Transfer Price With Inc Tax	</td>' +
                        '<td>Unit Ord Value</td>' +
                        '<td>Total Ord Value</td>' +
                        '<td>Tax %</td>' +
                        '<td>Tax (Value)</td>' +
                        '<td>Total Ord Val With Tax</td>' +
                        '<td>Margin</td>' +
                        '</tr>' +
                        '</thead>' +
                        '<tbody>';
                    for (j = 0; j < data[i].productinfo.length; j++) {
                        var totaltransforprice = parseFloat(data[i].productinfo[j].qty) * parseFloat(data[i].productinfo[j].unit_transfor_price);
                        var taxrs = parseFloat(totaltransforprice) * parseFloat(data[i].productinfo[j].transfor_tax) / 100;
                        var totaltpricewithtax = parseFloat(totaltransforprice) + parseFloat(taxrs);

                        var totalordvalue = parseFloat(data[i].productinfo[j].unit_order_value) * parseFloat(data[i].productinfo[j].qty);
                        var otaxrs = parseFloat(totalordvalue) * parseFloat(data[i].productinfo[j].order_tax) / 100;
                        var totalowithtax = parseFloat(totalordvalue) + parseFloat(otaxrs);


                        var margin = parseFloat(totalordvalue) - parseFloat(totaltransforprice);

                        totaltransforprice = (parseFloat(totaltransforprice) / 100000).toFixed(2);
                        taxrs = (parseFloat(taxrs) / 100000).toFixed(2);
                        totaltpricewithtax = (parseFloat(totaltpricewithtax) / 100000).toFixed(2);
                        totalordvalue = (parseFloat(totalordvalue) / 100000).toFixed(2);
                        otaxrs = (parseFloat(otaxrs) / 100000).toFixed(2);
                        totalowithtax = (parseFloat(totalowithtax) / 100000).toFixed(2);
                        margin = (parseFloat(margin) / 100000).toFixed(2);


                        html += '<tr><td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].productinfo[j].product_name + '</td>' +
                            '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].productinfo[j].qty + '</td>' +
                            '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + data[i].productinfo[j].unit_transfor_price + '</td>' +
                            '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + totaltransforprice + '</td>' +
                            '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + data[i].productinfo[j].transfor_tax + '</td>' +
                            '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + taxrs + '</td>' +
                            '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + totaltpricewithtax + '</td>' +
                            '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + data[i].productinfo[j].unit_order_value + '</td>' +
                            '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + totalordvalue + '</td>' +
                            '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + data[i].productinfo[j].order_tax + '</td>' +
                            '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + otaxrs + '</td>' +
                            '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + totalowithtax + '</td>' +
                            '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + margin + '</td>' +
                            '</tr>';

                    }

                    html += '</tbody>' +
                        '</table></div></td></tr>';


                }
                console.log(html);
                $("#funnelrep_tbody").html(html);
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

        //$('#productinfo_' + id).show();

        if (text == "View More") {

            if (proid > 0) {
                $('#productinfo_' + proid).hide();
                $('#' + proid).text('View More');
            }
            $('#productinfo_' + id).show();
            proid = id;

            $('#' + id).text('View Less');
        } else {
            $('#' + id).text('View More');
            $('#productinfo_' + id).hide();
        }




    });

    //click event of btn export


    $(document).on("submit", "#funnel_form", function(e) {
        e.preventDefault();

        var userid = $('#salesrepresentive').val();
        var ovmnm = $('#ovmnm').val();
        var productnm = $('#productnm').val();
        var fromdate = $('#fromdate').val();
        var to_date = $('#to_date').val();

        var today = new Date();
        var fyear = today.getFullYear().toString();
        if ((today.getMonth() + 1) <= 3) {
            fiscalyear = (parseInt(fyear) - parseInt(1)) + "-" + fyear;

        } else {
            fiscalyear = parseInt(fyear) + "-" + (parseInt(fyear) + parseInt(1));

        }
        fiscalyear = fiscalyear.split('-');
        var statdate = fiscalyear[0] + "-" + "04" + "-" + "01";
        if (usertype == "SalesRepresentative" && userrole == "Sales") {
            userid = useruniqueid;
        }
        //$('#btnExport').val(userid + "_" + statdate);
        //   $('#btnExport').val(userid + "_" + statdate + "_" + ovmnm + "_" + productnm + "_" + fromdate + "_" + to_date);

        if (fromdate == "" && to_date == "") {
            $('#btnExport').val(userid + "_" + statdate + "_" + ovmnm + "_" + productnm + "_" + 1 + "_" + 1);

        } else {
            $('#btnExport').val(userid + "_" + statdate + "_" + ovmnm + "_" + productnm + "_" + fromdate + "_" + to_date);

        }
        $.ajax({
            type: 'POST',
            url: base_url + "Funnelreport/getfunnelreportdata1",
            async: false,
            data: {
                uid: userid,
                ovmnm: ovmnm,
                productnm: productnm,
                fromdate: fromdate,
                to_date: to_date,
                statdate: statdate,
            },
            dataType: 'json',
            success: function(data) {
                var summargin = 0;
                var sumtop = 0;
                var html = '';


                sr = sr + 1;




                $("#funnelrep_tbody").html('');
                var sr = 0;
                for (var i = 0; i < data.length; i++) {
                    sr = sr + 1;

                    summargin = (parseFloat(summargin) + parseFloat(data[i].magin)).toFixed(2);
                    sumtop = (parseFloat(sumtop) + parseFloat(data[i].totalordvalue)).toFixed(2);


                    if (data[i].status == 1) {
                        statusinfo = 'Pending';
                    } else if (data[i].status == 2) {
                        statusinfo = 'Confirm';
                    } else if (data[i].status == 3) {
                        statusinfo = 'Cancle';
                    } else {
                        statusinfo = 'Invoice Generated';
                    }

                    var totalordvalue = parseFloat(data[i].totalordvalue).toFixed(2);
                    var magin1 = parseFloat(data[i].magin).toFixed(2);

                    totalordvalue = (parseFloat(totalordvalue) / 100000).toFixed(2);
                    magin1 = (parseFloat(magin1) / 100000).toFixed(2);

                    if (data[i].productinfo.length > 0) {

                        html += '<tr id="lossrep_' + sr + '">' +
                            '<td  style="white-space:nowrap;text-align:left;padding:10px 10px;"></td>' +
                            '<td  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].customer_name + '</td>' +
                            '<td  style="white-space:nowrap;text-align:left;padding:10px 10px;"></td>' +
                            '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].product + '<button class="productinfo pull-right" name="' + sr + '" style="color:blue" id=' + sr + '>View More</button></td>' +
                            '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].orderdate + '</td>' +
                            '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + totalordvalue + '</td>' +
                            '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + magin1 + '</td>' +
                            '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].probability + '%</td>' +
                            '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].order_due_date + '</td>' +
                            '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + statusinfo + '</td>' +

                            '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].description + '</td>' +
                            '</tr>';

                        html += '<tr id="productinfo_' + sr + '" style="display:none;" ><td colspan="11"><div><table class="table table-bordered table-hover" id="productinformation">' +

                            '<thead>' +
                            '<tr>' +
                            '<td width="20%">Description</td>' +
                            '<td>Qty</td>' +
                            '<td>UnitTransfer Price</td>' +
                            '<td>Total Transfer Price</td>' +
                            '<td>Tax (%)</td>' +
                            '<td>Tax (Rs)</td>' +
                            '<td>Total Transfer Price With Inc Tax	</td>' +
                            '<td>Unit Ord Value</td>' +
                            '<td>Total Ord Value</td>' +
                            '<td>Tax %</td>' +
                            '<td>Tax (Value)</td>' +
                            '<td>Total Ord Val With Tax</td>' +
                            '<td>Margin</td>' +
                            '</tr>' +
                            '</thead>' +
                            '<tbody>';
                        for (j = 0; j < data[i].productinfo.length; j++) {
                            var totaltransforprice = parseFloat(data[i].productinfo[j].qty) * parseFloat(data[i].productinfo[j].unit_transfor_price);
                            var taxrs = parseFloat(totaltransforprice) * parseFloat(data[i].productinfo[j].transfor_tax) / 100;
                            var totaltpricewithtax = parseFloat(totaltransforprice) + parseFloat(taxrs);

                            var totalordvalue = parseFloat(data[i].productinfo[j].unit_order_value) * parseFloat(data[i].productinfo[j].qty);
                            var otaxrs = parseFloat(totalordvalue) * parseFloat(data[i].productinfo[j].order_tax) / 100;
                            var totalowithtax = parseFloat(totalordvalue) + parseFloat(otaxrs);


                            var margin = parseFloat(totalordvalue) - parseFloat(totaltransforprice);

                            totaltransforprice = (parseFloat(totaltransforprice) / 100000).toFixed(2);
                            taxrs = (parseFloat(taxrs) / 100000).toFixed(2);
                            totaltpricewithtax = (parseFloat(totaltpricewithtax) / 100000).toFixed(2);
                            totalordvalue = (parseFloat(totalordvalue) / 100000).toFixed(2);
                            otaxrs = (parseFloat(otaxrs) / 100000).toFixed(2);
                            totalowithtax = (parseFloat(totalowithtax) / 100000).toFixed(2);
                            margin = (parseFloat(margin) / 100000).toFixed(2);


                            html += '<tr><td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].productinfo[j].product_name + '</td>' +
                                '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].productinfo[j].qty + '</td>' +
                                '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + data[i].productinfo[j].unit_transfor_price + '</td>' +
                                '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + totaltransforprice + '</td>' +
                                '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + data[i].productinfo[j].transfor_tax + '</td>' +
                                '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + taxrs + '</td>' +
                                '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + totaltpricewithtax + '</td>' +
                                '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + data[i].productinfo[j].unit_order_value + '</td>' +
                                '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + totalordvalue + '</td>' +
                                '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + data[i].productinfo[j].order_tax + '</td>' +
                                '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + otaxrs + '</td>' +
                                '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + totalowithtax + '</td>' +
                                '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + margin + '</td>' +
                                '</tr>';

                        }


                        html += '</tbody>' +
                            '</table></div></td></tr>';
                    }


                }
                console.log(html);
                $("#funnelrep_tbody").html(html);
                summargin = (parseFloat(summargin) / 100000).toFixed(2);
                sumtop = (parseFloat(sumtop) / 100000).toFixed(2);
                $('#totaltop').html(sumtop);
                $('#totalmargin').html(summargin);

            }
        });

    });


    getallovm();

    function getallovm() {
        $.ajax({
            type: 'POST',
            url: baseurl + "Quotation_Estimate/get_master_ovm",
            async: false,
            data: {

            },
            dataType: 'json',
            success: function(data) {

                var html = '';
                html += '<option  disabled value="" >Select</option>';
                //						}
                for (i = 0; i < data.length; i++) {
                    var id = '';

                    name = data[i].ovmname;
                    id = data[i].ovmname;

                    if (i == 0) {
                        html += '<option selected value="All" >All</option>';
                    } else {
                        html += '<option value="' + id + '" >' + name + '</option>';
                    }



                }
                $('#ovmnm').html(html);
            }

        });
    }

    getallproduct();

    function getallproduct() {

        $.ajax({
            type: 'POST',
            url: baseurl + "Quotation_Estimate/get_master_product",
            async: false,
            data: {

            },
            dataType: 'json',
            success: function(data) {
                var html = '';
                html += '<option  disabled value="" >Select</option>';
                //						}
                for (i = 0; i < data.length; i++) {
                    var id = '';

                    name = data[i].product_name;
                    id = data[i].product_name;

                    if (i == 0) {
                        html += '<option selected value="All" >All</option>';
                    } else {
                        html += '<option value="' + id + '" >' + name + '</option>';
                    }



                }
                $('#productnm').html(html);


            }

        });
    }



});