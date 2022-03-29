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

        for ($i = 0; $i >= 10; $i++) {
            $this->todoList->addItem(new Item("name " . $i, "content" . $i));
        }
        parent::setUp();
    }

    public function testTodoListValid()
    {
        $this->assertTrue($this->todoList->isValid());
    }

    /* public function testMaxItem()
    {
        $this->user = new User('seb@test.fr', 'seb', 'sso', 'P@ssw0rd1234', Carbon::now()->subYears(20));
        // $this->item = new Item();
        $this->todoList = new TodoList($this->user);

        for ($i = 0; $i >= 25; $i++) {
            $this->todoList->addItem(new Item("name " . $i, "content" . $i));
        }

        $this->assertFalse($this->todoList->isValid());
    }*/

    public function testNameItem()
    {
    }
}
