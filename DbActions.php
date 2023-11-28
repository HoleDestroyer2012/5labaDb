<?php
class DbActions
{
    private $DB_ADRESS;
    private $USERNAME;
    private $PASSWORD;
    private $DB_NAME;
    private $conn;

    public function __construct($DB_ADRESS = "localhost", $USERNAME = "root", $PASSWORD = "", $DB_NAME = "my_database")
    {
        $this->DB_ADRESS = $DB_ADRESS;
        $this->USERNAME = $USERNAME;
        $this->PASSWORD = $PASSWORD;
        $this->DB_NAME = $DB_NAME;
    }

    public function dbConnect()
    {
        $this->conn = new mysqli($this->DB_ADRESS, $this->USERNAME, $this->PASSWORD, $this->DB_NAME);

        if ($this->conn->connect_error) {
            die("Ошибка подключения: " . $this->conn->connect_error);
        }
    }

    public function closeConnection()
    {
        $this->conn->close();
    }

    public function addUserDb()
    {
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $delivery_address = $_POST["delivery_address"];
        $email = $_POST["email"];
        $phone_number = $_POST["phone_number"];

        $sql = "INSERT INTO customers (first_name, last_name, delivery_address, email, phone_number) VALUES ('$first_name', '$last_name', '$delivery_address', '$email', '$phone_number')";

        $this->dbConnect();

        if ($this->conn->query($sql) === true) {
            $_COOKIE["add_user_log"] = "Пользователь успешно добавлен в базу данных";
        } else {
            $_COOKIE["add_user_log"] = "Ошибка при добавлении пользователя";
        }

        $this->closeConnection();
    }

    public function checkTable()
    {
        if (isset($_GET["table_name"])) {
            $table_name = $_GET["table_name"];

            $sql = "SELECT * FROM " . $table_name;

            $this->dbConnect();
            $result = $this->conn->query($sql);

            if ($result->num_rows > 0) {
                $_COOKIE["rows"] = $result->fetch_all(MYSQLI_ASSOC);
            }

            $this->closeConnection();
        }
    }
}
?>