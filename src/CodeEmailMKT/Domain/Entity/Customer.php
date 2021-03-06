<?php

declare(strict_types = 1);

namespace CodeEmailMKT\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="enderecos")
 */
class Customer
{

    private $id;
    private $name;
    private $email;
    private $tags;

    /**
     * Customer constructor.
     * @param $tags
     */
    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }


    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTags(Collection $tags)
    {
        /** @var Tag $tag */
        foreach ($tags as $tag) {
            $tag->getCustomers()->add($this); //adicionando o customer na tag
            $this->tags->add($tag); //adicionando a tag no customer
        }

        return $this;
    }

    public function removeTags(Collection $tags)
    {
        /** @var Tag $tag */
        foreach ($tags as $tag) {
            $tag->getCustomers()->removeElement($this); //removendo o customer na tag
            $this->tags->removeElement($tag); //removendo a tag no customer
        }

        return$this;
    }

}