<!DOCTYPE html>
<html lang="en">
<head>
  <!--css-->
  @include('user.css')
  <style>
    main {
      position: relative;
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: calc(100% - 60px); /* Adjust height considering the header */
    }

.image-container {
    position: relative;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.image-container img {
    max-width: 100%;
    max-height: 100%;
    object-fit: cover;
}

.download-box {
    position: absolute;
    top: 30px;
    right: 30px;
    background-color: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

.download-box p {
    margin: 10px 0;
}

.download-box a {
    color: #4caf50;
    text-decoration: none;
    transition: color 0.3s ease;
}

.download-box a:hover {
    color: #388e3c;
}

.download-box strong {
    display: block;
    font-size: 18px;
    color: #333;
    margin-bottom: 10px;
}

/* Announcement */

.announcement-container {
    position: absolute;
    width: 45%;
    top: 30px;
    left: 30px;
}

.announcement-box {
    position: absolute;
    top: 30px;
    left: 30px;
    background-color: #ffffff;
    padding: 5px;
    border-radius: 8px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

.announcement-list {
    max-height: 200px; /* Adjust as needed */
    overflow-y: auto; /* Add scrollbar if content exceeds max height */
}

.announcement {
    margin-bottom: 20px;
}

.announcement h3 {
    font-size: 18px;
    margin-bottom: 5px;
}

.announcement p {
    margin: 0;
}

.toggle-btn {
    display: block;
    width: 100%;
    background-color: #4caf50;
    color: #fff;
    border: none;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.toggle-btn:hover {
    background-color: #388e3c;
}

  </style>

</head>
<body>

  <!-- Back to top button -->
  <div class="back-to-top"></div>

  <header style="">

    <!-- Nav -->
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="/"><span class="text-success">KICT</span> - Collaboration Management System</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport" aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="" id="navbarSupport">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link active" href="{{'/'}}">Home</a>
            </li>

            @if(Route::has('login'))

            @auth

            <li class="nav-item">
              <a class="nav-link" href="{{'userdashboard'}}">Dashboard</a>
            </li>

            <x-app-layout>
            </x-app-layout>

            @else

            <li class="nav-item">
              <a class="btn btn-success ml-lg-3" href="{{route('login')}}">Login</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-success ml-lg-3" href="{{route('register')}}">Register</a>
            </li>

            @endauth

            @endif

          </ul>
        </div> <!-- .navbar-collapse -->
      </div> <!-- .container -->
    </nav>

  </header>

  <main>
    
    <div class="image-container">
    
      <img src="{{ asset('images_fixed/kict_home.jpg') }}" alt="Collaboration">

      <div class="announcement-box" style="width: 50%; height: 300px; overflow-y: auto;">
          <div class="container" style="width: 100%;">
              <div class="card-header">Announcements</div>
              <div class="card-body" style="max-height: 100%; overflow-y: auto;">
                  @if ($announcements->isEmpty())
                      <p>No announcements available.</p>
                  @else
                      <ul style="margin-bottom: 0;">
                          @foreach ($announcements as $announcement)
                              <li>
                                  <h3>{{ $announcement->title }}</h3>
                                  <textarea class="form-control" rows="3" readonly>{{ $announcement->description }}</textarea>
                              </li>
                          @endforeach
                      </ul>
                  @endif
              </div>
          </div>
      </div>
      
      <div class="download-box">
            <p>Download template here</p>
            <p><a href="{{ asset('images_fixed/LoI_template.docx') }}">LoI</a></p>
            <p><a href="{{ asset('images_fixed/MoA_template.docx') }}">MoA</a></p>
            <p><a href="{{ asset('images_fixed/MoU_template.docx') }}">MoU</a></p>    
        </div>
    </div>
  </main>

<script src="../assets/js/jquery-3.5.1.min.js"></script>

<script src="../assets/js/bootstrap.bundle.min.js"></script>

<script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

<script src="../assets/vendor/wow/wow.min.js"></script>

<script src="../assets/js/theme.js"></script>
  
</body>
</html>