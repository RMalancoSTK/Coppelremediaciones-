<?php
class CoreController
{
    private $instanciaMenu;
    public $menu;

    public function __construct()
    {
        // Utils::validateSession();
        $this->instanciaMenu = new MenuModel();
        $this->menu ? $this->menu : $this->menu = $this->crearMenu($this->instanciaMenu, $_SESSION['rol']);
    }

    private function crearMenu($instancia, $rol)
    {
        $menu = $instancia->getMenu($rol);
        foreach ($menu['id_rol'] as $i => $men) {
            $decode = json_decode($menu['json_submenu'][$i]);
            $id_submenu = explode(",", $decode->id);
            $submenu = $instancia->getSubMenu(implode(",", $id_submenu));
            $menu['submenu'][$i] = $submenu;
        }
        return $menu;
    }
}
