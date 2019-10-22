<a href="javascript:;" onclick="showAjaxModal('<?php echo site_url('modal/popup/librarian_add');?>');"
    class="btn btn-primary pull-right">
        <i class="entypo-plus-circled"></i>
        <?php echo get_phrase('add_new_librarian');?>
</a>
<br><br>

<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <th style="width: 60px;">#</th>
            <th><div><?php echo get_phrase('name');?></div></th>
            <th><div><?php echo get_phrase('email');?></div></th>
            <th><div><?php echo get_phrase('options');?></div></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $count = 1;
        $librarians   =   $this->db->get('librarian')->result_array();
        foreach($librarians as $row): ?>
            <tr>
                <td><?php echo $count++;?></td>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['email'];?></td>
                <td>

                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                            Acción <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                            <li>
                                <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/librarian_edit/'.$row['librarian_id']);?>');">
                                    <i class="entypo-pencil"></i>
                                    <?php echo get_phrase('edit');?>
                                </a>
                            </li>
                            <li class="divider"></li>

                            <li>
                                <a href="#" onclick="confirm_modal('<?php echo site_url('admin/librarian/delete/'.$row['librarian_id']);?>');">
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



<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->
<script type="text/javascript">

    jQuery(document).ready(function($)
    {
        $('#table_export').dataTable({
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
