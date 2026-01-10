<?php

namespace WikiGods\ImageGenerator\Tests;

use InvalidArgumentException;
use Orchestra\Testbench\TestCase;
use WikiGods\ImageGenerator\FakerImageGeneratorServiceProvider;
use WikiGods\ImageGenerator\ImageGenerator;

class ImageGeneratorTest extends TestCase
{
    protected $testDir;
    protected $fontPath;

    protected function setUp(): void
    {
        parent::setUp();

        $this->testDir = __DIR__ . '/temp_outputs';
        if (!is_dir($this->testDir)) {
            mkdir($this->testDir, 0777, true);
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

    /** @test */
    public function it_generates_a_png_image_with_correct_dimensions()
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

    /** @test */
    public function it_generates_a_jpg_image()
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

    /** @test */
    public function it_can_render_text_if_font_provided()
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

    /** @test */
    public function it_throws_exception_if_directory_is_not_writable()
    {
        $this->expectException(InvalidArgumentException::class);

        ImageGenerator::image('/root/invalid_dir_xyz');
    }

    /** @test */
    public function it_can_be_used_as_a_faker_provider()
    {
        $faker = \Faker\Factory::create();

        $faker->addProvider(new FakerImageGeneratorServiceProvider($faker));

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
}