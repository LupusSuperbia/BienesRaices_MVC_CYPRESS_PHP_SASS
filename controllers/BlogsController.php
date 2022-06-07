<?php

namespace Controllers;

use MVC\Router;
use Model\Blogs;
use Intervention\Image\ImageManagerStatic as Image;

class BlogsController
{

    public static function index(Router $router)
    {
        $blogs = Blogs::all();

        $resultado = $_GET['resultado'] ?? null;

        $router->render('blogs/index', [
            'blogs' => $blogs,
            'resultado' => $resultado
        ]);
    }

    public static function crear(Router $router)
    {
        $blogs = new Blogs();
        $errores = Blogs::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $blog = new Blogs($_POST['blog']);
            /** SUBIDA DE ARCHIVOS */
            // Genera un nombre único
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            // Setear la imagen
            // Realia un rezise a la imagen con interevention 
            if ($_FILES['blogs']['tmp_name']['imagen']) {

                $image = Image::make($_FILES['blogs']['tmp_name']['imagen'])->fit(800, 600);
                $blog->setImagen($nombreImagen);
            }

            $errores = $blog->validar();
            if (empty($errores)) {
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                // Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);

                // Guardar en la base de datos 
                $resultado = $blog->guardar();
                if ($resultado) {
                    header('Location: /blogs/index?resultado=1');
                }
            }
        }
        $router->render('blogs/crear', [
            'errores' => $errores,
            'blogs' => $blogs,
        ]);
    }

    public static function actualizar(Router $router)
    {

        $id = validarORedireccionar('/blogs/index');

        $blogs = Blogs::find($id);
        $errores = Blogs::getErrores();


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Asignar los atributos
            $args = $_POST['blogs'];

            $blogs->sincronizar($args);
            // Validacion 
            $errores = $blogs->validar();

            // Subida de archivos
            // Genera un nombre único
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            if ($_FILES['blogs']['tmp_name']['imagen']) {

                $image = Image::make($_FILES['blogs']['tmp_name']['imagen'])->fit(800, 600);
                $blogs->setImagen($nombreImagen);
            }


            if (empty($errores)) {
                if ($_FILES['blogs']['tmp_name']['imagen']) {
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }

                $resultado = $blogs->guardar();
                if ($resultado) {
                    header('Location: /blogs/index?resultado=2');
                }
            }
        }


        $router->render('blogs/actualizar', [
            'blogs' => $blogs,
            'errores' => $errores
        ]);
    }

    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if ($id) {
                $tipo = $_POST['tipo'];
                if (validarTipoContenido($tipo)) {
                    $blogs = Blogs::find($id);
                    $resultado = $blogs->eliminar();
                }
            }
        }
    }
}
