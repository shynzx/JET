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
        self::$username = 'enrique@jet'; // Nota el '@jet' al final del username.
        self::$password = '125128HL:v125'; 
        self::connect();
    }

    private static function connect() {
        try {
            $options = [
                PDO::MYSQL_ATTR_SSL_CA => 'DigiCertGlobalRootCA.crt.pem', // Ruta al certificado SSL
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];
            self::$databaseConnection = new PDO(
                "mysql:host=" . self::$localhost . ";dbname=" . self::$database, self::$username, self::$password, $options
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
