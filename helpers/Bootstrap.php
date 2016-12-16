<?php
namespace sebastiangolian\yii2\helpers;

/**
 * Description of Bootstrap
 *
 * @author Sebastian Golian <sebastiangolian@gmail.com>
 */

class Bootstrap {
     /**
     * Generates a bootstrap icon markup.
     *
     * Example:
     *
     * ~~~
     * echo Html::icon('pencil');
     * echo Html::icon('trash', ['style' => 'color: red; font-size: 2em']);
     * echo Html::icon('plus', ['class' => 'text-success']);
     * ~~~
     *
     * @see http://getbootstrap.com/components/#glyphicons
     *
     * @param string $icon the bootstrap icon name without prefix (e.g. 'plus', 'pencil', 'trash')
     * @param array $options HTML attributes / options for the icon container
     * @param string $prefix the css class prefix - defaults to 'glyphicon glyphicon-'
     * @param string $tag the icon container tag (usually 'span' or 'i') - defaults to 'span'
     *
     * @return string
     */
    public static function icon($icon, $options = [], $prefix = 'glyphicon glyphicon-', $tag = 'span')
    {
        $class = isset($options['class']) ? ' ' . $options['class'] : '';
        $options['class'] = $prefix . $icon . $class;
        return static::tag($tag, '', $options);
    }
    //test 222
}
