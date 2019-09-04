<?php
/**
 * Created by PhpStorm.
 * User: Roberto
 * Date: 20/12/2018
 * Time: 05:53 PM
 */

include_once "Database.php";

class Contacto
{
    private $db;
    private $nombre;
    private $telefono;
    private $email;
    private $comentario;
    private $asunto;

    public function __construct()
    {
        $obb = new Database();
        $this->db = $obb->getConnection();
    }

    public function lista()
    {
        //ejecutamos una query cualquiera ...
        $sql = "SELECT * FROM contacto";

        $result = $this->db->query($sql);
        var_dump($sql);
    }

    public function save()
    {

        if (!($sentencia = $this->db->prepare("INSERT INTO `contacto` (`nombre`,`telefono`,`email`,`comentario`,`asunto`)  VALUES (?,?,?,?,?)"))) {
            echo "Falló la preparación: (" . $this->db->errno . ") " . $this->db->error;
        }


        if (!$sentencia->bind_param("sssss", $this->nombre,$this->telefono, $this->email, $this->comentario, $this->asunto)) {
            echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
        }

        $resp = $sentencia->execute();

        if (!$resp) {
            echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
        }

        $sentencia->close();

        return $resp;

    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * @param mixed $telefono
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * @param mixed $mensaje
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;
    }

    /**
     * @return mixed
     */
    public function getAsunto()
    {
        return $this->asunto;
    }

    /**
     * @param mixed $asunto
     */
    public function setAsunto($asunto)
    {
        $this->asunto = $asunto;
    }
}