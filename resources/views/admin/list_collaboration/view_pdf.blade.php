<!DOCTYPE html>
<html lang="en">

<head>
  <style>
    .image {
      display: flex;
      flex-wrap: wrap;
      justify-content: left;
      align-items: flex-start;
      margin: 20px;
    }
    .shows {
      width: auto;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      margin: 10px;
      padding: 15px;
      cursor: pointer;
      transition: transform 0.3s ease-in-out;
    }
    .shows:hover {
      transform: scale(1.05);
    }

  </style>
    @include('admin.css')

</head>

<body>

  <!-- ======= Header ======= -->
  @include('admin.navbar')
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  @include('admin.sidebar')
  <!-- End Sidebar-->

  <!-- ======= Main ======= -->
  <main id="main" class="main">
  <div class="content-wrapper">
    <div class="pagetitle">
      <h1 class="page-title">Document</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{'home'}}"><i class="bi bi-house-door"></i></a></li>
          <li class="breadcrumb-item"><a href="#">Collaborations/a></li>
          <li class="breadcrumb-item active">Details</li>
          <li class="breadcrumb-item active">Document</li>
        </ol>
      </nav>

      <br><h2>File List</h2><br>
      <div class="container mt-5">
        <div class="row justify-content-center">
          <div class="col-md-6">
          @if(session('success'))
            <div class="alert alert-success">
              {{ session('success') }}
            </div>
          @endif

          @if(session('error'))
            <div class="alert alert-danger">
              {{ session('error') }}
            </div>
          @endif

          </div>
        </div>
      </div>

      <div class="image" >
        @foreach($datas as $data)
        <div class="shows" align = "center">
        <img width= "100 px"src="collabimages/pdf_logo.png">
        <a href="{{ route('file.view', $data->id) }}" target="_blank">{{$data -> d_document_name}}</a>
        <p></p>
            <form action="{{ route('file.delete', $data->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this file?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Delete File</button>
            </form>
        </div>      
        @endforeach  
      </div>
      <button type="button" class="btn btn-secondary btn-lg rounded-circle position-fixed" style="bottom: 70px; right: 50px;" data-toggle="modal" data-target="#uploadModal">
        <i class="fas fa-plus"></i>
      </button>
      
      @foreach($datas as $data)
      <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Upload File</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('file.store', $data -> d_collaboration_name) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="file">Choose File</label>
                            <input type="file" name="file" class="form-control-file" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
      
    </div>
  </div>
  </main>
  <!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->

  <script>
    function openPdfInNewTab(url) {
        window.open(url, '_blank');
    }
</script>
    
    @include('admin.script')

</body>

</html>