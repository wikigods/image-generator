<?php

namespace WikiGods\ImageGenerator\Categories;

class HelmetCategory extends CategoryDefinition
{
    protected $name = 'helmet';

    protected $variants = ['hard_hat', 'bike_helmet', 'visor', 'cap'];

    protected $palette = [[250, 243, 225], [235, 161, 47], [91, 68, 37], [230, 213, 176]];

}
