@if (count($errors) > 0)
    @foreach($errors->all() as $error)
    <div class="row">
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Error!</h4>
            {{ $error }}
        </div>
    </div>
    @endforeach
@elseif ( session()->has('status'))
    <div class="row">
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Success!</h4>
            {{ session()->get('status')}}
        </div>
    </div>
@elseif ( session()->has('warning'))
<div class="row">
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Warning!</h4>
            {{ session()->get('warning')}}
        </div>
    </div>
@else
<div class="row"></div>
@endif
