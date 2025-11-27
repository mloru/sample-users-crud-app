<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use JetBrains\PhpStorm\NoReturn;
use PHPUnit\Framework\Attributes\Test;

final class UserTest extends TestCase
{
    #[NoReturn]
    #[Test]
    public function a_user_can_be_persisted(): void
    {
        /** @var User $user */
        User::factory()
            ->create([
                'name' => self::USER_1_NAME,
                'email' => self::USER_1_EMAIL,
                'password' => self::USER_1_PASSWORD,
            ]);

        $this->assertDatabaseCount('users', 1);

        $this->assertDatabaseHas(
            'users',
            [
                'name' => self::USER_1_NAME,
                'email' => self::USER_1_EMAIL,
            ]
        );

        /** @var User $user */
        $user = User::where('email', self::USER_1_EMAIL)
            ->first();

        $this->assertTrue(
            Hash::check(self::USER_1_PASSWORD, $user->password)
        );
    }
}
