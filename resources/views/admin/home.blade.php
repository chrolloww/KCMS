<!DOCTYPE html>
<html lang="en">

<head>
  
    @include('admin.css')

</head>

<body>

  <!-- ======= Header ======= -->
  @include('admin.navbar')
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{'home'}}">
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

    </ul>

  </aside>
  <!-- End Sidebar-->

  <!-- ======= Main ======= -->
  @include('admin.body')
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

  @include('admin.script')

</body>

</html>