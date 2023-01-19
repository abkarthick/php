<?php
class CRUD
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create($table, $data)
    {
        $fields = implode(", ", array_keys($data));
        $values = ":" . implode(", :", array_keys($data));

        $query = "INSERT INTO $table ($fields) VALUES ($values)";
        $stmt = $this->db->prepare($query);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        return $stmt->execute();
    }

    public function read($table, $id = null)
    {
        if ($id) {
            $query = "SELECT * FROM $table WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $query = "SELECT * FROM $table";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }

    public function update($table, $data, $id)
    {
        $fields = implode(" = :", array_keys($data)) . " = :";

        $query = "UPDATE $table SET $fields WHERE id = :id";
        $stmt = $this->db->prepare($query);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        $stmt->bindValue(':id', $id);

        return $stmt->execute();
    }

    public function delete($table, $id)
    {
        $query = "DELETE FROM $table WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }
}



// CREATE

$pdo = new PDO("mysql:host=localhost;dbname=your_db", "username", "password");
$crud = new CRUD($pdo);

// To create a new record, you can call the `create` method and pass in the table name and an associative array of data:

$data = array(
    "name" => "John Doe",
    "email" => "johndoe@example.com",
    "phone" => "555-555-5555"
);

$crud->create("users", $data);

// READ

// To read a single record
$user = $crud->read("users", 1);

// To read all records
$users = $crud->read("users");

// UPDATE

$data = array(
    "name" => "Jane Doe",
    "email" => "janedoe@example.com",
    "phone" => "555-555-5555"
);
$crud->update("users", $data, 1);

// DELETE

$crud->delete("users", 1);
