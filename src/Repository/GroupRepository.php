<?php

declare(strict_types=1);

namespace BitBag\SyliusProductAttributeGroupsPlugin\Repository;

use BitBag\SyliusProductAttributeGroupsPlugin\Entity\Attribute;
use Doctrine\ORM\Query\Expr\Join;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Product\Model\ProductAttribute;
use Sylius\Component\Product\Model\ProductAttributeTranslation;

class GroupRepository extends EntityRepository implements GroupRepositoryInterface
{
    public function findAttributesById(int $id, string $locale): array
    {
        $results = $this->createQueryBuilder('g')
           ->select('pat.name')
           ->innerJoin(Attribute::class, 'a', Join::WITH, 'g.id = a.group')
           ->innerJoin(ProductAttribute::class, 'pa', Join::WITH, 'a.syliusAttribute = pa.id')
           ->innerJoin(ProductAttributeTranslation::class, 'pat', Join::WITH, 'pa.id = pat.translatable')
           ->where('g.id = :id')
           ->andWhere('pat.locale = :locale')
           ->setParameters(['id' => $id, 'locale' => $locale])
           ->addGroupBy('pat.name')
           ->orderBy('pat.name')
           ->getQuery()
           ->getResult();

        return array_map(fn (array $item) => $item['name'], $results);
    }
}
