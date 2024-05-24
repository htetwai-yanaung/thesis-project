@extends('template::layouts.master')
@section('content')
<section class="profile text-primary" style="padding-top: 80px">
    <div class="container gap-4 d-flex align-items-center">
        <div class="pt-5" id="img_preview">
            <img src="storage/uploads/Ellipse 4.png" alt="" class="rounded-circle img-thumbnail " />
        </div>
        <div class="mt-5">
        <h6 class="fw-bold">Mg Tect Htun</h6>
        <span>VI-BE Student</span>
        </div> 
        <!-- <div class="container mx-auto d-flex justify-content-end" >
                      
          </div> -->
        <div class="mt-5 thesis-create justify-content-end" id="">
            <a href=""><button type="button" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i><span class="">Post your thesis</span></button></a>
        </div>
         
    </div>
    <div class="p-4 shadow-md">
        <ul class="list-unstyled">
            <li class="post" style="margin: 5px; padding: 10px;">
                <h4 class="title fw-bold">Robotic Arm Project</h4>
                <div class="d-flex">   
                    <p style="text-align:justify;padding-right: 15px;" class="text-secondary">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quisquam, suscipit asperiores a, exercitationem reprehenderit illum, nobis aliquid neque consequuntur harum id perspiciatis! Hic qui sit ut autem nesciunt quam magni atque possimus impedit, voluptatum libero, voluptatem quis non ratione molestiae inventore consequatur. Eligendi quibusdam architecto ipsum rerum nobis, in quas impedit qui sit blanditiis. Iste repudiandae ipsum architecto, vel ipsam quasi magnam. Aperiam illo aliquid voluptatum ut non in laborum vel eligendi nobis delectus! Repudiandae porro ipsa aliquam aperiam quisquam dicta doloribus quae quia impedit exercitationem omnis perspiciatis, deleniti, nesciunt, rem saepe debitis fuga quod animi quidem nam non odio.</p>
                    <img class="thesis-image" src="storage/uploads/thesis.jpg" alt="" srcset="">
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-info">Tect Htun</span>
                    <span>8.4.2024</span>
                </div>
             </li>
             <li class="post" style="margin: 5px; padding: 10px;">
                <h4 class="title fw-bold">Robotic Arm Project</h4>
                <div class="d-flex">   
                    <p style="text-align:justify;padding-right: 15px;" class="text-secondary">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quisquam, suscipit asperiores a, exercitationem reprehenderit illum, nobis aliquid neque consequuntur harum id perspiciatis! Hic qui sit ut autem nesciunt quam magni atque possimus impedit, voluptatum libero, voluptatem quis non ratione molestiae inventore consequatur. Eligendi quibusdam architecto ipsum rerum nobis, in quas impedit qui sit blanditiis. Iste repudiandae ipsum architecto, vel ipsam quasi magnam. Aperiam illo aliquid voluptatum ut non in laborum vel eligendi nobis delectus! Repudiandae porro ipsa aliquam aperiam quisquam dicta doloribus quae quia impedit exercitationem omnis perspiciatis, deleniti, nesciunt, rem saepe debitis fuga quod animi quidem nam non odio.</p>
                    <img class="thesis-image" src="storage/uploads/thesis.jpg" alt="" srcset="">
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-info">Tect Htun</span>
                    <span>8.4.2024</span>
                </div>
             </li>
             <li class="post" style="margin: 5px; padding: 10px;">
                <h4 class="title fw-bold">Robotic Arm Project</h4>
                <div class="d-flex">   
                    <p style="text-align:justify;padding-right: 15px;" class="text-secondary">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quisquam, suscipit asperiores a, exercitationem reprehenderit illum, nobis aliquid neque consequuntur harum id perspiciatis! Hic qui sit ut autem nesciunt quam magni atque possimus impedit, voluptatum libero, voluptatem quis non ratione molestiae inventore consequatur. Eligendi quibusdam architecto ipsum rerum nobis, in quas impedit qui sit blanditiis. Iste repudiandae ipsum architecto, vel ipsam quasi magnam. Aperiam illo aliquid voluptatum ut non in laborum vel eligendi nobis delectus! Repudiandae porro ipsa aliquam aperiam quisquam dicta doloribus quae quia impedit exercitationem omnis perspiciatis, deleniti, nesciunt, rem saepe debitis fuga quod animi quidem nam non odio.</p>
                    <img class="thesis-image" src="storage/uploads/thesis.jpg" alt="" srcset="">
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-info">Tect Htun</span>
                    <span>8.4.2024</span>
                </div>
             </li>
        </ul>
    </div>       
</section>
@endsection