<div class="container">
    <div class="form-group">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" placeholder="" value="{{isset($thing)? $thing->name:''}}" {{isset($thing) == 0?'required':''}}>
    </div>
    <div class="form-group">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" placeholder="" {{isset($thing) == 0?'required':''}}>{{isset($thing)? $thing->description:''}}</textarea>
    </div>
    <div class="form-group">
        <label class="form-label">Hardware</label>
        <input type="text" name="hardware" class="form-control" placeholder="Ex. Raspberry, NodeMCU" value="{{isset($thing)? $thing->hardware:''}}" {{isset($thing) == 0?'required':''}}>
    </div>
</div>
