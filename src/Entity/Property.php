<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\PropertyRepository;
use Doctrine\DBAL\Types\DateImmutableType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ApiResource(
 *     shortName="Properties",
 *     itemOperations={"get"},
 *     collectionOperations={
 *          "post"
 *     },
 *     normalizationContext={"groups"={"property:read","propertyItem:read"}},
 *     denormalizationContext={"groups"={"property:write"}},
 * )
 * @ORM\Entity(repositoryClass=PropertyRepository::class)
 */
class Property
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @Groups({"property:read", "property:write", "items:read"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Item::class, inversedBy="properties")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="Item cannot be empty")
     * @Groups({"property:write"})
     */
    private $item;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"property:read", "property:write", "items:read"})
     * @Assert\NotBlank(message="Item name cannot be empty")
     * @Assert\Length(
     *     min=2,
     *     max=255,
     *     maxMessage="Describe property name in 255 chars or less"
     * )
     */
    private $propertyName;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"property:read", "property:write", "items:read"})
     * @Assert\Length(
     *     min=2,
     *     max=100,
     *     maxMessage="Describe property code in 100 chars or less"
     * )
     */
    private $propertyCode;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"property:read", "property:write", "items:read"})
     */
    private $propertyDescription;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"property:read", "items:read"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"}, columnDefinition="datetime default current_timestamp on update current_timestamp not null")
     * @Groups({"property:read", "items:read"})
     */
    private $updatedAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
        $this->updatedAt = new \DateTime('now');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getItem(): ?Item
    {
        return $this->item;
    }

    public function setItem(?Item $item): self
    {
        $this->item = $item;

        return $this;
    }

    public function getPropertyName(): ?string
    {
        return $this->propertyName;
    }

    public function setPropertyName(string $propertyName): self
    {
        $this->propertyName = $propertyName;

        return $this;
    }

    public function getPropertyCode(): ?string
    {
        return $this->propertyCode;
    }

    public function setPropertyCode(string $propertyCode): self
    {
        $this->propertyCode = $propertyCode;

        return $this;
    }

    public function getPropertyDescription(): ?string
    {
        return $this->propertyDescription;
    }

    public function setPropertyDescription(?string $propertyDescription): self
    {
        $this->propertyDescription = $propertyDescription;

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
}
