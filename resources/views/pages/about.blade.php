@extends('layouts.app')

@section('banner-heading')
    <header class="intro-header" style="background-image: url({{asset('img/about-page.jpg')}})">
        <div class="container">
            <div class="row">
                <div class=" col-md-11 col-md-offset-1">
                    <div class="site-heading">
                        <h1>About Us</h1>

                        <hr class="small">

                        <span class="subheading">Where people post opinions about current or future tech</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 col-md-10 col-md-offset-1">
                <div class="post-panel">
                    <h2 class="title">Passion, Motivation, Perseverance</h2>
                    <p class="about-us">
                        Vaporware skateboard fingerstache man bun, shoreditch put a bird on it microdosing bushwick VHS you probably haven't heard of them semiotics meditation drinking vinegar. Brunch hashtag migas poutine, VHS everyday carry put a bird on it deep v fam tousled crucifix.
                    </p>
                    <p class="about-us">
                         Hella la croix chambray, marfa raw denim roof party gentrify wayfarers next level occupy try-hard. Bicycle rights lo-fi jianbing waistcoat, gentrify tattooed tumeric cray letterpress PBR&B. Raclette blog poke, austin lumbersexual swag viral brunch pickled DIY iceland. Dreamcatcher lomo adaptogen, church-key gochujang venmo tilde copper mug. Leggings actually salvia neutra keffiyeh gentrify try-hard crucifix green juice. 
                    </p>
                    <p class="about-us">
                         Forage portland cloud bread messenger bag chicharrones authentic pabst activated charcoal actually 90's raw denim heirloom microdosing. Jianbing 90's raclette meggings cronut jean shorts shabby chic cold-pressed irony trust fund wolf cred knausgaard. 
                    </p>

 
                    <hr>
                </div>
            </div>
        </div>
    </div>
@endsection