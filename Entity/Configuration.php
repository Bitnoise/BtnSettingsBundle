<?php

namespace Btn\SettingsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Configuration
 *
 * @ORM\Table(name="configuration")
 * @ORM\Entity
 */
class Configuration
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="keyId", type="string", length=60)
     */
    private $keyId;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=255)
     */
    private $value;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set keyId
     *
     * @param string $keyId
     * @return Configuration
     */
    public function setKeyId($keyId)
    {
        $this->keyId = $keyId;

        return $this;
    }

    /**
     * Get keyId
     *
     * @return string
     */
    public function getKeyId()
    {
        return $this->keyId;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return Configuration
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}
