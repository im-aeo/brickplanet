<!--
MIT License

Copyright (c) 2022 FoxxoSnoot

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
-->

@extends('layouts.default', [
    'title' => 'Welcome'
])

@section('css')
    <style>
        html, body {
            height: 100%;
        }

        .alert, .navbar-nav.mr-auto, .sidebar, footer {
            display: none;
        }

        .navbar-toggler {
            opacity: 0!important;
            cursor: default;
        }

        .alert {
            margin-bottom: 0!important;
        }

        .landing-header {
            margin-top: -100px;
            padding: 50px 0 50px 0;
            align-items: stretch;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 95vh;
        }

        @media only screen and (max-width: 768px) {
            .landing-header {
                margin-top: -85px;
            }
        }

        .landing-header .header-content {
            align-items: center;
            display: flex;
            flex-grow: 1;
            flex-shrink: 0;
        }

        @media only screen and (min-width: 768px) {
            .landing-header h1 {
                font-size: 50px;
            }

            .landing-header p {
                font-size: 23px;
            }

            .landing-header .btn {
                font-size: 18px;
            }

            .landing-header .btn:first-child {
                margin-right: 25px;
            }
        }
    </style>
@endsection

@section('content')
  
                        <h1>The place to create.</h1>
                        <p>{{ config('site.name') }} is an online 3D gaming platform where users can enable their creativity. Customize your character, create your own clothing, participate in a virtual economy, create groups, chat with others, and much more.</p>
                        
@endsection
