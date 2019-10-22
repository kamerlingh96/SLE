<hr />
<?php echo form_open(base_url() . 'index1.1.php?student/attendance_report_selector/'.$student_id); ?>
<div class="row">

    <div class="col-md-offset-3 col-md-2">
         <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('month'); ?></label>
            <select name="month" class="form-control selectboxit">
                <?php
                for ($i = 1; $i <= 12; $i++):
                    if ($i == 1)
                        $m = 'enero';
                    else if ($i == 2)
                        $m = 'febrero';
                    else if ($i == 3)
                        $m = 'marzo';
                    else if ($i == 4)
                        $m = 'abril';
                    else if ($i == 5)
                        $m = 'mayo';
                    else if ($i == 6)
                        $m = 'junio';
                    else if ($i == 7)
                        $m = 'julio';
                    else if ($i == 8)
                        $m = 'agosto';
                    else if ($i == 9)
                        $m = 'septiembre';
                    else if ($i == 10)
                        $m = 'octubre';
                    else if ($i == 11)
                        $m = 'noviembre';
                    else if ($i == 12)
                        $m = 'diciembre';
                    ?>
                    <option value="<?php echo $i; ?>"
                          <?php if($month == $i) echo 'selected'; ?>  >
                                <?php echo get_phrase($m); ?>
                    </option>
                    <?php
                endfor;
                ?>
            </select>
         </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('sessional_year'); ?></label>
            <select class="form-control selectboxit" name="sessional_year" disabled>
                <?php
                $sessional_year_options = explode('-', $running_year); ?>
                <option value="<?php echo $sessional_year_options[0]; ?>"><?php echo $sessional_year_options[0]; ?></option>
                <option value="<?php echo $sessional_year_options[1]; ?>"><?php echo $sessional_year_options[1]; ?></option>
            </select>
        </div>
    </div>

    <input type="hidden" name="operation" value="selection">
    <input type="hidden" name="year" value="<?php echo $running_year;?>">

	<div class="col-md-2" style="margin-top: 20px;">
		<button type="submit" class="btn btn-info"><?php echo get_phrase('show_report');?></button>
	</div>
</div>

<?php echo form_close(); ?>


<!-- Attendance Table starts from here -->
<?php if ($class_id != '' && $section_id != '' && $month != '' && $sessional_year != '' && $student_id != ''): ?>

    <br>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4" style="text-align: center;">
            <div class="tile-stats tile-gray">
                <div class="icon"><i class="entypo-docs"></i></div>
                <h3 style="color: #696969;">
                    <?php
                    $section_name = $this->db->get_where('section', array('section_id' => $section_id))->row()->name;
                    $class_name = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
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
                    echo get_phrase('attendance_sheet');
                    ?>
                </h3>
                <h4 style="color: #696969;">
    <?php echo get_phrase('class') . ' ' . $class_name; ?> : <?php echo get_phrase('section');?> <?php echo $section_name; ?><br>
    <?php echo $m . ', ' . $sessional_year; ?>
                </h4>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>


    <hr />

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered" id="my_table">
                <thead>
                    <tr>
                        <td style="text-align: center;">
    <?php echo get_phrase('students'); ?> <i class="entypo-down-thin"></i> | <?php echo get_phrase('date'); ?> <i class="entypo-right-thin"></i>
                        </td>
    <?php
    $year = explode('-', $running_year);
    $days = cal_days_in_month(CAL_GREGORIAN, $month, $sessional_year);
    for ($i = 1; $i <= $days; $i++) {
        ?>
                            <td style="text-align: center;"><?php echo $i; ?></td>
                    <?php } ?>
                    <td style="text-align: center;">Recompensas</td>
                    </tr>
                </thead>

                <tbody>
                            <?php
                            $data = array();

                            $students = $this->db->get_where('enroll', array('student_id' => $student_id,'class_id' => $class_id, 'year' => $running_year, 'section_id' => $section_id))->result_array();
                            if (sizeof($students) > 0):
                            foreach ($students as $row):
                                ?>
                        <tr>
                            <td style="text-align: center;">
                            <?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name; ?>
                            </td>
                            <?php
                            $status = 0;
                            $recompensas = 0;
                            for ($i = 1; $i <= $days; $i++) {
                                $timestamp = strtotime($i . '-' . $month . '-' . $sessional_year);
                                //$this->db->group_by('timestamp');
                                $attendance = $this->db->get_where('attendance', array('section_id' => $section_id, 'class_id' => $class_id, 'year' => $running_year, 'timestamp' => $timestamp, 'student_id' => $row['student_id']))->result_array();

                                foreach ($attendance as $row1):
                                    $month_dummy = date('d', $row1['timestamp']);

                                    if ($i == $month_dummy)
                                    $status = $row1['status'];
                                    $recompensa = $row1['recompensas'];
                                    $recompensas = $recompensas+$recompensa;


                                endforeach;
                                ?>
                                <td style="text-align: center;">
            <?php if ($status == 1) { ?>
                                        <i class="entypo-record" style="color: #00a651;"></i>/<?=$recompensa?>
                            <?php  } if($status == 2)  { ?>
                                        <i class="entypo-record" style="color: #ee4749;"></i>
            <?php  } $status =0;?>


                                </td>

        <?php } ?>
    <?php endforeach; ?>
  <?php endif; ?>
  <td style="text-align: center;"><?=$recompensas?></td>

                    </tr>

    <?php ?>

                </tbody>
            </table>
            <center>
                <a href="<?php echo base_url(); ?>index1.1.php/student/attendance_report_print_view/<?php echo $class_id; ?>/<?php echo $section_id; ?>/<?php echo $month; ?>/<?php echo $sessional_year; ?>/<?php echo $student_id; ?>"
                   class="btn btn-primary" target="_blank">
    <?php echo get_phrase('print_attendance_sheet'); ?>
                </a>
            </center>
        </div>
    </div>
<?php endif; ?>
