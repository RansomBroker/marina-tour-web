@extends('layouts.app')

@section('title', 'Smith Travel Bali - Tour Detail')

@section('content')
    <livewire:public.tour-detail :slug="$slug" />
@endsection
