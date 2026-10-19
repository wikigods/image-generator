<?php

namespace WikiGods\ImageGenerator\Categories;

class BeverageCategory extends CategoryDefinition
{
    protected $name = 'beverage';

    protected $variants = ['bottle', 'can', 'coffee', 'juice', 'water', 'cup'];

    protected $palette = [[231, 246, 250], [45, 151, 190], [37, 70, 91], [190, 222, 231]];

}
