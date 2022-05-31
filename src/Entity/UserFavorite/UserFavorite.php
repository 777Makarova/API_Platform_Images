<?php
namespace App\Entity\UserFavorite;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\BaseEntity\BaseEntity;
use App\Entity\Image\Image;
use App\Entity\User\User;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ApiResource]


#[ApiFilter(SearchFilter::class, properties: [
    'user_id' => 'exact',
    'image_id' => 'exact',
    'dateCreate' => 'partial'
])]
#[ApiFilter(DateFilter::class, properties: ['dateCreate'])]
#[ApiFilter(OrderFilter::class, properties:['id', 'dateCreate'])]

class UserFavorite extends BaseEntity {

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'userFavorites')]
    private ?User $user_id;


    #[ORM\ManyToOne(targetEntity: Image::class, inversedBy: 'imageFavorites')]
    private ?Image $image_id;

    /**
     * @return User|null
     */
    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    /**
     * @param User|null $user_id
     */
    public function setUserId(?User $user_id): void
    {
        $this->user_id = $user_id;
    }


    /**
     * @return Image|null
     */
    public function getImageId(): ?Image
    {
        return $this->image_id;
    }


    /**
     * @param Image|null $image_id
     */
    public function setImageId(?Image $image_id): void
    {
        $this->image_id = $image_id;
    }


}
