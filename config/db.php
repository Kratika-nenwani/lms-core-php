<?php
// class Database {
//     private $host = "db"; // service name from docker-compose
//     private $db_name = "lms";
//     private $username = "root";
//     private $password = "root";
//     public $conn;

//     public function connect() {
//         $this->conn = null;
//         try {
//             $this->conn = new PDO(
//                 "mysql:host={$this->host};dbname={$this->db_name}",
//                 $this->username,
//                 $this->password
//             );
//             $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//         } catch(PDOException $exception) {
//             echo "Connection error: " . $exception->getMessage();
//         }

//         return $this->conn;
//     }
// }
class Database
{
    private $host;
    private $db_name;
    private $username;
    private $password;
    public $conn;

    public function __construct()
    {
        $this->host = getenv("DB_HOST");
        $this->db_name = getenv("DB_NAME");
        $this->username = getenv("DB_USER");
        $this->password = getenv("DB_PASS");
    }

    public function connect()
    {
        $this->conn = null;
        
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name}",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
