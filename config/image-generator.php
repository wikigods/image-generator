<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Disco de Almacenamiento
    |--------------------------------------------------------------------------
    | El disco donde se guardarán las imágenes generadas (ej. 'public', 's3').
    */
    'disk' => 'public',

    /*
    |--------------------------------------------------------------------------
    | Ruta Base
    |--------------------------------------------------------------------------
    | Carpeta dentro del disco donde se guardarán los archivos.
    */
    'path' => 'generated-images',

    /*
    |--------------------------------------------------------------------------
    | Configuración de Fuente Predeterminada
    |--------------------------------------------------------------------------
    | Ruta absoluta al archivo .ttf. Si es null, no se renderizará texto.
    */
    'font_path' => null, // ej: public_path('fonts/Roboto-Bold.ttf')

    /*
    |--------------------------------------------------------------------------
    | Ajustes de Renderizado
    |--------------------------------------------------------------------------
    */
    'padding' => 40,
    'line_spacing' => 10,
    'default_font_size' => 50,
];