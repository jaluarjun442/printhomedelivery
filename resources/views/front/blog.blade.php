@extends('layouts.web.web')

@section('custom_header')

@php
$metaTitle = $blog->meta_title ?: $blog->title;

$metaDescription = $blog->meta_description
?: $blog->excerpt
?: \Illuminate\Support\Str::limit(
trim(strip_tags($blog->content)),
155
);

$ogTitle = $blog->og_title ?: $metaTitle;

$ogDescription = $blog->og_description ?: $metaDescription;

$ogImage = $blog->og_image ?: $blog->image;

$ogImageUrl = $ogImage
? asset('uploads/blog/' . $ogImage)
: asset('web_assets/images/logo.png');

$canonicalUrl = route('blog', [
'id' => $blog->id,
'slug' => $blog->slug
]);
@endphp


<title>{{ $metaTitle }}</title>

<meta
    name="description"
    content="{{ $metaDescription }}">

<meta
    name="robots"
    content="index,follow">

<link
    rel="canonical"
    href="{{ $canonicalUrl }}">


{{-- =====================================================
        OPEN GRAPH
    ====================================================== --}}

<meta
    property="og:type"
    content="article">

<meta
    property="og:title"
    content="{{ $ogTitle }}">

<meta
    property="og:description"
    content="{{ $ogDescription }}">

<meta
    property="og:url"
    content="{{ $canonicalUrl }}">

<meta
    property="og:image"
    content="{{ $ogImageUrl }}">

<meta
    property="og:site_name"
    content="Print Ki Dukan">


{{-- =====================================================
        TWITTER CARD
    ====================================================== --}}

<meta
    name="twitter:card"
    content="summary_large_image">

<meta
    name="twitter:title"
    content="{{ $ogTitle }}">

<meta
    name="twitter:description"
    content="{{ $ogDescription }}">

<meta
    name="twitter:image"
    content="{{ $ogImageUrl }}">


{{-- =====================================================
        ARTICLE META
    ====================================================== --}}

@if($blog->published_at)

<meta
    property="article:published_time"
    content="{{ $blog->published_at->toIso8601String() }}">

@endif


<meta
    property="article:section"
    content="Blog">


{{-- =====================================================
        BREADCRUMB SCHEMA
    ====================================================== --}}

<script type="application/ld+json">
    {
        !!json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                [
                    '@type' => 'ListItem',
                    'position' => 1,
                    'name' => 'Home',
                    'item' => url('/')
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 2,
                    'name' => 'Blogs',
                    'item' => route('blogs')
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 3,
                    'name' => $blog - > title,
                    'item' => $canonicalUrl
                ]
            ]
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!
    }
</script>


{{-- =====================================================
        ARTICLE SCHEMA
    ====================================================== --}}

<script type="application/ld+json">
    {
        !!json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Article',

            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => $canonicalUrl
            ],

            'headline' => $blog - > title,

            'description' => $metaDescription,

            'image' => [
                $ogImageUrl
            ],

            'datePublished' => $blog - > published_at ?
            $blog - > published_at - > toIso8601String() :
            $blog - > created_at - > toIso8601String(),

            'dateModified' => $blog - > updated_at -
            >
            toIso8601String(),

            'author' => [
                '@type' => 'Organization',
                'name' => 'Print Ki Dukan',
                'url' => url('/')
            ],

            'publisher' => [
                '@type' => 'Organization',
                'name' => 'Print Ki Dukan',
                'url' => url('/')
            ]
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!
    }
</script>

@endsection


@section('content')

<main>

    {{-- =====================================================
        BREADCRUMB
    ====================================================== --}}

    <section class="border-bottom">

        <div class="container py-3">

            <nav aria-label="breadcrumb">

                <ol class="breadcrumb mb-0">

                    <li class="breadcrumb-item">

                        <a href="{{ url('/') }}">
                            Home
                        </a>

                    </li>

                    <li class="breadcrumb-item">

                        <a href="{{ route('blogs') }}">
                            Blogs
                        </a>

                    </li>

                    <li
                        class="breadcrumb-item active"
                        aria-current="page">
                        {{ $blog->title }}
                    </li>

                </ol>

            </nav>

        </div>

    </section>


    {{-- =====================================================
        ARTICLE
    ====================================================== --}}

    <article>

        <div class="container py-5">

            <div class="row justify-content-center">

                <div class="col-xl-9 col-lg-10">


                    {{-- CATEGORY / LABEL --}}

                    <div
                        class="text-uppercase small fw-semibold text-muted mb-3"
                        style="letter-spacing:2px;">
                        Print Ki Dukan
                    </div>


                    {{-- H1 --}}

                    <h1
                        class="display-4 fw-bold mb-3">
                        {{ $blog->title }}
                    </h1>


                    {{-- DATE --}}

                    @if($blog->published_at)

                    <div class="text-muted mb-4">

                        Published on
                        <time
                            datetime="{{ $blog->published_at->toIso8601String() }}">
                            {{ $blog->published_at->format('d M Y') }}
                        </time>

                    </div>

                    @endif


                    {{-- FEATURED IMAGE --}}

                    @if($blog->image)

                    <figure class="mb-5">

                        <img
                            src="{{ asset('uploads/blog/' . $blog->image) }}"
                            alt="{{ $blog->title }}"
                            class="img-fluid w-100"
                            width="1200"
                            height="630"
                            fetchpriority="high">

                    </figure>

                    @endif


                    {{-- EXCERPT --}}

                    @if($blog->excerpt)

                    <div class="mb-4">

                        <p
                            class="lead fw-medium">
                            {{ $blog->excerpt }}
                        </p>

                    </div>

                    @endif


                    {{-- BLOG CONTENT --}}

                    <div class="blog-content">

                        {!! $blog->content !!}

                    </div>


                    {{-- BACK TO BLOGS --}}

                    <div class="mt-5 pt-4 border-top">

                        <a
                            href="{{ route('blogs') }}"
                            class="btn btn-outline-dark rounded-0">
                            ← Back to Blogs
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </article>

</main>


<style>
    .blog-content {
        font-size: 18px;
        line-height: 1.85;
        color: #222;
    }

    .blog-content h2 {
        font-size: 30px;
        line-height: 1.3;
        margin-top: 42px;
        margin-bottom: 18px;
        font-weight: 700;
    }

    .blog-content h3 {
        font-size: 24px;
        line-height: 1.4;
        margin-top: 32px;
        margin-bottom: 14px;
        font-weight: 700;
    }

    .blog-content p {
        margin-bottom: 20px;
    }

    .blog-content img {
        max-width: 100%;
        height: auto;
        margin: 25px 0;
    }

    .blog-content ul,
    .blog-content ol {
        margin-bottom: 22px;
        padding-left: 25px;
    }

    .blog-content li {
        margin-bottom: 8px;
    }

    .blog-content a {
        text-decoration: underline;
    }

    @media (max-width: 767px) {

        .blog-content {
            font-size: 16px;
            line-height: 1.75;
        }

        .blog-content h2 {
            font-size: 25px;
        }

        .blog-content h3 {
            font-size: 21px;
        }

    }
</style>

@endsection