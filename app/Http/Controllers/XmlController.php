<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Item;
use App\Models\Order;
use App\Models\Person;
use App\Models\Phone;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use SimpleXMLElement;

/**
 * Class XmlController
 * @package App\Http\Controllers
 */
class XmlController extends Controller
{

    /**
     * @param SimpleXMLElement $orderXml
     * @param array $processed
     * @return array
     */
    private static function processOrderXml(SimpleXMLElement $orderXml, array $processed)
    {
        try {
            $order = Order::find((int)$orderXml->orderid);

            if (!$order) {
                $order = new Order([
                    'id' => (int)$orderXml->orderid,
                    'person_id' => (int)$orderXml->orderperson
                ]);

                $order->save();
            }

            $addressXml = $orderXml->shipto;
            $address = new Address([
                'name' => $addressXml->name,
                'address' => $addressXml->address,
                'city' => $addressXml->city,
                'country' => $addressXml->country,
            ]);
            $order->address()->save($address);

            foreach ($orderXml->items->item as $itemXml) {
                $item = new Item([
                    'title' => (string)$itemXml->title,
                    'note' => (string)$itemXml->note,
                    'quantity' => (string)$itemXml->quantity,
                    'price' => (string)$itemXml->price,
                ]);

                $order->items()->save($item);
            }

            $processed[] = $order;
        } catch (\Exception $exception) {
            $processed[] = 'An Error Occurred with id ' . $orderXml->orderid . ' - ' . $exception->getMessage();
        }

        return $processed;
    }

    /**
     * @param SimpleXMLElement $personXml
     * @param array $processed
     * @return array
     */
    private static function processPeopleXml(SimpleXMLElement $personXml, array $processed)
    {
        try {
            $person = Person::find((int)$personXml->personid);

            if (!$person) {
                $person = new Person([
                    'id' => (int)$personXml->personid,
                    'name' => (string)$personXml->personname,
                ]);
                $person->save();
            }

            foreach ($personXml->phones->phone as $phoneXml) {
                $phone = new Phone([
                    'number' => (string)$phoneXml[0]
                ]);

                $person->phones()->save($phone);
            }

            $processed[] = $person;
        } catch (\Exception $exception) {
            $processed[] = 'An Error Occurred with id ' . $personXml->personid . ' - ' . $exception->getMessage();
        }

        return $processed;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function upload(Request $request): JsonResponse
    {
        $request->validate(['file' => 'required']);

        try {
            $file = $request->file('file');

            $xml_string = $file->getContent();
            $xml = new SimpleXMLElement($xml_string);
            $processed = [];

            foreach ($xml as $key => $elements) {
                switch ($key) {
                    case 'person':
                        $processed = self::processPeopleXml($elements, $processed);
                        break;
                    case 'shiporder':
                        $processed = self::processOrderXml($elements, $processed);
                        break;
                }
            }
        } catch (\Exception $e) {
            return new JsonResponse('An Error Occurred: ' . $e->getMessage(), $e->getCode());
        }

        return new JsonResponse($processed);
    }
}
