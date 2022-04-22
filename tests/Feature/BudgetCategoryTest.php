<?php

namespace Tests\Feature;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BudgetCategoryTest extends TestCase
{
    use RefreshDatabase;


    protected function setUp(): void
    {
        $this->actingAs($user = User::factory()->create());
    }

    /** @test */
    public function it_creates_a_category_for_budget_account()
    {
        $response = $this
            ->post('/budget/categories/create', [
                'title' => 'Test Category',
                'description' => 'Description',
            ]);

        $this->assertDatabaseHas('categories', [
            'account_type' => Payment::ACCOUNT_TYPE_BUDGET,
            'title' => 'Test Category',
        ]);
    }
}
