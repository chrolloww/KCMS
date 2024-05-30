<!DOCTYPE html>
<html lang="en">

<head>
  @include('user.css')
  <style>

        .div_deg
        {
            display: flex;
            justify-content: center;
            align-items: center;
            /* margin-top: 10px; */
        }

        .table_deg
        {
            
            width: 100%;
            border-collapse: collapse;
        }

        th
        {
            background-color: skyblue;
            color: black;
            font-size: 15px;
            font-weight: bold;
            padding: 15px;
            border: 0.5px solid black;
        }

        td
        {
            
            padding: 5px;
            color: black;
        }

        input[type='search']
        {
          width: 500px;
          height: 60px;
          margin-left: 50px;
        }

        .collab_image 
        {
          width: 100px;
          height: 100px;
          /* object-fit: cover; Ensures the image remains square and covers the area */
        }

        .image_cell, .button_cell 
        {
          text-align: center;
          vertical-align: middle;
        }

    </style>
</head>
<body>

  <!-- Back to top button -->
  <div class="back-to-top"></div>

  <header>
    <!-- <div class="topbar">
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
        </div> 
      </div> 
    </div>  -->

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
              <a class="nav-link active" href="{{'/'}}">Home</a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" href="about.html">Collaboration</a>
            </li> -->
            <li class="nav-item">
              <a class="nav-link" href="blog.html">Announcement</a>
            </li>

            @if(Route::has('login'))

            @auth

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

  <!-- Accordion Starts -->

  <ul class="accordian">
    <li>
        <input type="radio" name="accordion" id="first">
        <label for="first">Letter of Intent (LoI) </label>
        <div class="content">
          <table>

            <div class="div_deg">
              <table class="table_deg">
                @foreach($datas as $data)
                @if($data->c_type == "LoI")

                <tr>
                  @if(isset($data) && $data->c_image)
                  <td class="image_cell"><img class="collab_image" src="/collabimages/{{$data->c_image}}" alt=""></td>
                  @else
                  <td class="image_cell"><img class="collab_image" src="/collabimages/not_found.jpg" alt=""></td>
                  @endif
                  <td><strong>{{$data->c_name}}</strong><br>{{$data->c_focal_person}}<br>{{$data -> s_email}}</td>
                  @include('user.view_details')
                  <td class="button_cell"><a class="btn btn-primary" href="{{url('update_collaboration',$data->id)}}">Update</a></td>
                  <td class="button_cell"><a class="btn btn-secondary" onClick="confirmation(event)" href="{{ route('collaboration.details', $data->id)}}">Details</a></td>
                </tr>

                @endif
                @endforeach
              </table>
            </div>

          </table>

        </div>
    </li>

    <li>
        <input type="radio" name="accordion" id="second">
        <label for="second">Memoranda of Agreement (MoA)</label>
        <div class="content">
          <table>

          <div class="div_deg">
              <table class="table_deg">

             @foreach($datas as $data)
             @if($data->c_type == "MoA")

                <tr>
                  @if(isset($data) && $data->c_image)
                  <td class="image_cell"><img class="collab_image" src="/collabimages/{{$data->c_image}}" alt=""></td>
                  @else
                  <td class="image_cell"><img class="collab_image" src="/collabimages/not_found.jpg" alt=""></td>
                  @endif
                  <td><strong>{{$data->c_name}}</strong><br>{{$data->c_focal_person}}<br>{{$data -> s_email}}</td>
                  @include('user.view_details')
                  <td class="button_cell"><a class="btn btn-primary" href="{{url('update_collaboration',$data->id)}}">Update</a></td>
                  <td class="button_cell"><a class="btn btn-secondary" onClick="confirmation(event)" href="{{ route('collaboration.details', $data->id)}}">Details</a></td>
                </tr>

                @endif
                @endforeach

              </table>
          </div>

          </table>

        </div>
    </li>

    <li>
        <input type="radio" name="accordion" id="third">
        <label for="third">Memoranda of Understanding (MoU)</label>
        <div class="content">
          <table>
            <div class="div_deg">
              <table class="table_deg">

             @foreach($datas as $data)
             @if($data->c_type == "MoU")

                <tr>
                  @if(isset($data) && $data->c_image)
                  <td class="image_cell"><img class="collab_image" src="/collabimages/{{$data->c_image}}" alt=""></td>
                  @else
                  <td class="image_cell"><img class="collab_image" src="/collabimages/not_found.jpg" alt=""></td>
                  @endif
                  <td><strong>{{$data->c_name}}</strong><br>{{$data->c_focal_person}}<br>{{$data -> s_email}}</td>
                  @include('user.view_details')
                  <td class="button_cell"><a class="btn btn-primary" href="{{url('update_collaboration',$data->id)}}">Update</a></td>
                  <td class="button_cell"><a class="btn btn-secondary" onClick="confirmation(event)" href="{{ route('collaboration.details', $data->id)}}">Details</a></td>
                </tr>

                @endif
                @endforeach

              </table>
          </div>

          </table>

        </div>
    </li>
  </ul>

  <!-- Accordion Ends -->

@include('user.script')
</body>
</html>