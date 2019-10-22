<hr />
<div class="row">
    <div class="col-md-12">

        <!---CONTROL TABS START-->
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
                    <?php echo get_phrase('book_list');?>
                        </a></li>
        </ul>
        <!---CONTROL TABS END-->


        <div class="tab-content">
        <br>
            <!--TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">

                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="books">
                    <thead>
                        <tr>
                            <th width="40"><div><?php echo get_phrase('book_id');?></div></th>
                            <th><div><?php echo get_phrase('name');?></div></th>
                            <th><div><?php echo get_phrase('author');?></div></th>
                            <th><div><?php echo get_phrase('description');?></div></th>
                            <th><div><?php echo get_phrase('price');?></div></th>
                            <th><div><?php echo get_phrase('class');?></div></th>
                            <th><div><?php echo get_phrase('download');?></div></th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!--TABLE LISTING ENDS-->
        </div>
    </div>
</div>


<script type = 'text/javascript'>
    jQuery(document).ready(function($) {
        $.fn.dataTable.ext.errMode = 'throw';
        $('#books').DataTable({
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
                "url": "<?php echo site_url('parents/get_books') ?>",
                "dataType": "json",
                "type": "POST",
            },
            "columns": [
                { "data": "book_id" },
                { "data": "name" },
                { "data": "author" },
                { "data": "description" },
                { "data": "price" },
                { "data": "class" },
                { "data": "download" },
            ],
            "columnDefs": [
                {
                    "targets": [1,2,4,5,6],
                    "orderable": false
                },
            ]
        });
    });
</script>
