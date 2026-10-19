<?php

namespace WikiGods\ImageGenerator\Categories;

class CarCategory extends CategoryDefinition
{
    protected $name = 'car';

    protected $variants = ['sedan', 'suv', 'truck', 'motorcycle', 'bicycle', 'bus'];

    protected $palette = [[231, 246, 244], [36, 157, 139], [37, 55, 68], [192, 222, 216]];

}
