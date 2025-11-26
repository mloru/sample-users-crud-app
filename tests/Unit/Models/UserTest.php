<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\Test;

final class UserTest extends TestCase
{
    /**
     * @var string
     */
    const USER_NAME = 'test user';

    /**
     * @var string
     */
    const USER_EMAIL = 'test@example.com';

    /**
     * @var string
     */
    const USER_PASSWORD = 'password';

    #[Test]
    public function a_user_can_be_persisted(): void
    {
        /** @var User $user */
        $user = User::factory()
            ->create([
                'name' => self::USER_NAME,
                'email' => self::USER_EMAIL,
                'password' => self::USER_PASSWORD,
            ]);

        $this->assertDatabaseCount('users', 1);

        $this->assertDatabaseHas(
            'users',
            [
                'name' => self::USER_NAME,
                'email' => self::USER_EMAIL,
            ]
        );

        /** @var User $user */
        $user = User::where('email', self::USER_EMAIL)
            ->first();

        $this->assertTrue(
            Hash::check(self::USER_PASSWORD, $user->password)
        );
    }
}
