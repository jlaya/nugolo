function aceptar() {
    //    var opcion = document.form-register.formulario2.condiciones; //acceso al botón
        var opcion = document.getElementById("condiciones");
    
        var vNombre = document.getElementById("nombres");
        if (vNombre.value === "") {
            alert("Nombre en blanco...");
            return false;
        }
    
        if (opcion.checked == true) { //botón seleccionado
            alert("El Formulario ha sido enviado")
        }
        else {  //botón no seleccionado
            alert("El formulario no ha podido enviarse. \n Debe aceptar las condiciones para poder enviar el formulario");
            return false; //el formulario no se envia
        }
    
    }
    
    