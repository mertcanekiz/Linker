<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class EditLinksTest extends TestCase
{
  use DatabaseMigrations;
  /**
   * Unauthenticated users may not edit links
   *
   * @test
   * @return void
   */
  public function unauthenticated_users_may_not_edit_links()
  {
    $link = create('App\Link');
    $this->get(route('links.edit', $link))
      ->assertRedirect(route('login'));
    $this->patch(route('links.update', $link))
      ->assertRedirect(route('login'));
  }

  /**
   * Authenticated users may edit their own links
   *
   * @test
   * @return void
   */
  public function authenticated_users_may_only_edit_their_own_links()
  {
    $this->signIn();
    $link = create('App\Link', ['user_id' => Auth::id()]);

    $updatedLink = [
      'title' => 'Updated title',
      'url' => 'http://updated.com'
    ];

    $this->patch(route('links.update', $link), $updatedLink);
    $this->assertDatabaseHas('links', $updatedLink);

  }

  /**
   * Authenticated users may not edit other users' links
   *
   * @test
   * @return void
   */
  public function authenticated_users_may_not_edit_other_users_links()
  {
    $this->signIn();
    $link = create('App\Link');

    $updatedLink = [
      'title' => 'Updated title',
      'url' => 'http://updated.com'
    ];

    $this->patch(route('links.update', $link), $updatedLink)
      ->assertStatus(403);
  }
}
