@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">
                        <div class="text-center">@lang('Ссылки для регистрации')</div>
                    </div>
                    <div class="card-body">
                        @foreach($links as $link)
                            <div class="d-flex justify-content-evenly mb-3">
                                <div class="w-75">{{ route('register.store', $link->hash) }}</div>
                                <form class="align-self-center" method="post" action="{{ route('link.delete', $link->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">X</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                    <div class="card-footer">
                        <form class="text-center" method="post" action="{{ route('link.store') }}">
                            @csrf
                            <button class="btn btn-primary">@lang('Создать новую ссылку')</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
