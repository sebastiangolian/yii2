<?php
namespace sebastiangolian\yii2\helpers;

use yii\bootstrap\Dropdown;
use yii\bootstrap\Html;



/**
 * Description of Bootstrap
 *
 * @author Sebastian Golian <sebastiangolian@gmail.com>
 */

class Bootstrap extends Html
{
    /*
     * Generate dropdown component
     * Bootstrap::dropdown('Lista ', 
     * [
     *      '<li class="dropdown-header">Dropdown header</li>',
     *      ['label' => 'DropdownA', 'url' => '/'],
     *      '<li role="separator" class="divider"></li>',
     *      ['label' => 'DropdownB', 'url' => '#'],
     * ]);
     * @param string $content Button label
     * @param array $items List of menu items in the dropdown
     * @param string $id
     */
    public static function dropdown($content,$items = [],$id = 'dropdown1')
    {
        echo static::beginTag('div',['class'=>'dropdown']);
            echo static::button($content.' '.static::tag('span','',['class'=>'caret']),[
                'class'=>'btn btn-default dropdown-toggle','type'=>'button','id'=>$id,'data-toggle'=>'dropdown','aria-haspopup'=>'true', 'aria-expanded'=>'true'
            ]);
            echo Dropdown::widget(['items'=>$items,'options'=>['aria-labelledby'=>$id]]);
        echo static::endTag('div');
    }
}
