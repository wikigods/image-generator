<?php

namespace WikiGods\ImageGenerator;

use WikiGods\ImageGenerator\Categories\CategoryRegistry;

class ImageRenderer
{
    public static function drawCategory($image, $width, $height, $category, $variant = null)
    {
        $category = strtolower(trim($category));
        $category = strtr($category, [
            'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 'ü' => 'u', 'ñ' => 'n',
        ]);
        $category = str_replace([' ', '-'], '_', $category);
        $aliases = [
            'abstract' => 'abstract',
            'aleatorio' => 'random',
            'aleatoria' => 'random',
            'any' => 'random',
            'random' => 'random',
            'generic' => 'product',
            'products' => 'product',
            'producto' => 'product',
            'productos' => 'product',
            'item' => 'product',
            'items' => 'product',
            'food' => 'food',
            'foods' => 'food',
            'alimento' => 'food',
            'alimentos' => 'food',
            'grocery' => 'food',
            'groceries' => 'food',
            'abarrote' => 'food',
            'abarrotes' => 'food',
            'produce' => 'food',
            'fruit' => 'food',
            'fruta' => 'food',
            'frutas' => 'food',
            'vegetable' => 'food',
            'vegetables' => 'food',
            'verdura' => 'food',
            'verduras' => 'food',
            'bread' => 'food',
            'pan' => 'food',
            'dairy' => 'food',
            'lacteos' => 'food',
            'carne' => 'food',
            'meat' => 'food',
            'beverages' => 'beverage',
            'drink' => 'beverage',
            'drinks' => 'beverage',
            'bebida' => 'beverage',
            'bebidas' => 'beverage',
            'water' => 'beverage',
            'agua' => 'beverage',
            'coffee' => 'beverage',
            'cafe' => 'beverage',
            'juice' => 'beverage',
            'jugo' => 'beverage',
            'books' => 'book',
            'libro' => 'book',
            'libros' => 'book',
            'education' => 'book',
            'educacion' => 'book',
            'school' => 'book',
            'school_supplies' => 'book',
            'notebook' => 'book',
            'notebooks' => 'book',
            'cuaderno' => 'book',
            'cuadernos' => 'book',
            'technology' => 'computer',
            'tecnologia' => 'computer',
            'computer' => 'computer',
            'computadora' => 'computer',
            'computadoras' => 'computer',
            'laptop' => 'computer',
            'laptops' => 'computer',
            'monitor' => 'computer',
            'phone' => 'computer',
            'telefono' => 'computer',
            'celular' => 'computer',
            'celulares' => 'computer',
            'electronics' => 'computer',
            'electronic' => 'computer',
            'electronica' => 'computer',
            'medicines' => 'medicine',
            'medical' => 'medicine',
            'medicine' => 'medicine',
            'medicina' => 'medicine',
            'medicinas' => 'medicine',
            'medicamento' => 'medicine',
            'medicamentos' => 'medicine',
            'health' => 'medicine',
            'salud' => 'medicine',
            'pharmacy' => 'medicine',
            'farmacia' => 'medicine',
            'pill' => 'medicine',
            'pills' => 'medicine',
            'first_aid' => 'medicine',
            'botiquin' => 'medicine',
            'stethoscope' => 'medicine',
            'estetoscopio' => 'medicine',
            'construccion' => 'construction',
            'ppe' => 'construction',
            'safety' => 'construction',
            'seguridad' => 'construction',
            'industrial_safety' => 'construction',
            'safety_equipment' => 'construction',
            'equipo_de_seguridad' => 'construction',
            'helmet' => 'helmet',
            'hard_hat' => 'helmet',
            'casco' => 'helmet',
            'harness' => 'harness',
            'arnes' => 'harness',
            'carpentry' => 'carpentry',
            'carpinteria' => 'carpentry',
            'woodworking' => 'carpentry',
            'tool' => 'carpentry',
            'tools' => 'carpentry',
            'herramienta' => 'carpentry',
            'herramientas' => 'carpentry',
            'hammer' => 'carpentry',
            'martillo' => 'carpentry',
            'saw' => 'carpentry',
            'sierra' => 'carpentry',
            'wood' => 'carpentry',
            'madera' => 'carpentry',
            'home' => 'furniture',
            'hogar' => 'furniture',
            'furniture' => 'furniture',
            'mueble' => 'furniture',
            'muebles' => 'furniture',
            'chair' => 'furniture',
            'silla' => 'furniture',
            'table' => 'furniture',
            'mesa' => 'furniture',
            'bed' => 'furniture',
            'cama' => 'furniture',
            'clothes' => 'clothing',
            'clothing' => 'clothing',
            'ropa' => 'clothing',
            'fashion' => 'clothing',
            'moda' => 'clothing',
            'shirt' => 'clothing',
            'camisa' => 'clothing',
            'shoes' => 'clothing',
            'zapato' => 'clothing',
            'zapatos' => 'clothing',
            'accessories' => 'clothing',
            'accesorios' => 'clothing',
            'products' => 'product',
            'transport' => 'car',
            'transportation' => 'car',
            'transporte' => 'car',
            'carro' => 'car',
            'carros' => 'car',
            'cars' => 'car',
            'auto' => 'car',
            'autos' => 'car',
            'automobile' => 'car',
            'vehicle' => 'car',
            'vehicles' => 'car',
            'vehiculo' => 'car',
            'bicicleta' => 'car',
            'bicycle' => 'car',
            'motorcycle' => 'car',
            'motocicleta' => 'car',
            'moto' => 'car',
            'bus' => 'car',
            'autobus' => 'car',
            'property' => 'hotel',
            'properties' => 'hotel',
            'real_estate' => 'hotel',
            'propiedad' => 'hotel',
            'casa' => 'hotel',
            'house' => 'hotel',
            'apartment' => 'hotel',
            'departamento' => 'hotel',
            'building' => 'hotel',
            'edificio' => 'hotel',
            'hotels' => 'hotel',
            'hoteles' => 'hotel',
            'hotel' => 'hotel',
            'sports' => 'sports',
            'sport' => 'sports',
            'deporte' => 'sports',
            'deportes' => 'sports',
            'outdoor' => 'sports',
            'outdoors' => 'sports',
            'aire_libre' => 'sports',
            'ball' => 'sports',
            'pelota' => 'sports',
            'camping' => 'sports',
            'tent' => 'sports',
            'carpa' => 'sports',
            'beauty' => 'beauty',
            'belleza' => 'beauty',
            'hygiene' => 'beauty',
            'higiene' => 'beauty',
            'cosmetic' => 'beauty',
            'cosmetics' => 'beauty',
            'cosmetico' => 'beauty',
            'cosmeticos' => 'beauty',
            'shampoo' => 'beauty',
            'champu' => 'beauty',
            'soap' => 'beauty',
            'jabon' => 'beauty',
            'pets' => 'pets',
            'pet' => 'pets',
            'mascota' => 'pets',
            'mascotas' => 'pets',
            'animal' => 'pets',
            'animals' => 'pets',
            'dog' => 'pets',
            'perro' => 'pets',
            'cat' => 'pets',
            'gato' => 'pets',
            'agriculture' => 'agriculture',
            'agricultura' => 'agriculture',
            'plant' => 'agriculture',
            'plants' => 'agriculture',
            'planta' => 'agriculture',
            'plantas' => 'agriculture',
            'seed' => 'agriculture',
            'semilla' => 'agriculture',
            'semillas' => 'agriculture',
            'garden' => 'agriculture',
            'jardin' => 'agriculture',
            'farm' => 'agriculture',
            'granja' => 'agriculture',
            'toys' => 'toys',
            'toy' => 'toys',
            'juguete' => 'toys',
            'juguetes' => 'toys',
            'entertainment' => 'toys',
            'entretenimiento' => 'toys',
            'music' => 'toys',
            'musica' => 'toys',
            'instrument' => 'toys',
            'instrumento' => 'toys',
            'office' => 'office',
            'oficina' => 'office',
            'stationery' => 'office',
            'papeleria' => 'office',
            'pencil' => 'office',
            'lapiz' => 'office',
            'pen' => 'office',
            'boligrafo' => 'office',
            'paper' => 'office',
            'papel' => 'office',
        ];
        if (isset($aliases[$category])) {
            $category = $aliases[$category];
        }

        if ('random' === $category) {
            $categories = ImageGenerator::categories();
            $category = $categories[array_rand($categories)];
        }

        $supportedCategories = ImageGenerator::categories();
        if (!in_array($category, $supportedCategories, true)) {
            throw new \InvalidArgumentException(sprintf(
                'Unsupported image category "%s". Supported categories: abstract, %s.',
                $category,
                implode(', ', $supportedCategories)
            ));
        }

        $variant = null === $variant || '' === trim((string) $variant) ? null : strtolower(str_replace([' ', '-'], '_', strtr(trim((string) $variant), [
            'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 'ü' => 'u', 'ñ' => 'n',
        ])));
        $variantAliases = [
            'hard_disk' => 'hard_drive', 'hdd' => 'hard_drive', 'disco_duro' => 'hard_drive',
            'memory' => 'ram', 'memoria' => 'ram', 'gpu' => 'graphics_card', 'tarjeta_grafica' => 'graphics_card',
            'cpu' => 'processor', 'procesador' => 'processor', 'placa_madre' => 'motherboard', 'usb' => 'usb_drive',
            'portatil' => 'laptop', 'pantalla' => 'monitor', 'teclado' => 'keyboard', 'raton' => 'mouse',
        ];
        if (isset($variantAliases[$variant])) {
            $variant = $variantAliases[$variant];
        }
        $variants = ImageGenerator::variants($category);
        if (null === $variant) {
            $variant = $variants[array_rand($variants)];
        } elseif (!in_array($variant, $variants, true)) {
            throw new \InvalidArgumentException(sprintf(
                'Unsupported variant "%s" for category "%s". Supported variants: %s.',
                $variant,
                $category,
                implode(', ', $variants)
            ));
        }

        $renderCategory = $category;

        $palette = CategoryRegistry::palette($category);
        // Keep each illustration recognizable while producing a fresh palette on every call.
        $palette[0] = self::varyColor($palette[0], 22);
        $palette[1] = self::varyColor($palette[1], 55);
        $palette[2] = self::varyColor($palette[2], 18);
        $palette[3] = self::varyColor($palette[3], 28);

        $background = self::allocateColor($image, $palette[0]);
        $accent = self::allocateColor($image, $palette[1]);
        $dark = self::allocateColor($image, $palette[2]);
        $shadow = self::allocateColor($image, $palette[3]);
        $light = imagecolorallocate($image, 255, 255, 255);
        $green = imagecolorallocate($image, 76, 160, 89);
        $red = imagecolorallocate($image, 220, 76, 76);
        $yellow = imagecolorallocate($image, 245, 191, 65);
        $width = max(1, $width);
        $height = max(1, $height);
        $unit = max(1, (int) (min($width, $height) * mt_rand(82, 100) / 100));
        $centerX = (int) ($width / 2) + (int) ($unit * mt_rand(-4, 4) / 100);
        $centerY = (int) ($height / 2) + (int) ($unit * mt_rand(-4, 4) / 100);

        imagefill($image, 0, 0, $background);
        imagefilledellipse($image, $centerX, $centerY, (int) ($unit * 0.88), (int) ($unit * 0.88), $light);
        imagefilledrectangle($image, 0, (int) ($height * 0.82), $width, $height, $background);

        if (self::drawSpecificCategoryVariant($image, $renderCategory, $variant, $centerX, $centerY, $unit, $accent, $dark, $light, $shadow, $yellow)) {
            // The selected category class has its own variant artwork.
        } elseif ('product' === $renderCategory) {
            self::drawProductItem($image, $variant, $centerX, $centerY, $unit, $accent, $dark, $light, $shadow);
        } elseif ('car' === $renderCategory) {
            self::drawVehicle($image, $variant, $centerX, $centerY, $unit, $accent, $dark, $light, $shadow);
        } elseif ('hotel' === $renderCategory) {
            self::drawBuilding($image, $centerX, $centerY, $unit, $accent, $dark, $light, $shadow);
        } elseif ('food' === $renderCategory) {
            self::drawFoodItem($image, $variant, $centerX, $centerY, $unit, $accent, $dark, $light, $red, $green, $yellow);
        } elseif ('beverage' === $renderCategory || 'beauty' === $renderCategory) {
            self::drawContainerItem($image, $renderCategory, $variant, $centerX, $centerY, $unit, $accent, $dark, $light, $yellow);
        } elseif ('book' === $renderCategory) {
            $left = $centerX - (int) ($unit * 0.28);
            $top = $centerY - (int) ($unit * 0.28);
            imagefilledrectangle($image, $left + 8, $top + 8, $centerX + (int) ($unit * 0.28), $centerY + (int) ($unit * 0.28), $shadow);
            imagefilledrectangle($image, $left, $top, $centerX + (int) ($unit * 0.26), $centerY + (int) ($unit * 0.26), $accent);
            imagefilledrectangle($image, $left + 9, $top + 9, $centerX + (int) ($unit * 0.2), $centerY + (int) ($unit * 0.2), $light);
            imagefilledrectangle($image, $centerX - 3, $top + 9, $centerX + 3, $centerY + (int) ($unit * 0.2), $dark);
            imageline($image, $left + 18, $top + (int) ($unit * 0.1), $centerX - 9, $top + (int) ($unit * 0.1), $accent);
            imageline($image, $centerX + 10, $top + (int) ($unit * 0.1), $centerX + (int) ($unit * 0.18), $top + (int) ($unit * 0.1), $accent);
        } elseif ('computer' === $renderCategory && in_array($variant, ['laptop', 'desktop', 'monitor'], true)) {
            $left = $centerX - (int) ($unit * 0.32);
            $top = $centerY - (int) ($unit * 0.25);
            imagefilledrectangle($image, $left, $top, $centerX + (int) ($unit * 0.32), $centerY + (int) ($unit * 0.12), $dark);
            imagefilledrectangle($image, $left + 8, $top + 8, $centerX + (int) ($unit * 0.32) - 8, $centerY + (int) ($unit * 0.12) - 8, $accent);
            imagefilledrectangle($image, $centerX - 4, $centerY + (int) ($unit * 0.12), $centerX + 4, $centerY + (int) ($unit * 0.23), $dark);
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.18), $centerY + (int) ($unit * 0.23), $centerX + (int) ($unit * 0.18), $centerY + (int) ($unit * 0.28), $dark);
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.22), $centerY + (int) ($unit * 0.32), $centerX + (int) ($unit * 0.22), $centerY + (int) ($unit * 0.36), $shadow);
            if ('laptop' === $variant) {
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.4), $centerY + (int) ($unit * 0.13), $centerX + (int) ($unit * 0.4), $centerY + (int) ($unit * 0.2), $shadow);
                imagefilledpolygon($image, [
                    $centerX - (int) ($unit * 0.4), $centerY + (int) ($unit * 0.13),
                    $centerX + (int) ($unit * 0.4), $centerY + (int) ($unit * 0.13),
                    $centerX + (int) ($unit * 0.34), $centerY + (int) ($unit * 0.2),
                    $centerX - (int) ($unit * 0.34), $centerY + (int) ($unit * 0.2),
                ], 4, $dark);
            }
        } elseif ('computer' === $renderCategory && 'ram' === $variant) {
            $left = $centerX - (int) ($unit * 0.38);
            $top = $centerY - (int) ($unit * 0.12);
            imagefilledrectangle($image, $left, $top, $centerX + (int) ($unit * 0.38), $centerY + (int) ($unit * 0.12), $accent);
            for ($chip = 0; $chip < 6; $chip++) {
                $chipX = $left + (int) ($unit * (0.08 + $chip * 0.12));
                imagefilledrectangle($image, $chipX, $top + 5, $chipX + (int) ($unit * 0.07), $centerY + (int) ($unit * 0.04), $dark);
                imagefilledrectangle($image, $chipX + 3, $centerY + (int) ($unit * 0.12), $chipX + 7, $centerY + (int) ($unit * 0.18), $yellow);
            }
        } elseif ('computer' === $renderCategory && 'hard_drive' === $variant) {
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.32), $centerY - (int) ($unit * 0.23), $centerX + (int) ($unit * 0.32), $centerY + (int) ($unit * 0.23), $dark);
            imagefilledellipse($image, $centerX - (int) ($unit * 0.03), $centerY, (int) ($unit * 0.34), (int) ($unit * 0.34), $shadow);
            imagefilledellipse($image, $centerX - (int) ($unit * 0.03), $centerY, (int) ($unit * 0.1), (int) ($unit * 0.1), $light);
            imageline($image, $centerX - (int) ($unit * 0.02), $centerY, $centerX + (int) ($unit * 0.23), $centerY - (int) ($unit * 0.15), $accent);
        } elseif ('computer' === $renderCategory && 'ssd' === $variant) {
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.32), $centerY - (int) ($unit * 0.2), $centerX + (int) ($unit * 0.32), $centerY + (int) ($unit * 0.2), $dark);
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.2), $centerY - (int) ($unit * 0.1), $centerX + (int) ($unit * 0.2), $centerY + (int) ($unit * 0.1), $accent);
            imagefilledrectangle($image, $centerX + (int) ($unit * 0.32), $centerY - (int) ($unit * 0.08), $centerX + (int) ($unit * 0.4), $centerY + (int) ($unit * 0.08), $yellow);
        } elseif ('computer' === $renderCategory && in_array($variant, ['graphics_card', 'motherboard'], true)) {
            $left = $centerX - (int) ($unit * 0.36);
            $top = $centerY - (int) ($unit * 0.28);
            imagefilledrectangle($image, $left, $top, $centerX + (int) ($unit * 0.36), $centerY + (int) ($unit * 0.28), $accent);
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.12), $centerY - (int) ($unit * 0.12), $centerX + (int) ($unit * 0.12), $centerY + (int) ($unit * 0.12), $dark);
            if ('graphics_card' === $variant) {
                imagefilledellipse($image, $centerX, $centerY, (int) ($unit * 0.24), (int) ($unit * 0.24), $light);
                imageellipse($image, $centerX, $centerY, (int) ($unit * 0.2), (int) ($unit * 0.2), $dark);
            } else {
                imageline($image, $left + 5, $top + (int) ($unit * 0.12), $centerX - (int) ($unit * 0.16), $top + (int) ($unit * 0.12), $yellow);
                imageline($image, $centerX + (int) ($unit * 0.16), $top + (int) ($unit * 0.12), $centerX + (int) ($unit * 0.29), $top + (int) ($unit * 0.12), $yellow);
            }
        } elseif ('computer' === $renderCategory && 'processor' === $variant) {
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.22), $centerY - (int) ($unit * 0.22), $centerX + (int) ($unit * 0.22), $centerY + (int) ($unit * 0.22), $dark);
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.15), $centerY - (int) ($unit * 0.15), $centerX + (int) ($unit * 0.15), $centerY + (int) ($unit * 0.15), $accent);
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.07), $centerY - (int) ($unit * 0.07), $centerX + (int) ($unit * 0.07), $centerY + (int) ($unit * 0.07), $light);
        } elseif ('computer' === $renderCategory && 'keyboard' === $variant) {
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.38), $centerY - (int) ($unit * 0.2), $centerX + (int) ($unit * 0.38), $centerY + (int) ($unit * 0.2), $dark);
            for ($row = 0; $row < 3; $row++) {
                for ($key = 0; $key < 8; $key++) {
                    $keyX = $centerX - (int) ($unit * 0.32) + (int) ($key * $unit * 0.09);
                    $keyY = $centerY - (int) ($unit * 0.13) + (int) ($row * $unit * 0.09);
                    imagefilledrectangle($image, $keyX, $keyY, $keyX + (int) ($unit * 0.055), $keyY + (int) ($unit * 0.045), $light);
                }
            }
        } elseif ('computer' === $renderCategory && 'mouse' === $variant) {
            imagefilledellipse($image, $centerX, $centerY, (int) ($unit * 0.38), (int) ($unit * 0.56), $dark);
            imagefilledrectangle($image, $centerX - 1, $centerY - (int) ($unit * 0.27), $centerX + 1, $centerY, $light);
            imagefilledrectangle($image, $centerX - 2, $centerY - (int) ($unit * 0.18), $centerX + 2, $centerY - (int) ($unit * 0.04), $accent);
        } elseif ('computer' === $renderCategory && 'usb_drive' === $variant) {
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.18), $centerY - (int) ($unit * 0.28), $centerX + (int) ($unit * 0.18), $centerY + (int) ($unit * 0.24), $accent);
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.1), $centerY + (int) ($unit * 0.24), $centerX + (int) ($unit * 0.1), $centerY + (int) ($unit * 0.35), $dark);
            imagefilledellipse($image, $centerX, $centerY - (int) ($unit * 0.08), (int) ($unit * 0.08), (int) ($unit * 0.08), $light);
        } elseif ('medicine' === $renderCategory) {
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.2), $centerY - (int) ($unit * 0.22), $centerX + (int) ($unit * 0.2), $centerY + (int) ($unit * 0.24), $accent);
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.12), $centerY - (int) ($unit * 0.31), $centerX + (int) ($unit * 0.12), $centerY - (int) ($unit * 0.22), $dark);
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.15), $centerY - (int) ($unit * 0.04), $centerX + (int) ($unit * 0.15), $centerY + (int) ($unit * 0.04), $light);
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.04), $centerY - (int) ($unit * 0.15), $centerX + (int) ($unit * 0.04), $centerY + (int) ($unit * 0.15), $light);
        } elseif ('construction' === $renderCategory || 'helmet' === $renderCategory) {
            imagefilledellipse($image, $centerX, $centerY, (int) ($unit * 0.54), (int) ($unit * 0.42), $accent);
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.28), $centerY, $centerX + (int) ($unit * 0.28), $centerY + (int) ($unit * 0.13), $accent);
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.38), $centerY + (int) ($unit * 0.1), $centerX + (int) ($unit * 0.38), $centerY + (int) ($unit * 0.16), $dark);
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.035), $centerY - (int) ($unit * 0.2), $centerX + (int) ($unit * 0.035), $centerY + (int) ($unit * 0.08), $light);
        } elseif ('harness' === $renderCategory) {
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.2), $centerY - (int) ($unit * 0.16), $centerX + (int) ($unit * 0.2), $centerY + (int) ($unit * 0.3), $accent);
            imageline($image, $centerX - (int) ($unit * 0.2), $centerY - (int) ($unit * 0.16), $centerX + (int) ($unit * 0.2), $centerY + (int) ($unit * 0.3), $light);
            imageline($image, $centerX + (int) ($unit * 0.2), $centerY - (int) ($unit * 0.16), $centerX - (int) ($unit * 0.2), $centerY + (int) ($unit * 0.3), $light);
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.24), $centerY + (int) ($unit * 0.05), $centerX + (int) ($unit * 0.24), $centerY + (int) ($unit * 0.12), $dark);
        } elseif ('carpentry' === $renderCategory) {
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.035), $centerY - (int) ($unit * 0.04), $centerX + (int) ($unit * 0.035), $centerY + (int) ($unit * 0.31), $dark);
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.22), $centerY - (int) ($unit * 0.2), $centerX + (int) ($unit * 0.22), $centerY - (int) ($unit * 0.08), $accent);
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.22), $centerY - (int) ($unit * 0.2), $centerX - (int) ($unit * 0.14), $centerY - (int) ($unit * 0.08), $dark);
        } elseif ('furniture' === $renderCategory) {
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.22), $centerY - (int) ($unit * 0.28), $centerX + (int) ($unit * 0.22), $centerY + (int) ($unit * 0.05), $accent);
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.3), $centerY, $centerX + (int) ($unit * 0.3), $centerY + (int) ($unit * 0.1), $dark);
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.24), $centerY + (int) ($unit * 0.1), $centerX - (int) ($unit * 0.17), $centerY + (int) ($unit * 0.32), $dark);
            imagefilledrectangle($image, $centerX + (int) ($unit * 0.17), $centerY + (int) ($unit * 0.1), $centerX + (int) ($unit * 0.24), $centerY + (int) ($unit * 0.32), $dark);
        } elseif ('clothing' === $renderCategory) {
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.2), $centerY - (int) ($unit * 0.2), $centerX + (int) ($unit * 0.2), $centerY + (int) ($unit * 0.3), $accent);
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.36), $centerY - (int) ($unit * 0.17), $centerX - (int) ($unit * 0.2), $centerY + (int) ($unit * 0.02), $accent);
            imagefilledrectangle($image, $centerX + (int) ($unit * 0.2), $centerY - (int) ($unit * 0.17), $centerX + (int) ($unit * 0.36), $centerY + (int) ($unit * 0.02), $accent);
            imagefilledellipse($image, $centerX, $centerY - (int) ($unit * 0.19), (int) ($unit * 0.14), (int) ($unit * 0.08), $light);
        } elseif ('sports' === $renderCategory) {
            self::drawSportsItem($image, $variant, $centerX, $centerY, $unit, $accent, $dark, $light, $shadow, $yellow);
        } elseif ('pets' === $renderCategory) {
            imagefilledellipse($image, $centerX - (int) ($unit * 0.2), $centerY - (int) ($unit * 0.16), (int) ($unit * 0.22), (int) ($unit * 0.26), $dark);
            imagefilledellipse($image, $centerX + (int) ($unit * 0.2), $centerY - (int) ($unit * 0.16), (int) ($unit * 0.22), (int) ($unit * 0.26), $dark);
            imagefilledellipse($image, $centerX, $centerY, (int) ($unit * 0.48), (int) ($unit * 0.48), $accent);
            imagefilledellipse($image, $centerX - (int) ($unit * 0.1), $centerY - (int) ($unit * 0.03), 5, 5, $dark);
            imagefilledellipse($image, $centerX + (int) ($unit * 0.1), $centerY - (int) ($unit * 0.03), 5, 5, $dark);
            imagefilledellipse($image, $centerX, $centerY + (int) ($unit * 0.1), (int) ($unit * 0.12), (int) ($unit * 0.08), $light);
        } elseif ('agriculture' === $renderCategory) {
            imageline($image, $centerX, $centerY + (int) ($unit * 0.27), $centerX, $centerY - (int) ($unit * 0.23), $dark);
            imagefilledellipse($image, $centerX - (int) ($unit * 0.13), $centerY - (int) ($unit * 0.1), (int) ($unit * 0.25), (int) ($unit * 0.12), $green);
            imagefilledellipse($image, $centerX + (int) ($unit * 0.13), $centerY + (int) ($unit * 0.02), (int) ($unit * 0.25), (int) ($unit * 0.12), $green);
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.22), $centerY + (int) ($unit * 0.2), $centerX + (int) ($unit * 0.22), $centerY + (int) ($unit * 0.34), $accent);
        } elseif ('toys' === $renderCategory) {
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.27), $centerY - (int) ($unit * 0.05), $centerX - (int) ($unit * 0.02), $centerY + (int) ($unit * 0.22), $red);
            imagefilledrectangle($image, $centerX + (int) ($unit * 0.02), $centerY - (int) ($unit * 0.05), $centerX + (int) ($unit * 0.27), $centerY + (int) ($unit * 0.22), $yellow);
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.14), $centerY - (int) ($unit * 0.3), $centerX + (int) ($unit * 0.14), $centerY - (int) ($unit * 0.08), $accent);
            imagefilledellipse($image, $centerX, $centerY - (int) ($unit * 0.19), (int) ($unit * 0.07), (int) ($unit * 0.07), $light);
        } elseif ('office' === $renderCategory) {
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.2), $centerY - (int) ($unit * 0.28), $centerX + (int) ($unit * 0.2), $centerY + (int) ($unit * 0.28), $light);
            imageline($image, $centerX - (int) ($unit * 0.12), $centerY - (int) ($unit * 0.12), $centerX + (int) ($unit * 0.12), $centerY - (int) ($unit * 0.12), $accent);
            imageline($image, $centerX - (int) ($unit * 0.12), $centerY, $centerX + (int) ($unit * 0.12), $centerY, $accent);
            imageline($image, $centerX - (int) ($unit * 0.12), $centerY + (int) ($unit * 0.12), $centerX + (int) ($unit * 0.12), $centerY + (int) ($unit * 0.12), $accent);
            imagefilledrectangle($image, $centerX + (int) ($unit * 0.22), $centerY - (int) ($unit * 0.2), $centerX + (int) ($unit * 0.28), $centerY + (int) ($unit * 0.2), $yellow);
        }
    }

    private static function drawSpecificCategoryVariant($image, $category, $variant, $centerX, $centerY, $unit, $accent, $dark, $light, $shadow, $yellow)
    {
        if ('book' === $category) {
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.27), $centerY - (int) ($unit * 0.3), $centerX + (int) ($unit * 0.27), $centerY + (int) ($unit * 0.3), $accent);
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.2), $centerY - (int) ($unit * 0.23), $centerX + (int) ($unit * 0.2), $centerY + (int) ($unit * 0.23), $light);
            if ('comic' === $variant) {
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.16), $centerY - (int) ($unit * 0.16), $centerX + (int) ($unit * 0.16), $centerY + (int) ($unit * 0.12), $yellow);
                imagefilledellipse($image, $centerX, $centerY - (int) ($unit * 0.02), (int) ($unit * 0.13), (int) ($unit * 0.13), $accent);
            } else {
                foreach ([-2, -1, 0, 1, 2] as $line) {
                    imageline($image, $centerX - (int) ($unit * 0.15), $centerY + (int) ($line * $unit * 0.07), $centerX + (int) ($unit * 0.15), $centerY + (int) ($line * $unit * 0.07), $accent);
                }
            }

            return true;
        }

        if ('medicine' === $category) {
            if ('pills' === $variant) {
                foreach ([[-0.17, -0.12], [0.12, -0.1], [-0.04, 0.12], [0.22, 0.15]] as $pill) {
                    imagefilledellipse($image, $centerX + (int) ($unit * $pill[0]), $centerY + (int) ($unit * $pill[1]), (int) ($unit * 0.2), (int) ($unit * 0.1), $accent);
                    imageline($image, $centerX + (int) ($unit * $pill[0]), $centerY + (int) ($unit * $pill[1] - 3), $centerX + (int) ($unit * $pill[0]), $centerY + (int) ($unit * $pill[1] + 3), $light);
                }
            } elseif ('first_aid' === $variant) {
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.28), $centerY - (int) ($unit * 0.2), $centerX + (int) ($unit * 0.28), $centerY + (int) ($unit * 0.2), $accent);
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.1), $centerY - (int) ($unit * 0.04), $centerX + (int) ($unit * 0.1), $centerY + (int) ($unit * 0.04), $light);
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.04), $centerY - (int) ($unit * 0.12), $centerX + (int) ($unit * 0.04), $centerY + (int) ($unit * 0.12), $light);
            } elseif ('thermometer' === $variant) {
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.06), $centerY - (int) ($unit * 0.27), $centerX + (int) ($unit * 0.06), $centerY + (int) ($unit * 0.16), $light);
                imagefilledellipse($image, $centerX, $centerY + (int) ($unit * 0.2), (int) ($unit * 0.18), (int) ($unit * 0.18), $red = imagecolorallocate($image, 220, 76, 76));
                imagefilledrectangle($image, $centerX - 2, $centerY - (int) ($unit * 0.03), $centerX + 2, $centerY + (int) ($unit * 0.19), $red);
            } elseif ('syringe' === $variant) {
                imageline($image, $centerX - (int) ($unit * 0.25), $centerY + (int) ($unit * 0.22), $centerX + (int) ($unit * 0.2), $centerY - (int) ($unit * 0.22), $accent);
                imageline($image, $centerX - (int) ($unit * 0.31), $centerY + (int) ($unit * 0.16), $centerX - (int) ($unit * 0.19), $centerY + (int) ($unit * 0.28), $dark);
                imageline($image, $centerX + (int) ($unit * 0.2), $centerY - (int) ($unit * 0.22), $centerX + (int) ($unit * 0.34), $centerY - (int) ($unit * 0.35), $dark);
            } elseif ('stethoscope' === $variant) {
                imagearc($image, $centerX, $centerY - (int) ($unit * 0.08), (int) ($unit * 0.42), (int) ($unit * 0.48), 0, 180, $accent);
                imageline($image, $centerX - (int) ($unit * 0.21), $centerY - (int) ($unit * 0.08), $centerX - (int) ($unit * 0.21), $centerY - (int) ($unit * 0.28), $accent);
                imageline($image, $centerX + (int) ($unit * 0.21), $centerY - (int) ($unit * 0.08), $centerX + (int) ($unit * 0.21), $centerY - (int) ($unit * 0.28), $accent);
                imagefilledellipse($image, $centerX, $centerY + (int) ($unit * 0.17), (int) ($unit * 0.15), (int) ($unit * 0.15), $dark);
            } else {
                self::drawContainerItem($image, 'beverage', 'bottle', $centerX, $centerY, $unit, $accent, $dark, $light, $yellow);
            }

            return true;
        }

        if ('construction' === $category || 'helmet' === $category) {
            if ('vest' === $variant) {
                imagefilledpolygon($image, [$centerX - (int) ($unit * 0.25), $centerY - (int) ($unit * 0.24), $centerX + (int) ($unit * 0.25), $centerY - (int) ($unit * 0.24), $centerX + (int) ($unit * 0.34), $centerY + (int) ($unit * 0.28), $centerX - (int) ($unit * 0.34), $centerY + (int) ($unit * 0.28)], 4, $yellow);
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.04), $centerY - (int) ($unit * 0.2), $centerX + (int) ($unit * 0.04), $centerY + (int) ($unit * 0.25), $light);
            } elseif ('cone' === $variant) {
                imagefilledpolygon($image, [$centerX, $centerY - (int) ($unit * 0.31), $centerX + (int) ($unit * 0.22), $centerY + (int) ($unit * 0.22), $centerX - (int) ($unit * 0.22), $centerY + (int) ($unit * 0.22)], 3, $yellow);
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.29), $centerY + (int) ($unit * 0.22), $centerX + (int) ($unit * 0.29), $centerY + (int) ($unit * 0.3), $dark);
            } elseif ('toolbox' === $variant) {
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.3), $centerY - (int) ($unit * 0.05), $centerX + (int) ($unit * 0.3), $centerY + (int) ($unit * 0.24), $accent);
                imagearc($image, $centerX, $centerY - (int) ($unit * 0.05), (int) ($unit * 0.24), (int) ($unit * 0.2), 180, 360, $dark);
            } elseif ('ladder' === $variant) {
                imageline($image, $centerX - (int) ($unit * 0.2), $centerY - (int) ($unit * 0.32), $centerX - (int) ($unit * 0.2), $centerY + (int) ($unit * 0.32), $accent);
                imageline($image, $centerX + (int) ($unit * 0.2), $centerY - (int) ($unit * 0.32), $centerX + (int) ($unit * 0.2), $centerY + (int) ($unit * 0.32), $accent);
                for ($step = -2; $step <= 2; $step++) {
                    imageline($image, $centerX - (int) ($unit * 0.2), $centerY + (int) ($step * $unit * 0.12), $centerX + (int) ($unit * 0.2), $centerY + (int) ($step * $unit * 0.12), $dark);
                }
            } elseif ('cap' === $variant) {
                imagefilledellipse($image, $centerX, $centerY, (int) ($unit * 0.5), (int) ($unit * 0.3), $accent);
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.32), $centerY, $centerX + (int) ($unit * 0.32), $centerY + (int) ($unit * 0.08), $dark);
            } else {
                imagefilledellipse($image, $centerX, $centerY + (int) ($unit * 0.04), (int) ($unit * 0.62), (int) ($unit * 0.36), $accent);
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.32), $centerY, $centerX + (int) ($unit * 0.32), $centerY + (int) ($unit * 0.1), $dark);
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.04), $centerY - (int) ($unit * 0.21), $centerX + (int) ($unit * 0.04), $centerY + (int) ($unit * 0.2), $yellow);
            }

            return true;
        }

        if ('harness' === $category) {
            if ('carabiner' === $variant) {
                imageellipse($image, $centerX, $centerY, (int) ($unit * 0.36), (int) ($unit * 0.5), $accent);
                imageline($image, $centerX + (int) ($unit * 0.09), $centerY - (int) ($unit * 0.23), $centerX - (int) ($unit * 0.08), $centerY + (int) ($unit * 0.22), $dark);
            } elseif ('lanyard' === $variant) {
                imagearc($image, $centerX, $centerY - (int) ($unit * 0.06), (int) ($unit * 0.42), (int) ($unit * 0.52), 0, 180, $accent);
                imagefilledellipse($image, $centerX, $centerY + (int) ($unit * 0.22), (int) ($unit * 0.1), (int) ($unit * 0.1), $yellow);
            } else {
                imageline($image, $centerX, $centerY - (int) ($unit * 0.3), $centerX, $centerY + (int) ($unit * 0.3), $accent);
                imageline($image, $centerX - (int) ($unit * 0.26), $centerY - (int) ($unit * 0.12), $centerX + (int) ($unit * 0.26), $centerY - (int) ($unit * 0.12), $accent);
                imageline($image, $centerX - (int) ($unit * 0.26), $centerY + (int) ($unit * 0.16), $centerX + (int) ($unit * 0.26), $centerY + (int) ($unit * 0.16), $accent);
            }

            return true;
        }

        if ('carpentry' === $category) {
            if ('saw' === $variant) {
                imagefilledpolygon($image, [$centerX - (int) ($unit * 0.32), $centerY - (int) ($unit * 0.12), $centerX + (int) ($unit * 0.28), $centerY - (int) ($unit * 0.12), $centerX + (int) ($unit * 0.17), $centerY + (int) ($unit * 0.12), $centerX - (int) ($unit * 0.32), $centerY + (int) ($unit * 0.12)], 4, $accent);
            } elseif ('drill' === $variant) {
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.28), $centerY - (int) ($unit * 0.12), $centerX + (int) ($unit * 0.2), $centerY + (int) ($unit * 0.08), $accent);
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.08), $centerY + (int) ($unit * 0.08), $centerX + (int) ($unit * 0.06), $centerY + (int) ($unit * 0.29), $dark);
                imageline($image, $centerX + (int) ($unit * 0.2), $centerY - (int) ($unit * 0.02), $centerX + (int) ($unit * 0.36), $centerY - (int) ($unit * 0.02), $dark);
            } elseif ('wrench' === $variant || 'screwdriver' === $variant) {
                imageline($image, $centerX, $centerY - (int) ($unit * 0.28), $centerX, $centerY + (int) ($unit * 0.25), $accent);
                if ('wrench' === $variant) {
                    imagearc($image, $centerX, $centerY - (int) ($unit * 0.22), (int) ($unit * 0.24), (int) ($unit * 0.24), 210, 330, $dark);
                } else {
                    imagefilledrectangle($image, $centerX - (int) ($unit * 0.09), $centerY + (int) ($unit * 0.19), $centerX + (int) ($unit * 0.09), $centerY + (int) ($unit * 0.34), $dark);
                }
            } elseif ('wood' === $variant) {
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.32), $centerY - (int) ($unit * 0.18), $centerX + (int) ($unit * 0.32), $centerY + (int) ($unit * 0.18), $shadow);
                imageellipse($image, $centerX - (int) ($unit * 0.25), $centerY, (int) ($unit * 0.08), (int) ($unit * 0.25), $dark);
            } else {
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.04), $centerY - (int) ($unit * 0.04), $centerX + (int) ($unit * 0.04), $centerY + (int) ($unit * 0.31), $dark);
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.24), $centerY - (int) ($unit * 0.23), $centerX + (int) ($unit * 0.24), $centerY - (int) ($unit * 0.08), $accent);
            }

            return true;
        }

        if ('furniture' === $category) {
            if ('table' === $variant || 'desk' === $variant) {
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.32), $centerY - (int) ($unit * 0.08), $centerX + (int) ($unit * 0.32), $centerY + (int) ($unit * 0.02), $accent);
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.25), $centerY + (int) ($unit * 0.02), $centerX - (int) ($unit * 0.19), $centerY + (int) ($unit * 0.3), $dark);
                imagefilledrectangle($image, $centerX + (int) ($unit * 0.19), $centerY + (int) ($unit * 0.02), $centerX + (int) ($unit * 0.25), $centerY + (int) ($unit * 0.3), $dark);
            } elseif ('bed' === $variant) {
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.34), $centerY - (int) ($unit * 0.12), $centerX + (int) ($unit * 0.34), $centerY + (int) ($unit * 0.17), $accent);
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.3), $centerY - (int) ($unit * 0.24), $centerX - (int) ($unit * 0.06), $centerY - (int) ($unit * 0.08), $light);
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.32), $centerY + (int) ($unit * 0.17), $centerX - (int) ($unit * 0.27), $centerY + (int) ($unit * 0.29), $dark);
                imagefilledrectangle($image, $centerX + (int) ($unit * 0.27), $centerY + (int) ($unit * 0.17), $centerX + (int) ($unit * 0.32), $centerY + (int) ($unit * 0.29), $dark);
            } elseif ('sofa' === $variant) {
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.32), $centerY - (int) ($unit * 0.16), $centerX + (int) ($unit * 0.32), $centerY + (int) ($unit * 0.12), $accent);
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.38), $centerY - (int) ($unit * 0.06), $centerX - (int) ($unit * 0.28), $centerY + (int) ($unit * 0.2), $dark);
                imagefilledrectangle($image, $centerX + (int) ($unit * 0.28), $centerY - (int) ($unit * 0.06), $centerX + (int) ($unit * 0.38), $centerY + (int) ($unit * 0.2), $dark);
            } elseif ('cabinet' === $variant) {
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.24), $centerY - (int) ($unit * 0.31), $centerX + (int) ($unit * 0.24), $centerY + (int) ($unit * 0.31), $accent);
                imageline($image, $centerX, $centerY - (int) ($unit * 0.31), $centerX, $centerY + (int) ($unit * 0.31), $dark);
                imagefilledellipse($image, $centerX - (int) ($unit * 0.04), $centerY, 4, 4, $light);
                imagefilledellipse($image, $centerX + (int) ($unit * 0.04), $centerY, 4, 4, $light);
            } else {
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.22), $centerY - (int) ($unit * 0.25), $centerX + (int) ($unit * 0.22), $centerY + (int) ($unit * 0.04), $accent);
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.3), $centerY, $centerX + (int) ($unit * 0.3), $centerY + (int) ($unit * 0.1), $dark);
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.24), $centerY + (int) ($unit * 0.1), $centerX - (int) ($unit * 0.17), $centerY + (int) ($unit * 0.32), $dark);
                imagefilledrectangle($image, $centerX + (int) ($unit * 0.17), $centerY + (int) ($unit * 0.1), $centerX + (int) ($unit * 0.24), $centerY + (int) ($unit * 0.32), $dark);
            }

            return true;
        }

        if ('clothing' === $category) {
            if ('pants' === $variant) {
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.22), $centerY - (int) ($unit * 0.28), $centerX + (int) ($unit * 0.22), $centerY - (int) ($unit * 0.08), $accent);
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.22), $centerY - (int) ($unit * 0.08), $centerX - (int) ($unit * 0.03), $centerY + (int) ($unit * 0.31), $accent);
                imagefilledrectangle($image, $centerX + (int) ($unit * 0.03), $centerY - (int) ($unit * 0.08), $centerX + (int) ($unit * 0.22), $centerY + (int) ($unit * 0.31), $accent);
            } elseif ('shoes' === $variant) {
                imagefilledellipse($image, $centerX - (int) ($unit * 0.16), $centerY + (int) ($unit * 0.08), (int) ($unit * 0.38), (int) ($unit * 0.2), $accent);
                imagefilledellipse($image, $centerX + (int) ($unit * 0.18), $centerY + (int) ($unit * 0.08), (int) ($unit * 0.38), (int) ($unit * 0.2), $dark);
            } elseif ('hat' === $variant) {
                imagefilledellipse($image, $centerX, $centerY + (int) ($unit * 0.03), (int) ($unit * 0.48), (int) ($unit * 0.18), $dark);
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.18), $centerY - (int) ($unit * 0.28), $centerX + (int) ($unit * 0.18), $centerY + (int) ($unit * 0.04), $accent);
            } else {
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.2), $centerY - (int) ($unit * 0.22), $centerX + (int) ($unit * 0.2), $centerY + (int) ($unit * 0.28), $accent);
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.36), $centerY - (int) ($unit * 0.18), $centerX - (int) ($unit * 0.2), $centerY + (int) ($unit * 0.02), $accent);
                imagefilledrectangle($image, $centerX + (int) ($unit * 0.2), $centerY - (int) ($unit * 0.18), $centerX + (int) ($unit * 0.36), $centerY + (int) ($unit * 0.02), $accent);
                if ('jacket' === $variant) {
                    imageline($image, $centerX, $centerY - (int) ($unit * 0.2), $centerX, $centerY + (int) ($unit * 0.28), $light);
                }
            }

            return true;
        }

        if ('hotel' === $category) {
            if ('house' === $variant || 'cabin' === $variant) {
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.28), $centerY - (int) ($unit * 0.08), $centerX + (int) ($unit * 0.28), $centerY + (int) ($unit * 0.27), $accent);
                imagefilledpolygon($image, [$centerX - (int) ($unit * 0.34), $centerY - (int) ($unit * 0.08), $centerX, $centerY - (int) ($unit * 0.36), $centerX + (int) ($unit * 0.34), $centerY - (int) ($unit * 0.08)], 3, $dark);
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.06), $centerY + (int) ($unit * 0.08), $centerX + (int) ($unit * 0.06), $centerY + (int) ($unit * 0.27), $light);
            } else {
                self::drawBuilding($image, $centerX, $centerY, $unit, $accent, $dark, $light, $shadow);
                if ('resort' === $variant) {
                    imagefilledrectangle($image, $centerX - (int) ($unit * 0.35), $centerY + (int) ($unit * 0.21), $centerX + (int) ($unit * 0.35), $centerY + (int) ($unit * 0.26), $yellow);
                }
            }

            return true;
        }

        if ('pets' === $category) {
            if ('fish' === $variant) {
                self::drawFoodItem($image, 'fish', $centerX, $centerY, $unit, $accent, $dark, $light, $shadow, imagecolorallocate($image, 76, 160, 89), $yellow);
            } elseif ('bird' === $variant) {
                imagefilledellipse($image, $centerX, $centerY, (int) ($unit * 0.38), (int) ($unit * 0.3), $accent);
                imagefilledellipse($image, $centerX - (int) ($unit * 0.08), $centerY - (int) ($unit * 0.16), (int) ($unit * 0.18), (int) ($unit * 0.18), $dark);
                imagefilledpolygon($image, [$centerX + (int) ($unit * 0.16), $centerY - (int) ($unit * 0.04), $centerX + (int) ($unit * 0.32), $centerY + (int) ($unit * 0.02), $centerX + (int) ($unit * 0.16), $centerY + (int) ($unit * 0.08)], 3, $yellow);
            } elseif ('paw' === $variant) {
                imagefilledellipse($image, $centerX, $centerY + (int) ($unit * 0.1), (int) ($unit * 0.3), (int) ($unit * 0.24), $accent);
                foreach ([-2, -1, 1, 2] as $toe) {
                    imagefilledellipse($image, $centerX + (int) ($toe * $unit * 0.09), $centerY - (int) ($unit * 0.12), (int) ($unit * 0.12), (int) ($unit * 0.15), $accent);
                }
            } elseif ('food_bowl' === $variant) {
                imagearc($image, $centerX, $centerY, (int) ($unit * 0.56), (int) ($unit * 0.4), 0, 180, $accent);
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.28), $centerY, $centerX + (int) ($unit * 0.28), $centerY + (int) ($unit * 0.19), $accent);
                imagefilledellipse($image, $centerX, $centerY, (int) ($unit * 0.52), (int) ($unit * 0.12), $yellow);
            } else {
                $earHeight = 'cat' === $variant ? 0.26 : 0.2;
                imagefilledellipse($image, $centerX - (int) ($unit * 0.2), $centerY - (int) ($unit * 0.16), (int) ($unit * 0.22), (int) ($unit * 0.26), $accent);
                imagefilledellipse($image, $centerX + (int) ($unit * 0.2), $centerY - (int) ($unit * 0.16), (int) ($unit * 0.22), (int) ($unit * 0.26), $accent);
                imagefilledellipse($image, $centerX, $centerY, (int) ($unit * 0.48), (int) ($unit * 0.48), $accent);
                if ('cat' === $variant) {
                    imagefilledpolygon($image, [$centerX - (int) ($unit * 0.31), $centerY - (int) ($unit * 0.14), $centerX - (int) ($unit * 0.23), $centerY - (int) ($unit * $earHeight), $centerX - (int) ($unit * 0.15), $centerY - (int) ($unit * 0.14)], 3, $accent);
                    imagefilledpolygon($image, [$centerX + (int) ($unit * 0.31), $centerY - (int) ($unit * 0.14), $centerX + (int) ($unit * 0.23), $centerY - (int) ($unit * $earHeight), $centerX + (int) ($unit * 0.15), $centerY - (int) ($unit * 0.14)], 3, $accent);
                }
                imagefilledellipse($image, $centerX - (int) ($unit * 0.1), $centerY - (int) ($unit * 0.03), 5, 5, $dark);
                imagefilledellipse($image, $centerX + (int) ($unit * 0.1), $centerY - (int) ($unit * 0.03), 5, 5, $dark);
            }

            return true;
        }

        if ('agriculture' === $category) {
            if ('tractor' === $variant) {
                self::drawVehicle($image, 'truck', $centerX, $centerY, $unit, $accent, $dark, $light, $shadow);
            } elseif ('seed' === $variant) {
                foreach ([-1, 0, 1] as $seed) {
                    imagefilledellipse($image, $centerX + (int) ($seed * $unit * 0.18), $centerY, (int) ($unit * 0.16), (int) ($unit * 0.25), $yellow);
                }
            } elseif ('wheat' === $variant) {
                imageline($image, $centerX, $centerY + (int) ($unit * 0.3), $centerX, $centerY - (int) ($unit * 0.28), $green = imagecolorallocate($image, 76, 160, 89));
                for ($grain = -2; $grain <= 2; $grain++) {
                    imagefilledellipse($image, $centerX + (int) ($unit * ($grain % 2 ? 0.08 : -0.08)), $centerY + (int) ($grain * $unit * 0.08), (int) ($unit * 0.11), (int) ($unit * 0.07), $yellow);
                }
            } elseif ('watering_can' === $variant) {
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.24), $centerY - (int) ($unit * 0.12), $centerX + (int) ($unit * 0.2), $centerY + (int) ($unit * 0.2), $accent);
                imagearc($image, $centerX - (int) ($unit * 0.2), $centerY, (int) ($unit * 0.28), (int) ($unit * 0.3), 90, 270, $dark);
                imageline($image, $centerX + (int) ($unit * 0.2), $centerY - (int) ($unit * 0.04), $centerX + (int) ($unit * 0.36), $centerY - (int) ($unit * 0.2), $accent);
            } else {
                imageline($image, $centerX, $centerY + (int) ($unit * 0.28), $centerX, $centerY - (int) ($unit * 0.23), $dark);
                imagefilledellipse($image, $centerX - (int) ($unit * 0.13), $centerY - (int) ($unit * 0.1), (int) ($unit * 0.25), (int) ($unit * 0.12), $green = imagecolorallocate($image, 76, 160, 89));
                imagefilledellipse($image, $centerX + (int) ($unit * 0.13), $centerY + (int) ($unit * 0.02), (int) ($unit * 0.25), (int) ($unit * 0.12), $green);
                if ('tree' === $variant) {
                    imagefilledrectangle($image, $centerX - (int) ($unit * 0.05), $centerY, $centerX + (int) ($unit * 0.05), $centerY + (int) ($unit * 0.3), $dark);
                    imagefilledellipse($image, $centerX, $centerY - (int) ($unit * 0.12), (int) ($unit * 0.42), (int) ($unit * 0.4), $green);
                }
            }

            return true;
        }

        if ('toys' === $category) {
            if ('ball' === $variant) {
                self::drawSportsItem($image, 'ball', $centerX, $centerY, $unit, $accent, $dark, $light, $shadow, $yellow);
            } elseif ('doll' === $variant || 'teddy_bear' === $variant) {
                imagefilledellipse($image, $centerX, $centerY - (int) ($unit * 0.14), (int) ($unit * 0.32), (int) ($unit * 0.32), $accent);
                imagefilledellipse($image, $centerX - (int) ($unit * 0.17), $centerY - (int) ($unit * 0.27), (int) ($unit * 0.14), (int) ($unit * 0.14), $accent);
                imagefilledellipse($image, $centerX + (int) ($unit * 0.17), $centerY - (int) ($unit * 0.27), (int) ($unit * 0.14), (int) ($unit * 0.14), $accent);
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.14), $centerY + (int) ($unit * 0.02), $centerX + (int) ($unit * 0.14), $centerY + (int) ($unit * 0.29), $yellow);
            } elseif ('music' === $variant) {
                imagefilledellipse($image, $centerX - (int) ($unit * 0.17), $centerY + (int) ($unit * 0.19), (int) ($unit * 0.16), (int) ($unit * 0.12), $accent);
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.1), $centerY - (int) ($unit * 0.25), $centerX - (int) ($unit * 0.06), $centerY + (int) ($unit * 0.19), $dark);
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.06), $centerY - (int) ($unit * 0.25), $centerX + (int) ($unit * 0.18), $centerY - (int) ($unit * 0.18), $dark);
            } elseif ('puzzle' === $variant) {
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.26), $centerY - (int) ($unit * 0.26), $centerX + (int) ($unit * 0.26), $centerY + (int) ($unit * 0.26), $yellow);
                imageline($image, $centerX, $centerY - (int) ($unit * 0.26), $centerX, $centerY + (int) ($unit * 0.26), $light);
                imageline($image, $centerX - (int) ($unit * 0.26), $centerY, $centerX + (int) ($unit * 0.26), $centerY, $light);
            } else {
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.27), $centerY - (int) ($unit * 0.05), $centerX - (int) ($unit * 0.02), $centerY + (int) ($unit * 0.22), $red = imagecolorallocate($image, 220, 76, 76));
                imagefilledrectangle($image, $centerX + (int) ($unit * 0.02), $centerY - (int) ($unit * 0.05), $centerX + (int) ($unit * 0.27), $centerY + (int) ($unit * 0.22), $yellow);
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.14), $centerY - (int) ($unit * 0.3), $centerX + (int) ($unit * 0.14), $centerY - (int) ($unit * 0.08), $accent);
            }

            return true;
        }

        if ('office' === $category) {
            if ('pen' === $variant || 'pencil' === $variant) {
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.05), $centerY - (int) ($unit * 0.27), $centerX + (int) ($unit * 0.05), $centerY + (int) ($unit * 0.23), $accent);
                imagefilledpolygon($image, [$centerX - (int) ($unit * 0.05), $centerY + (int) ($unit * 0.23), $centerX + (int) ($unit * 0.05), $centerY + (int) ($unit * 0.23), $centerX, $centerY + (int) ($unit * 0.34)], 3, $dark);
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.06), $centerY - (int) ($unit * 0.28), $centerX + (int) ($unit * 0.06), $centerY - (int) ($unit * 0.2), $yellow);
            } elseif ('stapler' === $variant) {
                imagefilledpolygon($image, [$centerX - (int) ($unit * 0.28), $centerY + (int) ($unit * 0.13), $centerX - (int) ($unit * 0.16), $centerY - (int) ($unit * 0.15), $centerX + (int) ($unit * 0.25), $centerY - (int) ($unit * 0.15), $centerX + (int) ($unit * 0.29), $centerY + (int) ($unit * 0.13)], 4, $accent);
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.28), $centerY + (int) ($unit * 0.13), $centerX + (int) ($unit * 0.29), $centerY + (int) ($unit * 0.2), $dark);
            } else {
                imagefilledrectangle($image, $centerX - (int) ($unit * 0.2), $centerY - (int) ($unit * 0.28), $centerX + (int) ($unit * 0.2), $centerY + (int) ($unit * 0.28), $light);
                if ('folder' === $variant) {
                    imagefilledrectangle($image, $centerX - (int) ($unit * 0.26), $centerY - (int) ($unit * 0.2), $centerX - (int) ($unit * 0.02), $centerY - (int) ($unit * 0.12), $yellow);
                }
                foreach ([-2, -1, 0, 1, 2] as $line) {
                    imageline($image, $centerX - (int) ($unit * 0.12), $centerY + (int) ($line * $unit * 0.08), $centerX + (int) ($unit * 0.12), $centerY + (int) ($line * $unit * 0.08), $accent);
                }
            }

            return true;
        }

        return false;
    }

    private static function drawProductItem($image, $variant, $centerX, $centerY, $unit, $accent, $dark, $light, $shadow)
    {
        if ('bottle' === $variant || 'jar' === $variant) {
            $bodyTop = $centerY - (int) ($unit * 0.2);
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.17), $bodyTop, $centerX + (int) ($unit * 0.17), $centerY + (int) ($unit * 0.28), $accent);
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.08), $centerY - (int) ($unit * 0.31), $centerX + (int) ($unit * 0.08), $bodyTop, $accent);
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.1), $centerY - (int) ($unit * 0.35), $centerX + (int) ($unit * 0.1), $centerY - (int) ($unit * 0.3), $dark);
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.17), $centerY, $centerX + (int) ($unit * 0.17), $centerY + (int) ($unit * 0.05), $light);

            return;
        }

        if ('bag' === $variant) {
            imagefilledpolygon($image, [$centerX - (int) ($unit * 0.25), $centerY - (int) ($unit * 0.15), $centerX + (int) ($unit * 0.25), $centerY - (int) ($unit * 0.15), $centerX + (int) ($unit * 0.2), $centerY + (int) ($unit * 0.28), $centerX - (int) ($unit * 0.2), $centerY + (int) ($unit * 0.28)], 4, $accent);
            imagearc($image, $centerX, $centerY - (int) ($unit * 0.12), (int) ($unit * 0.24), (int) ($unit * 0.24), 180, 360, $dark);

            return;
        }

        $boxWidth = (int) ($unit * 0.48);
        $boxHeight = (int) ($unit * 0.42);
        $left = $centerX - (int) ($boxWidth / 2);
        $top = $centerY - (int) ($boxHeight / 2);
        imagefilledrectangle($image, $left + 4, $top + 7, $left + $boxWidth + 4, $top + $boxHeight + 7, $shadow);
        imagefilledrectangle($image, $left, $top, $left + $boxWidth, $top + $boxHeight, $accent);
        imagefilledrectangle($image, $left, $top, $left + $boxWidth, $top + (int) ($boxHeight * 0.2), $dark);
        imagefilledrectangle($image, $left + (int) ($boxWidth * 0.42), $top + (int) ($boxHeight * 0.2), $left + (int) ($boxWidth * 0.58), $top + $boxHeight, $light);
        imagefilledrectangle($image, $left + (int) ($boxWidth * 0.2), $top + (int) ($boxHeight * 0.52), $left + (int) ($boxWidth * 0.34), $top + (int) ($boxHeight * 0.72), $light);
    }

    private static function drawFoodItem($image, $variant, $centerX, $centerY, $unit, $accent, $dark, $light, $red, $green, $yellow)
    {
        if ('bread' === $variant) {
            imagefilledellipse($image, $centerX, $centerY, (int) ($unit * 0.62), (int) ($unit * 0.4), $yellow);
            foreach ([-1, 0, 1] as $slice) {
                imageline($image, $centerX + (int) ($slice * $unit * 0.13), $centerY - (int) ($unit * 0.12), $centerX + (int) ($slice * $unit * 0.13), $centerY + (int) ($unit * 0.08), $light);
            }

            return;
        }

        if ('cheese' === $variant) {
            imagefilledpolygon($image, [$centerX - (int) ($unit * 0.3), $centerY + (int) ($unit * 0.2), $centerX + (int) ($unit * 0.3), $centerY + (int) ($unit * 0.2), $centerX + (int) ($unit * 0.12), $centerY - (int) ($unit * 0.25)], 3, $yellow);
            foreach ([[-0.08, 0.04], [0.12, 0.12], [0.08, -0.08]] as $hole) {
                imagefilledellipse($image, $centerX + (int) ($unit * $hole[0]), $centerY + (int) ($unit * $hole[1]), (int) ($unit * 0.07), (int) ($unit * 0.07), $light);
            }

            return;
        }

        if ('carrot' === $variant) {
            imagefilledpolygon($image, [$centerX - (int) ($unit * 0.16), $centerY - (int) ($unit * 0.2), $centerX + (int) ($unit * 0.16), $centerY - (int) ($unit * 0.2), $centerX, $centerY + (int) ($unit * 0.32)], 3, $red);
            imageline($image, $centerX, $centerY - (int) ($unit * 0.2), $centerX - (int) ($unit * 0.11), $centerY - (int) ($unit * 0.34), $green);
            imageline($image, $centerX, $centerY - (int) ($unit * 0.2), $centerX + (int) ($unit * 0.11), $centerY - (int) ($unit * 0.34), $green);

            return;
        }

        if ('fish' === $variant) {
            imagefilledellipse($image, $centerX, $centerY, (int) ($unit * 0.5), (int) ($unit * 0.32), $accent);
            imagefilledpolygon($image, [$centerX + (int) ($unit * 0.23), $centerY, $centerX + (int) ($unit * 0.4), $centerY - (int) ($unit * 0.14), $centerX + (int) ($unit * 0.4), $centerY + (int) ($unit * 0.14)], 3, $red);
            imagefilledellipse($image, $centerX - (int) ($unit * 0.13), $centerY - (int) ($unit * 0.04), (int) ($unit * 0.04), (int) ($unit * 0.04), $dark);

            return;
        }

        if ('banana' === $variant) {
            imagefilledellipse($image, $centerX, $centerY, (int) ($unit * 0.58), (int) ($unit * 0.25), $yellow);
            imageline($image, $centerX - (int) ($unit * 0.27), $centerY, $centerX + (int) ($unit * 0.27), $centerY, $light);
            return;
        }

        imagefilledellipse($image, $centerX - (int) ($unit * 0.1), $centerY + (int) ($unit * 0.03), (int) ($unit * 0.34), (int) ($unit * 0.38), $red);
        imagefilledellipse($image, $centerX + (int) ($unit * 0.1), $centerY + (int) ($unit * 0.03), (int) ($unit * 0.34), (int) ($unit * 0.38), $red);
        imageline($image, $centerX, $centerY - (int) ($unit * 0.14), $centerX + 4, $centerY - (int) ($unit * 0.27), $dark);
        imagefilledellipse($image, $centerX + (int) ($unit * 0.09), $centerY - (int) ($unit * 0.22), (int) ($unit * 0.2), (int) ($unit * 0.09), $green);
    }

    private static function drawContainerItem($image, $category, $variant, $centerX, $centerY, $unit, $accent, $dark, $light, $yellow)
    {
        if ('beauty' === $category && 'soap' === $variant) {
            imagefilledellipse($image, $centerX, $centerY, (int) ($unit * 0.48), (int) ($unit * 0.28), $accent);
            imageellipse($image, $centerX, $centerY, (int) ($unit * 0.48), (int) ($unit * 0.28), $dark);
            return;
        }

        if ('beauty' === $category && 'brush' === $variant) {
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.06), $centerY - (int) ($unit * 0.22), $centerX + (int) ($unit * 0.06), $centerY + (int) ($unit * 0.3), $accent);
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.15), $centerY - (int) ($unit * 0.3), $centerX + (int) ($unit * 0.15), $centerY - (int) ($unit * 0.18), $dark);
            for ($bristle = -2; $bristle <= 2; $bristle++) {
                imageline($image, $centerX + (int) ($bristle * $unit * 0.045), $centerY - (int) ($unit * 0.3), $centerX + (int) ($bristle * $unit * 0.045), $centerY - (int) ($unit * 0.38), $light);
            }
            return;
        }

        if ('beverage' === $category && in_array($variant, ['can', 'coffee'], true)) {
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.17), $centerY - (int) ($unit * 0.27), $centerX + (int) ($unit * 0.17), $centerY + (int) ($unit * 0.27), $accent);
            imagefilledellipse($image, $centerX, $centerY - (int) ($unit * 0.27), (int) ($unit * 0.34), (int) ($unit * 0.07), $light);
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.17), $centerY - (int) ($unit * 0.04), $centerX + (int) ($unit * 0.17), $centerY + (int) ($unit * 0.04), 'coffee' === $variant ? $dark : $yellow);
            return;
        }

        if ('beverage' === $category && 'cup' === $variant) {
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.2), $centerY - (int) ($unit * 0.12), $centerX + (int) ($unit * 0.2), $centerY + (int) ($unit * 0.2), $accent);
            imagearc($image, $centerX + (int) ($unit * 0.2), $centerY, (int) ($unit * 0.24), (int) ($unit * 0.22), 270, 90, $dark);
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.25), $centerY + (int) ($unit * 0.2), $centerX + (int) ($unit * 0.25), $centerY + (int) ($unit * 0.24), $dark);
            return;
        }

        $bodyWidth = (int) ($unit * 0.3);
        $bodyHeight = (int) ($unit * 0.43);
        imagefilledrectangle($image, $centerX - (int) ($bodyWidth / 2), $centerY - (int) ($bodyHeight / 2), $centerX + (int) ($bodyWidth / 2), $centerY + (int) ($bodyHeight / 2), $accent);
        imagefilledrectangle($image, $centerX - (int) ($bodyWidth * 0.25), $centerY - (int) ($bodyHeight / 2) - (int) ($unit * 0.12), $centerX + (int) ($bodyWidth * 0.25), $centerY - (int) ($bodyHeight / 2), $dark);
        imagefilledrectangle($image, $centerX - (int) ($bodyWidth / 2), $centerY - (int) ($unit * 0.012), $centerX + (int) ($bodyWidth / 2), $centerY + (int) ($unit * 0.012), $light);
    }

    private static function drawVehicle($image, $variant, $centerX, $centerY, $unit, $accent, $dark, $light, $shadow)
    {
        if ('motorcycle' === $variant || 'bicycle' === $variant) {
            $wheelSize = (int) ($unit * ('bicycle' === $variant ? 0.2 : 0.17));
            $leftWheelX = $centerX - (int) ($unit * 0.25);
            $rightWheelX = $centerX + (int) ($unit * 0.25);
            $wheelY = $centerY + (int) ($unit * 0.16);
            imageellipse($image, $leftWheelX, $wheelY, $wheelSize, $wheelSize, $dark);
            imageellipse($image, $rightWheelX, $wheelY, $wheelSize, $wheelSize, $dark);
            imageline($image, $leftWheelX, $wheelY, $centerX - (int) ($unit * 0.02), $centerY - (int) ($unit * 0.04), $accent);
            imageline($image, $centerX - (int) ($unit * 0.02), $centerY - (int) ($unit * 0.04), $rightWheelX, $wheelY, $accent);
            imageline($image, $leftWheelX, $wheelY, $centerX + (int) ($unit * 0.08), $wheelY, $accent);
            imageline($image, $centerX + (int) ($unit * 0.08), $wheelY, $centerX - (int) ($unit * 0.02), $centerY - (int) ($unit * 0.04), $accent);
            if ('motorcycle' === $variant) {
                imagefilledellipse($image, $centerX, $centerY + (int) ($unit * 0.03), (int) ($unit * 0.34), (int) ($unit * 0.16), $accent);
                imageline($image, $centerX + (int) ($unit * 0.16), $centerY - (int) ($unit * 0.04), $rightWheelX, $wheelY, $dark);
            } else {
                imageline($image, $rightWheelX, $wheelY, $rightWheelX + (int) ($unit * 0.04), $centerY - (int) ($unit * 0.08), $dark);
                imageline($image, $centerX - (int) ($unit * 0.02), $centerY - (int) ($unit * 0.04), $centerX - (int) ($unit * 0.14), $centerY - (int) ($unit * 0.08), $dark);
            }

            return;
        }

        if ('truck' === $variant || 'bus' === $variant) {
            $left = $centerX - (int) ($unit * 0.38);
            $right = $centerX + (int) ($unit * 0.38);
            $top = $centerY - (int) ($unit * 0.19);
            $bottom = $centerY + (int) ($unit * 0.13);
            imagefilledrectangle($image, $left + 3, $top + 6, $right + 3, $bottom + 6, $shadow);
            imagefilledrectangle($image, $left, $top, $right, $bottom, $accent);
            $windowCount = 'bus' === $variant ? 4 : 2;
            for ($window = 0; $window < $windowCount; $window++) {
                $windowX = $left + (int) ($unit * (0.07 + $window * (0.58 / $windowCount)));
                imagefilledrectangle($image, $windowX, $top + 5, $windowX + (int) ($unit * 0.1), $top + (int) ($unit * 0.09), $light);
            }
            imagefilledellipse($image, $centerX - (int) ($unit * 0.23), $bottom, (int) ($unit * 0.17), (int) ($unit * 0.17), $dark);
            imagefilledellipse($image, $centerX + (int) ($unit * 0.23), $bottom, (int) ($unit * 0.17), (int) ($unit * 0.17), $dark);

            return;
        }

        $bodyLeft = $centerX - (int) ($unit * 0.38);
        $bodyRight = $centerX + (int) ($unit * 0.38);
        $bodyTop = $centerY - (int) ($unit * ('suv' === $variant ? 0.12 : 0.02));
        $bodyBottom = $centerY + (int) ($unit * 0.19);
        imagefilledrectangle($image, $bodyLeft + 3, $bodyTop + 6, $bodyRight + 3, $bodyBottom + 6, $shadow);
        imagefilledrectangle($image, $bodyLeft, $bodyTop, $bodyRight, $bodyBottom, $accent);
        imagefilledrectangle($image, $centerX - (int) ($unit * 0.22), $centerY - (int) ($unit * 0.2), $centerX + (int) ($unit * 0.2), $bodyTop, $accent);
        imagefilledrectangle($image, $centerX - (int) ($unit * 0.17), $centerY - (int) ($unit * 0.16), $centerX - 3, $bodyTop - 2, $light);
        imagefilledrectangle($image, $centerX + 3, $centerY - (int) ($unit * 0.16), $centerX + (int) ($unit * 0.15), $bodyTop - 2, $light);
        imagefilledellipse($image, $centerX - (int) ($unit * 0.22), $bodyBottom, (int) ($unit * 0.18), (int) ($unit * 0.18), $dark);
        imagefilledellipse($image, $centerX + (int) ($unit * 0.22), $bodyBottom, (int) ($unit * 0.18), (int) ($unit * 0.18), $dark);
        imagefilledellipse($image, $centerX - (int) ($unit * 0.22), $bodyBottom, (int) ($unit * 0.08), (int) ($unit * 0.08), $light);
        imagefilledellipse($image, $centerX + (int) ($unit * 0.22), $bodyBottom, (int) ($unit * 0.08), (int) ($unit * 0.08), $light);
    }

    private static function drawSportsItem($image, $variant, $centerX, $centerY, $unit, $accent, $dark, $light, $shadow, $yellow)
    {
        if ('racket' === $variant) {
            imageellipse($image, $centerX, $centerY - (int) ($unit * 0.1), (int) ($unit * 0.35), (int) ($unit * 0.44), $accent);
            imageline($image, $centerX, $centerY + (int) ($unit * 0.1), $centerX, $centerY + (int) ($unit * 0.36), $dark);
            imageline($image, $centerX - (int) ($unit * 0.12), $centerY - (int) ($unit * 0.1), $centerX + (int) ($unit * 0.12), $centerY - (int) ($unit * 0.1), $light);
            imageline($image, $centerX, $centerY - (int) ($unit * 0.3), $centerX, $centerY + (int) ($unit * 0.1), $light);

            return;
        }

        if ('weights' === $variant) {
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.24), $centerY - (int) ($unit * 0.04), $centerX + (int) ($unit * 0.24), $centerY + (int) ($unit * 0.04), $dark);
            foreach ([-1, 1] as $side) {
                imagefilledrectangle($image, $centerX + (int) ($side * $unit * 0.2) - (int) ($unit * 0.07), $centerY - (int) ($unit * 0.18), $centerX + (int) ($side * $unit * 0.2) + (int) ($unit * 0.07), $centerY + (int) ($unit * 0.18), $accent);
            }

            return;
        }

        if ('tent' === $variant) {
            imagefilledpolygon($image, [$centerX - (int) ($unit * 0.36), $centerY + (int) ($unit * 0.25), $centerX, $centerY - (int) ($unit * 0.3), $centerX + (int) ($unit * 0.36), $centerY + (int) ($unit * 0.25)], 3, $accent);
            imagefilledpolygon($image, [$centerX - (int) ($unit * 0.05), $centerY + (int) ($unit * 0.25), $centerX, $centerY - (int) ($unit * 0.03), $centerX + (int) ($unit * 0.13), $centerY + (int) ($unit * 0.25)], 3, $light);

            return;
        }

        if ('trophy' === $variant) {
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.05), $centerY + (int) ($unit * 0.12), $centerX + (int) ($unit * 0.05), $centerY + (int) ($unit * 0.27), $dark);
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.2), $centerY + (int) ($unit * 0.27), $centerX + (int) ($unit * 0.2), $centerY + (int) ($unit * 0.33), $dark);
            imagefilledrectangle($image, $centerX - (int) ($unit * 0.18), $centerY - (int) ($unit * 0.24), $centerX + (int) ($unit * 0.18), $centerY + (int) ($unit * 0.11), $yellow);
            imagearc($image, $centerX - (int) ($unit * 0.18), $centerY - (int) ($unit * 0.08), (int) ($unit * 0.2), (int) ($unit * 0.26), 270, 90, $yellow);
            imagearc($image, $centerX + (int) ($unit * 0.18), $centerY - (int) ($unit * 0.08), (int) ($unit * 0.2), (int) ($unit * 0.26), 90, 270, $yellow);

            return;
        }

        if ('bicycle' === $variant) {
            self::drawVehicle($image, 'bicycle', $centerX, $centerY, $unit, $accent, $dark, $light, $shadow);

            return;
        }

        imagefilledellipse($image, $centerX, $centerY, (int) ($unit * 0.54), (int) ($unit * 0.54), $accent);
        imageline($image, $centerX - (int) ($unit * 0.23), $centerY, $centerX + (int) ($unit * 0.23), $centerY, $light);
        imageline($image, $centerX, $centerY - (int) ($unit * 0.23), $centerX, $centerY + (int) ($unit * 0.23), $light);
        imageellipse($image, $centerX, $centerY, (int) ($unit * 0.28), (int) ($unit * 0.54), $light);
    }

    /**
     * Apply a bounded random variation to a palette color.
     *
     * @param array<int, int> $rgb
     * @return array<int, int>
     */
    private static function varyColor(array $rgb, $range)
    {
        foreach ($rgb as $index => $channel) {
            $rgb[$index] = max(0, min(255, $channel + mt_rand(-$range, $range)));
        }

        return $rgb;
    }

    /**
     * Render a short label using GD's built-in font when no TTF font was supplied.
     */
    public static function drawFallbackText($image, $width, $height, $text)
    {
        $text = trim(preg_replace('/\\s+/', ' ', (string) $text));
        if ('' === $text) {
            return;
        }

        $font = 4;
        $maxCharacters = max(1, (int) floor(($width - 24) / imagefontwidth($font)));
        if (strlen($text) > $maxCharacters) {
            $text = substr($text, 0, max(1, $maxCharacters - 3)) . '...';
        }

        $bannerHeight = imagefontheight($font) + 16;
        $bannerTop = max(0, $height - $bannerHeight);
        $bannerColor = imagecolorallocate($image, 255, 255, 255);
        $textColor = imagecolorallocate($image, 35, 42, 55);
        imagefilledrectangle($image, 0, $bannerTop, $width, $height, $bannerColor);

        $textWidth = imagefontwidth($font) * strlen($text);
        $x = max(4, (int) (($width - $textWidth) / 2));
        $y = $bannerTop + (int) (($bannerHeight - imagefontheight($font)) / 2);
        imagestring($image, $font, $x, $y, $text, $textColor);
    }

    private static function drawBuilding($image, $centerX, $centerY, $unit, $accent, $dark, $light, $shadow)
    {
        $buildingWidth = (int) ($unit * 0.48);
        $buildingHeight = (int) ($unit * 0.58);
        $left = $centerX - (int) ($buildingWidth / 2);
        $top = $centerY - (int) ($buildingHeight / 2);
        imagefilledrectangle($image, $left + 4, $top + 7, $left + $buildingWidth + 4, $top + $buildingHeight + 7, $shadow);
        imagefilledrectangle($image, $left, $top, $left + $buildingWidth, $top + $buildingHeight, $accent);
        imagefilledrectangle($image, $left - (int) ($buildingWidth * 0.08), $top, $left + $buildingWidth + (int) ($buildingWidth * 0.08), $top + (int) ($unit * 0.06), $dark);
        $windowWidth = max(2, (int) ($unit * 0.07));
        $windowHeight = max(2, (int) ($unit * 0.09));
        foreach ([-1, 0, 1] as $column) {
            foreach ([-1, 0] as $row) {
                $windowX = $centerX + (int) ($column * $unit * 0.13);
                $windowY = $centerY + (int) ($row * $unit * 0.17) - (int) ($unit * 0.04);
                imagefilledrectangle($image, $windowX - (int) ($windowWidth / 2), $windowY, $windowX + (int) ($windowWidth / 2), $windowY + $windowHeight, $light);
            }
        }
        imagefilledrectangle($image, $centerX - (int) ($unit * 0.055), $top + $buildingHeight - (int) ($unit * 0.18), $centerX + (int) ($unit * 0.055), $top + $buildingHeight, $dark);
    }

    private static function allocateColor($image, array $rgb)
    {
        return imagecolorallocate($image, $rgb[0], $rgb[1], $rgb[2]);
    }
}
