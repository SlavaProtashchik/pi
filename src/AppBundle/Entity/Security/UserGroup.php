<?php
namespace AppBundle\Entity\Security;

use Sonata\UserBundle\Entity\BaseGroup;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Group
 * @package AppBundle\Entity\Security
 *
 * @ORM\Entity
 * @ORM\Table(name="user_group")
 */
class UserGroup extends BaseGroup
{
    /**
     * @var int $id
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Get id
     *
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }
}
