@extends('admin.layouts.admin_layout')
@section('content')
<div class="container">
    <br>
    <h2>Edit QR</h2>

    <form action="{{ route('qr.update', $qr->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">QR Name</label>
            <input type="text" name="name" class="form-control" value="{{ $qr->name }}" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="text" name="price" class="form-control" value="{{ $qr->price }}" required>
        </div>

        <div class="mb-3">
            <label for="dham_id" class="form-label">Select Dham</label>
            <select class="form-control" name="dham_id">
                @foreach ($dhams as $dham)
                    <option value="{{ $dham->id }}" {{ $qr->dham_id == $dham->id ? 'selected' : '' }}>
                        {{ $dham->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="qr_image" class="form-label">QR Image</label>
            <input type="file" name="qr_image" class="form-control">
            <small>Current: <img src="{{ asset($qr->qr_image) }}" width="100"></small>
        </div>

        <button type="submit" class="btn btn-primary">Update QR</button>
    </form>
</div>
@endsection
