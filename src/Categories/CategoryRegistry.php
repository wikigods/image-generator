<?php

namespace WikiGods\ImageGenerator\Categories;

class CategoryRegistry
{
    public static function all()
    {
        return [
            new ProductCategory(), new FoodCategory(), new BeverageCategory(), new BookCategory(),
            new ComputerCategory(), new MedicineCategory(), new ConstructionCategory(), new HelmetCategory(),
            new HarnessCategory(), new CarpentryCategory(), new FurnitureCategory(), new ClothingCategory(),
            new CarCategory(), new HotelCategory(), new SportsCategory(), new BeautyCategory(),
            new PetsCategory(), new AgricultureCategory(), new ToysCategory(), new OfficeCategory(),
        ];
    }

    public static function categories()
    {
        $categories = [];
        foreach (self::all() as $category) {
            $categories[] = $category->name();
        }

        return $categories;
    }

    public static function variants($category)
    {
        foreach (self::all() as $definition) {
            if ($definition->name() === strtolower(trim((string) $category))) {
                return $definition->variants();
            }
        }

        return [];
    }

    public static function palette($category)
    {
        foreach (self::all() as $definition) {
            if ($definition->name() === strtolower(trim((string) $category))) {
                return $definition->palette();
            }
        }

        return [];
    }

}
