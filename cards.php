<?php
include("FileManager.php");
include("options.php");
include('outfit.php');
if(isset($_GET['lang']))
    $val=$_GET['lang'];
else
    $val='en-US';
$manager = new FileManager();
$list = $manager->readFile($listPath, $val);
$cards = $manager->readFile($cardPath, $val);
?>
<div class="card-info">

</div>
<div class="cards-container">
    <div class="container">
    <div class="row">
    <?php
        $i=0;
        foreach($cards as $value)
        {
            if($i%4==0)
                print "<div class='row'>";
            ?>
            <div class=" col-sm-3 text-center">
                <figure>
            <figcaption>
                <img class="" alt="<?php print $value->name; ?>" height="273" width="217" src="<?php print $value->variations[0]->art->thumbnailImage;?>">
            </figcaption>
            <p>
                <span><?php print $value->name; ?></span></p><p><?php print $value->info; ?></p>
            </div>
            <figure>
            <?php
            if($i%4==3)
                print "</div>";
            $i++;
        }
    ?>
    </div>
</div>
</div>
<?php
?>