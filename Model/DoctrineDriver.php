<?php

namespace Btn\SettingsBundle\Model;

use Btn\SettingsBundle\Model\SettingInterface;
use Btn\SettingsBundle\Entity\Setting;
use Doctrine\ORM\EntityManager;

/**
 * Settings Manager
 *
 * @package btn.settings
 * @author michalsoczynski
 **/
class DoctrineDriver implements SettingInterface
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var EntityRepository
     */
    protected $repo;

    /**
     * default values - array with key:value
     *
     * @var array
     **/
    protected $defaults;

    /**
     * Constructor.
     *
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em, $defaults = array())
    {
        $this->defaults = $defaults;
        $this->em       = $em;
        $this->repo     = $em->getRepository('BtnSettingsBundle:Setting');
    }

    /**
     * Get settings value
     *
     * @return string $value
     **/
    public function get($name)
    {
        $settings = $this->repo->findOneBy(array(
            'name' => $name,
        ));

        if ($settings === null) {
            //try from defaults
            if (isset($this->defaults[$name])) {
                //save to db from defaults
                $this->set($name, $this->defaults[$name]);

                return $this->defaults[$name];
            }
        }

        return $settings ? $settings->getValue() : '';
    }

    /**
     * Set settings value
     *
     * @return boolean
     **/
    public function set($name, $value)
    {
        $settings = $this->repo->findOneBy(array(
            'name' => $name,
        ));

        //create new one if we don't have this key in table
        if ($settings === null) {
            //create new
            $settings = new Setting();
            $settings->setName($name);
            $this->em->persist($settings);
        }

        //change value
        $settings->setValue($value);
        $this->em->flush($settings);

        return true;
    }

    /**
     * Find all entities from table Settings
     *
     * @return array
     *
     **/
    public function getAll()
    {
        $arr      = array();
        $entities = $this->repo->findAll();

        //rewrite entity data to array via keys
        foreach ($entities as $entity) {
            $arr[$entity->getName()] = $entity->getValue();
        }

        return $arr;
    }
}
