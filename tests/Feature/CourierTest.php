<?php

use App\Models\Courier;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('paginates couriers ordered by name by default', function (): void {
    foreach ([
        'Zaki Pratama',
        'Andi Wijaya',
        'Budi Santoso',
        'Citra Lestari',
        'Dewi Anjani',
        'Eko Saputra',
        'Farhan Akbar',
        'Gita Permata',
        'Hadi Nugroho',
        'Indra Gunawan',
        'Joko Susilo',
        'Kirana Putri',
    ] as $name) {
        Courier::factory()->create(['name' => $name]);
    }

    $response = $this->getJson('/couriers?per_page=10');

    $response->assertOk()
        ->assertJsonPath('per_page', 10)
        ->assertJsonPath('current_page', 1);

    expect($response->json('data.0.name'))->toBe('Andi Wijaya');
});

it('can sort couriers by registered date', function (): void {
    Courier::factory()->create(['name' => 'Older Courier', 'registered_at' => '2025-01-01']);
    Courier::factory()->create(['name' => 'Newest Courier', 'registered_at' => '2026-01-01']);

    $response = $this->getJson('/couriers?sort=registered_at&direction=desc');

    $response->assertOk();
    expect($response->json('data.0.name'))->toBe('Newest Courier');
});

it('can search courier name by multiple keywords', function (): void {
    Courier::factory()->create(['name' => 'Budiono Hadi Agung']);
    Courier::factory()->create(['name' => 'Budi Santoso']);

    $response = $this->getJson('/couriers?search=budi+agung');

    $response->assertOk()
        ->assertJsonCount(1, 'data')
        ->assertJsonPath('data.0.name', 'Budiono Hadi Agung');
});

it('can filter couriers by comma separated levels', function (): void {
    Courier::factory()->create(['name' => 'Level One', 'level' => 1]);
    Courier::factory()->create(['name' => 'Level Two', 'level' => 2]);
    Courier::factory()->create(['name' => 'Level Three', 'level' => 3]);
    Courier::factory()->create(['name' => 'Level Four', 'level' => 4]);

    $response = $this->getJson('/couriers?level=2,3');

    $response->assertOk()->assertJsonCount(2, 'data');

    expect(collect($response->json('data'))->pluck('level')->all())->toBe([3, 2]);
});

it('shows a courier detail', function (): void {
    $courier = Courier::factory()->create(['name' => 'Detail Courier']);

    $this->getJson("/couriers/{$courier->id}")
        ->assertOk()
        ->assertJsonPath('name', 'Detail Courier');
});

it('stores a validated courier and persists it to database', function (): void {
    $payload = [
        'name' => 'Budi Agung',
        'code' => 'CRR-0001',
        'email' => 'budi@example.test',
        'phone' => '081234567890',
        'service_area' => 'Jakarta',
        'level' => 3,
        'is_active' => true,
        'registered_at' => '2026-05-26',
    ];

    $this->postJson('/couriers', $payload)
        ->assertCreated()
        ->assertJsonPath('name', 'Budi Agung');

    $this->assertDatabaseHas('couriers', [
        'code' => 'CRR-0001',
        'name' => 'Budi Agung',
        'level' => 3,
    ]);
});

it('requires complete valid input when storing a courier', function (): void {
    $this->postJson('/couriers', [
        'name' => '',
        'code' => '',
        'email' => 'not-email',
        'level' => 6,
    ])->assertUnprocessable()
        ->assertJsonValidationErrors(['name', 'code', 'email', 'level']);
});

it('updates a validated courier and persists changes to database', function (): void {
    $courier = Courier::factory()->create([
        'name' => 'Old Name',
        'code' => 'CRR-OLD',
        'email' => 'old@example.test',
    ]);

    $this->putJson("/couriers/{$courier->id}", [
        'name' => 'New Name',
        'code' => 'CRR-NEW',
        'email' => 'new@example.test',
        'phone' => '089999999',
        'service_area' => 'Bandung',
        'level' => 4,
        'is_active' => false,
        'registered_at' => '2026-05-20',
    ])->assertOk()
        ->assertJsonPath('name', 'New Name');

    $this->assertDatabaseHas('couriers', [
        'id' => $courier->id,
        'code' => 'CRR-NEW',
        'level' => 4,
        'is_active' => false,
    ]);
});

it('deletes a courier from database', function (): void {
    $courier = Courier::factory()->create();

    $this->deleteJson("/couriers/{$courier->id}")
        ->assertNoContent();

    $this->assertDatabaseMissing('couriers', [
        'id' => $courier->id,
    ]);
});
