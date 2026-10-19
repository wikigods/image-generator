<?php

namespace WikiGods\ImageGenerator\Categories;

class CarpentryCategory extends CategoryDefinition
{
    protected $name = 'carpentry';

    protected $variants = ['hammer', 'saw', 'drill', 'wrench', 'wood', 'screwdriver'];

    protected $palette = [[248, 241, 229], [161, 111, 64], [76, 54, 38], [225, 211, 191]];

}
