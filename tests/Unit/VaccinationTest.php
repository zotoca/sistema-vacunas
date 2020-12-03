<?php

namespace Tests\Unit;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\Vaccination;

class VaccinationTest extends TestCase
{

    use RefreshDatabase;

    public function test_it_has_a_path(){
        $vaccination = Vaccination::factory()->create();

        $this->assertEquals("/vacunas/$vaccination->id", $vaccination->path());
    }



}
