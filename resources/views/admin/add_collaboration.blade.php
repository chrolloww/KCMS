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
      
      <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{'home'}}">
          <i class="bi bi-grid"></i>
          <span>Home</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link " href ="{{'add_collaboration_view'}}">
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
        <a class="nav-link collapsed">
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

      <li class="nav-item">
          <a class="nav-link collapsed" href="{{'add_announcement'}}">
            <i class="bi bi-question-circle"></i>
            <span>Announcement</span>
          </a>
      </li>

    </ul>

  </aside>

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
                                    <label for="">Category:</label>
                                    <select name="type" class="form-control">
                                        <option value="option1">Please select</option>
                                        <option value="LoI">LoI</option>
                                        <option value="MoA">MoA</option>
                                        <option value="MoU">MoU</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Benefit:</label>
                                    <textarea class="form-control @error('benefit') is-invalid @enderror"  name="benefit" rows="4" required></textarea>
                                    @error('benefit')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
    <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>KICT_IIUM</span></strong>. All Rights Reserved
    </div>
  </footer>

    @include('admin.script')

    <!-- End custom js for this page -->
  </body>
</html>