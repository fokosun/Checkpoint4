<div class="row">
    <div class="col-md-12 outro">
        <div class="text-center spacer">
            <h3>Categories</h3>
        </div>
        @if(count($categories) > 0)
        @foreach($categories as $category)
        <div class="col-lg-3 col-xs-9">
            <div class="inner text-lowercase">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ $category->title }}</h3>
                    </div>
                    <div class="box-body">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>150</h3>

              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>

                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>
