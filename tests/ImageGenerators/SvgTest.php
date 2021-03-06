<?php

namespace Spatie\MediaLibrary\Test\ImageGenerators;

use Spatie\MediaLibrary\ImageGenerators\FileTypes\Svg;
use Spatie\MediaLibrary\Test\TestCase;

class SvgTest extends TestCase
{
    /** @test */
    public function it_can_convert_a_svg()
    {
        $imageGenerator = new Svg();

        if (! $imageGenerator->requirementsAreInstalled()) {
            $this->markTestSkipped('Skipping svg test because requirements to run it are not met');
        }

        $media = $this->testModelWithoutMediaConversions->addMedia($this->getTestSvg())->toMediaLibrary();

        $this->assertTrue($imageGenerator->canConvert($media->getPath()));

        $imageFile = $imageGenerator->convert($media->getPath());

        $this->assertEquals('image/jpeg', mime_content_type($imageFile));
    }
}
