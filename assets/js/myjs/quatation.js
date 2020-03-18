$(document).ready(function() {

    var table_name = "quotation_master";

    if (usertype == "SalesRepresentative" && userrole == "Sales") {
        $("#salesrepresentive").attr("required", false);

        $.ajax({
            type: 'POST',
            url: baseurl + "Quotation_Estimate/get_salespername",
            async: false,
            data: {
                useruniqueid: useruniqueid,
            },
            dataType: 'json',
            success: function(data) {
                $('#salesrepresentive1').val(data[0].first_name + "" + data[0].last_name);
            }
        });

    } else {

        $("#salesrepresentive").attr("required", true);
    }


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

            '<td><input type="text" placeholder="OEM" name="P_Id[]" id="ovm_' + row_id + '" class="form-control ovmnm"></td>' +

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
        getallovm();
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

                var product = [];
                for (var i = 0; i < data.length; i++) {
                    productnm = data[i].ovmname;

                    product.push(productnm);
                }

                // $(".product_name").autocomplete({
                //     source: ["PHP", "JQuery", "JavaScript", "HTML", "ASP", "Perl", "MySQL", "Access", "Excel", "Dot Net"],
                //     autoFocus: true
                // });

                console.log(product);
                $(".ovmnm").autocomplete({
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
                                } else if (data > 0) {
                                    $('#cotactperson').val('');
                                    $('#phn').val('');
                                    $('#s_email').val('');
                                    $('#customerid').val(data);
                                } else {

                                    $('#customerid').val(data[0].account_id);
                                    $('#cotactperson').val(data[0].contact_name);
                                    $('#phn').val(data[0].mobile_no);
                                    $('#s_email').val(data[0].email_id);

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
    $(document).on("submit", "#quotation_form", function(e) {
        e.preventDefault();

        $('#btn_submit_quotation').attr('disabled', true);
        $('#wait').show();




        var cus_name = $('#cus_name').val();
        var cotactperson = $('#cotactperson').val();
        var phn = $('#phn').val();
        var s_email = $('#s_email').val();
        var bill_no = $('#bill_no').val();
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
        var salesrepresentive = $('#salesrepresentive').val();
        var customerid = $('#customerid').val();

        console.log(customerid);


        if (usertype == "SalesRepresentative" && userrole == "Sales") {
            salesrepresentive = useruniqueid;
        }

        var flag = 0;

        var today = new Date();
        var dd = today.getDate();

        var mm = today.getMonth() + 1;
        var yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd;
        }

        if (mm < 10) {
            mm = '0' + mm;
        }
        o_date = yyyy + '-' + mm + '-' + dd;



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

                var ovm = $('#ovm_' + id1[1]).val();
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
                    student["ovmname"] = ovm;

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
                    url: baseurl + "Quotation_Estimate/save_settings",
                    dataType: "JSON",
                    async: false,
                    data: {
                        id: id,
                        cus_name: cus_name,
                        cotactperson: cotactperson,
                        phn: phn,
                        s_email: s_email,
                        bill_no: bill_no,
                        refno: refno,
                        o_date: o_date,
                        o_due_date: o_due_date,
                        description: description,
                        studejsonObj: studejsonObj,

                        finalordervalue: finalordervalue,
                        finaltrasforprice: finaltrasforprice,
                        lesstaxcst: lesstaxcst,
                        lesstrasporation: lesstrasporation,
                        lessbg: lessbg,
                        lessother: lessother,
                        finalmargin: finalmargin,
                        table_name: table_name,
                        salesrepresentive: salesrepresentive,
                        customerid: customerid,

                    },
                    success: function(data) {
                        console.log(data);
                        $('#btn_submit_quotation').attr('disabled', false);
                        $('#wait').hide();
                        if (data > 0) {
                            $.notify({
                                title: '',
                                message: '<strong>Data saved successfully</strong>'
                            }, {
                                type: 'success'
                            });
                            if (id == "") {

                                $('#save_update').val(data);
                                $('#btnprint').val(data);
                                $('#btnExport').val(data);
                                $('#btnprint').show();
                                $('#btnExport').show();
                                $('#btnmailsend').show();
                                $('#tbcustomer').trigger('click');
                                var qid = data;
                                $.ajax({
                                    type: "POST",
                                    url: baseurl + "Quotation_Estimate/getquotationnodata",
                                    dataType: "JSON",
                                    data: {
                                        id: qid,

                                    },
                                    success: function(data1) {
                                        $('#bill_no').val(data1[0].quotaion_no);
                                    }
                                });



                            } else {
                                $('.btnhideshow').hide();
                                $('.tablehideshow').show();
                                $('.btnhide').show();
                                $('.closehide').hide();
                                form_clear();
                            }

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
        $('#customerid').val('');
        $('#cus_name').val('');
        $('#cotactperson').val('');
        $('#phn').val('');
        $('#s_email').val('');
        $('#bill_no').val('');
        $('#refno').val('');
        $('#Tax').val('');
        // $('#o_date').val('');
        $('#o_due_date').val('');
        $('#description').val('');

        $('#finalordvalue').val('');
        $('#finaltrasforprice').val('');
        $('#lesstaxcst').val('0');
        $('#lesstrasporation').val('0');
        $('#lessbg').val('0');
        $('#lessother').val('0');
        $('#finalmargin').val('0');
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

        var today = new Date();
        var dd = today.getDate();

        var mm = today.getMonth() + 1;
        var yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd;
        }

        if (mm < 10) {
            mm = '0' + mm;
        }
        today = yyyy + '-' + mm + '-' + dd;


        $("#o_date").val(today);

    }

    $(document).on('click', '.btnhide', function(e) {
        e.preventDefault();
        $('.btnhideshow').show();
        $('.closehide').show();
        $('.tablehideshow').hide();
        $('.btnhide').hide();
        $('#btnmailsend').hide();

        form_clear();
        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if (month < 10)
            month = '0' + month.toString();
        if (day < 10)
            day = '0' + day.toString();

        var minDate = year + '-' + month + '-' + day;

        $('#o_due_date').attr('min', minDate);
        getqutationno();

    });

    $(document).on('click', '.closehide', function(e) {
        e.preventDefault();
        $('.btnhideshow').hide();
        $('#sendemail_div').hide();
        $('.btnhide').show();
        $('.tablehideshow').show();
        $('.closehide').hide();
        form_clear();
        getqutationno();

    });
    $(document).on('click', '#reset', function(e) {
        e.preventDefault();
        form_clear();
    });

    displayqutation();
    var editflag = 0;
    var delflag = 0;
    var createorderflag = 0;

    function displayqutation() {

        for (var j = 0; j < arrayFromPHP.length; j++) {

            if (arrayFromPHP[j] == "editQuotation") {
                editflag = 1;
            }
            if (arrayFromPHP[j] == "deleteQuotation") {
                delflag = 1;
            }
            if (arrayFromPHP[j] == "createOrder") {
                createorderflag = 1;
            }

        }

        $.ajax({
            type: 'POST',
            url: baseurl + "Quotation_Estimate/getallquatatyion",
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
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Quotation Number</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Sales Representative</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Ref Number</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Version</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Quotation Date </th>' +
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
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none;">Order Due Date</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none;">Customer Id</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Remark</th>' +
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



                    var tdateAr = data[i].order_date.split('-');
                    date = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0];

                    var tdateAr = data[i].order_due_date.split('-');
                    odate = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0];
                    html += '<tr>' +
                        '<td id="customer_name_' + data[i].id + '">' + data[i].customer_name + '</td>' +
                        '<td class="quotationnoversion" id="quotaion_no_' + data[i].id + '">' + data[i].quotaion_no + '</td>' +
                        '<td id="salesrepresent_' + data[i].id + '">' + data[i].firstname + "" + data[i].last_name + '</td>' +
                        '<td id="ref_number_' + data[i].id + '">' + data[i].ref_number + '</td>' +
                        '<td> <select name="latestversion_' + data[i].id + '" id="latestversion_' + data[i].id + '" class="form-control latestversion"></select></td>' +
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
                        '<td style="display:none;" id="salesperson_' + data[i].id + '">' + data[i].salesperson + '</td>' +
                        '<td style="display:none;" id="customer_id_' + data[i].id + '">' + data[i].customer_id + '</td>' +
                        '<td id="remark_' + data[i].id + '">' + data[i].remark + '</td>';

                    // if (data[i].quote_status == 1) {
                    //     html += '<td> <select name="quotestatus_' + data[i].id + '" id="quotestatus_' + data[i].id + '" class="form-control quotestatus"><option disabled>select</option><option value="1" selected>Pending</option><option value="2">Confirm</option><option value="3">Cancel</option></select</td>';
                    // } else if (data[i].quote_status == 2) {
                    //     html += '<td> <select disabled name="quotestatus_' + data[i].id + '" id="quotestatus_' + data[i].id + '" class="form-control quotestatus"><option disabled>select</option><option value="1">Pending</option><option value="2" selected>Confirm</option><option value="3">Cancel</option></select</td>';
                    // } else {
                    //     html += '<td> <select disabled name="quotestatus_' + data[i].id + '" id="quotestatus_' + data[i].id + '" class="form-control quotestatus"><option disabled>select</option><option value="1">Pending</option><option value="2">Confirm</option><option value="3" selected>Cancel</option></select</td>';
                    // }

                    if (data[i].quote_status == 1) {
                        html += '<td> <button  class="btn btn-sm btn-warning  btn-xs  changestatusmodel" id="quotestatus_' + data[i].id + '"   >Identified</button>&nbsp;</td>';
                    } else if (data[i].quote_status == 2) {
                        html += '<td> <button  class="btn btn-sm btn-success  btn-xs  changestatusmodel" id="quotestatus_' + data[i].id + '"    >Order Won</button>&nbsp;</td>';
                    } else if (data[i].quote_status == 3) {
                        html += '<td> <button  class="btn btn-sm btn-danger btn-xs  changestatusmodel" id="quotestatus_' + data[i].id + '"   >Order Lost</button>&nbsp;</td>';
                    } else if (data[i].quote_status == 4) {
                        html += '<td> <button  class="btn btn-sm btn-info btn-xs  changestatusmodel" id="quotestatus_' + data[i].id + '"   >Quoted</button>&nbsp;</td>';
                    } else if (data[i].quote_status == 5) {
                        html += '<td> <button  class="btn btn-sm btn-primary btn-xs  changestatusmodel" id="quotestatus_' + data[i].id + '"   >Qualified</button>&nbsp;</td>';
                    } else if (data[i].quote_status == 6) {
                        html += '<td> <button  class="btn btn-sm btn-primary btn-xs  changestatusmodel" id="quotestatus_' + data[i].id + '"   >Negotiation</button>&nbsp;</td>';
                    } else if (data[i].quote_status == 7) {
                        html += '<td> <button  class="btn btn-sm btn-danger btn-xs  changestatusmodel" id="quotestatus_' + data[i].id + '"   >Opportunity Dropped</button>&nbsp;</td>';
                    }


                    // html += '< /td>';

                    if (data[i].quote_status == 1 || data[i].quote_status == 4 || data[i].quote_status == 5 || data[i].quote_status == 6) {

                        html += ' <td>';
                        if (editflag == 1) {

                            html += '<button  class="edit_data btn btn-sm  btn-xs  btn-primary" id="' + data[i].id + '"  ><i class="fa fa-edit"></i></button>&nbsp;';
                        }
                        if (delflag == 1) {
                            html += '<button name="delete" value="Delete" class="delete_data btn btn-xs btn-danger" id=' +
                                data[i].id + '><i class="fa fa-trash"></i></button>';
                        }
                        html += '</td>';
                    } else if (data[i].quote_status == 2) {
                        if (createorderflag == 1) {
                            html += '<td><button  class="getorder btn btn-sm  btn-xs  btn-primary" id="' + data[i].id + '"  ><i class="fa fa-shopping-cart"></i></button></td>';
                        } else {
                            html += "<td>-</td>";
                        }


                    } else {
                        // html += "-";
                        html += "<td>-</td>";
                    }

                    html += '</tr>';


                }

                html += '</tbody></table>';
                $('#show_master').html(html);
                // $('#mytable').DataTable({
                //     "fnDrawCallback": function() { //for display for bootstraptoggle button
                //         // jQuery('#mytable .latestversion').dropdown();
                //         responsive: true;
                //     }
                // });
            }
        });
        getallversion();

    }

    $(document).on('click', '.edit_data', function(e) {
        e.preventDefault();

        var id1 = $(this).attr('id');
        var html1 = '';


        $('.btnhideshow').show();
        $('.tablehideshow').hide();
        $('#searchversion').show();
        $('#btnmailsend').show();

        $('.btnhide').hide();

        $('.closehide').show();


        $('#btnprint').show();
        $('#btnExport').show();

        $('#tbcustomer').trigger('click');

        var customer_name = $('#customer_name_' + id1).html();
        var quotaion_no = $('#quotaion_no_' + id1).html();
        var ref_number = $('#ref_number_' + id1).html();
        var contact_person_ = $('#contact_person_' + id1).html();
        var mobile_no_ = $('#mobile_no_' + id1).html();
        var email_id_ = $('#email_id_' + id1).html();
        var order_date_ = $('#order_date_' + id1).html();
        var order_due_date_ = $('#order_due_date_' + id1).html();
        var description_ = $('#description_' + id1).html();
        var total_order_value_ = $('#total_order_value_' + id1).html();
        var total_trasfor_price_ = $('#total_trasfor_price_' + id1).html();
        var less_input_tax_ = $('#less_input_tax_' + id1).html();
        var less_trasportion_ = $('#less_trasportion_' + id1).html();
        var less_bg_ = $('#less_bg_' + id1).html();
        var less_others_ = $('#less_others_' + id1).html();
        var margin_ = $('#margin_' + id1).html();
        var salesperson = $('#salesperson_' + id1).html();
        var salesrepresent = $('#salesrepresent_' + id1).html();
        var customer_id = $('#customer_id_' + id1).html();

        $('#cus_name').val(customer_name);
        $('#cotactperson').val(contact_person_);
        $('#phn').val(mobile_no_);
        $('#s_email').val(email_id_);
        $('#bill_no').val(quotaion_no);
        $('#refno').val(ref_number);
        $('#customerid').val(customer_id);

        //$('#o_date').val(order_date_);
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


        if (usertype == "SalesRepresentative" && userrole == "Sales") {

            $("#salesrepresentive1").val(salesrepresent);
        } else {
            $('#salesrepresentive').val(salesperson).trigger('change');
        }


        $('#save_update').val(id1);

        var today = new Date();
        var dd = today.getDate();

        var mm = today.getMonth() + 1;
        var yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd;
        }

        if (mm < 10) {
            mm = '0' + mm;
        }
        today = yyyy + '-' + mm + '-' + dd;


        $("#o_date").val(today);



        $.ajax({
            type: "POST",
            url: baseurl + "Quotation_Estimate/getquatationdetalis",
            dataType: "JSON",
            data: {
                id: id1,

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

                            '<td><input type="text" placeholder="OEM" name="P_Id[]" id="ovm_' + row_id + '" class="form-control ovmnm" value="' + data[i].ovmnm + '"></td>' +

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
                    getallovm();
                    get_all_margin();

                }

            }
        });

        $.ajax({
            type: "POST",
            url: baseurl + "Quotation_Estimate/getquotationversion",
            data: {
                id: quotaion_no,
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

        var vesion = $('#search_version').val();



        $('#btnprint').val(id1);
        $('#btnExport').val(id1);



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
                table_name: 'quotation_master',
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
        var bill_no = $('#bill_no').val();





        $.ajax({
            type: "POST",
            url: baseurl + "Quotation_Estimate/getquationvesiondata",
            dataType: "JSON",
            data: {
                version: version,
                bill_no: bill_no,

            },
            success: function(data) {


                $('#btnprint').val(data[0].id);
                $('#btnExport').val(data[0].id);
                $('#cus_name').val(data[0].customer_name);
                $('#cotactperson').val(data[0].contact_person);
                $('#phn').val(data[0].mobile_no);
                $('#s_email').val(data[0].email_id);
                $('#bill_no').val(data[0].quotaion_no);
                $('#refno').val(data[0].ref_number);
                $('#customerid').val(data[0].customer_id);

                //$('#o_date').val(order_date_);
                $('#o_due_date').val(data[0].order_due_date);
                $('#description').val(data[0].description);



                $('#finalordvalue').val(data[0].total_order_value);
                $('#finaltrasforprice').val(data[0].total_trasfor_price);
                $('#lesstaxcst').val(data[0].less_input_tax);
                $('#lesstrasporation').val(data[0].less_trasportion);
                $('#lessbg').val(data[0].less_bg);
                $('#lessother').val(data[0].less_others);
                $('#finalmargin').val(data[0].margin);


                if (usertype == "SalesRepresentative" && userrole == "Sales") {

                    $("#salesrepresentive1").val(data[0].first_name + "" + data[0].last_name);
                } else {
                    $('#salesrepresentive').val(data[0].salesrepresentative).trigger('change');
                }

            }
        });


        $.ajax({
            type: "POST",
            url: baseurl + "Quotation_Estimate/getquationversionwise",
            dataType: "JSON",
            data: {
                version: version,
                bill_no: bill_no,

            },
            success: function(data) {

                $("#product_table tbody").html('');

                if (data.length > 0) {
                    var row_id = 0;
                    for (var i = 0; i < data.length; i++) {
                        row_id = row_id + 1;
                        $('#order_date').val(data[0].quotation_date);

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
                    getallovm();
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
        getexclefile(id);
        // if (id != "") {
        //     id = id.split("_");




        // }



    });

    function getexclefile(id, version) {


        var total_order_value = 0;
        var total_trasfor_price = 0;
        var less_input_tax = 0;
        var less_trasportion = 0;
        var less_bg = 0;
        var less_others = 0;
        var fmargin = 0;
        var quedate = "";

        $.ajax({
            type: "POST",
            url: baseurl + "Quotation_Estimate/getcustomerinfo",
            dataType: "JSON",
            data: {
                version: version,
                id: id,

            },
            success: function(data) {

                $.ajax({
                    type: "POST",
                    url: baseurl + "Quotation_Estimate/getquatationdate",
                    dataType: "JSON",
                    data: {
                        version: version,
                        id: id,

                    },
                    success: function(result) {
                        quedate = result[0].quotation_date;


                        total_order_value = data[0].total_order_value;
                        total_trasfor_price = data[0].total_trasfor_price;
                        less_input_tax = data[0].less_input_tax;
                        less_trasportion = data[0].less_trasportion;
                        less_bg = data[0].less_bg;
                        less_others = data[0].less_others;
                        fmargin = data[0].margin;

                        // var tdateAr = data[0].order_date.split('-');
                        // var date = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0];

                        var tdateAr = data[0].order_due_date.split('-');
                        var odate = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0];
                        if (quedate != "") {
                            var tdateAr = quedate.split('-');
                            quedate = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0];
                        }
                        var exhtml = '<tr>' +
                            '<td colspan="2" style="white-space:nowrap;text-align:left;padding:10px 10px;">Customer Name:</td>' +
                            '<td colspan="2" style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[0].customer_name + '</td>' +
                            '<td colspan="2"  style="white-space:nowrap;text-align:left;padding:10px 10px;">Quatation Number:</td>' +
                            '<td colspan="2"  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[0].quotaion_no + '</td>' +


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
                            '<td colspan="2"  style="white-space:nowrap;text-align:left;padding:10px 10px;">Quotation Date:</td>' +
                            '<td colspan="2"  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + quedate + '</td>' +


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
                            url: baseurl + "Quotation_Estimate/getproductdetalis",
                            dataType: "JSON",
                            data: {
                                //version: version,
                                id: id,

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
                                        // fileext: ".xls"
                                });

                            }
                        });
                    }
                });

            }



        });





    }
    //function for getting all version 

    function getallversion() {
        $(".quotationnoversion").each(function() {
            var id1 = $(this).attr('id');


            var val = $('#' + id1).html();

            var id1 = id1.split("_");


            var getid = id1[2];
            console.log(getid);


            $.ajax({
                type: "POST",
                url: baseurl + "Quotation_Estimate/getquotationversion",
                data: {
                    id: val,
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
                    $('#latestversion_' + getid).html(html);
                }
            });
            $.ajax({
                type: "POST",
                url: baseurl + "Quotation_Estimate/getquotationselect",
                data: {
                    id: val,
                },
                dataType: "JSON",
                async: false,
                success: function(data) {

                    if (data.length > 0) {

                        $('#latestversion_' + getid).val(data[0].quote_lock_version).trigger('change');
                        $("#latestversion_" + getid).attr("disabled", "disabled");
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
        var qnoid = $('#quotaion_no_' + id[1]).html();

        var lversion = $('#latestversion_' + id[1]).val();

        $.ajax({
            type: "POST",
            url: baseurl + "Quotation_Estimate/updatequotestatus",
            data: {
                id: id[1],
                lversion: lversion,
                status: status,
                qnoid: qnoid,
            },
            dataType: "JSON",
            async: false,
            success: function(data) {

                if (data == true) {
                    $.notify({
                        title: '',
                        message: '<strong>Change Status SuccessFully  !!</strong>'
                    }, {
                        type: 'success'
                    });
                    displayqutation();
                }



            }
        });




    });

    $(document).on('change', '.latestversion', function(e) {
        e.preventDefault();

        var id = $(this).attr('id');
        var version = $(this).val();
        id = id.split("_");
        saleid = id[1];


        $.ajax({
            type: "POST",
            url: base_url + "Quotation_Estimate/getsalespersion",
            data: {
                table_name: table_name,
                id: id[1],
                version: version,
            },
            dataType: "JSON",
            async: false,
            success: function(data) {

                if (data.length > 0) {

                    $('#salesrepresent_' + saleid).html(data[0].first_name + "" + data[0].last_name);
                    $('#salesperson_' + saleid).html(data[0].id);
                }


            }
        });


    });

    $(document).on('change', '#search_version', function(e) {
        e.preventDefault();

        var id = $('#save_update').val();
        var version = $(this).val();



        $.ajax({
            type: "POST",
            url: base_url + "Quotation_Estimate/getsalespersion",
            data: {
                table_name: table_name,
                id: id,
                version: version,
            },
            dataType: "JSON",
            async: false,
            success: function(data) {

                if (data.length > 0) {

                    //$('#salesrepresent_' + saleid).html(data[0].first_name + "" + data[0].last_name);
                    $('#salesrepresentive').val(data[0].id).trigger('change');
                }


            }
        });


    });

    //  
    $(document).on('click', '.getorder', function(e) {
        e.preventDefault();

        var id = $(this).attr('id');

        location.href = "getorderinfo/" + id;

        //location.href = baseurl + "Quotation_Estimate/getorderinfo/?quotation_id=" + id;

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


    function getqutationno() {
        var id = $('#save_update').val();
        if (id == "") {

            $.ajax({
                type: "POST",
                url: base_url + "Quotation_Estimate/getquatationno",
                data: {
                    table_name: table_name,
                },
                dataType: "JSON",
                async: false,
                success: function(data) {

                    // $('#bill_no').val(data);
                }
            });
        }
    }


    //click event of pending confirm and cancle 
    $(document).on('click', '.changestatusmodel', function(e) {
        e.preventDefault();
        $('#myModal2').modal('show');
        $('#stutusremark').val('');
        var statusid = $(this).attr('id');
        var statusval = $(this).text();
        var status = 0;

        if (statusval == "Identified") {
            status = 1;

        } else if (statusval == "Order Won") {
            status = 2;
            $('.statushidefrom').hide();
        } else if (statusval == "Order Lost") {
            status = 3;

        } else if (statusval == "Quoted") {
            status = 4;
        } else if (statusval == "Qualified") {
            status = 5;
        } else if (statusval == "Negotiation") {
            status = 6;
        } else if (statusval == "Opportunity Dropped") {
            status = 7;
        }
        if (status == 2 || status == 3) {
            $('.statushidefrom').hide();
        } else {
            $('.statushidefrom').show();
        }
        $('#quote_status').val(status).trigger('change');
        $('#status_id').val(statusid);
        var id = statusid.split("_");
        var qnoid = $('#quotaion_no_' + id[1]).html();

        $.ajax({
            type: "POST",
            url: baseurl + "Quotation_Estimate/getqutation_status_info",
            data: {
                qid: qnoid,

            },
            dataType: "JSON",
            async: false,
            success: function(data) {
                var html = '';

                for (i = 0; i < data.length; i++) {


                    var date = data[i].created_at;
                    var fdateslt = date.split('-');
                    var time = fdateslt[2].split(' ');
                    var checkintime = time[0] + '/' + fdateslt[1] + '/' + fdateslt[0];
                    var stustus = '';
                    if (data[i].quote_status == 1) {
                        stustus = "Identified";
                    } else if (data[i].quote_status == 2) {
                        stustus = "Order Won";
                    } else if (data[i].quote_status == 3) {
                        stustus = "Order Lost";
                    } else if (data[i].quote_status == 4) {
                        stustus = "Quoted";
                    } else if (data[i].quote_status == 5) {
                        stustus = "Qualified";
                    } else if (data[i].quote_status == 6) {
                        stustus = "Negotiation";
                    } else if (data[i].quote_status == 7) {
                        stustus = "Opportunity Dropped";
                    }

                    html += '<tr>' +
                        '<td  id="date_' + data[i].id + '"  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + checkintime + '</td>' +
                        '<td  id="notes_' + data[i].id + '"  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].remark + '</td>' +
                        '<td  id="userid_' + data[i].id + '"   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + stustus + '</td>' +
                        '<td  id="userid_' + data[i].id + '"   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].first_name + '' + data[i].last_name + '</td>' +
                        '</tr>';
                }

                $('#ac_notes_tbody').html(html);
            }
        });

    });

    $(document).on('submit', '#form_changestatus', function(e) {
        e.preventDefault();


        var id = $('#status_id').val();
        var status = $('#quote_status').val();
        var stutusremark = $('#stutusremark').val();
        id = id.split("_");
        var qnoid = $('#quotaion_no_' + id[1]).html();

        var lversion = $('#latestversion_' + id[1]).val();

        $('#wait1').show();
        $('#changestatuainfo').attr('disabled', true);


        $.ajax({
            type: "POST",
            url: baseurl + "Quotation_Estimate/updatequotestatus",
            data: {
                id: id[1],
                lversion: lversion,
                status: status,
                qnoid: qnoid,
                stutusremark: stutusremark,
            },
            dataType: "JSON",
            async: false,
            success: function(data) {
                $('#changestatuainfo').attr('disabled', false);
                $('#wait1').hide();
                if (data == true) {
                    $.notify({
                        title: '',
                        message: '<strong>Change Status SuccessFully  !!</strong>'
                    }, {
                        type: 'success'
                    });
                    displayqutation();
                    $('#myModal2').modal('hide');
                }



            }
        });

    });

    $(document).on('click', '#btnmailsend', function(e) {
        e.preventDefault();
        $('#sendemail_div').show();
        $('.btnhideshow').hide();
        var customerid = $('#customerid').val();


        var cus_name = $('#cus_name').val();
        var cotactperson = $('#cotactperson').val();
        var phn = $('#phn').val();
        var s_email = $('#s_email').val();
        var bill_no = $('#bill_no').val();
        var refno = $('#refno').val();
        var Tax = $('#Tax').val();
        var o_date = $('#o_date').val();
        var o_due_date = $('#o_due_date').val();

        var tdateAr = o_due_date.split('-');
        o_due_date = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0];

        var tdateAr = o_date.split('-');
        o_date = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0];


        var finalordervalue = $('#finalordvalue').val();


        var salesrepresentive = $('#salesrepresentive option:selected').text();
        var salesrepresentive1 = $('#salesrepresentive1').val();

        var ptaxvalue = $('#P_Tax_Val_1').val();

        if (usertype == "SalesRepresentative" && userrole == "Sales") {

            $('#lblsalesrepresentative').text('Sales Representative:' + salesrepresentive1);
        } else {
            $('#lblsalesrepresentative').text('Sales Representative:' + salesrepresentive);
        }

        $('#lblcustfirstname').text('Customer Name:' + cus_name);
        $('#lblQuotationno').text('Quotation Number:' + bill_no);

        var id = $('#save_update').val();
        var search_version = $('#search_version option:selected').text();

        if (id == "") {
            $('#lblversion').text('Version:' + 1);

        } else {
            $('#lblversion').text('Version:' + search_version);
        }


        $('#lblrefnumber').text('Ref Number:' + refno);
        $('#lblorderduedate').text('Order Due Dater:' + o_due_date);
        $('#lbltotalordervalue').text('Total Order Value :' + ptaxvalue);
        $('#lblquotationdate').text('Quotation Date:' + o_date);

        if (usertype == "SalesRepresentative" && userrole == "Sales") {

            $('#lbl1salespr').text('Sales Representative:' + salesrepresentive1);
        } else {
            $('#lbl1salespr').text('Sales Representative:' + salesrepresentive);
        }

        $('#lbl1custnm').text('Customer Name:' + cus_name);
        $('#lbl1quotationno').text('Quotation Number:' + bill_no);

        var id = $('#save_update').val();
        var search_version = $('#search_version option:selected').text();


        if (id == "") {

        } else {

            if (search_version == "Select") {
                $('#lbl1version').text('Version:' + 1);
            } else {
                $('#lbl1version').text('Version:' + search_version);
            }
        }


        $('#lbl1refno').text('Ref Number:' + refno);
        $('#lbl1orderduedate').text('Order Due Dater:' + o_due_date);
        $('#lbl1totalordvalue').text('Total Order Value :' + ptaxvalue);
        $('#lbl1quotationdate').text('Quotation Date:' + o_date);




        $.ajax({
            type: "POST",
            url: baseurl + "Quotation_Estimate/getcustomerdata",
            data: {
                customerid: customerid,

            },
            dataType: "JSON",
            async: false,
            success: function(data) {

                var html = '';
                for (i = 0; i < data.length; i++) {
                    if (i == 0) {
                        $('#cto').val(data[0].email_id)
                    }

                    if (i > 0) {
                        name = data[i].contact_name;
                        id = data[i].email_id;

                        html += '<option  value="' + id + '" >' + name + '</option>';
                    }

                }
                $('#customercc').html(html);
            }
        });

        $.ajax({
            type: "POST",
            url: baseurl + "Quotation_Estimate/getsalesperson",
            data: {

            },
            dataType: "JSON",
            async: false,
            success: function(data) {

                var html1 = '';
                for (i = 0; i < data.length; i++) {
                    if (i == 0) {
                        $('#sto').val(data[0].email)
                    }

                    if (i > 0) {
                        name = data[i].user_name;
                        id = data[i].email;

                        html1 += '<option  value="' + id + '" >' + name + '</option>';
                    }

                }
                $('#scc').html(html1);
            }
        });

        var btnprin = $('#btnprint').val();

        $.ajax({
            type: "POST",
            url: baseurl + "Quotation_Estimate/getfilenameinfo",
            data: {

                btnprin: btnprin,

            },
            dataType: "html",
            async: false,
            success: function(data) {

                var filenm = data.split("EOF");
                var trimStr = $.trim(filenm[1]);
                $('#btnfilenmshow1').val(base_url + "quatationpdf/quotation_" + trimStr + ".pdf");
                $('#btnfilenmshow2').val(base_url + "quatationpdf/quotation_" + trimStr + ".pdf");
                $('#filenamepdf1').text('quotation_' + trimStr + ".pdf");
                $('#filenamepdf2').text('quotation_' + trimStr + ".pdf");
                //$("#getdfieename").attr("href", base_url + "quatationpdf/invoice_" + filenm[1] + ".pdf")

            }
        });

    });

    $(document).on('click', '.btnfilenmshow', function(e) {
        e.preventDefault();
        var value = $(this).val();
        window.open(value, '_blank');
    });

    $(document).on('click', '#csend', function(e) {
        e.preventDefault();

        $(".column-title").each(function() {
            var htmlString = $(this).html();
            alert(htmlString);
        });



        $.ajax({
            type: "POST",
            url: baseurl + "Quotation_Estimate/docuploadfile",
            data: {
                cto: cto,
                customercc: customercc,
                subject: subject,
                msg: msg,
                btnprin: btnprin,
                attachment: attachment,
                filenamepdf: filenamepdf,

            },
            // dataType: "JSON",
            async: false,
            success: function(data) {}
        });




        var cto = $('#cto').val();
        var customercc = $('#customercc').val();
        var subject = $('#cSubject').val();
        var msg = $('#cmsg').val();
        var btnprin = $('#btnprint').val();
        var attachment = $('#btnfilenmshow1').val();
        var filenamepdf = $('#filenamepdf1').text();

        $('#wait3').show();

        // cto = cto.split(",");
        // studejsonObj = [];
        // for (i = 0; i < cto.length; i++) {

        //     studejsonObj.push(cto[i]);
        // }
        // console.log("studejsonObj" + studejsonObj);






        $('#csend').attr('disabled', true);


        $('#lblcsend').text('Sending Mail ');
        $('#lblcsend').css('display', 'block');


        $.ajax({
            type: "POST",
            url: baseurl + "Quotation_Estimate/sendemailcustomer",
            data: {
                cto: cto,
                customercc: customercc,
                subject: subject,
                msg: msg,
                btnprin: btnprin,
                attachment: attachment,
                filenamepdf: filenamepdf,

            },
            // dataType: "JSON",
            async: false,
            success: function(data) {
                console.log('for mail customer test');

                if (data != "") {
                    $('#wait3').hide();
                    $('#csend').attr('disabled', false);
                    $('#lblcsend').css('display', 'none');
                    $.notify({
                        title: '',
                        message: '<strong>SuccessFully Send Email</strong>'
                    }, {
                        type: 'success'
                    });
                }
            },
            error: function(error) {

                console.log('error');
                console.log(error);
            }
        });


    });

    $(document).on('click', '#ssend', function(e) {
        e.preventDefault();


        $('#wait4').show();

        var cto = $('#sto').val();
        var customercc = $('#scc').val();
        var subject = $('#sSubject').val();
        var msg = $('#smsg').val();
        var btnprin = $('#btnprint').val();
        var attachment = $('#btnfilenmshow1').val();
        var filenamepdf = $('#filenamepdf1').text();



        $('#ssend').attr('disabled', true);

        $.ajax({
            type: "POST",
            url: baseurl + "Quotation_Estimate/sendemailcustomer",
            data: {
                cto: cto,
                customercc: customercc,
                subject: subject,
                msg: msg,
                btnprin: btnprin,
                filenamepdf: filenamepdf,

            },
            //dataType: "JSON",
            async: false,
            success: function(data) {
                console.log('for mail sale test');
                $('#ssend').attr('disabled', false);
                $('#wait4').hide();
                if (data != "") {
                    $.notify({
                        title: '',
                        message: '<strong>SuccessFully Send Email</strong>'
                    }, {
                        type: 'success'
                    });
                }
            }
        });


    });

    $(document).on('click', '#searchfilter', function(e) {
        e.preventDefault();

        var status = $('#quotation_status_info').val();
        $('#wait6').show();

        for (var j = 0; j < arrayFromPHP.length; j++) {

            if (arrayFromPHP[j] == "editQuotation") {
                editflag = 1;
            }
            if (arrayFromPHP[j] == "deleteQuotation") {
                delflag = 1;
            }
            if (arrayFromPHP[j] == "createOrder") {
                createorderflag = 1;
            }

        }

        $.ajax({
            type: 'POST',
            url: baseurl + "Quotation_Estimate/getsearchfilter",
            async: false,
            data: {

                status: status,
            },
            dataType: 'json',
            success: function(data) {
                var html = '';
                $('#wait6').hide();
                html += '<table id="mytable" class="table table-striped">' +
                    '<thead>' +
                    '<tr>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Customer Name</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Quotation Number</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Sales Representative</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Ref Number</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Version</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Quotation Date </th>' +
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
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none;">Order Due Date</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none;">Customer Id</th>' +
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



                    var tdateAr = data[i].order_date.split('-');
                    date = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0];

                    var tdateAr = data[i].order_due_date.split('-');
                    odate = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0];
                    html += '<tr>' +
                        '<td id="customer_name_' + data[i].id + '">' + data[i].customer_name + '</td>' +
                        '<td class="quotationnoversion" id="quotaion_no_' + data[i].id + '">' + data[i].quotaion_no + '</td>' +
                        '<td id="salesrepresent_' + data[i].id + '">' + data[i].firstname + "" + data[i].last_name + '</td>' +
                        '<td id="ref_number_' + data[i].id + '">' + data[i].ref_number + '</td>' +
                        '<td> <select name="latestversion_' + data[i].id + '" id="latestversion_' + data[i].id + '" class="form-control latestversion"></select></td>' +
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
                        '<td style="display:none;" id="salesperson_' + data[i].id + '">' + data[i].salesperson + '</td>' +
                        '<td style="display:none;" id="customer_id_' + data[i].id + '">' + data[i].customer_id + '</td>';

                    // if (data[i].quote_status == 1) {
                    //     html += '<td> <select name="quotestatus_' + data[i].id + '" id="quotestatus_' + data[i].id + '" class="form-control quotestatus"><option disabled>select</option><option value="1" selected>Pending</option><option value="2">Confirm</option><option value="3">Cancel</option></select</td>';
                    // } else if (data[i].quote_status == 2) {
                    //     html += '<td> <select disabled name="quotestatus_' + data[i].id + '" id="quotestatus_' + data[i].id + '" class="form-control quotestatus"><option disabled>select</option><option value="1">Pending</option><option value="2" selected>Confirm</option><option value="3">Cancel</option></select</td>';
                    // } else {
                    //     html += '<td> <select disabled name="quotestatus_' + data[i].id + '" id="quotestatus_' + data[i].id + '" class="form-control quotestatus"><option disabled>select</option><option value="1">Pending</option><option value="2">Confirm</option><option value="3" selected>Cancel</option></select</td>';
                    // }

                    // if (data[i].quote_status == 1) {
                    //     html += '<td> <button  class="btn btn-sm btn-warning  btn-xs  changestatusmodel" id="quotestatus_' + data[i].id + '"   >Pending</button>&nbsp;</td>';
                    // } else if (data[i].quote_status == 2) {
                    //     html += '<td> <button  class="btn btn-sm btn-success  btn-xs  changestatusmodel" id="quotestatus_' + data[i].id + '"   disabled >Confirm</button>&nbsp;</td>';
                    // } else {
                    //     html += '<td> <button  class="btn btn-sm btn-danger btn-xs  changestatusmodel" id="quotestatus_' + data[i].id + '"   disabled>Cancel</button>&nbsp;</td>';
                    // }

                    if (data[i].quote_status == 1) {
                        html += '<td> <button  class="btn btn-sm btn-warning  btn-xs  changestatusmodel" id="quotestatus_' + data[i].id + '"   >Identified</button>&nbsp;</td>';
                    } else if (data[i].quote_status == 2) {
                        html += '<td> <button  class="btn btn-sm btn-success  btn-xs  changestatusmodel" id="quotestatus_' + data[i].id + '"    >Order Won</button>&nbsp;</td>';
                    } else if (data[i].quote_status == 3) {
                        html += '<td> <button  class="btn btn-sm btn-danger btn-xs  changestatusmodel" id="quotestatus_' + data[i].id + '"   >Order Lost</button>&nbsp;</td>';
                    } else if (data[i].quote_status == 4) {
                        html += '<td> <button  class="btn btn-sm btn-info btn-xs  changestatusmodel" id="quotestatus_' + data[i].id + '"   >Quoted</button>&nbsp;</td>';
                    } else if (data[i].quote_status == 5) {
                        html += '<td> <button  class="btn btn-sm btn-primary btn-xs  changestatusmodel" id="quotestatus_' + data[i].id + '"   >Qualified</button>&nbsp;</td>';
                    } else if (data[i].quote_status == 6) {
                        html += '<td> <button  class="btn btn-sm btn-primary btn-xs  changestatusmodel" id="quotestatus_' + data[i].id + '"   >Negotiation</button>&nbsp;</td>';
                    } else if (data[i].quote_status == 7) {
                        html += '<td> <button  class="btn btn-sm btn-danger btn-xs  changestatusmodel" id="quotestatus_' + data[i].id + '"   > Opportunity Dropped</button>&nbsp;</td>';
                    }


                    // html += '< /td>';

                    if (data[i].quote_status == 1 || data[i].quote_status == 4 || data[i].quote_status == 5 || data[i].quote_status == 6) {
                        html += ' <td>';
                        if (editflag == 1) {

                            html += '<button  class="edit_data btn btn-sm  btn-xs  btn-primary" id="' + data[i].id + '"  ><i class="fa fa-edit"></i></button>&nbsp;';
                        }
                        if (delflag == 1) {
                            html += '<button name="delete" value="Delete" class="delete_data btn btn-xs btn-danger" id=' +
                                data[i].id + '><i class="fa fa-trash"></i></button>';
                        }
                        html += '</td>';
                    } else if (data[i].quote_status == 2) {
                        if (createorderflag == 1) {
                            html += '<td><button  class="getorder btn btn-sm  btn-xs  btn-primary" id="' + data[i].id + '"  ><i class="fa fa-shopping-cart"></i></button></td>';
                        } else {
                            html += "<td>-</td>";
                        }


                    } else {
                        // html += "-";
                        html += "<td>-</td>";
                    }

                    html += '</tr>';


                }

                html += '</tbody></table>';
                $('#show_master').html(html);
                // $('#mytable').DataTable({
                //     //deferRender: true

                //     // "fnDrawCallback": function() { //for display for bootstraptoggle button
                //     //     //jQuery('#mytable .latestversion').dropdown();
                //     //     $(".latestversion select").select2();

                //     // }
                // });
            }
        });
        getallversion();


    });

    $(document).on("mousedown", "#file", function() {
        var id = 'file';
        var hiddenid = "file_hidden";
        var msgid = "msg";
        //	$('#filename').removeAttr('form');

        uploadfile(id);
    });

    function uploadfile(id) {
        //console.log(id + '-' + hiddenid + '-' + msgid);

        $('#' + id).ajaxfileupload({
            //'action' : 'callAction',

            'action': baseurl + 'settings/doc_upload',
            params: { id: id },
            'onStart': function() { $('#' + msgid).html("<font color='red'><i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>Please wait file is uploading.....</font>"); },
            'onComplete': function(response) {
                //console.log(response);


            }
        });
    }



});