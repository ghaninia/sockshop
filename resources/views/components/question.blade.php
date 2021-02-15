<div class="section questions" id="questions">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="information">
                    <h1>{{ options('title') }}</h1>
                    <p>{{ options('description') }}</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="accordion-container">
                    @foreach($questions as $question)
                    <div class="set {{ !$loop->index ? 'active' : null }}">
                        <div class="title waves-effect waves-dark">
                            @if(isset($question['title']))
                                {{ $question['title'] }}
                            @endif
                        </div>
                        <div class="content">
                            <p>
                            @if(isset($question['description']))
                                {{ $question['description'] }}
                            @endif
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
