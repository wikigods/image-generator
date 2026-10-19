<?php

namespace WikiGods\ImageGenerator\Categories;

class AgricultureCategory extends CategoryDefinition
{
    protected $name = 'agriculture';

    protected $variants = ['plant', 'tree', 'seed', 'tractor', 'wheat', 'watering_can'];

    protected $palette = [[239, 247, 230], [88, 151, 66], [52, 82, 39], [205, 224, 186]];

}
