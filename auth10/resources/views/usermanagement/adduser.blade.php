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
                <div class="col-sm-12" align="left">
                    <h1> ADD USER</h1>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <!-- <div class="card-header">
                <h3 class="card-title"></h3>
            </div> -->
            <div class="card-body">

                <form role="form" id="quickForm" action="{{route('users.create')}}" enctype="multipart/form-data" method="POST">
                    <div class="card-body">
                        <div class="row">
                            @csrf
                            <div class="form-group  col-md-6">
                                <label>Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                            </div>

                            <div class="form-group  col-md-6">
                                <label>Login ID</label>
                                <input type="text" class="form-control" name="email" id="email" placeholder="Enter Login ID">

                                @error('email')
                                <span class="invalid-feedback" role="alert" style="color:red;">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group  col-md-6">
                                <label>Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Profile Picture</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="profilepicture" name="profilepicture">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>

                            <div class="form-group  col-md-6">
                                <label>User Type:</label>
                                <select class="form-control" name="role" id="role">
                                    <option value=""> Select Role</option>
                                    <option value="agent"> Agent</option>
                                    <option value="admin"> Admin</option>

                                    <?php $type = Auth::user()->role;
                                    if ($type == 'superadmin') { ?>
                                        <option value="superadmin"> Super Admin</option>
                                    <?php } ?>
                                </select>
                            </div>



                        </div>

                        <!-- /.card-body -->
                        <button type="submit" class="btn btn bg-gradient-info btn-sm" style="margin-top: 20px; float:right"><span>SUBMIT</span></button>
                    </div>
                </form>
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
    $(document).ready(function() {

        $("#quickForm").validate({
            rules: {
                name: {
                    required: true
                },

                email: {
                    required: true,
                    // email: true,
                },
                role: {
                    required: true,
                },
                password: {
                    required: true,
                },
                messages: {
                    email: {
                        required: "Please enter a email address",
                        email: "Please enter a vaild email address"
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                }
            },
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>

@endsection