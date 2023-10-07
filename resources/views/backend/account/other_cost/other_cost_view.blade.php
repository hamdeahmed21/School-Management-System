@extends('admin.admin_master')
@section('title')
    Other Cost List
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
                                <h3 class="box-title">Other Cost List </h3>
                                <a href="{{ route('other.cost.add') }}" style="float: right;" class="btn btn-rounded btn-success mb-5"> Add Other Cost</a>

                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th width="5%">SL</th>
                                            <th>Date</th>
                                            <th>Amount </th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Action</th>


                                        </tr>
                                        </thead>
                                        @php($i=1)
                                        <tbody>
                                        @foreach($AccountOtherCosts as $AccountOtherCost )
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td> {{ date('d-m-Y', strtotime($AccountOtherCost->date)) }}</td>
                                                <td> {{ $AccountOtherCost->amount }}</td>
                                                <td> {{ $AccountOtherCost->description }}</td>
                                                <td>
                                                    <img src="{{ (!empty($AccountOtherCost->image))? url('upload/cost_images/'.$AccountOtherCost->image):url('upload/no_image.jpg') }}" style="width: 70px; height: 50px;">
                                                </td>

                                                <td> <a href="{{ route('edit.other.cost',$AccountOtherCost->id ) }}" class="btn btn-info"> Edit</a> </td>

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