@extends('layouts.web.web')

@section('custom_header')

<title>
    Blogs | Print Ki Dukan
</title>

<meta
    name="description"
    content="Read the latest printing guides, tips, ideas and useful information from Print Ki Dukan.">

<meta
    name="robots"
    content="index,follow">

<link
    rel="canonical"
    href="{{ url('/blogs') }}">

@endsection


@section('content')

<main>

    {{-- =====================================================
        BLOG HERO
    ====================================================== --}}

    <section class="py-5 border-bottom">

        <div class="container">

            <div class="row">

                <div class="col-lg-8 mx-auto text-center">

                    <span
                        class="text-uppercase small fw-semibold text-muted mb-3 blog-label">
                        Print Ki Dukan
                    </span>

                    <h1 class="display-5 fw-bold mt-2 mb-3">
                        Our Blogs
                    </h1>

                    <p class="lead text-muted mb-0">
                        Helpful printing guides, tips, ideas and
                        everything you need to know about printing.
                    </p>

                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
        BLOG LIST
    ====================================================== --}}

    <section class="py-5 document-upload-section">

        <div class="container">

            @if($blogs->count())

            <div class="row g-4">

                @foreach($blogs as $blog)

                <div class="col-lg-4 col-md-6">

                    <article
                        class="card h-100 border-0 shadow-sm">

                        {{-- IMAGE --}}

                        <a
                            href="{{ route('blog', [
                                        'id' => $blog->id,
                                        'slug' => $blog->slug
                                    ]) }}"
                            class="text-decoration-none">

                            @if($blog->image)

                            <img
                                src="{{ asset('uploads/blog/' . $blog->image) }}"
                                alt="{{ $blog->title }}"
                                class="card-img-top blog-list-image"
                                loading="lazy">

                            @else

                            <div
                                class="d-flex align-items-center justify-content-center blog-list-no-image">

                                <span class="text-muted">
                                    No Image
                                </span>

                            </div>

                            @endif

                        </a>


                        <div class="card-body p-4 d-flex flex-column">


                            {{-- DATE --}}

                            @if($blog->published_at)

                            <div
                                class="small text-muted mb-2">
                                {{ $blog->published_at->format('d M Y') }}
                            </div>

                            @endif


                            {{-- TITLE --}}

                            <h2
                                class="h4 mb-3">

                                <a
                                    href="{{ route('blog', [
                                                'id' => $blog->id,
                                                'slug' => $blog->slug
                                            ]) }}"
                                    class="text-dark text-decoration-none">

                                    {{ $blog->title }}

                                </a>

                            </h2>


                            {{-- EXCERPT --}}

                            @if($blog->excerpt)

                            <p
                                class="text-muted mb-4">
                                {{ $blog->excerpt }}
                            </p>

                            @endif


                            {{-- READ MORE --}}

                            <div class="mt-auto">

                                <a
                                    href="{{ route('blog', [
                                                'id' => $blog->id,
                                                'slug' => $blog->slug
                                            ]) }}"
                                    class="btn btn-outline-dark rounded-0">
                                    Read More
                                </a>

                            </div>


                        </div>

                    </article>

                </div>

                @endforeach

            </div>


            {{-- =================================================
                    PAGINATION
                ================================================== --}}

            <div class="d-flex justify-content-center mt-5">

                {{ $blogs->links() }}

            </div>


            @else

            <div class="text-center py-5">

                <h2 class="h4">
                    No blogs available
                </h2>

                <p class="text-muted mb-0">
                    Check back soon for new articles.
                </p>

            </div>

            @endif

        </div>

    </section>

</main>

@endsection