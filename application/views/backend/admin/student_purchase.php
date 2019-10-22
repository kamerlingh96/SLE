<style>
  .exam_chart {
    width       : 100%;
    height      : 265px;
    font-size   : 11px;
  }
</style>

<?php
  $student_info = $this->db->get_where('student', array('student_id' => $student_id))->result_array();
  foreach ($student_info as $row):
    $enroll_info = $this->db->get_where('enroll', array(
      'student_id' => $row['student_id'], 'year' => $running_year
    ));
    $class_id = $enroll_info->row()->class_id;
    $exams = $this->crud_model->get_exams();
?>
<div class="profile-env">
	<header class="row">
		<div class="col-md-3">
			<center>
        <a href="#">
  				<img src="<?php echo $this->crud_model->get_image_url('student', $student_id) ;?>" class="img-circle"
          style="width: 60%;" />
  			</a>
        <br>
        <h3>
          <?php echo $row['name']; ?>
        </h3>
        <br>
        <span>
          <?php
            $class_name = $this->db->get_where('class', array(
              'class_id' => $enroll_info->row()->class_id
            ))->row()->name;
            $section_name = $this->db->get_where('section', array(
              'section_id' => $enroll_info->row()->section_id
            ))->row()->name;
          ?>
          <a href="<?php echo site_url('admin/student_information/'.$enroll_info->row()->class_id);?>">
            <?php echo get_phrase('class').' - '.$class_name.' | '. get_phrase('section').' - '.$section_name; ?>
          </a>
        </span>
      </center>
		</div>
    <div class="col-md-9">

		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab1" data-toggle="tab" class="btn btn-default">
					<span class="visible-xs"><i class="entypo-home"></i></span>
					<span class="hidden-xs"><?php echo "Compra"; ?></span>
				</a>
			</li>
			<li class="">
				<a href="#tab2" data-toggle="tab" class="btn btn-default">
					<span class="visible-xs"><i class="entypo-user"></i></span>
					<span class="hidden-xs"><?php echo "Historial de compra"; ?></span>
				</a>
			</li>

		</ul>

		<div class="tab-content">
			<div class="tab-pane active" id="tab1">
        <?php
          $basic_info_titles = ['name','parent', 'class', 'section', 'email', 'phone', 'address', 'gender', 'birthday'];
          $basic_info_values = [$row['name'], $row['parent_id'] == NULL ? '' : $this->db->get_where('parent', array('parent_id' => $row['parent_id']))->row()->name,
          $class_name, $section_name, $row['email'], $row['phone'] == NULL ? '' : $row['phone'], $row['address'] == NULL ? '' : $row['address'], $row['sex'] == NULL ? '' : $row['sex'], $row['birthday'],
          $row['transport_id'] == NULL ? '' : $this->db->get_where('transport', array('transport_id' => $row['transport_id']))->row()->route_name,
          $row['dormitory_id'] == NULL ? '' : $this->db->get_where('dormitory', array('dormitory_id' => $row['dormitory_id']))->row()->name];


          $students = $this->db->get_where('enroll', array('student_id' => $student_id,'class_id' => $class_id, 'year' => $running_year))->result_array();
          if (sizeof($students) > 0):
            foreach ($students as $row):
              $status = 0;
              $recompensas = 0;

              $status2 = 0;
              $demeritos = 0;

              $compras = 0;

              $attendance = $this->db->get_where('attendance', array( 'class_id' => $class_id, 'year' => $running_year, 'student_id' => $student_id))->result_array();
              $compras_generadas = $this->db->get_where('compra', array( 'class_id' => $class_id, 'year' => $running_year, 'student_id' => $student_id))->result_array();

              foreach ($attendance as $row1):



                  $recompensa = $row1['recompensas'];
                  $recompensas = $recompensas+$recompensa;


                  $demerito = $row1['demeritos'];
                  $demeritos = $demeritos+$demerito;

                  $compra = $row1['valor'];
                  $compras += $compra;


              endforeach;

              foreach ($compras_generadas as $row1):
                  $compra = $row1['valor'];
                  $compras += $compra;


              endforeach;
              $recompensas = $recompensas-$demeritos-$compras;
            endforeach;
          endif;

        ?>
        <div class="panel panel-primary" data-collapsed="0">

    			<div class="panel-body">

                    <?php echo form_open(site_url('admin/generate_purchase/'.$class_id.'/'.$student_id) , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

    					<div class="form-group">
    						<label for="field-1" class="col-sm-3 control-label"><?php echo "Meritos";?></label>

    						<div class="col-sm-5">
    							<input type="number" class="form-control" name="meritos" disabled autofocus value="<?php echo $recompensas; ?>">
    						</div>
    					</div>

    					<div class="form-group">
    						<label for="field-1" class="col-sm-3 control-label"><?php echo "Articulo";?></label>
    						<div class="col-sm-5">
    							<input type="text" class="form-control" name="articulo" value="" data-validate="required">
    						</div>
    					</div>

    					<div class="form-group">
    						<label for="field-2" class="col-sm-3 control-label"><?php echo "Valor";?></label>

    						<div class="col-sm-5">
    							<input type="number" class="form-control" name="valor" value="" data-validate="required" min="0" max="<?php echo $recompensas; ?>" id="valor" Onchange="compra();">
    						</div>
    					</div>

    					<div class="form-group">
    						<label for="field-2" class="col-sm-3 control-label"><?php echo "Restante";?></label>

    						<div class="col-sm-5">
    							<input type="number" class="form-control" disabled name="restante" value="<?php echo $recompensas; ?>" id="restante">
    						</div>
    					</div>


                        <div class="form-group">
    						<div class="col-sm-offset-3 col-sm-5">
    							<button type="submit" class="btn btn-default"><?php echo "Generar compra";?></button>
    						</div>
    					</div>
                    <?php echo form_close();?>
                </div>
            </div>
			</div>

      <script type="text/javascript">

      function compra() {

        var total  = <?php echo $recompensas; ?>;

          $("#valor").each(function() {

            if (isNaN(parseFloat($(this).val()))) {

              total += 0;

            } else {

              total -= parseFloat($(this).val());

            }

          });
          //alert(total);
          document.getElementById('restante').value = total;
      }

      </script>
			<div class="tab-pane" id="tab2">
        <?php
            $query = $this->db->get_where('section' , array('class_id' => $class_id));
            if ($query->num_rows() > 0):
                $sections = $query->result_array();
                foreach ($sections as $row):
        ?>

        <?php endforeach;?>
        <?php endif;?>
        <div class="tab-content">
            <div class="tab-pane active" id="home">

                <table class="table table-bordered datatable">
                    <thead>
                        <tr>
                            <th><div><?php echo "Articulo";?></div></th>
                            <th><div><?php echo "Valor";?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                        $compras_generadas = $this->db->get_where('compra', array( 'class_id' => $class_id, 'year' => $running_year, 'student_id' => $student_id))->result_array();

                       ?>
                       <?php
                       foreach ($compras_generadas as $row1):



                        ?>
                        <tr>
                            <td><?php echo $row1['articulo'];?></td>
                            <td><?php echo $row1['valor'];?></td>
                        </tr>
                        <?php
                          endforeach;
                         ?>
                    </tbody>
                </table>

            </div>
			</div>

		</div>

		<br>

	</div>
	</header>
</div>
<?php endforeach; ?>


<script type="text/javascript">

	jQuery(document).ready(function($) {
        $('.datatable').DataTable({
          language: {
            "sProcessing":     "Procesando...",
          	"sLengthMenu":     "Mostrar _MENU_ registros",
          	"sZeroRecords":    "No se encontraron resultados",
          	"sEmptyTable":     "Ning��n dato disponible en esta tabla",
          	"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          	"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
          	"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
          	"sInfoPostFix":    "",
          	"sSearch":         "Buscar:",
          	"sUrl":            "",
          	"sInfoThousands":  ",",
          	"sLoadingRecords": "Cargando...",
          	"oPaginate": {
          		"sFirst":    "Primero",
          		"sLast":     "�0�3ltimo",
          		"sNext":     "Siguiente",
          		"sPrevious": "Anterior"
          	},
          	"oAria": {
          		"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          		"sSortDescending": ": Activar para ordenar la columna de manera descendente"
          	}
          }
        });
	});

</script>
