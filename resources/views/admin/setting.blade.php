@extends('admin.layouts.admin_layout')
@section('content')
<div class="container">
    <br>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        {{-- Left: Upload QR + List (col-8) --}}
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header"><strong>Price master</strong></div>
                <div class="card-body">
                    <form action="{{ route('price.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Title</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Price</label>
                            <input type="text" name="price" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Select Dham</label>
                            <select class="form-control" name="dham_id">
                                @foreach ($dhams as $dham)
                                <option value="{{$dham->id}}">{{$dham->name}}</option>  
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><strong>Uploaded QRs</strong></div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Dham</th>
                                
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dhamPayments as $payment)
                                <tr>
                                    <td>{{ $payment->name }}</td>
                                    <td>{{ $payment->price }}</td>
                                    <td>{{ $payment->dham->name }}</td>
                                    
                                    <td>
                                        
                                        <a href="{{ route('price.edit', $payment->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">No QRs uploaded yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>

        {{-- Right: Enable Payment Option (col-4) --}}
        <div class="col-md-4">
            <div class="card">
                <div class="card-header"><strong>Enable Payment Option</strong></div>
                <div class="card-body">
                    {{-- You can replace this with a real form or toggle switch --}}
                    <form action="{{route('admin.payments.status')}}" method="POST">
                        @csrf
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="enable_payment" id="enable_payment" {{$payments->status == 1 ? 'checked' : ''}}>
                            <label class="form-check-label" for="enable_payment" >
                                Enable UPI / QR Payment
                            </label>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Save Settings</button>
                    </form>
                </div>
            </div>
            <br>

            <div class="card">
                <div class="card-header"><strong>Upload Payment QR</strong></div>
                <div class="card-body">
                    {{-- You can replace this with a real form or toggle switch --}}
                    <form action="{{route('qr.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-check mb-3">
                            <label for="qr_image" class="form-label">QR Image</label>
                            <input type="file" name="qr_image" class="form-control" required>
                        </div>
                        <div class="form-check mb-3">
                            <label for="qr_image" class="form-label">UPI</label>
                            <input type="text" name="upi" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-info w-100">Upload</button>
                    </form>

                    <table class="table">
                        <tr>
                            <th>Upi</th>
                            <th>QR</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($qrs as $qr)
                            <tr>
                                <td>{{ $qr->upi }}</td>
                                <td><img src="{{ asset($qr->qr_image) }}" width="70px"></td>
                                <td>
                                    <a href="{{ route('qr.download', $qr->id) }}" class="btn btn-sm btn-success">Download</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
