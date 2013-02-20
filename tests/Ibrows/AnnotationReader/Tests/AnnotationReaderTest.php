<?php

namespace Ibrows\AnnotationReader\Tests;

use Ibrows\AnnotationReader\AnnotationReader;
use Ibrows\AnnotationReader\AnnotationReaderInterface;

use Ibrows\AnnotationReader\Tests\Entity\TestEntity;
use Ibrows\AnnotationReader\Tests\Annotation\TestAnnotation;

use Doctrine\Common\Annotations\AnnotationReader as DoctrineAnnotationReader;

class AnnotationReaderTest extends \PHPUnit_Framework_TestCase
{
    public function testSetAnnotationReader()
    {
        $doctrineAnnotationReader = new DoctrineAnnotationReader();
        $reader = new AnnotationReader();

        $reader->setAnnotationReader($doctrineAnnotationReader);
        $this->assertAttributeSame($doctrineAnnotationReader, 'annotationReader', $reader, 'AnnotationReader not correct setted');
    }

    public function testGetAnnotations()
    {
        $reader = $this->getReader();

        $annotations = $reader->getAnnotations(get_class($this->getTestEntity()));

        $keys = array(
            AnnotationReaderInterface::SCOPE_CLASS,
            AnnotationReaderInterface::SCOPE_METHOD,
            AnnotationReaderInterface::SCOPE_PROPERTY
        );

        foreach($keys as $scope){
            $this->assertArrayHasKey($scope, $annotations, 'Key "'. $scope .'" not found');
        }

        $this->assertEquals($this->getTestedAnnotations(), $annotations, 'Structure of Result not equal');
    }

    /**
     * @return AnnotationReader
     */
    private function getReader()
    {
        $reader = new AnnotationReader();
        $reader->setAnnotationReader(new DoctrineAnnotationReader());
        return $reader;
    }

    /**
     * @return TestEntity
     */
    private function getTestEntity()
    {
        return new TestEntity();
    }

    private function getTestedAnnotations()
    {
        return array(
            AnnotationReaderInterface::SCOPE_CLASS => array(

            ),
            AnnotationReaderInterface::SCOPE_METHOD => array(

            ),
            AnnotationReaderInterface::SCOPE_PROPERTY => array(
                'testProperty' => array(
                    'TestAnnotationInterface' => array(
                        new TestAnnotation()
                    )
                )
            )
        );
    }
}