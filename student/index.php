<?php
$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";
require_once "controller.php";

$cs = new controller();

switch ($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        switch ($action) {
            case "forma":
                include "../public/viewForm.php";
                break;
            case "logout":
                $cs->logout();
                break;
        }
        break;

    case "POST":
        switch ($action) {
            case "Update":
                $cs->insertAndCalculateMinPrisustvo();
                break;
            case "insertAndCalculateMinPrisustvo":
                $cs->insertAndCalculateMinPrisustvo();
                break;
        }
        break;
}
?>
