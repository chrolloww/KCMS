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

        <div class="container-fluid page-body-wrapper"  style="padding-top: 50px;">

        <div class="container">

        <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            @if(session()->has('message'))
              <div class="alert alert-success" >

              <button type="button" class="close" data-bs-dismiss="alert">x</button>
                {{ session()->get('message') }}
              </div>
            @endif
            
            <div class="card">
                <div class="card-header">Add Collaboration</div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{url('upload_collaboration')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Collaboration Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Collaboration Name" required autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Focal Person</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"  name="focal_person" placeholder="Focal Person" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Benefit</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"  name="benefit" placeholder="Benefit" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Start Date</label>
                            <input type="date" class="form-control @error('name') is-invalid @enderror" name="start_date" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">End Date</label>
                            <input type="date" class="form-control @error('name') is-invalid @enderror" name="end_date" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" class="form-control @error('name') is-invalid @enderror" name="file" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

        </div>

        </div>

        
    <!-- container-scroller -->
    <!-- plugins:js -->
    
    @include('admin.script')

    <!-- End custom js for this page -->
  </body>
</html>