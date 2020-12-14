<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\JsonResponse;

/**
 * Class PersonController
 * @package App\Http\Controllers
 */
class PersonController extends Controller
{

    /**
     * @return JsonResponse
     */
    public function list()
    {
        return new JsonResponse(Person::all());
    }
}
