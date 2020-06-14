<?php
?>
<p></p>
<?php
class Datenbank {

    protected $con = false;
    private $DB_Servername = "localhost";
    private $DB_User = "root";
    private $DB_Passwort = "";
    private $DB_Name = "x-analytics";
    protected $stmt;
    protected $result;


    protected function run_simple($sql){
      // Führt ein sql statement ohne prepared statements
      if($this->con){
        if($this->result = $this->con->query($sql)){
          return true;
        } else {
          return false;
        }
      } else {
        return false;
      }
    } // end of function

    protected function run_prepared($statement, $datatypestring ,$valuearray){
      //creates a statement an runs it
      if ($this->con) {
        if ($this->stmt = $this->con->prepare($statement)) {
          $this->stmt->bind_param($datatypestring, ...$valuearray);
          $this->stmt->execute();
          return true;
        } else {
          return false;
        }
      } else {
        return false;
      }
    } // end of function

    protected function close_statement(){
      if ($this->stmt) {
        if ($this->stmt->close()) {
          return true;
        } else {
          return false;
        }
      } else {
        return true;
      }
    } // end of function

    protected function connect(){
      if(!$this->con){
        $this->con = new mysqli($this->DB_Servername,$this->DB_User,$this->DB_Passwort,$this->DB_Name); //erstelle verbindung
        if($this->con){
          //echo "connected";
          return true;
        } else{
        return false;
          }
      } else{
          return true;
        }
    } // end of function

    protected function disconnect(){
      if($this->con){
        if($this->con->close()){
          $this->con = false;
          return true;
        }
        else{
          return false;
        }
      } else {
        return true;
      }
    } // end of function

    protected function table_exists($table){
      $result = $this->con->query('SHOW TABLES FROM '.$this->DB_Name.' LIKE "'.$table.'"');
      if($result){
        if($result->num_rows==1){
          return true;
        } else{
          return false;
        }
      }
    } // end of function

    protected function freeres(){
      if ($this->stmt) {
        if ($this->stmt->free_result()) {
          return true;
        } else {
          return false;
        }
      } else {
        return true;
      }
    } // end of function

    protected function stmtclose_disconnect(){ // use at non select prepared queries
      if ($this->close_statement() && $this->disconnect()) {
        return true;
      } else {
        return false;
      }
    } // end of function

    protected function freeres_stmtclose_disconnect(){ // use at non select prepared queries
      $this->freeres();
      $this->close_statement();
      $this->disconnect();
    } // end of function
}
