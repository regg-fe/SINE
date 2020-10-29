(function formulario()
{
    let formulario = document.getElementsByName('formulario')[0];

    function validarUsuario(e){
        if(formulario.username.value == 0){
            formulario.username.className = "error";
            formulario.username.placeholder = "Es obligatorio rellenar este campo para continuar";
            e.preventDefault();
        }
        else{
            formulario.username.className = "";
        }
    }
    function validarContraseña(e){
        if(formulario.password.value == 0){
            formulario.password.className = "error";
            formulario.password.placeholder = "Es obligatorio rellenar este campo para continuar";
            e.preventDefault();
        }
        else{
            formulario.password.className = "";
        }
    }
    function validar(e){
        validarUsuario(e);
        validarContraseña(e);
    }
    formulario.addEventListener("submit",validar);
}())

