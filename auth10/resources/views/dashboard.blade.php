@extends('layouts.master')
@section('title')
Dashboard
@stop
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <!-- <h1>Dashboard</h1> -->
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card card-cyan">
      <div class="card-header">
        <h1 class="card-title">Dashboard</h1>


      </div>
      <div class="card-body">
        <h1 style="font-size:20px ;"><b> Welcome {{Auth::user()->name}} </b></h1>
      </div>

      <!-- /.card-footer-->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>



@endsection