<?php

namespace Tests\Unit;

use App\Models\Person;
use PHPUnit\Framework\TestCase;

/**
 * Class PersonTest
 * @package Tests\Unit
 */
class PersonTest extends TestCase
{

    /**
     * Unit test person.
     *
     * @return void
     */
    public function testCreate()
    {
        $person = new Person([
            'id' => 1,
            'name' => 'Arthur'
        ]);

        $this->assertEquals('Arthur', $person->name);
    }
}
