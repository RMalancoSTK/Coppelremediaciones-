<?php
class ApsModel
{
    private $con;

    public function __construct()
    {
        $this->con = new Connection();
        $this->con = $this->con->connect();
    }

    public function listAps()
    {
        $query = "SELECT *, if(estatus = 1, 'ACTIVO', 'INACTIVO') AS estatus_aps, if(estatus = 1, 'bg-success', 'bg-warning') AS colores_aps FROM co_aps";
        $statement = mysqli_query($this->con, $query);
        $statement = mysqli_fetch_all($statement, MYSQLI_ASSOC);
        return $statement;
    }

    public function listApsJson()
    {
        return $this->con->query("SELECT *, if(estatus = 1, 'ACTIVO', 'INACTIVO') AS estatus_aps, if(estatus = 1, 'bg-success', 'bg-warning') AS colores_aps FROM co_aps");
    }

    public function getApsJson($id)
    {
        return $this->con->query("SELECT * FROM co_aps WHERE id_aps = $id");
    }

    public function saveApsJson($datos)
    {
        $fechacreacion = date("Y-m-d");
        $query = "INSERT INTO co_aps (nombre, estatus, fecha_reg) VALUES ('" . $datos['nombre'] . "', 1, '$fechacreacion')";
        $res = mysqli_query($this->con, $query);
        return true;
    }

    public function editApsJson($datos)
    {
        $query = "UPDATE co_aps SET nombre = '" . $datos['nombre'] . "' WHERE id_aps = '" . $datos["id_aps"] . "' ";
        $res = mysqli_query($this->con, $query);
        return true;
    }

    public function estatusApsJson($datos)
    {
        $query = "UPDATE co_aps SET estatus = " . $datos['estatus'] . "
        WHERE id_aps =" . $datos['id_aps'];
        $res = mysqli_query($this->con, $query);
        return true;
    }

    public function editAps($datos)
    {
        $query = "UPDATE co_aps SET nombre = '" . $datos['nombre'] . "', estatus = '" . $datos['estatus'] . "' WHERE id_aps = '" . $datos["id"] . "' ";
        $res = mysqli_query($this->con, $query);
        return true;
    }

    public function deleteAps($datos)
    {
        $query = "UPDATE co_aps SET estatus = 0 WHERE id_aps =" . $datos['idAps'];
        $res = mysqli_query($this->con, $query);
        return true;
    }

    public function saveAps($datos)
    {
        $fecha = getdate();
        $fecha = $fecha["year"] . "-" . $fecha["mon"] . "-" . $fecha["mday"];
        $query = "INSERT INTO co_aps (nombre,estatus,fecha_reg) VALUES ('" . $datos['nombre'] . "', 1, '$fecha')";
        $res = mysqli_query($this->con, $query);
        return true;
    }
}
