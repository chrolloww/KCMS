  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{'home'}}">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">

    <!-- Total Collaboration card -->
      <div class="col-xxl-4 col-xl-12">
        <div class="card info-card customers-card">
          <div class="card-body">
            <h5 class="card-title">Total Active <span>| Collaboration</span></h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-people"></i>
              </div>

              <div class="ps-3">
                <h6 style = "color: green;">
                  {{ $total->filter(function ($data) { return $data->duration_left > 0 && $data->c_status != "TERMINATE";})->count() }}
                </h6>
                <span class="text-success small pt-1 fw-bold">Active</span> <span class="text-muted small pt-2 ps-1">Collaboration</span>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Total Collaboration card -->

      <div class="row">
          <div class="col-lg-8">
            <div class="row">
              <!-- Active Collaboration Card -->
              <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">
                  <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                      <li class="dropdown-header text-start">
                        <h6>Filter</h6>
                      </li>
                      <li><a class="dropdown-item" href="{{ url('home') }}?filter=LoI">LoI</a></li>
                      <li><a class="dropdown-item" href="{{ url('home') }}?filter=MoU">MoU</a></li>
                      <li><a class="dropdown-item" href="{{ url('home') }}?filter=MoA">MoA</a></li>
                    </ul>
                  </div>

                <div class="card-body">
                  <h5 class="card-title" style = "color: green;">Active <span>| Collaboration</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                    <h6>
                    {{ $datas->filter(function ($data) use ($filter) { return $data->duration_left > 0 && $data->c_type == $filter && $data->c_status != "TERMINATE";})->count() }}
                    </h6>
                      <span class="text-success small pt-1 fw-bold">Active</span> 
                      <span class="text-muted small pt-2 ps-1">{{ $filter }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Active Collaboration Card -->

            <!-- Near Expired Collaboration Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="{{ url('home') }}?expire=MoA">MoA</a></li>
                    <li><a class="dropdown-item" href="{{ url('home') }}?expire=MoU">MoU</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title" style = "color: orange;">Near Expired <span>| Collaboration</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people" style="color: blue;"></i>
                    </div>
                    <div class="ps-3">
                    <h6>
                    {{ $datase->filter(function ($data) use ($expire) { return $data->duration_left > 0 && $data->duration_left < 180 && $data->c_type == $expire && $data->c_status != "TERMINATE";})->count() }}
                    </h6>
                      <span class="text-warning small pt-1 fw-bold">Near Expired</span> 
                      <span class="text-muted small pt-2 ps-1">{{ $expire }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Near Expired Collaboration Card -->
            </div>
          </div>

          <!-- Right side columns -->
        <div class="col-lg-4">
        <!-- Terminated Collaboration Card -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title" style = "color: red;">Terminated <span>| Collaboration</span></h5>

              <div class="activity">
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people" style="color: blue;"></i>
                  </div>
                <div class="ps-3">
                  <h6>
                    {{ $total->filter(function ($data) { return $data->c_status == 'TERMINATE';})->count() }}
                  </h6>
                  <span class="text-danger small pt-1 fw-bold">Terminated</span> 
                  <span class="text-muted small pt-2 ps-1">collaboration</span>
                </div>
              </div>
            </div>
          </div> <!-- End Terminated Collaboration Card -->
        </div>
        </div><!-- End Right side columns -->


        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">
            
            <!-- Graph Collaboration Card -->
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Total Signed Collaboration <span> /5 years</span></h5>
                  @include('admin.chart')

                </div>

              </div>
            </div><!-- End Graph Collaboration Card -->
          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">

          <!-- Number of staff with no collaboration card -->
          <div class="card">

            <div class="card-body">
              <h5 class="card-title">Staff <span>| No Collaboration</span></h5>

              <div class="activity">
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-file-earmark-person" style="color: blue;"></i>
                  </div>
                <div class="ps-3">
                  <h6>
                    {{ $staff }}
                  </h6>
                  <span class="text-danger small pt-1 fw-bold">No Collaboration</span> 
                  <span class="text-muted small pt-2 ps-1">staff</span>
                </div>
              </div>

              </div>

            </div>
          </div><!-- End Number of staff with no collaboration card -->

        </div><!-- End Right side columns -->

      </div>
    </section>

  </main>