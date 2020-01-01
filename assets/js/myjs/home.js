$(document).ready(function() {
    var table_name = "category_type";
    var validate = 0;
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

    //  show_master(); //call function show data table



    function show_master() {

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
                        '<td><button  class="edit_data btn btn-sm  btn-xs  btn-primary" id="' + data[i].id + '"  ><i class="fa fa-edit"></i></button>&nbsp;<button name="delete" value="Delete" class="delete_data btn btn-xs btn-danger" id=' +
                        data[i].id + '><i class="fa fa-trash"></i></button></td>' +
                        '</tr>';
                }

                html += '</tbody></table>';
                $('#show_master').html(html);
                // $('#myTable').DataTable({});
            }

        });
    }

    /*---------get data into area_master end-----------------*/

    $(document).on('click', '.closehideshow', function() {
        form_clear();
    });




    /*---------get  role_master  start-----------------*/

    $(document).on('click', '.edit_data', function(e) {
        e.preventDefault();

        var id1 = $(this).attr('id');


        var name = $('#name_' + id1).html();

        $('#category').val(name);


        $('#save_update').val(id1);



    });



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
                getfinicialamt(userid);
                getfunalchart(userid);
            }
        });

    }

    $(document).on("change", "#salesrepresentive", function(e) {
        e.preventDefault();

        var uid = $(this).val();

        getfinicialamt(uid);
        getfunalchart(uid);


    });

    if (usertype == "SalesRepresentative" && userrole == "Sales") {
        getfinicialamt(useruniqueid);

        getfunalchart(useruniqueid);

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

    }

    function getfinicialamt(uid) {
        $.ajax({
            type: "POST",
            url: base_url + "Homecontroller/getfinicialamtdata",
            data: {
                uid: uid,
            },
            dataType: "JSON",
            async: false,
            success: function(data) {

                $('#targetyearamt').html(data[0].finicialyear_amt);

                var today = new Date();
                var fyear = today.getFullYear().toString();
                if ((today.getMonth() + 1) <= 3) {



                    fiscalyear = (parseInt(fyear) - parseInt(1)) + "-" + fyear;

                } else {
                    fiscalyear = parseInt(fyear) + "-" + (parseInt(fyear) + parseInt(1));
                    //fiscalyear=  fiscalyear.toString().substr(-2);
                }

                fiscalyear = fiscalyear.split('-');

                var apriltarget = 0;
                var apriltask = 0;

                var aprilexcess = 0;
                var aprilachieveper = 0;

                var mayachieved = 0;
                var juneachieved = 0;
                var julyachieved = 0;

                var augustachieved = 0;
                var septemberachieved = 0;
                var octomberachive = 0;
                var novemberachive = 0;
                var decemberachive = 0;
                var januaryachive = 0;
                var februaryachive = 0;
                var marchachive = 0;



                $.ajax({
                    type: "POST",
                    url: base_url + "Homecontroller/getfinicialyearwisedata",
                    data: {
                        startyear: fiscalyear[0],
                        endyear: fiscalyear[1],
                        uid: uid,
                    },
                    dataType: "JSON",
                    async: false,
                    success: function(data) {

                        console.log("data" + data);
                        for (i = 0; i < data.length; i++) {
                            if (i == 0) {
                                aprilachieved = data[i].sum;
                                aprilachieved = (parseFloat(aprilachieved) / 100000).toFixed(2);
                            }
                            if (i == 1) {
                                mayachieved = data[i].sum;
                                mayachieved = (parseFloat(mayachieved) / 100000).toFixed(2);
                            }
                            if (i == 2) {
                                juneachieved = data[i].sum;
                                juneachieved = (parseFloat(juneachieved) / 100000).toFixed(2);
                            }
                            if (i == 3) {
                                julyachieved = data[i].sum;
                                julyachieved = (parseFloat(julyachieved) / 100000).toFixed(2);
                            }
                            if (i == 4) {
                                augustachieved = data[i].sum;
                                augustachieved = (parseFloat(augustachieved) / 100000).toFixed(2);
                            }
                            if (i == 5) {
                                septemberachieved = data[i].sum;
                                septemberachieved = (parseFloat(septemberachieved) / 100000).toFixed(2);
                            }
                            if (i == 6) {
                                octomberachive = data[i].sum;
                                octomberachive = (parseFloat(octomberachive) / 100000).toFixed(2);
                            }
                            if (i == 7) {
                                novemberachive = data[i].sum;
                                novemberachive = (parseFloat(novemberachive) / 100000).toFixed(2);
                            }
                            if (i == 8) {
                                decemberachive = data[i].sum;
                                decemberachive = (parseFloat(decemberachive) / 100000).toFixed(2);
                            }
                            if (i == 9) {
                                januaryachive = data[i].sum;
                                januaryachive = (parseFloat(januaryachive) / 100000).toFixed(2);
                            }
                            if (i == 10) {
                                februaryachive = data[i].sum;
                                februaryachive = (parseFloat(februaryachive) / 100000).toFixed(2);
                            }
                            if (i == 10) {
                                marchachive = data[i].sum;
                                marchachive = (parseFloat(marchachive) / 100000).toFixed(2);
                            }

                        }
                    }
                });
                var q1tgt = 0;
                var q2target = 0;
                var q3target = 0;
                var q4target = 0;


                var q2task = 0;
                var q3task = 0;
                var q4task = 0;

                var q1achd = 0;
                var q2achd = 0;
                var q3achd = 0;
                var q4achd = 0;

                var q1excess = 0;
                var q2excess = 0;
                var q3excess = 0;
                var q4excess = 0;

                var q1achdper = 0;
                var q2achdper = 0;
                var q3achdper = 0;
                var q4achdper = 0;


                var q1achd = parseFloat(aprilachieved) + parseFloat(mayachieved) + parseFloat(juneachieved);
                var q2achd = parseFloat(julyachieved) + parseFloat(augustachieved) + parseFloat(septemberachieved);
                var q3achd = parseFloat(octomberachive) + parseFloat(novemberachive) + parseFloat(decemberachive);
                var q4achd = parseFloat(januaryachive) + parseFloat(februaryachive) + parseFloat(marchachive);


                var finicialyearamt = data[0].finicialyear_amt;
                // if (finicialyearamt > 0) {
                q1tgt = parseFloat(finicialyearamt) * parseFloat(0.22).toFixed(2);
                q2target = parseFloat(finicialyearamt) * parseFloat(0.25).toFixed(2);
                q3target = parseFloat(finicialyearamt) * parseFloat(0.26).toFixed(2);
                q4target = parseFloat(finicialyearamt) * parseFloat(0.27).toFixed(2);

                //Q1 Tgt @ 22% to Q4 Target @ 27%
                $('#q1tgt').html(q1tgt.toFixed(2));
                $('#q2target').html(q2target.toFixed(2));
                $('#q3target').html(q3target.toFixed(2));
                $('#q4target').html(q4target.toFixed(2));


                //Q1 Task--strat Q4 Task
                q2task = parseFloat(q1tgt) + parseFloat(q2target);
                q3task = parseFloat(q2task) + parseFloat(q3target);
                q4task = parseFloat(q3task) + parseFloat(q4target);

                $('#q1task').html(q1tgt.toFixed(2));
                $('#q2task').html(q2task.toFixed(2));
                $('#q3task').html(q3task.toFixed(2));
                $('#q4task').html(q4task.toFixed(2));

                //Q1 Achd to Q4 Achd

                // q1achd = 0;
                // q2achd = 0;
                // q3achd = 0;
                // q4achd = 0;

                $('#q1achd').html(q1achd.toFixed(2));
                $('#q2achd').html(q2achd.toFixed(2));
                $('#q3achd').html(q3achd.toFixed(2));
                $('#q4achd').html(q4achd.toFixed(2));

                //Q1 Excess to Q4 Excess
                q1excess = parseFloat(q1tgt) - parseFloat(q1achd);
                q2excess = parseFloat(q2task) - parseFloat(q2achd);
                q3excess = parseFloat(q3task) - parseFloat(q3achd);
                q4excess = parseFloat(q4task) - parseFloat(q4achd);

                $('#q1excess').html(q1excess.toFixed(2));
                $('#q2excess').html(q2excess.toFixed(2));
                $('#q3excess').html(q3excess.toFixed(2));
                $('#q4excess').html(q4excess.toFixed(2));

                //Q1  Achd % to Q4  Achd %

                q1achdper = (parseFloat(q1achd) / parseFloat(q1excess) * parseFloat(100)).toFixed(2);
                q2achdper = (parseFloat(q2achd) / parseFloat(q2excess) * parseFloat(100)).toFixed(2);
                q3achdper = (parseFloat(q3achd) / parseFloat(q3excess) * parseFloat(100)).toFixed(2);
                q4achdper = (parseFloat(q4achd) / parseFloat(q4excess) * parseFloat(100)).toFixed(2);

                $('#q1achdper').html(q1achdper + "%");
                $('#q2achdper').html(q2achdper + "%");
                $('#q3achdper').html(q3achdper + "%");
                $('#q4achdper').html(q4achdper + "%");



                //for Second Table Start---


                //Q1 @ 22%April @ 5%




                apriltarget = (parseFloat(finicialyearamt) * parseFloat(0.05)).toFixed(2);
                aprilexcess = (parseFloat(apriltarget)).toFixed(2);
                aprilachieveper = (parseFloat(aprilachieved) / parseFloat(apriltarget) * parseFloat(100)).toFixed(2);

                $('#apriltarget').html(apriltarget);
                $('#apriltask').html(apriltarget);
                $('#aprilacheive').html(aprilachieved);
                $('#aprilexcess').html(apriltarget);
                $('#aprilachieveper').html(aprilachieveper + "%");


                //Q1 @ 22%May @ 8%
                var maytarget = 0;
                var maytask = 0;

                var mayexcess = 0;
                var mayachieveper = 0;

                maytarget = (parseFloat(finicialyearamt) * parseFloat(0.08)).toFixed(2);
                maytask = (parseFloat(maytarget) + parseFloat(aprilexcess)).toFixed(2);
                mayexcess = (parseFloat(maytask) - parseFloat(mayachieved)).toFixed(2);
                mayachieveper = (parseFloat(mayachieved) / parseFloat(maytask) * parseFloat(100)).toFixed(2); ///last chanes


                $('#maytarget').html(maytarget);
                $('#maytask').html(maytask);
                $('#mayachieve').html(mayachieved);
                $('#mayaccess').html(mayexcess);
                $('#mayper').html(mayachieveper + "%");


                //Q1 @ 22% June @ 9%
                var junetarget = 0;
                var junetask = 0;

                var juneexcess = 0;
                var juneachieveper = 0;

                junetarget = (parseFloat(finicialyearamt) * parseFloat(0.09)).toFixed(2);
                junetask = (parseFloat(junetarget) + parseFloat(mayexcess)).toFixed(2);
                juneexcess = (parseFloat(junetask) - parseFloat(juneachieved)).toFixed(2);
                juneachieveper = (parseFloat(juneachieved) / parseFloat(junetask) * parseFloat(100)).toFixed(2); ///last chanes


                $('#junetarget').html(junetarget);
                $('#junetask').html(junetask);
                $('#juneachive').html(juneachieved);
                $('#juneaccess').html(juneexcess);
                $('#juneper').html(juneachieveper + "%");

                // Over All Q1

                var overallq1target = 0;
                var overallq1task = 0;
                var overallq1achieved = 0;
                var overallq1excess = 0;
                var overallq1achieveper = 0;


                overallq1target = (parseFloat(apriltarget) + parseFloat(maytarget) + parseFloat(junetarget)).toFixed(2);
                overallq1task = junetask;
                overallq1achieved = (parseFloat(aprilachieved) + parseFloat(mayachieved) + parseFloat(juneachieved)).toFixed(2);
                overallq1excess = (parseFloat(overallq1task) - parseFloat(overallq1achieved));
                overallq1achieveper = (parseFloat(overallq1achieved) / parseFloat(overallq1task) * parseFloat(100)).toFixed(2);

                $('#overallq1target').html(overallq1target);
                $('#overallq1task').html(overallq1task);
                $('#overallq1achive').html(overallq1achieved);
                $('#overallq1access').html(overallq1excess);
                $('#overallq1per').html(overallq1achieveper + "%");


                //Q2 @ 25%
                //for july
                var julytarget = 0;
                var julytask = 0;

                var julyexcess = 0;
                var julyachieveper = 0;

                julytarget = (parseFloat(finicialyearamt) * parseFloat(0.08)).toFixed(2);
                julytask = (parseFloat(julytarget) + parseFloat(overallq1excess)).toFixed(2);
                julyexcess = (parseFloat(julytask) - parseFloat(julyachieved)).toFixed(2);
                julyachieveper = (parseFloat(julyachieved) / parseFloat(julytask) * parseFloat(100)).toFixed(2); ///last chanes

                $('#julytarget').html(julytarget);
                $('#julytask').html(julytask);
                $('#julyachive').html(julyachieved);
                $('#julyexcess').html(julyexcess);
                $('#julyper').html(julyachieveper + "%");



                //for August
                var augusttarget = 0;
                var augusttask = 0;

                var augustexcess = 0;
                var augustachieveper = 0;

                augusttarget = (parseFloat(finicialyearamt) * parseFloat(0.09)).toFixed(2);
                augusttask = (parseFloat(augusttarget) + parseFloat(julyexcess)).toFixed(2);
                augustexcess = (parseFloat(augusttask) - parseFloat(augustachieved)).toFixed(2);
                augustachieveper = (parseFloat(augustachieved) / parseFloat(augusttask) * parseFloat(100)).toFixed(2); ///last chanes

                $('#augusttarget').html(augusttarget);
                $('#augusttask').html(augusttask);
                $('#augustachive').html(augustachieved);
                $('#augustexcess').html(augustexcess);
                $('#augustper').html(augustachieveper + "%");


                //for September--

                var septembertarget = 0;
                var septembertask = 0;

                var septemberexcess = 0;
                var septemberachieveper = 0;

                septembertarget = (parseFloat(finicialyearamt) * parseFloat(0.08)).toFixed(2);
                septembertask = (parseFloat(septembertarget) + parseFloat(augustexcess)).toFixed(2);
                septemberexcess = (parseFloat(septembertask) - parseFloat(septemberachieved)).toFixed(2);
                septemberachieveper = (parseFloat(septemberachieved) / parseFloat(septembertask) * parseFloat(100)).toFixed(2); ///last chanes

                $('#septembertarget').html(septembertarget);
                $('#septembertask').html(septembertask);
                $('#septemberachive').html(septemberachieved);
                $('#septemberexcess').html(septemberexcess);
                $('#septemberper').html(septemberachieveper + "%");


                // Over All Q2

                var overallq2target = 0;
                var overallq2task = 0;
                var overallq2achieved = 0;
                var overallq2excess = 0;
                var overallq2achieveper = 0;


                overallq2target = (parseFloat(julytarget) + parseFloat(augusttarget) + parseFloat(septembertarget)).toFixed(2);
                overallq2task = (parseFloat(overallq1target) + parseFloat(overallq2target)).toFixed(2);;
                overallq2achieved = (parseFloat(septemberachieved) + parseFloat(augustachieved) + parseFloat(julyachieved)).toFixed(2);
                overallq2excess = (parseFloat(overallq2task) - parseFloat(overallq2achieved)).toFixed(2);
                overallq2achieveper = (parseFloat(overallq2achieved) / parseFloat(overallq2task) * parseFloat(100)).toFixed(2);

                $('#overallq2target').html(overallq2target);
                $('#overallq2task').html(overallq2task);
                $('#overallq2achive').html(overallq2achieved);
                $('#overallq2access').html(overallq2excess);
                $('#overallq2per').html(overallq2achieveper + "%");

                //for H1 @ 47%

                var h1target = 0;

                var h1achieved = 0;
                var h1excess = 0;
                var h1achieveper = 0;

                h1target = (parseFloat(overallq2target) + parseFloat(overallq1target)).toFixed(2);
                h1achieved = (parseFloat(overallq2achieved) + parseFloat(overallq1achieved)).toFixed(2);
                h1excess = (parseFloat(h1target) - parseFloat(h1achieved)).toFixed(2);
                h1achieveper = (parseFloat(h1achieved) / parseFloat(h1target) * parseFloat(100)).toFixed(2);


                $('#h1target').html(h1target);
                $('#h1task').html(h1target);
                $('#h1achive').html(h1achieved);
                $('#h1excess').html(h1excess);
                $('#h1per').html(h1achieveper + "%");


                //Q3 @ 26%

                //for Octomber
                var octombertarget = 0;
                var octombertask = 0;

                var octomberexcess = 0;
                var octomberper = 0;

                octombertarget = (parseFloat(finicialyearamt) * parseFloat(0.08)).toFixed(2);
                octombertask = (parseFloat(octombertarget) + parseFloat(septemberexcess)).toFixed(2);
                octomberexcess = (parseFloat(octombertask) - parseFloat(octomberachive)).toFixed(2);
                octomberper = (parseFloat(octomberachive) / parseFloat(octombertask) * parseFloat(100)).toFixed(2); ///last chanes

                $('#octombertarget').html(octombertarget);
                $('#octombertask').html(octombertask);
                $('#octomberachive').html(octomberachive);
                $('#octomberexcess').html(octomberexcess);
                $('#octomberper').html(octomberper + "%");


                //for November @ 9%
                var novembertarget = 0;
                var novembertask = 0;

                var novemberexcess = 0;
                var novemberper = 0;

                novembertarget = (parseFloat(finicialyearamt) * parseFloat(0.09)).toFixed(2);
                novembertask = (parseFloat(novembertarget) + parseFloat(octomberexcess)).toFixed(2);
                novemberexcess = (parseFloat(novembertask) - parseFloat(novemberachive)).toFixed(2);
                novemberper = (parseFloat(novemberachive) / parseFloat(novembertask) * parseFloat(100)).toFixed(2); ///last chanes

                $('#novembertarget').html(novembertarget);
                $('#novembertask').html(novembertask);
                $('#novemberachive').html(novemberachive);
                $('#novemberexcess').html(novemberexcess);
                $('#novemberper').html(novemberper + "%");


                //for DEcember @ 9%
                var decembertarget = 0;
                var decembertask = 0;

                var decemberexcess = 0;
                var decemberper = 0;

                decembertarget = (parseFloat(finicialyearamt) * parseFloat(0.09)).toFixed(2);
                decembertask = (parseFloat(decembertarget) + parseFloat(novemberexcess)).toFixed(2);
                decemberexcess = (parseFloat(decembertask) - parseFloat(decemberachive)).toFixed(2);
                decemberper = (parseFloat(decemberachive) / parseFloat(decembertask) * parseFloat(100)).toFixed(2); ///last chanes

                $('#decembertarget').html(decembertarget);
                $('#decembertask').html(decembertask);
                $('#decemberachive').html(decemberachive);
                $('#decemberexcess').html(decemberexcess);
                $('#decemberper').html(decemberper + "%");



                // Over All Q3

                var overallq3target = 0;
                var overallq3task = 0;
                var overallq3achieved = 0;
                var overallq3excess = 0;
                var overallq3achieveper = 0;


                overallq3target = (parseFloat(decembertarget) + parseFloat(novembertarget) + parseFloat(octombertarget)).toFixed(2);
                overallq3task = (parseFloat(overallq2task) + parseFloat(overallq3target)).toFixed(2);;
                overallq3achieved = (parseFloat(decemberachive) + parseFloat(novemberachive) + parseFloat(octomberachive));
                overallq3excess = (parseFloat(overallq3task) - parseFloat(overallq3achieved)).toFixed(2);
                overallq3achieveper = (parseFloat(overallq3achieved) / parseFloat(overallq3task) * parseFloat(100)).toFixed(2);

                $('#overallq3target').html(overallq3target);
                $('#overallq3task').html(overallq3task);
                $('#overallq3achieved').html(overallq3achieved);
                $('#overallq3excess').html(overallq3excess);
                $('#overallq3achieveper').html(overallq3achieveper + "%");



                //for January @ 9%
                var januarytarget = 0;
                var januarytask = 0;

                var januaryexcess = 0;
                var januaryper = 0;

                januarytarget = (parseFloat(finicialyearamt) * parseFloat(0.09)).toFixed(2);
                januarytask = (parseFloat(januarytarget) + parseFloat(overallq3excess)).toFixed(2);
                januaryexcess = (parseFloat(januarytask) - parseFloat(januaryachive)).toFixed(2);
                januaryper = (parseFloat(januaryachive) / parseFloat(januarytask) * parseFloat(100)).toFixed(2); ///last chanes

                $('#januarytarget').html(januarytarget);
                $('#januarytask').html(januarytask);
                $('#januaryachive').html(januaryachive);
                $('#januaryexcess').html(januaryexcess);
                $('#januaryper').html(januaryper + "%");


                //for February @ 8%
                var februarytarget = 0;
                var februarytask = 0;

                var februaryexcess = 0;
                var februaryper = 0;

                februarytarget = (parseFloat(finicialyearamt) * parseFloat(0.08)).toFixed(2);
                februarytask = (parseFloat(februarytarget) + parseFloat(januaryexcess)).toFixed(2);
                februaryexcess = (parseFloat(februarytask) - parseFloat(februaryachive)).toFixed(2);
                februaryper = (parseFloat(februaryachive) / parseFloat(februarytask) * parseFloat(100)).toFixed(2); ///last chanes

                $('#februarytarget').html(februarytarget);
                $('#februarytask').html(februarytask);
                $('#februaryachive').html(februaryachive);
                $('#februaryexcess').html(februaryexcess);
                $('#februaryper').html(februaryper + "%");

                //for March @ 10%

                var marchtarget = 0;
                var marchtask = 0;

                var marchexcess = 0;
                var marchyper = 0;

                marchtarget = (parseFloat(finicialyearamt) * parseFloat(0.10)).toFixed(2);
                marchtask = (parseFloat(marchtarget) + parseFloat(februaryexcess)).toFixed(2);
                marchexcess = (parseFloat(marchtask) - parseFloat(marchachive)).toFixed(2);
                marchyper = (parseFloat(marchachive) / parseFloat(marchtask) * parseFloat(100)).toFixed(2); ///last chanes

                $('#marchtarget').html(marchtarget);
                $('#marchtask').html(marchtask);
                $('#marchachive').html(marchachive);
                $('#marchexcess').html(marchexcess);
                $('#marchyper').html(marchyper + "%");


                // Over All Q4

                var overallq4target = 0;
                var overallq4task = 0;
                var overallq4achieved = 0;
                var overallq4excess = 0;
                var overallq4achieveper = 0;


                overallq4target = (parseFloat(januarytarget) + parseFloat(februarytarget) + parseFloat(marchtarget)).toFixed(2);
                overallq4task = (parseFloat(overallq3task) + parseFloat(overallq4target)).toFixed(2);;
                overallq4achieved = (parseFloat(januaryachive) + parseFloat(februaryachive) + parseFloat(marchachive)).toFixed(2);
                overallq4excess = (parseFloat(overallq4task) - parseFloat(overallq4achieved)).toFixed(2);
                overallq4achieveper = (parseFloat(overallq4achieved) / parseFloat(overallq4task) * parseFloat(100));

                $('#overallq4target').html(overallq4target);
                $('#overallq4task').html(overallq4task);
                $('#overallq4achive').html(overallq4achieved);
                $('#overallq4excess').html(overallq4excess);
                $('#overallq4achieveper').html(overallq4achieveper + "%");

                //H2 @ 53%
                var h2target = 0;
                var h2task = 0;
                var h2achieved = 0;
                var h2excess = 0;
                var h2achieveper = 0;






                h2target = (parseFloat(overallq3target) + parseFloat(overallq4target)).toFixed(2);

                h2task = (parseFloat(h2target) + parseFloat(h1target)).toFixed(2);
                h2achieved = (parseFloat(overallq4achieved) + parseFloat(overallq3achieved)).toFixed(2);
                h2excess = (parseFloat(h2task) - parseFloat(h2achieved)).toFixed(2);
                h2achieveper = (parseFloat(h2achieved) / parseFloat(h2excess) * parseFloat(100)).toFixed(2);

                $('#h2target').html(h2target);
                $('#h2task').html(h2task);
                $('#h2achive').html(h2achieved);
                $('#h2excess').html(h2excess);
                $('#h2per').html(h2achieveper + "%");


                //Yearly 
                var yeartarget = 0;
                var yeartask = 0;
                var yearachieved = 0;
                var yearexcess = 0;
                var yearachieveper = 0;

                yearachieved = (parseFloat(h2achieved) + parseFloat(h1achieved)).toFixed(2);
                yearexcess = (parseFloat(finicialyearamt) - parseFloat(yearachieved)).toFixed(2);
                yearachieveper = (parseFloat(yearachieved) / parseFloat(finicialyearamt) * parseFloat(100)).toFixed(2);

                $('#yeartarget').html(finicialyearamt);
                $('#yeartask').html(finicialyearamt);
                $('#yearacheive').html(yearachieved);
                $('#yearexcess').html(yearexcess);
                $('#yearper').html(yearachieveper);



                //   }




            }
        });
    }

    function getCurrentFinancialYear() {
        var fiscalyear = "";
        var today = new Date();
        var fyear = today.getFullYear().toString().substr(-2);
        if ((today.getMonth() + 1) <= 3) {



            fiscalyear = (parseInt(fyear) - parseInt(1)) + "-" + fyear;

        } else {
            fiscalyear = parseInt(fyear) + "-" + (parseInt(fyear) + parseInt(1));
            //fiscalyear=  fiscalyear.toString().substr(-2);
        }
        return fiscalyear
    }





    var currentfbyear = getCurrentFinancialYear();
    $('#targetcurrerenyear').html("Target for FY" + currentfbyear + "(in Lakhs)");






    //for funnel chart
    function getfunalchart(uid) {

        var today = new Date();

        var Quatation = 0;
        var ConformQuatation = 0;
        var Order = 0;


        var fyear = today.getFullYear().toString();
        if ((today.getMonth() + 1) <= 3) {



            fiscalyear = (parseInt(fyear) - parseInt(1)) + "-" + fyear;

        } else {
            fiscalyear = parseInt(fyear) + "-" + (parseInt(fyear) + parseInt(1));
            //fiscalyear=  fiscalyear.toString().substr(-2);
        }

        fiscalyear = fiscalyear.split('-');
        var statdate = fiscalyear[0] + "-" + "04" + "-" + "01";



        console.log("statdate" + statdate);
        $.ajax({
            type: "POST",
            url: base_url + "Homecontroller/funnelchartdata",
            data: {
                statdate: statdate,
                // fiscalyear: fiscalyear,

                uid: uid,
            },
            dataType: "JSON",
            async: false,
            success: function(data) {



                Quatation = data[0].qutationsum;
                ConformQuatation = data[0].conformsum;
                Order = data[0].ordersum;




                Quatation = parseFloat(Quatation) / parseFloat(100000);
                ConformQuatation = parseFloat(ConformQuatation) / parseFloat(100000);
                Order = parseFloat(Order) / parseFloat(100000);

                var config = {
                    type: 'funnel',
                    data: {
                        datasets: [{
                            data: [Quatation, ConformQuatation, Order],
                            backgroundColor: [
                                "#FF6384",
                                "#36A2EB",
                                "#FFCE56"
                            ],
                            hoverBackgroundColor: [
                                "#FF6384",
                                "#36A2EB",
                                "#FFCE56"
                            ]
                        }],
                        labels: [
                            "Quotation(In Lakh's)",
                            "ConfirmQuatation(In Lakh's)",
                            "Order(In Lakh's)"
                        ]
                    },
                    options: {
                        responsive: true,
                        sort: 'desc',
                        legend: {
                            position: 'top'
                        },
                        title: {
                            display: true,
                            text: 'Lead Management'
                        },
                        animation: {
                            animateScale: true,
                            animateRotate: true
                        }
                    }
                };

                window.onload = function() {
                    var ctx = document.getElementById("chart-area").getContext("2d");
                    window.myDoughnut = new Chart(ctx, config);
                };

            }
        });


    }




});

