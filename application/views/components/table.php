<div class="content">
  <div class="filterable col-md-12 list">
    <table id="tabela" class="table table-hover table-bordered">
      <thead>
          <tr class="filters">
            <?php
              foreach($titles as $rows => $title){
                echo "
              <th id='filter_col".$rows."' data-column=".$rows.">
                <input style='width:50px' class='column_filter form-control' id='col".$rows."_filter' type='text' placeholder='".$title."' disabled>
                <span style='display:none'>".$title."</span>
              </th>";
              }
            ?>
          </tr>
      </thead>
      <tbody>
        <?php 
        var_dump($contacts);die;
          foreach($contacts as $key => $val){
            $status = ($val['statusCota'] == 1) ? 'Ativo' : 'Inativo';
            echo "<tr>";
              echo "<td>".$val['beneficiario']."</td>";
              echo "<td>".$val['nome']."</td>";
              echo "<td>".$val['publico']."</td>";
              echo "<td>".$val['uf']."</td>";
              echo "<td>".$val['email']."</td>";
              echo "<td>(".$val['dddcelular']. ") " .$val['celular']."</td>";
              echo "<td>(".$val['dddtelefone1']. ") " .$val['telefone1']."</td>";
              echo "<td>(".$val['dddtelefone2']. ") " .$val['telefone2']."</td>";
              echo "<td>".implode('/',array_reverse(explode('-',$val['dia'])))."</td>";
              echo "<td>".$val['hora']."</td>";
              echo "<td>".$val['operador']."</td>";
              echo "<td>".$val['statusLigacao']."</td>";
              echo "<td>".$val['statusCota']."</td>";
              echo "<td>".implode('/',array_reverse(explode('-',$val['save_dt'])))."</td>";
              // echo "<td>".$val['municipio']."</td>";
              // echo "<td>".$val['sexo']."</td>";
              // echo "<td>".$val['nascimento']."</td>";
            echo "</tr>";
          }
        ?>
      </tbody>
    </table>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
<!-- tabela -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
<!-- botões tabela -->
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
<script type="text/javascript">
    function filterColumn ( i ) {
        $('#tabela').DataTable().column( i ).search(
            $('#col'+i+'_filter').val(),
            $('#col'+i+'_smart').prop('checked')
        ).draw();
    }
		//cria a tabela pela api DataTable
		$(document).ready(function() {
				function date () {
					var today = new Date();
					var date = today.getDate()+'-'+(today.getMonth()+1)+'-'+today.getFullYear();
					var time = today.getHours() + "-" + today.getMinutes() + "-" + today.getSeconds();
					var dateTime = date+'_'+time;
					return dateTime
				};
				var table = $('#tabela').DataTable({
					stateSave: false,
					scrollY: '60vh',
					scrollCollapse: true,
					"scrollX": true,
					"lengthMenu": [[10, 50, 100, 500], [10, 50, 100, 500]],
          "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"
          },
					"dom": "<'row'<'col-lg-12'B>>"+"<'row'<'col-lg-12'tr>>"+"<'row'<'col-lg-3'l><'col-lg-3'i><'col-lg-6'p>>",
          "columnDefs": [ 
            {
              "targets": [6],
              "orderable": false
            }
          ],
					buttons: [
            {
							className: 'btn btn-secondary btn-filter',
							text: 'Filtrar',
              action: function(){
                var $panel = $('.filterable').parents(),
                  $filters = $panel.find('.filters input');
                  console.log($panel)
                if ($filters.prop('disabled') == true) {
                  $filters.prop('disabled', false);
                } else {
                  $filters.val('').prop('disabled', true);
                }
              }
						},
						{
							extend: 'excelHtml5',
							className: 'btn btn-secondary btn-export',
							title: null,
							filename: date,
							text: 'Exportar',
							exportOptions: {
								columns: ':visible:not(.notexport)'
							}
						}
					],
					order: []
				});
        $('input.column_filter').on( 'keyup click', function () {
          filterColumn( $(this).parents('th').attr('data-column') );
        } );
			$(document).ready(function (){
				//desabilitar ordenação quando filtro está habilitado
				var table = $('#table').DataTable();

				$('.form-control').on('click', function(e){
					e.stopPropagation();
				});
			});
		});
	</script>