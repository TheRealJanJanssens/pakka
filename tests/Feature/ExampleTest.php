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
