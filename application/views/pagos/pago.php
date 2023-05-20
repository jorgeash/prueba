
<div class="app">

    <!-- Begin page content -->
    <main class="container">
      <div class="p-4 p-md-5 text-white rounded bg-dark">
      <span class="badge rounded-pill bg-success" id="msm_alert"></span>
      <div class="row mb-3">
   Ingreso de Pagos
      <hr class="my-4">

      <div id="selectUsuarios"></div>
     
        <div class="widget-container">
        
          <br>
          <div id="form"></div>
        </div>
  
      </div>
     
      </div>

        
    </main>

 </div>

 <script type="text/javascript">


var glousuarios = '';
    $(document).ready(function() {

      $.ajax({
         url: "<?php echo base_url('usuarios/getUsuarioPago'); ?>",
         type: "GET",
         dataType: "json",
         success: function(response) {
            // Llenar el campo de selección utilizando DevExpress
            glousuarios = response;

         },
         async: false
      });
      console.log(glousuarios);
     // Crea el formulario utilizando DevExpress
      $("#form").dxForm({
         formData: {
          usuario:"",
            tipo_pago: "",
            cantidad: "",
            monto_pagar: "",
            
            comentario: ""
         },
         items: [ 
          {
            dataField: "usuario_id",
            label: {
               text: "Usuarios"
            },
            editorType: "dxSelectBox",
            editorOptions: {
               placeholder: "Seleccione una opción",
               dataSource: glousuarios,
               displayExpr: "nombre", // Nombre del campo en la tabla de la base de datos
               valueExpr: "usuario_id" // Nombre del campo en la tabla de la base de datos que representa el valor seleccionado
            }
          
          },{
            dataField: "tipo_pago",
            label: {
               text: "Tipos de Pagos"
            },
            editorType: "dxSelectBox",
            editorOptions: {
               placeholder: "Seleccione el tipo de pago",
               dataSource: ["Bonos", "Horas Extras"]
            }
         },{
            dataField: "cantidad",
            label: {
               text: "Cantidad"
            },
            editorType: "dxNumberBox",
            editorOptions: {
               placeholder: "Ingrese cantidad"
            }
         },{
            dataField: "monto_pagar",
            label: {
               text: "Monto a Pagar"
            },
            editorType: "dxNumberBox",
            editorOptions: {
               placeholder: "Ingrese monto a pagar"
            }
         },{
            dataField: "fecha_pagar",
            label: {
               text: "Feha a pagar"
            },
            editorType: "dxDateBox",
            editorOptions: {
             
               placeholder: "Ingrese fecha a pagar",
               displayFormat: "dd/MM/yyyy", // Formato de visualización de la fecha
               value: new Date(), // Valor inicial del campo
               
               onValueChanged: function (e) {
                  // Obtener el valor seleccionado en el campo
                  var selectedDate = e.value;

                  // Formatear la fecha solo con la parte de la fecha
                  var formattedDate = DevExpress.localization.formatDate(selectedDate, "dd/MM/yyyy");

                  // Actualizar el valor del campo con la fecha formateada
                  e.component.option("text", formattedDate);
            },
         },
      },{
            dataField: "comentario",
            label: {
               text: "Comentario"
            },
            editorType: "dxTextArea",
            editorOptions: {
               placeholder: "Ingrese Comentario"
            }
         }, {
            itemType: "button",
            buttonOptions: {
               text: "Guardar",
               onClick: function() {
                
                  // Enviar los datos al servidor
                  const formData = $("#form").dxForm("instance").option("formData");
         
                  $.ajax({
                     url: "<?php echo base_url('pagos/guardarPago'); ?>",
                     type: "POST",
                     data: formData ,
                     dataType: "json",
                     success: function(response) {

                        if (response.msg == 'error' ){
                         
                           DevExpress.ui.dialog.alert(response.validacion, 'Campos Requeridos' );
                           return;
                        }

                        DevExpress.ui.dialog.alert('Registro guardado exitosamente');
                        $('#form').dxForm('option', 'formData', {});
                        
                     }
                  });
               }
            }
         }]
      });
   
   });

</script>