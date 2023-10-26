@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">@lang('Новая задача')</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('task.update', $task->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <label for="status" class="col-md-4 col-form-label text-md-end">@lang('Статус')</label>

                                <div class="col-md-6">

                                    <select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
                                        <option value="in process" @if($task->status === "in process") selected @endif>@lang('in process')</option>
                                        <option value="completed" @if($task->status === "completed") selected @endif>@lang('completed')</option>
                                        <option value="postponed" @if($task->status === "postponed") selected @endif>@lang('postponed')</option>
                                    </select>

                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">@lang('Название')</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $task->name }}" required autocomplete="name" autofocus>

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
                                    <input id="category" type="text" class="form-control @error('category') is-invalid @enderror" name="category" value="{{ $task->category->name }}" required autocomplete="category">

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

                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="10" required autocomplete="description">{{ $task->description }}</textarea>

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
                                    <input id="start" type="datetime-local" class="form-control @error('start') is-invalid @enderror" name="start" value="{{ $task->start }}" autocomplete="start">

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
                                    <input id="end" type="datetime-local" class="form-control @error('end') is-invalid @enderror" name="end" value="{{ $task->end }}" autocomplete="end">

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

                                    <select class="form-control @error('priority') is-invalid @enderror" name="priority" id="priority">
                                        <option value="5" @if($task->priority === 5) selected @endif>Очень высокий</option>
                                        <option value="4" @if($task->priority === 4) selected @endif>Высокий</option>
                                        <option value="3" @if($task->priority === 3) selected @endif>Средний</option>
                                        <option value="2" @if($task->priority === 2) selected @endif>Низкий</option>
                                        <option value="1" @if($task->priority === 1) selected @endif>Очень низкий</option>
                                    </select>

                                    @error('priority')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="responsibles" class="col-md-4 col-form-label text-md-end">@lang('Приоритет')</label>

                                <div class="col-md-6">

                                    <select multiple class="form-control @error('responsibles') is-invalid @enderror" name="responsibles[]" id="responsibles">
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" @foreach($task->responsibles as $responsible) @if($user->id === $responsible->id) selected @endif @endforeach >
                                                {{ $user->last_name }}  {{ $user->first_name }}
                                            </option>
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
                                        @lang('Изменить')
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
