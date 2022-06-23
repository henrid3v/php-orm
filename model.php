<?php
    class ORM{
        private $name,$pass;
        function __construct($name,$pass){
            $this->name = $name;
            $this->pass = $pass;
        }
        private function server(){
            $db = new PDO('mysql:host=localhost',''.$this->name.'',''.$this->pass.'');
            return $db;
        }
        private function servers($dbname){
            $db = new PDO('mysql:host=localhost;dbname='.$dbname.'',''.$this->name.'',''.$this->pass.'');
            return $db;
        }
        public function createDatabase($data){
            $db = $this->server();
            $req = $db->query('create database '.$data);
        }
        public function createTable($data,$table,$nom,$type){
            $db = $this->servers($data);
            $req = $db->query('create table '.$table.'('.$nom.' '.$type.')');
        }
        public function alterTableAdd($data,$table,$nom,$type){
            $db = $this->servers($data);
            $req = $db->query('alter table '.$table.' add '.$nom.' '.$type.'');
        }
        public function alterTableForeign($data,$table,$i,$nom,$tableEtr){
            $db = $this->servers($data);
            $req = $db->query('alter table '.$table.' add constraint fk_etrangere'.$i.' foreign key('.$nom.') '.$tableEtr.'');
        }
        public function alterTablePrimary($data,$table,$cle){
            $db = $this->servers($data);
            $req = $db->query('alter table '.$table.' add primary key('.$cle.')');
        }
        public function alterTablePrimarys($data,$table,$cle){
            $db = $this->servers($data);
            $req = $db->query('alter table '.$table.' add constraint fk_primary primary key('.$cle.')');
        }
    }
?>
