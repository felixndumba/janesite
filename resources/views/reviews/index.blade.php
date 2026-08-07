@extends('layouts.app')

@section('title', 'Reviews | Thedi Advisors')
@section('meta_description', 'Read client reviews and testimonials for Thedi Advisors, a financial consulting and advisory firm in Kenya.')
@section('canonical_url', url('/reviews'))
@section('og_image', asset('images/jane1.jpg'))

@section('content')

    {{-- Inline review form shown first (no popup) --}}
    @include('partials.reviews-form-inline')

    {{-- Review messages come after the form --}}
    @include('partials.reviews-carousel')

@endsection

