@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Задание 1') }}
                </div>
                <div class="card-body">
                    <br>
                    <table id="example" class="display dataTable table  table-bordered" style="width:100%">
                    </table>    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection