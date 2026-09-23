@extends('layouts.app')

@section('title', $blog->meta_title ?: $blog->title . ' - Smith Travel Bali')
@section('meta_description', $blog->meta_description ?: $blog->description)

@section('content')
    <livewire:public.blog-detail :slug="$blog->slug" />
@endsection
