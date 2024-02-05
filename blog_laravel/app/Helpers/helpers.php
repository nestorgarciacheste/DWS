<?php

if (!function_exists('fechaActual')) {
    function fechaActual($formato = "d/m/Y")
    {
        return date($formato);
    }
}
