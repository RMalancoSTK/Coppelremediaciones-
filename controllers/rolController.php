<?php
require_once("models/rolModel.php");

class RolController extends coreController
{
    private $rol;
    private $js;
    private $instanciaMenu;

    public function __construct()
    {
        parent::__construct();
        if (isset($_SESSION) && ($_SESSION['id']) != 0) {
            $this->rol = new  RolModel();
            $this->instanciaMenu = new MenuModel();
            $this->js = '../assets/js/rol.js';
        } else {
            header("Location: index.php");
        }
    }

    public function add($datos = null)
    {
        require_once("views/templates/header.php");
        require_once("views/templates/menu.php");
        require_once("views/rol.php");
        require_once("views/templates/footer.php");
    }


    public function read($datos)
    {
        $res = $this->rol->read($datos);
        $resMenu = $this->instanciaMenu->getAllMenu();
        foreach ($resMenu['id'] as $i => $rm) {
            $resMenu['submenu'][$i] = $this->instanciaMenu->getAllSubmenu($rm);
        }

        require_once("views/templates/header.php");
        require_once("views/templates/menu.php");
        require_once("views/read.php");
        require_once("views/templates/footer.php");
    }

    public function edit()
    {
        $res = $this->rol->update($_POST);
        $data["res"] = "Tu registro se ha actualizado correctamente";
        echo json_encode($data);
    }

    public function save()
    {
        $resId = $this->rol->save($_POST['nombre']);
        $guardarRelacion["id"] = array();
        foreach ($_POST['checkMenu'] as $i => $chkMenu) {
            $resRelacion = $this->rol->getRelation($chkMenu);
            foreach ($resRelacion['id'] as $j => $idSubMenu) {
                foreach ($_POST['checkSubMenu'] as $k => $checkSubMenu) {
                    if ($checkSubMenu == $idSubMenu) {
                        array_push($guardarRelacion["id"], $checkSubMenu);
                    }
                }
            }
            $formatoJson = json_encode($guardarRelacion);
            $resultado = str_replace("[", "", $formatoJson);
            $resultado = str_replace("]", "", $resultado);
            $guardarRelRolMenu = $this->rol->saveRelation($resId, $chkMenu, $resultado);
            $guardarRelacion["id"] = array();
        }
        $data["res"] = "Tu registro se ha agregado correctamente";
        echo json_encode($data);
        //$data["res"] = "Se ha agregado correctamente el Rol";
        //echo json_encode($data); 
    }

    public function delete()
    {
        $res = $this->rol->delete($_POST["idRol"]);
        echo json_encode($res);
    }
}
