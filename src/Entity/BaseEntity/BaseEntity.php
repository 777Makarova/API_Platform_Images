<?php
namespace App\Entity\BaseEntity;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\DateTimeType;


class BaseEntity{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected ?int $id = null;

    #[ORM\Column(type: 'datetime')]
    public \DateTime $dateCreate;

    #[ORM\Column(type: 'datetime')]
    public \DateTime $dateUpdate;


    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param DateTime $dateCreate
     */
    public function setDateCreate(DateTime $dateCreate): void
    {
        $this->dateCreate = $dateCreate;
    }

    /**
     * @param DateTime $dateUpdate
     */
    public function setDateUpdate(DateTime $dateUpdate): void
    {
        $this->dateUpdate = $dateUpdate;
    }




}