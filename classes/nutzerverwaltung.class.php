<?php

class Nutzerverwaltung extends Datenbank
{
    public function getStatus(){
        echo "Success";
    }
    public function changeUser($username, $email, $name){}
    public function adduser($username, $role, $email, $hashedpw)
    {
      $this->connect();
      $sql = "INSERT INTO User (username, role , email, password) VALUES (?, ?, ?, ?)";
      if($this->run_prepared($sql,"siss", array($username, $role, $email, $hashedpw))){
        $this->stmtclose_disconnect();
        return true;
      }
      $this->stmtclose_disconnect();
    }
    public function get_email_byID($ID_user){

    }
    public function deleteuser($userID)
    {
      $this->connect();
      $sql = "DELETE FROM User WHERE UserID=?";
      if($this->run_prepared($sql,"i", array($userID))){
        $this->stmtclose_disconnect();
        return true;
      }
      $this->stmtclose_disconnect();
    }

    public function change_userpassword($userID, $newpw)
    {
      $this->connect();
      $sql = "UPDATE user SET password=? WHERE UserID=?";
      if($this->run_prepared($sql, "si", array($newpw, $userID))){
        $this->stmtclose_disconnect();
        return true;
      }
      $this->stmtclose_disconnect();
    }

    public function change_userrole($userID, $newrole)
    {
      $this->connect();
      $sql = "UPDATE user SET role=? WHERE UserID=?";
      if($this->run_prepared($sql, "si", array($newrole, $userID))){
        $this->stmtclose_disconnect();
        return true;
      }
      $this->stmtclose_disconnect();
    }

    public function change_username($userID, $newusername)
    {
      $this->connect();
      $sql = "UPDATE user SET username=? WHERE UserID=?";
      if($this->run_prepared($sql, "si", array($newusername, $userID))){
        $this->stmtclose_disconnect();
        return true;
      }
      $this->stmtclose_disconnect();
    }
    public function get_name_by_id($ID){}
    public function get_username_by_id($ID){}
    public function get_userid_by_name($username)
    {
      $this->connect();
      $sql = "SELECT UserID FROM User WHERE username=?";
      if($this->run_prepared($sql,"s", array($username))){
        $result = $this->stmt->get_result();
        if($result->num_rows > 0){
          while($row = $result->fetch_assoc()){
            $array[] = $row;
          }
        $this->freeres_stmtclose_disconnect();
        return $array;
        }
      }
      $this->freeres_stmtclose_disconnect();
    }
    public function get_userrole_by_id($userID)
    {
      $this->connect();
      $sql = "SELECT role FROM USER WHERE UserID=?";
      if($this->run_prepared($sql, "i", array($userID))){
        $result = $this->stmt->get_result();
        if($result->num_rows > 0){
          while($row = $result->fetch_assoc()){
            $array[] = $row;
          }
        $this->freeres_stmtclose_disconnect();
        return $array;
        }
      }
      $this->freeres_stmtclose_disconnect();
    }
    public function check_user($username, $unHashedPW)
    {
      $sql = "SELECT password from user WHERE username=?";
      $this->connect();
      if($this->run_prepared($sql, "s", array($username))){
        $result = $this->stmt->get_result();
        if($result->num_rows > 0){
          while($row = $result->fetch_assoc()){
            $array[] = $row;
          }
        $this->freeres_stmtclose_disconnect();
        return password_verify($unHashedPW,$array[0]['password']);
        }
      }
    }
}
