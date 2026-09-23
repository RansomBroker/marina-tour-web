@extends('layouts.admin')

@section('title', 'Edit Article - Smith Travel Bali')
@section('title_breadcrumb', 'Edit Article')

@section('content')
    <livewire:admin.blog-form :blogId="$id" />
@endsection
