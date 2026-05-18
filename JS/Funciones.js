$(document).ready(function () {
    $("#buscador").on("keyup", function () {
        var valor = $(this).val().toLowerCase();
        $("tbody tr").filter(function () {
            var textoFila = $(this).text().toLowerCase();
            $(this).toggle(textoFila.indexOf(valor) > -1);
        });
    });
});