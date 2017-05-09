@extends('layouts.app')

@section('content')
    <section class="main vh-min-100">
        <div class="container">
            <div class="section--centered">
                <form action="">
                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-1">
                            <h1 class="uppercase">campsite</h1>
                            <h3 class="m-b-20">Find the perfect campsite</h3>
                        </div>
                    </div>
                    <div class="row m-b-20 ">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" placeholder="Where do you wanna go?">
                        </div>
                    </div>
                    <div class="row m-b-20 ">
                        <div class="col-sm-4">
                            <input type="text" class="form-control" placeholder="Number of persons">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" placeholder="From dd/mm/yy">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" placeholder="Until dd/mm/yy">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-block btn-main">
                                Search
                            </button>
                        </div>
                    </div>
                </form>
                <div class="row m-t-40">
                    <div class="col-sm-4 col-sm-offset-4">
                        <a href="" target="_self">
                            <button type="button" class="btn btn-transparent btn-block">
                                How it works?
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <p>test</p>
                </div>
            </div>
        </div>
    </section>
@endsection
