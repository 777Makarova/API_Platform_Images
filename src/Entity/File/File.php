<?php
namespace App\Entity\File;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use App\Entity\BaseEntity\BaseEntity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ApiResource]

#[ApiFilter(SearchFilter::class, properties: [
    'id' => 'exact',
    'dateCreate' => 'partial'
])]
#[ApiFilter(DateFilter::class, properties: ['dateCreate'])]
#[ApiFilter(OrderFilter::class, properties:['id', 'dateCreate'])]

class File extends BaseEntity
{

    #[ORM\Column (type: 'string')]
    #[Assert\NotNull]
    private string $name = '';

    #[ORM\Column (type: 'string')]
    #[Assert\NotNull]
    private string $path = '';

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string|null $path
     */
    public function setPath(?string $path): void
    {
        $this->path = $path;
    }


}

