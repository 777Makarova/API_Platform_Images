<?php

namespace App\Entity\User;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\BaseEntity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
* Test
*
* @ORM\Entity
*/
#[ApiResource]
class Test
{
    /**
     * The id of the object
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected ?int $id = null;


    /**
     * The name of the user
     *
     * @ORM\Column
     */
    #[Assert\NotBlank]
    private string $name = '';


    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}