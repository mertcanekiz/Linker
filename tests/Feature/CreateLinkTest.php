<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CreateLinkTest extends TestCase
{
  use DatabaseMigrations;
  /**
   * Unauthenticated users can not create links
   *
   * @test
   * @return void
   */
  public function unauthenticated_users_can_not_create_links()
  {
    $this->post(route('links.store'), [])
      ->assertRedirect(route('login'));
  }

  /**
   * Authenticated users may create links
   *
   * @test
   * @return void
   */
  public function it_authenticated_users_may_create_links()
  {
    $this->withoutExceptionHandling();
    $this->signIn();
    $link = make('App\Link', ['user_id' => Auth::id()]);
    $this->post(route('links.store'), $link->toArray())
      ->assertStatus(302);
    $this->assertDatabaseHas('links', $link->toArray());
  }
}
