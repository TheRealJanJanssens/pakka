<?php
/**
 * Feature tests
 *
 * Test the functionality of the entire system like a user should use it
 * (users perspective)
 */

use TheRealJanJanssens\Pakka\Database\Seeders\MenuSeeder;
use TheRealJanJanssens\Pakka\Models\User;

use function Pest\Laravel\get;

beforeEach(function () {
    $this->seed(MenuSeeder::class);
    User::factory()->create();
});

//TODO: when new scenario is run the database is cleared and migrations and seeders run again. the auto increment is not reset so the beforeEach doesn't start from 1 so below test fails
it('has users')->assertDatabaseHas('users', [
    'id' => 1,
]);

// it('has languages')->assertDatabaseHas('languages', [
//     'id' => 1,
// ]);

it('has menus')->assertDatabaseHas('menus', [
    'id' => 1,
]);

// TODO: Route check doesn't work yet because following on Settings model needs to be removed
// Also add Role middleware
// DB::statement("SET SESSION group_concat_max_len = 1000000;");

// it('redirects to login page when not logged in', function(){
//     $response = get(route('admin.users.index'));
//     $response->assertStatus(302);
// });

// it('has users page', function () {
//     //Authentication
//     $user = User::factory()->create();
//     $response = $this->actingAs($user);

//     get(route('admin.users.index'))->assertStatus(200);
// });

