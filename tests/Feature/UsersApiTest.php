<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersApiTest extends TestCase
{
    /**
     * test returning all users
     *
     * @return void
     */
    public function test_if_users_data_returned_correct()
    {
        $response = $this->getJson('/api/users');
        $response->assertOk()->assertJson([]);
    }

}
