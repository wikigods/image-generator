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

### 2) Uso con Faker (automatico)

Después de instalar el paquete, puedes usar:

```php
$path = fake()->image(
    storage_path('app/public/images'),
    'Seeder Image',
    resource_path('fonts/Nunito-Regular.ttf'),
    300,
    200,
    true,
    'jpg'
);
```

No necesitas llamar `addProvider(...)` manualmente.

## Firma del metodo

```php
image(
    $dir = null,
    $text = null,
    $fontPath = null,
    $width = 640,
    $height = 480,
    $fullPath = true,
    $format = 'png'
)
```

## Parametros

- `$dir`: Directorio destino. Si es `null`, usa el directorio temporal del sistema.
- `$text`: Texto opcional para dibujar.
- `$fontPath`: Ruta a fuente `.ttf` (requerida si quieres renderizar texto).
- `$width`: Ancho de imagen.
- `$height`: Alto de imagen.
- `$fullPath`: Si es `true`, retorna ruta completa; si es `false`, solo nombre del archivo.
- `$format`: `png` o `jpg`.

## Requisitos

- PHP con extensión `ext-gd`.
- Permisos de escritura en el directorio de salida.

## Testing

```bash
vendor/bin/phpunit
```
