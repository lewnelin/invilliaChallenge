<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Person;
use App\Models\Phone;
use Illuminate\Http\Request;
use SimpleXMLElement;

/**
 * Class XmlController
 * @package App\Http\Controllers
 */
class XmlController extends Controller
{

    private static function processOrderXml(SimpleXMLElement $orderXml)
    {
        $order = new Order([
            'id' => (int)$orderXml->orderid,
            'person_id' => (int)$orderXml->orderperson
        ]);

        $order->save();

//        foreach ($orderXml->phones->phone as $phoneXml) {
//            $phone = new Phone([
//                'number' => (string)$phoneXml[0]
//            ]);
//
//            $order->phones()->save($phone);
//        }

        return $order->id;
    }

    /**
     * @param SimpleXMLElement $personXml
     * @return int
     */
    private static function processPeopleXml(SimpleXMLElement $personXml)
    {
        $person = new Person([
            'id' => (int)$personXml->personid,
            'name' => (string)$personXml->personname,
        ]);
        $person->save();

        foreach ($personXml->phones->phone as $phoneXml) {
            $phone = new Phone([
                'number' => (string)$phoneXml[0]
            ]);

            $person->phones()->save($phone);
        }

        return $person->id;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function upload(Request $request)
    {
        $request->validate(['file' => 'required']);
        $file = $request->file('file');

        $xml_string = $file->getContent();
        $xml = new SimpleXMLElement($xml_string);
        $processed = [];

        foreach ($xml as $key => $elements) {
            switch ($key) {
                case 'person':
                    $id = self::processPeopleXml($elements);
                    $processed[] = $id;
                    break;
                case 'shiporder':
                    $id = self::processOrderXml($elements);
                    $processed[] = $id;
                    break;
            }
        }

        return $processed;
    }
}
