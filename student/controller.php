<?php
require_once "DAO.php";
session_start();

class controller{

    function logout(){
        if($_SESSION["korisnik"]){
            session_unset();
            session_destroy();
            include "../public/viewForm.php";
        }
    }


    // New method to insert and calculate minimum presence
    function insertAndCalculateMinPrisustvo() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $brRadnika = isset($_POST['brRadnika']) ? $_POST['brRadnika'] : null;
            $trajanjePrisustva = isset($_POST['trajanjePrisustva']) ? $_POST['trajanjePrisustva'] : null;

            $errors = $this->validate($brRadnika, $trajanjePrisustva);
            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header('Location: index.php');
                exit();
            }

            // Insert data into the database
            $dao = new DAO();
            $dao->insertPrisustvo($brRadnika, $trajanjePrisustva);

            // Get the record with minimum presence
            $minPrisustvo = $dao->getMinPrisustvo();

            // Store data in the session
            $_SESSION['minPrisustvo'] = $minPrisustvo;

            // Redirect to the display page
            header('Location: ../public/prikaz.php');
            exit();
        }
    }

    private function validate($brRadnika, $trajanjePrisustva) {
        $errors = [];

        if (empty($brRadnika) || !is_numeric($brRadnika)) {
            $errors[] = 'Broj radnika mora biti validan broj.';
        }

        if (empty($trajanjePrisustva) || !is_numeric($trajanjePrisustva)) {
            $errors[] = 'Trajanje prisustva mora biti validan broj.';
        }

        return $errors;
    }
}
?>