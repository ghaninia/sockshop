<div class="container">
    <div class="section features" id="features" tabindex="-1">
        @foreach($features as $feature)
        <div class="feature {{ !$loop->index ? 'active' : null }}">
            <i class="{{ $feature['icon'] }}"></i>
            <div>
                <h1>{{ $feature['title'] }}</h1>
                <p>{{ $feature['description'] }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
