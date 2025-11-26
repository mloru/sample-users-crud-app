<?php

declare(strict_types=1);

namespace Tests\Unit;

use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use InteractsWithDatabase;
    use LazilyRefreshDatabase;
}
