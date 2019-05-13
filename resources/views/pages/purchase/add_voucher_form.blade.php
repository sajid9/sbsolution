{{-- extend  --}}
@extends('layout.app')
@extends('includes.header')
@extends('includes.footer')
@extends('includes.sidebar')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'Dashboard')
@section('header')
@parent
<style>
  fieldset { 
    display: block;
    margin-left: 2px;
    margin-right: 2px;
    padding-top: 0.35em;
    padding-bottom: 0.625em;
    padding-left: 0.75em;
    padding-right: 0.75em;
    border: 2px solid #ccc;
  }
  legend{
    width:inherit; /* Or auto */
    padding:0 10px; /* To give a bit of padding on the left and right */
    border-bottom:none;
  }
</style>
@endsection
@section('content')
<div class="panel panel-default">
<div class="panel-heading">
    Add New Voucher
</div>
<div class="panel-body">

{{-- form start  --}}
<form method="post" action="{{url('item/additem')}}">
	@csrf
  <div class="row">
    <div class="col-md-6">
      <fieldset>
        <legend>Vendor:</legend>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="vouchernumber">Voucher Number <span class="text-danger">*</span></label>
              <input type="text" name="voucher_number" value="{{old('voucher_number',rand())}}" class="form-control" id="vouchernumber" aria-describedby="vouchernumber" placeholder="voucher number">
              <small id="vouchernumber" class="form-text text-muted text-danger">{{$errors->first('voucher_number')}}</small>
            </div>
            <div class="form-group">
              <label for="vouchernumber">Voucher Number <span class="text-danger">*</span></label>
              <input type="text" name="voucher_number" value="{{old('voucher_number')}}" class="form-control" id="vouchernumber" aria-describedby="vouchernumber" placeholder="voucher number">
              <small id="vouchernumber" class="form-text text-muted text-danger">{{$errors->first('voucher_number')}}</small>
            </div>
          </div>
          <div class="col-md-6">
           <div class="form-group">
              <label for="total_amount">Total Amount <span class="text-danger">*</span></label>
              <input type="number" name="total_amount" value="{{old('total_amount')}}" class="form-control" id="total_amount" placeholder="Short Code" aria-describedby="total_amount">
              <small id="total_amount" class="form-text text-muted text-danger">{{$errors->first('total_amount')}}</small>
            </div>
            <div class="form-group">
              <label for="supplier">Supplier </label>
              <select name="supplier" class="form-control" id="supplier" aria-describedby="supplier">
                <option value="">Select supplier</option>
                @foreach($suppliers as $supplier)
                <option value="{{$supplier->id}}">{{$supplier->supplier_name}}</option>
                @endforeach
              </select>
              <small id="supplier" class="form-text text-muted text-danger">{{$errors->first('supplier')}}</small>
            </div>
            
          </div>
          
        </div>
      </fieldset>
    </div>
    <div class="col-md-6">
      <fieldset>
        <legend>Add Item:</legend>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="barcode">Barcode <span class="text-danger">*</span></label>
              <div class="input-group">
                <input type="text" name="barcode" value="{{old('barcode')}}" class="form-control" id="barcode" aria-describedby="barcode" placeholder="voucher number">
                <span class="input-group-addon"><i id="list" class="glyphicon glyphicon-list"></i></span>
              </div>
              <small id="barcode" class="form-text text-muted text-danger">{{$errors->first('barcode')}}</small>
            </div>
            <div class="form-group">
              <label for="quantity">Quantity <span class="text-danger">*</span></label>
              <input type="text" name="quantity" value="{{old('quantity')}}" class="form-control" id="quantity" aria-describedby="quantity" placeholder="voucher number">
              <small id="quantity" class="form-text text-muted text-danger">{{$errors->first('quantity')}}</small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="purchase_price">Purchase Price <span class="text-danger">*</span></label>
              <input type="text" name="purchase_price" value="{{old('purchase_price')}}" class="form-control" id="purchase_price" aria-describedby="purchase_price" placeholder="voucher number">
              <small id="purchase_price" class="form-text text-muted text-danger">{{$errors->first('purchase_price')}}</small>
            </div>
            <div class="form-group">
              <label for="sale_price">Sale Price <span class="text-danger">*</span></label>
              <input type="text" name="sale_price" value="{{old('sale_price')}}" class="form-control" id="sale_price" aria-describedby="sale_price" placeholder="voucher number">
              <small id="sale_price" class="form-text text-muted text-danger">{{$errors->first('sale_price')}}</small>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <button class="btn btn-primary">Add Item</button>
          </div>
        </div>
      </fieldset>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <fieldset>
        <legend>Items:</legend>
        <table class="table">
          <tr>
            <th>Id</th>
            <th>Item Name</th>
            <th>Purchase Price</th>
            <th>Sale Price</th>
            <th>Quantity</th>
          </tr>
        </table>
      </fieldset>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12" style="padding-top: 20px">
      <button type="submit" class="btn btn-primary">Submit</button> <a href="{{url('item/itemlisting')}}" class="btn btn-default">Back</a>
    </div>
  </div>
</form>
{{-- form end --}}

</div>
</div>
@endsection
@section('footer')
@parent
<script>
  
</script>

@endsection