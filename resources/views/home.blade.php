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
              <div class="count">{{($totalpurchase != null) ?$totalpurchase->total : 0}}</div>
              <h3>Purchase</h3>
              <p><a href="{{ url('voucher/voucherlisting') }}">Read More </a></p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-check-square-o"></i></div>
              <div class="count">{{($totalsale != null) ?$totalsale->total: 0}}</div>
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
    </div>
    <div class="col-md-6">
        <div class="panel panel-success">
          <div class="panel-heading">Calender</div>
          <div class="panel-body">
            <div id="dn-calender"></div>
          </div>
        </div>
    </div>
</div>
@endif
@endsection
@section('footer')
@parent
<script src="{{ asset('js/dncalendar.min.js')}}"></script>
<script>
    var my_calendar = $("#dn-calender").dnCalendar({
        dataTitles: { defaultDate: 'default', today : 'Today' },
        notes: [
          { "date": "2019-7-6", "note": ["Happy New Year 2016"] }
          ],
        showNotes: true,
    });
    my_calendar.build();

</script>
@endsection