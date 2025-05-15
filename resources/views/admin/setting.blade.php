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
                <div class="card-header"><strong>Upload QR</strong></div>
                <div class="card-body">
                    <form action="{{ route('qr.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">QR Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="qr_image" class="form-label">QR Image</label>
                            <input type="file" name="qr_image" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Upload</button>
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
                                <th>QR Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($qrs as $qr)
                                <tr>
                                    <td>{{ $qr->name }}</td>
                                    <td>
                                        <img src="{{ asset($qr->qr_image) }}" alt="{{ $qr->name }}">
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2">No QRs uploaded yet.</td>
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
        </div>
    </div>
</div>
@endsection
