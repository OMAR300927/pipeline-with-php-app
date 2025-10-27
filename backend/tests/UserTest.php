<?php
use PHPUnit\Framework\TestCase;
use App\Models\User;

class UserTest extends TestCase {
    public function testUserCreation() {
        $user = new User(1, 'Omar', 'omar@example.com');
        $this->assertEquals('Omar', $user->name);
    }
}
