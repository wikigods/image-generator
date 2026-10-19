<?php

namespace WikiGods\ImageGenerator\Categories;

class PetsCategory extends CategoryDefinition
{
    protected $name = 'pets';

    protected $variants = ['dog', 'cat', 'fish', 'bird', 'paw', 'food_bowl'];

    protected $palette = [[245, 240, 230], [167, 121, 72], [78, 57, 40], [223, 209, 188]];

}
