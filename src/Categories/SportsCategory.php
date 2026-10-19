<?php

namespace WikiGods\ImageGenerator\Categories;

class SportsCategory extends CategoryDefinition
{
    protected $name = 'sports';

    protected $variants = ['ball', 'racket', 'weights', 'tent', 'bicycle', 'trophy'];

    protected $palette = [[235, 245, 236], [69, 151, 83], [43, 73, 48], [201, 224, 202]];

}
