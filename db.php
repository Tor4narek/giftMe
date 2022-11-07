<?php

class Database{
    private $link;
    public function __construct(){
        $this->connect();
        
    }
    private function connect(){
        $this->link = new PDO("mysql:host=localhost; dbname=a0738150_giftme", 'a0738150_giftme','191104Tor' );
        return $this; 

    }
    public function execute($sql){
        $sth = $this->link->prepare($sql);
        return $sth -> execute();
    }
    public function query($sql){
        $sth = $this->link->prepare($sql);
        $sth -> execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        if($result === false){
            return [];
        }
        return $result;
    }
}