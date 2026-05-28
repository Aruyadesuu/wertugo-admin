@extends('layouts.app')
@section('title', 'Dashboard')
@section('admin-content')

<div class="container my-3">
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h1>Total User</h1>
                    <p>{{ $stats['total_user'] }}</p>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection