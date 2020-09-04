<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class DashboardTest extends TestCase
{
  use DatabaseMigrations;

  /**
   * Change the ordering of the links
   *
   * @test
   * @return void
   */
  public function an_authenticated_user_can_change_ordering_of_their_links()
  {
    $this->withoutExceptionHandling();
    $this->signIn();
    $user = Auth::user();
    create('App\Link', ['user_id' => $user->id], 3);
    $ordering = [2, 3, 1];
    $this->post('/changeorder', [
      'ordering' => $ordering
    ])->assertStatus(200);
    $this->assertEquals(collect($ordering), $user->links()->orderBy('ordering', 'asc')->pluck('id'));
  }

  /**
   * Changing the ordering with invalid id's should fail
   *
   * @test
   * @return void
   */
  public function ordering_can_not_be_changed_with_invalid_ids()
  {
    $this->signIn();
    $user = Auth::user();
    create('App\Link', ['user_id' => $user->id], 3);
    $ordering = [2, 3, 999];
    $this->post('/changeorder', [
      'ordering' => $ordering
    ])->assertStatus(400);
  }
}
