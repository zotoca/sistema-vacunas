<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Street;

class StreetTest extends TestCase
{

    use RefreshDatabase;

    public function test_it_has_a_path(){
        $street = Street::factory()->create();


        $this->assertEquals("/calles/$street->id", $street->path());
    }

    public function test_it_can_add_houses(){
        $street = Street::factory()->create();

        $house = $street->addHouse("1");

        $this->assertCount(1, $street->houses);
        $this->assertTrue($street->houses->contains($house));
    }


}
