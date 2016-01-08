<div class="row">
    <div class="col-md-12 outro">
        <div class="text-center spacer">
            <h3>learning at teachademia</h3>
        </div>
       @if(count($categories) > 0)
        @foreach($categories as $category)
        <div class="col-lg-3 col-xs-6">
            <div class="inner text-lowercase">
            {{ $category->title }}
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>
