<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> Doctorly | Hospital & Clinic Management Laravel System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Manage your hospital and clinic operations efficiently with Doctorly, a powerful Laravel-based system for healthcare institutions. Streamline patient records, appointments, billing, and more.">
    <meta name="keywords" content="Doctorly, Hospital Management, Clinic Management, Laravel System, Healthcare Software">
    <meta name="author" content="Themesbrand">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('frontend/images/favicon.ico') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.4.47/css/materialdesignicons.min.css" />
    <!-- App css -->
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('frontend/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('frontend/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('frontend/libs/toastr/build/toastr.min.css') }}" rel="stylesheet" type="text/css">

</head>

<body>

    <div class="landing-page">
        <!-- header nav bar start  -->
        <header>
            <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top navbar-custom sticky sticky-light"
                id="navbar">
                <div class="container">
                    <a class="navbar-brand logo" href="#!">
                        <img src="{{ asset('frontend/images/logo-dark.png') }}" alt="" height="22">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#home">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#services">Services</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#departments">Departments</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#team">Team</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#reviews">Reviews</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#faqs">FaQ's</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#contact">Contact</a>
                            </li>
                        </ul>

                        @auth
                            <div class="nav-btn">
                                <a href="{{ route('dashboard') }}" class="btn btn-primary"><i
                                        class="mdi mdi-login me-2"></i>Dashboard</a>
                            </div>
                        @else
                            <div class="nav-btn">
                                <a href="{{ route('login') }}" class="btn btn-primary"><i class="mdi mdi-login me-2"></i>Log
                                    in</a>
                            </div>
                        @endauth


                    </div>
                </div>
            </nav>
        </header>
        <!-- header nav bar end  -->


        <!-- home-section start -->
        <section class="hero-section bg-img" id="home">
            <div class="container">
                <!-- row start  -->
                <div class="row align-items-center justify-content-between g-3 g-lg-5">
                    <div class="col-lg-5 align-self-start">
                        <div class="hero-content">
                            <div class="title-sm my-4">
                                <h4 class="text-success">Certificated Doctors</h6>
                            </div>
                            <div class="hero-header">
                                <h1 class="display-6 lh-base fw-medium">Search and find <span class="text-primary">
                                        our clinic </span>for better solution</h1>
                                <p>Expands Access To Care For Patients And Supports Community Health Staff And
                                    Junior Doctors. Consult With Online Doctors In Worldwide - Book Appointment With
                                    Doctors.</p>
                            </div>
                            <div class="hero-btn mt-4">
                                <a href="login_2.htm" class="btn btn-primary"><i
                                        class="mdi mdi-file-document-edit-outline me-2"></i>Make an Appointment</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 align-self-end">
                        <div class="img-part ms-auto">
                            <img src="{{ asset('frontend/images/landing/doctor-team.png') }}" alt="doctor"
                                class="img-fluid img-width">
                            <div class="img-text text-center p-3 pb-1 rounded-3 z-n1">
                                <i class="mdi mdi-ambulance"></i>
                                <p class="my-2 fw-semibold">24 Hour Doctor</p>
                                <div class="mb-3">
                                    <span>We Provide 24/7 Medical Services</span>
                                </div>
                            </div>
                            <div class="img-text-1 text-start rounded-3 px-3 p-2">
                                <i class="mdi mdi-doctor"></i>
                                <div class="text">
                                    <p class="pt-2 pb-2 ms-4 fw-semibold mb-0">Best Doctor In Our Hospital</p>
                                    <div class="ms-4">
                                        <span>All Department</span>
                                    </div>
                                </div>
                            </div>
                            <div class="img-text-2 text-center p-2 px-3 rounded-3">
                                <i class="mdi mdi-cast-education"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- row end  -->
            </div>
        </section>
        <!-- home-section end  -->

        <!-- services-section start  -->
        <section class="section about-section bg-light" id="services">
            <div class="container">
                <!-- row start  -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="about-header text-center">
                            <h1>Health services for you</h1>
                            <p> We are always here to listening and understanding</p>

                        </div>
                    </div>
                </div>
                <!-- row end  -->
                <div class="about-content mt-5">
                    <!-- row start  -->
                    <div class="row align-items-center justify-content-center g-4">
                        <div class="col-lg-2 col-md-6">
                            <div class="icon-text p-4 pb-3 text-center shadow">
                                <i class="mdi mdi-virus"></i>
                                <p class="mt-4 fw-semibold">Covid-19 Test</p>

                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6">
                            <div class="icon-text p-4 pb-3 bg-primary text-center shadow">
                                <i class="mdi mdi-tooth"></i>
                                <p class="mt-4 fw-semibold text-light">Dental Care</p>

                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6">
                            <div class="icon-text p-4 pb-3 text-center shadow">
                                <i class="mdi mdi-heart-pulse"></i>
                                <p class="mt-4 fw-semibold">Heart Caring</p>

                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6">
                            <div class="icon-text p-4 pb-3 bg-primary text-center shadow">
                                <i class="mdi mdi-bone"></i>
                                <p class="mt-4 fw-semibold text-light">Orthopadic</p>

                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6">
                            <div class="icon-text p-4 pb-3 text-center shadow">
                                <i class="mdi mdi-clipboard-search-outline"></i>
                                <p class="mt-4 fw-semibold">Research</p>

                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6">
                            <div class="icon-text p-4 pb-3 bg-primary text-center shadow">
                                <i class="mdi mdi-lungs"></i>
                                <p class="mt-4 fw-semibold text-light">Lungs</p>

                            </div>
                        </div>
                    </div>
                    <!-- row end  -->
                </div>
            </div>
        </section>
        <!-- services-section end  -->

        <!-- services-section start  -->
        <section class="section services-section">
            <div class="container">
                <!-- row start  -->
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="about-header text-center">
                            <h1 class="lh-base">Why Choose <span class="text-primary">Doctorly </span>Home care ?
                            </h1>
                            <p>The medical profession is the most respected profession in the world. No matter
                                where you work, you as a doctor</p>
                        </div>
                    </div>
                </div>
                <!-- row end  -->
                <div class="services-content mt-5">
                    <div class="row align-items-center justify-content-center g-4">
                        <div class="col-lg-3 col-md-6">
                            <div class="content-main bg-light p-4 rounded-3 shadow-sm">
                                <i class="mdi mdi-medical-bag"></i>
                                <h4 class="my-4 lh-base">Medical Advices & Check Ups</h4>
                                <a href="#!" class="text-primary fw-medium">Learn More</a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="content-main bg-light p-4 rounded-3 shadow-sm">
                                <i class="mdi mdi-needle"></i>
                                <h4 class="my-4 lh-base">Trusted Medical Treatment</h4>
                                <a href="#!" class="text-primary fw-medium">Learn More</a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="content-main bg-light p-4 rounded-3 shadow-sm">
                                <i class="mdi mdi-store-24-hour"></i>
                                <h4 class="my-4 lh-base">Emergency Help Aveilable 24/7</h4>
                                <a href="#!" class="text-primary fw-medium">Learn More</a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="content-main bg-light p-4 rounded-3 shadow-sm">
                                <i class="mdi mdi-doctor"></i>
                                <h4 class="my-4 lh-base">Research Professional</h4>
                                <a href="#!" class="text-primary fw-medium">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <!-- row end  -->
                </div>
            </div>
        </section>
        <!-- services-section end  -->

        <!-- features-section start  -->
        <section class="features-section bg-light" id="features">
            <div class="container">
                <!-- row start  -->
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-5">
                        <div class="features-img">
                            <img src="{{ asset('frontend/images/landing/doctor-2.png') }}" alt="doctor"
                                class="img-fluid">
                            <div class="img-text-2 text-center bg-white p-3 pb-3 rounded-3">
                                <i class="mdi mdi-doctor"></i>
                                <p class="mt-2 mb-0 fw-semibold">Dr. Aenna backer </p>
                                <span>New York, United states</span>
                                <div class="hero-btn mt-3">
                                    <a href="#!" class="btn btn-primary"><i
                                            class="mdi mdi-file-document-edit-outline me-2 p-0 bg-primary fs-5 text-light"></i>Appointment</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Our Features --}}
                    <div class="col-lg-5 align-self-start">
                        <div class="features-header pt-3">
                            <div class="title-sm">
                                <h4 class="text-success">Our Features</h5>
                            </div>
                            <h1 class="lh-base mt-3">We are always ensure best <span class="text-primary">Medical
                                    treatment</span> for Your Health</h1>
                            <p>Pain Management Treatment Options Pain and symptom management is one of the primary
                                goals of palliative and hospice care</p>
                        </div>
                        <div class="features-list d-flex mt-2">
                            <i class="mdi mdi-check-circle"></i>
                            <p class="pt-2 ms-4">Top Specialist Doctor</p>
                        </div>
                        <div class="features-list d-flex mt-2">
                            <i class="mdi mdi-check-circle"></i>
                            <p class="pt-2 ms-4">State of the art Doctor services</p>
                        </div>
                        <div class="features-list d-flex mt-2">
                            <i class="mdi mdi-check-circle"></i>
                            <p class="pt-2 ms-4">Discount for all medical treatment</p>
                        </div>
                        <div class="features-list d-flex mt-2">
                            <i class="mdi mdi-check-circle"></i>
                            <p class="pt-2 ms-4">Enrollment is Quick and easy</p>
                        </div>
                        <div class="feature-btn mt-3 mb-5">
                            <a href="#!" class="btn btn-primary"><i
                                    class="mdi mdi-file-document-edit-outline me-2"></i>Make an Appointment</a>
                        </div>
                    </div>


                    {{-- Book Appointment --}}



                </div>
                <!-- row end  -->
            </div>
        </section>
        <!-- features-section end  -->


        <!-- Appointment-section start  -->
        <section class="features-section bg-light" id="features">
            <div class="container">
                <!-- row start  -->
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-5">
                        <div class="features-img">
                            <img src="{{ asset('frontend/images/landing/doctor-2.png') }}" alt="doctor"
                                class="img-fluid">
                            <div class="img-text-2 text-center bg-white p-3 pb-3 rounded-3">
                                <i class="mdi mdi-doctor"></i>
                                <p class="mt-2 mb-0 fw-semibold">Dr. Aenna backer </p>
                                <span>New York, United states</span>
                                <div class="hero-btn mt-3">
                                    <a href="#!" class="btn btn-primary"><i
                                            class="mdi mdi-file-document-edit-outline me-2 p-0 bg-primary fs-5 text-light"></i>Appointment</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Our Features --}}
                    <div class="col-lg-5">
                        <div class="bg-light rounded h-100 d-flex align-items-center p-5">
                            <form action="{{ route('frontend.book.appointment') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-12 col-sm-6">
                                        <input type="text" name="name" class="form-control border-0"
                                            placeholder="Name" style="height: 55px;" required="">
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <input type="email" name="email" class="form-control border-0"
                                            placeholder="Email" style="height: 55px;" required="">
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <input type="text" name="phone" class="form-control border-0"
                                            placeholder="Mobile Number " style="height: 55px;" required="">
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <select class="form-select border-0" style="height: 55px;" name="doctor_id">
                                            @foreach ($doctors as $doctor)
                                                <option value="{{ $doctor->id }}">
                                                    {{ $doctor->user->name }} - {{ $doctor->department->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="date" id="date" data-target-input="nearest">
                                            <input type="date" name="date"
                                                class="form-control border-0" placeholder="Date "
                                                style="height: 55px;" required="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="time" id="time" data-target-input="nearest">
                                            <input type="time" name="time"
                                                class="form-control border-0" placeholder="Time"
                                                style="height: 55px;" required="">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <textarea class="form-control border-0" name="reason" rows="5" placeholder="Reason" required=""></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100 py-3" type="submit">Book Appointment
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                    {{-- Book Appointment --}}



                </div>
                <!-- row end  -->
            </div>
        </section>
        <!-- Appointment-section end  -->

        <!-- departments-section start  -->
        <section class="section department-section pb-4" id="departments">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="department-header text-center">
                            <div class="title-sm">
                                <h4 class="text-success">Our Department</h5>
                            </div>
                            <h1 class="lh-base mt-3">We have all <span class="text-primary">Department</span></h1>
                            <p>Dermatologists Have problems with your skin, hair, nails? · Endocrinologists These
                                are
                                experts on hormones and metabolism. </p>
                        </div>
                    </div>
                </div>
                <div class="row mt-5
                 g-3">
                    <div class="col-lg-2 col-md-6">
                        <a href="#!">
                            <div class="department-content text-center p-3 bg-light rounded-3 shadow-sm">
                                <i class="mdi mdi-human-wheelchair"></i>
                                <h5 class="mt-1">Crutches</h5>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <a href="#!">
                            <div class="department-content text-center p-3 bg-light rounded-3 shadow-sm">
                                <i class="mdi mdi-radiology-box"></i>
                                <h5 class="mt-1">X-ray</h5>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <a href="#!">
                            <div class="department-content text-center p-3 bg-light rounded-3 shadow-sm">
                                <i class="mdi mdi-heart-pulse"></i>
                                <h5 class="mt-1">Pulmonary</h5>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <a href="#!">
                            <div class="department-content text-center p-3 bg-light rounded-3 shadow-sm">
                                <i class="mdi mdi-lungs"></i>
                                <h5 class="mt-1">Cardiology</h5>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <a href="#!">
                            <div class="department-content text-center p-3 bg-light rounded-3 shadow-sm">
                                <i class="mdi mdi-tooth"></i>
                                <h5 class="mt-1">Dental Care </h5>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <a href="#!">
                            <div class="department-content text-center p-3 bg-light rounded-3 shadow-sm">
                                <i class="mdi mdi-brain"></i>
                                <h5 class="mt-1">Neurology</h5>
                            </div>
                        </a>
                    </div>


                    <div class="col-lg-2 col-md-6">
                        <a href="#!">
                            <div class="department-content text-center p-3 bg-light rounded-3 shadow-sm">
                                <i class="mdi mdi-needle"></i>
                                <h5 class="mt-1">Medical</h5>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <a href="#!">
                            <div class="department-content text-center p-3 bg-light rounded-3 shadow-sm">
                                <i class="mdi mdi-bone"></i>
                                <h5 class="mt-1">Orthopadic</h5>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <a href="#!">
                            <div class="department-content text-center p-3 bg-light rounded-3 shadow-sm">
                                <i class="mdi mdi-water"></i>
                                <h5 class="mt-1">Blood Bank</h5>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <a href="#!">
                            <div class="department-content text-center p-3 bg-light rounded-3 shadow-sm">
                                <i class="mdi mdi-wheelchair-accessibility"></i>
                                <h5 class="mt-1">Surgical</h5>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <a href="#!">
                            <div class="department-content text-center p-3 bg-light rounded-3 shadow-sm">
                                <i class="mdi mdi-mother-nurse"></i>
                                <h5 class="mt-1">Nursing</h5>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <a href="#!">
                            <div class="department-content text-center p-3 bg-light rounded-3 shadow-sm">
                                <i class="mdi mdi-head-snowflake"></i>
                                <h5 class="mt-1">Psychiarty</h5>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- departments-section end  -->

        <!-- doctors-section start  -->
        <section class="section team-section" id="team">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="department-header text-center">
                            <div class="title-sm">
                                <h4 class="text-success">Our Doctor</h5>
                            </div>
                            <h1 class="lh-base mt-3">We Have Best <span class="text-primary">Doctor</span></h1>
                            <p>TeamDoctor provides organisations with an essential video-based online training
                                course
                                for
                                all employees which gives a baseline of knowledge. </p>
                        </div>
                    </div>
                </div>
                <div class="row mt-5 align-items-center">
                    <div class="col-lg-12">
                        <div class="swiper mySwiper swiper-btn">
                            <div class="swiper-wrapper mb-5">
                                <div class="swiper-slide">
                                    <div class="doctor-img shadow-sm p-3">
                                        <img src="{{ asset('frontend/images/landing/doctor-4.png') }}" alt="doctor"
                                            class="img-fluid">
                                        <div class="doctor-detail mt-3 text-center">
                                            <h4>Dr. Morak jhon</h4>
                                            <p>Anesthesiologists</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="doctor-img shadow-sm p-3">
                                        <img src="{{ asset('frontend/images/landing/doctor-3.png') }}" alt="doctor"
                                            class="img-fluid">

                                        <div class="doctor-detail mt-3 text-center">
                                            <h4>Dr. Aenna backer</h4>
                                            <p>Cardiologist</p>

                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="doctor-img shadow-sm p-3">
                                        <img src="{{ asset('frontend/images/landing/doctor-5.png') }}" alt="doctor"
                                            class="img-fluid">

                                        <div class="doctor-detail mt-3 text-center">
                                            <h4>Dr. Morish Jemsh</h4>
                                            <p>Dermatologists</p>

                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="doctor-img shadow-sm p-3">
                                        <img src="{{ asset('frontend/images/landing/doctor-6.png') }}" alt="doctor"
                                            class="img-fluid">

                                        <div class="doctor-detail mt-3 text-center">
                                            <h4>Dr. Olivia Nebar</h4>
                                            <p>Endocrinologists</p>

                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="doctor-img shadow-sm p-3">
                                        <img src="{{ asset('frontend/images/landing/doctor-7.jpg') }}" alt="doctor"
                                            class="img-fluid">

                                        <div class="doctor-detail mt-3 text-center">
                                            <h4>Dr. Hory Mant</h4>
                                            <p>Anesthesiologists</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="doctor-img shadow-sm p-3">
                                        <img src="{{ asset('frontend/images/landing/doctor-8.jpg') }}" alt="doctor"
                                            class="img-fluid">

                                        <div class="doctor-detail mt-3 text-center">
                                            <h4>Dr. Vrutki vahut</h4>
                                            <p>Cardiologist</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="doctor-img shadow-sm p-3">
                                        <img src="{{ asset('frontend/images/landing/doctor-9.jpg') }}" alt="doctor"
                                            class="img-fluid">

                                        <div class="doctor-detail mt-3 text-center">
                                            <h4>Dr. Krish Bardan</h4>
                                            <p>Dermatologists</p>

                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="doctor-img shadow-sm p-3 mb-2">
                                        <img src="{{ asset('frontend/images/landing/doctor-10.jpg') }}"
                                            alt="doctor" class="img-fluid">

                                        <div class="doctor-detail mt-3 text-center">
                                            <h4>Dr. Teri Hrio</h4>
                                            <p>Endocrinologists</p>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        // <!-- doctors-section end  -->

        <!-- testimonial-section start  -->
        <section class="section testimonial-section bg-light overflow-hidden" id="reviews">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="testimonial-header text-center">
                            <div class="title-sm">
                                <h4 class="text-success">Testimonial</h5>
                            </div>
                            <h1 class="lh-base mt-3">Patient's <span class="text-primary"> Feedback</span></h1>
                            <p> This review shows that incorporating patient feedback of their experience into
                                research
                                on
                                quality patient-centred care</p>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center justify-content-center mt-5">
                    <!--end col-->
                    <div class="col-lg-12">
                        <!-- Swiper -->
                        <div class="swiper-container testi-slider pb-5 overflow-hidden">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide bg-light">
                                    <div class="testi-box p-3 position-relative">
                                        <div class="user-img shadow-sm p-3 bg-white rounded-3">
                                            <img src="{{ asset('frontend/images/landing/img-1.jpg') }}"
                                                alt="doctor" class="img-fluid rounded-circle w-25 mx-auto">
                                            <div class="user-detail mt-3 text-center">
                                                <h4 class="mb-3 text-primary">Nesri Mratin</h4>
                                                <i class="mdi mdi-star"></i>
                                                <i class="mdi mdi-star"></i>
                                                <i class="mdi mdi-star"></i>
                                                <i class="mdi mdi-star"></i>
                                                <i class="mdi mdi-star"></i>
                                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                                    Suscipit,
                                                    error!</p>

                                            </div>
                                        </div>

                                    </div>
                                    <!--end testi-box-->
                                </div>
                                <div class="swiper-slide bg-light">
                                    <div class="testi-box p-3 position-relative">
                                        <div class="user-img shadow-sm p-3 bg-white rounded-3">
                                            <img src="{{ asset('frontend/images/landing/img-2.jpg') }}"
                                                alt="doctor" class="img-fluid rounded-circle w-25 mx-auto">
                                            <div class="user-detail mt-3 text-center">
                                                <h4 class="mb-3 text-primary">Jhon Gaurg</h4>
                                                <i class="mdi mdi-star"></i>
                                                <i class="mdi mdi-star"></i>
                                                <i class="mdi mdi-star"></i>
                                                <i class="mdi mdi-star"></i>
                                                <i class="mdi mdi-star"></i>
                                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                                    Suscipit,
                                                    error!</p>

                                            </div>
                                        </div>

                                    </div>
                                    <!--end testi-box-->
                                </div>
                                <div class="swiper-slide bg-light">
                                    <div class="testi-box p-3 position-relative">
                                        <div class="user-img shadow-sm p-3 bg-white rounded-3">
                                            <img src="{{ asset('frontend/images/landing/img-4.jpg') }}"
                                                alt="doctor" class="img-fluid rounded-circle w-25 mx-auto">
                                            <div class="user-detail mt-3 text-center">
                                                <h4 class="mb-3 text-primary">Wiky Moty</h4>
                                                <i class="mdi mdi-star"></i>
                                                <i class="mdi mdi-star"></i>
                                                <i class="mdi mdi-star"></i>
                                                <i class="mdi mdi-star"></i>
                                                <i class="mdi mdi-star"></i>
                                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                                    Suscipit,
                                                    error!</p>

                                            </div>
                                        </div>

                                    </div>
                                    <!-- end testi-box -->
                                </div>
                                <div class="swiper-slide bg-light">
                                    <div class="testi-box p-3 position-relative">
                                        <div class="user-img shadow-sm p-3 bg-white rounded-3">
                                            <img src="{{ asset('frontend/images/landing/img-3.png') }}"
                                                alt="doctor" class="img-fluid rounded-circle w-25 mx-auto">
                                            <div class="user-detail mt-3 text-center">
                                                <h4 class="my-3 text-primary">Jeky Jodh</h4>
                                                <i class="mdi mdi-star"></i>
                                                <i class="mdi mdi-star"></i>
                                                <i class="mdi mdi-star"></i>
                                                <i class="mdi mdi-star"></i>
                                                <i class="mdi mdi-star"></i>
                                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                                    Suscipit,
                                                    error!</p>

                                            </div>
                                        </div>

                                    </div>
                                    <!--end testi-box-->
                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                    <!--end col-->
                </div>


                <!-- row end  -->
            </div>
        </section>
        <!-- testimonial-section end  -->

        <!-- appoiment-section start  -->
        <!-- <section class="section appoiment-section">
        <div class="container">

            <div class="form-part mt-5">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-6">
                        <div class="appoiment-header mb-5">
                            <div class="title-sm">
                                <h4 class="text-success">Appointment</h5>
                            </div>
                            <h1 class="lh-base mt-3">Get Your <span class="text-primary">Appointment</span></h1>
                        </div>
                        <form class="row g-3">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="First name" aria-label="First name" require>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Last name" aria-label="Last name" require>
                            </div>
                            <div class="col-md-6">
                                <input type="email" class="form-control" id="inputEmail4" placeholder="Your Email" require>
                            </div>
                            <div class="col-md-6">
                                <input type="date" class="form-control" placeholder="date" require>
                            </div>
                            <div class="col-md-6">
                                <input type="file" id="myFile" class="form-control" name="filename" require>
                            </div>
                            <div class="col-md-6">
                                <select id="inputState" class="form-select" require>
                                    <option selected>Select Doctor</option>
                                    <option>Dr. Marco Denil</option>
                                    <option>Dr. Morak jhon</option>
                                    <option>Dr. Aenna backer</option>
                                    <option>Dr. Morish Jemsh</option>
                                    <option>Dr. Olivia Nebar</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-4">
                                <h6 class="pt-3">Plese Call Us : <a href="#!" class="text-primary"> +123 465 9012</a></h6>
                            </div>
                            <div class="col-md-6 mt-4">
                                <button type="submit" class="btn btn-primary">Book Doctor Slot</button>
                            </div>
                        </form>

                    </div>
                    <div class="col-lg-5">
                        <img src="https://doctorly.themesbrand.website/build/images/landing/doctor-7.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section> -->

        <!-- appoiment-section end  -->

        <section class="section faq-section pb-3" id="faqs">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="testimonial-header text-center">
                            <div class="title-sm">
                                <h4 class="text-success">How To Contact ?</h5>
                            </div>
                            <h1 class="lh-base mt-3">Frequently Asked<span class="text-primary"> Questions</span>
                            </h1>
                            <p> How does Google protect my privacy and keep my information secure? We know security
                                and
                                privacy are important</p>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center justify-content-between g-3 g-lg-5">
                    <div class="col-lg-6">
                        <h3 class="mb-5 text-muted text-decoration-underline">Most Ask Questions :</h3>
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true"
                                        aria-controls="collapseOne">
                                        What medical expenses are not tax deductible?
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        It is a long established fact that a reader will be distracted by the read
                                        content of page when looking at its layout. The point of using Lorem Ipsum
                                        is
                                        that it has a more-or-less no content here making it look like.

                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                        aria-controls="collapseTwo">
                                        Are dental expenses deductible 2023?
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        It is a long established fact that a reader will be distracted by the read
                                        content of page when looking at its layout. The point of using Lorem Ipsum
                                        is
                                        that it has a more-or-less no content here making it look like.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                        aria-expanded="false" aria-controls="collapseThree">
                                        What is the standard deduction for 2023 for over 65?
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        It is a long established fact that a reader will be distracted by the read
                                        content of page when looking at its layout. The point of using Lorem Ipsum
                                        is
                                        that it has a more-or-less no content here making it look like.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                        aria-expanded="false" aria-controls="collapseFour">
                                        What qualifies as a qualified medical expense?
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        It is a long established fact that a reader will be distracted by the read
                                        content of page when looking at its layout. The point of using Lorem Ipsum
                                        is
                                        that it has a more-or-less no content here making it look like.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                        aria-expanded="false" aria-controls="collapseFive">
                                        How much can you deduct for dental expenses?
                                    </button>
                                </h2>
                                <div id="collapseFive" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        It is a long established fact that a reader will be distracted by the read
                                        content of page when looking at its layout. The point of using Lorem Ipsum
                                        is
                                        that it has a more-or-less no content here making it look like.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <img src="{{ asset('frontend/images/landing/Online Doctor-pana.png') }}" alt=""
                            class="img-fluid">

                    </div>
                </div>
            </div>
        </section>

        <!-- cta-section start  -->
        <section class="section cta-section bg-light pt-5" id="contact">
            <div class="container">
                <!-- row start  -->
                <div class="row align-items-center justify-content-center text-center">
                    <div class="col-lg-7">
                        <div class="cta-header">
                            <h1 class="lh-base mt-3">Health services or tips for <span class="text-primary">
                                    Healthy Living</span>, you can find here</h1>
                            <div class="cta-btn mt-5">
                                <a href="#!" class="btn btn-primary"><i
                                        class="mdi mdi-login-variant me-2"></i>Stay Connected</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- row end  -->
            </div>
        </section>
        <!-- cta-section end  -->

        <!-- footer-section start  -->
        <footer class="section footer-section bg-dark">
            <div class="container">
                <!-- row start  -->
                <div class="row justify-content-between g-2">
                    <div class="col-lg-4">
                        <a class="brand-logo" href="#!">
                            <img src="{{ asset('frontend/images/logo-light.png') }}" alt="" height="22">
                        </a>
                        <p class="mt-4 text-white-50">Doctorly is our country's health insurance program for people age
                            65 or older.</p>
                        <div class="footer-btn mt-4">
                            <h5>Subscribe :</h5>
                            <a href="#!" class="btn btn-light">Subscribe to more</a>
                        </div>
                    </div>


                    <div class="col-lg-2">
                        <h5>Department :</h5>
                        <ul>
                            <li>
                                <a href="#!"><i class="mdi mdi-chevron-right"></i>
                                    Anesthesiologists</a>
                            </li>
                            <li>
                                <a href="#!"><i class="mdi mdi-chevron-right"></i>
                                    Cardiologists </a>
                            </li>
                            <li>
                                <a href="#!"><i class="mdi mdi-chevron-right"></i>
                                    Dermatologists</a>
                            </li>
                            <li>
                                <a href="#!"><i class="mdi mdi-chevron-right"></i>
                                    Ophthalmology</a>
                            </li>
                            <li>
                                <a href="#!"><i class="mdi mdi-chevron-right"></i>
                                    Neurology</a>
                            </li>
                            <li>
                                <a href="#!"><i class="mdi mdi-chevron-right"></i>
                                    Hematology</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-2">
                        <h5>Quick Links :</h5>
                        <ul>
                            <li>
                                <a href="#!"><i class="mdi mdi-chevron-right"></i>
                                    About Us</a>
                            </li>
                            <li>
                                <a href="#!"><i class="mdi mdi-chevron-right"></i>
                                    Contact</a>
                            </li>
                            <li>
                                <a href="#!"><i class="mdi mdi-chevron-right"></i>
                                    Support</a>
                            </li>
                            <li>
                                <a href="#!"><i class="mdi mdi-chevron-right"></i>
                                    Latest Blogs</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-4">
                        <h5>Contact Us :</h5>
                        <ul>
                            <li>
                                <span class="text-white"><span class="mdi mdi-map-marker font-size-18"></span> </span>
                                <a href="#!">New York , Unaited
                                    States</a>
                            </li>
                            <li>
                                <span class="text-white"><span class="mdi mdi-email-outline font-size-18"></span>
                                </span> <a href="#!">supprot12@gmail.com</a>
                            </li>
                            <li>
                                <span class="text-white"><span class="mdi mdi-phone-outline font-size-18"></span>
                                </span> <a href="#!">+125 202 2536</a>
                            </li>
                        </ul>
                        <div class="media-icon">
                            <ul class="list-inline d-flex flex-wrap social m-0">
                                <li class="me-1"><a href="#!" class="social-icon"><i
                                            class="mdi mdi-facebook"></i></a></li>
                                <li class="mx-1"><a href="#!" class="social-icon"><i
                                            class="mdi mdi-twitter"></i></a></li>
                                <li class="mx-1"><a href="#!" class="social-icon"><i
                                            class="mdi mdi-linkedin"></i></a></li>
                                <li class="mx-1"><a href="#!" class="social-icon"><i
                                            class="mdi mdi-google-plus"></i></a></li>
                                <li class="mx-1"><a href="#!" class="social-icon"><i
                                            class="mdi mdi-microsoft-xbox"></i></a></li>
                            </ul>
                        </div>

                    </div>

                </div>
                <!-- row end  -->
            </div>
            <!-- container end  -->
        </footer>
        <!-- footer end  -->

        <!-- footer-copyright start  -->
        <div class="footer-copyright p-4">
            <div class="container">
                <div class="text-center">
                    <p class="text-white m-0">© 2024 . Crafted with by Themesbrand</p>
                </div>
            </div>
        </div>
        <!-- footer-copyright end  -->
    </div>

    <!-- JAVASCRIPT -->
    <!-- JAVASCRIPT -->
    <script src="{{ asset('frontend/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('frontend/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('frontend/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('frontend/libs/toastr/toastr.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('frontend/js/app.min.js') }}"></script>
    <script src="{{ asset('frontend/js/landing.js') }}"></script>
</body>

</html>
