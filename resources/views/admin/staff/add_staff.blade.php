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

    <main id="main" class="main">

        <div class="content-wrapper">
        <div class="pagetitle">
            <h1 class="page-title">Add Staff</h1>
            <nav>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{'home'}}"><i class="bi bi-house-door"></i></a></li>
                <li class="breadcrumb-item"><a href="#">Staff</a></li>
                <li class="breadcrumb-item"><a href="#">Add Staff</a></li>
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
                        <div class="card-header">Add Staff</div>
                        <div class="card-body">
                            <form action="{{url('upload_staff')}}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="">Staff Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder = "Eg: Asst. Prof. Dr. " required autofocus>
                                </div>

                                <div class="form-group">
                                    <label for="">Staff ID</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"  name="staff_id" placeholder = "Eg: 1234567"required>
                                </div>
                        
                                <div class="form-group">
                                    <label for="">Staff Email</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"  name="email" placeholder = "Eg: IIUM@gmail.com"required>
                                </div>
                            
                                <button type="submit" class="btn btn-primary">Add Staff</button>
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
    <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>KICT_IIUM</span></strong>. All Rights Reserved
    </div>
  </footer>

    @include('admin.script')

    <!-- End custom js for this page -->
  </body>
</html>