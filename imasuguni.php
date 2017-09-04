<!DOCTYPE html>
<html>
<head>
    <title>Cards!</title>
    <meta charset="UTF-8">
</head>
<body>
<?php
ini_set('display_errors', 1);
class API
{
    public $link = "https://api.gwentapi.com/v0/cards"; //link to main mage of API

    function result_site($url)
    {
        return json_decode(file_get_contents($url));
    }


    function get_count()
    {
        return $this->result_site($this->link)->count;
    }
    //get cardlist, if cardlist got changed, change all the info about card.
    function get_cards($allcards=[], $cardinfos=[],$lang='en-US',$last=0, $limit=10)
    {
        $full = $this->link."?limit=".$limit."&lang=".$lang."&offset=".$last;
        $question = $this->result_site($full);
        $cardlist = $question -> results;
        foreach($cardlist as $key=>$value)
        {
            if(!isset($allcards[$key+$last]))
                $allcards[$key+$last]=null;
            elseif($allcards[$key+$last]==$value)
                continue;
            $allcards[$key+$last]=$value;
            //todo:log that card got changed!
            //change everything about it!
            $card_info = $this->result_site($value->href."?lang=".$lang);
            foreach($card_info->variations as $key=>$vari)
            {
                $card_variation = $this->result_site($vari->href."?lang=".$lang);
                print("<pre>");
                $card_info->variations[$key] = $card_variation;
                print_r($card_info);
                print("</pre>");
            }
        }
        return $allcards;
    }
}
$api = new API;

$cardlist=$api->get_cards();
//print_r($cardlist);
foreach($cardlist as $key=>$value)
{
    //getting basic card info
    $card_info = $api->result_site($value->href);

    foreach($card_info->variations as $vari)
    {
        $card_variation=$api->result_site($vari->href);
        print("<pre>");
        print_r($card_variation);
        //print_r($vari);
        print("</pre>");
    }
    print("<pre>");
    //print_r($item->variations);
    print("</pre>");
}
/*foreach($items as $key=>$val)
{
    print($key." ".$val->name." ".$val->href."<br>");
    //print_r($api->result_site($val->href));
}*/
/*foreach($k as $id=>$items)
{
    print($id." ".$items."<br>");
}*/
/*for($i=0; $i<$count; $i++)
{
    print_r($api->result_site($items[$i]->href));
}*/
//$t = $api->result_site($items[0]->href);
//print_r($t);
?>
</body>
</html>
