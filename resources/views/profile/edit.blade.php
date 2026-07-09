@extends('layout.master')

@section('content')
<head>
    <style>
        input[type="text"] {
            text-transform: none !important;
        }
        
</style>
</head>
<div class="container mt-4 p-4 border rounded">
    
  {{-- <h3>Edit Profile</h3> --}}

  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <form action="{{ route('profile.update') }}" method="POST">
    @csrf
    @method('PUT')

    @foreach (['first_name','last_name','email','phone','province','city','postal_code'] as $field)
      <div class="form-group">
        <label>{{ ucwords(str_replace('_', ' ', $field)) }}</label>
        <input type="text" name="{{ $field }}" value="{{ old($field, $user->$field) }}"
               class="form-control @error($field) is-invalid @enderror">
        @error($field)
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
    @endforeach

    <button type="submit" class="btn btn-success mt-3">Save Changes</button>
  </form>
</div>
@endsection