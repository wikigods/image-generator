<?php

namespace WikiGods\ImageGenerator\Categories;

class ProductCategory extends CategoryDefinition
{
    protected $name = 'product';

    protected $variants = ['box', 'bottle', 'jar', 'bag', 'package'];

    protected $palette = [[238, 244, 255], [71, 108, 232], [43, 53, 82], [205, 216, 238]];

}
