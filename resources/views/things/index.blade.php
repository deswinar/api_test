@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">Things</div>

    <div class="card-body">
        <div class="table-responsive">
          <button data-toggle="data-toggle" title="Create Thing" class="btn btn-primary" onclick="createThings();">
            <i class="fa fa-plus-circle">Create Things</i>
          </button>
          <br><br>
          <table id="thingsTable" name="thingsTable" class="table table-bordered table-hover table-light">
              <thead class="thead-dark">
                  <tr>
                      <th>No</th>
                      <th>Name</th>
                      <th>Description</th>
                      <th>Hardware</th>
                      <th>Created At</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                @foreach($things as $key=>$thing)
                  <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$thing->name}}</td>
                      <td>{{$thing->description}}</td>
                      <td>{{$thing->hardware}}</td>
                      <td>{{$thing->created_at}}</td>
                      <td>
                          <button data-toggle="data-toggle1" title="Edit Thing" class="btn btn-warning btn-sm" onclick="editThings({{$thing->id}});">
                              <i class="fa fa-edit"></i>
                          </button>
                      </td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            {!! Form::open(['url' => 'foo/bar', 'class' => 'formAct', 'id' => 'formId', 'method' => 'POST']) !!}
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div id="formBatch">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btnSubmit" class="btn btn-primary">Create</button>
                    <button type="button" class="btn btn-danger" name="btnClose" data-dismiss="modal">Close</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<script>
function createThings(){
    $(".modal-title").text("Create Things");
    $("#btnSubmit").text("Create");
    $("#formModal").modal('show');
    $("#formId").attr('action', "{{url('things/store')}}");

    var token = $('meta[name="csrf_token"]').attr('content');
    $.get("{{url('things/create')}}", {_token:token}, function(data){
        $("#formBatch").html(data);
        // alert(data);
    });
}

function editThings(idx){
    id = idx;
    $(".modal-title").text("Update Things");
    $("#btnSubmit").text("Update");
    $("#formModal").modal('show');
    $("#formId").attr('action', "{{url('things/update')}}/"+id);

    var token = $('meta[name="csrf_token"]').attr('content');
    $.get("{{url('things/edit')}}", {_token:token, id:id}, function(data){
        $("#formBatch").html(data);
        alert(data);
    });
}
document.addEventListener("DOMContentLoaded", function(event) {
    $('#thingsTable').DataTable();
});
</script>

@endsection
