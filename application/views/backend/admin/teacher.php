            <a href="javascript:;" onclick="showAjaxModal('<?php echo site_url('modal/popup/modal_teacher_add/');?>');"
            	class="btn btn-primary pull-right">
                <i class="entypo-plus-circled"></i>
            	<?php echo get_phrase('add_new_teacher');?>
                </a>
                <br><br>
               <table class="table table-bordered datatable" id="teachers">
                    <thead>
                        <tr>
                            <th width="60"><div><?php echo get_phrase('teacher_id');?></div></th>
                            <th width="80"><div><?php echo get_phrase('photo');?></div></th>
                            <th><div><?php echo get_phrase('name');?></div></th>
                            <th><div><?php echo get_phrase('email');?></div></th>
                            <th><div><?php echo get_phrase('phone');?></div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
                </table>



<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->
<script type="text/javascript">

	jQuery(document).ready(function($) {
        $.fn.dataTable.ext.errMode = 'throw';
        $('#teachers').DataTable({
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
          },
            "processing": true,
            "serverSide": true,
            "ajax":{
                "url": "<?php echo site_url('admin/get_teachers') ?>",
                "dataType": "json",
                "type": "POST",
            },
            "columns": [
                { "data": "teacher_id" },
                { "data": "photo" },
                { "data": "name" },
                { "data": "email" },
                { "data": "phone" },
                { "data": "options" },
            ],
            "columnDefs": [
                {
                    "targets": [1,5],
                    "orderable": false
                },
            ]
        });
	});

    function teacher_edit_modal(teacher_id) {
        showAjaxModal('<?php echo site_url('modal/popup/modal_teacher_edit/');?>' + teacher_id);
    }

    function teacher_delete_confirm(teacher_id) {
        confirm_modal('<?php echo site_url('admin/teacher/delete/');?>' + teacher_id);
    }

</script>
