<?php
namespace App\Entity\UserImage;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\BaseEntity\BaseEntity;
use App\Entity\Image\Image;
use App\Entity\User\User;
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

class UserImage extends BaseEntity {

    #[ORM\Column (type: 'integer')]
    #[Assert\NotNull]
    private ?int $user_id = null;

    #[ORM\Column (type: 'integer')]
    #[Assert\NotNull]
    private ?int $image_id = null;

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    /**
     * @return int|null
     */
    public function getImageId(): ?int
    {
        return $this->image_id;
    }




}

