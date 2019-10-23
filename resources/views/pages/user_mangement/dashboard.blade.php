
  {{-- extend  --}}
  @extends('layout.app')
  @extends('includes.header')
  @extends('includes.footer')
  @extends('includes.sidebar')

  {{-- page titles --}}
  @section('title', 'Dashboard')
  @section('pagetitle', 'User And Role Management')
  @section('header')
  @parent
  <link rel="stylesheet" type="text/css" href="{{ asset('dist/themes/default/style.css') }}">
  @endsection


  @section('content')

    @include('includes.alerts')
    <ul class="nav nav-pills"  id="myTab">
      <li class="active"><a data-toggle="pill" href="#users">Users</a></li>
      <li><a data-toggle="pill" href="#role">Roles</a></li>
      <li><a data-toggle="pill" href="#authority">Authority</a></li>
    </ul>
    {{-- main tab --}}
    <div class="tab-content">
      {{-- user tab --}}
      <div id="users" class="tab-pane fade in active">
        @include('pages.user_mangement.user_mangement_tab')
      </div>
      {{-- role tab  --}}
      <div id="role" class="tab-pane fade">
       
        @include('pages.user_mangement.role_mangement_tab')
      </div>
      <div id="authority" class="tab-pane fade">
        @include('pages.user_mangement.authority')
      </div>
      {{-- role tab  ends--}}
    </div>
  {{-- third tab start from there --}}
    
  </div>
</div>
</div>
@endsection
@section('footer')
@parent

<!-- DataTables JavaScript -->
<script src="{{asset('js/dataTables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/dataTables/dataTables.bootstrap.min.js')}}"></script>
<script src="{{ asset('dist/jstree.min.js') }}"></script>
<script>
  {{-- js tree code start  --}}
    $('#html').jstree({
      'core' : {
        'data' : {
                "url" : "{{url('user_mangement/getauthority')}}",
                "dataType" : "json" // needed only if you do not supply JSON headers
              }
            },
      "types" : {
          "default" : {
            "icon" : "glyphicon glyphicon-user"
          },
          "demo" : {
            "icon" : "glyphicon glyphicon-user"
          }
        },
        
      'plugins':["checkbox","types"]
    });
    /*check if role exsist load it in tree*/
    $('#role-auth').on('change',function(){
      var role = $(this).val();
      $.ajax({
        url:"{{route('checkrole')}}",
        type:"post",
        dataType:"json",
        data:{role:role,_token:"{{csrf_token()}}"},
        success:function(res){
          if(res.length > 0){
            $('#auth_id').val(res[0].id);
            $('#html').jstree(true).uncheck_all();
            $('#html').jstree(true).close_all();
            $('#html').jstree('select_node', res[0].selected_ids);
          }else{
            $('#auth_id').val('');
            $('#html').jstree(true).uncheck_all();
            $('#html').jstree(true).close_all();
          }
        }
      });
    })
    /*add authority to the database get from the js tree*/
    $('#addauthority').on('click',function(){
      var role = $('#role-auth').val();
      var parent_id = $('#auth_id').val();
      var selectedData = [];
      var selectedID = [];
      var selectedIndexes;
        selectedIndexes = $("#html").jstree("get_selected", true);
        jQuery.each(selectedIndexes, function (index, value) {
          selectedData.push(selectedIndexes[index].text);
          selectedID.push(selectedIndexes[index].id);
        });
      $.ajax({
        url:"{{ url('user_mangement/addauthority') }}",
        type:"post",
        dataType:"json",
        data:{parent_id:parent_id,role:role,roles:selectedData,id:selectedID,_token:"{{csrf_token()}}"},
        success:function(res){
          if(res.message){
            $.toast({
              heading: 'SUCCESS',
              text: res.message,
              icon: 'success',
              position: 'top-right', 
              loader: true,        // Change it to false to loader
              loaderBg: '#9EC600'  // To change the background
            })
          }
        }
      });
    })
    /*end js tree code*/
  $(document).ready(function() {
      $('#dataTables-example1').DataTable({
              responsive: true
      });
      $('[data-toggle="tooltip"]').tooltip();
  });
  $(document).ready(function() {
      $('#dataTables-example2').DataTable({
              responsive: true
      });
      $('[data-toggle="tooltip"]').tooltip();
  });
// standard on load code goes here with $ prefix
// note: the $ is setup inside the anonymous function of the ready command

    $(document).ready(function() {
      $('#edituser').on('click',function(){
        var val = $(this).closest('tr').find('td').eq(3).text();
        console.log(val);
      })
     });


  </script>
  @endsection
