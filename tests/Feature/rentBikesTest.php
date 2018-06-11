<?php

namespace Tests\Feature;

use Tests\TestCase;
use DateTime;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class rentBikesTest extends TestCase
{


    /**
     * Test to rent bikes by dates
     *
     * @return void
     */
    public function testRentBikesByDate()
    {

      $requestParams = [
        'inputBike' => 3,
        'dateStart' => new DateTime('2018-06-01 09:00:00'),
        'dateEnd'   => new DateTime('2018-06-21 09:00:00')
      ];

     $response =  $this->call('POST', '/rentbydates', $requestParams);

     $this->assertTrue($response->isOk(), "Wrong params");

    }

    /**
     * Test to get should user view home
     *
     * @return void
     */
    public function testHomeGet()
    {

      $response = $this->get('/');

      $response->assertStatus(200);
      $response->assertSeeText("Intive FDV test");
      $response->assertSeeText("ACME RENTAL'S BIKES");
      $response->assertSeeText("Please input the Quantity of bikes you may want to rent");
      $response->assertSeeText("# Bikes");
      $response->assertSeeText("Rent");
      $response->assertSessionMissing('inputBike');
      $response->assertViewIs("home");

      $this->assertTrue($response->isOk(), "Wrong params");

    }

    /**
     * Test to post and render a view to show information
     *
     * @return void
     */
    public function testHomePost()
    {

      $requestParams = [
        'inputBike' => 3,
      ];

     $response =  $this->call('POST', '/', $requestParams);

     $response->assertSeeText("Intive FDV test");
     $response->assertSeeText("ACME RENTAL'S BIKES");
     $response->assertSeeText("Thanks to use ACME RENTAL'S BIKES service.");
     $response->assertSeeText("Your bikes");
     $response->original->getData()['bikes'];
     $response->assertViewHas("bikes", !null);
     $response->assertViewHas("byHour", !null);
     $response->assertViewHas("byDay", !null);
     $response->assertViewHas("byWeek", !null);
     $response->assertViewIs("success");
     $this->assertTrue($response->isOk(), "Wrong params");


    }

}
