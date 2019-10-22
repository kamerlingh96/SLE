<hr />

<form class="" action="<?php echo base_url() . 'index1.1.php/student/attendance_report_selector/'; ?>" method="post">
<div class="row">
    <div class="col-md-offset-3 col-md-3">
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

    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('sessional_year'); ?></label>
            <select class="form-control selectboxit" name="sessional_year">
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
</form>
