@extends('layouts.app')
@section('content')
<div class="container">
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title">
                    <h1>Add IP</h1>
                </div>
            </div>
            <div class="col-md-6">
                <div class="breadcrumb-wrapper">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">

                            <li class="breadcrumb-item">
                                <a href="{{ url('/allowed-ips/index') }}">Allowed IPs</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="{{ url('/allowed-ips/create') }}">Add IP</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="card-style settings-card-2 mb-30">
            <form action="{{url('/allowed-ips/create')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-xxl-4">
                        <div class="input-style-1">
                            <label>Enter IP address</label>
                            <input type="text" name="ip" id="ipAddress" placeholder="Enter IP Address"
                                value="{{ old('ip') }}" />
                            <span class="text-danger">
                                @error('ip')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-style-1 drop-1">
                            <label> STATUS </label>
                            <select class="form-select " name="status" id="ipstatus">
                                <option value="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">InActive</option>
                            </select>
                            <span class="text-danger">
                                @error('states')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-style-1">
                            <label>CITY</label>
                            <input type="text" name="city" id="cities" readonly />
                            <span class="text-danger">
                                @error('city')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-style-1">
                            <label>STATE</label>
                            <input type="text" name="state" id="states" readonly />
                            <span class="text-danger">
                                @error('state')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-style-1">
                            <label>COUNTRY</label>
                            <input type="text" name="country" id="countries" readonly />
                            <span class="text-danger">
                                @error('country')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-style-1">
                            <label>AREA</label>
                            <input type="text" name="area" id="areas" readonly />
                            <span class="text-danger">
                                @error('area')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                    </div>


                    <div class="col-12">
                        <div class="input-style-1">
                            <label>Description</label>
                            <input type="text" name="description" value="{{ old('remarks') }}" />
                            <span class="text-danger">
                                @error('description')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="col-12">
                        <button id="submitBtn" class="main-btn dark-btn btn-hover submitbtn" name="submit">
                            Add Ip 
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999; justify-content: center; align-items: center;">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

<script>
$(document).ready(function() {
    var baseUrl = "https://api.postalpincode.in/pincode/";

    function showLoader() {
        const overlay = document.getElementById('overlay');
        overlay.style.display = 'flex'; 
    }

    function hideLoader() {
        const overlay = document.getElementById('overlay');
        overlay.style.display = 'none';
    }

    $('#ipAddress').on('change', function() {
        var ip = $(this).val();

        if (ip) {
            showLoader(); 

            $.ajax({
                url: "{{ url('allowed-ips/get-ip-info') }}",
                method: 'GET',
                data: {
                    ip: ip
                },
                success: function(data) {
                    $('#cities').val(data.city_name);
                    $('#states').val(data.region_name);
                    $('#countries').val(data.country_name);
                    $('#areas').val(data.area_name);

                    if (data.zip_code) {
                        $.ajax({
                            url: baseUrl + data.zip_code,
                            method: 'GET',
                            success: function(response) {
                                hideLoader(); 

                                if (response[0].Status === "Success") {
                              
                                    var areaNames = response[0].PostOffice.map(
                                        function(postOffice) {
                                            return postOffice.Name; 
                                        });

                                
                                    var areaNamesString = areaNames.join(', ');
                                    $('#areas').val(areaNamesString);

                                
                                    Swal.fire({
                                        title: 'Success!',
                                        text: 'Area information fetched successfully.',
                                        icon: 'success',
                                        confirmButtonText: 'Okay'
                                    });
                                } else {
                                    $('#areas').val('');
                                    console.log('No data found for this zip code');

                                 
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'No area information found for this zip code.',
                                        icon: 'error',
                                        confirmButtonText: 'Okay'
                                    });
                                }
                            },
                            error: function(xhr) {
                                hideLoader(); 
                                console.log('Error fetching postal data:', xhr.responseText);

                          
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Failed to fetch postal data.',
                                    icon: 'error',
                                    confirmButtonText: 'Okay'
                                });
                            }
                        });
                    } else {
                        hideLoader();
                    }
                },
                error: function(xhr) {
                    hideLoader(); 
                    console.log('Error:', xhr.responseText);
                }
            });
        } else {
            $('#cities').val('');
            $('#states').val('');
            $('#countries').val('');
            $('#areas').val('');
        }
    });
});
</script>



@endsection