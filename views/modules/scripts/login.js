$("#frmAcceso").on('submit', function(e) {

    e.preventDefault();
    emails = $("#emails").val();
    passwords = $("#passwords").val();
    correo = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    ps = /^[0-9a-zA-Z]+$/i;

    if (correo.test(emails) && ps.test(passwords)) {
        $.post("../../ajax/usuarios.php?op=verificar", { "emails": emails, "passwords": passwords },
            function(data) {
                if (data != "null") {
                    $(location).attr("href", "inicio.php");
                    alertify.success('Bienvenido');

                } else {
                    alertify.error("contrasena y/o password incorrectos");
                }
            });

    } else {
        alertify.error("contrasena y/o password incorrectos");
    }

})