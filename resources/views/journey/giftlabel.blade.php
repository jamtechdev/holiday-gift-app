@extends('layouts.journey')

@section('title', 'Gift Categories')

@section('journey-content')
<style>
.journey-page {
    padding: 0px;
}
.gift-container {
    width: 100%;
    height: 100vh;
    max-width: 1140px;
    margin: 0px auto;
    position: relative;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: right;
}
img.overlayPuzzle {
    width: 100%;
    height: 100%;
    position: absolute;
    z-index: 99;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
}
.logoBox {
    padding-top: 44px;
}
.logoBox img{
    margin: auto;
}
.logoBox {
    text-align: center;
}
.boxes {
    gap: 10px;
    display: flex;
    justify-content: center;
    margin-top: 69px;
    flex-wrap: wrap;
}
.boxes a {
    position: relative;
    width: 280px;
    height: 280px;
    margin: 10px;
    text-align: center;
    text-decoration: none;
}
.boxes a .category-image {
    width: 100%;
    height: 100%;
    object-fit: contain;
}
.boxes a .category-name {
    position: absolute;
    left: 0;
    right: 0;
    bottom: 10px;
    color: #dcd08f;
    font-weight: 600;
    font-size: 18px;
}
.giftBox {
    position: relative;
    z-index: 99;
}
</style>

<div class="gift-container" style="background-image: url('{{ asset('images/center.png') }}');">
    <img src="{{ asset('images/overlayPuzzle.png') }}" class="overlayPuzzle" />

    <div class="giftBox">
        <div class="logoBox">
           <img src="{{ asset('images/logo-golden.png') }}" class="logo" />
        </div>

        <div class="boxes">
            @foreach($categories as $category)
                <a href="{{ route('user.gifts.byCategory', $category) }}" class="category-link" data-category="{{ $category->name }}">
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="category-image" />
                    <span class="category-name">{{ $category->name }}</span>
                </a>
            @endforeach
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const categoryLinks = document.querySelectorAll('.category-link');
    
    categoryLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const categoryName = this.getAttribute('data-category');
            if (typeof toastr !== 'undefined') {
                toastr.success('Loading ' + categoryName + ' gifts...');
            }
        });
    });
});
</script>

@endsection


