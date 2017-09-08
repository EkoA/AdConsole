@extends('layouts.app')

@section('content')
<div class="clearfix"></div>
<br/><br/><br/><br/><br/><br/><br/><br/><br/>

      <div class="container">
        <div class="row">
          <div class="col-md-10 col-md-offset-1">
            <div class="contact-us">
              <div class="row">

            @if (Auth::guest())
            @else
              @include('layouts.menu')
            @endif

            <div class="col-md-8 col-sm-7 wallet">
                <h4 class="wallet-head" style="color: #fff; font-weight: bold;" align="center">Create an Ad</h4><br/>

                  @if(!empty($result))
                    <center><p>{{$result}}</p></center>
                  @endif

                  <center><h3>Wallet Balance: <span style="color: #8dc63f; font-weight: bold;">&#8358;{{ Auth::user()->balance }}</span></h3></center>
                  <hr>
                  <form class="contact-form" role="form" method="POST" action="{{ route('ads.store') }}" enctype="multipart/form-data">
                      {{ csrf_field() }}

                    <div class="form-group">
                      <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                          <div class="col-md-2"> Image: </div>
                                <div class="col-md-10"><input type="file" name="image" accept="image/*" id="file" class="required bg-button" style="width:100%" onClick="checker()" multiple required></div>
                                <br>
                                <span id="erry" style="color:red;"></span>
                                <span id="err" style="color:red;"></span>
                              @if ($errors->has('image'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('image') }}</strong>
                                  </span>
                              @endif
                      </div>
                    </div><br/><br/>

                      <script type="text/javascript">
                            //alert("here");
                            function checker()
                            {
                              var _URL = window.URL || window.webkitURL;

                              $("#file").change(function(e) {
                                  var file, img;
                                  //var count = 0;
                                  if ((file = this.files[0])) {
                                      img = new Image();
                                      img.onload = function() {
                                          if(Math.round(file.size/1024) > 2300)
                                          {
                                            //alert(Math.round(file.size/1024)*2400);
                                            document.getElementById('err').innerHTML ="<p style='color:red;'>Please select an image that is not more than 2MB</p>";
                                            document.getElementById('subo').innerHTML = "<p></p>";
                                          }

                                          if(this.width != this.height)
                                          {
                                            document.getElementById('erry').innerHTML ="<p style='color:red;'>Please select an image that is a perfect square</p>";
                                            document.getElementById('err').innerHTML ="<p></p>";
                                            document.getElementById('subo').innerHTML = "<p></p>";
                                          }
                                          else
                                          {
                                            document.getElementById('erry').innerHTML ="<p></p>";
                                            document.getElementById('err').innerHTML ="<p></p>";
                                            document.getElementById('subo').innerHTML = "<button type='submit' class='btn btn-primary'><i class='fa fa-btn fa-user'></i> Create </button>";
                                          }

                                          if(Math.round(file.size/1024) <= 2300 && this.width == this.height)
                                          {
                                            document.getElementById('subo').innerHTML = "<button type='submit' class='btn btn-primary'><i class='fa fa-btn fa-user'></i> Create </button>";
                                            document.getElementById('subo').innerHTML = "<button type='submit' class='btn btn-primary'><i class='fa fa-btn fa-user'></i> Create </button>";
                                            document.getElementById('erry').innerHTML ="<p></p>";
                                            document.getElementById('err').innerHTML ="<p></p>";
                                          }
                                      };
                                      img.onerror = function() {
                                          alert("This is not a valid file: " + file.type);
                                      };
                                      img.src = _URL.createObjectURL(file);
                                  }
                              });
                            }
                        </script>

                      <div class="form-group">
                      <div class="col-md-2"> Caption: </div>
                          <div class="col-md-10"><textarea id="caption" class="form-control" name="caption" placeholder="Caption for Advert" maxlength="200" required></textarea></div>
                              @if ($errors->has('caption'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('caption') }}</strong>
                                  </span>
                              @endif
                      </div><br><br/><br>

                      <div class="form-group">
                          <div class="col-md-2"> Start Date: </div>
                          <?php
                              $dat = date("Y-m-d");
                          ?>
                          <div class="col-md-10">
                              <input id="start_date" type="date" class="form-control" name="start_date" value="{{ old('start_date') }}" min="<?php echo $dat; ?>" required>
                          </div>    

                              @if ($errors->has('start_date'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('start_date') }}</strong>
                                  </span>
                              @endif
                          
                      </div><br><br/>

                      <div class="form-group">
                          <div class="col-md-2"> End Date: </div>
                          <?php
                              $dat = date("Y-m-d");
                          ?>
                          
                              <div class="col-md-10"><input id="end_date" type="date" class="form-control" name="end_date" value="{{ old('end_date') }}" min="<?php echo $dat; ?>" required></div>

                              @if ($errors->has('end_date'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('end_date') }}</strong>
                                  </span>
                              @endif
                      </div><br/><br/>

                      <!--<div class="form-group{{ $errors->has('priority') ? ' has-error' : '' }}">
                              <label for="priority" class="col-md-4 control-label">Priority</label>

                              <div class="col-md-6">
                                <select class="form-control" name ="priority" id="priority" >
                                    <option value="High">High Priority (&#8358;{{$cost->reg_high}}/impression)</option>
                                    <option value="Medium">Medium Priority (&#8358;{{$cost->reg_med}}/impression)</option>
                                    <option value="Low">Low Priority (&#8358;{{$cost->reg_low}}/impression)</option>
                                </select>

                                  @if ($errors->has('priority'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('priority') }}</strong>
                                      </span>
                                  @endif
                              </div>
                      </div>-->

                    <div class="form-group">
                     <div class="col-md-2"> Coverage Areas: </div>
                      <div class="col-md-10">
                              <div class="col-md-4"><input type="checkbox" name="location[]" value="Abia">Abia</div>
                              <div class="col-md-4"><input type="checkbox" name="location[]" value="Adamawa">Adamawa</div>
                              <div class="col-md-4"><input type="checkbox" name="location[]" value="Anambra">Anambra</div>
                              <div class="col-md-4"><input type="checkbox" name="location[]" value="Akwa Ibom">Akwa Ibom</div>
                              <div class="col-md-4"><input type="checkbox" name="location[]" value="Bauchi">Bauchi</div>
                              <div class="col-md-4"><input type="checkbox" name="location[]" value="Bayelsa">Bayelsa</div>
                              <div class="col-md-4"><input type="checkbox" name="location[]" value="Benue">Benue</div>
                              <div class="col-md-4"><input type="checkbox" name="location[]" value="Borno">Borno</div>
                              <div class="col-md-4"><input type="checkbox" name="location[]" value="Cross River">Cross River</div>
                              <div class="col-md-4"><input type="checkbox" name="location[]" value="Delta">Delta</div>
                              <div class="col-md-4"><input type="checkbox" name="location[]" value="Ebonyi">Ebonyi</div>
                              <div class="col-md-4"><input type="checkbox" name="location[]" value="Edo">Edo</div>
                              <div class="col-md-4"><input type="checkbox" name="location[]" value="Ekiti">Ekiti</div>
                              <div class="col-md-4"><input type="checkbox" name="location[]" value="Enugu">Enugu</div>
                              <div class="col-md-4"><input type="checkbox" name="location[]" value="FCT">FCT</div>
                              <div class="col-md-4"><input type="checkbox" name="location[]" value="Gombe">Gombe</div>
                              <div class="col-md-4"><input type="checkbox" name="location[]" value="Imo">Imo</div>
                              <div class="col-md-4"><input type="checkbox" name="location[]" value="Jigawa">Jigawa</div>
                              <div class="col-md-4"><input type="checkbox" name="location[]" value="Kaduna">Kaduna</div>
                              <div class="col-md-4"><input type="checkbox" name="location[]" value="Kano">Kano</div>
                              <div class="col-md-4"><input type="checkbox" name="location[]" value="Kastina">Kastina</div>
                              <div class="col-md-4"><input type="checkbox" name="location[]" value="Kebbi">Kebbi</div>
                              <div class="col-md-4"><input type="checkbox" name="location[]" value="Kogi">Kogi</div>
                              <div class="col-md-4"><input type="checkbox" name="location[]" value="Kwara">Kwara</div>
                              <div class="col-md-4"><input type="checkbox" name="location[]" value="Lagos">Lagos</div>
                              <div class="col-md-4"><input type="checkbox" name="location[]" value="Nasarawa">Nasarawa</div>
                              <div class="col-md-4"><input type="checkbox" name="location[]" value="Niger">Niger</div>
                              <div class="col-md-4"><input type="checkbox" name="location[]" value="Ogun">Ogun</div>
                              <div class="col-md-4"><input type="checkbox" name="location[]" value="Ondo">Ondo</div>
                              <div class="col-md-4"><input type="checkbox" name="location[]" value="Osun">Osun</div>
                              <div class="col-md-4"><input type="checkbox" name="location[]" value="Oyo">Oyo</div>
                              <div class="col-md-4"><input type="checkbox" name="location[]" value="Plateau">Plateau</div>
                              <div class="col-md-4"><input type="checkbox" name="location[]" value="Rivers">Rivers</div>
                              <div class="col-md-4"><input type="checkbox" name="location[]" value="Sokoto">Sokoto</div>
                              <div class="col-md-4"><input type="checkbox" name="location[]" value="Taraba">Taraba</div>
                              <div class="col-md-4"><input type="checkbox" name="location[]" value="Yobe">Yobe</div>
                              <div class="col-md-4"><input type="checkbox" name="location[]" value="Zamfara">Zamfara</div>
                  </div>
                  </div>
                  <div class="clearfix"></div><br/><br/><br/>

                  <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                  <div class="form-group">
                     <div class="col-md-2"> Amount: </div>
                      <div class="col-md-10"><input id="amount" type="number" class="form-control" name="amount" value="{{ old('amount') }}" max="{{ Auth::user()->balance }}" min="{{$cost->min_cost}}" required>
                      </div>
                  </div> <br/><br/><br/>

                                  @if ($errors->has('amount'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('amount') }}</strong>
                                      </span>
                                  @endif
                              </div>

                      <!--<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="col-md-4 control-label">Name</label>

                          <div class="col-md-6">
                              <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

                              @if ($errors->has('name'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('name') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>-->

                      <!--hidden fields-->
                   <div class="form-group">
                     <div class="col-md-2"> </div>
                            <span id="subo">
                              <div class="col-md-10"><button class="btn btn-primary btn-block" type="submit" ><span class="glyphicon glyphicon-cart"></span>Create</button> </div>
                            </span>
                   </div> <br/><br/><br/><br/>
                      </div>
                  </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
