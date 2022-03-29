<?php

use App\Entity\Item;
use App\Entity\TodoList;
use App\Entity\User;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    private $user;
    private $todoList;
    private $item;



    protected function setUp(): void
    {
        $this->user = new User('seb@test.fr', 'seb', 'sso', 'P@ssw0rd1234', Carbon::now()->subYears(20));
        $this->todoList = new TodoList($this->user);
        $this->item = new Item("name item", "content item", $this->todoList);

        parent::setUp();
    }

    public function testItemValid()
    {
        $this->assertTrue($this->item->isValid());
    }

    public function testItemLongContent()
    {
        $itemLongContent = new Item("name long", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin varius orci ac lectus condimentum elementum. Curabitur fermentum porttitor magna. Aenean a volutpat turpis. Ut facilisis tortor in turpis tempus, eu tristique magna elementum. Fusce vel nisi risus. Praesent nisi nibh, volutpat a sodales et, posuere vel nulla. In dictum suscipit volutpat. Fusce sed aliquet est. Pellentesque dapibus cursus ipsum nec aliquet. Mauris vestibulum euismod sem eu porta. Donec et tristique ipsum.

In id dui est. Ut luctus lobortis leo sit amet commodo. Aliquam volutpat in velit vel vestibulum. Morbi ullamcorper, mi et pellentesque efficitur, mi felis rutrum sapien, sit amet accumsan nisl velit non turpis. In egestas lobortis neque at dictum. Mauris maximus faucibus odio. Donec lobortis viverra porttitor.

Vivamus efficitur eu tortor non malesuada. Sed laoreet justo nec nulla tempor, sit amet pretium urna elementum. Vestibulum quis sapien diam. Aenean interdum, sapien ac laoreet scelerisque, felis erat efficitur justo, ac consequat nunc turpis quis mi. Donec interdum at mi quis tincidunt. Vestibulum eget luctus magna. Nam fringilla congue luctus. Donec imperdiet purus vel ante luctus, eget porta neque posuere. Cras non metus eu nulla tristique lobortis. Quisque porttitor enim ut purus vulputate, at dapibus est auctor.

Morbi eget eros et odio lobortis convallis quis non tellus. Fusce facilisis lectus vitae tincidunt tincidunt. Fusce leo quam, feugiat at ipsum non, tristique aliquam leo. Duis lobortis felis vel egestas venenatis. Nunc malesuada consectetur tellus ut scelerisque. Suspendisse maximus bibendum dui, id ornare ex imperdiet vitae. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae;

Nunc tristique a massa in viverra. Nulla vitae mi nibh. Curabitur purus metus, accumsan id vestibulum nec, convallis id erat. Cras eleifend purus massa, a hendrerit ex ornare id. Vestibulum a facilisis dui, sit amet condimentum urna. Integer a augue enim. Mauris viverra nisl ipsum, vel iaculis velit lacinia eget. Nulla facilisi. Phasellus hendrerit finibus posuere. Phasellus ac ultricies felis. Ut vitae placerat magna, non faucibus ligula. Vivamus porttitor ligula at commodo malesuada. Suspendisse bibendum augue libero, eu scelerisque felis mollis at. Pellentesque sagittis congue nunc, non ullamcorper lacus dignissim sed. Integer convallis consequat neque vel tincidunt. In condimentum augue non felis dignissim, eu convallis elit elementum.");

        $this->assertFalse($itemLongContent->isValid());
    }

    /*  public function testNameUnique()
    {

        $item2 = new Item('name item', 'content item', $this->todoList);

        $this->assertFalse($item2->isValid());
    }*/

    public function testCreateDate()
    {
        $item2 = new Item('name item 2', 'content item 2', $this->todoList);

        $item3 = new Item('name item 3', 'content item 3', $this->todoList);

        $dateIterval = $item3->getDate()->diff($item2->getDate());
        $result = $dateIterval->y >= 0 &&  $dateIterval->m >= 0 && $dateIterval->d >= 0 && $dateIterval->i > 30;
        $this->assertFalse($result);
    }
}
