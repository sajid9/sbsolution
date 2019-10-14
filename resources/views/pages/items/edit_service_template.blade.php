<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label for="barcode">Barcode <span class="text-danger">*</span></label>
      <input type="text" name="barcode" value="{{old('barcode',$item->barcode)}}" class="form-control" id="barcode" placeholder="Short Code" aria-describedby="barcode">
      <small id="barcode" class="form-text text-muted text-danger">{{$errors->first('barcode')}}</small>
    </div>
    <div class="form-group">
      <label for="itemname">Item Name <span class="text-danger">*</span></label>
      <input type="text" name="item_name" value="{{old('item_name',$item->item_name)}}" class="form-control" id="itemname" aria-describedby="itemname" placeholder="item Name">
      <small id="itemname" class="form-text text-muted text-danger">{{$errors->first('item_name')}}</small>
    </div>
    <div class="form-group">
      <label for="sale_price">Service Price <span class="text-danger">*</span></label>
      <input type="hidden" name="purchase_price" value="{{$item->purchase_price}}">
      <input readonly type="number" name="sale_price" value="{{old('sale_price',$item->sale_price)}}" class="form-control" id="sale_price" placeholder="Sale Price" aria-describedby="sale_price">
      <small id="sale_price" class="form-text text-muted text-danger">{{$errors->first('sale_price')}}</small>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="duration">Duration <span class="text-danger">*</span></label>
      <input type="text" name="duration" value="{{old('duration',$item->duration)}}" class="form-control" id="duration" placeholder="Sale Price" aria-describedby="duration_msg">
      <small id="duration_msg" class="form-text text-muted text-danger">{{$errors->first('duration')}}</small>
    </div>
    <div class="form-group">
      <label for="category">Category </label>
      <select name="category" class="form-control" id="category" aria-describedby="category">
        <option value="">Select Category</option>
        @foreach($categories as $category)
          <option value="{{$category->id}}" {{($item->category_id == $category->id)? 'selected':''}}>{{ $category->category_name}}</option>
        @endforeach
      </select>
      <small id="category" class="form-text text-muted text-danger">{{$errors->first('category')}}</small>
    </div>
    <div class="form-group">
      <label for="class">Class </label>
      <select name="class" class="form-control" id="class" aria-describedby="class">
        <option value="">Select Class</option>
        @foreach($classes as $class)
          <option value="{{$class->id}}" {{($item->class_id == $class->id)? 'selected':''}}>{{ $class->class_name}}</option>
        @endforeach
      </select>
      <small id="class" class="form-text text-muted text-danger">{{$errors->first('class')}}</small>
    </div>
    
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="sub_class">Sub Class </label>
      <select name="sub_class" class="form-control" id="sub_class" aria-describedby="sub_class">
        <option value="">Select Subclass</option>
        @foreach($sub_classes as $subclass)
          <option value="{{$subclass->id}}" {{($item->sub_class_id == $subclass->id)? 'selected':''}}>{{ $subclass->class_name}}</option>
        @endforeach
      </select>
      <small id="sub_class" class="form-text text-muted text-danger">{{$errors->first('sub_class')}}</small>
    </div>    
    <div class="form-group">
      <label for="discription">Description</label>
      <textarea class="form-control" name="description" id="description" rows="3" aria-describedby="description">{{old('description',$item->item_desc)}}</textarea>
    </div>
  </div>
</div>