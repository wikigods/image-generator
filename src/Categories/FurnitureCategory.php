<?php

namespace WikiGods\ImageGenerator\Categories;

class FurnitureCategory extends CategoryDefinition
{
    protected $name = 'furniture';

    protected $variants = ['chair', 'table', 'sofa', 'bed', 'desk', 'cabinet'];

    protected $palette = [[246, 239, 231], [155, 111, 76], [79, 57, 43], [224, 207, 188]];

}
