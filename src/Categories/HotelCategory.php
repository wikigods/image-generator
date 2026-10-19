<?php

namespace WikiGods\ImageGenerator\Categories;

class HotelCategory extends CategoryDefinition
{
    protected $name = 'hotel';

    protected $variants = ['hotel', 'house', 'apartment', 'resort', 'cabin', 'office_building'];

    protected $palette = [[250, 239, 222], [215, 139, 63], [91, 67, 53], [231, 211, 184]];

}
