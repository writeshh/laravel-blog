@if ($_SERVER['REQUEST_URI'] == "/")
<!-- Header Banner For Home -->
<div class="home">
    <div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="{{asset('img/index.jpg')}}" data-speed="0.8"></div>
    <div class="home_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="home_content text-center">
                        <div class="home_title">Search For Post</div>
                        <div class="post_search">
                            <div class="post_search_background"></div>
                            <form action="/search" class="post_search_form" id="post_search_form" role="search">
                                <input type="text" class="post_search_input" name="query" placeholder="Enter Post Name" required="required">
                                <button class="post_search_button">search</button>
                            </form>
                        </div>
                        <div class="btn-group mt-5">
                            <a href="/login" class="btn btn-outline-primary btn-lg mr-1">Login</a>
                            <a href="/register" class="btn btn-outline-secondary btn-lg">Register</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@else
<!-- Header Banner For Other Pages -->
<div class="page">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="page_content">
                    <div class="page_image"><img src="{{asset('img/about_page.png')}}" alt=""></div>
                    <div class="page_title">
                        @if (!empty($title))
                            {{ $title }}
                        @elseif ($_SERVER['REQUEST_URI'] == "/password/reset")
                            {{'Reset Password'}}
                        @else
                            {{ 'No title' }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
