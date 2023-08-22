<?php
// HomeController.php
class HomeController extends Controller {
    public function index() {
        // Aquí puedes agregar la lógica que necesitas para cargar los datos para tu vista.
        $data = [
            'message' => '¡Bienvenido a mi proyecto!',
        ];

        // Llamamos a la vista y le pasamos los datos que queremos mostrar.
        $this->view('home', $data);
    }
}
?>