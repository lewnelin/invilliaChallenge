<?php

namespace Tests\Unit;

use App\Models\Address;
use App\Models\Item;
use App\Models\Order;
use App\Models\Person;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

/**
 * Class OrderTest
 * @package Tests\Unit
 */
class OrderTest extends TestCase
{

    /**
     * Unit test Order.
     *
     * @return void
     */
    public function testCreate()
    {
        $shipOrder = new Order();
        $items = new Collection([
            new Item([
                'title' => 'Item 1',
                'note' => 'Note 1',
                'quantity' => 100,
                'price' => 21.2,
                'order_id' => $shipOrder->id
            ]),
            new Item([
                'title' => 'Item 1',
                'note' => 'Note 1',
                'quantity' => 50,
                'price' => 53.2,
                'order_id' => $shipOrder->id
            ]),
        ]);

        $shipOrder->items = $items;

        $shipTo = new Address([
            'name' => 'Place 1',
            'address' => 'Address 1',
            'city' => 'City 1',
            'country' => 'Country 1'
        ]);
        $shipOrder->address = $shipTo;

        $person = new Person(['name' => 'Name 6']);
        $shipOrder->person = $person;

        $this->assertTrue($shipOrder instanceof Order);
    }
}
