<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Lecture;
use App\Models\SubjectClassRoomGroupTeacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\LectureController
 */
final class LectureControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $lectures = Lecture::factory()->count(3)->create();

        $response = $this->get(route('lecture.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $lecture = Lecture::factory()->create();

        $response = $this->get(route('lecture.show', $lecture));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\LectureController::class,
            'store',
            \App\Http\Requests\Api\LectureStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_responds_with(): void
    {
        $start_time = $this->faker->dateTime();
        $end_time = $this->faker->dateTime();
        $day_of_week = $this->faker->word();
        $subject_class_room_group_teacher = SubjectClassRoomGroupTeacher::factory()->create();

        $response = $this->post(route('lecture.store'), [
            'start_time' => $start_time,
            'end_time' => $end_time,
            'day_of_week' => $day_of_week,
            'subject_class_room_group_teacher_id' => $subject_class_room_group_teacher->id,
        ]);

        $lectures = Lecture::query()
            ->where('start_time', $start_time)
            ->where('end_time', $end_time)
            ->where('day_of_week', $day_of_week)
            ->where('subject_class_room_group_teacher_id', $subject_class_room_group_teacher->id)
            ->get();
        $this->assertCount(1, $lectures);
        $lecture = $lectures->first();

        $response->assertNoContent(201);
    }
}
