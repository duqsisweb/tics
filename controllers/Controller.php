<?php 
class Controller {
    protected function view($view, $data = []) {
        require_once "../views/header.php"; // Incluimos el header en todas las vistas
        require_once "../views/" . $view . ".php";
    }
}

?>