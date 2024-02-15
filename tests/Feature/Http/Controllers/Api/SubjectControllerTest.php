<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Subject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\SubjectController
 */
final class SubjectControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $subjects = Subject::factory()->count(3)->create();

        $response = $this->get(route('subject.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $subject = Subject::factory()->create();

        $response = $this->get(route('subject.show', $subject));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\SubjectController::class,
            'store',
            \App\Http\Requests\Api\SubjectStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_responds_with(): void
    {
        $name = $this->faker->name();

        $response = $this->post(route('subject.store'), [
            'name' => $name,
        ]);

        $subjects = Subject::query()
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $subjects);
        $subject = $subjects->first();

        $response->assertNoContent(201);
    }
}
