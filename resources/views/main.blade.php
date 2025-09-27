@extends('layouts.app')
@extends('layouts.header')


@section('content')
<main >
    <!-- Hero Section -->
   <div>
    @include('partials.section1')
   </div>
    <div id="about">
        @include('partials.about')
    </div>
    <div data-aos="zoom-in-right" data-aos-delay="200" data-aos-duration="1000">
        @include('partials.servicessupport')
    </div data-aos="zoom-in-right" data-aos-delay="200" data-aos-duration="1000">
     <div id="services">
        @include('partials.service-1')
    </div>
     
    <div id="partners">
        @include('partials.partner')
    </div>
    
   
    <div id="reviews">
        @include('partials.reviews')
    </div>
    <div id="faqs">
        @include('partials.faqs')
    </div>
</main>
@endsection
