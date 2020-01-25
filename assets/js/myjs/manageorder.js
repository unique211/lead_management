$(document).ready(function() {

    var table_name = "order_master";
    $(document).on('click', '#add_row', function(e) {
        e.preventDefault();
        addproduct();


    });
    addproduct();

    // for add product
    function addproduct() {
        var table = $("#product_table");
        var count_table_tbody_tr = $("#product_table tbody tr").length;
        var row_id = $('#product_tbody').val();
        row_id = parseInt(row_id) + 1;

        //   $.ajax({
        //   url: base_url + '/Invoice_Quatation/getTableProductRow/',
        //   type: 'post',
        //   dataType: 'json',
        //   success:function(response) {
        // console.log(reponse.x);

        var html = '<tr id="row_' + row_id + '"  class="producttbrow">' +


            '<td><input type="text" placeholder="Product Name" name="P_Id[]" id="pid_' + row_id + '" class="form-control product_name"></td>' +


            '<td><input type="text" placeholder="Qty" name="P_Id[]" id="qty_' + row_id + '" value="1" class="form-control totalprice"></td>' +

            '<td><input type="text" placeholder="UnitTransfer Price" name="P_Id[]" id="unitprice_' + row_id + '" class="form-control totalprice"></td>' +

            '<td><input type="text" placeholder="Total Transfer Price" name="P_Id[]" id="totaltransforprice_' + row_id + '" class="form-control" disabled></td>' +

            '<td><input type="text" placeholder="Tax (%)" name="P_Id[]" id="taxper_' + row_id + '" class="form-control gettaxamt"></td>' +


            '<td><input type="text" placeholder="Tax (Rs)" name="P_Id[]" id="taxprice_' + row_id + '" class="form-control" disabled></td>' +

            '<td><input type="text" placeholder="Total Transfer Price With Inc Tax" name="P_Qty[]" id="totalpricewithtax_' + row_id + '" class="form-control" disabled></td>' +

            '<td><input type="text" placeholder="Unit Ord Value" name="P_Rate[]" id="unitordvalue_' + row_id + '" class="form-control gettotalordvalue"></td>' +

            '<td><input type="text" placeholder="Total Ord Value" name="P_Rate[]" id="totalordvalue_' + row_id + '" class="form-control " disabled></td>' +

            '<td><input type="text" placeholder="Tax %" name="P_Tax[]" id="ptax_' + row_id + '" class="form-control getordtaxprice"></td>' +


            '<td><input type="text" placeholder="Tax Rs" name="P_Tax_Rs[]" id="ptaxrs_' + row_id + '" class="form-control" disabled></td>' +





            '<td><input type="text" placeholder="Total Ord Val With Tax" name="P_Discount[]" id="totalodval_' + row_id + '" class="form-control" disabled></td>' +

            '<td><input type="text" placeholder="Amount" name="P_TotalAmt[]" id="margin_' + row_id + '" class="form-control" disabled></td>' +

            '<td><button type="button" id="row_' + row_id + '" class="btn btn-default deleterow" style="font-size: 12px; color:red" ><i class="fa fa-close"></i></button></td></tr>';

        //'<td colspan="13"  id="rows_' + row_id + '"> <textarea class="form-control" rows="2" name="P_Desc[]" id="P_Desc_1"></textarea></td>' +
        //'</tr>';

        if (count_table_tbody_tr >= 1) {
            $("#product_table tbody tr:last").after(html);
        } else {
            $("#product_table tbody").html(html);
        }

        $('#product_tbody').val(row_id);


        getallproduct();
    }


    $(document).on('blur', '.totalprice', function(e) {
        e.preventDefault();

        var id = $(this).attr('id');
        id = id.split("_");

        var qty = $('#qty_' + id[1]).val();
        var unitprice = $('#unitprice_' + id[1]).val();

        var taxper_ = $('#taxper_' + id[1]).val();
        var unitordvalue = $('#unitordvalue_' + id[1]).val();
        var ptax_ = $('#ptax_' + id[1]).val();
        var pprice = 0;
        var totalordvalue = 0;
        var totalordwithtax = 0;

        var taxprice = 0;
        var totalwithtax = 0;

        var total = 0;
        if (qty > 0 && unitprice > 0) {
            total = parseInt(qty) * parseInt(unitprice);

        }
        if (taxper_ > 0) {
            taxprice = parseFloat(total) * parseFloat(taxper_) / 100;
            totalwithtax = parseFloat(total) + parseFloat(taxprice);

        } else {
            totalwithtax = parseFloat(total);

        }

        if (unitordvalue > 0) {
            totalordvalue = parseFloat(unitordvalue) * parseFloat(qty);

        }
        if (ptax_ > 0) {
            pprice = parseFloat(totalordvalue) * parseFloat(ptax_) / 100;
            totalordwithtax = parseFloat(totalordvalue) + parseFloat(pprice);
        }

        $('#taxprice_' + id[1]).val(taxprice);
        $('#ptaxrs_' + id[1]).val(pprice);
        $('#totalordvalue_' + id[1]).val(totalordvalue);
        $('#totalpricewithtax_' + id[1]).val(totalwithtax);
        $('#totaltransforprice_' + id[1]).val(total);
        $('#totalodval_' + id[1]).val(totalordwithtax);


        //for changes ---*/
        var totaltransforprice = $('#totaltransforprice_' + id[1]).val();
        var margin = 0;
        var totalordvalue = $('#totalordvalue_' + id[1]).val();
        var ptax_ = $('#ptax_' + id[1]).val();
        var total = 0;
        var totalordvalue_ = 0;
        if (ptax_ > 0 && totalordvalue > 0) {
            total = parseFloat(totalordvalue) * parseFloat(ptax_) / 100;
            totalordvalue_ = parseFloat(total) + parseFloat(totalordvalue);
        }

        if (totalordvalue_ > 0 && totaltransforprice > 0) {
            margin = parseFloat(totalordvalue) - parseFloat(totaltransforprice);
        }

        $('#totalodval_' + id[1]).val(totalordvalue_);
        $('#ptaxrs_' + id[1]).val(total);
        $('#margin_' + id[1]).val(margin);
        getamt();
        get_all_margin();

    });

    $(document).on('blur', '.gettaxamt', function(e) {
        e.preventDefault();

        var id = $(this).attr('id');
        id = id.split("_");

        var taxper_ = $('#taxper_' + id[1]).val();
        var totaltransforprice = $('#totaltransforprice_' + id[1]).val();
        var total = 0;
        var totalpricewithtax = 0;
        if (taxper_ > 0 && totaltransforprice > 0) {
            total = parseFloat(totaltransforprice) * parseFloat(taxper_) / parseFloat(100);
            totalpricewithtax = parseFloat(total) + parseFloat(totaltransforprice);
        }
        $('#taxprice_' + id[1]).val(total);
        $('#totalpricewithtax_' + id[1]).val(totalpricewithtax);
        getamt();
    });




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

                var product = [];
                for (var i = 0; i < data.length; i++) {
                    productnm = data[i].product_name;

                    product.push(productnm);
                }

                // $(".product_name").autocomplete({
                //     source: ["PHP", "JQuery", "JavaScript", "HTML", "ASP", "Perl", "MySQL", "Access", "Excel", "Dot Net"],
                //     autoFocus: true
                // });

                console.log(product);
                $(".product_name").autocomplete({
                    source: product,
                    autoFocus: true,


                });
            }

        });
    }


    $(document).on("blur", ".product_name", function(e) {
        e.preventDefault();

        var id = $(this).attr('id');
        id = id.split("_");
        var val = $(this).val();

        $.ajax({
            type: 'POST',
            url: baseurl + "Quotation_Estimate/get_product_detalis",
            async: false,
            data: {
                val: val,

            },
            dataType: 'json',
            success: function(data) {
                var totaltransforprice = 0;
                var taxrs = 0;
                var totalpricewithtax = 0;
                var totalordvalue = 0;
                var ordtaxprice = 0;
                var totalordvaluewithtax = 0;
                var margin = 0;

                if (data.length > 0) {

                    $('#unitprice_' + id[1]).val(data[0].unit_transfor_price);
                    $('#taxper_' + id[1]).val(data[0].transfor_tax);
                    $('#unitordvalue_' + id[1]).val(data[0].unit_order_value);
                    $('#ptax_' + id[1]).val(data[0].order_value_tax);
                    if (data[0].unit_transfor_price > 0 && data[0].transfor_tax > 0) {
                        taxrs = parseFloat(data[0].unit_transfor_price) * parseFloat(data[0].transfor_tax) / 100;
                        totalpricewithtax = parseFloat(data[0].unit_transfor_price) + parseFloat(taxrs);
                    }

                    if (data[0].unit_order_value > 0 && data[0].order_value_tax > 0) {
                        ordtaxprice = parseFloat(data[0].unit_order_value) * parseFloat(data[0].order_value_tax) / 100;
                        totalordvaluewithtax = parseFloat(data[0].unit_order_value) + parseFloat(ordtaxprice) / 100;

                    }
                    var margin = 0;
                    if (data[0].unit_order_value > 0 && data[0].unit_transfor_price) {
                        margin = parseInt(data[0].unit_order_value) - parseInt(data[0].unit_transfor_price);
                    } else {
                        margin = 0;
                    }

                    $('#taxprice_' + id[1]).val(taxrs);
                    $('#totaltransforprice_' + id[1]).val(data[0].unit_transfor_price);
                    //  $('#totalpricewithtax_' + id[1]).val(totalpricewithtax);
                    $('#totalpricewithtax_' + id[1]).val(totalpricewithtax);
                    $('#totalordvalue_' + id[1]).val(data[0].unit_order_value);
                    $('#ptaxrs_' + id[1]).val(ordtaxprice);
                    $('#totalodval_' + id[1]).val(totalordvaluewithtax);
                    $('#margin_' + id[1]).val(margin);


                } else {
                    $('#unitprice_' + id[1]).val('');
                    $('#taxper_' + id[1]).val('');
                    $('#unitordvalue_' + id[1]).val('');
                    $('#ptax_' + id[1]).val('');

                    $('#taxprice_' + id[1]).val('');
                    $('#totaltransforprice_' + id[1]).val('');
                    //  $('#totalpricewithtax_' + id[1]).val(totalpricewithtax);
                    $('#totalpricewithtax_' + id[1]).val('');
                    $('#totalordvalue_' + id[1]).val('');
                    $('#ptaxrs_' + id[1]).val('');
                    $('#totalodval_' + id[1]).val('');
                    $('#margin_' + id[1]).val('');
                }

            }
        });
        getamt();
        get_all_margin();

    });

    function getamt() {

        var totaltransforprice = 0;
        var totalrs = 0;
        var totalpricewithtax = 0;
        var totalordvalue = 0;
        var totalordwithtax = 0;
        var margin = 0;

        $(".producttbrow").each(function() {


            var id = $(this).attr('id');
            id = id.split("_");


            var totalprice = $('#totaltransforprice_' + id[1]).val();
            var taxprice_1 = $('#taxprice_' + id[1]).val();
            var totalpricewithtax_ = $('#totalpricewithtax_' + id[1]).val();
            var P_TotalAmt_ = $('#totalordvalue_' + id[1]).val();
            var totalodval_ = $('#totalodval_' + id[1]).val();
            var margin_ = $('#margin_' + id[1]).val();

            console.log(totalprice);

            if (totalprice > 0) {
                totaltransforprice = parseFloat(totaltransforprice) + parseFloat(totalprice);
            }


            if (taxprice_1 > 0) {
                totalrs = parseFloat(totalrs) + parseFloat(taxprice_1);
            }


            if (totalpricewithtax_ > 0) {
                totalpricewithtax = parseFloat(totalpricewithtax) + parseFloat(totalpricewithtax_);
            }


            if (P_TotalAmt_ > 0) {
                totalordvalue = parseFloat(totalordvalue) + parseFloat(P_TotalAmt_);
            }


            if (totalodval_ > 0) {
                totalordwithtax = parseFloat(totalodval_) + parseFloat(totalordwithtax);
            }
            if (margin_ > 0 || margin_ < 0) {
                margin = parseFloat(margin) + parseFloat(margin_);
            }




        });
        $('#totaltrasnforprice').val(totaltransforprice);
        $('#totaltaxprice').val(totalrs);
        $('#totaltranforpricewithtax').val(totalpricewithtax);
        $('#P_TotalAmt_1').val(totalordvalue);
        $('#P_Tax_Val_1').val(totalordwithtax);
        $('#Margin_1').val(margin);

        $('#finalordvalue').val(totalordvalue);
        $('#finaltrasforprice').val(totaltransforprice);


    }


    $(document).on('blur', '.gettotalordvalue', function(e) {
        e.preventDefault();

        var id = $(this).attr('id');
        id = id.split("_");

        var unitordvalue = $('#unitordvalue_' + id[1]).val();
        var qty_ = $('#qty_' + id[1]).val();

        var totalordvalue_ = 0;
        if (qty_ > 0 && unitordvalue > 0) {
            totalordvalue_ = parseFloat(unitordvalue) * parseFloat(qty_);
        }
        $('#totalordvalue_' + id[1]).val(totalordvalue_);
    });

    $(document).on('blur', '.getordtaxprice', function(e) {
        e.preventDefault();

        var id = $(this).attr('id');
        id = id.split("_");

        var totaltransforprice = $('#totaltransforprice_' + id[1]).val();
        var margin = 0;
        var totalordvalue = $('#totalordvalue_' + id[1]).val();
        var ptax_ = $('#ptax_' + id[1]).val();
        var total = 0;
        var totalordvalue_ = 0;
        if (ptax_ > 0 && totalordvalue > 0) {
            total = parseFloat(totalordvalue) * parseFloat(ptax_) / 100;
            totalordvalue_ = parseFloat(total) + parseFloat(totalordvalue);
        }

        if (totalordvalue_ > 0 && totaltransforprice > 0) {
            margin = parseFloat(totalordvalue) - parseFloat(totaltransforprice);
        }

        $('#totalodval_' + id[1]).val(totalordvalue_);
        $('#ptaxrs_' + id[1]).val(total);
        $('#margin_' + id[1]).val(margin);
        getamt();
    });





    //for deleting prooff data
    $(document).on('click', '.deleterow', function(e) {
        e.preventDefault();

        var id = $(this).attr('id');
        id = id.split("_");
        if (id != "") {
            $('#row_' + id[1]).remove();
        }
        getamt();
        get_all_margin();

    });




    //function for get all customer

    getallcustomer();

    function getallcustomer() {

        $.ajax({
            type: 'POST',
            url: baseurl + "Quotation_Estimate/get_master_allcustomer",
            async: false,
            data: {

            },
            dataType: 'json',
            success: function(data) {

                var customer = [];
                for (var i = 0; i < data.length; i++) {
                    customernm = data[i].customer_name;

                    customer.push(customernm);
                }

                console.log(customer);

                // $("#cus_name").autocomplete({
                //     source: ["PHP", "JQuery", "JavaScript", "HTML", "ASP", "Perl", "MySQL", "Access", "Excel", "Dot Net"],
                //     autoFocus: true
                // });

                // console.log(product);
                $("#cus_name").autocomplete({
                    source: customer,
                    autoFocus: true,

                    select: function(event, ui) {
                        var label = ui.item.label;
                        var value = ui.item.value;
                        //store in session

                        $.ajax({
                            type: 'POST',
                            url: baseurl + "Quotation_Estimate/get_customer_detalis",
                            async: false,
                            data: {
                                customer: value,

                            },
                            dataType: 'json',
                            success: function(data) {
                                if (data == "0") {
                                    $('#cotactperson').val('');
                                    $('#phn').val('');
                                    $('#s_email').val('');
                                    $('#customerid').val('');
                                } else {
                                    $('#cotactperson').val(data[0].contact_name);
                                    $('#phn').val(data[0].mobile_no);
                                    $('#s_email').val(data[0].email_id);
                                    $('#customerid').val(data[0].account_id);
                                }
                            }
                        });

                    }


                });
            }

        });
    }

    // $(document).on('blur', '#cus_name', function(e) {
    //     e.preventDefault();
    //     var customer = $(this).val();
    //     $.ajax({
    //         type: 'POST',
    //         url: baseurl + "Quotation_Estimate/get_customer_detalis",
    //         async: false,
    //         data: {
    //             customer: customer,

    //         },
    //         dataType: 'json',
    //         success: function(data) {
    //             if (data == "0") {
    //                 $('#cotactperson').val('');
    //                 $('#phn').val('');
    //                 $('#s_email').val('');
    //             } else {
    //                 $('#cotactperson').val(data[0].contact_name);
    //                 $('#phn').val(data[0].mobile_no);
    //                 $('#s_email').val(data[0].email_id);
    //             }
    //         }
    //     });
    // });


    /*---------insert data into area_master start-----------------*/
    $(document).on("submit", "#order_form", function(e) {
        e.preventDefault();
        //alert('hii1');

        $('#wait').show();
        var cus_name = $('#cus_name').val();
        var cotactperson = $('#cotactperson').val();
        var phn = $('#phn').val();
        var s_email = $('#s_email').val();
        var orderno = $('#orderno').val();
        var refno = $('#refno').val();
        var Tax = $('#Tax').val();
        var o_date = $('#o_date').val();
        var o_due_date = $('#o_due_date').val();
        var description = $('#description').val();



        var finalordervalue = $('#finalordvalue').val();
        var finaltrasforprice = $('#finaltrasforprice').val();
        var lesstaxcst = $('#lesstaxcst').val();
        var lesstrasporation = $('#lesstrasporation').val();
        var lessbg = $('#lessbg').val();
        var lessother = $('#lessother').val();
        var finalmargin = $('#finalmargin').val();
        var search_version = $('#search_version').text();
        var quatation_no = $('#quatation_no').text();
        var quatationidno = $('#quatationid').val();
        var customerid = $('#customerid').val();
        var flag = 0;

        var salesrepresentive = $('#salesrepresentive').val();



        if (usertype == "SalesRepresentative" && userrole == "Sales") {
            salesrepresentive = useruniqueid;
        }

        var id = $('#save_update').val();

        var l1 = $('table#product_table').find('tbody').find('tr');
        var r = l1.length;



        if (r > 0) {

            studejsonObj = [];
            $(".producttbrow").each(function() {
                var id1 = $(this).attr('id');
                console.log(id1);

                id1 = id1.split("_");


                student = {};

                var productname = $('#pid_' + id1[1]).val();
                var qty = $('#qty_' + id1[1]).val();
                var unitprice = $('#unitprice_' + id1[1]).val();
                var taxper = $('#taxper_' + id1[1]).val();
                var unitordvalue = $('#unitordvalue_' + id1[1]).val();
                var ptax = $('#ptax_' + id1[1]).val();
                var margin = $('#margin_' + id1[1]).val();






                if (productname != "" && qty != "" && unitprice != "" && taxper != "" && unitordvalue != "" && ptax != "") {



                    student["productname"] = productname;
                    student["qty"] = qty;
                    student["unitprice"] = unitprice;
                    student["unittaxper"] = taxper;
                    student["orderunitvalue"] = unitordvalue;
                    student["ordertax"] = ptax;
                    student["margin"] = margin;

                    for (var i = 0; i < studejsonObj.length; i++) {


                        if (productname == studejsonObj[i].productname) {
                            flag = 1;

                        }
                    }






                } else {

                    $.notify({
                        title: '',
                        message: '<strong>Empty Row Found !!/strong>'
                    }, {
                        type: 'success'
                    });
                }
                if (flag == 1) {


                } else {
                    studejsonObj.push(student);
                }

            });



            if (flag == 0) {
                $.ajax({
                    type: "POST",
                    url: baseurl + "Quotation_order/save_settings",
                    dataType: "JSON",
                    async: false,
                    data: {
                        id: id,
                        cus_name: cus_name,
                        cotactperson: cotactperson,
                        phn: phn,
                        s_email: s_email,
                        bill_no: orderno,
                        refno: refno,
                        o_date: o_date,
                        o_due_date: o_due_date,
                        description: description,
                        studejsonObj: studejsonObj,
                        search_version: search_version,
                        finalordervalue: finalordervalue,
                        finaltrasforprice: finaltrasforprice,
                        lesstaxcst: lesstaxcst,
                        lesstrasporation: lesstrasporation,
                        lessbg: lessbg,
                        lessother: lessother,
                        finalmargin: finalmargin,
                        table_name: table_name,
                        quatationidno: quatationidno,
                        quatation_no: quatation_no,
                        salesrepresentive: salesrepresentive,
                        customerid: customerid,
                    },
                    success: function(data) {
                        console.log(data);
                        $('#wait').hide();

                        if (data > 0) {




                            // $('#save_update').val(data);
                            // $('#btnprint').val(data);
                            // $('#btnExport').val(data);
                            // $('#btnprint').show();
                            // $('#btnExport').show();
                            $("#tab2").prop('disabled', false);
                            $("#tab2").trigger('click');


                            $.notify({
                                title: '',
                                message: '<strong>Data saved successfully</strong>'
                            }, {
                                type: 'success'
                            });

                            //$('.btnhideshow').hide();
                            //$('.tablehideshow').show();

                            // form_clear();
                            displayqutation();


                        } else {
                            errorTost("Data Cannot Save");
                        }
                    }
                });
            } else {
                $.notify({
                    title: '',
                    message: '<strong>Same Product Exists Please Select Another Product !!! </strong>'
                }, {
                    type: 'success'
                });
            }
        } else {
            $.notify({
                title: '',
                message: '<strong>Please Add Atleast One Product !!!</strong>'
            }, {
                type: 'success'
            });
        }


    });
    /*---------insert data into area_master end-----------------*/


    $(document).on('blur', '.getmargindata', function(e) {
        e.preventDefault();

        var finalordervalue = $('#finalordvalue').val();
        var finaltrasforprice = $('#finaltrasforprice').val();
        var lesstaxcst = $('#lesstaxcst').val();
        var lesstrasporation = $('#lesstrasporation').val();
        var lessbg = $('#lessbg').val();
        var lessother = $('#lessother').val();
        var finalmargin = $('#finalmargin').val();

        if (lesstaxcst == "") {
            lesstaxcst = 0;
        }
        if (lesstrasporation == "") {
            lesstrasporation = 0;
        }
        if (lessbg == "") {
            lessbg = 0;
        }
        if (lessother == "") {
            lessother = 0;
        }
        if (finaltrasforprice == "") {
            finaltrasforprice = 0;
        }
        if (finalordervalue == "") {
            finalordervalue = 0;
        }


        var alltotal = parseFloat(finaltrasforprice) + parseFloat(lesstaxcst) + parseFloat(lesstrasporation) + parseFloat(lessbg) + parseFloat(lessother);

        var finalmargin = parseFloat(finalordervalue) - parseFloat(alltotal);

        $('#finalmargin').val(finalmargin);

    });

    function get_all_margin() {
        var finalordervalue = $('#finalordvalue').val();
        var finaltrasforprice = $('#finaltrasforprice').val();
        var lesstaxcst = $('#lesstaxcst').val();
        var lesstrasporation = $('#lesstrasporation').val();
        var lessbg = $('#lessbg').val();
        var lessother = $('#lessother').val();
        var finalmargin = $('#finalmargin').val();

        if (lesstaxcst == "") {
            lesstaxcst = 0;
        }
        if (lesstrasporation == "") {
            lesstrasporation = 0;
        }
        if (lessbg == "") {
            lessbg = 0;
        }
        if (lessother == "") {
            lessother = 0;
        }
        if (finaltrasforprice == "") {
            finaltrasforprice = 0;
        }
        if (finalordervalue == "") {
            finalordervalue = 0;
        }


        var alltotal = parseFloat(finaltrasforprice) + parseFloat(lesstaxcst) + parseFloat(lesstrasporation) + parseFloat(lessbg) + parseFloat(lessother);

        var finalmargin = parseFloat(finalordervalue) - parseFloat(alltotal);

        $('#finalmargin').val(finalmargin);
    }

    function form_clear() {
        $('#cus_name').val('');
        $('#customerid').val('');
        $('#cotactperson').val('');
        $('#phn').val('');
        $('#s_email').val('');
        $('#bill_no').val('');
        $('#refno').val('');
        $('#Tax').val('');
        $('#o_date').val('');
        $('#o_due_date').val('');
        $('#description').val('');

        $('#finalordvalue').val('');
        $('#finaltrasforprice').val('');
        $('#lesstaxcst').val('');
        $('#lesstrasporation').val('');
        $('#lessbg').val('');
        $('#lessother').val('');
        $('#finalmargin').val('');
        $("#product_table tbody").html('');
        addproduct();
        $('#save_update').val('');

        $('#totaltrasnforprice').val('');
        $('#totaltaxprice').val('');
        $('#totaltranforpricewithtax').val('');
        $('#P_TotalAmt_1').val('');
        $('#P_Tax_Val_1').val('');
        $('#Margin_1').val('');
        $('#searchversion').hide();
        $('#btnprint').hide();
        $('#btnExport').hide();
        $("#tblexporttbl").html('');

    }

    $(document).on('click', '.btnhide', function(e) {
        e.preventDefault();
        $('.btnhideshow').show();
        $('.closehide').show();
        $('.tablehideshow').hide();
        $('.btnhide').hide();

        form_clear();

    });

    $(document).on('click', '.closehide', function(e) {
        e.preventDefault();
        $('.btnhideshow').hide();
        $('.btnhide').show();
        $('.tablehideshow').show();
        $('.closehide').hide();
        location.href = baseurl + "manageorder";
        form_clear();

    });
    $(document).on('click', '#reset', function(e) {
        e.preventDefault();
        form_clear();
    });

    displayqutation();
    var editflag = 0;
    var delflag = 0;
    var exportflag = 0;

    function displayqutation() {
        for (var j = 0; j < arrayFromPHP.length; j++) {

            if (arrayFromPHP[j] == "editOrder") {
                editflag = 1;
            }
            if (arrayFromPHP[j] == "deleteOrder") {
                delflag = 1;
            }




        }

        $.ajax({
            type: 'POST',
            url: baseurl + "Quotation_order/getallorder",
            async: false,
            data: {


            },
            dataType: 'json',
            success: function(data) {

                var html = '';
                html += '<table id="mytable" class="table table-striped">' +
                    '<thead>' +
                    '<tr>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Customer Name</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Quotation No</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Sales Representative	</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Version</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Order No</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Ref. Number</th>' +

                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Order Date </th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Order Due Date</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none;">Description</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none;">Contact Person</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none;">Mobile No</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none;">Email</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none;">Total Order Value (without Tax)</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none;">Total Transfer Price (without Tax)</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none;">Less Input Tax if CST</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none;">Less Transporation</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none;">Less BG/Insurance Cost</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none;">Less others (if any)</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none;">MARGIN</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none;">Order Date</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none;">Order Due Date</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none;">Quoteno</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none;">Sales Representative ID</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none;">Customerid ID</th>' +

                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Status</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Action</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>';

                for (i = 0; i < data.length; i++) {
                    var sr = i + 1;
                    var status = "";
                    var date = "";
                    var odate = "";

                    var ordstatus = "";


                    if (data[i].order_status == 1) {
                        ordstatus = "Waiting";
                    } else if (data[i].order_status == 2) {
                        ordstatus = "Accepted";
                    } else if (data[i].order_status == 3) {
                        ordstatus = "Rejected";
                    }

                    var tdateAr = data[i].order_date.split('-');
                    date = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0];

                    var tdateAr = data[i].order_due_date.split('-');
                    odate = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0];
                    html += '<tr>' +
                        '<td id="customer_name_' + data[i].id + '">' + data[i].customer_name + '</td>' +
                        '<td id="quotation_no_' + data[i].id + '">' + data[i].quotation_no + '</td>' +
                        '<td id="salesrepresentivename_' + data[i].id + '">' + data[i].firstname + "" + data[i].last_name + '</td>' +
                        '<td  id="version_' + data[i].id + '">' + data[i].quote_lock_version + '</td>' +
                        '<td id="order_no_' + data[i].id + '">' + data[i].order_no + '</td>' +
                        '<td id="ref_number_' + data[i].id + '">' + data[i].ref_number + '</td>' +

                        '<td  id="date_' + data[i].id + '">' + date + '</td>' +
                        '<td id="odate_' + data[i].id + '">' + odate + '</td>' +
                        '<td style="display:none;" id="contact_person_' + data[i].id + '">' + data[i].contact_person + '</td>' +
                        '<td style="display:none;" id="mobile_no_' + data[i].id + '">' + data[i].mobile_no + '</td>' +
                        '<td style="display:none;" id="email_id_' + data[i].id + '">' + data[i].email_id + '</td>' +
                        '<td style="display:none;" id="order_date_' + data[i].id + '">' + data[i].order_date + '</td>' +
                        '<td style="display:none;" id="order_due_date_' + data[i].id + '">' + data[i].order_due_date + '</td>' +
                        '<td style="display:none;" id="description_' + data[i].id + '">' + data[i].description + '</td>' +
                        '<td style="display:none;" id="total_order_value_' + data[i].id + '">' + data[i].total_order_value + '</td>' +
                        '<td style="display:none;" id="total_trasfor_price_' + data[i].id + '">' + data[i].total_trasfor_price + '</td>' +
                        '<td style="display:none;" id="less_input_tax_' + data[i].id + '">' + data[i].less_input_tax + '</td>' +
                        '<td style="display:none;" id="less_trasportion_' + data[i].id + '">' + data[i].less_trasportion + '</td>' +
                        '<td style="display:none;" id="less_bg_' + data[i].id + '">' + data[i].less_bg + '</td>' +
                        '<td style="display:none;" id="less_others_' + data[i].id + '">' + data[i].less_others + '</td>' +
                        '<td style="display:none;" id="margin_' + data[i].id + '">' + data[i].margin + '</td>' +
                        '<td style="display:none;" id="qutone_no_' + data[i].id + '">' + data[i].qutone_no + '</td>' +
                        '<td style="display:none;" id="salesrepresentative_' + data[i].id + '">' + data[i].salesrepresentative + '</td>' +
                        '<td style="display:none;" id="customerid_' + data[i].id + '">' + data[i].customer_id + '</td>';
                    if (data[i].order_status == 1) {

                        html += '<td> <button  class="btn btn-sm btn-warning  btn-xs orderstatusinfo" id="quotestatus_' + data[i].id + '"   >' + ordstatus + '</button>&nbsp;</td>';

                    } else
                    if (data[i].order_status == 2) {
                        html += '<td> <button  class="btn btn-sm btn-success  btn-xs orderstatusinfo" id="quotestatus_' + data[i].id + '"   >' + ordstatus + '</button>&nbsp;</td>';
                    } else if (data[i].order_status == 3) {
                        html += '<td> <button  class="btn btn-sm btn-danger  btn-xs orderstatusinfo" id="quotestatus_' + data[i].id + '"   >' + ordstatus + '</button>&nbsp;</td>';
                    }



                    html += '<td>';
                    if (editflag == 1) {
                        html += '<button  class="edit_data btn btn-sm  btn-xs  btn-primary" id="edit_' + data[i].id + '"  name="' + data[i].order_status + '" ><i class="fa fa-edit"></i></button>&nbsp;';
                    }
                    if (delflag == 1) {
                        html += '<button name="delete" value="Delete" class="delete_data btn btn-xs btn-danger" id=' + data[i].id + '><i class="fa fa-trash"></i></button>';
                    }
                    if (editflag != 1 && delflag != 1) {

                        html += '-';
                    }

                    html += '</td>';






                    html += '</tr>';


                }

                html += '</tbody></table>';
                $('#show_master').html(html);
                // $('#mytable').DataTable({});
            }
        });
        getallversion();
    }

    $(document).on('click', '.edit_data', function(e) {
        e.preventDefault();

        var id1 = $(this).attr('id');
        id1 = id1.split("_");
        var orderstatus = $(this).attr('name');
        var html1 = '';


        $('.btnhideshow').show();
        $('.tablehideshow').hide();
        $('#searchversion').show();

        $('.btnhide').hide();

        $('.closehide').show();

        for (var j = 0; j < arrayFromPHP.length; j++) {


            if (arrayFromPHP[j] == "exportOrder") {

                exportflag = 1;

            }



        }




        if (orderstatus == "2" && exportflag == 1 && usertype == "SalesRepresentative" && userrole == "Sales") {

            $('#btnprint').show();
            $('#btnExport').show();
        } else if (usertype == "Admin") {
            $('#btnprint').show();
            $('#btnExport').show();
        }

        var customer_name = $('#customer_name_' + id1[1]).html();
        var order_no_ = $('#order_no_' + id1[1]).html();
        var ref_number = $('#ref_number_' + id1[1]).html();
        var contact_person_ = $('#contact_person_' + id1[1]).html();
        var mobile_no_ = $('#mobile_no_' + id1[1]).html();
        var email_id_ = $('#email_id_' + id1[1]).html();
        var order_date_ = $('#order_date_' + id1[1]).html();
        var order_due_date_ = $('#order_due_date_' + id1[1]).html();
        var description_ = $('#description_' + id1[1]).html();
        var total_order_value_ = $('#total_order_value_' + id1[1]).html();
        var total_trasfor_price_ = $('#total_trasfor_price_' + id1[1]).html();
        var less_input_tax_ = $('#less_input_tax_' + id1[1]).html();
        var less_trasportion_ = $('#less_trasportion_' + id1[1]).html();
        var less_bg_ = $('#less_bg_' + id1[1]).html();
        var less_others_ = $('#less_others_' + id1[1]).html();
        var margin_ = $('#margin_' + id1[1]).html();
        var version_ = $('#version_' + id1[1]).html();
        var qutone_no = $('#qutone_no_' + id1[1]).html();
        var quotation_no = $('#quotation_no_' + id1[1]).html();
        var salesrepresentative_ = $('#salesrepresentative_' + id1[1]).html();
        var salesrepresentivename = $('#salesrepresentivename_' + id1[1]).html();
        var customerid = $('#customerid_' + id1[1]).html();





        if (usertype == "SalesRepresentative" && userrole == "Sales") {

            $("#salesrepresentive1").val(salesrepresentivename);
        } else {
            if (salesrepresentative_ > 0) {
                $('#salesrepresentive').val(salesrepresentative_).trigger('change');
            }

        }


        $('#quatationid').val(qutone_no);
        $('#customerid').val(customerid);

        $('#cus_name').val(customer_name);
        $('#cotactperson').val(contact_person_);
        $('#phn').val(mobile_no_);
        $('#s_email').val(email_id_);
        $('#orderno').val(order_no_);
        $('#refno').val(ref_number);

        $('#o_date').val(order_date_);
        $('#o_due_date').val(order_due_date_);
        $('#description').val(description_);

        total_order_value_ = parseFloat(total_order_value_).toFixed(2);

        $('#finalordvalue').val(total_order_value_);
        $('#finaltrasforprice').val(total_trasfor_price_);
        $('#lesstaxcst').val(less_input_tax_);
        $('#lesstrasporation').val(less_trasportion_);
        $('#lessbg').val(less_bg_);
        $('#lessother').val(less_others_);
        $('#finalmargin').val(margin_);
        $('#save_update').val(id1[1]);

        // var html1 = '<option selected value="' + version_ + '" >' + version_ + '</option>';
        $('#search_version').text(version_);
        $('#quatation_no').text(quotation_no);

        $.ajax({
            type: "POST",
            url: baseurl + "Quotation_order/getorderstatuscheck",
            dataType: "JSON",
            data: {
                id: id1[1],

            },
            success: function(data1) {

                if (data1 == '100') {

                    $('#accepted').show();
                    $('#rejected').show();
                    $('#remarkdiv').hide();
                } else {
                    $('#remarkdiv').show();
                    $('#accepted').hide();
                    $('#rejected').hide();



                    if (data1[0].order_status == "2") {

                        $('#btnsave').hide();
                        $('#reset').hide();

                        $('#accepted').hide();
                        $('#rejected').hide();

                    } else {
                        $('#btnsave').show();
                        $('#reset').show();
                        if (usertype == "Admin") {
                            $('#accepted').show();
                            $('#rejected').show();
                        }
                    }

                    $('#remark').val(data1[0].remark);
                }
            }
        });



        $.ajax({
            type: "POST",
            url: baseurl + "Quotation_order/getproductdetalis",
            dataType: "JSON",
            data: {
                id: id1[1],

            },
            success: function(data) {
                $("#product_table tbody").html('');

                if (data.length > 0) {
                    var row_id = 0;
                    for (var i = 0; i < data.length; i++) {
                        row_id = row_id + 1;

                        var totaluniprice = parseFloat(data[i].qty) * parseFloat(data[i].unit_transfor_price);
                        var unittaxamt = parseFloat(data[i].transfor_tax) * parseFloat(totaluniprice) / 100;
                        var transforwithtax = parseFloat(unittaxamt) + parseFloat(totaluniprice);

                        var totalord = parseFloat(data[i].qty) * parseFloat(data[i].unit_order_value);
                        var ordtaxvalue = parseFloat(data[i].order_tax) * parseFloat(totalord) / 100;
                        var ordwithtax = parseFloat(totalord) + parseFloat(ordtaxvalue);

                        var margin = parseFloat(totalord) - parseFloat(totaluniprice);

                        var html = '<tr id="row_' + row_id + '"  class="producttbrow">' +


                            '<td><input type="text" placeholder="Product Name" name="P_Id[]" id="pid_' + row_id + '"  value="' + data[i].product_name + '" class="form-control product_name"></td>' +


                            '<td><input type="text" placeholder="Qty" name="P_Id[]" id="qty_' + row_id + '" value="' + data[i].qty + '"  class="form-control totalprice"></td>' +

                            '<td><input type="text" placeholder="UnitTransfer Price" name="P_Id[]" value="' + data[i].unit_transfor_price + '" id="unitprice_' + row_id + '" class="form-control totalprice"></td>' +

                            '<td><input type="text" placeholder="Total Transfer Price" name="P_Id[]" value="' + totaluniprice + '"  id="totaltransforprice_' + row_id + '" class="form-control"></td>' +

                            '<td><input type="text" placeholder="Tax (%)" name="P_Id[]" id="taxper_' + row_id + '"  value="' + data[i].transfor_tax + '" class="form-control gettaxamt"></td>' +


                            '<td><input type="text" placeholder="Tax (Rs)" name="P_Id[]" id="taxprice_' + row_id + '" value="' + unittaxamt + '" class="form-control"></td>' +

                            '<td><input type="text" placeholder="Total Transfer Price With Inc Tax" name="P_Qty[]" value="' + transforwithtax + '"  id="totalpricewithtax_' + row_id + '" class="form-control"></td>' +

                            '<td><input type="text" placeholder="Unit Ord Value" name="P_Rate[]" id="unitordvalue_' + row_id + '" value="' + data[i].unit_order_value + '"  class="form-control gettotalordvalue"></td>' +

                            '<td><input type="text" placeholder="Total Ord Value" name="P_Rate[]" id="totalordvalue_' + row_id + '" value="' + totalord + '"  class="form-control "></td>' +

                            '<td><input type="text" placeholder="Tax %" name="P_Tax[]" id="ptax_' + row_id + '" value="' + data[i].order_tax + '"  class="form-control getordtaxprice"></td>' +


                            '<td><input type="text" placeholder="Tax Rs" name="P_Tax_Rs[]" id="ptaxrs_' + row_id + '" value="' + ordtaxvalue + '" class="form-control" readonly></td>' +





                            '<td><input type="text" placeholder="Total Ord Val With Tax" name="P_Discount[]" id="totalodval_' + row_id + '" value="' + ordwithtax + '" class="form-control"></td>' +

                            '<td><input type="text" placeholder="Amount" name="P_TotalAmt[]" id="margin_' + row_id + '" value="' + margin + '" class="form-control"></td>' +

                            '<td><button type="button" id="row_' + row_id + '" class="btn btn-default deleterow" style="font-size: 12px; color:red" ><i class="fa fa-close"></i></button></td></tr>';



                        $("#product_table tbody").append(html);
                        $('#product_tbody').val(row_id);


                    }
                    getamt();
                    getallproduct();
                    get_all_margin();
                }

            }
        });

        $.ajax({
            type: "POST",
            url: baseurl + "Quotation_Estimate/getquotationversion",
            data: {
                id: id1,
            },
            dataType: "JSON",
            async: false,
            success: function(data) {
                console.log(data);
                var html = '';
                var name = '';
                //					if(table_name=="victim_age"){
                //					html += '<option selected  value="" >Select Victim Age</option>';
                //						}else{
                html += '<option  disabled value="" >Select</option>';
                //						}
                for (i = 0; i < data.length; i++) {
                    var id = '';

                    name = data[i].version;
                    id = data[i].version;

                    if (i == 0) {
                        html += '<option selected value="' + id + '" >' + name + '</option>';
                    } else {
                        html += '<option value="' + id + '" >' + name + '</option>';
                    }



                }
                $('#search_version').html(html);
            }
        });

        $.ajax({
            type: "POST",
            url: baseurl + "Quotation_order/getmilestoneinfo",
            data: {
                id: id1[1],
            },
            dataType: "JSON",
            async: false,
            success: function(data) {
                var row_id = 0;
                if (data.length > 0) {
                    var status = data[0].paymenttype;
                    if (status == 1) {

                        $('#amountinfo').bootstrapToggle('on');

                    } else {
                        $('#amountinfo').bootstrapToggle('off');
                        // $('#status').bootstrapToggle('off');
                    }
                    for (var i = 0; i < data.length; i++) {
                        row_id = row_id + 1;

                        markup = '<tr  class="paymentdatadata" id="paymentdata_' + row_id + '" >' +
                            '<td   id="expeid_' + row_id + '">' +
                            '<input type="text" id="paymentname_' + row_id + '" name="paymentname_' + row_id + '" value="' + data[i].payment_description + '"  class="form-control" placeholder="Payment Description">' +
                            '</td>' +


                            '<td>' +
                            '<input type="number" id="amount_' + row_id + '" name="amount_' + row_id + '"  class="form-control checkmilestone" value="' + data[i].amount + '"  placeholder="Milestone">' +

                            '</td>' +
                            '<td>&nbsp;<button  class="regional_delete_data1 btn btn-xs btn-danger"   id="paymentdata_' + row_id + '"  ><i class="fa fa-trash"></i></button>' +
                            '</tr>';
                        $("#paymenttbody").prepend(markup);
                        $('#paymentid').val(row_id);
                    }
                }
            }
        });

        var vesion = $('#search_version').val();



        $('#btnprint').val(id1[1]);
        $('#btnExport').val(id1[1]);





    });

    /*---------delete  area_master  start-----------------*/

    $(document).on('click', '.delete_data', function() {

        $("#myModal1").modal('show');
        var id1 = $(this).attr('id');
        $('#del_id').val(id1);


    });



    $(document).on('click', '#delete', function() {


        var id1 = $('#del_id').val();


        $.ajax({
            type: "POST",
            url: baseurl + "Quotation_Estimate/delete_master",
            dataType: "JSON",
            data: {
                id: id1,
                table_name: 'order_master',
            },
            success: function(data) {
                if (data == true) {
                    $("#myModal1").modal('hide');
                    $.notify({
                        title: '',
                        message: '<strong>Record Delete Successfully!!</strong>'
                    }, {
                        type: 'success'
                    });
                    displayqutation(); //call function show all product					
                }


            }
        });

    });

    /*---------delete  area_master  end-----------------*/

    $(document).on('change', '#search_version', function() {
        var version = $(this).val();
        var id = $('#save_update').val();

        $('#btnprint').val(id + "_" + version);
        $('#btnExport').val(id + "_" + version);


        $.ajax({
            type: "POST",
            url: baseurl + "Quotation_Estimate/getquationversionwise",
            dataType: "JSON",
            data: {
                version: version,
                id: id,

            },
            success: function(data) {
                $("#product_table tbody").html('');

                if (data.length > 0) {
                    var row_id = 0;
                    for (var i = 0; i < data.length; i++) {
                        row_id = row_id + 1;

                        var totaluniprice = parseFloat(data[i].qty) * parseFloat(data[i].unit_transfor_price);
                        var unittaxamt = parseFloat(data[i].transfor_tax) * parseFloat(totaluniprice) / 100;
                        var transforwithtax = parseFloat(unittaxamt) + parseFloat(totaluniprice);

                        var totalord = parseFloat(data[i].qty) * parseFloat(data[i].unit_order_value);
                        var ordtaxvalue = parseFloat(data[i].order_tax) * parseFloat(totalord) / 100;
                        var ordwithtax = parseFloat(totalord) + parseFloat(ordtaxvalue);

                        var margin = parseFloat(totalord) - parseFloat(totaluniprice);

                        var html = '<tr id="row_' + row_id + '"  class="producttbrow">' +


                            '<td><input type="text" placeholder="Product Name" name="P_Id[]" id="pid_' + row_id + '"  value="' + data[i].product_name + '" class="form-control product_name"></td>' +


                            '<td><input type="text" placeholder="Qty" name="P_Id[]" id="qty_' + row_id + '" value="' + data[i].qty + '"  class="form-control totalprice"></td>' +

                            '<td><input type="text" placeholder="UnitTransfer Price" name="P_Id[]" value="' + data[i].unit_transfor_price + '" id="unitprice_' + row_id + '" class="form-control totalprice"></td>' +

                            '<td><input type="text" placeholder="Total Transfer Price" name="P_Id[]" value="' + totaluniprice + '"  id="totaltransforprice_' + row_id + '" class="form-control" disabled></td>' +

                            '<td><input type="text" placeholder="Tax (%)" name="P_Id[]" id="taxper_' + row_id + '"  value="' + data[i].transfor_tax + '" class="form-control gettaxamt"></td>' +


                            '<td><input type="text" placeholder="Tax (Rs)" name="P_Id[]" id="taxprice_' + row_id + '" value="' + unittaxamt + '" class="form-control" disabled></td>' +

                            '<td><input type="text" placeholder="Total Transfer Price With Inc Tax" name="P_Qty[]" value="' + transforwithtax + '"  id="totalpricewithtax_' + row_id + '" class="form-control" disabled></td>' +

                            '<td><input type="text" placeholder="Unit Ord Value" name="P_Rate[]" id="unitordvalue_' + row_id + '" value="' + data[i].unit_order_value + '"  class="form-control gettotalordvalue"></td>' +

                            '<td><input type="text" placeholder="Total Ord Value" name="P_Rate[]" id="totalordvalue_' + row_id + '" value="' + totalord + '"  class="form-control " disabled></td>' +

                            '<td><input type="text" placeholder="Tax %" name="P_Tax[]" id="ptax_' + row_id + '" value="' + data[i].order_tax + '"  class="form-control getordtaxprice"></td>' +


                            '<td><input type="text" placeholder="Tax Rs" name="P_Tax_Rs[]" id="ptaxrs_' + row_id + '" value="' + ordtaxvalue + '" class="form-control" disabled></td>' +





                            '<td><input type="text" placeholder="Total Ord Val With Tax" name="P_Discount[]" id="totalodval_' + row_id + '" value="' + ordwithtax + '" class="form-control" disabled></td>' +

                            '<td><input type="text" placeholder="Amount" name="P_TotalAmt[]" id="margin_' + row_id + '" value="' + margin + '" class="form-control" disabled></td>' +

                            '<td><button type="button" id="row_' + row_id + '" class="btn btn-default deleterow" style="font-size: 12px; color:red" ><i class="fa fa-close"></i></button></td></tr>';

                        $("#product_table tbody").append(html);

                    }
                    getamt();
                    getallproduct();
                }
            }
        });
    });



    $(document).on('click', '#btnExport', function() {
        // let file = new Blob([$('#tblexport').html()], { type: "application/vnd.ms-excel" });
        // let url = URL.createObjectURL(file);
        // let a = $("<a />", {
        //     href: url,
        //     download: "filename.xls"
        // }).appendTo("body").get(0).click();

        // e.preventDefault();
        var id = $('#btnExport').val();
        $("#tblexporttbl").html('');

        if (id != "") {


            getexclefile(id);


        }



    });

    function getexclefile(vid) {


        var total_order_value = 0;
        var total_trasfor_price = 0;
        var less_input_tax = 0;
        var less_trasportion = 0;
        var less_bg = 0;
        var less_others = 0;
        var fmargin = 0;


        $.ajax({
            type: "POST",
            url: baseurl + "Quotation_order/getcustomerinfo",
            dataType: "JSON",
            data: {

                id: vid,

            },
            success: function(data) {


                total_order_value = data[0].total_order_value;
                total_trasfor_price = data[0].total_trasfor_price;
                less_input_tax = data[0].less_input_tax;
                less_trasportion = data[0].less_trasportion;
                less_bg = data[0].less_bg;
                less_others = data[0].less_others;
                fmargin = data[0].margin;

                var tdateAr = data[0].order_date.split('-');
                var date = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0];

                var tdateAr = data[0].order_due_date.split('-');
                var odate = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0];
                var exhtml = '<tr>' +
                    '<td colspan="2" style="white-space:nowrap;text-align:left;padding:10px 10px;">Customer Name:</td>' +
                    '<td colspan="2" style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[0].customer_name + '</td>' +
                    '<td colspan="2"  style="white-space:nowrap;text-align:left;padding:10px 10px;">Order Number :</td>' +
                    '<td colspan="2"  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[0].order_no + '</td>' +


                    '</tr>' +
                    '<tr>' +
                    '<td colspan="2"  style="white-space:nowrap;text-align:left;padding:10px 10px;">Contact Person:</td>' +
                    '<td colspan="2"  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[0].contact_person + '</td>' +
                    '<td colspan="2"  style="white-space:nowrap;text-align:left;padding:10px 10px;">Ref Number:</td>' +
                    '<td colspan="2"  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[0].ref_number + '</td>' +


                    '</tr>' +
                    '<tr>' +
                    '<td colspan="2"  style="white-space:nowrap;text-align:left;padding:10px 10px;">Mobile No:</td>' +
                    '<td colspan="2"  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[0].mobile_no + '</td>' +
                    '<td colspan="2"  style="white-space:nowrap;text-align:left;padding:10px 10px;">Order Date:</td>' +
                    '<td colspan="2"  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + date + '</td>' +


                    '</tr>' +
                    '<tr>' +
                    '<td colspan="2"  style="white-space:nowrap;text-align:left;padding:10px 10px;">Email:</td>' +
                    '<td colspan="2"  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[0].email_id + '</td>' +
                    '<td colspan="2"  style="white-space:nowrap;text-align:left;padding:10px 10px;">Order Due Date:</td>' +
                    '<td colspan="2"  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + odate + '</td>' +


                    '</tr>' +
                    '<tr>' +
                    '<td colspan="3"  style="white-space:nowrap;text-align:left;padding:10px 10px;">Description</td>' +
                    '<td colspan="1"   style="white-space:nowrap;text-align:left;padding:10px 10px;">Qty</td>' +
                    '<td  colspan="1" style="white-space:nowrap;text-align:left;padding:10px 10px;">UnitTransfer Price</td>' +
                    '<td colspan="1"  style="white-space:nowrap;text-align:left;padding:10px 10px;">Total Transfer Price</td>' +
                    '<td colspan="1"  style="white-space:nowrap;text-align:left;padding:10px 10px;">Tax (%)</td>' +
                    '<td colspan="1"  style="white-space:nowrap;text-align:left;padding:10px 10px;">Tax (Rs)</td>' +
                    '<td colspan="1"  style="white-space:nowrap;text-align:left;padding:10px 10px;">Total Transfer Price With Inc Tax</td>' +

                    '<td colspan="1"  style="white-space:nowrap;text-align:left;padding:10px 10px;">Unit Order Value</td>' +
                    '<td colspan="1"  style="white-space:nowrap;text-align:left;padding:10px 10px;">Total Ord Value</td>' +
                    '<td colspan="1"  style="white-space:nowrap;text-align:left;padding:10px 10px;">Tax %</td>' +
                    '<td colspan="1"  style="white-space:nowrap;text-align:left;padding:10px 10px;">Tax (Value)</td>' +
                    '<td colspan="1"  style="white-space:nowrap;text-align:left;padding:10px 10px;">Total Ord Val With Tax</td>' +
                    '<td colspan="1"  style="white-space:nowrap;text-align:left;padding:10px 10px;">Margin</td>' +


                    '</tr>';

                $("#tblexporttbl").append(exhtml);

                $.ajax({
                    type: "POST",
                    url: baseurl + "Quotation_order/getproductdetalis",
                    dataType: "JSON",
                    data: {

                        id: vid,

                    },
                    success: function(data) {

                        var finaltotaluniprice = 0;
                        var finalunittaxamt = 0;
                        var finaltransforwithtax = 0;
                        var finaltotalord = 0;
                        var finalordtaxvalue = 0;
                        var finalordwithtax = 0;
                        var finalordmargin = 0;

                        for (var i = 0; i < data.length; i++) {

                            var totaluniprice = parseFloat(data[i].qty) * parseFloat(data[i].unit_transfor_price);
                            var unittaxamt = parseFloat(data[i].transfor_tax) * parseFloat(totaluniprice) / 100;
                            var transforwithtax = parseFloat(unittaxamt) + parseFloat(totaluniprice);

                            var totalord = parseFloat(data[i].qty) * parseFloat(data[i].unit_order_value);
                            var ordtaxvalue = parseFloat(data[i].order_tax) * parseFloat(totalord) / 100;
                            var ordwithtax = parseFloat(totalord) + parseFloat(ordtaxvalue);

                            var margin = parseFloat(totalord) - parseFloat(totaluniprice);

                            finaltotaluniprice = parseFloat(finaltotaluniprice) + parseFloat(totaluniprice);
                            finalunittaxamt = parseFloat(finalunittaxamt) + parseFloat(unittaxamt);
                            finaltransforwithtax = parseFloat(finaltransforwithtax) + parseFloat(transforwithtax);
                            finaltotalord = parseFloat(totalord) + parseFloat(finaltotalord);
                            finalordtaxvalue = parseFloat(ordtaxvalue) + parseFloat(finalordtaxvalue);
                            finalordwithtax = parseFloat(ordwithtax) + parseFloat(finalordwithtax);
                            finalordmargin = parseFloat(finalordmargin) + parseFloat(margin);

                            var html1 = '<tr>' +
                                '<td colspan="3"  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].product_name + '</td>' +
                                '<td colspan="1"   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].qty + '</td>' +
                                '<td  colspan="1" style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].unit_transfor_price + '</td>' +
                                '<td colspan="1"  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + totaluniprice + '</td>' +
                                '<td colspan="1"  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].transfor_tax + '</td>' +
                                '<td colspan="1"  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + unittaxamt + '</td>' +
                                '<td colspan="1"  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + transforwithtax + '</td>' +
                                '<td colspan="1"  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].unit_order_value + '</td>' +

                                '<td colspan="1"  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + totalord + '</td>' +
                                '<td colspan="1"  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].order_tax + '</td>' +
                                '<td colspan="1"  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + ordtaxvalue + '</td>' +
                                '<td colspan="1"  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + ordwithtax + '</td>' +
                                '<td colspan="1"  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + margin + '</td>' +


                                '</tr>';
                            $("#tblexporttbl").append(html1);
                        }

                        var html3 = '<tr>' +
                            '<td colspan="3"  style="white-space:nowrap;text-align:left;padding:10px 10px;"></td>' +
                            '<td colspan="1"   style="white-space:nowrap;text-align:left;padding:10px 10px;"></td>' +
                            '<td  colspan="1" style="white-space:nowrap;text-align:left;padding:10px 10px;"></td>' +
                            '<td colspan="1"  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + finaltotaluniprice + '</td>' +
                            '<td colspan="1"  style="white-space:nowrap;text-align:left;padding:10px 10px;"></td>' +
                            '<td colspan="1"  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + finalunittaxamt + '</td>' +
                            '<td colspan="1"  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + finaltransforwithtax + '</td>' +
                            '<td colspan="1"  style="white-space:nowrap;text-align:left;padding:10px 10px;"></td>' +

                            '<td colspan="1"  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + finaltotalord + '</td>' +
                            '<td colspan="1"  style="white-space:nowrap;text-align:left;padding:10px 10px;"></td>' +
                            '<td colspan="1"  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + finalordtaxvalue + '</td>' +
                            '<td colspan="1"  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + finalordwithtax + '</td>' +
                            '<td colspan="1"  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + finalordmargin + '</td>' +


                            '</tr>';
                        $("#tblexporttbl").append(html3);
                        var html2 = '<tr>' +
                            '<td colspan="2" style="white-space:nowrap;text-align:left;padding:10px 10px;"></td>' +
                            '<td colspan="2" style="white-space:nowrap;text-align:left;padding:10px 10px;"></td>' +
                            '<td colspan="2"  style="white-space:nowrap;text-align:left;padding:10px 10px;">Total Order Value(Rs) (without Tax):</td>' +
                            '<td colspan="2"  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + total_order_value + '</td>' +


                            '</tr>' +
                            '<tr>' +
                            '<td colspan="2" style="white-space:nowrap;text-align:left;padding:10px 10px;"></td>' +
                            '<td colspan="2" style="white-space:nowrap;text-align:left;padding:10px 10px;"></td>' +
                            '<td colspan="2"  style="white-space:nowrap;text-align:left;padding:10px 10px;">Total Transfer Price(Rs) (without Tax):</td>' +
                            '<td colspan="2"  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + total_trasfor_price + '</td>' +


                            '</tr>' +
                            '<tr>' +
                            '<td colspan="2" style="white-space:nowrap;text-align:left;padding:10px 10px;"></td>' +
                            '<td colspan="2" style="white-space:nowrap;text-align:left;padding:10px 10px;"></td>' +
                            '<td colspan="2"  style="white-space:nowrap;text-align:left;padding:10px 10px;">Less Input Tax if CST(Rs):</td>' +
                            '<td colspan="2"  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + less_input_tax + '</td>' +


                            '</tr>' +
                            '<tr>' +
                            '<td colspan="2" style="white-space:nowrap;text-align:left;padding:10px 10px;"></td>' +
                            '<td colspan="2" style="white-space:nowrap;text-align:left;padding:10px 10px;"></td>' +
                            '<td colspan="2"  style="white-space:nowrap;text-align:left;padding:10px 10px;">Less Transporation(Rs):</td>' +
                            '<td colspan="2"  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + less_trasportion + '</td>' +


                            '</tr>' +
                            '<tr>' +
                            '<td colspan="2" style="white-space:nowrap;text-align:left;padding:10px 10px;"></td>' +
                            '<td colspan="2" style="white-space:nowrap;text-align:left;padding:10px 10px;"></td>' +
                            '<td colspan="2"  style="white-space:nowrap;text-align:left;padding:10px 10px;">Less BG/Insurance Cost(Rs):</td>' +
                            '<td colspan="2"  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + less_bg + '</td>' +


                            '</tr>' +
                            '<tr>' +
                            '<td colspan="2" style="white-space:nowrap;text-align:left;padding:10px 10px;"></td>' +
                            '<td colspan="2" style="white-space:nowrap;text-align:left;padding:10px 10px;"></td>' +
                            '<td colspan="2"  style="white-space:nowrap;text-align:left;padding:10px 10px;">Less others(Rs) (if any):</td>' +
                            '<td colspan="2"  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + less_others + '</td>' +


                            '</tr>' +
                            '<tr>' +
                            '<td colspan="2" style="white-space:nowrap;text-align:left;padding:10px 10px;"></td>' +
                            '<td colspan="2" style="white-space:nowrap;text-align:left;padding:10px 10px;"></td>' +
                            '<td colspan="2"  style="white-space:nowrap;text-align:left;padding:10px 10px;">MARGIN:</td>' +
                            '<td colspan="2"  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + fmargin + '</td>' +


                            '</tr>';
                        $("#tblexporttbl").append(html2);

                        $("#tblexport").table2excel({
                            name: "Table2Excel",
                            filename: "quotation.xls"
                                //fileext: "."
                        });

                    }
                });


            }

        });





    }
    //function for getting all version 

    function getallversion() {
        $(".latestversion").each(function() {
            var id = $(this).attr('id');
            var getid = id;
            var id = id.split("_");


            $.ajax({
                type: "POST",
                url: baseurl + "Quotation_Estimate/getquotationversion",
                data: {
                    id: id[1],
                },
                dataType: "JSON",
                async: false,
                success: function(data) {
                    console.log(data);

                    var html = '';
                    var name = '';
                    //					if(table_name=="victim_age"){
                    //					html += '<option selected  value="" >Select Victim Age</option>';
                    //						}else{
                    html += '<option  disabled value="" >Select</option>';
                    //						}
                    for (i = 0; i < data.length; i++) {
                        var id = '';

                        name = data[i].version;
                        id = data[i].version;

                        if (i == 0) {
                            html += '<option selected value="' + id + '" >' + name + '</option>';
                        } else {
                            html += '<option value="' + id + '" >' + name + '</option>';
                        }



                    }
                    $('#' + getid).html(html);
                }
            });
            $.ajax({
                type: "POST",
                url: baseurl + "Quotation_Estimate/getquotationselect",
                data: {
                    id: id[1],
                },
                dataType: "JSON",
                async: false,
                success: function(data) {
                    if (data[0].quote_lock_version > 0) {
                        $('#' + getid).val(data[0].quote_lock_version).trigger('change');
                        $("#" + getid).attr("disabled", "disabled");
                    }

                }
            });
        });
    }


    //for changeing quote status
    $(document).on('change', '.quotestatus', function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        var status = $(this).val();
        id = id.split("_");

        var lversion = $('#latestversion_' + id[1]).val();

        $.ajax({
            type: "POST",
            url: baseurl + "Quotation_Estimate/updatequotestatus",
            data: {
                id: id[1],
                lversion: lversion,
                status: status,
            },
            dataType: "JSON",
            async: false,
            success: function(data) {

                if (data == true) {
                    $.notify({
                        title: '',
                        message: '<strong>Change Status Success Fully  !!</strong>'
                    }, {
                        type: 'success'
                    });
                    displayqutation();
                }



            }
        });




    });

    //  
    $(document).on('click', '.getorder', function(e) {
        e.preventDefault();

        var id = $(this).attr('id');


        location.href = baseurl + "Quotation_Estimate/getorderinfo/?quotation_id=" + id;

        // $.ajax({
        //     type: "POST",
        //     url: baseurl + "Quotation_Estimate/getorderinfo",
        //     data: {
        //         id: id,

        //     },
        //     dataType: "html",
        //     async: false,
        //     success: function(data) {
        //         $('#body').html(data);
        //     }
        // });
    });

    $(document).on('click', '.stausapproved', function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        var status = 0;
        if (id == "accepted") {
            status = 2;
        } else {
            status = 3;
        }
        $('#status_hidden').val(status);
        $('#myModal2').modal('show');
        var saveid = $('#save_update').val();

        $('#order_id_hidden').val(saveid);



    });
    //for change status by admin user

    $(document).on('submit', '#changeststus_form', function(e) {
        e.preventDefault();
        var statusremark = $('#statsusremark').val();
        var order_id = $('#order_id_hidden').val();
        var status = $('#status_hidden').val();

        $.ajax({
            type: "POST",
            url: baseurl + "Quotation_order/updateorderstatus",
            data: {
                id: order_id,
                statusremark: statusremark,
                status: status,
            },
            dataType: "JSON",
            async: false,
            success: function(data) {

                if (data == true) {
                    $.notify({
                        title: '',
                        message: '<strong>Change Status Success Fully  !!</strong>'
                    }, {
                        type: 'success'
                    });
                    $('#myModal2').modal('hide');
                    displayqutation();
                    $('#accepted').hide();
                    $('#rejected').hide();
                }



            }
        });
    });

    $(document).on('click', '.orderstatusinfo', function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        id = id.split("_");
        var text = $(this).text();
        if (text != "Waiting") {
            $('#myModal3').modal('show');
            $.ajax({
                type: "POST",
                url: baseurl + "Quotation_order/getorderemark",
                data: {
                    id: id[1],

                },
                dataType: "JSON",
                async: false,
                success: function(data) {

                    $('#statsusinforemark').val(data[0].remark)


                }
            });
        }

    });


    if (quatationid1 > 0) {
        $('#edit_' + quatationid1).trigger('click');

    }
    getMasterSelect('user_creation', '#salesrepresentive');

    function getMasterSelect(table_name, selecter) {

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
                for (i = 0; i < data.length; i++) {
                    var id = '';

                    name = data[i].first_name + " " + data[i].last_name;
                    id = data[i].id;





                    //alert(name);

                    if (usertype == "SalesRepresentative") {
                        if (id == useruniqueid) {
                            html += '<option selected value="' + id + '" >' + name + '</option>';
                        } else {
                            html += '<option value="' + id + '" >' + name + '</option>';
                        }
                    } else {
                        html += '<option value="' + id + '" >' + name + '</option>'; //last changes here
                    }



                }
                $(selecter).html(html);
            }
        });

    }

    function addpaymentinfo() {

        var row_id = $('#paymentid').val();
        row_id = parseInt(row_id) + 1;

        markup = '<tr  class="paymentdatadata" id="paymentdata_' + row_id + '" >' +
            '<td   id="expeid_' + row_id + '">' +
            '<input type="text" id="paymentname_' + row_id + '" name="paymentname_' + row_id + '"  class="form-control" placeholder="Payment Description">' +
            '</td>' +


            '<td>' +
            '<input type="text" id="amount_' + row_id + '" name="amount_' + row_id + '"  class="form-control checkmilestone" value="0" placeholder="Milestone">' +

            '</td>' +
            '<td>&nbsp;<button  class="regional_delete_data1 btn btn-xs btn-danger"   id="paymentdata_' + row_id + '"  ><i class="fa fa-trash"></i></button>' +
            '</tr>';
        $("#paymenttbody").prepend(markup);
        $('#paymentid').val(row_id);


    }
    $(document).on('click', '#add_payment', function(e) {
        addpaymentinfo();
    });

    $(document).on('click', '.regional_delete_data1', function(e) {
        e.preventDefault();
        var save_update = $(this).attr('id');
        save_update = save_update.split("_")[1];

        var rowCount = $('#paymenttb >tbody >tr').length;

        if (rowCount > 1) {
            console.log(save_update);
            if (save_update != "") {
                $("#paymentdata_" + save_update).remove();
                console.log("#paymentdata_" + save_update);

            }
        } else {
            $.notify({
                title: '',
                message: '<strong>One Payment is Required !!</strong>'
            }, {
                type: 'success'
            });
        }
        getamountmilestone();

    });
    $(document).on('blur', '.checkmilestone', function(e) {
        e.preventDefault();
        getamountmilestone();
    });



    function getamountmilestone() {
        var amt = 0;
        if ($('#amountinfo').is(":checked")) {

            amt = 1;
        } else {
            amt = 0;
        }
        var finalorder = $('#finalordvalue').val();
        var perinfo = 0;
        $(".paymentdatadata").each(function() {
            var id = $(this).attr('id');
            id = id.split("_");

            var newamt = $('#amount_' + id[1]).val();
            perinfo = parseFloat(perinfo) + parseFloat(newamt);


        });

        if (amt == 1) {
            if (perinfo > 100) {
                $.notify({
                    title: '',
                    message: '<strong>Milestone Not Grather than 100% !!</strong>'
                }, {
                    type: 'success'
                });
                $('#savemilestone').attr('disabled', true)
            } else {
                $('#savemilestone').attr('disabled', false)
            }
        } else if (amt == 0) {
            if (perinfo > finalorder) {
                $.notify({
                    title: '',
                    message: '<strong>Milestone Not Grather than Total Order Value !!</strong>'
                }, {
                    type: 'success'
                });
                $('#savemilestone').attr('disabled', true)
            } else {
                $('#savemilestone').attr('disabled', false)
            }
        }

    }
    $(document).on('click', '#savemilestone', function(e) {
        e.preventDefault();

        studejsonObj = [];
        var amt = 0;
        var id = $('#save_update').val();
        $('#wait1').hide();

        $('#savemilestone').attr('disabled', true);
        if ($('#amountinfo').is(":checked")) {

            amt = 1;
        } else {
            amt = 0;
        }

        $(".paymentdatadata").each(function() {
            var id1 = $(this).attr('id');
            console.log(id1);

            id1 = id1.split("_");


            student = {};

            var paymentname_ = $('#paymentname_' + id1[1]).val();
            var amount_ = $('#amount_' + id1[1]).val();


            student["paymentname"] = paymentname_;
            student["amount"] = amount_;
            student["amt"] = amt;

            studejsonObj.push(student);


        });
        console.log("studejsonObj" + studejsonObj);

        $.ajax({
            type: "POST",
            url: baseurl + "Quotation_order/save_payment",
            dataType: "JSON",
            async: false,
            data: {
                id: id,
                studejsonObj: studejsonObj,
            },
            success: function(data) {
                $('#wait1').hide();
                $('#savemilestone').attr('disabled', false);
                $.notify({
                    title: '',
                    message: '<strong>Milestone Save SucessFully !!</strong>'
                }, {
                    type: 'success'
                });
            }
        });


    });







});