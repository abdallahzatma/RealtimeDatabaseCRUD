
@extends('layout.main')
@section('main')
<body class="hold-transition sidebar-mini">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Starter Page</h1>


            @if(session()->has('pass'))
       
            <div class="alert alert-success" role="alert">
              {{ Session::get('pass') }}
            </div>
            
             
              
            @endif
          </div><!-- /.col -->
         
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Username</th>
                <th scope="col">EDIT</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>

       @if(!empty($blog))
       @for($i = 0; $i < count($blog); $i++)
  <tr>

    <th scope="row">{{ $i + 1 }}</th>
 {{-- {{   dd(array_keys($blog)[$i]);}} --}}
    <td>{{ $blog[array_keys($blog)[$i]]['fname'] }}</td>
    <td>{{ $blog[array_keys($blog)[$i]]['lname'] }}</td>
    <td>{{ $blog[array_keys($blog)[$i]]['uname'] }}</td>
    <td><a href="{{ route('admin.edit',array_keys($blog)[$i]) }}" class="btn btn-success"> Edit </a></td>
    <td><form action="{{ route('admin.destroy',  array_keys($blog)[$i] ) }}"method = "POST">
      @csrf
        @method('delete')
        <button class="btn btn-danger"> Delete</button>    
        </form></td>
  </tr>
@endfor
       
       @endif     

               
           
            </tbody>
          </table>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


@endsection