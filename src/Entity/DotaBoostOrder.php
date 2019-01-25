<?php
/**
 * Created by PhpStorm.
 * User: eqinex
 * Date: 19.01.19
 * Time: 20:30
 */

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * DotaBoostOrder
 *
 * @ORM\Table(name="dota_boost_order")
 * @ORM\Entity(repositoryClass="App\Repository\DotaBoostOrderRepository")
 */
class DotaBoostOrder
{
    const DOTA_BOOST_ORDER_STATUS_NEW = 1;
    const DOTA_BOOST_ORDER_STATUS_IN_PROGRESS = 2;
    const DOTA_BOOST_ORDER_STATUS_DONE = 3;
    const DOTA_BOOST_ORDER_STATUS_CANCELLED = 4;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255, unique=true, nullable=true)
     */
    protected $code;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status = 1;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title = "";

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description = "";

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", name="start_at", nullable=true)
     */
    private $startAt;

    /**
     * @ORM\Column(type="datetime", name="end_at", nullable=true)
     */
    private $endAt;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    private $owner;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="responsible_user_id", referencedColumnName="id")
     */
    private $responsibleUser;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->status = self::DOTA_BOOST_ORDER_STATUS_NEW;
    }

    /**
     * Get id
     *
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set code
     * @param string $code
     * @return DotaBoostOrder
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }


    /**
     * @param string $title
     * @return DotaBoostOrder
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return DotaBoostOrder
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getStartAt()
    {
        return $this->startAt;
    }

    /**
     * @param \DateTime $startAt
     */
    public function setStartAt($startAt)
    {
        $this->startAt = $startAt;
    }

    /**
     * @return \DateTime
     */
    public function getEndAt()
    {
        return $this->endAt;
    }

    /**
     * @param \DateTime $endAt
     */
    public function setEndAt($endAt)
    {
        $this->endAt = $endAt;
    }

    /**
     * Set owner
     *
     * @param User $owner
     *
     * @return $this
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return User
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function isOwner(User $user)
    {
        return $this->owner->getId() == $user->getId();
    }

    /**
     * Set responsibleUser
     *
     * @param User $responsibleUser
     *
     * @return $this
     */
    public function setResponsibleUser($responsibleUser)
    {
        $this->responsibleUser = $responsibleUser;

        return $this;
    }

    /**
     * Get responsibleUser
     *
     * @return User
     */
    public function getResponsibleUser()
    {
        return $this->responsibleUser;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function isResponsibleUser(User $user)
    {
        return $this->responsibleUser->getId() == $user->getId();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getTitle();
    }

    /**
     * @return array
     */
    public static function getStatusesList()
    {
        return [
            self::DOTA_BOOST_ORDER_STATUS_NEW => 'new',
            self::DOTA_BOOST_ORDER_STATUS_IN_PROGRESS => 'in_progress',
            self::DOTA_BOOST_ORDER_STATUS_DONE => 'done',
            self::DOTA_BOOST_ORDER_STATUS_CANCELLED => 'cancelled',
        ];
    }
}