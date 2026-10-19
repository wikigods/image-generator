<?php

namespace WikiGods\ImageGenerator\Categories;

class ComputerCategory extends CategoryDefinition
{
    protected $name = 'computer';

    protected $variants = ['laptop', 'desktop', 'monitor', 'ram', 'hard_drive', 'ssd', 'graphics_card', 'motherboard', 'processor', 'keyboard', 'mouse', 'usb_drive'];

    protected $palette = [[235, 241, 247], [68, 119, 180], [39, 54, 72], [201, 215, 231]];
}
