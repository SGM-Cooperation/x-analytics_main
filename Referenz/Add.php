<!DOCTYPE html>
<html>
<?php
require "core\autoload.core.php";
require "core\initVerwalung.core.php";


session_start();
function redirect($url, $statusCode = 303)
{

    header('Location: ' . $url, true, $statusCode);
    die();
}
//Past initialisation
$Path = $_SERVER['SERVER_NAME'];
if (isset($_SERVER[HTTPS])) {

} else {
    $Path = "http://$Path";
}
$Path = "$Path/login";
function add_ingrediencePrice($ingredience, $size, $price){
    global $Path;
    global $productVW;
    $productVW->add_ingredience_size_price($ingredience, $size, $price);
    $_SESSION['add'] = NULL;
    redirect($Path);
}
function add_product($Kategorie, $Name, $Beschreibung, $Size, $Additive, $ingredienceID)
{

    global $Path;
    global $productVW;
    $productVW->add_product($Kategorie, $Name, $Beschreibung, true);
    $productID = $productVW->get_productID_byName($Name);
    foreach ($Size as $size) {
        $productVW->add_productsize_price($productID[0]['ProduktID'], $size[0], $size[1]);
    }
    foreach ($Additive as $key) {
        $productVW->add_additive_to_product($productID[0]['ProduktID'], $key);
    }
    foreach ($ingredienceID as $key) {
        $productVW->add_ingredience_to_product($productID, $key);
    }
    $_SESSION['add'] = NULL;
    redirect($Path);
}

function add_size($name, $wert, $einheit)
{
    global $Path;
    global $productVW;
    $productVW->add_size($name, $wert, $einheit);
    $_SESSION['add'] = NULL;
    redirect($Path);
}

function add_extra($Name, $productID, $sizeID, $price)
{
    global $Path;
    global $productVW;
    $productVW->add_ingredience($Name);
    $productVW->add_ingredience_to_product($productID, $productVW->get_ingridienceID_byName($Name));
    $productVW->add_ingredience_size_price($productVW->get_ingridienceID_byName($Name), $sizeID, $price);
    $_SESSION['add'] = NULL;
    redirect($Path);
}

function add_zusatz($name, $beschreibung = "")
{
    global $Path;
    global $productVW;
    $productVW->add_additive($name, $beschreibung);
    $_SESSION['add'] = NULL;
    redirect($Path);
}

function add_kategorie($Name, $description = "")
{
    global $Path;
    global $productVW;
    $productVW->add_category($Name, $description);
    $_SESSION['add'] = NULL;
    redirect($Path);
}



if ($_SESSION['login'] && ($_SESSION['add'] == NULL)) {
    $_SESSION['add'] = $_POST['add'];
}
# Auswertung der Hinzufügung
if (isset($_POST['madeChange'])){
    switch ($_SESSION['add']) {
        case 'ingrediencePrice':
            add_ingrediencePrice($_POST['zusatz_name'], $_POST['product_size'], $_POST['product_preis'] );
        case 'kategorie':
            add_kategorie($_POST['kategorie_name'], $_POST['categorie_description']);
            break;
        case 'product':
            $size = array();
            for ($i = 0; $i < count($_POST['product_size']); $i++) {
                if ($_POST['product_size'][$i] != "00") {
                    #$count = count($size) + 1;
                    $size[$i] = array($_POST['product_size'][$i], $_POST['product_preice_size'][$i]);
                }
            }
            add_product($_POST['product_kategorie'], $_POST['product_name'], $_POST['product_descripion'],  $size, $_POST['additive'], $_POST['ingredience']);
            break;
            case'extra':
                add_extra($_POST['extra_name'], $_POST['extra_product'], $_POST['product_size'], $_POST['extra_preis']);
                break;
        case 'zusatz':
            add_zusatz($_POST['zusatz_name'], $_POST['zusatz_description']);
            break;
        case 'size':
            add_size($_POST['size_name'], $_POST['size_size'], $_POST['size_einheit']);
            break;

        default:
            // code...
            break;
    }}


if ($_SESSION['login']) {
    ?>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Milano Online Shop</title>
        <meta property="og:image" content="assets/img/Title.png?h=ed098f1e3bcf24f3d2d21c542f44e3f5">
        <meta property="og:type" content="website">
        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/styles.min.css?h=892d113da53cd05a8e3462ee32979f6e">
    </head>

    <body>
    <header>
        <h1 class="display-3 text-center">Hinzufügen</h1>

    </header>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input class="hidden" type="checkbox" name="madeChange" value="true" checked hidden>
        <?php

        if ($_SESSION['login'] == true) {
            if ($_SESSION['add'] == "product") {
                ?>
                <section>
                    <div class="table-responsive">
                        <table class="table table-striped w-auto">
                            <thead>
                            <tr></tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td style="width:20%;">Produktinformation</td>
                                <td style="width:20%;">Produktbeschreibung</td>
                                <td style="width:20%;">Kategorie</td>
                                <td style="width:20%;">Größe</td>
                                <td style="width:20%;">Zusatzstoffe</td>

                            </tr>
                            <tr>
                                <td style="width:20%;">
                                    <input style="width:100%;" type="text" class="bg-white border rounded shadow-sm"
                                           placeholder="Name" name="product_name"/></td>
                                </td>
                                <td style="width:20%;">
                                    <input style="width:100%;" type="text" class="bg-white border rounded shadow-sm"
                                           placeholder="Beschreibung" name="product_descripion"/></td>
                                </td>
                                <td style="width:20%;">

                                    <select name="product_kategorie" style="width:100%;">
                                        <optgroup label="Kategorie">
                                            <option class="bg-white border rounded shadow-sm" value="00" selected="">
                                                **Bitte wählen**
                                            </option>
                                            <?php foreach ($productVW->all_categories() as $key): ?>
                                                <option class="bg-white border rounded shadow-sm"
                                                        value="<?= $key['KategorieID'] ?>"><?= $key['name'] ?></option>
                                            <?php endforeach; ?>
                                        </optgroup>
                                    </select>
                                </td>
                                <td style="width:20%;">
                                    <?php
                                    for ($i = 0; $i < 5; $i++) { ?>
                                        <select name="product_size[<?php echo $i ?>]" style="width:100%;">
                                            <optgroup label="Size" style="width:100%;">
                                                <option style="width:100%;" class="bg-white border rounded shadow-sm" value="00" selected="">
                                                    **Bitte wählen**
                                                </option>
                                                <?php foreach ($productVW->all_sizes() as $key): ?>
                                                    <option style="width:100%;" class="bg-white border rounded shadow-sm" value="<?= $key['GroesseID'] ?>">
                                                        <?= $key['name'] ?> <?= $key['wert'] ?> <?= $key['einheit'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </optgroup>
                                        </select>
                                        <input style="width:50%;" class="bg-white border rounded shadow-sm"
                                               id="product_preice_size[<?php echo $i ?>]" type="number"
                                               name="product_preice_size[<?php echo $i ?>]" placeholder="5.00"
                                               step="0.01" />
                                        <lable for="product_preice_size[<?php echo $i ?>]">€</lable>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td style="width: 20%">
                                    <div style="height:50%;width:100%;border:1px solid #ccc;overflow:auto;">
                                        <?php foreach ($productVW->all_additives() as $key): ?>
                                            <input type="checkbox" name="additive[]"
                                                   id="id<?php echo $key['ZusatzstoffID'] ?>"
                                                   value="<?php echo $key['ZusatzstoffID'] ?>"><label
                                                   for="#id<?php echo $key['ZusatzstoffID'] ?>"><?php echo $key['name'] ?></label>
                                        <?php endforeach; ?>
                                    </div>
                                </td>
                                <td style="width: 20%">
                                    ingredience
                                    <div style="height:50%;width:100%;border:1px solid #ccc;overflow:auto;">
                                        <?php foreach ($productVW->all_ingrediences() as $key): ?>
                                            <input type="checkbox" name="ingredience[]"
                                                   id="id<?php echo $key['ZusatzzutatID'] ?>"
                                                   value="<?php echo $key['ZusatzzutatID'] ?>"><label
                                                    for="#id<?php echo $key['ZusatzzutatID'] ?>"><?php echo $key['name'] ?></label>
                                        <?php endforeach; ?>
                                    </div>
                                </td>

                            </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            <?php } elseif ($_SESSION['add'] == "size") { ?>
                <section>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Größe</th>
                                <th>Einheit</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <input type="text" class="bg-white border rounded shadow-sm" placeholder="Normal"
                                           name="size_name"/><br>
                                </td>
                                <td>
                                    <input type="number" class="bg-white border rounded shadow-sm" placeholder="28.00"
                                           name="size_size"/><br><label>Größe</label>
                                </td>
                                <td>
                                    <input type="text" class="bg-white border rounded shadow-sm" placeholder="cm"
                                           name="size_einheit"/><br><label>Einheit</label>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            <?php } elseif ($_SESSION['add'] == "kategorie") {
                ?>
                <section>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Beschreibung</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr></tr>
                            <tr>
                                <td>
                                    <input type="text" id="kategorie_name" class="bg-white border rounded shadow-sm"
                                           placeholder="Name" name="kategorie_name"/>

                                </td>
                                <td>
                                    <input type="text" id="categorie_description"
                                           class="bg-white border rounded shadow-sm" placeholder="Beschreibung"
                                           name="categorie_description"/>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            <?php } elseif ($_SESSION['add'] == "extra") {
                ?>
                <section>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <!--  $Name, $productID, $sizeID, $price -->
                                <th>Name</th>
                                <th>Product</th>
                                <th>Größe</th>
                                <th>Preis</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <input type="text" class="bg-white border rounded shadow-sm" placeholder="Name"
                                           name="extra_name"/><br>
                                </td>
                                <td>
                                    <select name="extra_product">
                                        <optgroup label="Produkt">
                                            <option value="00" selected="">**Bitte wählen**</option>
                                            <?php foreach ($productVW->all_products() as $key):
                                                ?>
                                                <option value="<?php echo $key['ProduktID']; ?>"><?php echo $key['name']; ?><?php var_dump($key['ProduktID']); ?></option>

                                        </optgroup>
                                    </select>
                                    <?php endforeach; ?>
                                </td>
                                <td style="width:20%;">
                                    <select name="product_size" style="width:100%;">
                                        <optgroup label="Kategorie" style="width:100%;">
                                            <option style="width:100%;" class="bg-white border rounded shadow-sm"
                                                    value="00" selected="">**Bitte wählen**
                                            </option>
                                            <?php foreach ($productVW->all_sizes() as $key): ?>
                                                <option style="width:100%;" class="bg-white border rounded shadow-sm"
                                                        value="<?= $key['GroesseID'] ?>"><?= $key['name'] ?> <?= $key['wert'] ?> <?= $key['einheit'] ?></option>
                                            <?php endforeach; ?>
                                        </optgroup>
                                    </select>

                                </td>
                                <td>
                                    <input type="number" style="width:80%;" class="bg-white border rounded shadow-sm"
                                           placeholder="5.00" name="extra_preis" value="00" step="0.01"/><label>€</label>
                                </td>
                                <td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            <?php } elseif ($_SESSION['add'] == "zusatz") {
               ?>
                <section>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Beschreibung</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr></tr>
                            <tr>
                                <td><input type="text" class="bg-white border rounded shadow-sm" placeholder="Name"
                                           name="zusatz_name"/><br></td>
                                <td>
                                    <input type="text" id="categorie_description"
                                           class="bg-white border rounded shadow-sm" placeholder="Beschreibung"
                                           name="zusatz_description"/>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            <?php } elseif ($_SESSION['add'] == "IngrediencePrice") {
                ?>
                <section>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Produkt</th>
                                <th>Größe</th>
                                <th>Zutat</th>
                                <th>Preis</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr></tr>
                            <tr>
                                <td>
                                    <?php
                                        if(!isset($_SESSION['product_ING_name'])){?>
                                            <form id="idProductIng">
                                                <select name="product_ING_name" style="width:100%;">
                                                    <optgroup label="Kategorie">
                                                        <option class="bg-white border rounded shadow-sm" value="00" selected="">
                                                            **Bitte wählen**
                                                        </option>
                                                        <?php foreach ($productVW->all_products() as $key): ?>
                                                            <option class="bg-white border rounded shadow-sm"
                                                                    value="<?= $key['name'] ?>"><?= $key['name'] ?></option>
                                                        <?php endforeach; ?>
                                                    </optgroup>
                                                </select>
                                            </form>
                                    <?php  } else{?>
                                            <input type="text" disabled placeholder="<?php echo $_SESSION['product_ING_name']?>">
                                            <?php } ?>
                                </td>
                                <td>
                                    <select name="product_size"
                                            style="width:100%;" <?php if (isset($_SESSION['product_ING_name'])) {
                                        echo "disabled";
                                    } ?>>
                                        <optgroup label="Größe">
                                            <option class="bg-white border rounded shadow-sm" value="00" selected="">
                                                **Bitte wählen**
                                            </option>
                                            <?php foreach ($productVW->sizes_of_product($productVW->get_productID_byName($_SESSION['product_ING_name'])) as $key): ?>
                                                <option class="bg-white border rounded shadow-sm"
                                                        value="<?= $key['GroesseID'] ?>"><?= $key['name'] ?></option>
                                            <?php endforeach; ?>
                                        </optgroup>
                                    </select>
                                </td>
                                <td>
                                    <select name="zusatz_name"
                                            style="width:100%;" <?php if (isset($_SESSION['product_ING_name'])) {
                                        echo "disabled";
                                    } ?>>
                                        <optgroup label="Extra">
                                            <option class="bg-white border rounded shadow-sm" value="00" selected="">
                                                **Bitte wählen**
                                            </option>
                                            <?php foreach ($productVW->ingrediences_of_product($productVW->get_productID_byName($_SESSION['product_ING_name'])) as $key): ?>
                                                <option class="bg-white border rounded shadow-sm"
                                                        value="<?= $key['ZusatzzutatID'] ?>"><?= $key['name'] ?></option>
                                            <?php endforeach; ?>
                                        </optgroup>
                                    </select>
                                </td>
                                <td>
                                    <input type="number"step="0.01"
                                           class="bg-white border rounded shadow-sm" placeholder="0.50"
                                           name="product_preis"/>€

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <button type="submit" form="idProductIng">Produkt wählen</button>
                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            <?php } else {
                redirect("$Path\Dashbord.php");
            }
        } else {
            #redirect("$Path\login");
        } ?>
        <button class="btn btn-primary" type="submit">Hinzufügen</button>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.min.js?h=9a96c264514f52ccce2a2d2c659647a3"></script>
    </body>
    <?php
}
?>
</html>
