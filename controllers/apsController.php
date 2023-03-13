<?php

require_once('models/apsModel.php');

class ApsController extends coreController
{
    private $js;
    private $aps;

    public function __construct()
    {
        parent::__construct();
        $this->js = '<script src="assets/js/aps.js"></script>';
        $this->aps = new apsModel();
    }

    public function aps()
    {
        Utils::validateSession();
        $_SESSION['script'] = $this->js;
        require_once("views/templates/header.php");
        require_once("views/templates/menu.php");
        require_once("views/aps.php");
        require_once("views/templates/footer.php");
    }

    // public function list()
    // {
    //     $aps = $this->aps->listAps();
    //     $aps = array_map(function ($ap) {
    //         return (object) array(
    //             'id' => $ap['id_aps'],
    //             'nombre' => $ap['nombre'],
    //             'estatus_aps' => $ap['estatus_aps'],
    //             'colores_aps' => $ap['colores_aps'],
    //             'fecha_reg' => $ap['fecha_reg'],
    //         );
    //     }, $aps);
    //     return $aps;
    // }

    public function listApsJson()
    {
        $arreglo = array();
        $query = $this->aps->listApsJson();
        foreach ($query as $data) {
            $arreglo[] = $data;
        }
        echo json_encode($arreglo);
        die();
    }

    public function getApsJson()
    {
        $id_aps = $_POST['id_aps'];
        $query = $this->aps->getApsJson($id_aps);
        $data = $query->fetch_object();
        echo json_encode($data);
        die();
    }

    public function guardarApsJson($datos)
    {
        $nombre = isset($datos['nombre']) ? $datos['nombre'] : null;
        $idAps = isset($datos['id_aps']) ? $datos['id_aps'] : null;

        if ($idAps && $nombre) {
            $this->aps->editApsJson($datos);
            $status = 'success';
            $message = 'Registro actualizado correctamente';
        } elseif ($nombre) {
            $this->aps->saveApsJson($datos);
            $status = 'success';
            $message = 'Registro guardado correctamente';
        } else {
            $status = 'error';
            $message = 'No se pudo guardar el registro';
        }

        echo json_encode(array(
            'status' => $status,
            'message' => $message,
        ));
    }

    public function desactivarApsJson($datos)
    {
        $idAps = isset($datos['id_aps']) ? $datos['id_aps'] : null;

        if ($idAps) {
            $this->aps->estatusApsJson($datos);
            $status = 'success';
            $message = 'Registro desactivado correctamente' . $datos['estatus'];
        } else {
            $status = 'error';
            $message = 'No se pudo eliminar el registro';
        }

        echo json_encode(array(
            'status' => $status,
            'message' => $message,
        ));
    }

    public function activarApsJson($datos)
    {
        $idAps = isset($datos['id_aps']) ? $datos['id_aps'] : null;

        if ($idAps) {
            $this->aps->estatusApsJson($datos);
            $status = 'success';
            $message = 'Registro activado correctamente';
        } else {
            $status = 'error';
            $message = 'No se pudo activar el registro';
        }

        echo json_encode(array(
            'status' => $status,
            'message' => $message,
        ));
    }

    public function edit()
    {
        $res = $this->aps->editAps($_POST);
        $data["res"] = "Tu registro se ha actualizado correctamente";
        echo json_encode($data);
    }

    public function delete()
    {
        $res = $this->aps->deleteAps($_POST);
        echo json_encode($res);
    }

    public function save()
    {
        $res = $this->aps->saveAps($_POST);
        $data["res"] = "Tu registro se ha agregado correctamente";
        echo json_encode($data);
    }
}
