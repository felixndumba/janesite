@extends('layouts.app')
@extends('layouts.header')


@section('content')
<main >
    <!-- Hero Section -->
   <div
   data-aos="zoom-in-right" data-aos-delay="200" data-aos-duration="1000">
    @include('partials.section1')
   </div>
    <div id="about"
    data-aos="zoom-in-right" data-aos-delay="200" data-aos-duration="1000">
        @include('partials.about')
    </div>
     <div id="#"
     data-aos="zoom-in-right" data-aos-delay="200" data-aos-duration="1000">
        @include('partials.counter')
    </div>
    <div data-aos="zoom-in-right" data-aos-delay="200" data-aos-duration="1000">
        @include('partials.servicessupport')
    </div data-aos="zoom-in-right" data-aos-delay="200" data-aos-duration="1000">
     <div id="services"
     data-aos="zoom-in-right" data-aos-delay="200" data-aos-duration="1000">
        @include('partials.service-1')
    </div>
     
    <div id="partners"
    data-aos="zoom-in-right" data-aos-delay="200" data-aos-duration="1000">
        @include('partials.partner')
    </div>
    
   
    <div id="reviews"
    data-aos="zoom-in-right" data-aos-delay="200" data-aos-duration="1000">
        @include('partials.reviews')
    </div>
    <div id="faqs">
        @include('partials.faqs')
    </div>
</main>
@endsection
