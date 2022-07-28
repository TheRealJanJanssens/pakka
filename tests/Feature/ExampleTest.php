<?php
/**
 * Feature tests
 *
 * Test the functionality of the entire system like a user should use it
 * (users perspective)
 */

use function Pest\Laravel\get;

use TheRealJanJanssens\Pakka\Models\User;

beforeEach(fn () => User::factory()->create());

//TODO: when new scenario is run the database is cleared and migrations and seeders run again. the auto increment is not reset so the beforeEach doesn't start from 1 so below test fails
it('has users')->assertDatabaseHas('users', [
    'id' => 1,
]);

it('has languages')->assertDatabaseHas('languages', [
    'id' => 1,
]);

it('has menus')->assertDatabaseHas('menus', [
    'id' => 1,
]);

// it('route is available', function () {
//     get('/admin')->assertStatus(200);
// });
