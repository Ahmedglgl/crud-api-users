<?php

namespace Models;
use mysqli;

// Define the person object structure
class Person {

    public $id;
    public $name;
    public $age;
    public $gender;
    public $email;
    private $conn;

    public function __construct() {
        $user = "root";
        $pass = "";
        $db = "persons";
        $this->conn = new mysqli('localhost', $user, $pass, $db);
        // view all mysqli errors
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function all(){
        try{   

            $stmt = $this->conn->prepare("SELECT * FROM users");
            
            $stmt->execute();
            $result = $stmt->get_result();
            $persons = array();
            while ($row = $result->fetch_assoc()) {
                array_push($persons, $row);
            }
            return $persons;
        }catch(Exception $e){
            return $e->getMessage();
        }
    }

    public function store($data){
        try{
            
            if(!isset($data) || empty($data)|| !is_array($data) || count($data) < 1){
                return 'data is empty';
            }
            $stmt = $this->conn->prepare("INSERT INTO users (name, age, gender, email) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("siis", $data['name'],$data['age'],$data['gender'],$data['email']);
            $stmt->execute();
            // check for successful store
            if($stmt->affected_rows === 0){
                return 'user not created';
            }
            $stmt->close();
            return $data;
        }catch(Exception $e){
            return $e->getMessage();
        }
    }

    public function show($id){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows === 0){
                return 'user not found';
            }
            $person = array();
            while ($row = $result->fetch_assoc()) {
                array_push($person, $row);
            }
            return $person;
        }catch(Exception $e){
            return $e->getMessage();
        }
    }

    public function update($data,$id){
        try{
            if(!isset($data) || empty($data)|| !is_array($data) || count($data) < 1){
                return 'data is empty';
            }

            $stmt = $this->conn->prepare("select * from users where id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $person = $stmt->get_result();
            if($person->num_rows === 0){
                return 'user not found';
            }
            
            // update 
            $stmt = $this->conn->prepare("UPDATE users SET name=?, age=?, gender=?, email=? WHERE id=?");            
            $stmt->bind_param("sssss", $data['name'],$data['age'],$data['gender'],$data['email'],$id);
            $stmt->execute();
            if($stmt->affected_rows === 0){
                return 'user not updated';
            }
            $stmt->close();
            return $data;
        }catch(Exception $e){
            return $e->getMessage();
        }

    }

    public function delete($id){
        $stmt = $this->conn->prepare("select * from users where id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        if($stmt->affected_rows === 0){
            return 'user not found';
        }
        $stmt->close();
        // delete 
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        if($stmt->affected_rows === 0){
            return 'user not deleted';
        }

        return 'Deleted successfully';

    }


}


