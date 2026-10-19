<?php

namespace WikiGods\ImageGenerator\Categories;

class HarnessCategory extends CategoryDefinition
{
    protected $name = 'harness';

    protected $variants = ['full_body', 'safety_belt', 'lanyard', 'carabiner'];

    protected $palette = [[249, 237, 234], [205, 83, 66], [84, 51, 47], [229, 202, 194]];

}
