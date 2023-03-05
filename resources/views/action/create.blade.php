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
            <h1 class="m-0" >Create New Studiom </h1>
           
          </div><!-- /.col -->
         
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        @if(session()->has('pass'))
        @if( Session::get('pass'))
        <div class="alert alert-success" role="alert">
          {{ "Store Done!" }}
        </div>
          @else
          @if(session()->has('error'))
          <div class="alert alert-danger" role="alert">
            {{ Session::get('error')}}
          </div>
            @else
            <div class="alert alert-danger" role="alert">
              {{ "Store Error!"}}
            </div>
          @endif
          
        @endif
          
                    
        
        
                    
                   
                      
                    @endif
                    @if(count($errors) >0)
                    @foreach ( $errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                      </div>
                    @endforeach
                        
                    @endif
        <form action="{{ route('admin.store') }}" method="POST">
@csrf
            <div class="mb-3 row">
                <label for="inputtext" class="col-sm-2 col-form-label">first Name</label>
                <div class="col-sm-10">
                  <input type="text" name="fname" class="form-control" id="inputtext">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="inputtext" class="col-sm-2 col-form-label">last Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="lname" id="inputtext">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="inputtext" class="col-sm-2 col-form-label">username</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="uname" id="inputtext">
                </div>
              </div>
              <div class="col-auto" style="text-align: center ">
                <button type="submit" class="btn btn-primary mb-3">Confirm identity</button>
              </div>

        </form>
      
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


@endsection