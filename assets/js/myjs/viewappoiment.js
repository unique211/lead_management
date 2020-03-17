$(document).ready(function() {
    var table_name = "category_type";
    var validate = 0;
    var editid = '';



    $(document).on('click', '.edit_icon_style_app', function(e) {
        e.preventDefault();

        editid = $(this).attr('id');

        datashow();
    });

    $(document).on('click', '#add_btnnotes', function(e) {
        e.preventDefault();
        var notes = $('#demo_note').val();
        var saveid = $('#save_update').val();
        if (notes != "") {
            $.ajax({
                type: "POST",
                url: baseurl + "Viewappoimentcontroller/save_notes",
                dataType: "JSON",
                async: false,
                data: {
                    id: saveid,
                    editid: editid,
                    notes: notes
                },
                success: function(data) {
                    datashow();
                    from_clear();
                }
            });
        }

    });


    function datashow() {
        //laast chane
        $.ajax({
            type: "POST",
            url: baseurl + "Viewappoimentcontroller/get_master",
            dataType: "JSON",
            async: false,
            data: {
                editid: editid,
                table_name: "demo_notes_entry",
            },
            success: function(data) {
                var html = '';


                for (i = 0; i < data.length; i++) {


                    var date = data[i].created_at;
                    var fdateslt = date.split('-');
                    var time = fdateslt[2].split(' ');
                    var checkintime = time[0] + '/' + fdateslt[1] + '/' + fdateslt[0];
                    html += '<tr>' +
                        '<td  id="date_' + data[i].id + '"  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + checkintime + '</td>' +
                        '<td  id="notes_' + data[i].id + '"  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].notes + '</td>' +
                        '<td  id="userid_' + data[i].id + '"   style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].first_name + '' + data[i].last_name + '</td>';
                    if (data[i].status == 0) {
                        //  html += "<td>-</td>"
                    } else {
                        //  html += '<td> <button  class="edit_data btn btn-sm  btn-xs  btn-primary" id="' + data[i].id + '"  ><i class="fa fa-edit"></i></button>&nbsp;<button name="delete" value="Delete" class="delete_data btn btn-xs btn-danger" id=' + data[i].id + '><i class="fa fa-trash"></i></button></td>';
                    }

                    '</tr>';
                }

                $('#ac_notes_tbody').html(html);


            }
        });
        $.ajax({
            type: "POST",
            url: baseurl + "Viewappoimentcontroller/get_master1",
            dataType: "JSON",
            async: false,
            data: {
                editid: editid,
                table_name: "resechedul_appoiment",
            },
            success: function(data) {
                var html = '';


                for (i = 0; i < data.length; i++) {
                    var date = data[i].r_date;
                    var tdateAr = date.split('-');
                    date = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0];
                    html += '<tr>' +
                        '<td  id="date_' + data[i].id + '"  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + date + '</td>' +
                        '<td  id="notes_' + data[i].id + '"  style="white-space:nowrap;text-align:left;padding:10px 10px;">' + data[i].r_time + '</td>';



                    '</tr>';
                }
                $('#rescheduletb_tbody').html(html);

            }

        });

    }
    $(document).on('click', '.edit_data', function(e) {
        e.preventDefault();

        var id = $(this).attr('id');
        var notes = $('#notes_' + id).html();

        $('#demo_note').val(notes);
        $('#save_update').val(id);


    });

    function from_clear() {
        $('#demo_note').val('');
        $('#save_update').val('');
    }

    $(document).on('click', '.delete_data', function(e) {
        e.preventDefault();

        var id1 = $(this).attr('id');

        //  alert('from here' + id1);
        $.ajax({
            type: "POST",
            url: baseurl + "Viewappoimentcontroller/delete_master",
            dataType: "JSON",
            data: {
                id: id1,
                table_name: 'demo_notes_entry',
            },
            success: function(data) {
                if (data == true) {

                    datashow(); //call function show all product					
                }


            }
        });

    });


});