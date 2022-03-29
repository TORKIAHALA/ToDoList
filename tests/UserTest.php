<?php

use App\Entity\User;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;



class UserTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        $this->user = new User('seb@test.fr', 'seb', 'sso', 'P@ssw0rd1234', Carbon::now()->subYears(20));
        parent::setUp();
    }



    public function testUserIsValidNominal()
    {
        $u = new User('seb@test.fr', 'seb', 'sso', 'P@ssw0rd1234', Carbon::now()->subYears(20));
        $result = $u->isValid();
        $this->assertTrue($result);
    }

    public function testIsValidNominal()
    {
        $this->assertTrue($this->user->isValid());
    }

    public function testUserNotValidDueToFName()
    {
        $u = new User('seb@test.fr', '', 'sso', 'P@ssw0rd1234', Carbon::now()->subYears(20));
        $result = $u->isValid();
        $this->assertFalse($result);
    }

    public function testNotValidDueToFName()
    {
        $this->user->setFirstname('');
        $this->assertFalse($this->user->isValid());
    }

    public function testNotValidDueToLName()
    {
        $this->user->setLastname('');
        $this->assertFalse($this->user->isValid());
    }

    public function testNotValidDueToBirthdayInFuture()
    {
        $this->user->setBirthdate(Carbon::now()->addDecade());
        $this->assertFalse($this->user->isValid());
    }

    public function testNotValidDueToTooYoungUser()
    {
        $this->user->setBirthdate(Carbon::now()->subDecade());
        $this->assertFalse($this->user->isValid());
    }

    public function testNotValidBadPassword()
    {
        $this->user->setPassword('toto');

        $this->assertFalse($this->user->isValid());
    }
}
