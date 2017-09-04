<?php
class FileManager
{
    function readFile($path, $lang='en-US')
    {
        $path = $path.$lang;
        if(!is_dir("data"))
            mkdir("data");
        if(file_exists($path))
        {
            $objData = file_get_contents($path);
            $data = unserialize($objData);
        }
        else {
            touch($path);
            $data = null;
        }
        return $data;
    }

    function writeFile($path, $data, $lang='en-US')
    {
        $path = $path.$lang;
        if(!file_exists($path))
            touch($path);
        $data = serialize($data);
        file_put_contents($path, $data);
    }
}
?>