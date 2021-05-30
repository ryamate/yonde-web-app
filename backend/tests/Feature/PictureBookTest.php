<?php

namespace Tests\Feature;

use App\PictureBook;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PictureBookTest extends TestCase
{
    // use RefreshDatabase;

    // public function testIsLikedByNull()
    // {
    //     $pictureBook = factory(PictureBook::class)->create();

    //     $result = $pictureBook->isLikedBy(null);

    //     $this->assertFalse($result);
    // }

    // public function testIsLikedByTheUser()
    // {
    //     $pictureBook = factory(PictureBook::class)->create();
    //     $user = factory(User::class)->create();
    //     $pictureBook->likes()->attach($user);

    //     $result = $pictureBook->isLikedBy($user);

    //     $this->assertTrue($result);
    // }

    // public function testIsLikedByAnother()
    // {
    //     $pictureBook = factory(PictureBook::class)->create();
    //     $user = factory(User::class)->create();
    //     $another = factory(User::class)->create();
    //     $pictureBook->likes()->attach($another);

    //     $result = $pictureBook->isLikedBy($user);

    //     $this->assertFalse($result);
    // }
}
