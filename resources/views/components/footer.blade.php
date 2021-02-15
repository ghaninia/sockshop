<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="copyright">
                    {{ options('copyright') }}
                </div>
            </div>
            <div class="col-lg-6">
                <div class="social-icons">
                    @if(!! options('support_facebook'))
                    <a href="{{ options('support_facebook') }}"><span class="feather-facebook"></span></a>
                    @endif
                    @if(!! options('support_twitter'))
                    <a href="{{ options('support_twitter') }}"><span class="feather-twitter"></span></a>
                    @endif
                    @if(!! options('support_instagram'))
                    <a href="{{ options('support_instagram') }}"><span class="feather-instagram"></span></a>
                    @endif
                    @if(!! options('support_telegram'))
                    <a href="{{ options('support_telegram') }}"><span class="feather-send"></span></a>
                    @endif
                    @if(!! options('support_email'))
                    <a href="mailto:{{ options('support_email') }}"><span class="feather-mail"></span></a>
                    @endif
                    <a href="{{ route('guest.sitemap') }}"><span class="feather-rss"></span></a>
                </div>
            </div>
        </div>
    </div>
</footer>
