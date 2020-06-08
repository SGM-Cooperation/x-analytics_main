<?php

class Auftragsverwaltung extends Datenbank
{
  //
  //  Hinzufügen von Datensätzen in die Haupttabellen
  //
  public function add_bezahlmethode($name, $linktoimage, $verfuegbar)
  {
    $this->connect();
    $sql = "INSERT INTO Bezahlmethode (name, linktoimage , verfuegbar) VALUES (?, ?, ?)";
    if($this->run_prepared($sql,"ssb", array($name, $linktoimage, $verfuegbar))){
      $this->stmtclose_disconnect();
      return true;
      }
    $this->stmtclose_disconnect();
  }

  public function add_liefermethode($name, $linktoimage)
  {
    $this->connect();
    $sql = "INSERT INTO Liefermethode (name, linktoimage) VALUES (?, ?)";
    if($this->run_prepared($sql,"ss", array($name, $linktoimage))){
      $this->stmtclose_disconnect();
      return true;
      }
    $this->stmtclose_disconnect();
  }

  public function add_status($color, $bezeichnung)
  {
    $this->connect();
    $sql = "INSERT INTO Status (color, bezeichnung) VALUES (?, ?)";
    if($this->run_prepared($sql,"ssb", array($color, $bezeichnung))){
      $this->stmtclose_disconnect();
      return true;
      }
    $this->stmtclose_disconnect();
  }

  public function add_auftrag($bestellung, $anschrift, $kontakt, $standort, $preis, $liefermethode, $bezahlmethode, $status)
  {
    $this->connect();
  $sql = "INSERT INTO Auftrag (bestellung, anschrift, kontakt, standort, preis, liefermethodeFremdschluessel, bezahlmethodeFremdschluessel, statusFremdschluessel) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
      if ($this->run_prepared($sql, "ssssiiii", array($bestellung, $anschrift, $kontakt, $standort, $preis, $liefermethode, $bezahlmethode, $status))) {
      $this->stmtclose_disconnect();
      return true;
      }
    $this->stmtclose_disconnect();
  }
  //
  // löschen von einträgen in denj Haupttabellen
  //
  public function delete_bezahlmethode($id)
  {
    $this->connect();
    $sql = "DELETE FROM Bezahlmethode WHERE id=?";
    if($this->run_prepared($sql,"i", array($id))){
      $this->stmtclose_disconnect();
      return true;
      }
    $this->stmtclose_disconnect();
  }

  public function delete_liefermethode($id)
  {
    $this->connect();
    $sql = "DELETE FROM Liefermethode WHERE id=?";
    if($this->run_prepared($sql,"i", array($id))){
      $this->stmtclose_disconnect();
      return true;
      }
    $this->stmtclose_disconnect();
  }

  public function delete_status($id)
  {
    $this->connect();
    $sql = "DELETE FROM Status WHERE id=?";
    if($this->run_prepared($sql,"i", array($id))){
      $this->stmtclose_disconnect();
      return true;
      }
    $this->stmtclose_disconnect();
  }

  public function delete_auftrag($id)
  {
    $this->connect();
    $sql = "DELETE FROM Auftrag WHERE id=?";
    if($this->run_prepared($sql,"i", array($id))){
      $this->stmtclose_disconnect();
      return true;
      }
    $this->stmtclose_disconnect();
  }
  //
  // Erhalten von Daten aus den Haupttabellen
  //
  public function all_auftraege()
  {
    $this->connect();
    $sql = "SELECT * FROM Auftrag";
    if($this->run_simple($sql)){
      if($this->result->num_rows > 0){
        while($row = $this->result->fetch_assoc()){
          $array[] = $row;
        }
        $this->disconnect();
        return $array;
      }
    }
    $this->disconnect();
  }

  public function auftrag_by_standort($standort)
  {
    $this->connect();
    $sql = "SELECT * FROM Auftrag WHERE standort=?";
    if($this->run_prepared($sql,"s", array($standort))){
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

  public function all_bezahlmethoden()
  {
    $this->connect();
    $sql = "SELECT * FROM Bezahlmethode";
    if($this->run_simple($sql)){
      if($this->result->num_rows > 0){
        while($row = $this->result->fetch_assoc()){
          $array[] = $row;
        }
        $this->disconnect();
        return $array;
      }
    }
    $this->disconnect();
  }

    public function get_price_byID($byID)
    {
        $this->connect();
        $sql = "SELECT * FROM auftrag WHERE id=?";
        if ($this->run_prepared($sql, "i", array($byID))) {
            if ($this->result->num_rows > 0) {
                while ($row = $this->result->fetch_assoc()) {
                    $array[] = $row;
                }
                $this->disconnect();
                return $array;
            }
        }
        $this->disconnect();
  }

  public function get_bezahlmethoden_byID($byID)
  {
    $this->connect();
    $sql = "SELECT * FROM Bezahlmethode WHERE id=?";
      if ($this->run_prepared($sql, "i", array($byID))) {
      if($this->result->num_rows > 0){
        while($row = $this->result->fetch_assoc()){
          $array[] = $row;
        }
        $this->disconnect();
        return $array;
      }
    }
    $this->disconnect();
  }

  public function all_liefermethoden()
  {
    $this->connect();
    $sql = "SELECT * FROM Liefermethode";
    if($this->run_simple($sql)){
      if($this->result->num_rows > 0){
        while($row = $this->result->fetch_assoc()){
          $array[] = $row;
        }
        $this->disconnect();
        return $array;
      }
    }
    $this->disconnect();
  }

  public function get_liefermethode_byID($ID)
  {
    $this->connect();
    $sql = "SELECT * FROM Liefermethode WHERE id = $ID";
    if($this->run_simple($sql)){
      if($this->result->num_rows > 0){
        while($row = $this->result->fetch_assoc()){
          $array[] = $row;
        }
        $this->disconnect();
        return $array;
      }
    }
    $this->disconnect();
  }

  public function all_staten()
  {
    $this->connect();
    $sql = "SELECT * FROM Status";
    if($this->run_simple($sql)){
      if($this->result->num_rows > 0){
        while($row = $this->result->fetch_assoc()){
          $array[] = $row;
        }
        $this->disconnect();
        return $array;
      }
    }
    $this->disconnect();
  }
  public function get_status_byID($ID)
  {
    $this->connect();
    $sql = "SELECT * FROM Status WHERE  id=?";
    if($this->run_prepared($sql,"i", array($ID))){
      if($this->result->num_rows > 0){
        while($row = $this->result->fetch_assoc()){
          $array[] = $row;
        }
        $this->disconnect();
        return $array;
      }
    }
    $this->disconnect();
  }
  //
  // Ändern von Daten in Haupttabellen
  //
  public function update_value($table, $valuename, $newvalue, $conditionattr, $conditionvalue, $datatypenewvalue, $datatypeconditionvalue) {
    //ändert einen Wert in einer tabelle: Gibt false zurück wenn prepare_statement in Datenbank false liefert -> SQL Statement nicht korrekt($sql)
    $this->connect();
    $sql = "UPDATE ".$this->con->real_escape_string($table)." SET ".$this->con->real_escape_string($valuename)."=? WHERE ".$this->con->real_escape_string($conditionattr)."=?";
    $dts = "".$datatypenewvalue."".$datatypeconditionvalue;
    if ($this->run_prepared($sql, $dts, array($newvalue, $conditionvalue))) {
      $this->stmtclose_disconnect();
      return true;
    }
    $this->stmtclose_disconnect();
  } // REDUNDANT TO Produktverwaltung
}
