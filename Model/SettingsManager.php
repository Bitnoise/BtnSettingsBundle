<?php

namespace Btn\SettingsBundle\Model;


use Doctrine\ORM\EntityManager;

/**
 * Settings Manager
 *
 * @package btn.settings
 * @author michalsoczynski
 **/
class SettingsManager
{
    /**
     * Constructor.
     *
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->repo = $em->getRepository('BtnSettingsBundle:Settings');
    }

    /**
     * Find all entities from database Settings
     *
     * @return array
     *
     **/
    public function findAll()
    {
        $arr = array();
        $entities = $this->repo->findAll();

        //rewrite entity data to array via keys
        foreach ($entities as $entity) {
            $arr[$entity->getKey()] = $entity->getValue();
        }

        return $arr;
    }
}
