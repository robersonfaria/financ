<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Repositories\Contracts\ClientRepositoryContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{

    /**
     * @var ClientRepositoryContract
     */
    private $clientRepository;

    public function __construct(ClientRepositoryContract $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create', ['user' => request()->user()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        try {
            $this->clientRepository->create($request->all());
            flash(__('Successfully saved registration'), 'alert-success');
            return redirect()
                ->route('home');
        } catch (\Exception $e) {
            report($e);
            flash(__('Error writing record'), 'alert-danger');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Client $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
}
