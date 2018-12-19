<div class="container">
    <div class="form-group">
        <label class="form-label">Namess</label>
        <input type="text" name="name" class="form-control" placeholder="" value="{{$things->name}}" required>
    </div>
    <div class="form-group">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" placeholder="" required>{{$things->description}}</textarea>
    </div>
    <div class="form-group">
        <label class="form-label">Hardware</label>
        <input type="text" name="hardware" class="form-control" placeholder="Ex. Raspberry, NodeMCU" value="{{$things->hardware}}" required>
    </div>
</div>
