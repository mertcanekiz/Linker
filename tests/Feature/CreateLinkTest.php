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
    $this->signIn();
    $link = make('App\Link', ['user_id' => Auth::id()]);
    $this->post(route('links.store'), $link->toArray())
      ->assertStatus(302);
    $this->assertDatabaseHas('links', $link->toArray());
  }

  /**
   * Any user can visit any link
   *
   * @test
   * @return void
   */
  public function any_user_can_visit_any_link()
  {
    $this->withoutExceptionHandling();
    $link = create('App\Link');
    $this->post(route('links.visit', $link))
      ->assertStatus(200);
    $this->assertDatabaseHas('visits', ['link_id' => $link->id]);
  }
}
