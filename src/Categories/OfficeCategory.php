<?php

namespace WikiGods\ImageGenerator\Categories;

class OfficeCategory extends CategoryDefinition
{
    protected $name = 'office';

    protected $variants = ['paper', 'pen', 'notebook', 'folder', 'pencil', 'stapler'];

    protected $palette = [[238, 244, 249], [68, 127, 180], [42, 60, 76], [205, 218, 231]];

}
