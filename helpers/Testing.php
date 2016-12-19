<?php
namespace sebastiangolian\yii2\helpers;

use Exception;
use Yii;
use yii\helpers\Html;
use yii\helpers\VarDumper;
class Testing
{
    /**
     * Displays a variable and validation if is object Model class
     * Testing::vd(array[0,1,2,3]);
     * Testing::vd(Client::find()->one());
     * @param mixed $var variable by dumping
     * @return string
     */
    public static function vd($var)
    {
        echo Html::beginTag('pre',['style'=>'margin-top:50px']);
        if(is_object($var))
        {
            if(in_array("yii\\base\\Model", class_parents($var)))
            {
                $var->validate();
                echo Html::tag('p','Model validation:',['style'=>'font-style:italic; font-weight:bold;']);
                VarDumper::dump($var->getErrors());
            }
        }
        
        echo Html::tag('p','Variable value:',['style'=>'font-style:italic;margin-top:10px;font-weight:bold;']);
        VarDumper::dump($var);
        echo Html::endTag('pre');
    }
    
    /**
     * Add variable value to logger file.
     * 
     * Add to config file if not exist appPath allias:
     * 'aliases' => ['appPath' => dirname(dirname(dirname(__DIR__)))]
     * 
     * Testing::logger(array[0,1,2,3]);
     * Testing::logger(Client::find()->one());
     * @param mixed $var variable by logging
     * @return string
     */
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
            throw new Exception('File not exist.');
        }
    }

    /**
     * Generating lorem ipsum text
     * echo Testing::lorem(5);
     * @param int $count
     * @param bool $paragraph
     * @return string
     */
    public static function lorem($count = 1, $paragraph = true)
    {
        $return = "";
        for($i=1;$i<=$count;$i++)
        {
            $line = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. '
                    . 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor '
                    . 'in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, '
                    . 'sunt in culpa qui officia deserunt mollit anim id est laborum.';
            
            if($paragraph){
                $return .= '<p>'.$line.'</p>';
            } else {
                $return .= $line;
            }
        }
        
        return $return;   
        
    }
    
    /**
     * Generating test image
     * echo Testing::image(100, 100);
     * echo Testing::image(100, 100, true);
     * @param int $width
     * @param int $height
     * @param bool $lorem_pixel If image from lorempixel.com
     */
    public static function image($width,$height,$lorem_pixel = false)
    {
        if($lorem_pixel){
            echo Html::img("http://lorempixel.com/{$width}/{$height}/");
        } else{
            echo Html::tag('div',"{$width}x{$height}",['style'=>
                "width:{$width}px; height:{$height}px; background-color:silver; text-align: center; font-size:30px;vertical-align: middle; display: table-cell;"
            ]);
        }
    }
}