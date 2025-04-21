@extends('website.app')

@section('content')
    @include('website.components.header')
    <main class="main">

        <!-- Hero Section -->
        @include('website.components.hero-section')

        <!-- /Hero Section -->

        <!-- About Section -->
        @include('website.components.about-us')
        <!-- /About Section -->

        <!-- Features Section -->
        @include('website.components.featured-section')
        <!-- /Features Section -->

        <!-- Stats Section -->
        @include('website.components.state-section')
        <!-- /Stats Section -->

        <!-- Details Section -->
        @include('website.components.detailed-section')
        <!-- Testimonials Section -->
        @include('website.components.testimonial')
        <!-- /Testimonials Section -->

        <!-- Team Section -->
        @include('website.components.teams')
        <!-- /Team Section -->

        <!-- Pricing Section -->
        @include('website.components.pricing',['plans'=>$plans])
        <!-- /Pricing Section -->

        <!-- Faq Section -->
        @include('website.components.faq-section')
        <!-- /Faq Section -->

        <!-- Contact Section -->
        @include('website.components.contact-us')
        <!-- /Contact Section -->

    </main>


    @include('website.components.footer')

@endsection
