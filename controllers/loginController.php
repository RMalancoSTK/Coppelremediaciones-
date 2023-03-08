<?php
require_once("models/loginModel.php");

class LoginController
{
    private $loginModel;

    public function __construct()
    {
        $this->loginModel = new LoginModel();
    }

    public function index()
    {
        require_once("views/login/index.php");
    }

    public function login($datos)
    {
        if (!isset($datos['usuario']) || empty($datos['usuario']) || !isset($datos['password']) || empty($datos['password'])) {
            $_SESSION['error'] = "Usuario y/o contraseña vacíos";
            header(LOCATION_LOGIN);
            return;
        }
        $usuario = Utils::limpiarDatos($datos['usuario']);
        $password = Utils::limpiarDatos($datos['password']);
        $data = $this->loginModel->validate($usuario, $password);
        if (isset($data['errorLogin'])) {
            $_SESSION['error'] = $data['errorLogin'];
            header(LOCATION_LOGIN);
            return;
        }
        $_SESSION['autenticado'] = true;
        $_SESSION['usuario'] = $data['nombre'];
        $_SESSION['rol'] = $data['rol'];
        $_SESSION['id'] = $data['id'];
        header(LOCATION_BASE_URL);
    }

    public function logout()
    {
        session_destroy();
        header(LOCATION_LOGIN);
    }
}
