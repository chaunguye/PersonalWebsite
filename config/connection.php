<?php
class Database{
private $servername = "localhost";
private $username = "root";
private $password = "";
private $databasename = "LazyReader";
// Create connection
public function connect(){
  $db = new mysqli($this->servername, $this->username, $this->password, $this->databasename);
// Check connection
  if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
  }
  return $db;
}
}
?>