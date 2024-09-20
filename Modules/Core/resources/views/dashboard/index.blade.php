@extends('core::layouts.master')

@section('content')
<div class="row">
    <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-primary card-round">
        <div class="card-body">
          <div class="row">
            <div class="col-5">
              <div class="icon-big text-center">
                <i class="fas fa-chalkboard-teacher"></i>
              </div>
            </div>
            <div class="col-7 col-stats">
              <div class="numbers">
                <p class="card-category">Teachers</p>
                <h4 class="card-title">{{ $totalTeachers }}</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-info card-round">
        <div class="card-body">
          <div class="row">
            <div class="col-5">
              <div class="icon-big text-center">
                <i class="fas fa-users"></i>
              </div>
            </div>
            <div class="col-7 col-stats">
              <div class="numbers">
                <p class="card-category">Students</p>
                <h4 class="card-title">{{ $totalStudents }}</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-success card-round">
        <div class="card-body">
          <div class="row">
            <div class="col-5">
              <div class="icon-big text-center">
                <i class="fas fa-file"></i>
              </div>
            </div>
            <div class="col-7 col-stats">
              <div class="numbers">
                <p class="card-category">Thesis</p>
                <h4 class="card-title">{{ $totalProjects }}</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-secondary card-round">
        <div class="card-body">
          <div class="row">
            <div class="col-5">
              <div class="icon-big text-center">
                <i class="fas fa-book-open"></i>
              </div>
            </div>
            <div class="col-7 col-stats">
              <div class="numbers">
                <p class="card-category">News</p>
                <h4 class="card-title">{{ $totalNews }}</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
              <div class="card-title">Teacher List</div>
            </div>
            <div class="card-body">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                  </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < 5; $i++)
                    <tr>
                        <td>{{ $teachers[$i]->name }}</td>
                        <td>{{ $teachers[$i]->email }}</td>
                    </tr>
                    @endfor
                </tbody>
              </table>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-header">
              <div class="card-title">Student List</div>
            </div>
            <div class="card-body">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                  </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < 5; $i++)
                    <tr>
                        <td>{{ $students[$i]->name }}</td>
                        <td>{{ $students[$i]->email }}</td>
                    </tr>
                    @endfor
                </tbody>
              </table>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->
<div class="row">
    <div class="col-6">
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <h3 class="fw-bold"><span class="text-primary">Thesis</span> in Department</h3>
            <a href="{{ route('thesis.index') }}" class="">View all</a>
        </div>
        @foreach ($thesisProjects as $project)
        <a href="{{ route('thesis.edit', $project->id) }}">
            <div class="card">
                <div class="card-body">
                    <h4>{{ $project->title }}</h4>
                    <div class="d-flex">
                        <p>{!! Str::limit($project->description, 100, '...') !!}</p>
                        <img src="storage/uploads/thesis.jpg" alt="" srcset="">
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-info">{{ $project->owner->name }}</span>
                        <span>{{ $project->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection

@section('script')
<script>
    $multipleLineChart = document
          .getElementById("multipleLineChart")
          .getContext("2d"),

    $myMultipleLineChart = new Chart(multipleLineChart, {
        type: "line",
        data: {
          labels: [
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Dec",
          ],
          datasets: [
            {
              label: "Python",
              borderColor: "#1d7af3",
              pointBorderColor: "#FFF",
              pointBackgroundColor: "#1d7af3",
              pointBorderWidth: 2,
              pointHoverRadius: 4,
              pointHoverBorderWidth: 1,
              pointRadius: 4,
              backgroundColor: "transparent",
              fill: true,
              borderWidth: 2,
              data: [30, 45, 45, 68, 69, 90, 100, 158, 177, 200, 245, 256],
            },
            {
              label: "PHP",
              borderColor: "#59d05d",
              pointBorderColor: "#FFF",
              pointBackgroundColor: "#59d05d",
              pointBorderWidth: 2,
              pointHoverRadius: 4,
              pointHoverBorderWidth: 1,
              pointRadius: 4,
              backgroundColor: "transparent",
              fill: true,
              borderWidth: 2,
              data: [10, 20, 55, 75, 80, 48, 59, 55, 23, 107, 60, 87],
            },
            {
              label: "Ruby",
              borderColor: "#f3545d",
              pointBorderColor: "#FFF",
              pointBackgroundColor: "#f3545d",
              pointBorderWidth: 2,
              pointHoverRadius: 4,
              pointHoverBorderWidth: 1,
              pointRadius: 4,
              backgroundColor: "transparent",
              fill: true,
              borderWidth: 2,
              data: [10, 30, 58, 79, 90, 105, 117, 160, 185, 210, 185, 194],
            },
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          legend: {
            position: "top",
          },
          tooltips: {
            bodySpacing: 4,
            mode: "nearest",
            intersect: 0,
            position: "nearest",
            xPadding: 10,
            yPadding: 10,
            caretPadding: 10,
          },
          layout: {
            padding: { left: 15, right: 15, top: 15, bottom: 15 },
          },
        },
      });

</script>
@endsection
