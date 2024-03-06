@extends('layouts.master')
@section('title')
User Management
@stop
@section('content')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-12">
                <div class="col-sm-12">
                    <h1>USER MANAGEMENT</h1>
                </div>
            </div>
            <div class="col-sm-12" align="right">
                <a href="{{route('adduser')}}">
                    <button class="btn btn bg-gradient-info btn-sm">
                        <i class="fa fa-plus" aria-hidden="true"><span style="color:#fff;"></i> Add User</span> </button>
                </a>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card card-primary">
            <!-- <div class="card-header">
                <h3 class="card-title"></h3> -->
            <!-- </div> -->
            <div class="card-body">

                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Name</th>
                            <th>User ID</th>
                            <th>Role Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $sno = 1 ?>
                        @foreach($user as $users)
                        <tr class="gradeX">
                            <td>{{$sno++}}</td>
                            <td>{{$users->name}}</td>
                            <td>{{$users->email}}</td>
                            <td> <?php echo strtoupper($users->role) ?></td>
                            <td>
                                <div class="btn-group" style="padding:10px;align-items: center;justify-content: center;margin-left: 25%;">
                                    <a href="{{route('users.edit',$users->id)}}"> <i class=" fa fa-edit" style="padding:5px"></i></a>
                                    <?php $id = Auth::user()->id; ?>
                                    <?php if ($id != $users->id) { ?>
                                        <a href="{{route('users.delete',$users->id)}}" onclick="return confirm('Do you really want to Delete?');"><i class="fa fa-trash" style="color: #b91010;padding:5px"></i></a>
                                    <?php } ?>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<script>
    $(function() {
        $("#datatable").DataTable();

    });
</script>
<!-- /.content-wrapper -->
@endsection