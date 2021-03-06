@extends('admin.admin_master')
@section('title')
    Student Fee Category List
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
                                <h3 class="box-title">Student Fee Category List</h3>
                                <a href="{{ route('fee.category.add') }}" style="float: right;" class="btn btn-rounded btn-success mb-5"> Add Fee Category</a>

                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th width="5%">SL</th>
                                            <th>Name</th>
                                            <th width="25%">Action</th>

                                        </tr>
                                        </thead>
                                        @php($i=1)
                                        <tbody>
                                        @foreach($feecategory as $FeeCategory )
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td> {{ $FeeCategory->name }}</td>
                                                <td>
                                                    <a href="{{ route('fee.category.edit',$FeeCategory->id) }}" class="btn btn-info">Edit</a>
                                                    <a href="{{ route('fee.category.delete',$FeeCategory->id) }}" class="btn btn-danger" id="delete">Delete</a>

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
