<?php
namespace App\Entity\File;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use App\Controller\File\FileController;
use App\Entity\BaseEntity\BaseEntity;

use App\Entity\Image\Image;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ApiResource(
    collectionOperations: [
        'get' =>[
        ],
        'post'=>[
            'deserialize' => false,
            'controller' => FileController::class,
            'openapi_context' =>[
                'requestBody' =>[
                    'description' => 'File Upload',
                    'required' => true,
                    'content'=>[
                        'multipart/form-data'=>[
                            'schema'=>[
                                'type' => 'object',
                                'properties' => [
                                    'name' => [
                                        'type' => 'string',
                                        'description' => 'Write the file name'
                                    ],
                                    'file' => [
                                        'type' => 'string',
                                        'format' => 'binary',
                                        'description' => 'File to be uploaded. Only JPG!'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]

    ],
    iri: 'http://schema.org/ImageObject',
    itemOperations: ['get', 'delete'],
    normalizationContext: [Groups::class, 'read']
)]

#[ApiFilter(SearchFilter::class, properties: [
    'id' => 'exact',
    'dateCreate' => 'partial'
])]
#[ApiFilter(DateFilter::class, properties: ['dateCreate'])]
#[ApiFilter(OrderFilter::class, properties:['id', 'dateCreate'])]

class File
{


    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column (type: 'string')]
    #[Assert\NotNull]
    public string $name = '';

    #[ORM\Column (type: 'string')]
    #[ApiProperty (iri: 'http://schema.org/contentUrl')]
    #[Groups('read')]
    #[Assert\NotNull]
    public ?string $filePath = null;


    #[ORM\OneToMany(mappedBy: 'file_id', targetEntity: Image::class)]
    private iterable $ImageFile;



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
     * @return string|null
     */
    public function getFilePath(): ?string
    {
        return $this->filePath;
    }

    /**
     * @return iterable
     */
    public function getImageFile(): iterable
    {
        return $this->ImageFile;
    }
}

