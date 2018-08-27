<?php

 class DBConnection {
	
    private static $_handle = null;
    private static $_dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';port=3306';
    private static $_user = DB_LOGIN;
    private static $_password = DB_PASSWORD;
    private static $_options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"); // SET UTF-8

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function connect()
    {
        if ( is_null( self::$_handle ) ) {
            try {
                self::$_handle = new PDO( 
                    self::$_dsn, self::$_user, self::$_password, self::$_options 
                   );
            } catch ( PDOException $error ){
                die ( $error->getMessage() );
            }
        }
        return self::$_handle;
    }
}
