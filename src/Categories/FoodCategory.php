<?php

namespace WikiGods\ImageGenerator\Categories;

class FoodCategory extends CategoryDefinition
{
    protected $name = 'food';

    protected $variants = ['apple', 'banana', 'bread', 'cheese', 'carrot', 'fish'];

    protected $palette = [[246, 248, 229], [83, 160, 88], [52, 93, 56], [214, 228, 196]];

}
