$(document).ready(function() {
    var table_name = "new_account";
    var validate = 0;
    var fromdate = '';
    var todate = '';
    var checkemail = 0;
    var checkmobile = 0;
    var checklandline = 0;

    if (usertype != "SalesRepresentative") {

        $("#date").removeAttr("disabled");
    } else {
        // $("#date").removeAttr("disabled");  

        $("#date").attr("disabled", "disabled");
    }

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


    $("#date").val(today);

    /*---------insert data into area_master start-----------------*/
    $(document).on("submit", "#newaccountform", function(e) {
        e.preventDefault();



        if (checkemail == 0 && checkmobile == 0 && checklandline == 0) {

            var l_date = $('#date').val();
            var id = $('#save_update').val();
            var cname = $('#cname').val();
            var customer_type = $('#customer_type').val();
            var category = $('#category').val();
            var employees = $('#employees').val();
            var requirement = $('#requirement').val();
            var remark = $('#remark').val();
            var u_addr = $('#u_addr').val();

            // if(id !=""){
            //     var tdateAr = l_date.split('/');
            //     l_date = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0];

            // }
            var flag = 0;
            if (validate == 0) {

                var id = $('#save_update').val();
                studejsonObj = [];
                $(".addcontactinfo").each(function() {
                    var id1 = $(this).attr('id');
                    console.log(id1);

                    id1 = id1.split("_");


                    student = {};

                    var contactname = $('#contactname_' + id1[1]).val();
                    var designation = $('#designation_' + id1[1]).val();
                    var email = $('#email_' + id1[1]).val();
                    var mobile = $('#mobile_' + id1[1]).val();
                    var landline = $('#landline_' + id1[1]).val();



                    if (contactname != "" && designation != "") {
                        if (email != "" || mobile != "" || landline != "") {
                            console.log("contactname" + contactname + "designation" + designation + "email" + email + "mobile" + mobile + "" + landline)

                            student["contactname"] = contactname;
                            student["designation"] = designation;

                            student["email"] = email;
                            student["mobile"] = mobile;
                            student["landline"] = landline;

                            for (var i = 0; i < studejsonObj.length; i++) {

                                console.log("mobile" + mobile + "studejsonObj" + studejsonObj[i].mobile);
                                // if (mobile == studejsonObj[i].mobile || email == studejsonObj[i].email || landline == studejsonObj[i].landline) {
                                //     flag = 1;

                                // }
                                if (email == studejsonObj[i].email) {
                                    flag = 1;

                                }
                            }




                        } else {
                            $.notify({
                                title: '',
                                message: '<strong>Email id OR Mobile no Or Land line Required</strong>'
                            }, {
                                type: 'success'
                            });
                            flag = 1;
                        }

                    } else {

                        $.notify({
                            title: '',
                            message: '<strong>Atleast One Contact Information is Required!!</strong>'
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
                        url: baseurl + "NewAccountcontroller/save_settings",
                        dataType: "JSON",
                        async: false,
                        data: {
                            id: id,
                            l_date: l_date,
                            cname: cname,
                            customer_type: customer_type,
                            category: category,
                            employees: employees,
                            requirement: requirement,
                            remark: remark,
                            u_addr: u_addr,
                            studejsonObj: studejsonObj,
                            table_name: table_name,
                        },
                        success: function(data) {
                            console.log(data);
                            if (data == true) {
                                $.notify({
                                    title: '',
                                    message: '<strong>Data saved successfully</strong>'
                                }, {
                                    type: 'success'
                                });

                                form_clear();
                                show_master(fromdate, todate);
                                $('.btnhideshow').hide();
                                $('.tablehideshow').show();
                                $('.btnhide').show();
                                $('.closehide').hide();
                                $('#setaccounttext').text('All Account');

                            } else {
                                errorTost("Data Cannot Save");
                            }
                        }
                    });
                } else {
                    $.notify({
                        title: '',
                        message: '<strong>Dublicate Mobile No OR Email OR Land line Already Exists In  </strong>'
                    }, {
                        type: 'success'
                    });
                    studejsonObj = [];
                }
            } else {
                $.notify({
                    title: '',
                    message: '<strong> Customer Name Already Exists</strong>'
                }, {
                    type: 'success'
                });
            }
        } else {
            $.notify({
                title: '',
                message: '<strong>Mobile No OR Email OR Land line Already Exists </strong>'
            }, {
                type: 'success'
            });
        }

    });
    /*---------insert data into area_master end-----------------*/


    /*---------get data into area_master start-----------------*/

    show_master(fromdate, todate); //call function show data table
    var delflag = 0;
    var editflag = 0;

    //	function show data table
    function show_master(fromdate, todate) {

        for (var j = 0; j < arrayFromPHP.length; j++) {

            if (arrayFromPHP[j] == "editAccount") {
                editflag = 1;
            }
            if (arrayFromPHP[j] == "deleteAccount") {
                delflag = 1;
            }
        }

        $.ajax({
            type: 'POST',
            url: baseurl + "NewAccountcontroller/get_master",
            async: false,
            data: {
                table_name: table_name,
                fromdate: fromdate,
                todate: todate,
            },
            dataType: 'json',
            success: function(data) {

                var html = '';
                html += '<table id="myTable" class="table table-striped" style="width:100%;">' +
                    '<thead>' +
                    '<tr>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Date</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none;">Date</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Category</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none;">Category Id</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Customer Name</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">No of employees</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Customer Type</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none;">Customer Type ID</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none;">Requirement</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none;">Remarks</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none;">Address</th>' +

                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Action</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>';

                for (i = 0; i < data.length; i++) {
                    var sr = i + 1;
                    var status = "";
                    var date = "";

                    var tdateAr = data[i].date.split('-');
                    date = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0];
                    html += '<tr>' +
                        '<td id="date1_' + data[i].id + '">' + date + '</td>' +
                        '<td style="display:none;" id="date_' + data[i].id + '">' + data[i].date + '</td>' +
                        '<td id="categorytype_' + data[i].id + '">' + data[i].categorytype + '</td>' +
                        '<td style="display:none;" id="category_id' + data[i].id + '">' + data[i].category_id + '</td>' +
                        '<td id="customer_name_' + data[i].id + '">' + data[i].customer_name + '</td>' +
                        '<td id="no_of_employee_' + data[i].id + '">' + data[i].no_of_employee + '</td>' +
                        '<td id="customertype_' + data[i].id + '">' + data[i].customertype + '</td>' +
                        '<td style="display:none;" id="customer_type_' + data[i].id + '">' + data[i].customer_type + '</td>' +
                        '<td style="display:none;" id="requirement_' + data[i].id + '">' + data[i].requirement + '</td>' +
                        '<td style="display:none;" id="remark_' + data[i].id + '">' + data[i].remark + '</td>' +
                        '<td style="display:none;" id="address_' + data[i].id + '">' + data[i].address + '</td>' +


                        //'<td><button  class="edit_data btn btn-sm  btn-xs  btn-primary" id="' + data[i].id + '" value="' + data[i].id + '" ><i class="fa fa-edit"></i></button></td>' +
                        '<td>';
                    if (editflag == 1) {
                        html += '<button  class="edit_data btn btn-sm  btn-xs  btn-primary" id="' + data[i].id + '"  ><i class="fa fa-edit"></i></button>&nbsp;';
                    }
                    if (delflag == 1) {
                        html += '<button name="delete" value="Delete" class="delete_data btn btn-xs btn-danger" id=' + data[i].id + '><i class="fa fa-trash"></i></button>';
                    }
                    html += '</td></tr>';
                }

                html += '</tbody></table>';
                $('#show_master').html(html);
                $('#myTable').DataTable({

                    dom: 'Bfrtip',
                    //"dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>',
                    buttons: [{
                            extend: 'pdfHtml5',
                            title: 'Account',
                            orientation: 'landscape',
                            pageSize: 'A4',
                            exportOptions: {
                                columns: [0, 2, 4, 5, 6]
                            },
                        },
                        {
                            title: 'Account',
                            extend: 'excelHtml5',
                            exportOptions: {
                                columns: [0, 2, 4, 5, 6]
                            }
                        }
                    ]
                });
            }

        });
    }

    /*---------get data into area_master end-----------------*/

    $(document).on('click', '.closehideshow', function() {
        form_clear();
    });

    function form_clear() {


        $('#save_update').val('');



        //$('#date').val('');

        $('#cname').val('');
        $('#customer_type').val('').trigger('change');
        $('#category').val('').trigger('change');
        $('#employees').val('');
        $('#requirement').val('');
        $('#remark').val('');
        $('#save_update').val('');
        $('#contactinformation_tbody').html('');
        addproof();

    }


    /*---------get  role_master  start-----------------*/

    $(document).on('click', '.edit_data', function(e) {
        e.preventDefault();

        var id1 = $(this).attr('id');
        $('.btnhide').hide();
        $('#setaccounttext').text('New Account');
        $('.closehide').show();

        $('.btnhideshow').show();
        $('.tablehideshow').hide();
        var date = $('#date_' + id1).html();
        var category_id = $('#category_id' + id1).html();
        var customer_name = $('#customer_name_' + id1).html();
        var no_of_employee_ = $('#no_of_employee_' + id1).html();
        var customer_type_ = $('#customer_type_' + id1).html();
        var requirement_ = $('#requirement_' + id1).html();
        var remark_ = $('#remark_' + id1).html();
        var address_ = $('#address_' + id1).html();





        $('.ldate').val(date);

        $('#cname').val(customer_name);

        if (category_id > 0) {
            $('#category').val(category_id).trigger('change');
        }
        if (customer_type_ > 0) {
            $('#customer_type').val(customer_type_).trigger('change');
        }

        $('#employees').val(no_of_employee_);
        $('#requirement').val(requirement_);
        $('#remark').val(remark_);
        $('#u_addr').val(address_);
        $('#save_update').val(id1);


        $.ajax({
            type: "POST",
            url: baseurl + "NewAccountcontroller/getcontactinfo",
            dataType: "JSON",
            data: {
                id: id1,
                table_name: table_name,
            },
            success: function(data) {
                $('#contactinformation_tbody').html('');
                if (data.length > 0) {
                    row_id = 0;
                    for (var i = 0; i < data.length; i++) {

                        row_id = parseInt(row_id) + 1;
                        var html = '<tr  class="addcontactinfo"  id="addcontactinfo_' + row_id + '" >' +
                            '<td>' +
                            '<div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="contactname_' + row_id + '" name="contactname_' + row_id + '" placeholder="Contact Name" value="' + data[i].contact_name + '" class="form-control "  maxlength="20"  type="text"  ></div>' +

                            '</td>' +

                            '<td>' +
                            '<div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span><input id="designation_' + row_id + '" name="designation_' + row_id + '" placeholder="Designation" class="form-control " value="' + data[i].designation + '" type="text" maxlength="20"></div><span class="job1"></span></div>' +
                            '</td>' +

                            '<td>' +
                            '<div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span><input id="email_' + row_id + '" name="email_' + row_id + '" placeholder="Email" class="form-control email" value="' + data[i].email_id + '" type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"></div><span class="email1"></span></div>' +
                            '</td>' +

                            '<td>' +
                            '<div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span><input type="number" id="mobile_' + row_id + '" name="mobile_' + row_id + '" placeholder="Phone Number" class="form-control phn small-input"  value="' + data[i].mobile_no + '" pattern="[0-9]{10}" type="number" ></div><span class="phn1"></span></div>' +
                            '</td>' +

                            '<td>' +
                            '<div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span><input type="number" id="landline_' + row_id + '" name="landline_' + row_id + '" placeholder="Land line" class="form-control  small-input landline" value="' + data[i].lead_line + '"  pattern="[0-9]" type="number" ></div><span></span></div>' +
                            '</td>' +

                            '<td>&nbsp;<button  class="proff_delete_data btn btn-xs btn-danger"   id="addcontactinfo_' + row_id + '" title="Remove Section !!!" ><i class="fa fa-trash"></i></button></td>' +
                            '</tr>';

                        $('#contactinformation_tbody').prepend(html);
                        $('#row_id').val(row_id);
                    }
                }


            }
        });


    });

    /*---------get  area_master  end-----------------*/
    /*---------delete  area_master  start-----------------*/

    $(document).on('click', '.delete_data', function() {

        $("#myModal1").modal('show');
        var id1 = $(this).attr('id');
        $('#del_id').val(id1);


    });



    $(document).on('click', '#delete', function() {


        var id1 = $('#del_id').val();

        //  alert('from here' + id1);

        $.ajax({
            type: "POST",
            url: baseurl + "NewAccountcontroller/delete_master",
            dataType: "JSON",
            data: {
                id: id1,
                table_name: table_name,
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
                    show_master(where); //call function show all product					
                }


            }
        });

    });

    /*---------delete  area_master  end-----------------*/

    $(document).on('blur', '#cname', function() {
        var category = $('#cname').val();


        var id = $('#save_update').val();

        $.ajax({
            type: "POST",
            url: baseurl + "NewAccountcontroller/checkcategorytypeexist",
            dataType: "JSON",
            async: false,
            data: {
                id: id,
                category: category,

                table_name: table_name,
            },
            success: function(data) {
                if (data == "100") {
                    validate = 1;

                    $.notify({
                        title: '',
                        message: '<strong> Customer Name Already Exists</strong>'
                    }, {
                        type: 'success'
                    });
                } else {
                    validate = 0;
                }
            }
        });
    });

    $('#dataTable').DataTable({});
    //function for add proff dynamically
    addproof();

    function addproof() {
        var row_id = $('#row_id').val();
        row_id = parseInt(row_id) + 1;
        var html = '<tr  class="addcontactinfo"  id="addcontactinfo_' + row_id + '" >' +
            '<td>' +
            '<div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="contactname_' + row_id + '" name="contactname_' + row_id + '" placeholder="Contact Name" class="form-control "  maxlength="20"  type="text"  ></div>' +

            '</td>' +

            '<td>' +
            '<div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span><input id="designation_' + row_id + '" name="designation_' + row_id + '" placeholder="Designation" class="form-control "  value="" type="text" maxlength="20"></div><span class="job1"></span></div>' +
            '</td>' +

            '<td>' +
            '<div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span><input id="email_' + row_id + '" name="email_' + row_id + '" placeholder="Email" class="form-control email"  value="" type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"></div><span class="email1"></span></div>' +
            '</td>' +

            '<td>' +
            '<div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span><input id="mobile_' + row_id + '" name="mobile_' + row_id + '" placeholder="Phone Number" class="form-control phn small-input"  pattern="[0-9]{10}" type="number" ></div><span class="phn1"></span></div>' +
            '</td>' +

            '<td>' +
            '<div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span><input id="landline_' + row_id + '" name="landline_' + row_id + '" placeholder="Land line" class="form-control  small-input landline"  pattern="[0-9]" type="number" ></div><span ></span></div>' +
            '</td>' +

            '<td>&nbsp;<button  class="proff_delete_data btn btn-xs btn-danger"   id="addcontactinfo_' + row_id + '" title="Remove Section !!!" ><i class="fa fa-trash"></i></button></td>' +
            '</tr>';

        $('#contactinformation_tbody').prepend(html);
        $('#row_id').val(row_id);



    }
    //click event of add proff button
    $(document).on('click', '#addcontact', function(e) {
        e.preventDefault();
        addproof();
    });



    //for deleting prooff data
    $(document).on('click', '.proff_delete_data', function(e) {
        e.preventDefault();

        var id = $(this).attr('id');
        id = id.split("_");
        if (id != "") {
            $('#addcontactinfo_' + id[1]).remove();
        }

    });

    $(document).on('click', '.btnhide', function(e) {
        e.preventDefault();
        $('.btnhideshow').show();
        $('.tablehideshow').hide();
        $('.btnhide').hide();
        $('.closehide').show();
        $('#setaccounttext').text('New Account');
    });
    $(document).on('click', '#reset', function(e) {
        e.preventDefault();
        form_clear();
    });
    $(document).on('click', '.closehide', function(e) {
        e.preventDefault();
        form_clear();
        $('.btnhideshow').hide();
        $('.tablehideshow').show();
        $('.btnhide').show();
        $('.closehide').hide();
        $('#setaccounttext').text('All Account');
    });



    //for getting dropdown---
    getMasterSelect("customer_type", "#customer_type", " status = '1'");
    getMasterSelect("category_type", "#category", " status = '1'");

    function getMasterSelect(table_name, selecter, where) {

        $.ajax({
            type: "POST",
            url: baseurl + "NewAccountcontroller/get_master_where",
            data: {
                table_name: table_name,
                where: where,
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
                html += '<option selected disabled value="" >Select</option>';
                //						}
                for (i = 0; i < data.length; i++) {
                    var id = '';
                    if (table_name == "customer_type") {
                        name = data[i].customer_type;
                        id = data[i].id;
                    } else {
                        name = data[i].category_type;
                        id = data[i].id;
                    }


                    html += '<option value="' + id + '" >' + name + '</option>';

                }
                $(selecter).html(html);
            }
        });

    }
    $(document).on("submit", "#search_form", function(e) {
        e.preventDefault();
        var fromdate = $('#frmdate').val();
        var todate = $('#todate').val();

        // where = 'date >=' + fromdate + ' And date <=' + todate;

        show_master(fromdate, todate);
    });

    $(document).on("blur", ".email", function(e) {
        e.preventDefault();
        var email = $(this).val();

        var id = $('#save_update').val();
        if (email != '') {
            $.ajax({
                type: "POST",
                url: baseurl + "NewAccountcontroller/checkemail",
                data: {
                    email: email,
                    id: id,

                },
                dataType: "JSON",
                async: false,
                success: function(data) {
                    if (data == '100') {
                        checkemail = 1;
                        $.notify({
                            title: '',
                            message: '<strong>Email  Already Exists </strong>'
                        }, {
                            type: 'success'
                        });
                    } else {
                        checkemail = 0;
                    }
                }
            });
        } else {
            checkemail = 0;
        }
    });

    $(document).on("blur", ".phn", function(e) {
        e.preventDefault();
        var phn = $(this).val();
        console.log(phn);

        var id = $('#save_update').val();
        if (phn != '') {
            $.ajax({
                type: "POST",
                url: baseurl + "NewAccountcontroller/checkmoblino",
                data: {
                    phn: phn,
                    id: id,

                },
                dataType: "JSON",
                async: false,
                success: function(data) {
                    if (data == '100') {
                        checkmobile = 1;
                        $.notify({
                            title: '',
                            message: '<strong>Mobile  Already Exists </strong>'
                        }, {
                            type: 'success'
                        });
                    } else {
                        checkmobile = 0;
                    }
                }
            });
        } else {
            checkmobile = 0;
        }
    });

    $(document).on("blur", ".landline", function(e) {
        e.preventDefault();
        var landline = $(this).val();

        var id = $('#save_update').val();
        if (landline != '') {
            $.ajax({
                type: "POST",
                url: baseurl + "NewAccountcontroller/checklandline",
                data: {
                    landline: landline,
                    id: id,

                },
                dataType: "JSON",
                async: false,
                success: function(data) {
                    if (data == '100') {
                        checklandline = 1;
                        $.notify({
                            title: '',
                            message: '<strong>Land line  Already Exists </strong>'
                        }, {
                            type: 'success'
                        });
                    } else {
                        checklandline = 0;
                    }
                }
            });
        } else {
            checklandline = 0;
        }
    });



});