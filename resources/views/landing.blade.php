@extends('layouts.landing')

@section('content')

    {{-- 1. Hero Section --}}
    <section id="home" class="relative w-full overflow-hidden">
        @include("themes.$theme.hero")
    </section>

    {{-- 2. Navbar Sticky --}}
    <div class="sticky top-0 z-40 w-full">
        @include("themes.$theme.navbar")
    </div>

    {{-- 3. Profil Anak --}}
    <section id="mempelai" class="py-20 md:py-32 bg-slate-50 overflow-hidden scroll-mt-24">
        <div data-aos="fade-up" data-aos-duration="1000">
            @include("themes.$theme.profile")
        </div>
    </section>

    {{-- 4. Informasi Acara --}}
    <section id="acara" class="py-20 md:py-32 bg-white overflow-hidden scroll-mt-24">
        <div data-aos="fade-up" data-aos-duration="1000">
            @include("themes.$theme.info")
        </div>
    </section>

    {{-- 5. Acara Hiburan --}}
    <section id="entertainment" class="py-20 bg-slate-50 overflow-hidden scroll-mt-24">
        <div data-aos="fade-up">
            @include("themes.$theme.entertainment")
        </div>
    </section>

    {{-- 6. Galeri --}}
    <section id="galeri" class="py-20 bg-white overflow-hidden scroll-mt-24">
        <div data-aos="fade-up">
            @include("themes.$theme.gallery")
        </div>
    </section>

    {{-- 7. RSVP --}}
    <section id="rsvp" class="py-20 bg-slate-50 overflow-hidden scroll-mt-24">
        <div data-aos="fade-up">
            @include("themes.$theme.rsvp")
        </div>
    </section>

    {{-- 8. Gifts / Amplop --}}
    <section id="gifts" class="py-20 bg-white overflow-hidden scroll-mt-24">
        <div data-aos="fade-up">
            @include("themes.$theme.gifts")
        </div>
    </section>

    {{-- 9. Footer --}}
    <footer class="bg-slate-900 text-white pt-20 pb-10">
        @include("themes.$theme.footer")
    </footer>

@endsection
