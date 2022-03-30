<?php

use App\Entity\Item;
use App\Entity\TodoList;
use App\Entity\User;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class TodoListTest extends TestCase
{
    private TodoList $todoList;
    private User $user;
    private Item $item;

    protected function setUp(): void
    {
        $this->user = new User('seb@test.fr', 'seb', 'sso', 'P@ssw0rd1234', Carbon::now()->subYears(20));
        // $this->item = new Item();
        $this->todoList = new TodoList($this->user);


        $this->todoList->addItem(new Item("name 2", "content"));

        parent::setUp();
    }

    public function testTodoListValid()
    {
        $this->assertTrue($this->todoList->isValid());
    }

    public function testMaxItem()
    {
        $this->user = new User('seb@test.fr', 'seb', 'sso', 'P@ssw0rd1234', Carbon::now()->subYears(20));
        // $this->item = new Item();
        $todoList = new TodoList($this->user);


        $todoList->addItem(new Item("name 1", "content 1"));
        $todoList->addItem(new Item("name 2", "content 1"));
        $todoList->addItem(new Item("name 3", "content 1"));
        $todoList->addItem(new Item("name 4", "content 1"));
        $todoList->addItem(new Item("name 5", "content 1"));
        $todoList->addItem(new Item("name 6", "content 1"));
        $todoList->addItem(new Item("name 7", "content 1"));
        $todoList->addItem(new Item("name 8", "content 1"));
        $todoList->addItem(new Item("name 9", "content 1"));
        $todoList->addItem(new Item("name 10", "content 1"));
        $todoList->addItem(new Item("name 11", "content 1"));

        $this->assertFalse($todoList->isValid());
    }
}
