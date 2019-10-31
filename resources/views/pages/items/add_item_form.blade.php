{{-- extend  --}}
@extends('layout.app2')
@extends('includes.header2')
@extends('includes.footer2')
@extends('includes.sidebar2')

{{-- page titles --}}
@section('title', 'Dashboard')
@section('pagetitle', 'Add Item')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">
    Add New Item
</div>
<div class="panel-body">

{{-- form start  --}}
<form method="post" action="{{url('item/additem')}}">
	@csrf
  <p class="radio">
    Item:
    <input class="type flat" type="radio" value="item" name="type" checked/> Service:
    <input class="type flat" type="radio" value="service" name="type"/>
  </p>
  
  <hr>
  <div id="template_append">
    
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" data-toggle="toggle" name="is_active" value="yes" {{ (old('is_active') == 'yes') ? 'checked' : '' }} data-on="Active" data-off="Inactive">
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button> <a href="{{url('item/itemlisting')}}" class="btn btn-default">Back</a>
</form>
{{-- form end --}}
{{-- loading tile template --}}
  @include('pages.items.tile_template')
  {{-- loading item template --}}
  @include('pages.items.item_template')
  {{-- loading service template --}}
  @include('pages.items.service_template')
</div>
</div>
@endsection
@section('footer')
@parent
<script>
$(document).ready(function(){
  $('#template_append').html($('#item_template').html());
  $('#cal_open').on('blur',function(){
    $('#opening').val($(this).val());
  })
  
  /*$('#meter_per_box').on('blur',function(){
    if($('#type').parent().hasClass('off')){
      $('#opening').val($('#cal_open').val());
    }else{
      $('#opening').val(parseInt($('#cal_open').val()) * parseFloat($(this).val()));
    }
  })*/
  $(document).on('keyup','#barcode',function(){
    var barcoad = $(this).val();
    $('#itemname').val(barcoad);
  })
  $(document).on('keyup','#sale_price',function(){
    if($('.type:checked').val() == 'service'){
      var price = $(this).val();
      $('#purchase_price').val(price);
    }
  })
})

$(document).on('change','#class',function(){
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
$('.type').on('ifChecked',function(){
  if($(this).val() == 'item'){
    $('#template_append').html($('#item_template').html());
    
  }else if($(this).val() == 'tile'){
    $('#template_append').html($('#tile_template').html());
  }else{
    $('#template_append').html($('#service_template').html());
  }
})
</script>

@endsection