# WikiGods Image Generator

Generador de imágenes dinámicas para Laravel con integración automática en Faker.

## Instalacion

```bash
composer require wikigods/image-generator
```

No necesitas registrar el provider manualmente en Laravel moderno (autodiscovery).

## Que hace este paquete

- Genera imágenes PNG o JPG con fondo aleatorio.
- Puede renderizar texto centrado en múltiples líneas usando una fuente `.ttf`.
- Integra automáticamente un provider de Faker para que `fake()->image()` use este paquete.

## Uso rapido

### 1) Uso directo

```php
use WikiGods\ImageGenerator\Facades\ImageGenerator;

$path = ImageGenerator::image(
    dir: storage_path('app/public/images'),
    text: 'Hola Mundo',
    fontPath: resource_path('fonts/Nunito-Regular.ttf'),
    width: 640,
    height: 480,
    fullPath: true,
    format: 'png'
);
```

### 2) Uso con Faker (automático)

Laravel registra el provider del paquete mediante Composer autodiscovery. Al resolver Faker, el paquete agrega su provider automáticamente; no necesitas llamar `addProvider(...)`.

La firma mantiene primero los argumentos habituales de Faker (`dir`, `width`, `height`, `fullPath`, `aImageType`, `thumbsDir`). Para generar una imagen con texto, agrega `text` y `fontPath` al final:

```php
$path = fake()->image(
    storage_path('app/public/images'),
    300,
    200,
    true,
    'jpg',
    null,
    'Seeder Image',
    resource_path('fonts/Nunito-Regular.ttf')
);
```

`thumbsDir` se acepta para mantener compatibilidad con la firma de Faker; este paquete genera la imagen localmente y no lo utiliza.

## Firma del metodo

```php
image(
    $dir = null,
    $width = 640,
    $height = 480,
    $fullPath = true,
    $aImageType = null,
    $thumbsDir = null,
    $text = null,
    $fontPath = null
)
```

## Parametros

- `$dir`: Directorio destino. Si es `null`, usa el directorio temporal del sistema.
- `$text`: Texto opcional para dibujar.
- `$fontPath`: Ruta a fuente `.ttf` (requerida si quieres renderizar texto).
- `$width`: Ancho de imagen.
- `$height`: Alto de imagen.
- `$fullPath`: Si es `true`, retorna ruta completa; si es `false`, solo nombre del archivo.
- `$aImageType`: formato de salida (`png` o `jpg`); si es `null`, usa `png`.
- `$thumbsDir`: argumento compatible con Faker; no se utiliza porque las imágenes se generan localmente.
- `$text` y `$fontPath`: opciones adicionales del paquete para dibujar texto usando una fuente `.ttf`.

## Requisitos

- PHP con extensión `ext-gd`.
- Permisos de escritura en el directorio de salida.

## Testing

```bash
vendor/bin/phpunit
```
