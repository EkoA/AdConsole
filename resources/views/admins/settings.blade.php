@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Settings</div>

                <div class="panel-body">

                <table class="table table-hover table-responsive">
                  <caption>Current Settings</caption>
                  <tr><td>Cost per impression</td><td>Minimum Cost per ad</tr>
                  @foreach($settings as $set)
                          <tr><td>&nbsp; &#8358;{{$set->cost_imp}}&nbsp;&nbsp;</td><td>&nbsp; &#8358;{{$set->min_cost}}&nbsp;</td></tr>
                </table>

                <hr>

                <form class="form-horizontal" role="form" method="POST" action="{{ route('settings.store') }}">
                  {{ csrf_field() }}
                  {{ method_field('PUT') }}

                  <div class="form-group{{ $errors->has('min_cost') ? ' has-error' : '' }}">
                          <label for="min_cost" class="col-md-4 control-label">Minimum Cost (&#8358;):</label>

                          <div class="col-md-6">
                              <input id="min_cost" type="number" class="form-control" name="min_cost" value="{{$set->min_cost}}" min="1.00" required>
                              @if ($errors->has('min_cost'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('min_cost') }}</strong>
                                  </span>
                              @endif
                          </div>
                  </div>

                  <div class="form-group{{ $errors->has('cost_imp') ? ' has-error' : '' }}">
                          <label for="cost_imp" class="col-md-4 control-label">Cost per impression (&#8358;):</label>

                          <div class="col-md-6">
                              <input id="cost_imp" type="number" class="form-control" name="cost_imp" value="{{$set->cost_imp}}" min="1.00" required>
                              @if ($errors->has('cost_imp'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('cost_imp') }}</strong>
                                  </span>
                              @endif
                          </div>
                  </div>
                  @endforeach
                  <div class="form-group">
                      <div class="col-md-6 col-md-offset-4">
                          <button type="submit" class="btn btn-primary">
                              <i class="fa fa-btn fa-user"></i> Set
                          </button>
                      </div>
                  </div>
                </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
