@extends('backend.index')

@section('content')



<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Users List Table -->
    <div class="card">
        <!-- DataTable with Buttons -->
        <div class="card">
            <div class="card-datatable pt-0">
                <div class="card-header pb-0 ">
                    <h4 class="card-title
                        ">List of Options</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Content</th>
                                    <th>Vote</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($data->options as $option)
                                <tr>
                                    <td>{{$option->player->full_name}}</td>
                                    <td>{{$option->votes_count}}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>


            </div>
        </div>
    </div>
</div>


@endsection
