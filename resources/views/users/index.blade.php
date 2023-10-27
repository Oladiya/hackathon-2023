@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @foreach($users as $user)

                    <div class="card mb-3">
                        <div class="card-header">
                            <div class="col">
                                @error('self-delete')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="d-flex justify-content-between">
                                    <div class="align-self-center">
                                        @php
                                            echo $user->last_name . ' ' . $user->first_name . ' ' . $user->middle_name;
                                        @endphp
                                    </div>
                                    @if($user->is_approved === true)
                                        <div class="btn btn-success">@lang('Одобрен')</div>
                                    @elseif($user->is_approved === false)
                                        <div class="btn btn-danger">@lang('Не одобрен')</div>
                                    @else
                                        <div class="btn btn-info">@lang('На рассмотрении')</div>
                                    @endif
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="align-self-center"></div>
                                    <div class="align-self-center">

                                    </div>

                                    <div class="w-25 align-self-center"></div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <div>@lang('email: ') {{ $user->email }}</div>
                            <div>@lang('Администратор: ') @if($user->is_admin) Да @else Нет @endif</div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-evenly">
                                @if($user->is_approved)
                                    @if($user->is_admin)
                                        @if($user->id === auth()->id())
                                            <button class="btn btn-secondary">@lang('Убрать права администратора')</button>
                                        @else
                                            <form method="post" action="{{ route('user.remove-admin-rights', $user->id) }}">
                                                @csrf
                                                <button class="btn btn-danger" type="submit">@lang('Убрать права администратора')</button>
                                            </form>
                                        @endif
                                    @else
                                        <form method="post" action="{{ route('user.set-admin-rights', $user->id) }}">
                                            @csrf
                                            <button class="btn btn-danger" type="submit">@lang('Выдать права администратора')</button>
                                        </form>
                                    @endif
                                    <form method="post" action="{{ route('user.delete', $user->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">@lang('Удалить пользователя')</button>
                                    </form>
                                @else
                                    <form method="post" action="{{ route('user.approve', $user->id) }}">
                                        @csrf
                                        <button class="btn btn-success" type="submit">@lang('Одобрить')</button>
                                    </form>
                                    <form method="post" action="{{ route('user.reject', $user->id) }}">
                                        @csrf
                                        <button class="btn btn-danger" type="submit">@lang('Отклонить')</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>

                @endforeach

            </div>
        </div>
    </div>

@endsection
