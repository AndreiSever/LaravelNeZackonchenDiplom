@extends('layouts.app')
@section('content')
<div class="container">
    <div class="accordion" id="accordionExample">
    
        <div class="card">
            <div class="card-header" id="headingOne">
            <h5 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                {{ __('Задание 1') }}
                </button>
            </h5>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
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
            </div>
            </div>
        </div>

    </div>
</div>
 

@endsection