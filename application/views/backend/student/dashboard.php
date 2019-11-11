	<script src="<?php echo base_url('assets/js/confetti.js-master/index.min.js');?>"></script>
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

		<?php

		$month = date('m');

		if ($month == 1)
				$m = 'Enero';
		else if ($month == 2)
				$m = 'Febrero';
		else if ($month == 3)
				$m = 'Marzo';
		else if ($month == 4)
				$m = 'Abril';
		else if ($month == 5)
				$m = 'Mayo';
		else if ($month == 6)
				$m = 'Junio';
		else if ($month == 7)
				$m = 'Julio';
		else if ($month == 8)
				$m = 'Agosto';
		else if ($month == 9)
				$m = 'Septiembre';
		else if ($month == 10)
				$m = 'Octubre';
		else if ($month == 11)
				$m = 'Noviembre';
		else if ($month == 12)
				$m = 'Diciembre';

		 ?>

	<div class="col-md-4">
		<div class="row">

						<div class="col-md-12">

								<div class="tile-stats tile-green">
										<div class="icon"><i class="entypo-users"></i></div>
										<div class="num" style="font-size:20px;">"<?=$frases->frase?>"</div>

								</div>

						</div>

            <div class="col-md-12">

							<?php
							$year = explode('-', $running_year);
					    $days = cal_days_in_month(CAL_GREGORIAN, $month, $sessional_year);
							$data = array();

							$students = $this->db->get_where('enroll', array('student_id' => $student_id,'class_id' => $class_id, 'year' => $running_year, 'section_id' => $section_id))->result_array();
							if (sizeof($students) > 0):
								foreach ($students as $row):

								$status = 0;
								$recompensas = 0;

								$status2 = 0;
								$demeritos = 0;

								$compras = 0;




											//$this->db->group_by('timestamp');
											$attendance = $this->db->get_where('attendance', array('section_id' => $section_id, 'class_id' => $class_id, 'year' => $running_year, 'student_id' => $row['student_id']))->result_array();
											$compras_generadas = $this->db->get_where('compra', array( 'class_id' => $class_id, 'year' => $running_year, 'student_id' => $row['student_id']))->result_array();

											foreach ($attendance as $row1):



													$status = $row1['status'];
													$recompensa = $row1['recompensas'];
													$recompensas = $recompensas+$recompensa;

													$status2 = $row1['status'];
													$demerito = $row1['demerito'];
													$demeritos = $demeritos+$demerito;


											endforeach;

											foreach ($compras_generadas as $row1):
				                  $compra = $row1['valor'];
				                  $compras += $compra;


				              endforeach;



									endforeach;
								 endif;

								 $recompensas = $recompensas - $demeritos - $compras;

								 ?>

                <div class="tile-stats tile-red">
                    <div class="icon"><i class="fa fa-group"></i></div>
                    <div class="num" data-start="0" data-end="<?php echo $recompensas;?>"
                    		data-postfix="" data-duration="1500" data-delay="0">0</div>

                    <h3><?php echo get_phrase('recompensas');?></h3>
                   <p>Ciclo <?php echo $running_year; ?></p>
                </div>

            </div>

            <div class="col-md-12">

                <div class="tile-stats tile-aqua">
                    <div class="icon"><i class="entypo-user"></i></div>
										<div class="num" data-start="0" data-end="<?php echo $demeritos;?>"
                    		data-postfix="" data-duration="1500" data-delay="0">0</div>

                    <h3><?php echo "Deméritos";?></h3>
                   <p>Mes de <?php echo $m; ?></p>
                </div>

            </div>

						<div class="col-md-12">


							<?php
							$subjects = $this->db->get_where('subject' , array('class_id' => $class_id, 'year' => $running_year))->result();

									$checkEvaluacionViernes   =   array(  'timestamp' => strtotime("last Friday"), 'student_id' => $student_id, 'year' => $running_year,'class_id' => $class_id);
									$query = $this->db->get_where('evaluacion' , $checkEvaluacionViernes)->result();
									$mayorEvaluacion = false;
									foreach ($subjects as $subject) {
										foreach ($query as $value) {
											if ($subject->subject_id == $value->subject_id) {
												if ($value->evaluacion > 79) {
													$materia[] = $subject->name;
													$evaluacionFinal[] = $value->evaluacion;
													$mayorEvaluacion = true;
												}
											}
										}
									}

									/*echo "<pre>";
									print_r ( $query);
									echo "</pre>";*/
			?>



            </div>
            <div class="col-md-12">

                <div class="tile-stats tile-blue">
                    <div class="icon"><i class="entypo-chart-bar"></i></div>
                    <?php
						$check   =   array(  'timestamp' => strtotime(date('Y-m-d')) , 'status' => '1' );
                        $query = $this->db->get_where('attendance' , $check);
                        $present_today      =   $query->num_rows();
						?>
                    <div class="num" data-start="0" data-end="<?php echo $present_today;?>"
                    		data-postfix="" data-duration="500" data-delay="0">0</div>

                    <h3><?php echo get_phrase('attendance');?></h3>
                   <p>Total de estudiantes presentes hoy <?php  echo strtotime("last Friday");?></p>
                </div>

            </div>

    	</div>
    </div>

</div>


<!-- Central Modal Small -->
<div class="modal fade" id="centralModalSm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <!-- Change class .modal-sm to change the size of the modal -->
  <div class="modal-dialog modal-lg" role="document">


    <div class="modal-content">
      <div class="modal-body" id="modalFelicidades">
        <canvas id="my-canvas">
				</canvas>
				<div class="row" id="felicidadesModal" style=" top:0%;width:100%;height:100%; color:black;display: flex;justify-content: center;align-items: center;">
					<div class="col-md-12">
						<div class="row">
							<?php foreach ($materia as $key => $value): ?>
								<div class="col-md-8 text-center">
									<div class="row">
										<div class="col-md-12 felicidades1" style="font-size:50px;font-family:'Roboto', sans-serif; height:100%">
											<?php echo $value ?>
										</div>
									</div>
								</div>
								<div class="col-md-4 counter<?php echo $key ?> text-center felicidades1" style="font-size:50px;font-family:'Roboto', sans-serif;">
									0
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Central Modal Small -->






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

	<script src="<?php echo base_url('assets/js/confetti.js-master/index.min.js');?>"></script>

	<script type="text/javascript">
	window.onload = function() {
		if (<?php echo $mayorEvaluacion;?>) {
			felicidades();
		}
	};
	function felicidades(){
		$('#centralModalSm').modal('show');
		var delayInMilliseconds = 500; //1 second
		setTimeout(function() {
			var modalFelicidades = document.getElementById("modalFelicidades");
			var felicidadesModal = document.getElementById("felicidadesModal");
			console.log("hola; "+felicidadesModal.clientHeight);
			modalFelicidades.style.height = ""+felicidadesModal.clientHeight+"px"
			felicidadesModal.style.position = "absolute";

			console.log(modalFelicidades.clientWidth);
			console.log(modalFelicidades.clientWidth);
			var modalFelicidadesWidth =  modalFelicidades.clientWidth-15
			var modalFelicidadesHeight= modalFelicidades.clientHeight-15
			modalFelicidadesWidth = '' + modalFelicidadesWidth
			modalFelicidadesHeight= '' + modalFelicidadesHeight
			var confettiSettings = {
				target: 'my-canvas',
				width: modalFelicidadesWidth,
				height: modalFelicidadesHeight
			};
			var confetti = new ConfettiGenerator(confettiSettings);
			confetti.render();
			<?php foreach ($materia as $key => $value): ?>

			count<?php echo $key ?>();
			<?php endforeach; ?>
		}, delayInMilliseconds);
	}
	<?php foreach ($materia as $key => $value): ?>
	function count<?php echo $key ?>(){
		var counter = { var: 0 };
		TweenMax.to(counter, 3, {
			var: <?php echo $evaluacionFinal[$key]; ?>,
			onUpdate: function () {
				var number = Math.ceil(counter.var);
				$('.counter<?php echo $key ?>').html(number);
				if(number === counter.var){ count.kill(); }
			},
			onComplete: function(){
				count();
			},
			ease:Circ.easeOut
		});
	}
	<?php endforeach; ?>
	</script>
