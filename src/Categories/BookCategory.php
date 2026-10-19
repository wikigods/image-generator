<?php

namespace WikiGods\ImageGenerator\Categories;

class BookCategory extends CategoryDefinition
{
    protected $name = 'book';

    protected $variants = ['novel', 'notebook', 'textbook', 'magazine', 'comic'];

    protected $palette = [[244, 239, 250], [133, 83, 175], [63, 46, 82], [218, 204, 231]];

}
