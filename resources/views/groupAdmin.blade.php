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
                    <form>
                        <div class="form-row align-items-center">
                            <div class="col-auto">
                                <input class="form-control form-control mb-2 mr-sm-2 mb-sm-0" type="text"  id="group" value="" placeholder = "Номер группы"/>                            
                            </div>
                            <div class="col-auto">
                                <input type="button" class="btn btn-primary add"  value='Добавить'/>
                            </div>    
                        </div>
                    </form>
                    <br>
                    <table id="example" class="display dataTable table table-striped table-bordered" style="width:100%"> 
                    
                    </table>    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection