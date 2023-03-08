<?php

class LoginModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Connection();
        $this->db = $this->db->connect();
    }

    public function validate($usuario, $password)
    {
        $query = "SELECT usu.correo AS correo,
                    usu.nombre AS nombre,
                    usu.apt_pat AS apt_pat,
                    usu.apt_mat AS apt_mat ,
                    r_usu.id_rol AS rol,
                    usu.id_usuario AS id_usuario
                    FROM co_usuarios usu
           INNER JOIN co_r_usu r_usu ON r_usu.id_usuario = usu.id_usuario
           WHERE usu.correo = '" . $usuario . "'
           AND usu.password = '" . $password . "'
           AND usu.estatus = 1";

        $statement = mysqli_query($this->db, $query);
        if (mysqli_num_rows($statement) > 0) {
            foreach ($statement as $row) {
                $data['mail'] = $row['correo'];
                $data['nombre'] = $row['nombre'] . ' ' . $row['apt_pat'] . ' ' . $row['apt_mat'];
                $data['rol'] = $row['rol'];
                $data['id'] = $row['id_usuario'];
            }
        } else {
            $data['errorLogin'] = "Usuario y/o contraseña incorrectos";
        }
        return $data;
    }
}
