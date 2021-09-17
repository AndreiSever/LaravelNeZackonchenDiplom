@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Задание 1') }}
                </div>
                <div class="card-body">
                    <p>Текст задания</p>
                    <hr>
                    <table class='table-sm'>
                        <tbody>
                        <tr>
                            <td> <i class="fa fa-file-word-o  fa-2x fa-fw"></i> </td>
                            <td>
                                <p ><a href='#'>Какой то документ </a>(9 Мб)</p> 
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <hr>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="message-text" class="col-form-label">Текст сообщения:</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div>                    
                        <div class="form-group row">
                            <div class="fallback">
                                    <input name="file" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="file" multiple />
                            </div>
                            @if ($errors->has('file'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('file') }}</strong>
                                </span>
                            @endif
                        </div>   
                        <button type="button" class="btn btn-primary">Отправить</button>                   
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection