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

$datePublished = $blog->published_at
? $blog->published_at->toIso8601String()
: $blog->created_at->toIso8601String();

$dateModified = $blog->updated_at
? $blog->updated_at->toIso8601String()
: $datePublished;

@endphp


<title>{{ $metaTitle }}</title>

<meta
    name="description"
    content="{{ $metaDescription }}">

<meta
    name="robots"
    content="index,follow,max-image-preview:large">

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

<meta
    property="og:locale"
    content="en_IN">


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

<meta
    property="article:section"
    content="Blog">

<meta
    property="article:published_time"
    content="{{ $datePublished }}">

<meta
    property="article:modified_time"
    content="{{ $dateModified }}">


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
    BLOG POST SCHEMA
====================================================== --}}

<script type="application/ld+json">
    {
        !!json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'BlogPosting',

            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => $canonicalUrl
            ],

            'headline' => $blog - > title,

            'description' => $metaDescription,

            'image' => [
                $ogImageUrl
            ],

            'datePublished' => $datePublished,

            'dateModified' => $dateModified,

            'author' => [
                '@type' => 'Organization',
                'name' => 'Print Ki Dukan',
                'url' => url('/')
            ],

            'publisher' => [
                '@type' => 'Organization',
                'name' => 'Print Ki Dukan',
                'url' => url('/'),
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => asset('web_assets/images/logo.png')
                ]
            ],

            'isPartOf' => [
                '@type' => 'Blog',
                'name' => 'Print Ki Dukan Blog',
                'url' => route('blogs')
            ],

            'inLanguage' => 'en-IN'
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

    <article class="document-upload-section">

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
                            width="669"
                            height="353"
                            fetchpriority="high"
                            decoding="async">

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


@endsection