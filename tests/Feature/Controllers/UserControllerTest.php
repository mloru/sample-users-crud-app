<?php

declare(strict_types=1);

namespace Tests\Feature\Controllers;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\TestResponse;
use JetBrains\PhpStorm\NoReturn;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Component\HttpFoundation\Response;

final class UserControllerTest extends TestCase
{
    /** @var string */
    private const BASE_ENDPOINT = '/api/users';

    /** @var string */
    private const GET_SINGLE_USER_ENDPOINT = '/api/users/%d';

    /** @var string */
    private const INVALID_EMAIL = 'invalid-email';

    /** @var string */
    private const UPDATED_USER_1_NAME = 'Updated name';

    /** @var string */
    private const UPDATED_USER_1_EMAIL = 'updated@email.com';

    /** @var string */
    private const UPDATED_USER_PASSWORD = 'new!password$';

    /**
     * The name of the second user used in tests.
     *
     * @var string
     */
    protected const USER_2_NAME = 'test user 2';

    /**
     * The email address of the second user used in tests.
     *
     * @var string
     */
    protected const USER_2_EMAIL = 'test2@example.com';

    #[NoReturn]
    #[Test]
    public function it_returns_all_users(): void
    {
        /** @var User $user1 */
        $user1 = User::factory()
            ->create([
                'name' => self::USER_1_NAME,
                'email' => self::USER_1_EMAIL,
            ]);

        /** @var User $user2 */
        $user2 = User::factory()
            ->create([
                'name' => self::USER_2_NAME,
                'email' => self::USER_2_EMAIL,
            ]);

        $this->get(self::BASE_ENDPOINT)
            ->assertOk()
            ->assertJsonFragment(
                [
                    'id' => $user1->getId(),
                    'name' => self::USER_1_NAME,
                    'email' => self::USER_1_EMAIL,
                ]
            )
            ->assertJsonFragment(
                [
                    'id' => $user2->getId(),
                    'name' => self::USER_2_NAME,
                    'email' => self::USER_2_EMAIL,
                ],
            );
    }

    #[NoReturn]
    #[Test]
    public function it_returns_the_requested_user_if_it_exists(): void
    {
        /** @var User $user */
        $user = User::factory()
            ->create([
                'name' => self::USER_1_NAME,
                'email' => self::USER_1_EMAIL,
            ]);

        $this->get(
                sprintf(self::GET_SINGLE_USER_ENDPOINT, $user->getId())
            )
            ->assertOk()
            ->assertJsonFragment([
                'id' => $user->getId(),
                'name' => self::USER_1_NAME,
                'email' => self::USER_1_EMAIL,
            ]);

        $this->get(
                sprintf(self::GET_SINGLE_USER_ENDPOINT, self::NOT_EXISTING_USER_ID)
            )
            ->assertNotFound();
    }

    #[NoReturn]
    #[Test]
    public function it_returns_not_found_if_a_user_does_not_exist(): void
    {
        $this->get(
                sprintf(self::GET_SINGLE_USER_ENDPOINT, self::NOT_EXISTING_USER_ID)
            )
            ->assertStatus(Response::HTTP_NOT_FOUND);
    }

    #[NoReturn]
    #[Test]
    public function it_creates_a_user(): void
    {
        /** @var TestResponse $response */
        $response = $this->post(
            self::BASE_ENDPOINT,
            [
                'name' => self::USER_1_NAME,
                'email' => self::USER_1_EMAIL,
                'password' => self::USER_1_PASSWORD,
                'password_confirmation' => self::USER_1_PASSWORD,
            ]
        )
            ->assertCreated()
            ->assertJsonFragment([
                'name' => self::USER_1_NAME,
                'email' => self::USER_1_EMAIL,
            ]);

        /** @var array $decodedResponse */
        $decodedResponse = json_decode($response->getContent(), true);

        /** @var User|null $persistedUser */
        $persistedUser = User::find(Arr::get($decodedResponse, 'id'));

        $this->assertNotNull($persistedUser);

        $this->assertSame(self::USER_1_NAME, $persistedUser->getName());
        $this->assertSame(self::USER_1_EMAIL, $persistedUser->getEmail());
    }

    public static function invalidUserCreationData(): array
    {
        return [
            'empty name' => [
                'data' => [
                    'name' => '',
                    'email' => self::USER_1_EMAIL,
                    'password' => self::USER_1_PASSWORD,
                    'password_confirmation' => self::USER_1_PASSWORD,
                ],
                'errors' => [
                    'name' => ['Il campo name è richiesto.'],
                ]
            ],
            'missing name' => [
                'data' => [
                    'email' => self::USER_1_EMAIL,
                    'password' => self::USER_1_PASSWORD,
                    'password_confirmation' => self::USER_1_PASSWORD,
                ],
                'errors' => [
                    'name' => ['Il campo name è richiesto.'],
                ]
            ],
            'empty email' => [
                'data' => [
                    'name' => self::USER_1_NAME,
                    'email' => '',
                    'password' => self::USER_1_PASSWORD,
                    'password_confirmation' => self::USER_1_PASSWORD,
                ],
                'errors' => [
                    'email' => ['Il campo email è richiesto.'],
                ]
            ],
            'missing email' => [
                'data' => [
                    'name' => self::USER_1_NAME,
                    'password' => self::USER_1_PASSWORD,
                    'password_confirmation' => self::USER_1_PASSWORD,
                ],
                'errors' => [
                    'email' => ['Il campo email è richiesto.'],
                ]
            ],
            'invalid email' => [
                'data' => [
                    'name' => self::USER_1_NAME,
                    'email' => self::INVALID_EMAIL,
                    'password' => self::USER_1_PASSWORD,
                    'password_confirmation' => self::USER_1_PASSWORD,
                ],
                'errors' => [
                    'email' => ['Il campo email deve essere un indirizzo email valido.'],
                ]
            ],
            'non-matching passwords' => [
                'data' => [
                    'name' => self::USER_1_NAME,
                    'email' => self::USER_1_EMAIL,
                    'password' => self::USER_1_PASSWORD,
                    'password_confirmation' => self::USER_1_PASSWORD . 'x',
                ],
                'errors' => [
                    'password' => ['Il campo password non corrisponde.'],
                ]
            ],
        ];
    }

    #[NoReturn]
    #[dataProvider('invalidUserCreationData')]
    #[Test]
    public function user_create_route_returns_a_validation_error_if_data_is_not_valid(array $data, array $errors): void
    {
        /** @var TestResponse $response */
        $response = $this->post(
            self::BASE_ENDPOINT,
            $data
        )
            ->assertUnprocessable();

        /** @var array $responseData */
        $responseData = json_decode($response->getContent(), true);

        /**
         * @var string $field
         * @var array $expectedErrorMessages
         */
        foreach ($errors as $field => $expectedErrorMessages) {
            $this->assertArrayHasKey(
                $field,
                $responseData
            );

            /** @var array $returnedErrorMessages */
            $returnedErrorMessages = Arr::get($responseData, $field, []);

            /** @var string $expectedMessage */
            foreach ($expectedErrorMessages as $expectedMessage) {
                $this->assertContains($expectedMessage, $returnedErrorMessages);
            }
        }
    }

    public static function invalidUserUpdateData(): array
    {
        return [
            'empty name' => [
                'data' => [
                    'name' => '',
                ],
                'errors' => [
                    'name' => ['Il campo name è richiesto.'],
                ]
            ],
            'empty email' => [
                'data' => [
                    'email' => '',
                ],
                'errors' => [
                    'email' => ['Il campo email è richiesto.'],
                ]
            ],
            'invalid email' => [
                'data' => [
                    'name' => self::USER_1_NAME,
                    'email' => self::INVALID_EMAIL,
                    'password' => self::USER_1_PASSWORD,
                    'password_confirmation' => self::USER_1_PASSWORD,
                ],
                'errors' => [
                    'email' => ['Il campo email deve essere un indirizzo email valido.'],
                ]
            ],
            'non-matching passwords' => [
                'data' => [
                    'password' => self::USER_1_PASSWORD,
                    'password_confirmation' => self::USER_1_PASSWORD . 'x',
                ],
                'errors' => [
                    'password' => ['Il campo password non corrisponde.'],
                ]
            ],
        ];
    }

    #[NoReturn]
    #[dataProvider('invalidUserUpdateData')]
    #[Test]
    public function user_update_route_returns_a_validation_error_if_data_is_not_valid(array $data, array $errors): void
    {
        /** @var TestResponse $response */
        $response = $this->post(
            self::BASE_ENDPOINT,
            $data
        )
            ->assertUnprocessable();

        /** @var array $responseData */
        $responseData = json_decode($response->getContent(), true);

        /**
         * @var string $field
         * @var array $expectedErrorMessages
         */
        foreach ($errors as $field => $expectedErrorMessages) {
            $this->assertArrayHasKey(
                $field,
                $responseData
            );

            /** @var array $returnedErrorMessages */
            $returnedErrorMessages = Arr::get($responseData, $field, []);

            /** @var string $expectedMessage */
            foreach ($expectedErrorMessages as $expectedMessage) {
                $this->assertContains($expectedMessage, $returnedErrorMessages);
            }
        }
    }

    #[NoReturn]
    #[Test]
    public function it_deletes_a_user(): void
    {
        /** @var User $user */
        $user = User::factory()
            ->create([
                'name' => self::USER_1_NAME,
                'email' => self::USER_1_EMAIL,
            ]);

        $this->delete(
                sprintf(self::GET_SINGLE_USER_ENDPOINT, $user->getId())
            )
            ->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseMissing(
            'users',
            ['id' => $user->getId()]
        );
    }
    #[NoReturn]
    #[Test]
    public function it_updates_a_user(): void
    {
        /** @var User $user */
        $user = User::factory()
            ->create([
                'name' => self::USER_1_NAME,
                'email' => self::USER_1_EMAIL,
            ]);

        $this->put(
            sprintf(self::GET_SINGLE_USER_ENDPOINT, $user->getId()),
            [
                'name' => self::UPDATED_USER_1_NAME,
                'email' => self::UPDATED_USER_1_EMAIL,
                'password' => self::UPDATED_USER_PASSWORD,
                'password_confirmation' => self::UPDATED_USER_PASSWORD,
            ]
        )
            ->assertOk();

        $user->refresh();

        $this->assertSame(self::UPDATED_USER_1_NAME, $user->getName());
        $this->assertSame(self::UPDATED_USER_1_EMAIL, $user->getEmail());

        $this->assertTrue(
            Hash::check(self::UPDATED_USER_PASSWORD, $user->password)
        );
    }
}
