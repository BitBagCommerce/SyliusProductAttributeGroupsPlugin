<?php

/*
 * This file was created by developers working at BitBag
 * Do you need more information about us and what we do? Visit our https://bitbag.io website!
 * We are hiring developers from all over the world. Join us and start your new, exciting adventure and become part of us: https://bitbag.io/career
*/

declare(strict_types=1);

namespace Tests\Unit;

use BitBag\SyliusProductAttributeGroupsPlugin\Entity\Group;
use PHPUnit\Framework\TestCase;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

final class AttributeGroupSerializationTest extends TestCase
{
    private SerializerInterface $serializer;

    private Group $attributeGroup;

    protected function setUp(): void
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [
            new DateTimeNormalizer(),
            new ArrayDenormalizer(),
            new ObjectNormalizer(
                null,
                null,
                null,
                new PropertyInfoExtractor(
                    [],
                    [new PhpDocExtractor(), new ReflectionExtractor()]
                )
            ),
        ];

        $this->serializer = new Serializer($normalizers, $encoders);;

        $this->attributeGroup = new Group();

        $this->attributeGroup->setName('test_name');
    }

    public function testResolveStatus(): void
    {
        $serializedGroupAttributes = $this->serializer->serialize($this->attributeGroup, 'json');

        self::assertEquals($this->getResult(), $serializedGroupAttributes);
    }

    public function getResult(): string
    {
        return <<<JSON
        {"name":"test_name","attributes":[],"attributeCodes":[]}
        JSON;
    }
}
