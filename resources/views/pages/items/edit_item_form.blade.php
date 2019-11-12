{{-- extend  --}}
@extends('layout.app2')
@extends('includes.header2')
@extends('includes.footer2')
@extends('includes.sidebar2')

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
  <input type="hidden" name="type" value="{{$item->type}}">
  {{-- item template starts --}}
  {{-- item template starts --}}
  @if($item->type == 'item')
    @include('pages.items.edit_item_template')
  @endif
  {{-- item template ends --}}
  {{-- service template starts --}}
  {{-- service template starts --}}
  @if($item->type == 'service')
    @include('pages.items.edit_service_template')
  @endif
  {{-- end service template --}}
  {{-- tile template starts --}}
  {{-- tile template starts --}}
  @if($item->type == 'tile')
    @include('pages.items.edit_tile_template')
  @endif
  {{-- tile template ends --}}
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
  
</script>

@endsection