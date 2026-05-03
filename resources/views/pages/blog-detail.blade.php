@extends('layouts.app')

@section('title', 'Smith Travel Bali - Blog Detail')

@section('content')
    <livewire:public.blog-detail :slug="$slug" />
@endsection
