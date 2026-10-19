<?php

namespace WikiGods\ImageGenerator\Categories;

class MedicineCategory extends CategoryDefinition
{
    protected $name = 'medicine';

    protected $variants = ['bottle', 'pills', 'first_aid', 'thermometer', 'syringe', 'stethoscope'];

    protected $palette = [[239, 248, 244], [55, 160, 126], [42, 79, 70], [203, 230, 217]];

}
