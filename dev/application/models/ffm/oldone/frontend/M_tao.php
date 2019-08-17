<?php 
     if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    require_once(dirname(__FILE__)."/../M_complain.php");
    class tao extends  M_complain{
        public $cp_id;
        public $cp_complain;
        public $last_insert_id;
        function __construct(){
            parent::__construct();  
        }
        function insert() {
            $sql = "INSERT INTO complain (cp_complain)
                    VALUES(?)";
            $this->ffm->query($sql, array($this->cp_complain));
            $this->last_insert_id = $this->ffm->insert_id();
        }
    }
?>