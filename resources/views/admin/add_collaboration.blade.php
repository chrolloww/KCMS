<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <style type="text/css">
        label{
            display: incline-block;
            width: 200px;
        }
    </style>
    @include('admin.css')

  </head>
  <body>
      <!-- partial:partials/_sidebar.html -->
      
      @include('admin.sidebar')

      <!-- partial -->
      
      @include('admin.navbar')

        <!-- partial -->

        <div class="container-fluid page-body-wrapper">

        <div class="container" align="center" style="padding-top: 100px;">

        <div class = "container mt-5">
          <div class = "row justify-content-center">
            <div class = "col-md-6">
              <div class = "card">
                <div class = "card-header" style = "color: black; font-size: 23px;"><b>ADD COLLABORATION</b>
                  <div class = "card-body">

                  @if(session()->has('message'))
                    <div class="alert alert-success">
                      <button type="button" class="close" data-bs-dismiss="alert">x</button>
                      {{ session()->get('message') }}
                    </div>
                  @endif

                  <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>


                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        @if(session()->has('message'))
            <div class="alert alert-success">

            <button type="button" class="close" data-bs-dismiss="alert">x</button>
                {{ session()->get('message') }}
            </div>
        @endif

        <form action="{{url('upload_collaboration')}}" method="POST" enctype="multipart/form-data">

        @csrf

            <div class="row mt-5 ">

                <div style="padding:15px;">
                    <label for="">Collaboration Name</label>
                    <input type="text" style="color:black;" name="name" placeholder="Collaboration Name" required="">
                </div>

                <div style="padding:15px;">
                    <label for="">Focal Person</label>
                    <input type="text" style="color:black;" name="focal_person" placeholder="Focal Person" required="">
                </div>

                <div style="padding:15px;">
                    <label for="">Type of Collaboration</label>

                    <select name="type" style="color:black; width: 200px;" required="">
                        <option >--Select--</option>
                        <option value="MoA">MoA</option>
                        <option value="MoU">MoU</option>
                        <option value="LoI">LoI</option>
                    </select>
                </div>

                <div style="padding:15px;">
                    <label for="">Benefit</label>
                    <input type="text" style="color:black;" name="benefit" placeholder="benefit" required="">
                </div>

                <div class="center">
                <div class="col-2 py-2">
                    <label for="">Start Date</label>
                    <input type="date" name="start_date" class="form-control" style="color:black;" required="">
                </div>

                <div class="col-2 py-2">
                    <label for="">End Date</label>
                    <input type="date" name="end_date" class="form-control" style="color:black;" required="">
                </div>
                </div>

                <div style="padding:15px;">
                    <label >Image</label>
                    <input type="file" name="file" required="">
                </div>

                <div style="padding:15px;">
                    <input type="submit" class="btn btn-success">
                </div>

            </div>

        </form>

        </div>

        </div>

        @include('admin.form')
    <!-- container-scroller -->
    <!-- plugins:js -->
    
    @include('admin.script')

    <!-- End custom js for this page -->
  </body>
</html>