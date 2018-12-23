@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">Channel</div>

    <div class="card-body">
        <div class="table-responsive">
          <button data-toggle="data-toggle" title="Create Channel" class="btn btn-primary" onclick="createChannel();">
            <i class="fa fa-plus-circle">Create Channel</i>
          </button>
          <br><br>
          <table id="channelsTable" name="channelsTable" class="table table-bordered table-hover table-light">
              <thead class="thead-dark">
                  <tr>
                      <th>No</th>
                      <th>Name</th>
                      <th>Description</th>
                      <th>Type</th>
                      <th>Current Value</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                @foreach($channels as $key=>$channel)
                  <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$channel->name}}</td>
                      <td>{{$channel->description}}</td>
                      <td>{{$channel->type_id}}</td>
                      <td>{{$channel->value}}</td>
                      <td>
                          <a href="{{url('things/channels')}}" class="btn btn-primary btn-sm"><i class="fa fa-bars"></i></a>
                          <button data-toggle="data-toggle1" title="Edit Thing" class="btn btn-warning btn-sm" onclick="editThing({{$thing->id}});">
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
            {!! Form::open(['class' => 'formAct', 'id' => 'formId', 'method' => 'POST']) !!}
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
function createChannel(){
    $(".modal-title").text("Create Channel");
    $("#btnSubmit").text("Create");
    $("#formModal").modal('show');
    $("#formId").attr({"action":"{{url('things/store')}}", "method":"POST"});

    var token = $('meta[name="csrf_token"]').attr('content');
    $.get("{{url('things/create')}}", function(data){
        $("#formBatch").html(data);
        // alert(data);
    });
}

function editChannel(id){
    $(".modal-title").text("Edit Thing");
    $("#btnSubmit").text("Update");
    $("#formModal").modal('show');
    $("#formId").attr({"action":"{{url('things/update')}}", "method":"POST"});

    var token = $('meta[name="csrf_token"]').attr('content');
    $.get("{{url('things/edit')}}", {id:id}, function(data){
        $("#formBatch").html(data);
        // alert(data);
    });
}

document.addEventListener("DOMContentLoaded", function(event) {
    $('#channelsTable').DataTable();
});
</script>


@endsection
