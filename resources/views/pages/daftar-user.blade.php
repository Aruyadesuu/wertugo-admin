@extends('layouts.app')
@section('title', 'Daftar User')

@section('admin-content')

<div class="container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Profil</th>
                <th>Username</th>
                <th>Email</th>
                <th>Country</th>
                <th>Role</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $index => $user)
            <tr>
                <td>{{ $user['foto_profil'] }}</td>
                <td>{{ $user['username'] }}</td>
                <td>{{ $user['email'] }}</td>
                <td>{{ $user['country'] }}</td>
                <td>{{ $user['role'] }}</td>
                <td>{{ $user['created_at'] }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6">Belum ada data user.</td>
            </tr>
            @endforelse
        </tbody>
        



    </table>

</div>


@endsection