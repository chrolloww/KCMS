<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
                            <form action="{{ url('publish_announcement') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" required autofocus style="width: 100%;"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Publish</button>
                            </form>
                        </div>
                    </div>

                    <div class="card mt-4" style="width: 850px;">
                        <div class="card-header">Announcements</div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if ($announcements->isEmpty())
                                <p>No announcements available.</p>
                            @else
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Description</th>
                                            
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($announcements as $announcement)
                                            <tr>
                                                <td>{{ $announcement->title }}</td>
                                                <td><textarea class="form-control" rows="3" readonly>{{ $announcement->description }}</textarea></td>
                                                
                                                <td>
                                                    <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal" data-id="{{ $announcement->id }}" data-title="{{ $announcement->title }}" data-description="{{ $announcement->description }}">Edit</button>
                                                    <form action="{{ url('delete_announcement', $announcement->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this announcement?')">Delete</button>
                                                    </form>    
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>

                    <!-- Edit Announcement Modal -->
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit Announcement</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="editForm" action="" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')
                                        <div class="form-group">
                                            <label for="editTitle">Title</label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="editTitle" name="title" required autofocus>
                                        </div>
                                        <div class="form-group">
                                            <label for="editDescription">Description</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" id="editDescription" name="description" required autofocus style="width: 100%;"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </form>
                                </div>
                            </div>
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
    <script>
    $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id')
        var title = button.data('title')
        var description = button.data('description')
        var modal = $(this)
        modal.find('.modal-body #editTitle').val(title)
        modal.find('.modal-body #editDescription').val(description)
        modal.find('#editForm').attr('action', 'update_announcement/' + id)
    })
    </script>

    <!-- End custom js for this page -->
  </body>
</html>