@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @foreach($tasks as $task)

                    <div class="card mb-3">
                        <div class="card-header">
                            <div class="col">
                                <div class="d-flex justify-content-between">
                                    <p class="m-0">{{ $task->name }}</p>
                                    <p>{{ $task->category->name }}</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="align-self-center">{{ __($task->status) }}</div>
                                    <div class="align-self-center">
                                        @switch($task->priority)
                                            @case(0) Не имеет значения @break
                                            @case(1) Очень низкий @break
                                            @case(2) Низкий @break
                                            @case(3) Средний @break
                                            @case(4) Высокий @break
                                            @case(5) Очень высокий @break
                                        @endswitch
                                    </div>

                                    <div class="w-25 align-self-center">Выполнить до: {{ date('d.m.y H:i', strtotime($task->end)) }}</div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">

                            <p>{{ $task->description }}</p>
                            <div class="d-flex flex-wrap">
                                @foreach($task->responsibles as $responsible)
                                    <div class="btn btn-info">{{ $responsible->last_name }}</div>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row row-cols-3">
                                <a class="btn btn-warning" href="{{ route('task.edit', $task->id) }}">Редактировать</a>
                                <form method="post" action="{{ route('task.delete', $task->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="w-100 btn btn-danger" type="submit">Удалить</button>
                                </form>
                                <a class="btn btn-success" href="{{ route('task.show', $task->id) }}">Комментарии</a>
                            </div>
                        </div>
                    </div>

                @endforeach

            </div>
        </div>
    </div>

@endsection
