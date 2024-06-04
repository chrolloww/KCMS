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

		.title {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f0f0f0;
}

.announcement-link {
    text-decoration: none;
    color: #333; /* Change color as per your preference */
}

.announcement-link:hover {
    text-decoration: underline;
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
            <h1 class="page-title">Add Announcement</h1>
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
                        <div class="card-header">Add Announcement</div>
                        <div class="card-body">
                            <form action="{{url('publish_announcement')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="">Announcement Title</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="title" required autofocus>
                                </div>

								<div class="form-group">
    								<label for="">Announcement Content</label>
    								<textarea class="form-control @error('name') is-invalid @enderror" name="content" required autofocus style="width: 100%;"></textarea>
								</div>
                            
                                <button type="submit" class="btn btn-primary">Publish</button>
                            </form>
                        </div>
                    </div>

					<div class="card">
                        <div class="card-header">View Announcement</div>
                        <div class="card-body">
							@foreach($announcement as $item)
							<div class="title">
								<a class="announcement-link">{{$announcement->title}}</a>
							</div>
							@endforeach
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