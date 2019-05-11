@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Clientes') }}</div>
                    <form action="{{ action('ClientController@store') }}" method="POST">
                        @csrf()
                        <div class="card-body">
                            <div class="form-row">
                                {{--@dd($errors)--}}
                                <div class="col-md-6 mb-3">
                                    <label for="name">{{ __('Nome') }}</label>
                                    <input type="text" class="form-control @if ($errors->has('name')) is-invalid @endif" name="name" placeholder="{{ __("Nome") }}">
                                    @if ($errors->has('name'))
                                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary" type="submit">{{ __('Enviar') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
