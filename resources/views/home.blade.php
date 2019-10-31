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
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-money fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{($payable != null) ? $payable->balance : 0}}</div>
                        <div>Amount Payable</div>
                    </div>
                </div>
            </div>
            <a target="_blank" href="{{ url('invoice/amountpayable') }}">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-money fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{($receivable != null) ?$receivable->balance : 0}}</div>
                        <div>Amount Receivable!</div>
                    </div>
                </div>
            </div>
            <a href="{{ url('invoice/amountreceivable') }}" target="_blank">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-shopping-cart fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{($totalpurchase != null) ?$totalpurchase->total : 0}}</div>
                        <div>Total Purchase</div>
                    </div>
                </div>
            </div>
            <a href="{{ url('voucher/voucherlisting') }}">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-support fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{($totalsale != null) ?$totalsale->total: 0}}</div>
                        <div>Total Sale</div>
                    </div>
                </div>
            </div>
            <a href="{{ url('sale/saleorder') }}">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
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
        <div id="dn-calender"></div>
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