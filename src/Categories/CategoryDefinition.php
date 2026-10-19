<?php

namespace WikiGods\ImageGenerator\Categories;

abstract class CategoryDefinition
{
    protected $name;

    protected $variants = [];

    protected $palette = [];

    public function name()
    {
        return $this->name;
    }

    public function variants()
    {
        return $this->variants;
    }

    public function palette()
    {
        return $this->palette;
    }

}
