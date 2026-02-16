<?php
class model
{
    public $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function check_record($table, $conditions = [])
    {
        $where = [];

        foreach ($conditions as $column => $value) {
            $where[] = "$column = ?";
        }

        $where_clause = $where ? implode(' AND ', $where) : '1';
        $sql = "SELECT * FROM $table WHERE $where_clause";

        $stmt = $this->conn->prepare($sql);

        if (!empty($conditions)) {
            $types = str_repeat("s", count($conditions));
            $values = array_values($conditions);
            $stmt->bind_param($types, ...$values);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    public function insert_record($table, $data = [])
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode("','", $data);

        $sql = "INSERT INTO $table ($columns) VALUES ('$placeholders')";
        $this->conn->query($sql);

        return $this->conn->insert_id;
    }

    public function fetch_records($table, $columns = ['*'], $join = "", $conditions = [])
    {
        $table = preg_replace('/[^a-zA-Z0-9_]/', '', $table);

        $cols = implode(', ', $columns);

        $where = [];
        foreach ($conditions as $column => $value) {
            $where[] = "$column = ?";
        }

        $where_clause = !empty($where) ? implode(' AND ', $where) : '';

        $sql = "SELECT $cols FROM `$table`";

        if (!empty($join)) {
            $sql .= " $join";
        }

        if (!empty($where_clause)) {
            $sql .= " WHERE $where_clause";
        }

        $stmt = $this->conn->prepare($sql);

        if (!empty($conditions)) {
            $types = str_repeat("s", count($conditions));
            $values = array_values($conditions);
            $stmt->bind_param($types, ...$values);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }


    public function get_record_by_id($table, $id)
    {
        $table = preg_replace('/[^a-zA-Z0-9_]/', '', $table);

        $stmt = $this->conn->prepare("SELECT * FROM $table WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function update($table, $data = [], $where_column = 'id', $where_value = null)
    {
        // safety
        $table = preg_replace('/[^a-zA-Z0-9_]/', '', $table);
        $where_column = preg_replace('/[^a-zA-Z0-9_]/', '', $where_column);

        $fields = [];
        $types = "";
        $values = [];

        foreach ($data as $key => $value) {
            $fields[] = "`$key` = ?";
            $types .= "s";
            $values[] = $value;
        }

        $fields_sql = implode(', ', $fields);

        // 👇 dynamic column
        $sql = "UPDATE `$table` SET $fields_sql WHERE `$where_column` = ?";

        $types .= "i";
        $values[] = $where_value;

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param($types, ...$values);

        return $stmt->execute();
        //return $sql;
    }


    public function count($table, $conditions = [])
    {
        $table = preg_replace('/[^a-zA-Z0-9_]/', '', $table);

        $sql = "SELECT COUNT(*) as total FROM $table";

        if (!empty($conditions)) {
            $where = [];
            foreach ($conditions as $key => $value) {
                $value = $this->conn->real_escape_string($value);
                $where[] = "$key = '$value'";
            }
            $sql .= " WHERE " . implode(" AND ", $where);
        }

        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    public function delete($table, $where_column = 'id', $where_value = null)
{
    $table = preg_replace('/[^a-zA-Z0-9_]/', '', $table);
    $where_column = preg_replace('/[^a-zA-Z0-9_]/', '', $where_column);

    $sql = "DELETE FROM `$table` WHERE `$where_column` = ?";

    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $where_value);

    return $stmt->execute();
}

}
?>