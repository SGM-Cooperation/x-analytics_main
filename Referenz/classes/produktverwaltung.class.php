<?php

class Produktverwaltung extends Datenbank {

  public function database_connection_check(){
    if($this->connect() && $this->disconnect()){
      return true;
    } else{
      return false;
    }
  }
  //------------Funtionen zur Abfrage von Informationen------------------------------------

  public function get_product_by_name($pname){
    // Gibt alle produkte mit dem name in $pname zurück
    $this->connect();
    $sql = "SELECT * FROM Produkt WHERE name=?";
    if($this->run_prepared($sql,"s", array($pname))){
      $result = $this->stmt->get_result();
      if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
          $array[$row["ProduktID"]] = $row;
        }
        $this->freeres_stmtclose_disconnect();
        return $array;
      }
    }
    $this->freeres_stmtclose_disconnect();
  }

  public function all_categories() {
    //Gibt alle Kategorien zurück
    $this->connect();
    $sql = "SELECT * FROM Kategorie";
    if($this->run_simple($sql)){
      if($this->result->num_rows > 0){
        while($row = $this->result->fetch_assoc()){
          $array[$row["KategorieID"]] = $row;
        }
        $this->disconnect();
        return $array;
      }
    }
    $this->disconnect();
  }

  public function all_products()
  {
    $this->connect();
    $sql = "SELECT * FROM Produkt";
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

  public function all_sizes(){
    // Gibt alle einträge der Tabelle Größen zurück
    $this->connect();
    $sql = "SELECT * FROM Groesse";
    if($this->run_simple($sql)){
      if($this->result->num_rows > 0){
        while($row = $this->result->fetch_assoc()){
          $array[$row["GroesseID"]] = $row;
        }
        $this->disconnect();
        return $array;
      }
    }
    $this->disconnect();
  }

  public function sizes_of_product($productID){
    // Gibt Alle Verfügbaren Größen für ein Produkt zurück
    $this->connect();
    $sql = "SELECT GroesseFremdschluessel FROM ProdGrPr WHERE ProduktFremdschluessel=?";
    if($this->run_prepared($sql,"i", array($productID))){
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

  public function size_data_by_ID($GroesseID){
    // Gibt Alle Verfügbaren Größen für ein Produkt zurück
    $this->connect();
    $sql = "SELECT * FROM groesse WHERE GroesseID=?";
    if($this->run_prepared($sql,"i", array($GroesseID))){
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

  public function productprice_by_size($productID,$sizeID){
    // Gibt den Preis eines Produktes für eine Größe zurück
    $this->connect();
    $sql = "SELECT preis FROM ProdGrPr WHERE ProduktFremdschluessel=? AND GroesseFremdschluessel=?";
    if($this->run_prepared($sql,"ii", array($productID, $sizeID))){
      $result = $this->stmt->get_result();
      if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $this->freeres_stmtclose_disconnect();
        return $row;
        }
      }
    $this->freeres_stmtclose_disconnect();
  }

  public function all_ingrediences(){
    // Gibt alle verfügbaren Zusatzzutaten zurück
    $this->connect();
    $sql = "SELECT * FROM Zusatzzutat";
    if($this->run_simple($sql)){
      if($this->result->num_rows > 0){
        while($row = $this->result->fetch_assoc()){
          $array[$row["ZusatzzutatID"]] = $row;
        }
        $this->disconnect();
        return $array;
      }
    }
    $this->disconnect();
  }

  public function ingrediences_of_product($productID){
    // Gibt alle für ein Produkt verfügbare Zusatzzutaten zurück
    $this->connect();
    $sql = "SELECT ZusatzzutatFremdschluessel FROM hatZusatzzutat WHERE ProduktFremdschluessel=?";
    if($this->run_prepared($sql,"i", array($productID))){
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

  public function ingredienceprice_by_size($ingredience, $sizeID){
    //gibt den preis für eine zusatzzutat für eine bestimmte Größe zurück
    $this->connect();
    $sql = "SELECT preis FROM ZusatzzutatGrPr WHERE ZusatzzutatFremdschluessel=? AND GroesseFremdschluessel=?";
    if($this->run_prepared($sql,"ii", array($ingredience, $sizeID))){
      $result = $this->stmt->get_result();
      if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $this->freeres_stmtclose_disconnect();
        return $row;
        }
      }
    $this->freeres_stmtclose_disconnect();
  }
  public function ingredience_data_by_ID($GroesseID){
    // Gibt Alle Verfügbaren Größen für ein Produkt zurück
    $this->connect();
    $sql = "SELECT * FROM zusatzzutat WHERE ZusatzzutatID=?";
    if($this->run_prepared($sql,"i", array($GroesseID))){
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
  public function all_additives(){
    // gibt eine Liste aller vorhandenen Zusatzstoffe zurück
    $this->connect();
    $sql = "SELECT * FROM Zusatzstoff";
    if($this->run_simple($sql)){
      if($this->result->num_rows > 0){
        while($row = $this->result->fetch_assoc()){
          $array[$row["ZusatzstoffID"]] = $row;
        }
        $this->disconnect();
        return $array;
      }
    }
    $this->disconnect();
  }

  public function additives_of_product($productID){
    // Gibt eine Liste aller in einem Produkt vorhandenen Zusatzstoffe zurück
    $this->connect();
    $sql = "SELECT * FROM hatZusatzstoff WHERE ProduktFremdschluessel=?";
    if($this->run_prepared($sql,"i", array($productID))){
      $result = $this->stmt->get_result();
      if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
          $array[] = $row["ZusatzstoffFremdschluessel"];
        }
        $this->freeres_stmtclose_disconnect();
        return $array;
      }
    }
    $this->freeres_stmtclose_disconnect();
  }

  public function add_category($name, $description){
    // Fügt Kategorie hinzu
    $this->connect();
    $sql = "INSERT INTO Kategorie (name, beschreibung) VALUES (?, ?)";
    if($this->run_prepared($sql,"ss", array($name, $description))){
      $this->stmtclose_disconnect();
      return true;
      }
    $this->stmtclose_disconnect();
  }

  public function delete_category($categoryID){
    //Löscht eine Kategorie und alle enthaltenen Produkte
    $this->connect();
    $sql = "DELETE FROM Kategorie WHERE KategorieID=?";
    if($this->run_prepared($sql,"i", array($categoryID))){
      $this->stmtclose_disconnect();
      foreach($this->products_of_category($categoryID) as $product){
        $this->delete_product($product["ProduktID"]);
      }
      return true;
      }
    $this->stmtclose_disconnect();
    }



  //-------------Funktionen zum Hinzufügen von Haupttabellen--------------------------------

  public function products_of_category($category) {
    // Gibt Alle Produkte einer bestimmten Kategorie zurück
    $this->connect();
    $sql = "SELECT * FROM Produkt WHERE KategorieFremdSchluessel=?";
    if($this->run_prepared($sql,"i", array($category))){
      $result = $this->stmt->get_result();
      if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
          $array[$row["ProduktID"]] = $row;
        }
        $this->freeres_stmtclose_disconnect();
        return $array;
      }
    }
    $this->freeres_stmtclose_disconnect();
  }

  public function delete_product($productID){
    //Löscht ein Produkt aus allen Datenbanken
    $this->connect();
    $sql = "DELETE FROM Produkt WHERE ProduktID=?";
    if($this->run_prepared($sql,"i", array($productID))){
      $this->stmtclose_disconnect();
      $this->delete_all_ingrendience_from_product($productID);
      $this->delete_all_additive_from_product($productID);
      $this->delete_all_size_price_relations_from_product($productID);
      return true;
      }
    $this->stmtclose_disconnect();
    }

  public function delete_all_ingrendience_from_product($productID){
    //Löscht alle einem Produkt zugehörigen einträge in hatZusatzzutat
    $this->connect();
    $sql = "DELETE FROM hatZusatzzutat WHERE ProduktFremdschluessel=?";
    if($this->run_prepared($sql,"i", array($productID))){
      $this->stmtclose_disconnect();
      return true;
      }
      $this->stmtclose_disconnect();
  }

  public function delete_all_additive_from_product($productID){
    //Löscht alle einem Produkt zugehörigen Zusatzstoffe, also Einträge in hatZusatzstoff
    $this->connect();
    $sql = "DELETE FROM hatZusatzstoff WHERE ProduktFremdschluessel=?";
    if($this->run_prepared($sql,"i", array($productID))){
      $this->stmtclose_disconnect();
      return true;
      }
      $this->stmtclose_disconnect();
  }

  public function delete_all_size_price_relations_from_product($productID){
    //Löscht alle einem Produkt zugehörigen einträge in ProdGrPr
    $this->connect();
    $sql = "DELETE FROM ProdGrPr WHERE ProduktFremdschluessel=?";
    if($this->run_prepared($sql,"i", array($productID))){
      $this->stmtclose_disconnect();
      return true;
      }
      $this->stmtclose_disconnect();
  }

  public function add_product($katfremdid, $name, $beschr, $verfuegbar){
    // Fügt ein Neues Produkt mit Eintrag in Alle Tabellen hinzu
    $this->connect();
    var_dump($katfremdid);
    var_dump($name);
    var_dump($beschr);
    var_dump($verfuegbar);
    $sql = "INSERT INTO Produkt (KategorieFremdSchluessel, name, beschreibung, verfuegbar) VALUES (?, ?, ?, ?)";
    if($this->run_prepared($sql,"issi", array($katfremdid, $name, $beschr, $verfuegbar))){
      $this->stmtclose_disconnect();
      return true;
      }
    $this->stmtclose_disconnect();
  }

  public function get_productID_byName($Name){
    $this->connect();
    $sql = "SELECT ProduktID FROM produkt WHERE name=?";
    if($this->run_prepared($sql,"s", array($Name))){
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

  public function get_ingridienceID_byName($Name){
    $this->connect();
    $sql = "SELECT ZusatzzutatID FROM zusatzzutat WHERE name=?";
    if($this->run_prepared($sql,"s", array($Name))){
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

  public function add_size($name, $wert, $einheit){
    // Fügt eine Größe hinzu
    $this->connect();
    $sql = "INSERT INTO Groesse (name, wert, einheit) VALUES (?, ?, ?)";
    if($this->run_prepared($sql,"sis", array($name, $wert, $einheit))){
      $this->stmtclose_disconnect();
      return true;
      }
    $this->stmtclose_disconnect();
  }

  public function delete_size($sizeID){
    // Löscht eine Größe und alle Zugehörigkeiten
    $this->connect();
    $sql = "DELETE FROM Groesse WHERE GroesseID=?";
    if($this->run_prepared($sql,"i", array($sizeID))){
      $this->stmtclose_disconnect();
      $this->delete_size_price_relation_by_size($sizeID);
      $this->delete_prod_size_price_by_size($sizeID);
      return true;
      }
      $this->stmtclose_disconnect();
  }

  public function delete_size_price_relation_by_size($sizeID){
    //Löscht alle einer Groesse zugehörigen einträge in hatZusatzstoff
    $this->connect();
    $sql = "DELETE FROM hatZusatzstoff WHERE GroesseFremdschluessel=?";
    if($this->run_prepared($sql,"i", array($sizeID))){
      $this->stmtclose_disconnect();
      return true;
      }
      $this->stmtclose_disconnect();
  }

  public function delete_prod_size_price_by_size($sizeID){
    //Löscht alle einer Größe zugehörigen Eintäge in ProdGrPr
    $this->connect();
    $sql = "DELETE FROM ProdGrPr WHERE GroesseFremdschluessel=?";
    if($this->run_prepared($sql,"i", array($sizeID))){
      $this->stmtclose_disconnect();
      return true;
      }
      $this->stmtclose_disconnect();
  }


  //-------------Helpers----------------------------------------------------------

  public function add_additive($name, $beschreibung){
    // Fügt einen neuen Zusatzstoff hinzu
    $this->connect();
    $sql = "INSERT INTO Zusatzstoff (name,beschreibung) VALUES (?, ?)";
    if($this->run_prepared($sql,"ss", array($name, $beschreibung))){
      $this->stmtclose_disconnect();
      return true;
      }
    $this->stmtclose_disconnect();
  }

  public function delete_additive($additiveID){
    // Löscht zusatzstoff und alle Zugehörigkeiten
    $this->connect();
    $sql = "DELETE FROM Zusatzstoff WHERE ZusatzstoffID=?";
    if($this->run_prepared($sql,"i", array($additiveID))){
      $this->stmtclose_disconnect();
      $this->delete_all_relations_from_additive($additiveID);
      return true;
      }
    $this->stmtclose_disconnect();
  }

  public function delete_all_relations_from_additive($additiveID){
    //Löscht alle einem Zusatzstoff zugehörigen einträge in hatZusatzstoff
    $this->connect();
    $sql = "DELETE FROM hatZusatzstoff WHERE ZusatzstoffFremdschluessel=?";
    if($this->run_prepared($sql,"i", array($additiveID))){
      $this->stmtclose_disconnect();
      return true;
      }
      $this->stmtclose_disconnect();
  }

  public function add_ingredience($name) {
    // Fügt Zusatzzutat hinzu
    $this->connect();
    $sql = "INSERT INTO `zusatzzutat` (`name`) VALUES (?)";

    if($this->run_prepared($sql,"s", array($name))){
      $this->stmtclose_disconnect();
      return true;
      }
    $this->stmtclose_disconnect();
  }

  public function delete_ingredience($ingredienceID) {
    // Löscht Zusatzzutat und alle Zugehörigkeiten
    $this->connect();
    $sql = "DELETE FROM Zusatzzutat WHERE ZusatzzutatID=?";
    if($this->run_prepared($sql,"i", array($ingredienceID))){
      $this->stmtclose_disconnect();
      $this->delete_size_price_relation_by_ingredience($ingredienceID);
      $this->delete_belongings_to_product_by_ingredience($ingredienceID);
      return true;
      }
      $this->stmtclose_disconnect();
  }

  public function delete_size_price_relation_by_ingredience($ingredienceID){
    //Löscht alle einer Zusatzzutat zugegörigen relationen in ZusatzzutatGrPr
    $this->connect();
    $sql = "DELETE FROM ZusatzzutatGrPr WHERE ZusatzzutatFremdschluessel=?";
    if($this->run_prepared($sql,"i", array($ingredienceID))){
      $this->stmtclose_disconnect();
      return true;
      }
      $this->stmtclose_disconnect();
  }

  public function delete_belongings_to_product_by_ingredience($ingredienceID){
    //Löscht alle einer Zusatzzutat zugegörigen relationen in ZusatzzutatGrPr
    $this->connect();
    $sql = "DELETE FROM hatZusatzzutat WHERE ZusatzzutatFremdschluessel=?";
    if($this->run_prepared($sql,"i", array($ingredienceID))){
      $this->stmtclose_disconnect();
      return true;
      }
      $this->stmtclose_disconnect();
  }

  public function add_additive_to_product($productID, $additiveID) {
    // Eintrag in Tabelle "hatZusatzstoff"
    $this->connect();
    $sql = "INSERT INTO hatZusatzstoff (ProduktFremdschluessel, ZusatzstoffFremdschluessel) VALUES (?,?)";
    if ($this->run_prepared($sql, "ii", array($productID, $additiveID))) {
      $this->stmtclose_disconnect();
      return true;
    }
    $this->stmtclose_disconnect();
  }

  //-----------------Funtionen Zum herstellen und löschen von Relationen-----------------------------------------

  public function delete_additive_from_product($conditionattr, $conditionvalue){
    // Löscht eintrag aus "hatZusatzstoff"
    $this->connect();
    $sql = "DELETE FROM hatZusatzstoff WHERE ?=?";
    if ($this->run_prepared($sql, "si", array($conditionattr, $conditionvalue))) {
      $this->stmtclose_disconnect();
      return true;
    }
    $this->stmtclose_disconnect();
  }

  public function add_ingredience_to_product($productID, $ingredienceID){
    // Eintrag in Tabelle "hatZusatzzutat"
    $this->connect();
    $sql = "INSERT INTO hatZusatzzutat (ProduktFremdschluessel, ZusatzzutatFremdschluessel) VALUES (?,?)";
    if ($this->run_prepared($sql, "ii", array($productID, $ingredienceID))) {
      $this->stmtclose_disconnect();
      return true;
    }
    $this->stmtclose_disconnect();
  }

  public function delete_ingredience_from_product($conditionattr, $conditionvalue){
    // Löscht Eintrag aus Tabelle "hatZusatzzutat"
    $this->connect();
    $sql = "DELETE FROM hatZusatzzusatz WHERE ?=?";
    if ($this->run_prepared($sql, "si", array($conditionattr, $conditionvalue))) {
      $this->stmtclose_disconnect();
      return true;
    }
    $this->stmtclose_disconnect();
  }

  public function add_ingredience_size_price($ingredienceID, $sizeID, $price){
    // Eintrag in Tabelle "ZusatzzutatGrPr"
    $this->connect();
    $sql = "INSERT INTO ZusatzzutatGrPr (ZusatzzutatFremdschluessel, GroesseFremdschluessel, preis) VALUES (?,?,?)";
    if ($this->run_prepared($sql, "iii", array($ingredienceID, $sizeID, $price))) {
      $this->stmtclose_disconnect();
      return true;
    }
    $this->stmtclose_disconnect();
  }

  public function delete_ingredience_size_price($conditionattr, $conditionvalue){
    // löscht Eintrag aus "ZusatzzutatGrPr", param: nur ids der fremdschluessel
    $this->connect();
    $sql = "DELETE FROM ZusatzzutatGrPr WHERE ?=?";
    if ($this->run_prepared($sql, "si", array($conditionattr, $conditionvalue))) {
      $this->stmtclose_disconnect();
      return true;
    }
    $this->stmtclose_disconnect();
  }

  public function add_productsize_price($productID, $sizeID, $price){
    // Eintrag in Tabelle "ProdGrPr"
    $this->connect();
    $sql = "INSERT INTO ProdGrPr (ProduktFremdschluessel, GroesseFremdschluessel, preis) VALUES (?,?,?)";
    if ($this->run_prepared($sql, "iii", array($productID, $sizeID, $price))) {
      $this->stmtclose_disconnect();
      return true;
    }
    $this->stmtclose_disconnect();
  }

  public function delete_productsize_price($conditionattr, $conditionvalue){
    // Löscht Eintrag in Tabelle "ProdGrPr", param: nur ids der fremdschluessel
    $this->connect();
    $sql = "DELETE FROM ProdGrPr WHERE ?=?";
    if ($this->run_prepared($sql, "si", array($conditionattr, $conditionvalue))) {
      $this->stmtclose_disconnect();
      return true;
    }
    $this->stmtclose_disconnect();
  }

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
  }

//-----------------Funktionen zum ändern von einzelnen Werten in Datensätzen-----------------------------------------------------------------------

  private function get_product_by_ID($productID)
  {
    $this->connect();
    $sql = "SELECT * FROM Produkt WHERE ProduktID=?";
    if($this->run_prepared($sql,"i", array($productID))){
      $result = $this->stmt->get_result();
      if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
          $array[$row["ProduktID"]] = $row;
        }
        $this->freeres_stmtclose_disconnect();
        return $array;
      }
    }
    $this->freeres_stmtclose_disconnect();
  }


}

 ?>
