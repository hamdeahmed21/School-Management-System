@extends('admin.admin_master')
@section('title')
    Student Fee Amount List
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
                                <h3 class="box-title">Student Fee Amount List</h3>
                                <a href="{{ route('fee.amount.add') }}" style="float: right;" class="btn btn-rounded btn-success mb-5"> Add Fee Amount</a>

                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th width="5%">SL</th>
                                            <th>Fee Category</th>
                                            <th width="25%">Action</th>

                                        </tr>
                                        </thead>
                                        @php($i=1)
                                        <tbody>
                                        @foreach($FeeAmounts as $FeeAmount )
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td> {{ $FeeAmount->fee_cateogry->name }}</td>
                                                <td>
                                                    <a href="{{ route('fee.amount.edit',$FeeAmount->fee_category_id) }}" class="btn btn-info">Edit</a>
                                                    <a href="{{ route('fee.amount.details',$FeeAmount->fee_category_id) }}" class="btn btn-primary" >Details</a>

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
