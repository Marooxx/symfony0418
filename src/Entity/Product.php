<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Type(
     *     type="string"
     * )
     * @Assert\Length(
     *     min= 4,
     *     max= 50,
     *     minMessage="Le nom doit comporter au moins {{ limit }} caractères",
     *     maxMessage="Le nom doit comporter maximum {{ limit }} caractères"
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Assert\Type(
     *     type="string"
     * )
     * @Assert\Length(
     *     min= 15,
     *     max= 1000,
     *     minMessage="La description doit comporter au moins {{ limit }} caractères",
     *     maxMessage="La description doit comporter maximum {{ limit }} caractères"
     * )
     */
    private $description;

    /**
     * @ORM\Column(type="decimal", scale=2)
     * @Assert\Length(
     *     min= 0,
     *     max= 99999999.99,
     *     minMessage="Le prix doit être supérieur à {{ limit }}",
     *     maxMessage="Le prix doit être inférieur à {{ limit }}"
     * )
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbViews;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="products", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * Constructeur
     */
    public function __construct()
    {
        $this->nbViews = 0;
        $this->createdAt = new \DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getNbViews(): ?int
    {
        return $this->nbViews;
    }

    public function setNbViews(int $nbViews): self
    {
        $this->nbViews = $nbViews;

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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
