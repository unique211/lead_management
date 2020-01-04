$(document).ready(function() {
    var table_name = "category_type";
    var validate = 0;
    var cuser=0;


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
                funnelreport(userid);
                cuser=userid;
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
        cuser=useruniqueid;
        funnelreport(useruniqueid);

    }

    /*-for change event of dropdown--*/
    $(document).on('change', '#salesrepresentive', function() {

        var userid = $(this).val();
        cuser=userid;
        funnelreport(userid);
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
       

        $('#btnExport').val(uid+"_"+statdate);
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
                    html += '<tr id="lossrep_' + sr + '">' +
                        '<td  style="white-space:nowrap;text-align:left;padding:10px 10px;"></td>' +
                        '<td  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].customer_name + '</td>' +
                        '<td  style="white-space:nowrap;text-align:left;padding:10px 10px;"></td>' +
                        '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].product + '<button class="productinfo pull-right" name="' + sr + '" style="color:blue" id=' + data[i].qid1 + '>View More</button></td>' +
                        '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].orderdate + '</td>' +
                        '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + parseFloat(data[i].totalordvalue).toFixed(2) + '</td>' +
                        '<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + parseFloat(data[i].magin).toFixed(2) + '</td>' +
                        '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].probability + '%</td>' +
                        '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].order_due_date + '</td>' +
                        '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + statusinfo + '</td>' +

                        '<td   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].description + '</td>' +
                        '</tr>';

                    html += '<tr id="productinfo_' + data[i].qid1 + '" style="display:none;"  ><td colspan="11">' +

                        // '<thead>' +
                        // '<tr>' +
                        '<div class="row">' +

                        '<div class="col-sm-2" width="20%">Description</div>' +
                        '<div class="col-sm-1">Qty</div>' +
                        '<div class="col-sm-1">UnitTransfer Price</div>' +
                        '<div class="col-sm-1">Total Transfer Price</div>' +
                        '<div class="col-sm-1">Tax (%)</div>' +
                        '<div class="col-sm-1">Tax (Rs)</div>' +
                        '<div class="col-sm-1">Total Transfer Price With Inc Ta</div>' +
                        '<div class="col-sm-1">Unit Ord Value</div>' +
                        '<div class="col-sm-1">Total Ord Value</div>' +
                        '<div class="col-sm-1">Tax %</div>' +
                        '<div class="col-sm-1">Tax (Value)</div>' +
                        '</div><br>';

                    //alert(html);
                    //'<td>Total Ord Val With Tax</td>' +
                    // '<td>Margin</td>' +
                    // '</tr>' +
                    // '</thead>' +
                    // '<tbody>';
                    for (j = 0; j < data[i].productinfo.length; j++) {
                        var totaltransforprice = parseFloat(data[i].productinfo[j].qty) * parseFloat(data[i].productinfo[j].unit_transfor_price);
                        var taxrs = parseFloat(totaltransforprice) * parseFloat(data[i].productinfo[j].transfor_tax) / 100;
                        var totaltpricewithtax = parseFloat(totaltransforprice) + parseFloat(taxrs);

                        var totalordvalue = parseFloat(data[i].productinfo[j].unit_order_value) * parseFloat(data[i].productinfo[j].qty);
                        var otaxrs = parseFloat(totalordvalue) * parseFloat(data[i].productinfo[j].order_tax) / 100;
                        var totalowithtax = parseFloat(totalordvalue) + parseFloat(otaxrs);


                        var margin = parseFloat(totalordvalue) - parseFloat(totaltransforprice);


                        html += '<div class="row">' +
                            '<div class="col-sm-2"  >' + data[i].productinfo[j].product_name + '</div>' +
                            '<div class="col-sm-1"   >' + data[i].productinfo[j].qty + '</div>' +
                            '<div class="col-sm-1"  >' + data[i].productinfo[j].unit_transfor_price + '</div>' +
                            '<div class="col-sm-1"  >' + totaltransforprice + '</div>' +
                            '<div class="col-sm-1"   >' + data[i].productinfo[j].transfor_tax + '</div>' +
                            '<div class="col-sm-1"  >' + taxrs + '</div>' +
                            '<div class="col-sm-1"   >' + totaltpricewithtax + '</div>' +
                            '<div class="col-sm-1"   >' + data[i].productinfo[j].unit_order_value + '</div>' +
                            '<div class="col-sm-1"   >' + totalordvalue + '</div>' +
                            '<div class="col-sm-1"   >' + data[i].productinfo[j].order_tax + '</div>' +
                            '<div class="col-sm-1" >' + otaxrs + '</div>' +
                            //'<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + totalowithtax + '</td>' +
                            //'<td   style="white-space:nowrap;text-align:right;padding:10px 10px;">' + margin + '</td>' +
                            '</div><br>';

                    }

                    // html += '</tbody>' +
                    html += '</td></tr>';


                }
             
                console.log(html);
                $("#funnelrep_tbody").html(html);
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

    // //click event of btn export

    // $(document).on('click', '#btnExport', function() {
    //     var today = new Date();
    //     var fyear = today.getFullYear().toString();
    //     if ((today.getMonth() + 1) <= 3) {



    //         fiscalyear = (parseInt(fyear) - parseInt(1)) + "-" + fyear;

    //     } else {
    //         fiscalyear = parseInt(fyear) + "-" + (parseInt(fyear) + parseInt(1));
    //         //fiscalyear=  fiscalyear.toString().substr(-2);
    //     }

    //     fiscalyear = fiscalyear.split('-');
    //     var statdate = fiscalyear[0] + "-" + "04" + "-" + "01";

    //     $.ajax({
    //         type: 'POST',
    //         url: base_url + "Export/action",
    //         async: false,
    //         data: {
    //             uid: cuser,
    //             statdate: statdate,
    //         },
    //         dataType: 'json',
    //         success: function(data) {
    //         }
    //     });


    //     // $("#funnelreport_tb").table2excel({
    //     //     name: "Table2Excel",
    //     //     exclude: ".noExl",
    //     //     filename: "funnelreport.xls",

    //     // });


    // });



});