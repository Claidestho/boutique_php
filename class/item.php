<?php

class Item
{
    protected string $name;
    protected string $description;
    protected int $price;
    protected string $imageUrl;
    protected int $weight;
    protected int $quantity;
    protected int $avalaible = 0;
    protected int $discount_rate;
    protected int $id;
public function __construct(){

}
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    /**
     * @param string $imageUrl
     */
    public function setImageUrl(string $imageUrl): void
    {
        $this->imageUrl = $imageUrl;
    }

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * @param int $weight
     */
    public function setWeight(int $weight): void
    {
        $this->weight = $weight;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return bool
     */
    public function isAvalaible(): bool
    {
        return $this->avalaible;
    }

    /**
     * @param bool $avalaible
     */
    public function setAvalaible(bool $avalaible): void
    {
        $this->avalaible = $avalaible;
    }

    /**
     * @return int
     */
    public function getDiscountRate(): int
    {
        return $this->discount_rate;
    }

    /**
     * @param int $discount_rate
     */
    public function setDiscountRate(int $discount_rate): void
    {
        $this->discount_rate = $discount_rate;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }


}

