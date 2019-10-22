<?php

$total_income = 0;
$payments = $this->db->get_where('payment', array('year' => $running_year, 'payment_type' => 'income'))->result_array();
foreach($payments as $row)
	$total_income += $row['amount'];

$total_expense = 0;
$payments = $this->db->get_where('payment', array('year' => $running_year, 'payment_type' => 'expense'))->result_array();
foreach($payments as $row)
	$total_expense += $row['amount'];
?>



<hr />
<div class="row">
	<div class="col-md-8">
    	<div class="row">
            <!-- CALENDAR-->
            <div class="col-md-12 col-xs-12">
                <div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-calendar"></i>
                            <?php echo get_phrase('event_schedule');?>
                        </div>
                    </div>
                    <div class="panel-body" style="padding:0px;">
                        <div class="calendar-env">
                            <div class="calendar-body">
                                <div id="notice_calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<div class="col-md-4">
		<div class="row">
            <div class="col-md-12">

                <div class="tile-stats tile-red">
                    <div class="icon"><i class="fa fa-group"></i></div>
                    <div class="num" data-start="0"
												data-end="
													<?php
														$number_of_student_in_current_session = $this->db->get_where('enroll', array('year' => $running_year))->num_rows();
														echo $number_of_student_in_current_session;
														//echo $this->db->count_all('student');
													?>
													"
                    		data-postfix="" data-duration="1500" data-delay="0">0</div>

                    <h3><?php echo get_phrase('student');?></h3>
                   <p>Total de Estudiantes</p>
                </div>

            </div>
            <div class="col-md-12">

                <div class="tile-stats tile-green">
                    <div class="icon"><i class="entypo-users"></i></div>
                    <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('teacher');?>"
                    		data-postfix="" data-duration="800" data-delay="0">0</div>

                    <h3><?php echo get_phrase('teacher');?></h3>
                   <p>Total de Docentes</p>
                </div>

            </div>
            <div class="col-md-12">

                <div class="tile-stats tile-blue">
                    <div class="icon"><i class="entypo-chart-bar"></i></div>
                    <?php
						$check	=	array(	'timestamp' => strtotime(date('Y-m-d')) , 'status' => '1' );
						$query = $this->db->get_where('attendance' , $check);
						$present_today		=	$query->num_rows();
						?>
                    <div class="num" data-start="0" data-end="<?php echo $present_today;?>"
                    		data-postfix="" data-duration="500" data-delay="0">0</div>

                    <h3><?php echo get_phrase('attendance');?></h3>
                   <p>Total de Estudiantes presentes hoy</p>
                </div>
            </div>
					<div class="col-md-12">

				        <div class="tile-stats tile-green">
				            <div class="icon" style="margin-bottom: 20px;"><i class="fa fa-money" style="padding-right: 10px;"></i></div>
				            <div class="num" data-start="0" data-end="<?php echo $total_income; ?>"
				            		data-postfix="" data-duration="800" data-delay="0">0</div>

				            <h3><?php echo get_phrase('total_income'); ?></h3>
				        </div>

				    </div>

				    <div class="col-md-12">

				        <div class="tile-stats tile-aqua">
				            <div class="icon" style="margin-bottom: 20px;"><i class="fa fa-tags" style="padding-right: 10px;"></i></div>
				            <div class="num" data-start="0" data-end="<?php echo $total_expense; ?>"
				            		data-postfix="" data-duration="500" data-delay="0">0</div>

				            <h3><?php echo get_phrase('total_expense');?></h3>
				        </div>

				    </div>
    	</div>
    </div>

</div>



    <script>
  $(document).ready(function() {

	  var calendar = $('#notice_calendar');

				$('#notice_calendar').fullCalendar({
					header: {
						left: 'title',
						right: 'today prev,next'
					},
					buttonText:{
						today: 'hoy'
					},
					monthNames:[
						'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio',
  					'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
					],
					dayNamesShort:[
						'Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'
					],

					//defaultView: 'basicWeek',

					editable: false,
					firstDay: 1,
					height: 530,
					droppable: false,

					events: [
						<?php
						$notices	=	$this->db->get('noticeboard')->result_array();
						foreach($notices as $row):
						?>
						{
							title: "<?php echo $row['notice_title'];?>",
							start: new Date(<?php echo date('Y',$row['create_timestamp']);?>, <?php echo date('m',$row['create_timestamp'])-1;?>, <?php echo date('d',$row['create_timestamp']);?>),
							end:	new Date(<?php echo date('Y',$row['create_timestamp']);?>, <?php echo date('m',$row['create_timestamp'])-1;?>, <?php echo date('d',$row['create_timestamp']);?>)
						},
						<?php
						endforeach
						?>

					]
				});
	});
  </script>
