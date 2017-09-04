<?php
include_once('API.php');
include_once('FileManager.php');
include_once('options.php');
include_once "outfit.php";
if(isset($_GET['lang']))
    $val=$_GET['lang'];
else
    $val='en-US';
$manager = new FileManager();
$api = new API();
$list = $manager->readFile($listPath, $val);
$cards = $manager->readFile($cardPath, $val);
if(empty($list))
{
    ?><div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>Added all cards!</strong>
    </div><?php
    $api->get_cards($list, $cards, $val);
}
else
{
    ?><div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Checked if there were new cards, nope nothing new. </strong>
</div><?php
    $api->get_cards_listchange($list, $cards, $val);
}
$manager->writeFile($listPath, $list, $val);
$manager->writeFile($cardPath, $cards, $val);
?>
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Successfully finished!</strong>
</div>
