@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-10">

            @if (Session::has('success'))

            <div class="alert alert-success alert-dismissible fade show">

                {{ Session::get('success') }}

                <button
                    type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            @endif


            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">

                    <span>
                        Contact Message
                    </span>

                    <a
                        href="{{ route('admin.contact') }}"
                        class="btn btn-sm btn-secondary">

                        Back

                    </a>

                </div>


                <div class="card-body">


                    {{-- NAME --}}

                    <div class="form-group">

                        <label class="font-weight-bold">
                            Name
                        </label>

                        <div class="form-control bg-light">
                            {{ $contact->name }}
                        </div>

                    </div>


                    {{-- EMAIL --}}

                    <div class="form-group">

                        <label class="font-weight-bold">
                            Email
                        </label>

                        <div class="form-control bg-light">

                            <a href="mailto:{{ $contact->email }}">

                                {{ $contact->email }}

                            </a>

                        </div>

                    </div>


                    {{-- MOBILE --}}

                    <div class="form-group">

                        <label class="font-weight-bold">
                            Mobile
                        </label>

                        <div class="form-control bg-light">

                            @if($contact->mobile)

                            <a href="tel:{{ $contact->mobile }}">

                                {{ $contact->mobile }}

                            </a>

                            @else

                            <span class="text-muted">
                                Not provided
                            </span>

                            @endif

                        </div>

                    </div>


                    {{-- SUBJECT --}}

                    <div class="form-group">

                        <label class="font-weight-bold">
                            Subject
                        </label>

                        <div class="form-control bg-light">

                            {{ $contact->subject ?: 'No subject' }}

                        </div>

                    </div>


                    {{-- MESSAGE --}}

                    <div class="form-group">

                        <label class="font-weight-bold">
                            Message
                        </label>

                        <div
                            class="form-control bg-light"
                            style="
                                min-height:150px;
                                height:auto;
                                white-space:pre-wrap;
                            ">

                            {{ $contact->message }}

                        </div>

                    </div>


                    <div class="row">


                        {{-- DATE --}}

                        <div class="col-md-6">

                            <div class="form-group">

                                <label class="font-weight-bold">
                                    Received At
                                </label>

                                <div class="form-control bg-light">

                                    {{ $contact->created_at->format('d M Y h:i A') }}

                                </div>

                            </div>

                        </div>


                        {{-- IP --}}

                        <div class="col-md-6">

                            <div class="form-group">

                                <label class="font-weight-bold">
                                    IP Address
                                </label>

                                <div class="form-control bg-light">

                                    {{ $contact->ip_address ?: 'Not available' }}

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- STATUS --}}

                    <div class="form-group">

                        <label class="font-weight-bold">
                            Status
                        </label>

                        <div>

                            @if($contact->is_read)

                            <span class="badge badge-success">
                                Read
                            </span>

                            @else

                            <span class="badge badge-warning">
                                Unread
                            </span>

                            @endif

                        </div>

                    </div>


                    {{-- MARK AS READ --}}

                    @if(!$contact->is_read)

                    <form
                        method="POST"
                        action="{{ route('admin.contact.read', $contact->id) }}">

                        @csrf

                        <button
                            type="submit"
                            class="btn btn-primary">

                            <i class="fas fa-check"></i>

                            Mark as Read

                        </button>

                    </form>

                    @endif


                </div>

            </div>

        </div>

    </div>

</div>

@endsection