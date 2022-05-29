<?php

namespace App\Entity\Image;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\BaseEntity\BaseEntity;
use App\Entity\File\File;
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

    #[ORM\ManyToOne(targetEntity: File::class, inversedBy: 'ImageFile')]
    private ?File $file_id = null;

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
     * @return File
     */
    public function getFileId(): File
    {
        return $this->file_id;
    }

    /**
     * @param File|null $file_id
     */
    public function setFileId(?File $file_id): void
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

}
