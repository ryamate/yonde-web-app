<?php

namespace Tests\Feature\Http\Controllers;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PictureBookControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testHome()
    {
        $response = $this->get(route('picture_books.home'));

        $response->assertStatus(200)
            ->assertViewIs('picture_books.home');
    }

    public function testAbout()
    {
        $response = $this->get(route('picture_books.about'));

        $response->assertStatus(200)
            ->assertViewIs('picture_books.about');
    }

    public function testIndex()
    {
        $response = $this->get(route('picture_books.index'));

        $response->assertStatus(200)
            ->assertViewIs('picture_books.index');
    }

    public function testGuestCreate()
    {
        $response = $this->get(route('picture_books.create'));

        $response->assertRedirect(route('login'));
    }

    public function testAuthCreate()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get(route('picture_books.create'));

        $response->assertStatus(200)
            ->assertViewIs('picture_books.create');
    }
}