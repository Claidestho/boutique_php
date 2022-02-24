<?php
include_once 'item.php';

class Rodents extends Item {
    protected string $rodent_family;

    /**
     * @return string
     */
    public function getRodentFamily(): string
    {
        return $this->rodent_family;
    }

    /**
     * @param string $rodent_family
     */
    public function setRodentFamily(string $rodent_family): void
    {
        $this->rodent_family = $rodent_family;
    }


}