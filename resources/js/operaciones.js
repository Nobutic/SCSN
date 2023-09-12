$('#login').click(function(){

  // Traemos los datos de los inputs
  var user  = $('#user').val();
  var clave = $('#clave').val();

  // Envio de datos mediante Ajax
  $.ajax({
    method: 'POST',
    // Recuerda que la ruta se hace como si estuvieramos en el index y no en operaciones por esa razon no utilizamos ../ para ir a controller
    url: 'controller/loginController.php',
    // Recuerda el primer parametro es la variable de php y el segundo es el dato que enviamos
    data: {user_php: user, clave_php: clave},
    // Esta funcion se ejecuta antes de enviar la información al archivo indicado en el parametro url
    beforeSend: function(){
      // Mostramos el div con el id load mientras se espera una respuesta del servidor (el archivo solicitado en el parametro url)
      $('#load').show();
    },
    // el parametro res es la respuesta que da php mediante impresion de pantalla (echo)
    success: function(res){
      // Lo primero es ocultar el load, ya que recibimos la respuesta del servidor
      $('#load').hide();

      // Ahora validamos la respuesta de php, si es error_1 algun campo esta vacio de lo contrario todo salio bien y redireccionaremos a donde diga php
      if(res == 'error_1'){
        swal('Error', 'Por favor ingrese todos los campos', 'error');
      }else if(res == 'error_2'){
        // Recuerda que si no necesitas validar si es un email puedes eliminar el if de la linea 34
        swal('Error', 'Por favor ingrese un email valido', 'warning');
      }else if(res == 'error_3'){
        swal('Error', 'El usuario y contraseña que ingresaste es incorrecto', 'error');
      }else{
        // Redireccionamos a la página que diga corresponda el usuario
        window.location.href= res;
        
      }

    }
  });

});

$('#registro').click(function(){

  var form = $('#formulario_registro').serialize();

  $.ajax({
    method: 'POST',
    url: 'controller/admin/registroController.php',
    data: form,
    beforeSend: function(){
      $('#load').show();
    },
    success: function(res){
      $('#load').hide();

      if(res == 'error_1'){
        swal('Error', 'Campos obligatorios, por favor llena los campos vacíos', 'warning');
      }else if(res == 'error_2'){
        swal('Error', 'Las claves deben ser iguales, por favor intentalo de nuevo', 'error');
      }else if(res == 'error_3'){
        swal('Error', 'El correo que ingresaste ya se encuentra registrado', 'error');
      }else if(res == 'error_4'){
        swal('Error', 'Por favor ingresa un correo valido', 'warning');
      }else if(res == 'error_5'){
        swal('Error', 'La identificacion ingresada ya se encuentra registrada', 'error');
      }else if(res == 'guardar'){
        swal({ 
          title: "Mensaje",
           text: "Usuario guardado con exito",
            type: "success" 
          },
          function(){
            window.location = 'view/admin/listUser.php';
        });
      }else{
        window.location.href = res ;
      }


    }
  });

});

// Cambiar la contraseña del usuario
$('#cambiar').click(function(){

  // Traemos los datos de los inputs
  var iduser = $('#idUsuario').val();
  var cActual  = $('#claveActual').val();
  var cNueva1 = $('#claveNueva1').val();
  var cNueva2 = $('#claveNueva2').val();

  
  $.ajax({
    method: 'POST',
    
    url: '../../controller/cambiarClave.php',
    
    data: {idUsuario_php: iduser, cActual_php: cActual, cNueva1_php: cNueva1, cNueva2_php: cNueva2},
    
    beforeSend: function(){
      
      $('#load').show();
    },
    
    success: function(res){
      $('#load').hide();
      if(res == 'error_1'){
        swal('Error', 'Por favor ingrese todos los campos', 'error');
      }else if(res == 'error_2'){
        swal('Error', 'La contraseña actual es incorrecta', 'error');
      }else if(res == 'error_3'){
        swal('Error', 'Las contraseñas deben ser iguales, por favor intentalo de nuevo', 'error');
      }else{
        swal({
          title:'Contraseña cambiada', 
          text: 'El cambio de contraseña ha sido exitoso', 
          type: 'success'
        },
        function(){
        window.location = 'index.php';
        });
        
      }

    }
  });

});

$('#editarUsuario').click(function(){

  var datos = $('#formulario_edicion').serialize();
  
  $.ajax({
    method: 'POST',
    url: 'controller/admin/editarUser.php',
    data: datos,
    beforeSend: function(){
      $('#load').show();
    },
    success: function(res){
      $('#load').hide();

      if(res == 'error_1'){
        swal('Error', 'Campos obligatorios, por favor llena los campos vacíos', 'warning');
      }else if(res == 'error_2'){
        swal('Error', 'Las claves deben ser iguales, por favor intentalo de nuevo', 'error');
      }else if(res == 'error_4'){
        swal('Error', 'Por favor ingresa un correo valido', 'warning');
      }else if(res == 'actualizar'){
        swal({ 
          title: "Mensaje",
           text: "Usuario editado con exito",
            type: "success" 
          },
          function(){
            window.location = 'view/admin/listUser.php';
        });
      }else{
        window.location.href = res ;
      }


    }
  });
  
});


// Operaciones de Cliente
$('#registrarCliente').click(function(){

  var formdata = $('#nuevocliente').serialize();
  
  $.ajax({
    method: 'POST',
    url: '../../controller/admin/registroClient.php',
    data: formdata,
    beforeSend: function(){
      $('#load').show();
    },
    success: function(res){
      $('#load').hide();

      if(res == 'error_1'){
        swal('Campos obligatorios', 'Por favor llena los campos vacíos', 'warning');
      }else if(res == 'error_2'){
        swal('Error', 'La identificación ingresada ya se encuentra registrada', 'error');
      }else if(res == 'error_3'){
        swal('Error', 'El correo que ingresaste ya se encuentra registrado', 'error');
      }else if(res == 'error_4'){
        swal('Error', 'Por favor ingresa un correo valido', 'warning');
      }else if(res == 'error_5'){
        swal('Error', 'Las claves deben ser iguales, por favor intentalo de nuevo', 'error');
      }else if(res == 'guardar'){
        swal({
          title: 'Mensaje', 
          text: 'Cliente guardado con exito', 
          type: 'success'
          },
          function(){
            window.location = 'cliente.php';
        });
      }else{
        window.location.href = res ;
      }


    }
  });
  
});

$('#editarCliente').click(function(){

  var datos = $('#formulario_edicion').serialize();
  
  $.ajax({
    method: 'POST',
    url: '../../controller/admin/editarCliente.php',
    data: datos,
    beforeSend: function(){
      $('#load').show();
    },
    success: function(res){
      $('#load').hide();

      if(res == 'error_1'){
        swal('Error', 'Campos obligatorios, por favor llena los campos vacíos', 'warning');
      }else if(res == 'error_2'){
        swal('Error', 'Las claves deben ser iguales, por favor intentalo de nuevo', 'error');
      }else if(res == 'error_4'){
        swal('Error', 'Por favor ingresa un correo valido', 'warning');
      }else if(res == 'actualizar'){
        swal({ 
          title: "Mensaje",
           text: "Usuario editado con exito",
            type: "success" 
          },
          function(){
            window.location = '../../controller/admin/usuario.php';
        });
      }else{
        window.location.href = res ;
      }


    }
  });
  
});


// Operaciones Asesor
function agregarAsesor(){
  
  var formdata = $('#formulario_asesor').serialize();
  $.ajax({
    method: 'POST',
    url: '../../controller/admin/registroAsesor.php',
    data: formdata,
    beforeSend: function(){
      $('#load').show();
    },
    success: function(res){
      $('#load').hide();

      if(res == 'error_1'){
        swal('Error','Por favor llena los campos vacíos','warning');
      }else if(res == 'error_2'){
        swal('Error','La identificación ingresa ya se encuentra registrada','error');
      }else if(res == 'error_3'){
        swal('Error','El email ingresado ya se encuentra registrado','error');
      }else if(res == 'error_4'){
        swal('Error','Por favor ingresa un correo válido','error');
      }else if(res == 'error_5'){
        swal('Error','Las claves deben ser iguales, por favor intentalo de nuevo','error');
      }else if(res == 'guardar'){
        swal('Operación Exitosa!','Asesor guardado con exito', 'success');
        window.location='asesor.php';
      }else{
        window.location.href = res ;
      }
    }
  });
  
}

$('#editarAsesor').click(function(){

  var datos = $('#formulario_edicionA').serialize();
  
  $.ajax({
    method: 'POST',
    url: '../../controller/admin/editarAsesor.php',
    data: datos,
    beforeSend: function(){
      $('#load').show();
    },
    success: function(res){
      $('#load').hide();

      if(res == 'error_1'){
        swal('Error','Por favor llena los campos vacíos','warning');
      }else if(res == 'error_4'){
        swal('Error','Por favor ingresa un correo valido', 'error');
      }else if(res == 'actualizar'){
        swal('Actualización Exitosa!!','Asesor actualizado con exito', 'success');
        window.location='asesor.php';
      }else{
        window.location.href = res ;
      }

    }
  });
  
});


// Operaciones Tipo de Servicio
function registroTipoServicio(){
 
  var datos = $('#formulario_tipoServicio').serialize();
  
  $.ajax({
    method: 'POST',
    url: '../../controller/admin/registroTipoServicio.php',
    data: datos,
    beforeSend: function(){
      $('#load').show();
    },
    success: function(res){
      $('#load').hide();

      if(res == 'error_1'){
        swal('Campos obligatorios','Por favor llene los campos vacios','warning');
      }else if(res == 'existe'){
        swal('Error' ,'El tipo de servicio que desea registrar ya existe', 'error');
      }else if(res == 'registro'){
        swal({ 
          title: "Registro exitoso",
          type: "success" 
          },
          function(){
          window.location = '../../view/admin/tipoServicio.php';
        });
      }else{
        window.location.href = res ;
      }


    }
  });
  
}


// Operaciones Módulo
$('#registroModulo').click(function(){

  var datos = $('#formulario_modulo').serialize();
  
  $.ajax({
    method: 'POST',
    url: '../../controller/admin/registroModulo.php',
    data: datos,
    beforeSend: function(){
      $('#load').show();
    },
    success: function(res){
      $('#load').hide();

      if(res == 'error_1'){
        swal('Campos obligatorios','Por favor llene los campos vacios','warning');
      }else if(res == 'existe'){
        swal('Error','El modulo que intenta crear ya existe', 'error')
      }else if(res == 'registro'){
        swal({ 
          title: "Registro exitoso",
          type: "success" 
          },
          function(){
          window.location = '/SCSN/view/admin/modulo.php';
        });
      }else{
        window.location.href = res ;
      }


    }
  });
  
});


// Operaciones Control
$('#registroControl').click(function(){
  
  var datoControl = $('#formulario_control').serialize();

  $.ajax({
      method: 'POST',
      url: '../../controller/registrarControl.php',
      data: datoControl,
      beforeSend: function(){
          $('#load').show();
      },
      success: function(res){
          $('#load').hide();
          
          if(res == 'error_1'){
            swal('Campos obligatorios', 'Debe eligir el cliente', 'warning');
          }else if(res=='error_2'){
            swal('Campos obligatorios','Por favor llene los campos vacios','warning');
          }else if(res == 'registro'){
            swal({ 
                title: "Mensaje",
                text: "Control registrado con exito",
                type: "success" 
                },
                function(){
                window.location = 'listadoControl.php';
            });
          }else{
          window.location.href = res ;
          }
      }
  });
});


$('#editarControl').click(function(){

  var datosControl = $('#formulario_eControl').serialize();

  $.ajax({
    method: 'POST',
    url: '../../controller/editarControl.php',
    data: datosControl,
    beforeSend: function(){
      $('#load').show();
    },
    success: function(res){
      $('#load').hide();

      if(res == 'error_1'){
        swal({ 
          title: "Debe eligir el cliente",
          type: "error" 
        });
      }else if(res == 'error_2'){
        swal('Campos vacios', 'Por favor llene los campos vacios', 'error');
      }else if(res == 'editar'){
        swal({ 
          title: "Actualización exitosa",
          type: "success" 
          },
          function(){
          window.location = 'listaControles.php';
        });
      }else{
        window.location.href = res ;
      }

    }
  });
});

function aprobar(){
  if (confirm('Esta seguro de aprobar este control?')==true) {
    alert('Registro Exitoso!!!');
    return true;
  }else{
    return false;
  }
}


// Confirmacion para eliminar registro
function Confirmation() {
 
	if (confirm('Esta seguro de eliminar el registro?')==true) {
	    alert('El registro ha sido eliminado correctamente!!!');
	    return true;
	}else{
	    //alert('Cancelo la eliminacion');
	    return false;
	}
}


// Operaciones Tareas
$('#darSolucion').click(function(){
  
  var datos = $('#formulario_solucion').serialize();
  
  $.ajax({
    method: 'POST',
    url: '../../controller/asesor/darSolucion.php',
    data: datos,
    beforeSend: function(){
      $('#load').show();
    },
    success: function(res){
      $('#load').hide();

      if(res == 'error_1'){
        alert('Por favor digite la solucion');
      }else if(res == 'solucionar'){
        alert('Registro exitoso');
        window.location='tareas.php';
      }else{
        window.location.href = res ;
      }

    }
  });
});


// Cartera
$('#Abonar').click(function(){

  var datosAbono = $('#formulario_abono').serialize();

  $.ajax({
    method: 'POST',
    url: '../../controller/admin/abonar.php',
    data: datosAbono,
    beforeSend: function(){
      $('#load').show();
    },
    success: function(res){
      $('#load').hide();

      if(res == 'error_fecha'){
        swal('No ha elegido la fecha del abono', 'error');
      }else if(res == 'error_valor'){
        swal('No ha digitado el valor del abono', 'error');
      }else if(res == 'abono'){
        swal({ 
          title: "Registro exitoso",
          type: "success" 
          },
          function(){
          window.location = 'cartera.php';
        });
      }else{
        window.location.href = res ;
      }

    }
  });
});

$('#editar_Factura').click(function(){

  var datosFactura = $('#formulario_eFactura').serialize();

  $.ajax({
    method: 'POST',
    url: '../../controller/admin/editarFactura.php',
    data: datosFactura,
    beforeSend: function(){
      $('#load').show();
    },
    success: function(res){
      $('#load').hide();

      if(res == 'error_1'){
        swal('Error', 'Por favor, llenar los campos vacíos', 'error');
      }else if(res == 'editar'){
        swal({ 
          title: "Actualización exitosa",
          type: "success" 
          },
          function(){
          window.location = 'cartera.php';
        });
      }else{
        window.location.href = res ;
      }

    }
  });
});