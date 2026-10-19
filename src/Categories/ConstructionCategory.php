<?php

namespace WikiGods\ImageGenerator\Categories;

class ConstructionCategory extends CategoryDefinition
{
    protected $name = 'construction';

    protected $variants = ['helmet', 'vest', 'cone', 'drill', 'toolbox', 'ladder'];

    protected $palette = [[250, 243, 225], [235, 161, 47], [91, 68, 37], [230, 213, 176]];

}
