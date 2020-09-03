<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LinkTest extends TestCase
{
  use DatabaseMigrations;

  /**
   * Links should have an owner of type App\User
   *
   * @test
   * @return void
   */
  public function it_should_have_an_owner()
  {
    $this->signIn();
    $link = factory('App\Link')->create([
      'user_id' => Auth::id()
    ]);
    $this->assertInstanceOf('App\User', $link->owner);
  }

  /**
   * Links should have valid URLs
   *
   * @test
   * @return void
   */
  public function it_should_have_a_valid_url()
  {
    $link = create('App\Link');
    $this->assertTrue(filter_var($link->url, FILTER_VALIDATE_URL) !== false);
  }

  /**
   * Links should have titles
   *
   * @test
   * @return void
   */
  public function it_should_have_a_title()
  {
    $this->withoutExceptionHandling();
    $link = create('App\Link');
    $this->assertNotNull($link->title);
    $this->assertIsString($link->title);
  }

  /**
   * Links should have visits
   *
   * @test
   * @return void
   */
  public function it_should_have_visits()
  {
    $link = create('App\Link');
    create('App\Visit', ['link_id' => $link->id]);
    $this->assertInstanceOf('App\Visit', $link->visits->first());
  }
}
