<?php
class DataBase {
    private static $localhost;
    private static $username;
    private static $password;
    private static $database;
    public static $databaseConnection;

    public function __construct() {
        self::$localhost = 'jet.mysql.database.azure.com';
        self::$database = 'jet';
        self::$username = 'enrique@jet';
        self::$password = '125128HL:v125';
        self::connect();
    }

    private static function connect() {
        try {
            self::$databaseConnection = new PDO(
                "mysql:host=" . self::$localhost . ";dbname=" . self::$database, self::$username, self::$password
            );
            echo "Connection successful without SSL.";
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

DataBase::getInstance();
?>
