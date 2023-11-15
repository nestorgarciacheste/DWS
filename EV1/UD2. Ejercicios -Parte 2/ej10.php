<?php

$hoteles = array(
    array(
        "nombre" => "Abashin (MH)",
        "categoria" => "168",
        "habitaciones" => "46013 Valencia",
        "direccion" => "Avenida Ausias March, 58",
        "poblacion" => "Valencia"
    ),
    array(
        "nombre" => "Abba Acteon",
        "categoria" => "(Abba Hoteles)",
        "habitaciones" => "46023 Valencia",
        "direccion" => "Escultor Vicente Bertran Grimal,",
        "poblacion" => "Valencia"
    ),
    array(
        "nombre" => "Acta Atarananos",
        "categoria" => "4*",
        "habitaciones" => "42",
        "direccion" => "46012 Valencia Plaza Tribunal de las Aguas, 4",
        "poblacion" => "Valencia"
    ),
    array(
        "nombre" => "Acta del Carmen",
        "categoria" => "3*",
        "habitaciones" => "25",
        "direccion" => "46003 Valencia Blanquerias, 11",
        "poblacion" => "Valencia"
    ),
    array(
        "nombre" => "NCValencia [AC Hotels)",
        "categoria" => "163",
        "habitaciones" => "46023 Valencia",
        "direccion" => "Avenida de Francia, 57",
        "poblacion" => "Valencia"
    ),
    array(
        "nombre" => "Ad Hoc Monumental Valencia",
        "categoria" => "28",
        "habitaciones" => "46003 Valencia",
        "direccion" => "Boix, 4",
        "poblacion" => "Valencia"
    ),
    array(
        "nombre" => "Alkazar",
        "categoria" => "",
        "habitaciones" => "46002 Valencia",
        "direccion" => "Mosen Femades, 12",
        "poblacion" => "Valencia"
    )
);

function mostrarHoteles($hoteles)
{
    foreach ($hoteles as $hotel) {
        echo "Nombre: " . $hotel['nombre'] . "<br>";
        echo "Categoría: " . $hotel['categoria'] . "<br>";
        echo "Habitaciones: " . $hotel['habitaciones'] . "<br>";
        echo "Dirección: " . $hotel['direccion'] . "<br>";
        echo "Población: " . $hotel['poblacion'] . "<br>";
        echo "<br>";
    }
}

function mostrarHotelesMas100Habitaciones($hoteles)
{
    foreach ($hoteles as $hotel) {
        if ($hotel['categoria'] > 100) {
            echo "Nombre: " . $hotel['nombre'] . "<br>";
            echo "Categoría: " . $hotel['categoria'] . "<br>";
            echo "Habitaciones: " . $hotel['habitaciones'] . "<br>";
            echo "Dirección: " . $hotel['direccion'] . "<br>";
            echo "Población: " . $hotel['poblacion'] . "<br>";
            echo "<br>";
        }
    }
}

function mostrarHotelesMenos100Habitaciones3Estrellas($hoteles)
{
    foreach ($hoteles as $hotel) {
        if ($hotel['categoria'] < 100 && $hotel['categoria'] == "3*") {
            echo "Nombre: " . $hotel['nombre'] . "<br>";
            echo "Categoría: " . $hotel['categoria'] . "<br>";
            echo "Habitaciones: " . $hotel['habitaciones'] . "<br>";
            echo "Dirección: " . $hotel['direccion'] . "<br>";
            echo "Población: " . $hotel['poblacion'] . "<br>";
            echo "<br>";
        }
    }
}

function borrarHotelActaDelCarmen(&$hoteles)
{
    foreach ($hoteles as $indice => $hotel) {
        if ($hotel['nombre'] == "Acta del Carmen") {
            unset($hoteles[$indice]);
            break;
        }
    }
}

function borrarTodosLosHoteles(&$hoteles)
{
    $hoteles = array();
}

function anadirNuevosHoteles(&$hoteles, $nuevosHoteles)
{
    $hoteles = array_merge($hoteles, $nuevosHoteles);
}

echo "Listado de hoteles antes de realizar acciones:<br>";
mostrarHoteles($hoteles);

echo "Listado de hoteles de más de 100 habitaciones:<br>";
mostrarHotelesMas100Habitaciones($hoteles);

echo "Listado de hoteles de menos de 100 habitaciones y 3 estrellas:<br>";
mostrarHotelesMenos100Habitaciones3Estrellas($hoteles);

echo "Listado de hoteles después de borrar Acta del Carmen:<br>";
borrarHotelActaDelCarmen($hoteles);
mostrarHoteles($hoteles);

echo "Borrando todos los hoteles:<br>";
borrarTodosLosHoteles($hoteles);
echo "Listado de hoteles después de borrar todos:<br>";
mostrarHoteles($hoteles);

$nuevosHoteles = array(
    array(
        "nombre" => "Astona Falace",
        "categoria" => "LAyre Miestal",
        "habitaciones" => "204",
        "direccion" => "46003 Valencia Plaza Rodrigo Botet, 5",
        "poblacion" => "Valencia"
    ),
    array(
        "nombre" => "Balneario Las Arenas",
        "categoria" => "Lujo",
        "habitaciones" => "253",
        "direccion" => "46011 Valencia Eugenia Vines, 22:24",
        "poblacion" => "Valencia"
    )
);

echo "Añadiendo nuevos hoteles:<br>";
anadirNuevosHoteles($hoteles, $nuevosHoteles);
mostrarHoteles($hoteles);
