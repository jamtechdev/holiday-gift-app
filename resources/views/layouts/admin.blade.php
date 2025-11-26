@extends('layouts.app')

@section('content')
<div class="admin-layout">
    @include('partials.admin.sidebar')
    
    <main class="main-content">
        @include('partials.admin.navbar')
        
        @yield('admin-content')
    </main>
</div>
@endsection