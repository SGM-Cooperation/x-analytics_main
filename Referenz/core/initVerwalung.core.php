<?php
if(isset($productVW)){
  if (!($productVW instanceof Produktverwaltung)){
    unset($productVW);
    $productVW = new Produktverwaltung();
  }
}else{
  $productVW = new Produktverwaltung();
}

if(isset($auftragVW)){
  if (!($auftragVW instanceof Auftragsverwaltung)){
    unset($auftragVW);
    $auftragVW = new Auftragsverwaltung();
  }
}else {
    $auftragVW = new Auftragsverwaltung();
  }

if(isset($userVW)){
  if (!($userVW instanceof Nutzerverwaltung)){
    unset($userVW);
    $userVW = new Nutzerverwaltung();
  }
}else {
  $userVW = new Nutzerverwaltung();
}

if(isset($cart)){
  if (!($cart instanceof Warenkorb)){
    unset($cart);
    $cart = new Warenkorb();
  }
}else {
  $cart = new Warenkorb();
}

?>
