<?php
class RacunarDAO {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getNajskuplji() {
        $sql = "SELECT * FROM racunari ORDER BY cena DESC LIMIT 1";
        $result = $this->conn->query($sql);

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return null;
    }

    public function getRacunarId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM racunari WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return null;
    }

    public function getNajjeftiniji() {
        $sql = "SELECT * FROM racunari ORDER BY cena ASC LIMIT 1";
        $result = $this->conn->query($sql);

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return null;
    }
}
?>
