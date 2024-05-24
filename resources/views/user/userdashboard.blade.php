<!DOCTYPE html>
<html lang="en">
<head>
  <!--css-->
  @include('user.css')

</head>
<body>

  <!-- Back to top button -->
  <div class="back-to-top"></div>

  <header>
    <div class="topbar">
      <div class="container">
        <div class="row">
          <div class="col-sm-8 text-sm">
            <div class="site-info">
              <a href="#"><span class="mai-call text-primary"></span> +00 123 4455 6666</a>
              <span class="divider">|</span>
              <a href="#"><span class="mai-mail text-primary"></span> mail@example.com</a>
            </div>
          </div>
          <div class="col-sm-4 text-right text-sm">
            <div class="social-mini-button">
              <a href="#"><span class="mai-logo-facebook-f"></span></a>
              <a href="#"><span class="mai-logo-twitter"></span></a>
              <a href="#"><span class="mai-logo-dribbble"></span></a>
              <a href="#"><span class="mai-logo-instagram"></span></a>
            </div>
          </div>
        </div> <!-- .row -->
      </div> <!-- .container -->
    </div> <!-- .topbar -->

    <!-- Nav -->
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="#"><span class="text-primary">KICT</span> - Collaboration Management System</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport" aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="" id="navbarSupport">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="{{'/'}}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.html">Collaboration</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="blog.html">Announcement</a>
            </li>

            @if(Route::has('login'))

            @auth

            <li class="nav-item">
              <a class="nav-link active" href="{{'userdashboard'}}">Dashboard</a>
            </li>

            <x-app-layout>
            </x-app-layout>

            @else

            <li class="nav-item">
              <a class="btn btn-primary ml-lg-3" href="{{route('login')}}">Login</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-primary ml-lg-3" href="{{route('register')}}">Register</a>
            </li>

            @endauth

            @endif

          </ul>
        </div> <!-- .navbar-collapse -->
      </div> <!-- .container -->
    </nav>

  </header>

  <ul class="accordian">
    <li>
        <input type="radio" name="accordion" id="first">
        <label for="first">LETTER OF INTENT (LoI) </label>
        <div class="content">
          <table>

            @foreach($datas as $data)
            @if($data->c_type == "LoI")

            <tr style = "height: 100px;">
              <td>{{$loop -> iteration}}</td>
              <td>
              <div class="image">
                <img width= "100 px"src="collabimages/{{$data->c_image}}" alt="">
              </div>
              </td>

              <td>
              <table >
                <tr>
                  <div class="name">
                  <p class="text-xl mb-0">{{$data->c_name}}</p>
                </div>
                </tr>
                <tr>
                  <td>
                  <span class="text-sm text-grey">{{$data->c_focal_person}}</span>
                  </td>
                  <td>
                  <span class="text-sm1 text-grey">{{$data -> s_phone_number}}</span>
                  </td>
                </tr>
              </table>
              </td>
              
            </tr>
            @endif
            @endforeach
          </table>

        </div>
    </li>

    <li>
        <input type="radio" name="accordion" id="second">
        <label for="second">MoA</label>
        <div class="content">
          <table>

            @foreach($datas as $data)
            @if($data->c_type == "MoA")

            <tr style = "height: 100px;">
              <td>{{$loop -> iteration}}</td>
              <td>
              <div class="image">
                <img width= "100 px"src="collabimages/{{$data->c_image}}" alt="">
              </div>
              </td>

              <td>
              <table >
                <tr>
                  <div class="name">
                  <p class="text-xl mb-0">{{$data->c_name}}</p>
                </div>
                </tr>
                <tr>
                  <td>
                  <span class="text-sm text-grey">{{$data->c_focal_person}}</span>
                  </td>
                  <td>
                  <span class="text-sm1 text-grey">{{$data -> s_phone_number}}</span>
                  </td>
                </tr>
              </table>
              </td>
              
            </tr>
            @endif
            @endforeach
          </table>

        </div>
    </li>

    <li>
        <input type="radio" name="accordion" id="third">
        <label for="third">MoU</label>
        <div class="content">
          <table>

            @foreach($datas as $data)
            @if($data->c_type == "MoU")

            <tr style = "height: 100px;">
              <td>{{$loop -> iteration}}</td>
              <td>
              <div class="image">
                <img width= "100 px"src="collabimages/{{$data->c_image}}" alt="">
              </div>
              </td>

              <td>
              <table >
                <tr>
                  <div class="name">
                  <p class="text-xl mb-0">{{$data->c_name}}</p>
                </div>
                </tr>
                <tr>
                  <td>
                  <span class="text-sm text-grey">{{$data->c_focal_person}}</span>
                  </td>
                  <td>
                  <span class="text-sm1 text-grey">{{$data -> s_phone_number}}</span>
                  </td>
                </tr>
              </table>
              </td>
              
            </tr>
            @endif
            @endforeach
          </table>

        </div>
    </li>
  </ul>


<script src="../assets/js/jquery-3.5.1.min.js"></script>

<script src="../assets/js/bootstrap.bundle.min.js"></script>

<script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

<script src="../assets/vendor/wow/wow.min.js"></script>

<script src="../assets/js/theme.js"></script>
  
</body>
</html>