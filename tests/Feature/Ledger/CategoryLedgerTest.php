<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Str;

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
        $expected = self::buildCategory();
        $input = self::getInput($expected);

        $this->actingAs($user)->postJson(
            route('ledger.category.create'),
            $input
        );

        $actual = Category::first();
        $this->assertCategoryEqual($expected, $actual);
    }

    /** @test */
    public function it_updates_a_category_of_ledger_account()
    {
        $user = User::factory()->create();
        $category = self::createCategory();
        $input = self::getInputWithChanges($category, [
            'title' => 'My Updated Title',
            'description' => 'My Updated Description',
        ]);

        $this->actingAs($user)->patchJson(
            route('ledger.category.update', $category),
            $input
        );

        $actual = Category::find($category->id);
        $this->assertEquals('My Updated Title', $actual->title);
        $this->assertEquals('My Updated Description', $actual->description);
    }

    /** @test */
    public function it_deletes_a_category_of_ledger_account()
    {
        $user = User::factory()->create();
        $shop = self::createCategory();

        $this->actingAs($user)->deleteJson(
            route('ledger.category.destroy', $shop)
        );

        $actual = Category::find($shop->id);
        $this->assertNull($actual);
    }

    /** @test */
    public function an_unauthorized_user_cannot_create_a_category_for_ledger_account()
    {
        $category = self::buildCategory();
        $input = self::getInput($category);

        $this->postJson(
            route('ledger.category.create'),
            $input
        );

        $actual = Category::first();
        $this->assertNull($actual);
    }

    /** @test */
    public function an_unauthorized_user_cannot_update_a_category_of_ledger_account()
    {
        $category = self::createCategory();
        $input = self::getInputWithChanges($category, [
            'title' => 'My Updated Title',
            'description' => 'My Updated Description',
        ]);

        $this->patchJson(
            route('ledger.category.update', $category),
            $input
        );

        $actual = Category::find($category->id);
        $this->assertEquals($category->description, $actual->description);
    }

    /** @test */
    public function an_unauthorized_user_cannot_delete_a_category_of_ledger_account()
    {
        $category = self::createCategory();

        $this->deleteJson(
            route('ledger.category.destroy', $category)
        );

        $actual = Category::find($category->id);
        $this->assertNotNull($actual);
    }

    private static function buildCategory(): Category
    {
        $title = 'title';

        return new Category([
            'account_type' => Payment::ACCOUNT_TYPE_LEDGER,
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => 'description',
        ]);
    }

    private static function createCategory()
    {
        $category = self::buildCategory();
        self::save($category);

        return $category;
    }

    private static function save(Category $category)
    {
        $user = User::factory()->create();

        $category->creator_id = $user->id;
        $category->created_at = Carbon::now();
        $category->updated_at = Carbon::now();
        $category->save();
    }

    private static function getInput(Category $expected): array
    {
        return [
            'account_type' => $expected->payment_type,
            'title' => $expected->title,
            'description' => $expected->description,
        ];
    }

    private static function getInputWithChanges(
        Category $expected,
        array $changes
    ) {
        $original = self::getInput($expected);

        return array_merge($original, $changes);
    }
}
