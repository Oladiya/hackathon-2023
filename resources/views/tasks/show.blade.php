@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card mb-3">
                    <div class="card-header">
                        <div class="col">
                            <div class="d-flex justify-content-between">
                                <p>{{ $task->name }}</p>
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

                        <pre>{{ $task->description }}</pre>
                        <div class="d-flex flex-wrap">
                            @foreach($task->responsibles as $responsible)
                                <p class="btn btn-info">{{ $responsible->last_name }}</p>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row row-cols-3">
                            <a class="btn btn-warning" href="{{ route('task.edit', $task->id) }}">Редактировать</a>
                            <form class="" method="post" action="{{ route('task.delete', $task->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="w-100 btn btn-danger" type="submit">Удалить</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="comments">
                    <form method="post" action="{{ route('task.comment.store', $task->id) }}">
                        @csrf
                        <label for="text">@lang('Оставить комментарий')</label>
                        <textarea class="form-control mb-2" name="text" id="text" placeholder="@lang('Комментарий...')" ></textarea>
                        <button class="w-25 btn btn-success mb-2" type="submit">@lang('Отправить')</button>
                    </form>
                    <div class="col">
                        @foreach($task->comments as $comment)
                            <div class="card mb-2">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            @php
                                                $user = $comment->user;
                                                echo $user->last_name . " " . $user->first_name . " " . $user->middle_name;
                                            @endphp
                                        </div>
                                        <div>
                                            {{ date('H:i d.m.y', strtotime($comment->created_at)) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <pre>{{ $comment->text }}</pre>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
