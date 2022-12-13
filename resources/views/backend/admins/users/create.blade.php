@extends('layouts.app')

@section('content')
    <form action="{{ route('admin.hr.store') }}" method="post">
        @csrf
        @include('backend.admins.users.fields')
    </form>
@endsection
