<?php

declare(strict_types=1);

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * The name of the first user used in tests.
     *
     * @var string
     */
    protected const USER_1_NAME = 'test user 1';

    /**
     * The email address of the first user used in tests.
     *
     * @var string
     */
    protected const USER_1_EMAIL = 'test1@example.com';

    /**
     * The password of the first user used in tests.
     *
     * @var string
     */
    protected const USER_1_PASSWORD = 'password';

    /**
     * The id of a non-existing user.
     *
     * @var int
     */
    protected const NOT_EXISTING_USER_ID = 3;
}
