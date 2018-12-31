<div class="container">
    <input type="text" name="things_id" value="{{$id}}">
    <div class="form-group">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" placeholder="" value="{{isset($channel)? $channel->name:''}}" {{isset($channel) == 0?'required':''}}>
    </div>
    <div class="form-group">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" placeholder="" {{isset($channel) == 0?'required':''}}>{{isset($channel)? $channel->description:''}}</textarea>
    </div>
    <div class="form-group">
        <label class="form-label">Type</label>
        <select class="form-control" name="type">
            @foreach($types as $key=>$type)
                <option value="{{$type->id}}" {{isset($channel)? '':''}}>{{$type->name}}</option>
            @endforeach
        </select>
    </div>
</div>
