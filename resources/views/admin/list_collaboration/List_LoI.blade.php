<!DOCTYPE html>
<html lang="en">

<head>
  
    @include('admin.css')

</head>

<body>

  <!-- ======= Header ======= -->
  @include('admin.navbar')
  <!-- End Header -->

  <!-- ======= Sidebar ======= --><!DOCTYPE html>
<html lang="en">

<head>
  
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
    <h1 class="page-title">Letter of Intent (LoI)</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{'home'}}"><i class="bi bi-house-door"></i></a></li>
          <li class="breadcrumb-item"><a href="#">Active Collaboration</a></li>
        </ol>
      </nav>

    </div>

    <div id = "collaboration-section" class="collaboration-section">

  @foreach($datas as $data)
  @if($data->c_type == 'LoI' && $data->duration_left > 0 && $data->c_status != 'terminate')

  <div class="collaboration-box" onclick="collaborationDetails('{{ $data->c_name }}')">
  
  @include('admin.list_collaboration.List_body')
  </div>

  @endif
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
    function collaborationDetails(c_name) {
      window.location.href = "{{ url('/collaborations') }}_" + encodeURIComponent(c_name);
    }
  </script>

  @include('admin.script')

</body>

</html>