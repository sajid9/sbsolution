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
      <label for="size">Size <span class="text-danger">*</span></label>
      <select  name="size" class="form-control" id="size" aria-describedby="size_msg" >
        <option value="">Select Size</option>
        @foreach($sizes as $size)
        <option {{($item->size == $size->size)? 'selected':''}}>{{$size->size}}</option>
        @endforeach
      </select>
      <small id="size_msg" class="form-text text-muted text-danger">{{$errors->first('size')}}</small>
    </div>
    <div class="form-group">
      <label for="piece_in_box">Pieces Per Box <span class="text-danger">*</span></label>
      <input type="text" name="piece_in_box" value="{{old('piece_in_box',$item->pieces)}}" class="form-control" id="piece_in_box" aria-describedby="piece_in_box_msg" placeholder="Pieces Per Box">
      <small id="piece_in_box_msg" class="form-text text-muted text-danger">{{$errors->first('piece_in_box')}}</small>
    </div>
    <div class="form-group">
      <label for="meter_per_box">Meter Per Box <span class="text-danger">*</span></label>
      <input type="text" name="meter_per_box" value="{{old('meter_per_box',$item->meter)}}" class="form-control" id="meter_per_box" aria-describedby="meter_per_box_msg" placeholder="Meter Per Box">
      <small id="meter_per_box_msg" class="form-text text-muted text-danger">{{$errors->first('meter_per_box')}}</small>
    </div>
    <div class="form-group">
      <label for="low_stock">Low Stock</label>
      <input type="number" name="low_stock" value="{{old('low_stock',$item->low_stock)}}" class="form-control" id="low_stock" aria-describedby="low_stock_msg" placeholder="Low Stock">
      <small id="low_stock_msg" class="form-text text-muted text-danger">{{$errors->first('low_stock')}}</small>
    </div>
    
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="unit"> Measuring Unit</label>
      <select name="unit" class="form-control" id="unit" aria-describedby="unit_msg">
        <option value="">Select Unit</option>
        @foreach($units as $unit)
          <option value="{{$unit->id}}" {{($item->unit_id == $unit->id) ? 'selected' : ''}}>{{ $unit->unit}}</option>
        @endforeach
      </select>
      <small id="unit_msg" class="form-text text-muted text-danger">{{$errors->first('unit')}}</small>
    </div>
    <div class="form-group">
      <label for="purchase_price">Purchase Price <span class="text-danger">*</span></label>
      <input type="number" name="purchase_price" value="{{old('purchase_price',$item->purchase_price)}}" class="form-control" id="purchase_price" placeholder="Purchase Price" aria-describedby="purchase_price">
      <small id="purchase_price" class="form-text text-muted text-danger">{{$errors->first('purchase_price')}}</small>
    </div>
    <div class="form-group">
      <label for="sale_price">Sale Price <span class="text-danger">*</span></label>
      <input type="number" name="sale_price" value="{{old('sale_price',$item->sale_price)}}" class="form-control" id="sale_price" placeholder="Sale Price" aria-describedby="sale_price">
      <small id="sale_price" class="form-text text-muted text-danger">{{$errors->first('sale_price')}}</small>
    </div>
    <div class="form-group">
      <label for="group">group <span class="text-danger">*</span></label>
      <select name="group" class="form-control" id="group" aria-describedby="group_msg">
        <option value="">Select group</option>
        @foreach($groups as $group)
          <option value="{{$group->id}}" {{($item->group_id == $group->id) ? 'selected' : ''}}>{{ $group->name}}</option>
        @endforeach
      </select>
      <small id="group_msg" class="form-text text-muted text-danger">{{$errors->first('group')}}</small>
    </div>
    <div class="form-group">
      <label for="color">Color</label>
      <input type="text" name="color_name" value="{{old('color_name',$item->color)}}" class="form-control" id="color" aria-describedby="color" placeholder="Color">
      <small id="color" class="form-text text-muted text-danger">{{$errors->first('color_name')}}</small>
    </div>
    <div class="form-group">
      <label for="discription">Description</label>
      <textarea class="form-control" name="description" id="description" rows="3" aria-describedby="description">{{old('description',$item->item_desc)}}</textarea>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label for="company">Company </label>
      <select name="company" class="form-control" id="company" aria-describedby="company">
        <option value="">Select Company</option>
        @foreach($companies as $company)
          <option value="{{$company->id}}" {{($item->company_id == $company->id)? 'selected':''}}>{{ $company->company_name}}</option>
        @endforeach
      </select>
      <small id="company" class="form-text text-muted text-danger">{{$errors->first('company')}}</small>
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
      <label for="tile_type">Tile Type</label>
      <select name="tile_type" class="form-control" id="tile_type" aria-describedby="tile_type">
        <option value="">Select Tile Type</option>
        <option {{($item->tile_type == 'Floor') ? 'selected' : ''}}>Floor</option>
        <option {{($item->tile_type == 'Wall') ? 'selected' : ''}}>Wall</option>
        <option {{($item->tile_type == 'Kitchen') ? 'selected' : ''}}>Kitchen</option>
      </select>
      <small id="tile_type" class="form-text text-muted text-danger">{{$errors->first('tile_type')}}</small>
    </div>
  </div>
</div>