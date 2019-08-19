<?php
/**
 * Created by PhpStorm.
 * User: Eynsteyn
 * Date: 05.04.2019
 * Time: 16:11
 */

namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Seller", cascade={"persist", "remove"}, mappedBy="user")
     */
    private $seller;

    public function __construct()
    {
        parent::__construct();
    }
}




