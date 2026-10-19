<?php

namespace WikiGods\ImageGenerator\Categories;

class BeautyCategory extends CategoryDefinition
{
    protected $name = 'beauty';

    protected $variants = ['shampoo', 'soap', 'perfume', 'makeup', 'lotion', 'brush'];

    protected $palette = [[250, 237, 245], [205, 103, 153], [86, 49, 68], [231, 204, 219]];

}
