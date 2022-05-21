@extends('admin.admin_master')
@section('title')
view user
@endsection
@section('css')
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container-full">
            <!-- Content Header (Page header) -->


            <!-- Main content -->
            <section class="content">
                <div class="row">



                    <div class="col-12">

                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">User List</h3>
                                <a href="{{ route('users.add') }}" style="float: right;" class="btn btn-rounded btn-success mb-5"> Add User</a>

                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th width="5%">#</th>
                                            <th>Role</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Code</th>
                                            <th width="25%">Action</th>

                                        </tr>
                                        </thead>
                                        @php($i=1)
                                        <tbody>
                                        @foreach($users as $User )
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td> {{ $User->role }}</td>
                                                <td>{{ $User->name }}</td>
                                                <td>{{ $User->email }}</td>
                                                <td>{{ $User->code }}</td>
                                                <td>
                                                    <a href="{{ route('users.edit',$User->id) }}" class="btn btn-info">Edit</a>
                                                    <a href="{{ route('users.delete',$User->id) }}" class="btn btn-danger" id="delete">Delete</a>

                                                </td>

                                            </tr>
                                        @endforeach

                                        </tbody>
                                        <tfoot>

                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->


                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->

        </div>
    </div>


@endsection
@section('js')
                <script src="{{asset('backend/js/vendors.min.js')}}"></script>
                <script src="{{asset('assets/icons/feather-icons/feather.min.js')}}"></script>
                <script src="{{asset('assets/vendor_components/datatable/datatables.min.js')}}"></script>
                <script src="{{asset('backend/js/pages/data-table.j')}}s"></script>

                <!-- Sunny Admin App -->
                <script src="{{asset('backend/js/template.js')}}"></script>
@endsection
