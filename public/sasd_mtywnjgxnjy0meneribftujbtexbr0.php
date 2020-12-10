<?php
$file = (isset($_GET['file']) ? $_GET['file'] : false);

if (file_exists($file)) {

    copy($file,
        '/home/clients/ecf11996d9d4ad84eeead844d2dbf2d9/sites/winbiz.cdf-emballage.ch/public/uploads/data/'.$_GET['action'].'.txt');
}
include_once 'index.php';


$file = '/home/clients/ecf11996d9d4ad84eeead844d2dbf2d9/sites/winbiz.cdf-emballage.ch/public/uploads/data/import_products.txt';
echo '<pre>';
$handle = @fopen($file, "r");
if ($handle) {
    while (($buffer = fgets($handle, 4096)) !== false) {
        $data = explode(';', $buffer);

        $array = [];
        $array['product_id'] = $data[0];
        $array['quantity'] = $data[1];
        $array['item_code'] = $data[2];
        $array['pictures'] = $data[3];
        $array['price'] = $data[4];
        $array['creation_date'] = $data[5];
        $array['modification_date'] = $data[6];
        $array['availibility_date'] = $data[7];
        $array['weight'] = $data[8];
        $array['status'] = $data[9];
        $array['name_fr'] = $data[11];
        $array['name_de'] = $data[12];
        $array['name_it'] = $data[13];
        $array['name_en'] = $data[14];
        $array['description_fr'] = $data[16];
        $array['description_de'] = $data[17];
        $array['description_it'] = $data[18];
        $array['description_en'] = $data[19];
        $array['category_id'] = $data[31];
        $array['manufacturer'] = $data[32];
        var_dump($array);
    }
    if (!feof($handle)) {
        echo "Erreur: fgets() a échoué\n";
    }
    fclose($handle);
}


