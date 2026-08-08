@extends('layouts.web.web')

@section('content')
<section class="utf_block_wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <h3>Contact Us</h3>
                <form method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control form-control-name" name="name" id="name" placeholder="Name" type="text" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control form-control-email" name="email" id="email" placeholder="Email" type="email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone</label>
                                <input class="form-control form-control-phone" name="phone" id="phone" placeholder="Phone" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Subject</label>
                                <input class="form-control form-control-subject" name="subject" id="subject" placeholder="Subject" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea style="height: 100px;" class="form-control form-control-message" name="message" id="message" placeholder="Message..." rows="10" required></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary solid blank" type="submit">Send Message</button>
                    </div>
                </form>
            </div>
            @include('sidebar')
        </div>
    </div>
</section>
@endsection