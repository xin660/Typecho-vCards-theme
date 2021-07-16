<?php

namespace QPlayer;

use Typecho_Widget;

class Config
{
    public static function getConfig()
    {
        return Typecho_Widget::widget('Widget_Options')->plugin('QPlayer2');
    }
}