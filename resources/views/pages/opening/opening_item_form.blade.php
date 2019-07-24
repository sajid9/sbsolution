{{-- extend  --}}
@extends('layout.app')
@extends('includes.header')
@extends('includes.footer')
@extends('includes.sidebar')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'Opening Item')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">
    Add Opening Item
</div>
<div class="panel-body">
@include('includes.alerts')


{{-- form start  --}}
<form method="post" action="{{url('opening/saveitem')}}">
	@csrf
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <input type="hidden" name="item_id" id="itemId">
        <label for="barcode">Barcode <span class="text-danger">*</span></label>
        <div class="input-group">
          <input type="text"  name="barcode" value="{{old('barcode')}}" class="form-control" id="barcode" aria-describedby="barcode_msg" placeholder="voucher number">
          <span class="input-group-addon"><i data-toggle="modal" data-target="#myModal" class="glyphicon glyphicon-list"></i></span>
        </div>
        <small id="barcode_msg" class="form-text text-muted text-danger">{{$errors->first('item_id')}}</small>
      </div>
    </div>
    <div class="col-md-6">
     <div class="form-group">
       <label for="quantity">Quantity <span class="text-danger">*</span></label>
       <input type="number"  name="quantity" value="{{old('quantity')}}" class="form-control" id="quantity" aria-describedby="quantity" placeholder="voucher number">
       <small id="quantity_msg" class="form-text text-muted text-danger"></small>
     </div>
    </div>
  </div>
  
  <button type="submit"  class="btn btn-primary" id="addItem">Add Item</button> <a href="{{url('/')}}" class="btn btn-default">Back</a>
</form>
{{-- form end --}}
<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-full">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Items</h4>
        </div>
        <div class="modal-body">
          <table class="table table-striped table-bordered table-hover" id="items-datatable">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Item Name</th>
                    <th>Barcode</th>
                    <th>Purchase price</th>
                    <th>Sale Price</th>
                </tr>
            </thead>
            <tbody>
              @foreach($items as $item)
              <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->item_name}}</td>
                <td>{{$item->barcode}}</td>
                <td>{{$item->purchase_price}}</td>
                <td>{{$item->sale_price}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</div>
</div>
@endsection
@section('footer')
@parent
<script>

  $("#barcode").on('blur',function(){
      var barcode = $(this).val();
      var voucher_id = $('#vouchernumber').val();
      $.ajax({
        url:"{{url('voucher/searchbarcode')}}",
        type:"post",
        dataType:"json",
        data:{barcode:barcode,voucher_id:voucher_id,_token:"{{csrf_token()}}"},
        success:function(res){
          console.log(res.message);
          if(res.message){
            $('#barcode_msg').text(res.message);
            $('#addItem').prop('disabled',true);
          }else{
            if(res != null){
              $('#purchase_price').val(res.purchase_price);
              $('#sale_price').val(res.sale_price);
              $('#itemId').val(res.id);
              $('#addItem').prop('disabled',false);
              $('#barcode_msg').text('');
            }else{
              $('#purchase_price').val('');
              $('#sale_price').val('');
              $('#itemId').val('');
            }  
          }
        }
      });
    });
  
</script>

@endsection