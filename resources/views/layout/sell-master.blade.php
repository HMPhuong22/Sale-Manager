<?php
// Start the session
session_start();
?>
<!DOCTYPE html> 
<html lang="en">

<head>
    <title></title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    {{-- <link rel="stylesheet" href="{{asset('css\layout_banhang.css')}}"> --}}
    {{-- Boostrap 4 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    {{-- <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css\layout_banhang.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>

<body>
    <!-- place navbar here -->
    @include('sell.header-sell')

    <!-- main content -->
    <section class="container-fluid">
        <div class="row w-100" style="display: flex">
            <div class="col">
                @yield('search')
                <div class="left col-12">
                    @yield('sanphamTop')
                </div>
                @yield('title')
                <div class="left col-12">
                    @yield('sanphamBottom')
                </div>
            </div>   
            <div class="right col-4">
                @yield('bantra-hang')
            </div>
        </div>
    </section>
    {{-- Footer --}}
    {{-- <footer class="fixed-bottom"> --}}
        {{-- <input class="form-control col-8" type="text" placeholder="Ghi chú..."> --}}
    {{-- </footer> --}}
</body>
{{-- @yield('checkControl') --}}

</html>