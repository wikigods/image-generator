<?php

namespace WikiGods\ImageGenerator\Categories;

class ClothingCategory extends CategoryDefinition
{
    protected $name = 'clothing';

    protected $variants = ['shirt', 'jacket', 'pants', 'shoes', 'dress', 'hat'];

    protected $palette = [[246, 238, 247], [167, 91, 157], [78, 49, 76], [224, 203, 222]];

}
