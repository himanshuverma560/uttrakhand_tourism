<!DOCTYPE html>
<html lang="en">
@include('partials.user_head')

<body>
    @include('partials.user_nav')

    <!-- Main Content -->
    <div class="dashboard-content py-5">
        <div class="container-fluid px-4">
            <div class="row">
                <!-- Left Sidebar -->
                @include('partials.user_dashboard_nav')

                <!-- Main Dashboard Area -->
                <div class="col-md-9">
                    @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                    <div class="row g-4">
                        <!-- View Tours -->
                        <div class="tour-listing-section">
                            <div class="card">
                                <div
                                    class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Plan Your Tour</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <a href="{{ route('tour') }}" class="btn btn-info text-white">Add New Tour</a>
                                        <div class="d-flex gap-2 align-items-center">
                                            <input type="text" class="form-control"
                                                placeholder="Search By Tour Name">
                                            <button class="btn btn-info text-white">Search</button>
                                        </div>
                                    </div>

                                    <div class="alert alert-danger">
                                        Note : Tours without any pilgrim registration will be deleted in 3 days.
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="bg-primary text-white">
                                                <tr>
                                                    <th>Sr No</th>
                                                    <th>Created date</th>
                                                    <th>Group ID</th>
                                                    <th>Tour Name</th>
                                                    <th>Tour Date</th>
                                                    <th>Your Destination</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($tours as $index => $tour)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $tour->created_at->format('d-m-Y') }}</td>
                                                        <td>{{ $tour->tour_id }}</td>
                                                        <td>{{$tour->tour_name}}</td>
                                                        <!-- You can make this dynamic if needed -->
                                                        <td>{{ \Carbon\Carbon::parse($tour->start_date)->format('d-m-Y') }}
                                                            to
                                                            {{ \Carbon\Carbon::parse($tour->end_date)->format('d-m-Y') }}
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $date_wise_destination = json_decode($tour->date_wise_destination, true); // decode into array
                                                            ?>

                                                            {{ implode(', ', array_column($date_wise_destination, 'dham')) }}

                                                        </td>

                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                {{-- <button class="btn btn-sm btn-info view-pilgrims"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#pilgrimDetailsModal">
                                                                    <i class="fas fa-eye"></i>
                                                                </button> --}}
                                                                <a href="{{ route('tour.edit', $tour->id) }}"
                                                                    class="btn btn-sm btn-primary">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                @if (empty($tour->pilgrims))
                                                                <a href="{{ route('addPligrim', ['id' => $tour->id]) }}"
                                                                    class="btn btn-sm btn-success">
                                                                    Add Pilgrim
                                                                </a>
                                                                @else 
                                                                <a href="{{ route('download') }}"
                                                                    class="btn btn-sm btn-success">
                                                                    Download Certificate
                                                                </a>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="7" class="text-center">No tours found.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pilgrim Details Modal -->
    <div class="modal fade" id="pilgrimDetailsModal" tabindex="-1" aria-labelledby="pilgrimDetailsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pilgrimDetailsModalLabel">Pilgrim Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>Sr No</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th>Mobile</th>
                                    <th>Aadhaar</th>
                                    <th>Medical Condition</th>
                                    <th>Vehicle</th>
                                </tr>
                            </thead>
                            <tbody id="pilgrimDetailsTableBody">
                                <!-- Pilgrim details will be populated here dynamically -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @include('partials.user_footer')
</body>

</html>
