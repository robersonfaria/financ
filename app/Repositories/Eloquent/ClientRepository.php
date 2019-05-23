<?php

namespace App\Repositories\Eloquent;


use App\Models\Client;
use App\Repositories\Contracts\ClientRepositoryContract;
use Illuminate\Support\Facades\Auth;

class ClientRepository extends AbstractRepository implements ClientRepositoryContract
{

    public function __construct(Client $repository)
    {
        parent::__construct($repository);
    }

    public function create(array $data)
    {
        $user = Auth::user();
        return $user->clients()->create($data);
    }
}