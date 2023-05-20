
<div class="app">

    <!-- Begin page content -->
    <main class="container">
      <div class="p-4 p-md-5 text-white rounded bg-dark">
      <span class="badge rounded-pill bg-success" id="msm_alert"></span>
      <div class="row mb-3">
      <div id="selectUsuarios"></div>
         <div class="col-6 col-sm-12">
            <button type="button" class="btn btn-primary" id="btn_mostrar_modal">Nuevo Usuario</button>
         </div>
         <hr class="my-4">

         <div id="gridContainer"></div>
        
      </div>
      </div>
    </main>

 </div>
 <!-- Modal usuarios -->
<div class="modal fade" id="modal_usuarios" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"  style='background-color: rgb(42 42 42 / 0.5);'>
            <div class="widget-container">
               <br>
               <div id="form"></div>
            </div>  
            </div>
        </div>
    </div>
</div> <!-- End Modal Usuarios -->

 <script type="text/javascript">

      $("#btn_mostrar_modal").on('click', function () {
            $("#modal_usuarios").modal('show')
      });

    $(document).ready(function() {

     // Crea el formulario utilizando DevExpress
      $("#form").dxForm({
         formData: {
            nombres:"",
            apellidos: "",
            email: "",
            password : "",
            rol_usuario: "",
            estado: ""
         },
         items: [
            {
            dataField: "nombres",
            label: {
               text: "Nombres"
            },
            editorType: "dxTextBox",
            editorOptions: {
               placeholder: "Ingrese los nombres"
            }
         }, {
            dataField: "apellidos",
            label: {
               text: "Apellidos"
            },
            editorType: "dxTextBox",
            editorOptions: {
               placeholder: "Ingrese los apellidos"
            }
         },{
            dataField: "email",
            label: {
               text: "Correo"
            },
            editorType: "dxTextBox",
            editorOptions: {
               placeholder: "Ingrese correo"
            }
         },{
             dataField: 'password',
             label: {
                 text: 'Contraseña'
             },
             editorType: 'dxTextBox',
             editorOptions: {
                 mode: 'password',
                 placeholder: 'Ingresa tu contraseña'
             }
         }, {
            dataField: "rol_usuario",
            label: {
               text: "Rol"
            },
            editorType: "dxSelectBox",
            editorOptions: {
               placeholder: "Seleccione el tipo de rol",
               dataSource: ["Administrador", "Normal"]
            }
         },{
            dataField: "estado",
            label: {
               text: "Estado"
            },
            editorType: "dxSelectBox",
            editorOptions: {
               placeholder: "Seleccione el estado",
               dataSource: ["Activo", "Inactivo"]
            }
         }, {
            itemType: "button",
            buttonOptions: {
               text: "Guardar",
               onClick: function() {
                  // Enviar los datos al servidor
                  const formData = $("#form").dxForm("instance").option("formData");

                  $.ajax({
                     url: "<?php echo base_url('usuarios/guardarUsuario'); ?>",
                     type: "POST",
                     data: formData,
                     dataType: "json",
                     success: function(response) {
            
                     if (response.msg == 'error' ){
                         
                         DevExpress.ui.dialog.alert(response.validacion, 'Campos Requeridos' );
                         return;
                      }
                        DevExpress.ui.dialog.alert('Registro guardado exitosamente');
                        $('#gridContainer').dxDataGrid('instance').refresh();

                        $("#modal_usuarios").modal('hide');

                        // Limpiar el formulario dxForm
                        $('#form').dxForm('option', 'formData', {});
                        
                     }
                  });
               }
            }
         }]
      });


      $(function() {
            $('#gridContainer').dxDataGrid({

                dataSource: '<?php echo base_url("usuarios/getUsuario"); ?>',
                columns: [{
                    dataField: 'usuario_id',
                    caption: 'Id',
                    width: 40,
                }, {
                    dataField: 'nombre',
                    caption: 'Nombres',
                    width: 180,
                }, {
                    dataField: 'apellido',
                    caption: 'Apellidos',
                    width: 180,
                }, {
                    dataField: 'email',
                    caption: 'Correo',
                    width: 200,
                }, {
                    dataField: 'rol',
                    caption: 'Rol',
                    width: 120,
                }, {
                    dataField: 'estado',
                    caption: 'Estado'
                }, {
                  
                    type: "buttons",
                    buttons: [{
                        hint: "Eliminar",
                        icon: "remove",
                        onClick: function(e) {
                            let usuario_id = e.row.data.usuario_id;
                            eliminarUsuario(usuario_id);
                        }
                    }]
                }]
            });

            function eliminarUsuario(usuario_id) {
                if (confirm('¿Estás seguro de eliminar este usuario?')) {
                    $.ajax({
                        url: '<?php echo base_url("usuarios/borrarUsuario"); ?>',
                        method: 'POST',
                        data: { usuario_id : usuario_id },
                        dataType: "json",
                        success: function(response) {
                  
                            if (response.status == 'success') {
                                $('#gridContainer').dxDataGrid('instance').refresh();
                                alert('Usuario eliminado correctamente.');
                            } else {
                                alert('No se pudo eliminar el usuario.');
                            }
                        },
                        error: function() {
                            alert('Ocurrió un error al eliminar el usuario o tiene un pago asociado.');
                        }
                    });
                }
            }
        });

   });

</script>
