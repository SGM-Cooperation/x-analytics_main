<?php

class Produktverwaltung extends Datenbank
{

    public function database_connection_check()
    {
        if ($this->connect() && $this->disconnect()) {
            return true;
        } else {
            return false;
        }
    }

    //------------Funtionen zur Abfrage von Informationen------------------------------------

    public function get_all_Cookie($ID_user)
    {
        //Gibt alle Kategorien zurück
        $this->connect();
        $sql = "SELECT * FROM Cookie WHERE ID_user=?";
        if ($this->run_prepared($sql, "i", array($ID_user))) {
            $result = $this->stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $array[] = $row;
                }
                $this->freeres_stmtclose_disconnect();
                return $array;
            }
        }
        $this->freeres_stmtclose_disconnect();
    }

    public function get_cookie_by_Page($ID_Page)
    {
        $this->connect();
        $sql = "SELECT * FROM Cookie WHERE ID_Page=?";
        if ($this->run_prepared($sql, "i", array($ID_Page))) {
            $result = $this->stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $array[] = $row;
                }
                $this->freeres_stmtclose_disconnect();
                return $array;
            }
        }
        $this->freeres_stmtclose_disconnect();
    }

    public function add_cookie($IP, $City, $Country, $Time, $Browser, $ID_Page)
    {
        // Fügt ein Neues Produkt mit Eintrag in Alle Tabellen hinzu
        $this->connect();
        var_dump($IP);
        var_dump($City);
        var_dump($Country);
        var_dump($Time);
        var_dump($Browser);
        var_dump($ID_Page);
        $sql = "INSERT INTO Cookie (IP, City, Country, Time, Browser, ID_Page) VALUES (?, ?, ?, ?, ?,?,?)";
        if ($this->run_prepared($sql, "sssisi", array($IP, $City, $Country, $Time, $Browser, $ID_Page))) {
            $this->stmtclose_disconnect();
            return true;
        }
        $this->stmtclose_disconnect();
    }

    public function add_Page($URL, $ID_user)
    {
        // Fügt ein Neues Produkt mit Eintrag in Alle Tabellen hinzu

    }
    public function update_Page($ID_Page, $new_URL){}
    public function get_Page_by_URL($URL)
    {
        $this->connect();
        $sql = "SELECT * FROM Cookie WHERE URL=?";
        if ($this->run_prepared($sql, "i", array($URL))) {
            $result = $this->stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $array[] = $row;
                }
                $this->freeres_stmtclose_disconnect();
                return $array;
            }
        }
        $this->freeres_stmtclose_disconnect();
    }

    public function get_all_Page($ID_user)
    {
        //Gibt alle Kategorien zurück
        $this->connect();
        $sql = "SELECT * FROM Cookie WHERE ID_user=?";
        if ($this->run_prepared($sql, "i", array($ID_user))) {
            $result = $this->stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $array[] = $row;
                }
                $this->freeres_stmtclose_disconnect();
                return $array;
            }
        }
        $this->freeres_stmtclose_disconnect();
    }

    public function get_Cookie_ID($URL, $IP)
    {
        $this->connect();
        $sql = "SELECT * FROM Cookie WHERE URL=? AND IP=?";
        if ($this->run_prepared($sql, "si", array($URL, $IP))) {
            $result = $this->stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $array[] = $row;
                }
                $this->freeres_stmtclose_disconnect();
                return $array;
            }
        }
        $this->freeres_stmtclose_disconnect();
    }

    public function update_Cookie($ID_Cookie, $Time)
    {
        $this->connect();
        $sql = "UPDATE Cookie SET Time = ? WHERE ID_Cookie = ?;";
        if ($this->run_prepared($sql, "ii", array($ID_Cookie, $Time))) {
            $result = $this->stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $array[] = $row;
                }
                $this->freeres_stmtclose_disconnect();
                return $array;
            }
        }
        $this->freeres_stmtclose_disconnect();
    }

}
  
 ?>
