{{-- extend  --}}
@extends('layout.app')
@extends('includes.header')
@extends('includes.footer')
@extends('includes.sidebar')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'Dashboard')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">
    Add New Item
</div>
<div class="panel-body">

{{-- form start  --}}
<form method="post" action="{{url('item/additem')}}">
	@csrf
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="itemname">Item Name <span class="text-danger">*</span></label>
        <input type="text" name="item_name" value="{{old('item_name')}}" class="form-control" id="itemname" aria-describedby="itemname" placeholder="item Name">
        <small id="itemname" class="form-text text-muted text-danger">{{$errors->first('item_name')}}</small>
      </div>
      <div class="form-group">
        <label for="barcode">Barcode <span class="text-danger">*</span></label>
        <input type="text" name="barcode" value="{{old('barcode')}}" class="form-control" id="barcode" placeholder="Short Code" aria-describedby="barcode">
        <small id="barcode" class="form-text text-muted text-danger">{{$errors->first('barcode')}}</small>
      </div>
      <div class="form-group">
        <label for="purchase_price">Purchase Price <span class="text-danger">*</span></label>
        <input type="number" name="purchase_price" value="{{old('purchase_price')}}" class="form-control" id="purchase_price" placeholder="Short Code" aria-describedby="purchase_price">
        <small id="purchase_price" class="form-text text-muted text-danger">{{$errors->first('purchase_price')}}</small>
      </div>
      <div class="form-group">
        <label for="sale_price">Sale Price <span class="text-danger">*</span></label>
        <input type="number" name="sale_price" value="{{old('sale_price')}}" class="form-control" id="sale_price" placeholder="Short Code" aria-describedby="sale_price">
        <small id="sale_price" class="form-text text-muted text-danger">{{$errors->first('sale_price')}}</small>
      </div>
      <div class="form-group">
        <label for="discription">Description</label>
        <textarea class="form-control" name="description" id="description" rows="3" aria-describedby="description">{{old('description')}}</textarea>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="company">Company </label>
        <select name="company" class="form-control" id="company" aria-describedby="company">
          <option value="">Select Company</option>
          @foreach($companies as $company)
            <option value="{{$company->id}}">{{ $company->company_name}}</option>
          @endforeach
        </select>
        <small id="company" class="form-text text-muted text-danger">{{$errors->first('company')}}</small>
      </div>
      <div class="form-group">
        <label for="category">Category </label>
        <select name="category" class="form-control" id="category" aria-describedby="category">
          <option value="">Select Category</option>
          @foreach($categories as $category)
            <option value="{{$category->id}}">{{ $category->category_name}}</option>
          @endforeach
        </select>
        <small id="category" class="form-text text-muted text-danger">{{$errors->first('category')}}</small>
      </div>
      <div class="form-group">
        <label for="class">Class </label>
        <select name="class" class="form-control" id="class" aria-describedby="class">
          <option value="">Select Class</option>
          @foreach($classes as $class)
            <option value="{{$class->id}}">{{ $class->class_name}}</option>
          @endforeach
        </select>
        <small id="class" class="form-text text-muted text-danger">{{$errors->first('class')}}</small>
      </div>
      <div class="form-group">
        <label for="sub_class">Sub Class </label>
        <select name="sub_class" class="form-control" id="sub_class" aria-describedby="sub_class">
          <option value="">Select Subclass</option>
        </select>
        <small id="sub_class" class="form-text text-muted text-danger">{{$errors->first('sub_class')}}</small>
      </div>
    </div>
  </div>
  <div class="form-check">
    <input type="checkbox" name="is_active" value="yes" {{ (old('is_active') == 'yes') ? 'checked' : '' }} class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Active</label>
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