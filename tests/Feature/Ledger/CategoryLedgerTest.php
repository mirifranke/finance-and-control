<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryLedgerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_authorized_user_can_visit_ledger_categories()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/ledger/categories');

        $response->assertOk();
    }

    /** @test */
    public function an_unauthorized_user_cannot_visit_ledger_categories()
    {
        $response = $this->get('/ledger/categories');

        $response->assertRedirect();
    }

    /** @test */
    public function it_creates_a_category_for_ledger_account()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->postJson(
            route('ledger.category.create'),
            [
                'title' => 'title',
                'description' => 'description',
            ]
        );

        $this->assertDatabaseHas('categories', [
            'title' => 'title',
            'account_type' => Payment::ACCOUNT_TYPE_LEDGER,
        ]);
    }

    /** @test */
    public function it_updates_a_category_of_ledger_account()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create([
            'account_type' => Payment::ACCOUNT_TYPE_LEDGER
        ]);

        $this->actingAs($user)->patchJson(
            route('ledger.category.update', $category),
            [
                'id' => $category->id,
                'title' => 'updated title',
            ]
        );

        $this->assertDatabaseHas('categories', [
            'title' => 'updated title',
            'account_type' => Payment::ACCOUNT_TYPE_LEDGER,
        ]);

        $actual = Category::find($category->id);

        $this->assertNotNull($actual);
        $this->assertEquals('updated title', $actual->title);
        $this->assertEquals(Payment::ACCOUNT_TYPE_LEDGER, $actual->account_type);
    }

    /** @test */
    public function it_deletes_a_category_of_ledger_account()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create([
            'account_type' => Payment::ACCOUNT_TYPE_LEDGER
        ]);

        $this->actingAs($user)->deleteJson(
            route('ledger.category.destroy', $category)
        );

        $actual = Category::find($category->id);

        $this->assertNull($actual);
    }


    /** @test */
    public function an_unauthorized_user_cannot_create_a_category_for_ledger_account()
    {
        $this->postJson(
            route('ledger.category.create'),
            [
                'title' => 'title',
                'description' => 'description',
            ]
        );

        $this->assertDatabaseCount('categories', 0);
    }

    /** @test */
    public function an_unauthorized_user_cannot_update_a_category_of_ledger_account()
    {
        $category = Category::factory()->create([
            'account_type' => Payment::ACCOUNT_TYPE_LEDGER
        ]);

        $this->patchJson(
            route('ledger.category.update', $category),
            [
                'id' => $category->id,
                'title' => 'updated title',
            ]
        );

        $this->assertDatabaseHas('categories', [
            'title' => $category->title,
        ]);
    }

    /** @test */
    public function an_unauthorized_user_cannot_delete_a_category_of_ledger_account()
    {
        $category = Category::factory()->create([
            'account_type' => Payment::ACCOUNT_TYPE_LEDGER
        ]);

        $this->deleteJson(
            route('ledger.category.destroy', $category)
        );

        $this->assertDatabaseCount('categories', 1);
    }
}
