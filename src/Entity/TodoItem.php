<?php

namespace App\Entity;

use App\Repository\TodoItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table('items')]
#[ORM\Entity(repositoryClass: TodoItemRepository::class)]
class TodoItem implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'items')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TodoList $list = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getList(): ?TodoList
    {
        return $this->list;
    }

    public function setList(?TodoList $list): static
    {
        $this->list = $list;

        return $this;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'name' => $this->name
        ];
    }
}
