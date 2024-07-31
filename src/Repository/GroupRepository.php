<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\SyliusProductAttributeGroupsPlugin\Repository;

use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

class GroupRepository extends EntityRepository implements GroupRepositoryInterface
{
    public function findAttributesById(int $id, string $locale): array
    {
        $results = $this->createQueryBuilder('g')
           ->select('pat.name')
           ->innerJoin('g.attributes', 'a')
           ->innerJoin('a.syliusAttribute', 'pa')
           ->innerJoin('pa.translations', 'pat')
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
