<?php

namespace Controllers;

use MVC\Router;
use Model\Blogs;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController
{
    public static function index(Router $router)
    {
        $propiedades = Propiedad::get(3);
        $blogs = Blogs::get(2);
        $inicio = true;

        $router->render('paginas/index', [
            'inicio' => $inicio,
            'propiedades' => $propiedades,
            'blogs' => $blogs
        ]);
    }

    public static function nosotros(Router $router)
    {
        $router->render('paginas/nosotros', []);
    }

    public static function propiedades(Router $router)
    {
        $propiedades = Propiedad::all();

        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }

    public static function propiedad(Router $router)
    {

        $id = validarORedireccionar('/propiedades');
        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }

    public static function blogs(Router $router)
    {
        $blogs = Blogs::all();

        $router->render('paginas/blogs', [
            'blogs' => $blogs
        ]);
    }

    public static function entrada(Router $router)
    {
        $id = validarORedireccionar('/blogs');
        $blogs = Blogs::find($id);

        $router->render('paginas/entrada', [
            'blogs' => $blogs
        ]);
    }

    public static function contacto(Router $router)
    {
        $mensaje = NULL;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $respuestas = $_POST['contacto'];

            
            // Crear una instancia de PHPMailer
            $mail = new PHPMailer();

            // Configurar SMTP 
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '9a384384307c61';
            $mail->Password = '48d3655052b0fb';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;

            // Configurar el contenido del email 
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
            $mail->Subject = 'Tienes un Nuevo Mensaje';

            // Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';



            // Definir el contenido 
            $contenido = '<html>';
            $contenido .=  '<p>Tienes un nuevo mensaje</p>';
            $contenido .=  '<p>Nombre: ' . $respuestas['nombre'] . '</p>';

            // Enviar de forma condicional algunos cmapos de email o telefono 
            if ($respuestas['contacto'] === 'telefono') {
                $contenido .=  '<p>Eligió ser contactado por telefono ';
                $contenido .=  '<p>Telefono: ' . $respuestas['telefono'] . '</p>';
                $contenido .=  '<p>Fecha Contacto: ' . $respuestas['fecha'] . '</p>';
                $contenido .=  '<p>Hora: ' . $respuestas['hora'] . '</p>';
            } else {
                // Es el mail entonces agregamos el campo
                $contenido .=  '<p>Eligió ser contactado por email ';
                $contenido .=  '<p>Email: ' . $respuestas['email'] . '</p>';
            }
            $contenido .=  '<p>Mensaje: ' . $respuestas['mensaje'] . '</p>';
            $contenido .=  '<p>Venta O Compra: ' . $respuestas['tipo'] . '</p>';
            $contenido .=  '<p>Precio O Presupuesto: $' . $respuestas['precio'] . '</p>';
            $contenido .=  '<p>Prefiere ser contactado por: ' . $respuestas['contacto'] . '</p>';
            $contenido .= '</html>';
            // Esto es cuando el correo acepta html
            $mail->Body = $contenido;
            // Esto es cuando NO acepta html
            $mail->AltBody = 'Este mensaje es enviado sin html por pargela';

            // Enviar el mail

            if ($mail->send()) {
                $mensaje =  "Mensaje Enviado Correctamente";
            } else {
                $mensaje = "El mensaje no se pudo enviar";
            }
        }

        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}
