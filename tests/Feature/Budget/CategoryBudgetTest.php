<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryBudgetTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_authorized_user_can_visit_budget_categories()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/budget/categories');

        $response->assertOk();
    }

    /** @test */
    public function an_unauthorized_user_cannot_visit_budget_categories()
    {
        $response = $this->get('/budget/categories');

        $response->assertRedirect();
    }

    /** @test */
    public function it_creates_a_category_for_budget_account()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->postJson(
            route('budget.category.create'),
            [
                'title' => 'title',
                'description' => 'description',
            ]
        );

        $this->assertDatabaseHas('categories', [
            'title' => 'title',
            'account_type' => Payment::ACCOUNT_TYPE_BUDGET,
        ]);
    }

    /** @test */
    public function it_updates_a_category_of_budget_account()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create([
            'account_type' => Payment::ACCOUNT_TYPE_BUDGET
        ]);

        $this->actingAs($user)->patchJson(
            route('budget.category.update', $category),
            [
                'id' => $category->id,
                'title' => 'updated title',
            ]
        );

        $this->assertDatabaseHas('categories', [
            'title' => 'updated title',
            'account_type' => Payment::ACCOUNT_TYPE_BUDGET,
        ]);
    }

    /** @test */
    public function it_deletes_a_category_of_budget_account()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create([
            'account_type' => Payment::ACCOUNT_TYPE_BUDGET
        ]);

        $this->actingAs($user)->deleteJson(
            route('budget.category.destroy', $category)
        );

        $this->assertDatabaseMissing('categories', [
            'id' => $category->id,
        ]);
    }

    /** @test */
    public function an_unauthorized_user_cannot_create_a_category_for_budget_account()
    {
        $this->postJson(
            route('budget.category.create'),
            [
                'title' => 'title',
                'description' => 'description',
            ]
        );

        $this->assertDatabaseCount('categories', 0);
    }

    /** @test */
    public function an_unauthorized_user_cannot_update_a_category_of_budget_account()
    {
        $category = Category::factory()->create([
            'account_type' => Payment::ACCOUNT_TYPE_BUDGET
        ]);

        $this->patchJson(
            route('budget.category.update', $category),
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
    public function an_unauthorized_user_cannot_delete_a_category_of_budget_account()
    {
        $category = Category::factory()->create([
            'account_type' => Payment::ACCOUNT_TYPE_BUDGET
        ]);

        $this->deleteJson(
            route('budget.category.destroy', $category)
        );

        $this->assertDatabaseCount('categories', 1);
    }
}
