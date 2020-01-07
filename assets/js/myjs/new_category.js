$(document).ready(function() {
    var table_name = "category_type";
    var validate = 0;
    var Createflag = 0;
    /*---------insert data into area_master start-----------------*/
    $(document).on("submit", "#category_type", function(e) {
        e.preventDefault();

        var category = $('#category').val();


        var id = $('#save_update').val();

        if (validate == 0) {
            $.ajax({
                type: "POST",
                url: baseurl + "Categorycontroller/save_settings",
                dataType: "JSON",
                async: false,
                data: {
                    id: id,
                    category: category,

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
                        show_master();
                        if (Createflag != 1) {

                            $("#btnsave").attr("disabled", "disabled");
                        }

                    } else {
                        errorTost("Data Cannot Save");
                    }
                }
            });
        } else {
            $.notify({
                title: '',
                message: '<strong>Category Type Already Exists</strong>'
            }, {
                type: 'success'
            });
        }

    });

    /*---------insert data into area_master end-----------------*/


    /*---------get data into area_master start-----------------*/

    show_master(); //call function show data table
    var editflag = 0;
    var delflag = 0;

    //	function show data table
    function show_master() {

        for (var j = 0; j < arrayFromPHP.length; j++) {

            if (arrayFromPHP[j] == "editCategoryType") {
                editflag = 1;
            }
            if (arrayFromPHP[j] == "deleteCategoryType") {
                delflag = 1;
            }
            if (arrayFromPHP[j] == "createCategoryType") {
                Createflag = 1;
            }
        }


        $.ajax({
            type: 'POST',
            url: baseurl + "Categorycontroller/get_master",
            async: false,
            data: {
                table_name: table_name,
            },
            dataType: 'json',
            success: function(data) {

                var html = '';
                html += '<table id="myTable" class="table table-striped">' +
                    '<thead>' +
                    '<tr>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Sr No</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Category Type</th>' +

                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Action</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>';

                for (i = 0; i < data.length; i++) {
                    var sr = i + 1;
                    var status = "";
                    var date = "";

                    html += '<tr>' +
                        '<td id="id_' + data[i].id + '">' + sr + '</td>' +
                        '<td id="name_' + data[i].id + '">' + data[i].category_type + '</td>' +
                        //'<td><button  class="edit_data btn btn-sm  btn-xs  btn-primary" id="' + data[i].id + '" value="' + data[i].id + '" ><i class="fa fa-edit"></i></button></td>' +
                        '<td>';
                    if (editflag == 1) {
                        html += ' <button  class="edit_data btn btn-sm  btn-xs  btn-primary" id="' + data[i].id + '"  ><i class="fa fa-edit"></i></button>&nbsp;';
                    }
                    if (delflag == 1) {
                        html += ' <button name="delete" value="Delete" class="delete_data btn btn-xs btn-danger" id=' +
                            data[i].id + '><i class="fa fa-trash"></i></button>';
                    }
                    if (delflag != 1 && editflag != 1) {
                        html += '-';
                    }
                    html += '</td></tr>';
                }

                html += '</tbody></table>';
                $('#show_master').html(html);
                //$('#myTable').DataTable({});
            }

        });
    }



    /*---------get data into area_master end-----------------*/

    $(document).on('click', '.closehideshow', function() {
        form_clear();
    });

    function form_clear() {

        $('#category').val('');


        $('#save_update').val('');

    }


    /*---------get  role_master  start-----------------*/

    $(document).on('click', '.edit_data', function(e) {
        e.preventDefault();

        var id1 = $(this).attr('id');
        if (Createflag != 1) {

            $("#btnsave").removeAttr("disabled");
        }


        var name = $('#name_' + id1).html();

        $('#category').val(name);


        $('#save_update').val(id1);



    });
    if (Createflag != 1) {

        $("#btnsave").attr("disabled", "disabled");
    }
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
            url: baseurl + "Categorycontroller/delete_master",
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
                    show_master(); //call function show all product					
                }


            }
        });

    });

    /*---------delete  area_master  end-----------------*/

    $(document).on('blur', '#category', function() {
        var category = $('#category').val();


        var id = $('#save_update').val();

        $.ajax({
            type: "POST",
            url: baseurl + "Categorycontroller/checkcategorytypeexist",
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

                    // $.notify({
                    //     title: '',
                    //     message: '<strong>Category Type Already Exists</strong>'
                    // }, {
                    //     type: 'success'
                    // });
                } else {
                    validate = 0;
                }
            }
        });
    });


});