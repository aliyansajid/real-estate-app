@extends('layouts.app')

@section('title', 'Contact Us')

@section('breadcrumb_title', 'Contact Us')

@section('content')
<section class="wrap__contact-form">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <h5>Contact Us</h5>
                <form method="POST" action="{{ route('contact.send') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-group-name">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" placeholder="John Doe" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-name">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" placeholder="john@gmail.com" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-group-name">
                                <label>Subject</span></label>
                                <input type="text" class="form-control" name="subject" placeholder="Enter the subject" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Message</label>
                                <textarea class="form-control" rows="9" placeholder="Enter your message" name="message"></textarea>
                            </div>
                            <div class="form-group float-right mb-0">
                                <button type="submit" class="btn btn-primary btn-contact">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <div class="wrap__contact-open-hours">
                    <h5 class="text-capitalize">Open Hours</h5>
                    <ul class="list-unstyled">
                        <li class="d-flex align-items-center justify-content-between">
                            <span>Monday - Friday</span>
                            <span>09 AM - 05 PM</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-between">
                            <span>Saturday</span> <span>Closed</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-between">
                            <span>Sunday</span>
                            <span>Closed</span>
                        </li>
                    </ul>
                </div>

                <h5>Info Location</h5>
                <div class="wrap__contact-form-office">
                    <ul class="list-unstyled">
                        <li>
                            <span><i class="fa fa-home"></i></span>
                            GT Road, Quaid Avenue, Wah Cantt, Rawalpindi, Punjab
                        </li>
                        <li>
                            <span>
                                <i class="fa fa-phone"></i>
                                <a href="tel:+923303720100">+92 330 1234567</a>
                            </span>
                        </li>
                        <li>
                            <span>
                                <i class="fa fa-envelope"></i>
                                <a href="mailto:aliyansajid127@gmail.com">aliyansajid127@gmail.com</a>
                            </span>
                        </li>
                    </ul>

                    <div class="social__media">
                        <h5>Find Us</h5>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="#" class="btn btn-social rounded text-white facebook">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="btn btn-social rounded text-white twitter">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="btn btn-social rounded text-white whatsapp">
                                    <i class="fa fa-whatsapp"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="btn btn-social rounded text-white telegram">
                                    <i class="fa fa-telegram"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="btn btn-social rounded text-white linkedin">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
