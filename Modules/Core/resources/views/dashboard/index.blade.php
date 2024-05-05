@extends('core::layouts.master')

@section('content')
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card  h-100 py-2">
            <div class="card-body">
                <div class="no-gutters">
                    <div class="text-center">
                        <i class="fa-solid fa-user-group text-info"></i>
                        <div class="">Total Teachers</div>
                    </div>
                    <div class="text-center ">
                        {{ $totalTeachers }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card  h-100 py-2">
            <div class="card-body">
                <div class="no-gutters">
                    <div class="text-center">
                        <i class="fa-solid fa-user-group text-primary"></i>
                        <div class="">Total Students</div>
                    </div>
                    <div class="text-center ">
                        {{ $totalStudents }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card  h-100 py-2">
            <div class="card-body">
                <div class="no-gutters">
                    <div class="text-center">
                        <i class="fa-regular fa-newspaper text-success"></i>
                        <div class="">Total News</div>
                    </div>
                    <div class="text-center ">
                        50
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card  h-100 py-2">
            <div class="card-body">
                <div class="no-gutters">
                    <div class="text-center">
                        <i class="fa-solid fa-rectangle-list text-danger"></i>
                        <div class="">Total Thesis</div>
                    </div>
                    <div class="text-center ">
                        15
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->

<div class="row">
    <div class="col-xl-5 col-md-6 col-sm-4">
        <table class="table table-hover">
            <div class="table-label bg-white">
                <div class="d-flex justify-content-between align-items-center p-3">
                <span class="fw-bold text-info ">Teacher List</span>
                <a href="{{ route('teacher.index') }}" class="text-decoration-none">view all</a>
                </div>
            </div>
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Role</th>
                    <th scope="col">Ph no</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < 5; $i++)
                <tr>
                    <td>{{ $teachers[$i]->name }}</td>
                    <td>{{ $teachers[$i]->name }}</td>
                    <td>{{ $teachers[$i]->name }}</td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>


    <div class="col-xl-7 col-md-6 col-sm-8">
        <table class="table table-hover">
            <div class="table-label bg-white">
                <div class="d-flex justify-content-between align-items-center p-3">
                <span class="fw-bold text-info">Student List</span>
                <a href="{{ route('student.index') }}" class="text-decoration-none">view all</a>
                </div>
            </div>
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Year</th>
                <th scope="col">Email</th>
                <th scope="col">Projects</th>
            </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < 5; $i++)
                <tr>
                    <td>{{ $students[$i]->name }}</td>
                    <td>{{ $students[$i]->name }}</td>
                    <td>{{ $students[$i]->name }}</td>
                    <td>{{ $students[$i]->name }}</td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Content Column -->
    <div class="col-lg-6 bg-white">
    <ul style="list-style-type: none;">
        <div class="d-flex justify-content-between align-items-center p-3">
            <h4 class="fw-bold"><span class="text-primary">Thesis</span> in Department</h4>
        <a href="" class="text-decoration-none">view all</a>
        </div>
        <hr class="mt-0">
        <li class="bg-light" style="margin: 5px; padding: 10px;">
            <h4>Robotic Arm Project</h4>
            <div class="d-flex">
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repudiandae distinctio temporibus amet sit quod beatae.</p>
                <img src="Images/thesis.jpg" alt="" srcset="">
            </div>
            <div class="d-flex justify-content-between">
                <span class="text-info">Tect Htun</span>
                <span>8.4.2024</span>
            </div>
        </li>
        <li class="bg-light" style="margin: 5px; padding: 10px;">
            <h4>Robotic Arm Project</h4>
            <div class="d-flex">
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repudiandae distinctio temporibus amet sit quod beatae.</p>
                <img src="Images/thesis.jpg" alt="" srcset="">
            </div>
            <div class="d-flex justify-content-between">
                <span class="text-info">Tect Htun</span>
                <span>8.4.2024</span>
            </div>
        </li>
        <li class="bg-light" style="margin: 5px; padding: 10px;">
            <h4>Robotic Arm Project</h4>
            <div class="d-flex">
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repudiandae distinctio temporibus amet sit quod beatae.</p>
                <img src="Images/thesis.jpg" alt="" srcset="">
            </div>
            <div class="d-flex justify-content-between">
                <span class="text-info">Tect Htun</span>
                <span>8.4.2024</span>
            </div>
        </li>
    </ul>

    </div>
    <div class="col-lg-6 bg-white">
        <ul style="list-style-type: none;">
        <div class="d-flex justify-content-between align-items-center p-3">
            <h4 class="fw-bold"><span class="text-primary ">Thesis</span> in Department</h4>
        <a href="" class="text-decoration-none">view all</a>
        </div>
        <hr class="mt-0">
        <li class="bg-light" style="margin: 5px; padding: 10px;">
            <h4>Robotic Arm Project</h4>
            <div class="d-flex">
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repudiandae distinctio temporibus amet sit quod beatae.</p>
                <img src="Images/thesis.jpg" alt="" srcset="">
            </div>
            <div class="d-flex justify-content-between">
                <span class="text-info">Tect Htun</span>
                <span>8.4.2024</span>
            </div>
        </li>
        <li class="bg-light" style="margin: 5px; padding: 10px;">
            <h4>Robotic Arm Project</h4>
            <div class="d-flex">
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repudiandae distinctio temporibus amet sit quod beatae.</p>
                <img src="Images/thesis.jpg" alt="" srcset="">
            </div>
            <div class="d-flex justify-content-between">
                <span class="text-info">Tect Htun</span>
                <span>8.4.2024</span>
            </div>
        </li>
        <li class="bg-light" style="margin: 5px; padding: 10px;">
            <h4>Robotic Arm Project</h4>
            <div class="d-flex">
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repudiandae distinctio temporibus amet sit quod beatae.</p>
                <img src="Images/thesis.jpg" alt="" srcset="">
            </div>
            <div class="d-flex justify-content-between">
                <span class="text-info">Tect Htun</span>
                <span>8.4.2024</span>
            </div>
        </li>
        </ul>

    </div>
</div>

@endsection
