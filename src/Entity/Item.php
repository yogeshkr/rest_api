<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\ItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\DateImmutableType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ApiResource(
 *     shortName="Items",
 *     itemOperations={"get", "delete", "put"},
 *     normalizationContext={"groups"={"items:read"}},
 *     denormalizationContext={"groups"={"items:write"}},
 *     collectionOperations={"get", "post"}
 * )
 * @ORM\Entity(repositoryClass=ItemRepository::class)
 */
class Item
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @Groups({"items:read", "property:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"items:read", "items:write"})
     * @Assert\NotBlank(message="Item name cannot be empty")
     * @Assert\Length(
     *     min=2,
     *     max=255,
     *     maxMessage="Describe Item name in 255 chars or less"
     * )
     */
    private $itemName;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"items:read", "items:write"})
     * @Assert\NotBlank(message="Item code cannot be empty")
     * @Assert\Length(
     *     min=2,
     *     max=100,
     *     maxMessage="Describe Item code in 50 chars or less"
     * )
     */
    private $itemCode;
    /**
     * @ORM\OneToMany(targetEntity=Property::class, mappedBy="item", cascade={"persist"}, orphanRemoval=true)
     * @Groups({"property:read", "items:read"})
     */
    private $properties;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"items:read", "items:write"})
     */
    private $itemDescription;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"items:read", "items:write"})
     */
    private $itemImage;

    /**
     * @ORM\Column(type="float", precision=6, scale=2)
     * @Groups({"items:read", "items:write"})
     * @Assert\Type(message="Item price must be a numeric value", type="float")
     * @Assert\NotBlank(message="Item price cannot be empty")
     * @Assert\GreaterThanOrEqual(message="Item price must be no less than zero", value = 0)
     */
    private $itemPrice;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"items:read", "items:write"})
     * @Assert\Type(message="Item status must be a boolean value", type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"items:read"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"}, columnDefinition="datetime default current_timestamp on update current_timestamp not null")
     * @Groups({"items:read"})
     */
    private $updatedAt;


    public function __construct()
    {
        $this->propertyName = new ArrayCollection();
        $this->createdAt = new \DateTime('now');
        $this->updatedAt = new \DateTime('now');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getItemName(): ?string
    {
        return $this->itemName;
    }

    public function setItemName(string $itemName): self
    {
        $this->itemName = $itemName;

        return $this;
    }

    public function getItemCode(): ?string
    {
        return $this->itemCode;
    }

    public function setItemCode(string $itemCode): self
    {
        $this->itemCode = $itemCode;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, Property>
     */
    public function getProperties(): Collection
    {
        return $this->properties;
    }

    public function addProperties(Property $properties): self
    {
        if (!$this->properties->contains($properties)) {
            $this->properties[] = $properties;
            $properties->setItemId($this);
        }

        return $this;
    }

    public function removeProperties(Property $properties): self
    {
        if ($this->properties->removeElement($properties)) {
            // set the owning side to null (unless already changed)
            if ($properties->getItemId() === $this) {
                $properties->setItemId(null);
            }
        }

        return $this;
    }

    public function getItemDescription(): ?string
    {
        return $this->itemDescription;
    }

    public function setItemDescription(?string $itemDescription): self
    {
        $this->itemDescription = $itemDescription;

        return $this;
    }

    public function getItemImage(): ?string
    {
        return $this->itemImage;
    }

    public function setItemImage(?string $itemImage): self
    {
        $this->itemImage = $itemImage;

        return $this;
    }

    public function getItemPrice(): ?float
    {
        return $this->itemPrice;
    }

    public function setItemPrice(?float $itemPrice): self
    {
        $this->itemPrice = $itemPrice;

        return $this;
    }
}
