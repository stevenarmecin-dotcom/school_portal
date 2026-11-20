<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Course;
use App\Models\Phone;
use App\Models\Post;
use App\Models\Student;
use App\Models\User;
use App\Models\UserPhone;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_displays_database_content(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create([
            'user_id' => $user->id,
            'title' => 'Dashboard sample post',
        ]);
        $comment = Comment::factory()->create([
            'post_id' => $post->id,
            'body' => 'Dashboard sample comment',
        ]);
        $course = Course::factory()->create([
            'title' => 'Dashboard sample course',
        ]);
        $student = Student::factory()->create([
            'name' => 'Dashboard sample student',
        ]);
        $student->courses()->attach($course);
        $userPhone = UserPhone::factory()->create([
            'name' => 'Dashboard sample contact',
        ]);
        Phone::factory()->create([
            'user_phone_id' => $userPhone->id,
            'phone_number' => '555-0100',
        ]);

        $this->actingAs($user)
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSee(route('students.store'))
            ->assertSee('Add student')
            ->assertSee(route('posts.store'))
            ->assertSee('Add post')
            ->assertSee(route('courses.store'))
            ->assertSee('Add course')
            ->assertSee(route('phone-records.store'))
            ->assertSee('Add phone record')
            ->assertSee(route('comments.store', $post))
            ->assertSee($post->title)
            ->assertSee($comment->body)
            ->assertSee($course->title)
            ->assertSee($student->name)
            ->assertSee($userPhone->name)
            ->assertSee('555-0100');
    }

    public function test_authenticated_user_can_add_a_student_from_the_dashboard(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('students.store'), ['name' => 'New student'])
            ->assertRedirect(route('dashboard'));

        $this->assertDatabaseHas('students', ['name' => 'New student']);
    }

    public function test_student_name_is_required_when_adding_a_student(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->from(route('dashboard'))
            ->post(route('students.store'), ['name' => ''])
            ->assertRedirect(route('dashboard'))
            ->assertSessionHasErrors('name');

        $this->assertDatabaseCount('students', 0);
    }

    public function test_authenticated_user_can_add_a_post_and_comment(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('posts.store'), [
                'post_title' => 'New post',
                'post_body' => 'Post content',
            ])
            ->assertRedirect(route('dashboard'));

        $post = Post::where('title', 'New post')->firstOrFail();
        $this->assertSame($user->id, $post->user_id);

        $this->post(route('comments.store', $post), [
            'comment_body_'.$post->id => 'New comment',
        ])->assertRedirect(route('dashboard'));

        $this->assertDatabaseHas('comments', [
            'post_id' => $post->id,
            'body' => 'New comment',
        ]);
    }

    public function test_authenticated_user_can_add_a_course_and_phone_record(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('courses.store'), ['course_title' => 'New course'])
            ->assertRedirect(route('dashboard'));

        $this->post(route('phone-records.store'), [
            'contact_name' => 'New contact',
            'phone_number' => '555-0199',
        ])->assertRedirect(route('dashboard'));

        $this->assertDatabaseHas('courses', ['title' => 'New course']);
        $this->assertDatabaseHas('user_phones', ['name' => 'New contact']);
        $this->assertDatabaseHas('phones', ['phone_number' => '555-0199']);
    }
}
