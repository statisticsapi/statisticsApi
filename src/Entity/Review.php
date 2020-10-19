<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class review
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="review", indexes={
 *     @ORM\Index(name="IDX_REVIEW_ID", columns={"id"}),
 * })
 * @ORM\Entity(repositoryClass="App\Repository\ReviewRepository")
 *
 */
class Review
{
    /**
     * The unique auto incremented primary key.
     *
     * @var int
     *
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer", options={"unsigned":true})
     */
    private $id;

    /**
     * The unique auto incremented primary key.
     *
     * @var int
     *
     *
     * @ORM\Column(name="hotel_id", type="integer", options={"unsigned":true})
     */
    private $hotelId;

    /**
     *
     * @var float
     *
     *
     * @ORM\Column(name="score", precision=2, scale=2, type="float", nullable=true, options={"unsigned":true, "default":0})
     */
    private $score;


    /**
     *
     * @var string
     *
     *
     * @ORM\Column(name="comment", type="string", nullable=true)
     */
    private $comment;

    /**
     * @var \DateTime
     *
     *
     * @ORM\Column(name="created_date", type="datetime", unique=false, nullable=false)
     */
    private $createdDate;

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
     * @return int|null
     */
    public function getHotelId(): ?int
    {
        return $this->hotelId;
    }

    /**
     * @param int|null $hotelId
     * @return $this
     */
    public function setHotelId(?int $hotelId): self
    {
        $this->hotelId = $hotelId;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getScore(): ?float
    {
        return $this->score;
    }

    /**
     * @param float|null $score
     * @return $this
     */
    public function setScore(?float $score): self
    {
        $this->score = $score;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * @param  string|null  $comment
     * @return $this
     */
    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedDate(): \DateTime
    {
        return $this->createdDate;
    }

    /**
     * @param \DateTime $createdDate
     * @return $this
     */
    public function setCreatedDate(\DateTime $createdDate): self
    {
        $this->createdDate = $createdDate;

        return $this;
    }
}
