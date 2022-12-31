@extends('base')

@section('title', 'CMB - Remote Controller')

@push('scripts')
    @vite(['resources/assets/js/remote/app.ts'])
@endpush
