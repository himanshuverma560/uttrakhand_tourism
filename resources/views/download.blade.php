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
                        <!-- Download Registration -->
                        <div class="col-12 download-registration">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-header text-white d-flex align-items-center mb-3">
                                        <h5 class="card-title">List of Pilgrims/Tourist</h5>
                                        <!-- <div class="d-flex align-items-center">
                                            <select class="form-select me-3" style="width: 200px;">
                                                <option value="">Select Tour</option>
                                                <option value="Tour_04052025">Tour_04052025</option>
                                            </select>
                                            <div class="search-box position-relative">
                                                <input type="text" class="form-control" placeholder="Search Here">
                                                <button class="btn btn-primary position-absolute end 0 top-0 bottom-0">Search</button>
                                            </div>
                                        </div> -->
                                    </div>

                                    {{-- <a href="addPilgrim.html" class="btn btn-add-pilgrim me-4 mb-3">
                                        Add New Pilgrim/Tourist
                                    </a> --}}

                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Mobile Number</th>
                                                    <th>Tour ID</th>
                                                    <th>Action</th>
                                                    <th>Download Registration Letter</th>
                                                    <th>Certificate</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $value)
                                                    <tr>
                                                        <td><a href="#"
                                                                class="text-primary">{{ $value->name }}</a></td>
                                                        <td>{{ $value->mobile }}</td>
                                                        <td>{{ $value->tour_id }}</td>
                                                        <td>
                                                            <div class="d-flex justify-content-center gap-2">
                                                                <a href="{{ route('editPligrim', ['id' => $value->id]) }}"
                                                                    class="btn btn-sm btn-link p-0"><i
                                                                        class="fas fa-edit"></i></a>
                                                                <a href="{{ route('editPligrim', ['id' => $value->id, 'mode' => 'view']) }}"
                                                                    class="btn btn-sm btn-link p-0">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @if ($value->status == 1)
                                                                <a href={{ route('download-pdf', ['id' => $value->id]) }}
                                                                    class="btn btn-warning btn-sm">Download PDF</a>
                                                            @endif

                                                            @if ($value->status == 0 && $payment->status == 1)
                                                                <button type="button" class="btn btn-primary btn-sm"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#qrModal{{ $qr->id }}">
                                                                    Payment
                                                                </button>
                                                            @endif
                                                        </td>

                                                        <td></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-end gap-2 mt-3">
                                        <button class="btn btn-secondary">First</button>
                                        <button class="btn btn-secondary">Previous</button>
                                        <button class="btn btn-primary">1</button>
                                        <button class="btn btn-secondary">Next</button>
                                        <button class="btn btn-secondary">Last</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Payment QR Modal -->
    <div class="modal fade payment-modal" id="qrModal{{ $qr->id }}" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="qrModalLabel{{ $qr->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="qrModalLabel{{ $qr->id }}">Payble Amount: {{ $value->amount }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-3 py-4">
                    <p style="margin: 0;"><a href="#" onclick="copyUPI()" style="border: 1px solid green;padding:2px">Copy UPI</a>: <span id="upi-text">{{ $qr->upi }}</span></p>
                    <div class="qr-image-wrapper my-3">
                        <img src="{{ asset($qr->qr_image) }}" alt="{{ $qr->name }}" class="img-fluid"
                            style="max-width: 200px;">
                    </div>
                    <form action="{{ route('payment.store') }}" method="POST" enctype="multipart/form-data"
                        class="mt-4">
                        @csrf
                        <div class="mb-3">
                            <label for="qr_image" class="form-label">Upload Payment Screenshot</label>
                            <input type="file" name="qr_image" class="form-control" accept="image/*" required>
                            <input type="hidden" name="pilgrim_id" value="{{ $value->id }}">
                        </div>
                        <button type="submit" class="btn btn-info w-100">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS and dependencies -->
    @include('partials.user_footer')
    <script src="{{ asset('js/download.js') }}"></script>
</body>
@if (request('success') && request('payment_id'))
    <script>
        window.onload = function() {
            alert("You can download Certificate after some time");
        };
    </script>
@endif
<script>
    function copyUPI() {
        const upiText = document.getElementById("upi-text").innerText;
        navigator.clipboard.writeText(upiText).then(function() {
            //alert("UPI ID copied to clipboard!");
        }, function(err) {
            alert("Failed to copy UPI ID");
        });
    }
</script>
</html>
