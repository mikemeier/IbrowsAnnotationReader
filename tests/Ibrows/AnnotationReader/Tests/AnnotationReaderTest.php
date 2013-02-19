<?php

namespace Ibrows\AnnotationReader\Tests;

use Ibrows\AnnotationReader\AnnotationReader;

class AnnotationReaderTest extends \PHPUnit_Framework_TestCase
{
    public function testGetAnnotations()
    {
        $reader = new AnnotationReader();
        $this->assertEquals(1, 1, 'asd');
    }
}