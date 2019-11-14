{{-- extend  --}}
@extends('layout.app2')
@extends('includes.header2')
@extends('includes.footer2')
@extends('includes.sidebar2')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'Dashboard')
@section('header')
@parent
<link rel="stylesheet" type="text/css" href="{{ asset('css/dncalendar-skin.min.css') }}">
@endsection
{{-- page content --}}
@section('content')
<?php 
    if(CH::getauthorities() != null){
        $authorities = CH::getauthorities()->authority; 
    }else{
        $authorities = array();
    }
?>
@if(in_array('Dashboard',$authorities))
<div class="row">
    <div class="col-md-12">
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
              <div class="count">{{($payable != null) ? $payable->balance : 0}}</div>
              <h3>Payable</h3>
              <p><a target="_blank" href="{{ url('invoice/amountpayable') }}">Read More</a></p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-comments-o"></i></div>
              <div class="count">{{($receivable != null) ?$receivable->balance : 0}}</div>
              <h3>Receivable</h3>
              <p><a href="{{ url('invoice/amountreceivable') }}" target="_blank">Read More</a></p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
              <div class="count">{{($totalpurchase->total != null) ? $totalpurchase->total : 0}}</div>
              <h3>Purchase</h3>
              <p><a href="{{ url('voucher/voucherlisting') }}">Read More </a></p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-check-square-o"></i></div>
              <div class="count">{{($totalsale->total != null) ? $totalsale->total: 0}}</div>
              <h3>Sale</h3>
              <p><a href="{{ url('sale/saleorder') }}">Read More</a></p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-success">
          <div class="panel-heading">Alerts Low Stock</div>
          <div class="panel-body">
              <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Barcode</th>
                        <th>Item Name</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lowstocks as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->barcode}}</td>
                            <td>{{$item->item_name}}</td>
                            <td>{{$item->qty}}</td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
          </div>
        </div>
        <div class="panel panel-success">
          <div class="panel-heading">Sale of the day</div>
          <div class="panel-body">
              <table class="table display" id="example" style="width: 100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Receipt No</th>
                        <th>Total Amount</th>
                    </tr>
                </thead>
                
              </table>
          </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-success">
          <div class="panel-heading">Expenditure of the day</div>
          <div class="panel-body">
            <table class="table display" id="exp_tbl" style="width: 100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Description</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                
              </table>
          </div>
        </div>
    </div>
</div>
@endif
@endsection
@section('footer')
@parent
<script src="{{ asset('js/dncalendar.min.js')}}"></script>
<script src="{{asset('js/dataTables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/dataTables/dataTables.bootstrap.min.js')}}"></script>
<script>
   
  $(document).ready(function() {
      $('#example').DataTable( {
          "processing": true,
          "serverSide": true,
          "ajax": {
              "url": "{{url('getsaleofday')}}",
              "type": "POST",
              "data":{_token:"{{csrf_token()}}"}
          },
          "columns": [
              { "data": "id" },
              { "data": "receipt_no" },
              { "data": "total_amount" },
          ]
      } );
      $('#exp_tbl').DataTable( {
          "processing": true,
          "serverSide": true,
          "ajax": {
              "url": "{{url('getexpofday')}}",
              "type": "POST",
              "data":{_token:"{{csrf_token()}}"}
          },
          "columns": [
              { "data": "id" },
              { "data": "exp_desc" },
              { "data": "debit" },
          ]
      } );
  } );

</script>
@endsection