@extends('layouts.app')
@section('content')
@if(session('success'))
      
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>{{session('success')}}</strong>    
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
               

@endif
<div class="container-fluid">
          <!-- ========== title-wrapper start ========== -->
          <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title">
                  <h1>Masters</h1>
                </div>
              </div>
              <!-- end col -->
              <div class="col-md-6">
                <div class="breadcrumb-wrapper">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item active">
                        <a href="{{url()->current()}}">Masters</a>
                      </li>
                    </ol>
                  </nav>
                </div>
              </div>
              <!-- end col -->
            </div>
            <!-- end row -->
          </div>
          <!-- ========== title-wrapper end ========== -->
          <div class="row">
            <div class="col-xl-3 col-lg-6 col-sm-6">
              <div class="icon-card mb-30">
                <!-- <div class="icon purple">
                  <i class="lni lni-cart-full"></i>
                </div> -->
                <div class="content">
                  <h2 class="mb-10">Users</h2>
                  <a href="{{url('users/index')}}" class="main-btn dark-btn rounded-full btn-hover master-btn">Know more</a>
                  <p class="text-sm text-success">
                    <!-- <i class="lni lni-arrow-up"></i> +2.00% -->
                    <!-- <span class="text-gray">(30 days)</span> -->
                  </p>
                </div>
              </div>
              <!-- End Icon Cart -->
            </div>
            <!-- End Col -->
            <div class="col-xl-3 col-lg-6 col-sm-6">
              <div class="icon-card mb-30">
                <!-- <div class="icon purple">
                  <i class="lni lni-cart-full"></i>
                </div> -->
                <div class="content">
                  <h2 class="mb-10">Frequencies</h2>
                  <a href="{{url('frequencies/index')}}" class="main-btn dark-btn rounded-full btn-hover master-btn">Know more</a>
                  <p class="text-sm text-success">
                    <!-- <i class="lni lni-arrow-up"></i> +2.00% -->
                    <!-- <span class="text-gray">(30 days)</span> -->
                  </p>
                </div>
              </div>
              <!-- End Icon Cart -->
            </div>
            <!-- End Col -->
            <div class="col-xl-3 col-lg-6 col-sm-6">
              <div class="icon-card mb-30">
                <!-- <div class="icon purple">
                  <i class="lni lni-cart-full"></i>
                </div> -->
                <div class="content">
                  <h2 class="mb-10">Members</h2>
                  <a href="{{url('members/index')}}" class="main-btn dark-btn rounded-full btn-hover master-btn">Know more</a>
                  <p class="text-sm text-success">
                    <!-- <i class="lni lni-arrow-up"></i> +2.00% -->
                    <!-- <span class="text-gray">(30 days)</span> -->
                  </p>
                </div>
              </div>
              <!-- End Icon Cart -->
            </div>
            <!-- End Col -->
            <div class="col-xl-3 col-lg-6 col-sm-6">
              <div class="icon-card mb-30">
                <!-- <div class="icon purple">
                  <i class="lni lni-cart-full"></i>
                </div> -->
                <div class="content">
                  <h2 class="mb-10">Committees</h2>
                  <a href="{{url('committees/index')}}" class="main-btn dark-btn rounded-full btn-hover master-btn">Know more</a>
                  <p class="text-sm text-success">
                    <!-- <i class="lni lni-arrow-up"></i> +2.00% -->
                    <!-- <span class="text-gray">(30 days)</span> -->
                  </p>
                </div>
              </div>
              <!-- End Icon Cart -->
            </div>
            <div class="col-xl-3 col-lg-6 col-sm-6">
              <div class="icon-card mb-30">
                <!-- <div class="icon purple">
                  <i class="lni lni-cart-full"></i>
                </div> -->
                <div class="content">
                  <h2 class="mb-10">Meeting Room</h2>
                  <a href="{{url('meeting-rooms/index')}}" class="main-btn dark-btn rounded-full btn-hover master-btn">Know more</a>
                  <p class="text-sm text-success">
                    <!-- <i class="lni lni-arrow-up"></i> +2.00% -->
                    <!-- <span class="text-gray">(30 days)</span> -->
                  </p>
                </div>
              </div>
              <!-- End Icon Cart -->
            </div>
          </div>
          <!-- End Row -->
          
          <!-- End Row -->
        </div>
@endsection