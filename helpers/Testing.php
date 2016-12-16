<?php
namespace sebastiangolian\yii2\helpers;

use Exception;
use Yii;
use yii\helpers\VarDumper;
class Testing
{
    public static function vd($var)
    {
        echo '<pre style="margin-top:50px;">';
        //wyrzucenie walidacji obiektu jeśli jest to model
        if(is_object($var))
        {
            if(in_array("yii\\base\\Model", class_parents($var)))
            {
                $var->validate();
                echo '<p><u>Walidacja modelu:</u></p>';
                VarDumper::dump($var->getErrors());
            }
        }
        
        echo '<p><u>Wartość zmiennej:</u></p>';
        VarDumper::dump($var);
        echo '</pre>';
    }
    
    public static function logger($var)
    {
        $var = "---------------------------------- ".date('H:i:s')." ---------------------------------\n".VarDumper::dumpAsString($var). "\n";
        $file_path = Yii::getAlias('@appPath').'/logger.txt';
        if (is_file($file_path))
        {
            $currentData = file_get_contents($file_path);
            $var = $var.$currentData;
            file_put_contents($file_path,$var);
        }
        else 
        {
            throw new Exception('Podany plik nie istnieje');
        }
    }

    //generarowanie lorem ipsum
    public static function lorem($count = 1, $paragraph = true)
    {
        $return = "";
        for($i=1;$i<=$count;$i++)
        {
            if($paragraph) $return .='<p>';
            $return .= 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
            if($paragraph) $return .='</p>';
        }
        
        return $return;
    }
    
    //generowanie losowego zdjęcia
    public static function image($width,$height,$lorem_pixel = false)
    {
        if($lorem_pixel)
            echo "<img src='http://lorempixel.com/{$width}/{$height}/' />";
        else
            echo "<div style='width:{$width}px;height:{$height}px;background-color:silver; text-align: center; font-size:30px;vertical-align: middle; display: table-cell;'>{$width}x{$height}</div>";
    }
}