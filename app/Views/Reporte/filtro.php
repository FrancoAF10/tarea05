<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .container{
            text-align: center;
        }
    </style>
</head>
<body>
    
<form id="form" action="/reporte/filtro/pdf" method="get">
    <div class="container">
        <label for="superhero_name">SuperHero:</label>
        <input type="text" name="superhero_name" id="search">
        <br>
        <br>
        <div>
            <textarea id="detalles"  rows="10" cols="40" readonly></textarea>
            <button type="submit">PDF</button>
        </div>
    </div>
</form>
</body>
<script>
const busqueda = document.querySelector('#search');
const detalles = document.querySelector('#detalles');
const form= document.querySelector('#form')
let timeoutId;

busqueda.addEventListener('input', function() {
    clearTimeout(timeoutId);

    timeoutId = setTimeout(async function() {
        const consulta = busqueda.value.trim();
        if (consulta.length === 0) {
            detalles.value = "";
            return;
        }
                                        //este evita que al ingresar caracteres especiales nos arroje algun error
        fetch(`/reporte/search?superhero_name=${encodeURIComponent(consulta)}`)
            .then(res => res.json())
            .then(data => {
                if (data.length === 0) {
                    detalles.value = "No se encontraron resultados";
                } else {
                    detalles.value = data.map(row =>
                    //el desorden de las siguientes 3 lineas es como se vera dentro del textarea
                    //si lo alineo va a salir mas a la derecha que la primera fila
                       `Nombre: ${row.full_name}
Super heroe: ${row.superhero_name}
Bando: ${row.alignment}
Raza: ${row.race}`
                    ).join("\n\n");
                }
            })
            .catch(err => {
                detalles.value = "Error en la búsqueda";
                console.error(err);
            });
    }, 1000); 
});

</script>   
</html>