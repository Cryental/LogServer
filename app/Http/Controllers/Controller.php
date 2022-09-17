<?php

namespace App\Http\Controllers;

use App\Models\Token;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function checkToken($token) {
        $checkDB = Token::query()->where('token', $token)->first();

        return !empty($checkDB);
    }
}