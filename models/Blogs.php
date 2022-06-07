<?php

namespace Model;

class Blogs extends ActiveRecord
{
    protected static $tabla = 'blog';
    protected static $columnasDB = ['id', 'titulo', 'fecha', 'autor', 'detalles', 'imagen'];

    public $id;
    public $titulo;
    public $fecha;
    public $autor;
    public $detalles;
    public $imagen;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->fecha = date('Y/m/d');
        $this->autor = $args['autor'] ?? '';
        $this->detalles = $args['detalles'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
    }

    public function validar()
    {
        // VALIDAR INPUTS
        if (!$this->titulo) {
            self::$errores[] = 'El titulo es obligatorio';
        }
        // if (!$this->fecha) {
        //     self::$errores[] = 'El fecha es obligatorio';
        // }
        if (!$this->autor) {
            self::$errores[] = 'El autor es obligatorio';
        }
        if (!$this->detalles) {
            self::$errores[] = 'El detalles es obligatorio';
        }
        if (!$this->autor) {
            self::$errores[] = 'El autor es obligatorio';
        }
        if (!$this->imagen) {
            self::$errores[] = "La imagen es obligatoria";
        }
        return self::$errores;
    }
    
    public function eliminar()
    {
        // eliminar el registro
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        if ($resultado) {
            $this->borrarImagen();
            header('location: /blogs/index?resultado=3');
        }
    }


}
