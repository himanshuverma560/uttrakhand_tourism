@extends('admin.layouts.admin_layout')
@section('content')
    <br>
    <br>
    <div class="card">
        <div class="card-header">Contact Form Data</div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Tour ID</th>
                        <th>Tour Date</th>
                        <th>Destination</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tours as $tour)
                        <tr>
                            <td>{{ $tour->name }}</td>
                            <td>{{ $tour->email }}</td>
                            <td>{{ $tour->mobile }}</td>
                            <td>{{ $tour->tour->tour_id }}</td>
                            <td>{{ \Carbon\Carbon::parse($tour->start_date)->format('d-m-Y') }}
                                to
                                {{ \Carbon\Carbon::parse($tour->end_date)->format('d-m-Y') }}</td>
                            <td>
                                <?php
                                
                                $date_wise_destination = json_decode($tour->tour->date_wise_destination, true);
                                //dd($date_wise_destination);
                                foreach ($date_wise_destination as $destination) {
                                    echo $destination['dham'] . '-' . $destination['date'] . '<br>';
                                }
                                ?>
                            </td>

                            <td>
                                @if ($tour->status == 0)
                                    <form action="{{ route('admin.pilgrim.verify', $tour->id) }}" method="POST">
                                        @csrf

                                        <button type="submit" class="btn btn-success btn-sm">Verify</button>
                                    </form>
                                @else
                                    <span class="badge bg-success">Verified</span>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>


        </div>

    </div>
@endsection
