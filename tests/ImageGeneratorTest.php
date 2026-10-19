<?php

namespace WikiGods\ImageGenerator\Tests;

use InvalidArgumentException;
use Orchestra\Testbench\TestCase;
use WikiGods\ImageGenerator\ImageGenerator;
use WikiGods\ImageGenerator\ImageGeneratorServiceProvider;

class ImageGeneratorTest extends TestCase
{
    protected $testDir;
    protected $previewDir;
    protected $fontPath;

    protected function setUp(): void
    {
        parent::setUp();

        $this->testDir = __DIR__ . '/temp_outputs';
        if (!is_dir($this->testDir)) {
            mkdir($this->testDir, 0777, true);
        }

        $this->previewDir = __DIR__ . '/generated_images';
        if (!is_dir($this->previewDir)) {
            mkdir($this->previewDir, 0777, true);
        }

        $this->fontPath = __DIR__ . '/../src/resources/fonts/Nunito-Regular.ttf';
    }

    protected function tearDown(): void
    {
        if (is_dir($this->testDir)) {
            $files = glob($this->testDir . '/*');
            foreach ($files as $file) {
                unlink($file);
            }
            rmdir($this->testDir);
        }

        parent::tearDown();
    }

    protected function getPackageProviders($app)
    {
        return [ImageGeneratorServiceProvider::class];
    }

    public function testItGeneratesAPngImageWithCorrectDimensions()
    {
        $width = 200;
        $height = 100;

        $path = ImageGenerator::image(
            $this->testDir,
            null,
            null,
            $width,
            $height,
            true,
            'png'
        );

        $this->assertFileExists($path);

        $imageInfo = getimagesize($path);

        $this->assertEquals($width, $imageInfo[0], 'El ancho de la imagen no coincide');
        $this->assertEquals($height, $imageInfo[1], 'El alto de la imagen no coincide');
        $this->assertEquals('image/png', $imageInfo['mime']);
    }

    public function testItGeneratesAJpgImage()
    {
        $path = ImageGenerator::image(
            $this->testDir,
            null,
            null,
            300,
            300,
            true,
            'jpg'
        );

        $this->assertFileExists($path);
        $imageInfo = getimagesize($path);
        $this->assertEquals('image/jpeg', $imageInfo['mime']);
    }

    public function testItGeneratesOfflineIllustrationsForAllSupportedCategories()
    {
        foreach (ImageGenerator::categories() as $category) {
            $path = ImageGenerator::image(
                $this->previewDir,
                null,
                null,
                320,
                200,
                true,
                'png',
                $category
            );

            $previewPath = $this->previewDir . DIRECTORY_SEPARATOR . $category . '.png';
            if (file_exists($previewPath)) {
                unlink($previewPath);
            }
            $this->assertTrue(rename($path, $previewPath), sprintf('No se pudo guardar la vista previa de %s.', $category));
            $path = $previewPath;

            $this->assertFileExists($path, sprintf('No se generó la imagen de %s.', $category));
            $imageInfo = getimagesize($path);
            $this->assertSame(320, $imageInfo[0]);
            $this->assertSame(200, $imageInfo[1]);
            $this->assertSame('image/png', $imageInfo['mime']);
        }
    }

    public function testFakerGeneratesDifferentRandomIllustrationsWithoutDefaultLabel()
    {
        $faker = $this->app->make(\Faker\Generator::class);
        $hashes = [];

        for ($index = 1; $index <= 5; $index++) {
            $path = $faker->image($this->previewDir, 320, 200);
            $previewPath = $this->previewDir . DIRECTORY_SEPARATOR . 'faker-random-' . $index . '.png';
            if (file_exists($previewPath)) {
                unlink($previewPath);
            }

            $this->assertTrue(rename($path, $previewPath));
            $this->assertSame('image/png', getimagesize($previewPath)['mime']);
            $image = imagecreatefrompng($previewPath);
            $bottomLeft = imagecolorsforindex($image, imagecolorat($image, 0, 199));
            $this->assertFalse(255 === $bottomLeft['red'] && 255 === $bottomLeft['green'] && 255 === $bottomLeft['blue'], 'Faker no debe dibujar un nombre por defecto.');
            imagedestroy($image);
            $hashes[] = hash_file('sha256', $previewPath);
        }

        $this->assertGreaterThan(1, count(array_unique($hashes)), 'Faker debe variar la categoría, composición o paleta entre imágenes.');
    }

    public function testFakerCanGenerateEachComputerComponentVariant()
    {
        $faker = $this->app->make(\Faker\Generator::class);

        foreach (ImageGenerator::variants('computer') as $variant) {
            $path = $faker->computerImage($variant, $this->previewDir, 320, 200);
            $previewPath = $this->previewDir . DIRECTORY_SEPARATOR . 'computer-' . $variant . '.png';
            if (file_exists($previewPath)) {
                unlink($previewPath);
            }

            $this->assertTrue(rename($path, $previewPath), sprintf('No se pudo guardar la variante %s.', $variant));
            $this->assertSame('image/png', getimagesize($previewPath)['mime']);
        }
    }

    public function testEveryCategoryAcceptsItsOwnVariantsAndOptionalNames()
    {
        $faker = $this->app->make(\Faker\Generator::class);

        foreach (ImageGenerator::categories() as $category) {
            $variants = ImageGenerator::variants($category);
            $this->assertNotEmpty($variants, sprintf('La categoría %s debe declarar variantes.', $category));

            foreach ($variants as $variant) {
                $name = 'Demo ' . ucfirst($variant);
                $path = $faker->categoryImage($category, $this->previewDir, 240, 160, true, 'png', $variant, $name);
                $previewPath = $this->previewDir . DIRECTORY_SEPARATOR . $category . '-' . $variant . '.png';
                if (file_exists($previewPath)) {
                    unlink($previewPath);
                }

                $this->assertTrue(rename($path, $previewPath));
                $this->assertSame('image/png', getimagesize($previewPath)['mime']);
            }
        }
    }

    public function testFakerImageAcceptsAnOptionalNameAfterTheVariant()
    {
        $faker = $this->app->make(\Faker\Generator::class);
        $path = $faker->image($this->previewDir, 240, 160, true, 'png', null, null, null, 'food', 'bread', 'Pan de prueba');
        $previewPath = $this->previewDir . DIRECTORY_SEPARATOR . 'faker-food-bread-named.png';
        if (file_exists($previewPath)) {
            unlink($previewPath);
        }

        $this->assertTrue(rename($path, $previewPath));
        $image = imagecreatefrompng($previewPath);
        $bottomLeft = imagecolorsforindex($image, imagecolorat($image, 0, 159));
        $this->assertSame([255, 255, 255], [$bottomLeft['red'], $bottomLeft['green'], $bottomLeft['blue']]);
        imagedestroy($image);
    }

    public function testItAcceptsSpanishCategoryAliases()
    {
        foreach (['abarrotes', 'bebidas', 'computadora', 'casco', 'arnés', 'carpintería', 'hoteles'] as $category) {
            $path = ImageGenerator::image($this->testDir, null, null, 160, 120, true, 'png', $category);
            $this->assertFileExists($path, sprintf('No se aceptó la categoría "%s".', $category));
            $this->assertSame('image/png', getimagesize($path)['mime']);
        }
    }

    public function testItGeneratesACategoryImageThroughFaker()
    {
        $faker = $this->app->make(\Faker\Generator::class);

        $path = $faker->image($this->previewDir, 300, 200, true, 'png', null, null, null, 'car');
        $previewPath = $this->previewDir . DIRECTORY_SEPARATOR . 'faker-car.png';
        if (file_exists($previewPath)) {
            unlink($previewPath);
        }
        $this->assertTrue(rename($path, $previewPath), 'No se pudo guardar la imagen generada por Faker.');
        $path = $previewPath;

        $this->assertFileExists($path);
        $imageInfo = getimagesize($path);
        $this->assertSame(300, $imageInfo[0]);
        $this->assertSame(200, $imageInfo[1]);
        $this->assertSame('image/png', $imageInfo['mime']);
    }

    public function testItCanRenderTextIfFontProvided()
    {
        if (!file_exists($this->fontPath)) {
            $this->markTestSkipped('Archivo de fuente no encontrado para test de texto.');
        }

        $text = 'WikiGods Test';

        $path = ImageGenerator::image(
            $this->testDir,
            $text,
            $this->fontPath,
            400,
            200
        );

        $this->assertFileExists($path);
    }

    public function testItThrowsExceptionIfDirectoryIsNotWritable()
    {
        $this->expectException(InvalidArgumentException::class);

        ImageGenerator::image('/root/invalid_dir_xyz');
    }

    public function testItCanBeUsedAsAFakerProvider()
    {
        $faker = $this->app->make(\Faker\Generator::class);

        $text = 'Faker Integration';

        if (!file_exists($this->fontPath)) {
            $this->markTestSkipped('Fuente no encontrada para prueba de Faker.');
        }

        $imagePath = $faker->image(
            $this->testDir,
            $text,
            $this->fontPath,
            300,
            150
        );

        $this->assertFileExists($imagePath);

        $imageInfo = getimagesize($imagePath);
        $this->assertEquals(300, $imageInfo[0]);
        $this->assertEquals(150, $imageInfo[1]);
        $this->assertStringContainsString($this->testDir, $imagePath);
    }

    public function testItReplacesFakeImageAutomaticallyWhenPackageIsLoaded()
    {
        $faker = $this->app->make(\Faker\Generator::class);

        $imagePath = $faker->image($this->testDir, null, null, 180, 90, true, 'png');

        $this->assertFileExists($imagePath);

        $imageInfo = getimagesize($imagePath);
        $this->assertEquals(180, $imageInfo[0]);
        $this->assertEquals(90, $imageInfo[1]);
        $this->assertEquals('image/png', $imageInfo['mime']);
    }
}
