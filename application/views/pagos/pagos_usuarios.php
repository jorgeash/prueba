
<div class="app">

    <!-- Begin page content -->
    <main class="container">
      <div class="p-4 p-md-5 text-white rounded bg-dark">
      <span class="badge rounded-pill bg-success" id="msm_alert"></span>
      <div class="row mb-3">
      <div id="selectUsuarios"></div>
        Mis Pagos
         <hr class="my-4">

         <div id="gridPagoUsuarios"></div>
        
      </div>
      </div>
    </main>

 </div>

 <script type="text/javascript">

      $("#btn_mostrar_modal").on('click', function () {
            $("#modal_usuarios").modal('show')
      });

    $(document).ready(function() {


      $(function() {
            $('#gridPagoUsuarios').dxDataGrid({

                dataSource: '<?php echo base_url("pagos/getPago"); ?>',
                columns: [{
                    dataField: 'pago_id ',
                    caption: 'Id',
                    width: 10,
                }, {
                    dataField: 'tipo_pago',
                    caption: 'Tipo pago',
                    width: 120,
                }, {
                    dataField: 'cantidad',
                    caption: 'Cantidad',
                    width: 100,
                }, {
                    dataField: 'monto_pagar',
                    caption: 'Monto a Pagar',
                    width: 120,
                }, {
                    dataField: 'fecha_pago',
                    caption: 'Fecha pago',
                    width: 120,
                }, {
                    dataField: 'total_pagar',
                    caption: 'Total pagar',
                    width: 120,
                }, {
                    dataField: 'comentario',
                    caption: 'Comentario',
                    width: 200,
                }]
            });

        });

   });

</script>
