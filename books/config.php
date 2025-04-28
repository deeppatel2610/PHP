
<?php

class Config
{


    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "Book";
    private $conn;

    function connectDb()
    {
        $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if ($this->conn) {
            $res = array("status" => "Database connected successfully !");
            // echo json_encode($res);
        } else {
            $res = array("status" => "Database connection process failed !");
            echo json_encode($res);
        }
    }
    function fetchStudents()
    {
        $query = "SELECT * FROM books";
        $result = mysqli_query($this->conn, $query); 
        if ($result) {
            $response = [];
            while ($data = mysqli_fetch_assoc($result)) {
                array_push($response, $data);
            }
            // echo json_encode($response);
            return $response;
        } else {
            return null;
            // echo json_encode(array("error" => "No data available"));
        }
    }

    function insertStudent($Book_Name, $Book_Writer, $Book_Details,$Book_Price)
    {
        $query = "INSERT INTO books(Book_Name,Book_Writer,Book_Details,Book_Price)VALUES('$Book_Name','$Book_Writer','$Book_Details','$Book_Price');";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }
    function __construct()
{
    $this->connectDb();
}


    function removeStudent($id)
    {
        $query = "DELETE FROM books WHERE id = $id;";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    function editStudent($id, $Book_Name, $Book_Writer, $Book_Details,$Book_Price)
    {
        $query = "UPDATE books SET Book_Name='$Book_Name',Book_Writer='$Book_Writer', Book_Details ='$Book_Details', Book_Price='$Book_Price' WHERE id ='$id'";

        $result = mysqli_query($this->conn, $query);
        return $result;
    }
}
