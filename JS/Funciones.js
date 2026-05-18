$(document).ready(function () {
    $("#buscador").on("keyup", function () {
        var valor = $(this).val().toLowerCase();
        $("tbody tr").filter(function () {
            var textoFila = $(this).text().toLowerCase();
            $(this).toggle(textoFila.indexOf(valor) > -1);
        });
    });
    $(document).on("click", "#cerrarSesion", function (e) {
        let confirmacion = confirm("¿Seguro que deseas cerrar sesión?");
        if (!confirmacion) {
            e.preventDefault();
        }
    });
});