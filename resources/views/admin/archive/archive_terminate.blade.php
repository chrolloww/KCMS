<!DOCTYPE html>
<html lang="en">

<head>
  
    @include('admin.css')

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
          height: 50px;
          text-align: center;
          vertical-align: middle;
        }

    </style>

</head>

<body>

  <!-- ======= Header ======= -->
  @include('admin.navbar')
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{'home'}}">
          <i class="bi bi-grid"></i>
          <span>Home</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href ="{{'add_collaboration_view'}}">
          <i class="bi bi-menu-button-wide"></i>
          <span>Add Collaboration</span>
        </a>
      </li>

      <li class="nav-item">
        <a class=" nav-link collapsed">
            <i class="bi bi-universal-access"></i><span>Active Collaboration</span>
        </a>
        <div id="collaboration-list">
            <ul class="nav-content">
                <li>
                    <a href="{{'List_LoI'}}">
                        <i class="bi bi-circle"></i><span>LOI</span>
                    </a>
                </li>
                <li>
                    <a href="{{'List_MoA'}}">
                        <i class="bi bi-circle"></i><span>MoA</span>
                    </a>
                </li>
                <li>
                    <a href="{{'List_MoU'}}">
                        <i class="bi bi-circle"></i><span>MoU</span>
                    </a>
                </li>
            </ul>
          </div>
        </li>

      <li class="nav-item">
        <a class="nav-link ">
          <i class="bi bi-receipt-cutoff"></i><span>Archive</span>
        </a>
          <div id="collaboration-list">
            <ul class="nav-content">
              <li>
                <a href="{{'Archived_List_LoI'}}">
                  <i class="bi bi-circle"></i><span>Expired LoI</span>
                </a>
              </li>

              <li>
                <a href="{{'Archived_List_MoA'}}">
                  <i class="bi bi-circle"></i><span>Expired MoA</span>
                </a>
              </li>

              <li>
                <a href="{{'Archived_List_MoU'}}">
                  <i class="bi bi-circle"></i><span>Expired MoU</span>
                </a>
              </li>

              <li>
                <a href="{{'Archived_List_Terminate'}}">
                  <i class="bi bi-circle"></i><span>Terminate</span>
                </a>
              </li>

            </ul>
          </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed">
          <i class="bi bi-people"></i><span>Staff</span>
        </a>
          <div id="collaboration-list">
            <ul class="nav-content">
            <li>
              <a href="{{'staff_list_view'}}">
                <i class="bi bi-circle"></i><span>Staff List</span>
              </a>
            </li>

            <li>
              <a href="{{'add_staff_view'}}">
                <i class="bi bi-circle"></i><span>Add Staff</span>
              </a>
            </li>
            </ul>
          </div>
      </li>

    </ul>

  </aside>
  <!-- End Sidebar-->

  <!-- ======= Main ======= -->
  <main id="main" class="main">

  <div class="content-wrapper">
    <div class="pagetitle">
    <h1 class="page-title">Terminated Collabortaion</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{'home'}}"><i class="bi bi-house-door"></i></a></li>
          <li class="breadcrumb-item"><a href="#">Expired Collaboration</a></li>
        </ol>
      </nav>

    </div>

    <div class="content">
          <table>

            <div class="div_deg">
              <table class="table_deg">
                @foreach($datas as $data)
                @if($data->c_status == 'TERMINATE')

                <tr>
                  @if(isset($data) && $data->c_image)
                  <td class="image_cell"><img class="collab_image" src="/collabimages/{{$data->c_image}}" alt=""></td>
                  @else
                  <td class="image_cell"><img class="collab_image" src="/collabimages/not_found.jpg" alt=""></td>
                  @endif
                  <td><strong>{{$data->c_name}}</strong><br>{{$data->s_name}}<br>{{$data -> s_email}}</td>

                  @if($data->duration_left < 0)
                    @php
                      $duration = abs(intval($data->duration_left));
                    @endphp
                      <td><strong>Expired for:</strong><br>{{$duration}} days</td>
                  @elseif($data->duration_left < 30)
                    @php
                      $duration = abs(intval($data->duration_left / 30));
                    @endphp
                      <td><strong>Expired for:</strong><br>{{$duration}} month</td>
                  @elseif($data->duration_left < 360)
                    @php
                      $duration = abs(intval($data->duration_left / 360));
                    @endphp
                      <td><strong>Expired for:</strong><br>{{$duration}} year</td>
                  @endif
                  
                  <td class="button_cell"><a class="btn btn-secondary" onClick="confirmation(event)" href="{{ route('collaboration.details', $data->id)}}">View</a></td>
                </tr>

                @endif
                @endforeach
              </table>
            </div>

          </table>

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