<?php
class DataBase {
    private static $localhost;
    private static $username;
    private static $password;
    private static $database;
    public static $databaseConnection;

    private function __construct() {
        // Initialize database credentials from environment variables
        self::$localhost = getenv('DB_HOST') ?: 'jet.mysql.database.azure.com';
        self::$database = getenv('DB_NAME') ?: 'jet';
        self::$username = getenv('DB_USER') ?: 'enrique@jet'; // Note the '@jet' at the end of the username.
        self::$password = getenv('DB_PASS') ?: '125128HL:v125';
        self::connect();
    }

    private static function connect() {
        try {
            $options = [
                PDO::MYSQL_ATTR_SSL_CA => getenv('DB_SSL_CA') ?: 'DigiCertGlobalRootCA.crt.pem', // Path to SSL certificate
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];
            self::$databaseConnection = new PDO(
                "mysql:host=" . self::$localhost . ";dbname=" . self::$database, self::$username, self::$password, $options
            );
        } catch (PDOException $error) {
            // Log error to a file
            error_log("Failed connection to database: " . $error->getMessage());
            // Optionally, handle the error gracefully
            die("Database connection failed. Please try again later.");
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
