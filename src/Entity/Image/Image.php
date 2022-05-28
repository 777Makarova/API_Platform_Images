<?php

namespace App\Entity\Image;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\BaseEntity\BaseEntity;
use App\Entity\UserFavorite\UserFavorite;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ApiResource(
    collectionOperations: [
        'get' =>[
            'pagination_items_per_page' => 5
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
    mercure: true // протокол, позволяющий отправлять обновления объкта всем подключенным клиентам
)]

#[ApiFilter(SearchFilter::class, properties: [
    'id' => 'exact',
    'dateCreate' => 'partial'
])]
#[ApiFilter(DateFilter::class, properties: ['dateCreate'])]
#[ApiFilter(OrderFilter::class, properties:['id', 'dateCreate'])]

class Image extends BaseEntity
{
    /**
     * A nice image
     */
    #[ORM\Column (type: 'string')]
    #[Assert\NotBlank]
    public string $name = '';

    #[ORM\Column (type: 'string')]
    public string $size = '';

    // связать с id File
    #[ORM\Column (type: 'integer')]
    private ?int $file_id = null;

    #[ORM\Column (type: 'integer')]
    private ?int $parent = null;

    #[ORM\Column (type: 'integer')]
    private ?int $child = null;


    #[ORM\OneToMany(mappedBy: 'image_id', targetEntity: UserFavorite::class)]
    private iterable $imageFavorites;


    /**
     * @return iterable
     */
    public function getImageFavorites(): iterable
    {
        return $this->imageFavorites;
    }


    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }


    /**
     * @param string $size
     */
    public function setSize(string $size): void
    {
        $this->size = $size;
    }

    /**
     * @return int|null
     */
    public function getFileId(): ?int
    {
        return $this->file_id;
    }

    /**
     * @param int|null $file_id
     */
    public function setFileId(?int $file_id): void
    {
        $this->file_id = $file_id;
    }

    /**
     * @return int|null
     */
    public function getParent(): ?int
    {
        return $this->parent;
    }

    /**
     * @param int|null $parent
     */
    public function setParent(?int $parent): void
    {
        $this->parent = $parent;
    }

    /**
     * @param int|null $parent
     */

    /**
     * @return int|null
     */
    public function getChild(): ?int
    {
        return $this->child;
    }

    /**
     * @param int|null $child
     */
    public function setChild(?int $child): void
    {
        $this->child = $child;
    }
//
//    public function getParent(): ?int
//    {
//        return $this->parent;
//    }
//
//    public function getChild(): ?int
//    {
//        return $this->child;
//    }
//
//    public function setName(): self
//    {
//        return $this->name;
//    }
//
//    public function setSize(): self
//    {
//        return $this->size;
//    }
//
//    public function setParent(): ?int
//    {
//        return $this->parent;
//    }
//
//    public function setChild(): ?int
//    {
//        return $this->parent;
//    }


}
