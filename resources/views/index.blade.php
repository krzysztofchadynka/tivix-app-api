@extends('master')

@section('title', 'TIVIX recruitment application')

@section('content')
    <section class="vh-100">
        <div class="container-fluid">
            <div class="row h-100 mt-4">
                <div class="col-md-12">
                    <h1 class="text-center">@yield('title')</h1>
                    <form id="loginForm" onsubmit="event.preventDefault();">
                        <div class="form-outline mb-4">
                            <input type="email" id="loginEmail" class="form-control form-control-lg"
                                   placeholder="Enter a valid email address" />
                            <label class="form-label" for="loginEmail">Email address</label>
                        </div>
                        <div class="form-outline mb-3">
                            <input type="password" id="loginPassword" class="form-control form-control-lg"
                                   placeholder="Enter password" />
                            <label class="form-label" for="loginPassword">Password</label>
                        </div>
                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="button" id="loginButton" class="btn btn-primary btn-lg">
                                Login
                            </button>
                        </div>
                        <p class="lead fw-normal mb-0 me-3" id="loginResult"></p>
                    </form>
                    <form id="loggedUserForm" onsubmit="event.preventDefault();">
                        <button id="logoutButton" class="btn btn-primary btn-lg">Logout</button>
                        <div id="apiIntegration">
                            <div class="form-outline mb-4 mt-4">
                                <input type="text" id="positionTitle" class="form-control form-control-lg" />
                                <label class="form-label" for="positionTitle">Position title</label>
                            </div>

                            <button class="btn btn-success btn-lg" id="getMoviesButton">Get movies</button>
                            <button class="btn btn-success btn-lg" id="getEpisodesButton">Get episodes</button>
                            <button class="btn btn-success btn-lg" id="getSeriesButton">Get series</button>

                            <div class="row">
                                <div id="apiResponse" class="col-12 mt-4"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
