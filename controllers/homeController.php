<?php

class homeController extends coreController
{
    public function __construct()
    {
        parent::__construct();
        if (isset($_SESSION) && ($_SESSION['id']) != 0) {
        } else {
            header("Location: index.php");
        }
    }

    public function dashboard()
    {
        require_once("views/templates/header.php");
        require_once("views/templates/menu.php");
        require_once("views/home/home.php");
        require_once("views/templates/footer.php");
    }

    public function index()
    {
        require_once("views/templates/header.php");
        require_once("views/templates/menu.php");
        require_once("views/home/index.php");
        require_once("views/templates/footer.php");
    }
}
