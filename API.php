<?php
class API
{
    public $link = "https://api.gwentapi.com/v0/cards"; //link to main page of API

    function result_site($url)
    {
        return json_decode(file_get_contents($url));
    }

    function download_img($url)
    {
        $tab = explode('/', $url);
        $end = end($tab);
        $path = "images/".$end;
        if(!is_dir("images"))
            mkdir("images");
        if(!file_exists($path)) {
            $img = file_get_contents($url);
            file_put_contents($path, $img);
        }
        return $path;
    }

    function get_count()
    {
        return $this->result_site($this->link)->count;
    }

    function get_cards_listchange(&$allcards=[], &$cardinfos=[], $lang='en-US', $limit=null)
    {
        if($limit==null)
            $limit=$this->get_count();
        $question = $this->result_site($this->link."?limit=".$limit."&lang=".$lang);
        $cardlist = $question -> results;
        foreach($cardlist as $key=>$value)
        {
            if(!isset($allcards[$key]))
                $allcards[$key]=null;
            elseif($allcards[$key]==$value)
                continue;
            $allcards[$key]=$value;
            // card position got changed, so
            //change all info about it!
            $card_info = $this->result_site($value->href."?lang=".$lang);
            foreach($card_info->variations as $kee=>$vari)
            {
                $card_variation = $this->result_site($vari->href."?lang=".$lang);
                print("<pre>");
                /*print_r($card_info->variations[$kee]);
                print("</pre><br>");
                */
                $card_info->variations[$kee] = $card_variation;
                /*print("<pre>");
                print_r($card_info->variations[$kee]);
                print("</pre><br>");*/
                //print_r($card_info->variations[$kee]->art->thumbnailImage);
                $card_info->variations[$kee]->art->thumbnailImage=$this->download_img($card_info->variations[$kee]->art->thumbnailImage);
            }
            $cardinfos[$key]=$card_info;
        }
    }
    function get_cards(&$allcards=[], &$cardinfos=[], $lang='en-US', $limit=null)
    {
        if($limit==null)
            $limit=$this->get_count();
        $question = $this->result_site($this->link."?limit=".$limit."&lang=".$lang);
        $cardlist = $question -> results;
        foreach($cardlist as $key=>$value)
        {
            if(!isset($allcards[$key]))
                $allcards[$key]=null;
            elseif($allcards[$key]==$value)
                continue;
            $allcards[$key]=$value;
            // card position got changed, so
            //change all info about it!
            $card_info = $this->result_site($value->href."?lang=".$lang);
            foreach($card_info->variations as $kee=>$vari)
            {
                $card_variation = $this->result_site($vari->href."?lang=".$lang);
                print("<pre>");
                /*print_r($card_info->variations[$kee]);
                print("</pre><br>");
                */
                $card_info->variations[$kee] = $card_variation;
                /*print("<pre>");
                print_r($card_info->variations[$kee]);
                print("</pre><br>");*/
                //print_r($card_info->variations[$kee]->art->thumbnailImage);
                $card_info->variations[$kee]->art->thumbnailImage=$this->download_img($card_info->variations[$kee]->art->thumbnailImage);
            }
            $cardinfos[$key]=$card_info;
        }
    }


}
?>
