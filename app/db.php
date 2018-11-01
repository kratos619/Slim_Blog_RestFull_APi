<?php 

class DB 
{
    private $db_host = 'localhost';
    private $db_user = 'root';
    private $db_name = 'blog_api';
    private $db_pass =  '';


    // conncection

    public function connection(){
        $mysql_connection_string = "mysql:host=$this->db_host;dbname=$this->db_name";

        $db_connection = new PDO($mysql_connection_string, $this->db_user,$this->db_pass);

        $db_connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        return $db_connection;
    }

}
