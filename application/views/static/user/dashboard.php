

    <div id="wrapper">

    

        <div id="page-wrapper">

            <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Dashboard</h1>
                    </div>

            </div>

            <div class="row">

                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-calendar fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?=$todayEventsCount;?></div>
                                    <div>Events of Today!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Search Events</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <img src="<?=$user->picture?>" style="height:77px">
                                </div>
                            </div>
                        </div>
                        <a href="<?=$user->link;?>" target="_blank">
                            <div class="panel-footer">
                                <span class="pull-left"><?=$user->name;?></span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>


            <div class="row">

                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Events of Today
                        </div>

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Summary</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($events as $key => $foo):?>
                                        <tr>
                                            <td><?=($key+1);?></td>
                                            <td><?=$foo['summary'];?></td>
                                            <td><?=$foo['start'];?></td>
                                            <td><?=$foo['end'];?></td>
                                        </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


    </div>
      <div id="page-wrapper">

            <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Add Event</h1>
                    </div>

            </div>

            <?php if(isset($message)) echo $message;?>

            <div class="row">

                <div class="col-lg-12">

                    <div class="panel panel-default">

                        <div class="panel-heading">
                            Add Event
                        </div>

                        <div class="panel-body">

                            <div class="row">

                                <div class="col-lg-6">
<form method="addevent" action="post">
    <input type="text" name="summary" id="summary">
    <input type="text" name="">
    <input type="date" name="startDate" placeholder="startdate" id="startDate">
    <input type="time" name="startTime" id="startTime">
   <input type="date" name="endDate" placeholder="" id="endDate">
    <input type="time" name="endTime" id="endTime">
    <input type="text" name="description" id="description">
    <!-- <button id='addevent'>Add Event</button> -->
    <input type="submit" name="submit" value="submit" onclick="">
</form>
<!--                                     <form role="form" action="<?=base_url(uri_string());?>" method="POST">

                                        <div class="form-group">
                                            
                                            <label>Summary</label>

                                            <?php echo form_input( array( 'name' => 'summary', 'class' => 'form-control' , 'required' => true  ) );?>

                                        </div>

                                        <div class="form-group">
                                            
                                            <label class="col-lg-12" style="padding:0px;">Start Date / Time</label>

                                            <div class="col-lg-7" style="padding:0px;">

                                                <?php echo form_input( array( 'name' => 'startDate', 'type' => 'date' , 'class' => 'form-control' , 'required' => 'true' ) );?>

                                            </div>

                                            <div class="col-lg-5" style="padding:0px;"> 

                                                <?php echo form_input( array( 'name' => 'startTime', 'type' => 'time' , 'class' => 'form-control' , 'required' => 'true' ) );?>

                                            </div>

                                        </div>


                                        <div class="form-group">
                                            
                                            <label class="col-lg-12" style="padding:0px; margin-top:20px;">End Date / Time</label>

                                            <div class="col-lg-7" style="padding:0px;">

                                                <?php echo form_input( array( 'name' => 'endDate', 'type' => 'date' , 'class' => 'form-control' , 'required' => 'true' ) );?>

                                            </div>

                                            <div class="col-lg-5" style="padding:0px;"> 

                                                <?php echo form_input( array( 'name' => 'endTime', 'type' => 'time' , 'class' => 'form-control' , 'required' => 'true' ) );?>

                                            </div>

                                        </div>
                                        
                                        <div class="form-group">
                                            
                                            <label style="padding:0px; margin-top:20px;">Description</label>

                                            <?php echo form_textarea( array( 'name' => 'description', 'class' => 'form-control' , 'rows' => '5' ) );?>

                                        </div>

                                        <?php echo form_submit( array( 'value' => 'Save' , 'class' => 'btn btn-primary' , 'style' => 'margin-top:15px;' ) );?>

                                    </form> -->

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    <?php $this->load->view('footer');?>
<script type="text/javascript">
    $("#addevent").on('click', function(e) {

//calid=$("#calid").val();
/*    parameters = {  title: $("#event-title").val(), 
                    event_time: {
                        start_time: $("#event-type").val() == 'FIXED-TIME' ? $("#event-start-time").val().replace(' ', 'T') + ':00' : null,
                        end_time: $("#event-type").val() == 'FIXED-TIME' ? $("#event-end-time").val().replace(' ', 'T') + ':00' : null,
                        event_date: $("#event-type").val() == 'ALL-DAY' ? $("#event-date").val() : null
                    },
                   // all_day: $("#event-type").val() == 'ALL-DAY' ? 1 : 0,
                };*/
                s=$("#summary").val();
                sdate=$("#startDate").val();
                stime=$("#startTime").val();
                enddate=$("#endDate").val();
                endtime=$("#endTime").val();
                des=$("description").val();
                parameters={summary:s ,
                    start:sdate+'T'+stime+':00+03:00',
                      end:enddate+'T'+endtime+':00+03:00',
                      description:des};


    
    $.ajax({
        type: 'POST',
        url: 'ajax',
        data: { event_details: parameters,id:'primary' },
        dataType: 'json',
        success: function(response) {
            //alert(data);
            //console.log(data);
            $("#create-event").removeAttr('disabled');
            alert('Event created with ID : ' + response.event_id);
        },
        error: function(response) {
            $("#create-event").removeAttr('disabled');
            alert(response.responseJSON.message);
        }
    });
});
</script>
