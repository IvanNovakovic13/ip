<?php
require_once "RacunarDAO.php";
require_once "db_connection.php"; // Assuming this file sets up $conn
session_start();

class Controller {
    private $dao;

    public function __construct() {
        global $conn;
        $this->dao = new RacunarDAO($conn);
    }

    public function post() {
        $id = isset($_POST['id']) ? intval($_POST['id']) : null;

        if (!empty($id)) {
            $racunar = $this->dao->getRacunarId($id);

            if ($racunar !== null) {
                $_SESSION['racunar'] = $racunar;
                header("Location: prikaz.php");
                exit;
            } else {
                $_SESSION['error'] = "Nema ovog racunara";
                header("Location: index.php");
                exit;
            }
        } else {
            $_SESSION['error'] = "ID nije prosleđen ili je nevažeći";
            header("Location: index.php");
            exit;
        }
    }

    public function logout() {
        if (isset($_SESSION['racunar'])) {
            session_unset();
            session_destroy();
            header("Location: index.php");
            exit;
        }
    }
}

$controller = new Controller();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->post();
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['logout'])) {
    $controller->logout();
} else {
    header("Location: index.php");
    exit;
}
?>
