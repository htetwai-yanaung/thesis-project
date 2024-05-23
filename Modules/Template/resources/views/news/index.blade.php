@extends('template::layouts.master')
@section('content')
<div class="container mx-3 news d-flex justify-content-end" style="padding-top: 120px;">
    <div class="left col-12 col-lg-2">
      <a href="#"><button type="button" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i>Post your thesis</button></a>
    </div>          
  </div>
  <div class="container position-relative">
    <div class="flex-wrap gap-4 px-3 py-5 d-flex justify-content-center align-items-start">
      <article class="left col-12 col-lg-7">
        <h5 class="mb-3 text-primary fw-bold"><span class="text-info">Up to Date News</span> in our Department</h5>
        <ul style="list-style-type: none;">
          
           <hr class="mt-0">
           <li class="" style="margin: 5px; padding: 10px;">
              <h4 class="title fw-bold text-primary">Robotic Arm Project</h4>
              <div class="d-flex">   
                  <p class="description text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur cumque illo dolore! Magni enim magnam aliquid. Quaerat sit possimus similique ratione voluptatem animi ad, repudiandae atque necessitatibus dolorum laborum ducimus.</p>
                  <img class="thesis-image" src="storage/uploads/thesis.jpg" alt="" srcset="">
              </div>
              <div class="d-flex justify-content-between">
                  <span class="text-info">Tect Htun</span>
                  <span>8.4.2024</span>
              </div>
           </li>
           <li class="" style="margin: 5px; padding: 10px;">
            <h4 class="title fw-bold text-primary">Robotic Arm Project</h4>
            <div class="d-flex">   
                <p class="description text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur cumque illo dolore! Magni enim magnam aliquid. Quaerat sit possimus similique ratione voluptatem animi ad, repudiandae atque necessitatibus dolorum laborum ducimus.</p>
                <img class="thesis-image" src="storage/uploads/thesis.jpg" alt="" srcset="">
            </div>
            <div class="d-flex justify-content-between">
                <span class="text-info">Tect Htun</span>
                <span>8.4.2024</span>
            </div>
         </li>
         <li class="" style="margin: 5px; padding: 10px;">
          <h4 class="title fw-bold text-primary">Robotic Arm Project</h4>
          <div class="d-flex">   
              <p class="description text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur cumque illo dolore! Magni enim magnam aliquid. Quaerat sit possimus similique ratione voluptatem animi ad, repudiandae atque necessitatibus dolorum laborum ducimus.</p>
              <img class="thesis-image" src="storage/uploads/thesis.jpg" alt="" srcset="">
          </div>
          <div class="d-flex justify-content-between">
              <span class="text-info">Tect Htun</span>
              <span>8.4.2024</span>
          </div>
       </li>
       <li class="" style="margin: 5px; padding: 10px;">
        <h4 class="title fw-bold text-primary">Robotic Arm Project</h4>
        <div class="d-flex">   
            <p class="description text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur cumque illo dolore! Magni enim magnam aliquid. Quaerat sit possimus similique ratione voluptatem animi ad, repudiandae atque necessitatibus dolorum laborum ducimus.</p>
            <img class="thesis-image" src="storage/uploads/thesis.jpg" alt="" srcset="">
        </div>
        <div class="d-flex justify-content-between">
            <span class="text-info">Tect Htun</span>
            <span>8.4.2024</span>
        </div>
     </li>
          
        </ul>
      </article>
      <article class="right col-12 col-lg-4">
        <div class="project-container">
          <article class="px-4 py-3 shadow-sm project-post" style="margin: 30px;">
            <img src="storage/uploads/thesis.jpg" class="rounded thesis-detail" alt="...">
            <p class="text-primary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia quibusdam eum excepturi omnis accusamus quod, nostrum provident quos consectetur. Eos, iusto quaerat? Sit numquam illum dicta placeat quam fugit unde!</p>
            <div class="">
              <div class="project-type text-info">Mg Tect Htun</div>
              <p class="date text-secondary">03.02.2024</p>
            </div>
          </article>
        </div>
      </article>
      <div class="bottom-0 mx-auto divider col-6 bg-primary position-absolute" style="height: 3px;left: 0;right: 0;"></div>
    </div>
  </div>
@endsection