<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


use App\Models\House;

class HouseTest extends TestCase
{
    use RefreshDatabase;

    
    public function test_it_belongs_to_a_street(){
        $house = House::factory()->create();

        $this->assertInstanceOf("App\Models\Street", $house->street);
    }

    public function test_it_has_a_path(){
        $house = House::factory()->create();

        $this->assertEquals("/casas/$house->id", $house->path());
    }




}
