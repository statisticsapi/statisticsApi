<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Hotel
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="hotel", indexes={
 *     @ORM\Index(name="IDX_HOTEL_ID", columns={"id"}),
 * })
 * @ORM\Entity(repositoryClass="App\Repository\HotelRepository")
 *
 */
class Hotel
{
    /**
     * The unique auto incremented primary key.
     *
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer", options={"unsigned":true})
     */
    private $id;

    /**
     * The name of the hotel.
     *
     * @var string
     *
     *
     * @ORM\Column(name="name", type="string", length=255, unique=false, nullable=false)
     */
    private $name;

    /**
     * Asset constructor.
     * @throws \Exception
     */
    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

}
