<?php
require_once('config.php');

class modeloCredencialesBD
{
    protected $_db;

    public function __construct()
    {
        // $this->_db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->_db = mysqli_connect("localhost","root", "", "labsdb");

        if($this->_db->connect_errno){
            echo "Fallo al conectar a la base de datos ".$this->_db->connect_errno;
            return;
        }
    }

    
}