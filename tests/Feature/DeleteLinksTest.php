<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class DeleteLinksTest extends TestCase
{
  use DatabaseMigrations;

  /**
   * Unauthenticated users may not delete links
   *
   * @test
   * @return void
   */
  public function unauthenticated_users_may_not_delete_links()
  {
    $link = create('App\Link');
    $this->delete(route('links.destroy', $link))
      ->assertRedirect(route('login'));
  }

  /**
   * Authenticated users may delete their own links
   *
   * @test
   * @return void
   */
  public function authenticated_users_may_delete_their_own_links()
  {
    $this->signIn();
    $link = create('App\Link', ['user_id' => Auth::id()]);
    $this->delete(route('links.destroy', $link));
    $this->assertDatabaseMissing('links', ['id' => $link->id]);
  }

  /**
   * Authenticated users may not delete other users' links
   *
   * @test
   * @return void
   */
  public function it_authenticated_users_may_not_delete_other_users_links()
  {
    $this->signIn();
    $link = create('App\Link');
    $this->delete(route('links.destroy', $link))
      ->assertStatus(403);
    $this->assertDatabaseHas('links', ['id' => $link->id]);
  }
}
