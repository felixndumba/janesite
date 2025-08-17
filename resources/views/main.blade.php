@extends('layouts.app')
@extends('layouts.header')


@section('content')
<main >
    <!-- Hero Section -->
   <div>
    @include('partials.section1')
   </div>
    <div>
        @include('partials.about')
    </div>
    <div>
        @include('partials.servicessupport')
    </div>
     <div>
        @include('partials.services')
    </div>
    <div>
        @include('partials.partner')
    </div>
    <div>
        @include('partials.reviews')
    </div>
    <div>
        @include('partials.faqs')
    </div>
</main>
@endsection
