<?php

namespace Tests\Feature\Budget;

use App\Models\Payment;
use App\Models\Shop;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Str;

class ShopTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_authorized_user_can_visit_shops()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/budget/shops');

        $response->assertOk();
    }

    /** @test */
    public function an_unauthorized_user_cannot_visit_shops()
    {
        $response = $this->get('/budget/shops');

        $response->assertRedirect();
    }

    /** @test */
    public function it_creates_a_shop()
    {
        $user = User::factory()->create();
        $expected = self::buildShop();
        $input = self::getInput($expected);

        $this->actingAs($user)->postJson(
            route('budget.shop.create'),
            $input
        );

        $actual = Shop::first();
        $this->assertShopsEqual($expected, $actual);
    }

    /** @test */
    public function it_updates_a_shop()
    {
        $user = User::factory()->create();
        $shop = self::createShop();
        $input = self::getInputWithChanges($shop, [
            'title' => 'My Updated Title',
            'description' => 'My Updated Description',
        ]);

        $this->actingAs($user)->patchJson(
            route('budget.shop.update', $shop),
            $input
        );

        $actual = Shop::find($shop->id);
        $this->assertEquals('My Updated Title', $actual->title);
        $this->assertEquals('My Updated Description', $actual->description);
    }

    /** @test */
    public function it_deletes_a_shop()
    {
        $user = User::factory()->create();
        $shop = self::createShop();

        $this->actingAs($user)->deleteJson(
            route('budget.shop.destroy', $shop)
        );

        $actual = Payment::find($shop->id);
        $this->assertNull($actual);
    }

    /** @test */
    public function an_unauthorized_user_cannot_create_a_shop()
    {
        $shop = self::buildShop();
        $input = self::getInput($shop);

        $this->postJson(
            route('budget.shop.create'),
            $input
        );

        $actual = Shop::first();
        $this->assertNull($actual);
    }

    /** @test */
    public function an_unauthorized_user_cannot_update_a_shop()
    {
        $shop = self::createShop();
        $input = self::getInputWithChanges($shop, [
            'description' => 'My Updated Description',
        ]);

        $this->patchJson(
            route('budget.shop.create', $shop),
            $input
        );

        $actual = Shop::find($shop->id);
        $this->assertEquals($shop->description, $actual->description);
    }

    /** @test */
    public function an_unauthorized_user_cannot_delete_a_shop()
    {
        $shop = self::createShop();

        $this->deleteJson(
            route('budget.shop.destroy', $shop)
        );

        $actual = Shop::find($shop->id);
        $this->assertNotNull($actual);
    }

    private static function buildShop()
    {
        $title = 'title';

        return new Shop([
            'account_type' => Payment::ACCOUNT_TYPE_BUDGET,
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => 'description',
        ]);
    }

    private static function createShop()
    {
        $shop = self::buildShop();
        self::save($shop);

        return $shop;
    }

    private static function save(Shop $shop)
    {
        $user = User::factory()->create();

        $shop->creator_id = $user->id;
        $shop->created_at = Carbon::now();
        $shop->updated_at = Carbon::now();
        $shop->save();
    }

    private static function getInput(Shop $expected): array
    {
        return [
            'account_type' => $expected->payment_type,
            'title' => $expected->title,
            'description' => $expected->description,
        ];
    }

    private static function getInputWithChanges(
        Shop $expected,
        array $changes
    ) {
        $original = self::getInput($expected);

        return array_merge($original, $changes);
    }
}
