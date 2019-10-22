<hr />
<div class="row">
    <div class="col-md-12">

      <table class="table table-bordered datatable" id="table_export">
          <thead>
              <tr>
                  <th width="80"><div><?php echo get_phrase('id_no');?></div></th>
                  <th width="80"><div><?php echo get_phrase('photo');?></div></th>
                  <th><div><?php echo get_phrase('name');?></div></th>
                  <th class="span3"><div><?php echo get_phrase('address');?></div></th>
                  <th><div><?php echo get_phrase('email');?></div></th>
                  <th><div><?php echo get_phrase('options');?></div></th>
              </tr>
          </thead>
          <tbody>
              <?php
                      foreach($student_information as $row):
                      $class_id = $this->db->get_where('enroll', array('student_id' => $row['student_id']))->row()->class_id;
                      ?>
              <tr>
                  <td><?php echo $this->db->get_where('student' , array(
                          'student_id' => $row['student_id']
                      ))->row()->student_code;?></td>
                  <td><img src="<?php echo $this->crud_model->get_image_url('student',$row['student_id']);?>" class="img-circle" width="30" /></td>
                  <td>
                      <?php
                          echo $this->db->get_where('student' , array(
                              'student_id' => $row['student_id']
                          ))->row()->name;
                      ?>
                  </td>
                  <td>
                      <?php
                          echo $this->db->get_where('student' , array(
                              'student_id' => $row['student_id']
                          ))->row()->address;
                      ?>
                  </td>
                  <td>
                      <?php
                          echo $this->db->get_where('student' , array(
                              'student_id' => $row['student_id']
                          ))->row()->email;
                      ?>
                  </td>
                  <td>

                      <div class="btn-group">
                          <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                              Acción <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                              <!-- STUDENT PROFILE LINK -->
                              <li>
                                  <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/student_profile_on_modal/'.$row['student_id']);?>');">
                                      <i class="entypo-user"></i>
                                          <?php echo get_phrase('profile');?>
                                      </a>
                              </li>

                              <!-- STUDENT EDITING LINK -->
                              <li>
                                  <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/modal_student_edit/'.$row['student_id']);?>');">
                                      <i class="entypo-pencil"></i>
                                          <?php echo get_phrase('edit');?>
                                      </a>
                              </li>
                              <li>
                                  <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/student_id/'.$row['student_id']);?>');">
                                      <i class="entypo-vcard"></i>
                                      <?php echo get_phrase('generate_id');?>
                                  </a>
                              </li>

                              <li class="divider"></li>
                              <li>
                                <a href="#" onclick="confirm_modal('<?php echo site_url('admin/delete_student/'.$row['student_id'].'/'.$class_id);?>');">
                                  <i class="entypo-trash"></i>
                                    <?php echo get_phrase('delete');?>
                                </a>
                              </li>
                          </ul>
                      </div>

                  </td>
              </tr>
              <?php endforeach;?>
          </tbody>
      </table>
    </div>
</div>


<script type="text/javascript">

	jQuery(document).ready(function($) {
        $.fn.dataTable.ext.errMode = 'throw';
        $('#table_export').DataTable({
          language: {
            "sProcessing":     "Procesando...",
          	"sLengthMenu":     "Mostrar _MENU_ registros",
          	"sZeroRecords":    "No se encontraron resultados",
          	"sEmptyTable":     "Ningún dato disponible en esta tabla",
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
          		"sLast":     "Último",
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


<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->
