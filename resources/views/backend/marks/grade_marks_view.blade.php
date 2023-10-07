@extends('admin.admin_master')
@section('title')
    Grade Marks List
@endsection
@section('admin')


    <div class="content-wrapper">
        <div class="container-full">
            <!-- Content Header (Page header) -->


            <!-- Main content -->
            <section class="content">
                <div class="row">



                    <div class="col-12">

                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Grade Marks List </h3>
                                <a href="{{ route('marks.grade.add') }}" style="float: right;" class="btn btn-rounded btn-success mb-5"> Add Grade Marks</a>

                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th width="5%">SL</th>
                                            <th>Grade Name</th>
                                            <th>Grade Point</th>
                                            <th>Start Marks</th>
                                            <th>End Marks </th>
                                            <th>Point Range</th>
                                            <th>Remarks</th>

                                            <th width="15%">Action</th>

                                        </tr>
                                        </thead>
                                        @php($i=1)
                                        <tbody>
                                        @foreach($MarksGrades as $MarksGrade )
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td> {{ $MarksGrade->grade_name }}</td>
                                                <td> {{ number_format((float)$MarksGrade->grade_point,2)  }}</td>
                                                <td> {{ $MarksGrade->start_marks }}</td>
                                                <td> {{ $MarksGrade->end_marks }}</td>
                                                <td> {{ $MarksGrade->start_point }} -  {{ $MarksGrade->end_point }}</td>
                                                <td> {{ $MarksGrade->remarks }}</td>

                                                <td>
                                                    <a href="{{ route('marks.grade.edit',$MarksGrade->id) }}" class="btn btn-info">Edit</a>


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
