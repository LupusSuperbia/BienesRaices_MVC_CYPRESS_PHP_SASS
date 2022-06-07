<?php


define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');




function incluirTemplate(string $nombre, bool $inicio = false)
{
    include TEMPLATES_URL . "/${nombre}.php";
}


function estaAutenticado(): bool
{
    session_start();

    if (isset($_SESSION['login'])) {
        return true;
    }

    return false;
}

function debuguear($variable)
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / sanitizar  el html 

function s($html)
{
    $s = htmlspecialchars($html);
    return $s;
}

// VALIDAR TIPO DE CONTENIDO

function validarTipoContenido($tipo)
{
    $tipos = ['vendedor', 'propiedad', 'blog'];

    return in_array($tipo, $tipos);
}

// ----------------- MUESTRA LOS MENSAJES ------------- //

function mostrarNotificacion($codigo)
{
    $mensaje = '';

    switch ($codigo) {
        case 1:
            $mensaje = 'Creado Correctamente';
            break;
        case 2:
            $mensaje = 'Actualizado Correctamente';
            break;
        case 3:
            $mensaje = 'Eliminado Correctamente';
            break;
        default:
            $mensaje = false;
            break;
    }
    return $mensaje;
}


function validarORedireccionar(string $url)
{
    // ----- VALIDAR ID -
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if (!$id) {
        header('Location: ${url}');
    }
    return $id;
}
