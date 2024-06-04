<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
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

    <main id="main" class="main">

        <div class="content-wrapper">
        <div class="pagetitle">
            <h1 class="page-title">Add Collaboration</h1>
            <nav>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{'home'}}"><i class="bi bi-house-door"></i></a></li>
                <li class="breadcrumb-item"><a href="#">Add Collaboration</a></li>
            </ol>
            </nav>
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
                            <form action="{{url('upload_collaboration')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="">Collaboration Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autofocus>
                                </div>

                                <div class="form-group">
                                    <label for="">Focal Person (Staff ID)</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"  name="focal_person" required>
                                    @error('focal_person')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Benefit</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"  name="benefit" required>
                                </div>
                        
                                <div class="form-group">
                                    <label for="">Start Date</label>
                                    <input type="date" class="form-control @error('name') is-invalid @enderror" name="start_date" required>
                                </div>

                                <div class="form-group">
                                    <label for="">End Date</label>
                                    <input type="date" class="form-control @error('name') is-invalid @enderror" name="end_date" required>
                                </div>
                        
                                <div class="form-group">
                                    <label for="">Document</label>
                                    <input type="file" class="form-control @error('name') is-invalid @enderror" name="file" required>
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
        </main>
    <!-- container-scroller -->
    <!-- plugins:js -->
    
    @include('admin.script')

    <!-- End custom js for this page -->
  </body>
</html>