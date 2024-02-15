<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\ClassRoom;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\ClassRoomController
 */
final class ClassRoomControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $classRooms = ClassRoom::factory()->count(3)->create();

        $response = $this->get(route('class-room.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $classRoom = ClassRoom::factory()->create();

        $response = $this->get(route('class-room.show', $classRoom));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ClassRoomController::class,
            'store',
            \App\Http\Requests\Api\ClassRoomStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_responds_with(): void
    {
        $name = $this->faker->name();

        $response = $this->post(route('class-room.store'), [
            'name' => $name,
        ]);

        $classRooms = ClassRoom::query()
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $classRooms);
        $classRoom = $classRooms->first();

        $response->assertNoContent(201);
    }
}
