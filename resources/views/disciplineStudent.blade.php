@extends('layouts.app')
@section('content')
<div class="container">
    <div class="collapse-card">
        <div class="title">
            <i class="fa fa-times fa-2x fa-fw"></i>
            <span>Выполнено заданий: 30%</span>
            <strong>Какая та дисциплина</strong>          
        </div>
        <div class="body">  
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Задания</th>
                    <th scope="col">Оценка</th>
                    </tr>
                </thead>
                <tbody >
                    <tr>
                    <th scope="row">1</th>
                    <td>Какой то предмет</td>
                    <td>4</td>
                    </tr>

                </tbody>
            </table>      
        </div>
    </div>                            
</div>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Модальное окно</button>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Задание 1</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Текст задания</p>
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
        <form >
            <div class="form-group">
                <label for="message-text" class="col-form-label">Message:</label>
                <textarea class="form-control" id="message-text"></textarea>
                
        </div>        
        <form action="/upload-target" class="dropzone">
            <div class="fallback">
                    <input name="file" type="file" multiple />
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>

@endsection