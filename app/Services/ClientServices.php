<?php

namespace App\Services;


use App\Models\Client;
use Illuminate\Support\Facades\Auth;

class ClientServices
{

    public function store(array $data)
    {
        return Auth::user()->clients()->create($data);
    }
}
