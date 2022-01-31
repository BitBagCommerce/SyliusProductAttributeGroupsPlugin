<?php

namespace BitBag\SyliusProductAttributeGroupsPlugin\Repository;

use BitBag\SyliusProductAttributeGroupsPlugin\Entity\Attribute;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Product\Model\ProductAttribute;
use Sylius\Component\Product\Model\ProductAttributeTranslation;

class GroupRepository extends EntityRepository implements GroupRepositoryInterface
{
    public function findAttributesById(int $id, string $locale): array
    {
       $results = $this->createQueryBuilder('g')
           ->select('pat.name')
           ->innerJoin(Attribute::class, 'a')
           ->innerJoin(ProductAttribute::class, 'pa')
           ->innerJoin(ProductAttributeTranslation::class, 'pat')
           ->where('g.id = :id')
           ->andWhere('pat.locale = :locale')
           ->setParameters(['id' => $id, 'locale' => $locale])
           ->addGroupBy('pat.name')
           ->orderBy('pat.name')
           ->getQuery()
           ->getResult();

       return array_map(fn(array $item) => $item['name'], $results);
    }
}