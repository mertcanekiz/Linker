<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class VisitTest extends TestCase
{
  use DatabaseMigrations;

  /**
   * Visits should have a Link
   *
   * @test
   * @return void
   */
  public function it_should_have_a_link()
  {
    $visit = create('App\Visit');
    $this->assertInstanceOf('App\Link', $visit->link);
  }
}
