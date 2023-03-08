<?php
class Connection
{
    public function connect() // connection renombrarlo a connect
    {
        $db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if (!$db) {
            echo "conexión fallida";
            exit();
        } else {
            return $db;
        }
    }

    public function disconnect($db)
    {
        mysqli_close($db);
    }
}
