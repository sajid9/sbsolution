{{-- extend  --}}
@extends('layout.app')
@extends('includes.header')
@extends('includes.footer')
@extends('includes.sidebar')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'Edit item')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">
    Edit Item
</div>
<div class="panel-body">

{{-- form start  --}}
<form method="post" action="{{url('item/updateitem')}}">
  @csrf
  <input type="hidden" name="id" value="{{$item->id}}">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="itemname">Item Name <span class="text-danger">*</span></label>
        <input type="text" name="item_name" value="{{old('item_name',$item->item_name)}}" class="form-control" id="itemname" aria-describedby="itemname" placeholder="item Name">
        <small id="itemname" class="form-text text-muted text-danger">{{$errors->first('item_name')}}</small>
      </div>
      <div class="form-group">
        <label for="barcode">Barcode <span class="text-danger">*</span></label>
        <input type="text" name="barcode" value="{{old('barcode',$item->barcode)}}" class="form-control" id="barcode" placeholder="Short Code" aria-describedby="barcode">
        <small id="barcode" class="form-text text-muted text-danger">{{$errors->first('barcode')}}</small>
      </div>
      @if($item->type == 'tile')
      <div class="form-group">
          <input type="hidden" name="type" value="tile">
          <label for="color">Color <span class="text-danger">*</span></label>
          <input type="text" name="color_name" value="{{$item->color}}" class="form-control" id="color" aria-describedby="color" placeholder="Color">
          <small id="color" class="form-text text-muted text-danger">{{$errors->first('color_name')}}</small>
        </div>
        <div class="form-group">
          <label for="quality">quality <span class="text-danger">*</span></label>
          <select name="quality" class="form-control" id="quality" aria-describedby="quality_msg">
            <option>Select Qualitiy</option>
            <option {{($item->quality == 'Ceramic') ? 'selected':''}}>Ceramic</option>
            <option {{($item->quality == 'TB') ? 'selected':''}}>TB</option>
            <option {{($item->quality == 'Tiles') ? 'selected':''}}>Tiles</option>
          </select>
          <small id="quality_msg" class="form-text text-muted text-danger">{{$errors->first('quality')}}</small>
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
          <label for="meter_per_box">Meter Per Box <span class="text-danger">*</span></label>
          <input type="text" readonly="" name="meter_per_box" value="{{$item->meter}}" class="form-control" id="meter_per_box" aria-describedby="meter_per_box_msg" placeholder="Meter Per Box">
          <small id="meter_per_box_msg" class="form-text text-muted text-danger">{{$errors->first('meter_per_box')}}</small>
        </div>
        <div class="form-group">
          <label for="piece_in_box">Pieces Per Box <span class="text-danger">*</span></label>
          <input type="text" readonly="" name="piece_in_box" value="{{$item->pieces}}" class="form-control" id="piece_in_box" aria-describedby="piece_in_box_msg" placeholder="Pieces Per Box">
          <small id="piece_in_box_msg" class="form-text text-muted text-danger">{{$errors->first('piece_in_box')}}</small>
        </div>

      @endif
      <div class="form-group">
        <label for="purchase_price">Purchase Price <span class="text-danger">*</span></label>
        <input type="number" name="purchase_price" value="{{old('purchase_price',$item->purchase_price)}}" class="form-control" id="purchase_price" placeholder="Short Code" aria-describedby="purchase_price">
        <small id="purchase_price" class="form-text text-muted text-danger">{{$errors->first('purchase_price')}}</small>
      </div>
      <div class="form-group">
        <label for="sale_price">Sale Price <span class="text-danger">*</span></label>
        <input type="number" name="sale_price" value="{{old('sale_price',$item->sale_price)}}" class="form-control" id="sale_price" placeholder="Short Code" aria-describedby="sale_price">
        <small id="sale_price" class="form-text text-muted text-danger">{{$errors->first('sale_price')}}</small>
      </div>
      <div class="form-group">
        <label for="discription">Description</label>
        <textarea class="form-control" name="description" id="description" rows="3" aria-describedby="description">{{old('description',$item->description)}}</textarea>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <div class="form-group">
        <label for="group">group </label>
        <select name="group" class="form-control" id="group" aria-describedby="group_msg">
          <option value="">Select group</option>
          @foreach($groups as $group)
            <option value="{{$group->id}}" {{($item->group_id == $group->id) ? 'selected' : ''}}>{{ $group->name}}</option>
          @endforeach
        </select>
        <small id="group_msg" class="form-text text-muted text-danger">{{$errors->first('group')}}</small>
      </div>
        <label for="store">Store </label>
        <select name="store" class="form-control" id="store" aria-describedby="store">
          <option value="">Select store</option>
          @foreach($stores as $store)
            <option value="{{$store->id}}" {{($item->store_id == $store->id) ? 'selected' : ''}}>{{ $store->name}}</option>
          @endforeach
        </select>
        <small id="store" class="form-text text-muted text-danger">{{$errors->first('store')}}</small>
      </div>
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
    </div>
  </div>
  
  <div class="checkbox">
    <label>
      <input type="checkbox" data-toggle="toggle" name="is_active" value="yes" {{ (old('is_active') == 'yes' || $item->is_active == 'yes') ? 'checked' : '' }} data-on="Active" data-off="Inactive">
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button> <a href="{{url('item/itemlisting')}}" class="btn btn-default">Back</a>
</form>
{{-- form end --}}

</div>
</div>
@endsection
@section('footer')
@parent
<script>
$('#class').on('change',function(){
  var class_id = $(this).val();
  var token = $('input[name="_token"]').val();
  $.ajax({
    url:"{{url('subclass/getsubclass')}}",
    method:"post",
    dataType:'json',
    data:{id:class_id,_token:token},
    success:function(res){
      var template = '<option value="">Select Subclass</option>';
      for(var i = 0; i < res.length; i++){
        template += '<option value="'+res[i].id+'">'+res[i].class_name+'</option>';
      }
      $('#sub_class').html(template);
    }
  })
})
  
</script>

@endsection