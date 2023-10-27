@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card w">
                    <div class="card-header">@lang('Новая задача')</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('task.store') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">@lang('Название')</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="category" class="col-md-4 col-form-label text-md-end">@lang('Категория')</label>
                                <div class="col-md-6">
                                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                                    <div class="wrapper">
                                        <select id="category" class=" editableBox">
                                            @foreach($categories as $category)
                                                <option value="{{ $category->name }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        <input class="timeTextBox @error('category') is-invalid @enderror" required autocomplete="category" value="{{ old('category') }}" name="category" maxlength="5"/>
                                    </div>
                                    @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="description" class="col-md-4 col-form-label text-md-end">@lang('Описание')</label>

                                <div class="col-md-6">

                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="10" required autocomplete="description">{{ old('description') }}</textarea>

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="start" class="col-md-4 col-form-label text-md-end">@lang('Начало выполнения')</label>

                                <div class="col-md-6">
                                    <input id="start" type="datetime-local" class="form-control @error('start') is-invalid @enderror" name="start" value="{{ old('start') }}" autocomplete="start">

                                    @error('start')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="end" class="col-md-4 col-form-label text-md-end">@lang('Конец выполнения')</label>

                                <div class="col-md-6">
                                    <input id="end" type="datetime-local" class="form-control @error('end') is-invalid @enderror" name="end" value="{{ old('end') }}" autocomplete="end">

                                    @error('end')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="priority" class="col-md-4 col-form-label text-md-end">@lang('Приоритет')</label>

                                <div class="col-md-6">

                                    <select class="form-select @error('priority') is-invalid @enderror" name="priority" id="priority">
                                        <option value="5">Очень высокий</option>
                                        <option value="4">Высокий</option>
                                        <option value="3" selected>Средний</option>
                                        <option value="2">Низкий</option>
                                        <option value="1">Очень низкий</option>
                                    </select>

                                    @error('priority')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="responsibles" class="col-md-4 col-form-label text-md-end">@lang('Ответственные')</label>

                                <div class="col-md-6">

                                    <select multiple class="form-select @error('responsibles') is-invalid @enderror" name="responsibles[]" id="responsibles">
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->last_name }}  {{ $user->first_name }}</option>
                                        @endforeach
                                    </select>

                                    @error('responsibles')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        @lang('Добавить')
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
