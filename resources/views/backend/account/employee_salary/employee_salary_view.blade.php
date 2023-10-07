@extends('admin.admin_master')
@section('title')
    Employee Salary List
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
                                <h3 class="box-title">Employee Salary List </h3>
                                <a href="{{ route('account.salary.add') }}" style="float: right;" class="btn btn-rounded btn-success mb-5"> Add / Edit Employee Salary</a>

                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th width="5%">SL</th>
                                            <th>ID No</th>
                                            <th>Name </th>
                                            <th>Amount</th>
                                            <th>Date</th>


                                        </tr>
                                        </thead>
                                        @php($i=1)
                                        <tbody>
                                        @foreach($AccountEmployeeSalarys as $AccountEmployeeSalary )
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td> {{ $AccountEmployeeSalary->user->id_no }}</td>
                                                <td> {{ $AccountEmployeeSalary->user->name }}</td>
                                                <td> {{ $AccountEmployeeSalary->amount }}</td>
                                                <td> {{ date('M Y', strtotime($AccountEmployeeSalary->date))  }}</td>

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
