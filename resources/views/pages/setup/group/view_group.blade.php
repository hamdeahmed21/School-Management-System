
@extends('admin.admin_master')
@section('title')
    Student Group List
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
                                <h3 class="box-title">Student Group List</h3>
                                <a href="{{ route('student.group.add') }}" style="float: right;" class="btn btn-rounded btn-success mb-5"> Add Student Group</a>

                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th width="5%">#</th>
                                            <th>Name</th>
                                            <th width="25%">Action</th>

                                        </tr>
                                        </thead>
                                        @php($i=1)
                                        <tbody>
                                        @foreach($student_group as $StudentGroup )
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td> {{ $StudentGroup->name }}</td>
                                                <td>
                                                    <a href="{{ route('student.group.edit',$StudentGroup->id) }}" class="btn btn-info">Edit</a>
                                                    <a href="{{ route('student.group.delete',$StudentGroup->id) }}" class="btn btn-danger" id="delete">Delete</a>

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

@endsection