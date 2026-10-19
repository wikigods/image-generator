# WikiGods Image Generator

Generador de imágenes dinámicas para Laravel con integración automática en Faker.

## Instalacion

```bash
composer require wikigods/image-generator
```

No necesitas registrar el provider manualmente en Laravel moderno (autodiscovery).

## Que hace este paquete

- Genera imágenes PNG o JPG sin conexión, con fondo aleatorio o ilustraciones por categoría.
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
    format: 'png',
    category: 'product'
);
```

Las ilustraciones se dibujan localmente con GD: no descargan imágenes ni requieren una API de IA. Las 20 categorías visuales disponibles son `product`, `food`, `beverage`, `book`, `computer`, `medicine`, `construction`, `helmet`, `harness`, `carpentry`, `furniture`, `clothing`, `car`, `hotel`, `sports`, `beauty`, `pets`, `agriculture`, `toys` y `office`. `abstract` conserva el fondo aleatorio original.

También se aceptan alias en español e inglés. Por ejemplo: `abarrotes`/`frutas` → `food`, `bebidas` → `beverage`, `libros` → `book`, `tecnología`/`computadora` → `computer`, `salud`/`medicamentos` → `medicine`, `casco` → `helmet`, `arnés` → `harness`, `carpintería`/`herramientas` → `carpentry`, `hogar`/`muebles` → `furniture`, `ropa` → `clothing`, `carro`/`bicicleta` → `car`, `hotel`/`casa` → `hotel`, `deportes` → `sports`, `higiene` → `beauty`, `mascotas` → `pets`, `jardín` → `agriculture`, `juguetes` → `toys` y `papelería` → `office`.

### 2) Uso con Faker (automático)

Laravel registra el provider del paquete mediante Composer autodiscovery. Al resolver Faker, el paquete agrega su provider automáticamente; no necesitas llamar `addProvider(...)`.

Por defecto, cada llamada a `fake()->image()` escoge una categoría al azar entre las 20 disponibles, selecciona una variante de esa categoría y genera una ilustración sin texto. Puedes fijar la categoría y variante, o pasar un nombre opcional para mostrarlo en la imagen. La generación es local con GD: crea ilustraciones estilizadas, no fotografías.

La firma mantiene primero los argumentos habituales de Faker (`dir`, `width`, `height`, `fullPath`, `aImageType`, `thumbsDir`). La imagen sale sin etiqueta por defecto. Al final puedes pasar `text`, `fontPath`, `category`, `variant` y `name`; `name` es opcional y sirve para rotular cualquier categoría:

```php
$path = fake()->image(
    storage_path('app/public/images'),
    300,
    200,
    true,
    'jpg',
    null,
    null,
    null,
    'computer',
    'ram',
    'NovaTech RAM'
);
```

Si omites la variante, el paquete escoge una al azar dentro de la categoría. Si omites el nombre, no agrega etiqueta.

También puedes usar métodos más expresivos:

```php
$ram = fake()->computerImage('ram', $dir); // imagen de RAM sin etiqueta
$computerPart = fake()->computerImage(null, $dir); // variante de computadora aleatoria
$car = fake()->categoryImage('car', $dir, 640, 480, true, 'png', 'sedan', 'Sedán azul');
```

Cada categoría tiene su propio catálogo de variantes y elige una al azar si no indicas cuál. Por ejemplo, `food` ofrece `apple`, `banana`, `bread`, `cheese`, `carrot` y `fish`; `computer` ofrece `laptop`, `desktop`, `monitor`, `ram`, `hard_drive`, `ssd`, `graphics_card`, `motherboard`, `processor`, `keyboard`, `mouse` y `usb_drive`. `ImageGenerator::variants('computer')` devuelve el catálogo de esa categoría.

Las definiciones están separadas en `src/Categories/`, una clase por categoría. Cada una mantiene su paleta y sus variantes; `ImageGenerator` coordina la salida y `ImageRenderer` dibuja la ilustración con GD.

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
    $fontPath = null,
    $category = 'random',
    $variant = null,
    $name = null
)
```

## Parametros

- `$dir`: Directorio destino. Si es `null`, usa el directorio temporal del sistema.
- `$text`: Texto opcional para dibujar.
- `$fontPath`: Ruta a fuente `.ttf` opcional para el nombre o texto.
- `$width`: Ancho de imagen.
- `$height`: Alto de imagen.
- `$fullPath`: Si es `true`, retorna ruta completa; si es `false`, solo nombre del archivo.
- `$aImageType`: formato de salida (`png` o `jpg`); si es `null`, usa `png`.
- `$thumbsDir`: argumento compatible con Faker; no se utiliza porque las imágenes se generan localmente.
- `$text` y `$fontPath`: opciones adicionales para dibujar una etiqueta. Sin texto ni nombre, la imagen no incluye etiqueta.
- `$category`: estilo de imagen. Valores visuales: `abstract`, `product`, `food`, `beverage`, `book`, `computer`, `medicine`, `construction`, `helmet`, `harness`, `carpentry`, `furniture`, `clothing`, `car`, `hotel`, `sports`, `beauty`, `pets`, `agriculture`, `toys` y `office`. En Faker, `random` es el valor predeterminado. Se aceptan alias en español.
- `$variant`: variante de categoría; cada categoría tiene su propio catálogo y elige una variante al azar si se omite.
- `$name`: nombre opcional que se dibuja como etiqueta en cualquier categoría.

## Requisitos

- PHP con extensión `ext-gd`.
- Permisos de escritura en el directorio de salida.

## Testing

```bash
vendor/bin/phpunit
```

Las pruebas guardan vistas previas de las 20 categorías, las variantes de computadora y las salidas Faker en `tests/generated_images/`. La carpeta está ignorada por Git para que puedas abrir las imágenes localmente sin incluirlas en commits.
