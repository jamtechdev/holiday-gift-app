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
/* 1. Base Setup */
.flip-container {
  perspective: 1000px;
  width: 260px; /* Set the size of the visible image */
  height: 280px;
  margin: 0 auto;
  position: relative;
  /* Add margin to see the animation on the page */
}

/* 2. Flipper Container (Handles the animation) */
.flipper {
  position: absolute;
  width: 100%;
  height: 100%;
  /* The core animation */
  animation: center-flip 4s ease-in-out forwards;
  /* Enable 3D space for children */
  transform-style: preserve-3d;
}

/* 3. Image Styling */
.front {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  /* Crucial: Hides the back of the image during the 3D flip */
  /* backface-visibility: hidden; */
}

/* 4. Keyframes for the combined animation */
@keyframes center-flip {
  /* Start: Off-screen top */
  0% {
    transform: translateY(-100vh) rotateY(0deg);
    opacity: 0;
  }

  /* Midpoint: Image is in the center, before the flip starts */
  50% {
    transform: translateY(0) rotateY(0deg);
    opacity: 0.8;
  }

  /* End: Image is centered and flipped 180 degrees (e.g., around Y-axis) */
  100% {
    transform: translateY(0) rotateY(360deg);
    opacity: 1;
  }
}

.shine {
  position: relative;
  /* overflow: hidden; */
}
.shine::before {
  background: linear-gradient(to right, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.3) 100%);
  content: "";
  display: block;
  height: 100%;
  left: -75%;
  position: absolute;
  top: 0;
  transform: skewX(-25deg);
  width: 50%;
  z-index: 2;
}
.shine:hover::before, .shine:focus::before {
  -webkit-animation: shine 0.85s;
          animation: shine 0.85s;
}
@-webkit-keyframes shine {
  100% {
    left: 125%;
  }
}
@keyframes shine {
  100% {
    left: 125%;
  }
}
.Donation {
    max-width: 120px;
    position: absolute;
    top: -62px;
    height: auto !important;
    left: 41px;
}
.boxes a:first-child .flipper span {
    top: -100px;
    font-size: 26px;
    color: #fff;
    left: -76px;
    text-transform: uppercase;
}
.boxes a:nth-child(2) .flipper img.Donation{
    -moz-transform: scaleY(-1);
    -o-transform: scaleY(-1);
    -webkit-transform: scaleY(-1);
    transform: scaleY(-1);
    filter: FlipV;
    -ms-filter: "FlipV";
    -moz-transform: scale(-1, -1);
    -o-transform: scale(-1, -1);
    -webkit-transform: scale(-1, -1);
    transform: scale(-1, -1);
    right: 47px;
    left: auto;
    top: auto;
    bottom: -65px;
}
.boxes a:nth-child(2) .flipper span {
    top: auto;
    font-size: 26px;
    color: #fff;
    left: 73px;
    bottom: -101px;
    text-transform: uppercase;
}
.boxes a:last-child .flipper span {
    top: -100px;
    font-size: 26px;
    color: #fff;
    left: 52px;
    text-transform: uppercase;
}
.boxes a:last-child .flipper img.Donation {
    -moz-transform: scaleX(-1);
    -o-transform: scaleX(-1);
    -webkit-transform: scaleX(-1);
    transform: scaleX(-1);
    filter: FlipH;
    -ms-filter: "FlipH";
    left: auto;
    right: 53px;
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
                  <div class="flip-container">
                    <div class="flipper">   
                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="category-image" />
                        <span class="category-name">{{ $category->name }}</span>
                        <img src="{{ asset('images/arrow.png') }}" class="Donation" /> 
                    </div>
                  </div>  
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


