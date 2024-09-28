<?php
class DataBase {
    private static $localhost;
    private static $username;
    private static $password;
    private static $database;
    public static $databaseConnection;

    public function __construct() {
        self::$localhost = 'localhost';
        self::$database = 'jet';
        self::$username = 'root'; 
        self::$password = '1234'; 
        self::connect();
    }

    private static function connect() {
        try {
            self::$databaseConnection = new PDO(
                "mysql:host=" . self::$localhost . ";dbname=" . self::$database, self::$username, self::$password
            );
        } catch (PDOException $error) {
            echo "Failed connection to database: " . $error->getMessage();
        }
    }

    public static function getInstance() {
        static $instance;
        if ($instance === null) {
            $instance = new self();
        }
        return $instance;
    }
}
?>

