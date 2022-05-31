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
    private string $size = '';

    #[ORM\ManyToOne(targetEntity: File::class, inversedBy: 'ImageFile')]
    private ?File $file_id = null;

    #[ORM\Column (type: 'integer')]
    private ?int $parent = null;

    #[ORM\Column (type: 'integer')]
    private ?int $child = null;


    #[ORM\OneToMany(mappedBy: 'image_id', targetEntity: UserFavorite::class)]
    private iterable $imageFavorites;


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

}
