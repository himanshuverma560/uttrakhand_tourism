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
                                                    <td><a href="#" class="text-primary">{{$value->name}}</a></td>
                                                    <td>{{$value->mobile}}</td>
                                                    <td>{{$value->tour_id}}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-center gap-2">
                                                            <a href="{{route('editPligrim', ['id' => $value->id])}}" class="btn btn-sm btn-link p-0"><i class="fas fa-edit"></i></a>
                                                            <a href="{{ route('editPligrim', ['id' => $value->id, 'mode' => 'view']) }}" class="btn btn-sm btn-link p-0">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </div>
                                                    </td>   
                                                    <td>
                                                        @if ($value->status == 1)
                                                        <button class="btn btn-danger download-pdf"
                                                        data-regno="{{Auth::user()->unique_id}}"
                                                        data-group-id="{{$value->tour_id}}"
                                                        data-destination="{{$value->destinations}}"
                                                        data-tour-days="{{$value->tour_days}}"
                                                        data-selected-dates="{{$value->date_wise_destination}}"
                                                        data-full-name="{{$value->name}}"
                                                        data-gender="{{$value->gender}}"
                                                        data-age="{{$value->age}}"
                                                        data-diseases="NA"
                                                        data-aadhar="{{$value->aadhar_card}}"
                                                        data-email="{{$value->email}}"
                                                        data-mobile="{{$value->mobile}}"
                                                        data-address="{{$value->address}}"
                                                        data-state="{{$value->state}}"
                                                        data-photo-url="{{$value->profile_image_path}}"
                                                        data-qr-url="https://example.com/qr.jpg",
                                                        data-city="{{$value->city}}",
                                                        data-country="{{$value->country}}",
                                                        data-district="{{$value->district}}",
                                                        data-contact-number="{{$value->contact_number}}",
                                                        data-contact-person="{{$value->contact_person}}",
                                                        data-contact-relation="{{$value->contact_relation}}",
                                                        data-vehicle-details="{{$value->vehicle_details}}",
                                                        data-drivers-name="{{$value->driver_name}}",
                                                        data-vehicle-number="{{$value->vehicle_number}}">
                                                        Download PDF</button>
                                                        @endif

                                                        @if ($value->status == 0 && $payment->status == 1)
                                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#qrModal{{ $qr->id }}">
                                                                Payment
                                                            </button>

                                                            <div class="modal fade" id="qrModal{{ $qr->id }}" tabindex="-1" aria-labelledby="qrModalLabel{{ $qr->id }}" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content text-center">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="qrModalLabel{{ $qr->id }}">Payble Amount: {{$value->amount}}</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <h5>UPI ID: {{$qr->upi}}</h5>
                                                                            <img src="{{ asset($qr->qr_image) }}" alt="{{ $qr->name }}" class="img-fluid" style="max-width: 250px;">
                                                                            <form action="{{route('qr.store')}}" method="POST" enctype="multipart/form-data">
                                                                                @csrf
                                                                                <div class="form-check mb-3">
                                                                                    <label for="qr_image" class="form-label">Upload Payment ScreenShort</label>
                                                                                    <input type="file" name="qr_image" class="form-control" required>
                                                                                </div>
                                                                            
                                                                                <button type="submit" class="btn btn-info w-80">Upload</button>
                                                                            </form>
                                                    
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
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

    
    <script src="{{ asset('js/download.js') }}"></script>
    <!-- Bootstrap JS -->
    @include('partials.user_footer')
</body>
</html>