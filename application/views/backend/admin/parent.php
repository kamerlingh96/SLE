            <a href="javascript:;" onclick="showAjaxModal('<?php echo site_url('modal/popup/modal_parent_add/');?>');"
                class="btn btn-primary pull-right">
                <i class="entypo-plus-circled"></i>
                <?php echo get_phrase('add_new_parent');?>
                </a>
                <br><br>
               <table class="table table-bordered" id="parents">
                    <thead>
                        <tr>
                            <th width="60"><div><?php echo get_phrase('parent_id');?></div></th>
                            <th><div><?php echo get_phrase('name');?></div></th>
                            <th><div><?php echo get_phrase('email');?></div></th>
                            <th><div><?php echo get_phrase('phone');?></div></th>
                            <th><div><?php echo get_phrase('profession');?></div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
                </table>



<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->
<script type="text/javascript">

    jQuery(document).ready(function($) {
        $.fn.dataTable.ext.errMode = 'throw';
        $('#parents').DataTable({
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
                "url": "<?php echo site_url('admin/get_parents') ?>",
                "dataType": "json",
                "type": "POST",
            },
            "columns": [
                { "data": "parent_id" },
                { "data": "name" },
                { "data": "email" },
                { "data": "phone" },
                { "data": "profession" },
                { "data": "options" },
            ],
            "columnDefs": [
                {
                    "targets": [5],
                    "orderable": false
                },
            ]
        });
    });

    function parent_edit_modal(parent_id) {
        showAjaxModal('<?php echo site_url('modal/popup/modal_parent_edit/');?>' + parent_id);
    }

    function parent_delete_confirm(parent_id) {
        confirm_modal('<?php echo site_url('admin/parent/delete/');?>' + parent_id);
    }

</script>
