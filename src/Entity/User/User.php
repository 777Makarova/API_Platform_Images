<?php

namespace App\Entity\User;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use App\Entity\BaseEntity\BaseEntity;

use App\Entity\UserFavorite\UserFavorite;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ApiResource(
    collectionOperations: [
        'get' =>[
            'pagination_items_per_page' => 3
        ],
        'post' =>[
        ]
    ],
    itemOperations: [
        'get' =>[
        ],
        'put' => [
        ],
        'delete' => [
        ]
    ],
    mercure: true
)]

#[ApiFilter(SearchFilter::class, properties: [
    'id' => 'exact',
    'dateCreate' => 'partial'
])]
#[ApiFilter(DateFilter::class, properties: ['dateCreate'])]
#[ApiFilter(OrderFilter::class, properties:['id', 'dateCreate'])]

class User extends BaseEntity{

    #[ORM\OneToMany(mappedBy: 'user_id', targetEntity: UserFavorite::class)]
    private iterable $userFavorites;


    #[ORM\Column(type: 'string')]
    private ?string $name;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $email;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $phone;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $password;


    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     */
    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return iterable
     */
    public function getUserFavorites(): iterable
    {
        return $this->userFavorites;
    }




}
