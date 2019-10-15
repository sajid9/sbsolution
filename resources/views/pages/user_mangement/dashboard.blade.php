  {{-- extend  --}}
  @extends('layout.app')
  @extends('includes.header')
  @extends('includes.footer')
  @extends('includes.sidebar')

  {{-- page titles --}}
  @section('title', 'Dashboard')
  @section('pagetitle', 'User And Role Management')



  @section('content')

    @include('includes.alerts')
    <ul class="nav nav-pills"  id="myTab">
      <li class="active"><a data-toggle="pill" href="#users">Users</a></li>
      <li><a data-toggle="pill" href="#role">Roles</a></li>
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
      {{-- role tab  ends--}}
    </div>
    {{-- main tab end--}}

  @endsection




  @section('footer')
  @parent

  <!-- DataTables JavaScript -->
  <script src="{{asset('js/dataTables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('js/dataTables/dataTables.bootstrap.min.js')}}"></script>

  <script>
     {{--  $(document).ready(function() {
    $(".checkstatus").click(function(){
     if ($(this).is(':checked')){
      $('.hideshowpasswordfield').show();
     }else {
        $('.hideshowpasswordfield').hide();
     } 
    });
    });
--}}
    $(document).ready(function() {
      $('#edituser').on('click',function(){
        var val = $(this).closest('tr').find('td').eq(3).text();
        console.log(val);
      })


     });

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
  


  </script>
  @endsection
