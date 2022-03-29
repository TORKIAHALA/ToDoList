<?php

namespace App\Entity;

use App\Repository\TodoListRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TodoListRepository::class)]
class TodoList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToOne(targetEntity: User::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $user_todolist;

    #[ORM\OneToMany(mappedBy: 'todoList', targetEntity: Item::class)]
    private $items;

    public function __construct(User $user_todolist)
    {
        $this->items = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserTodolist(): ?User
    {
        return $this->user_todolist;
    }

    public function setUserTodolist(User $user_todolist): self
    {
        $this->user_todolist = $user_todolist;

        return $this;
    }

    /**
     * @return Collection<int, Item>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    /**
     * @return Array
     */
    public function getItemsName()
    {
        $arrayName = array();
        foreach ($this->getItems() as $item) {
            $arrayName[] = $item->getName();
        }
        return $arrayName;
    }

    public function addItem(Item $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
            $item->setTodoList($this);
        }

        return $this;
    }

    public function removeItem(Item $item): self
    {
        if ($this->items->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getTodoList() === $this) {
                $item->setTodoList(null);
            }
        }

        return $this;
    }

    public function isValid(): bool
    {
        return count($this->getItems()) < 10;
    }
}
