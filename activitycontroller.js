$(document).ready(function() {
    // Array para almacenar los valores de las actividades
    window.actividadesArray = [];

    // Función para agregar actividad a la lista y valor al array
    $("#agregar-actividad").click(function() {
        var actividadText = $("#actividades option:selected").text();
        var actividadValue = $("#actividades").val();
        var valueInt = parseInt(actividadValue);
        if (actividadValue !== "") {
            //console.log("BUENOS DIAS");
            actividadesArray.push(valueInt); // Agrega el valor al array
            //$("#actividades-agregadas").append("<li>" + actividadText + " <button type='button' class='btn btn-danger btn-circle btn-sm eliminar-actividad'>S</button></li>");
            $("#actividades-agregadas").append("<li>" + actividadText + " <i class='eliminar-actividad fas fa-trash-alt'></i></li>");
            console.log(actividadesArray);
            $("#actividades").val($("#actividades option:first").val()); // Establece el valor del select en el índice 0
        }
    });
    $(document).on("click", ".eliminar-actividad", function() {
        var index = $(this).parent().index(); // Obtiene el índice del elemento a eliminar
        actividadesArray.splice(index, 1); // Elimina el valor del array
        $(this).parent().remove(); // Elimina la actividad de la lista
        console.log(actividadesArray);
    });
});