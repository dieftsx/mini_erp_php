<?php
// models/BaseModel.php
class BaseModel {
    protected $conn;

    public function __construct() {
        $this->conn = getDBConnection();
    }

    protected function query($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) return false;

        if (!empty($params)) {
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        return $stmt;
    }
}
?>