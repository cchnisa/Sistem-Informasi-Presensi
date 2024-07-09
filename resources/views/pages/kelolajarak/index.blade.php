@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Kelola Jarak</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Kelola Jarak</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">

                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                <!-- /.card-header -->
                <div class="card-body">

                    <form method="POST" action="{{ url('/locations') }}" enctype="multipart/form-data">
                        @csrf
                        <div id="map" style="width: 100%; height: 400px;"></div>
                        <div class="form-group">
                            <label for="latitude">Latitude</label>
                            <input type="text" id="latitude" name="latitude" class="form-control" value="{{ $lastLocation ? $lastLocation->latitude : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="longitude">Longitude</label>
                            <input type="text" id="longitude" name="longitude" class="form-control" value="{{ $lastLocation ? $lastLocation->longitude : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="maxdistance">Jarak Maksimal</label>
                            <input type="text" id="maxdistance" name="maxdistance" class="form-control" value="{{ $lastLocation ? $lastLocation->maxdistance : '' }}">
                        </div>
                        <div>
                            <div>
                                <button type="submit" class="btn btn-info" onclick="submitForm()">Submit</button>
                            </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</section>
<script>
    function initMap() {
        const myLatlng = {
            lat: 0.5709851394085251,
            lng: 101.42609620976054
        };

        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 20,
            center: myLatlng,
        });

        // Buat marker baru
        const marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            draggable: true, // Marker dapat di-drag
        });

        // Create the initial InfoWindow.
        let infoWindow = new google.maps.InfoWindow({
            content: "Click the map to get Lat/Lng!",
            position: myLatlng,
        });

        infoWindow.open(map);
        // Configure the click listener.

        map.addListener("click", (mapsMouseEvent) => {
            marker.setPosition(mapsMouseEvent.latLng);
            // Create a new InfoWindow.
            // infoWindow = new google.maps.InfoWindow({
            //     position: mapsMouseEvent.latLng,
            // });
            infoWindow.setContent(
                JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
            );
            infoWindow.open(map);

            // Set the latitude and longitude values in the input fields
            document.getElementById("latitude").value = mapsMouseEvent.latLng.lat().toFixed(6);
            document.getElementById("longitude").value = mapsMouseEvent.latLng.lng().toFixed(6);
        });

        // Tambahkan event listener perpindahan marker (dragend)
        marker.addListener("dragend", () => {
            // Dapatkan posisi terbaru marker setelah perpindahan
            const position = marker.getPosition();

            // Setel info window dengan koordinat marker yang dipindahkan
            infoWindow.setContent(JSON.stringify(position.toJSON(), null, 2));
            infoWindow.open(map);

            // Setel nilai latitude dan longitude di input fields
            document.getElementById("latitude").value = position.lat().toFixed(6);
            document.getElementById("longitude").value = position.lng().toFixed(6);
        });
    }

    window.initMap = initMap;
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVv9OgHt2mbGg3c0XYiCNiN75bAucT6p0&libraries=places&callback=initMap" async defer></script>
@endsection