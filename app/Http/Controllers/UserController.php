<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{

    /**
     * @return JsonResponse
     */
    public function list()
    {
        return new JsonResponse(User::all());
    }
}
