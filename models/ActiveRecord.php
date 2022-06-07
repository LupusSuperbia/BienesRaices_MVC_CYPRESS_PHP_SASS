<?php

namespace Model;

class ActiveRecord
{
    // ---------------------------------------------------------------------------------------------------------------- //
    // ------------------------------------------------- BASE DE DATOS ------------------------------------------------ //
    // ---------------------------------------------------------------------------------------------------------------- //

    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';
    // ERRORES 
    // protected solo porue se va a modificar en la clase, static es para no instanciarlo 
    protected static $errores = [];

    //---------------- Definir la conexión a la BD --------- //
    public static function setDB($database)
    {
        self::$db = $database;
    }


    // --------------------- Acutalizar o Crear Propiedades --------- //
    public function guardar()
    {

        if (!is_null($this->id)) {
            // actualizar
            $this->actualizar();
            return true;
        } else {
            //creando un nuevo registro
            $this->crear();
            return true;
        }
        
    }


    // -------------------- CREA LAS PROPIEDADES ------------//
    public function crear()
    {
        // Sanitizar los datos 
        $atributos = $this->sanitizarAtributos();
        // Insertar en la base de datos
        $query = "INSERT INTO " .  static::$tabla . "( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        $resultado = self::$db->query($query);
        
        // Mensaje de exito
        if ($resultado) {
            // Redireccionar al usuario
            header('location: /admin?resultado=1');
        }
        return $resultado;
    }

    // -------------------- ACTUALIZA LAS PROPIEDADES ------------//
    public function actualizar()
    {
        // Sanitizar los datos 
        $atributos = $this->sanitizarAtributos();

        $valores = [];

        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "'";
        $query .= " LIMIT 1 ";

        // Interactuar con la BD 
        $resultado = self::$db->query($query);
        // Mensaje de exito
        if ($resultado) {
            // Redireccionar al usuario
            header('location: /admin?resultado=2');
        }
        return $resultado;
    }

    // -------------------- ELIMINA UN REGISTRO ------------//

    public function eliminar()
    {
        // eliminar el registro
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        if ($resultado) {
            $this->borrarImagen();
            header('location: /admin?resultado=3');
        }
    }



    // ---------- Identificar y unir los atributos de la BD ------//
    public function atributos()
    {
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
            if ($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    // -------------------- SANITIZA LOS ATRIBUTOS QUE VAN A ENTRAR A LA BD ------------//


    public function sanitizarAtributos()
    {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }

    // Subia de archivos 

    public function setImagen($imagen)
    {
        // Elimina la imagen previa 
        if (!is_null($this->id)) {
            $this->borrarImagen();
        }
        // Asignar al atributo de imagen el nombre de la imagen
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    public function borrarImagen()
    {
        // Comprobar si existe el archivo
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);

        if ($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }
    // Validacion  de erroresc
    public static function getErrores()
    {

        return static::$errores;
    }

    // Validacion
    public function validar()
    {

        // Return errores del objeto y pongo static para que vaya al atributo en la clase hijo
        static::$errores = [];
        return static::$errores;
    }



    // Lista todas los registros
    public static function all()
    {
        // static va a heredar este metodo y va a buscar este atributo en la clase en la cual se esta heredando ej propiedad o vendedores 

        $query = "SELECT * FROM " . static::$tabla;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    // ----- Obtiene determinado numero de registros 

    public static function get($cantidad)
    {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }



    // Busca un registro por su id 

    public static function find($id)
    {

        $query = "SELECT * FROM " . static::$tabla . " WHERE id = ${id}";

        $resultado = self::consultarSQL($query);
        // debuguear($resultado);

        return array_shift($resultado);
    }



    public static function consultarSQL($query)
    {
        // Consultar la base de datos 
        $resultado = self::$db->query($query);

        // iterar resultados
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
            // debuguear($array);
        }

        // Liberar la memoria 
        $resultado->free();
        // Retornar los resultados
        // debuguear($array);
        return $array;
    }

    protected static function crearObjeto($registro)
    {
        $objeto = new static;

        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }


    // Sincroniza el objeto en memoria con los cambios realizados por el usuario 
    public function sincronizar($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}
