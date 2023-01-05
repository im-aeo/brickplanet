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
    'title' => 'Download'
])

@section('css')
    <style>
        body, html {
            background-color: #3c3c3c!important;
        }

        .splash {
            background-image: url('/images/shuttle.png');
            background-position: center;
            background-repeat: no-repeat;
            width: 713px;
            height: 603px;
            margin: auto;
            margin-top: -24%;
            padding-top: 40%;
            box-sizing: content-box;
        }

        @media only screen and (max-width: 768px) {
            .splash {
                background-image: none;
                width: auto;
                height: auto;
                text-align: center;
            }

            a.download {
                width: 100%;
            }
        }

        a.download {
            float: left;
            text-decoration:none;
        }

        a.download h5 {
            margin: 0;
        }

        a.download:hover button {
            cursor: pointer;
            box-shadow: 0px 2px 5px rgba(0,0,0,0.2);
        }
    </style>
@endsection

@section('js')
    <script src="{{ js_file('games/download') }}"></script>
@endsection

@section('content')
    <div class="splash">
        <a class="download" style="width:100%;">
            <button class="orange" data-modal-open="download_client">
                <h1 style="margin:0.6em 0.8em">Download</h1>
            </button>
            <h5 style="color:#000">V0.3, 13.58MB</h5>
        </a>
        <a class="download" style="margin-top:30px;cursor:pointer;" data-modal-open="download_server">
            <h2 style="color:#fff;margin:0;">NODE-HILL</h2>
            <h5 style="color:#000">SERVER, 492KB</h5>
        </a>
    </div>
    <div class="modal" style="display:none;" data-modal="download_client">
        <div class="modal-content">
            <span class="close" data-modal-close="download_client">×</span>
            <span>Download Client</span>
            <hr>
            <span>You can not download the client <b>yet</b>. Stay updated in our Discord server.</span>
            <div class="modal-buttons">
                <button type="button" class="cancel-button" data-modal-close="download_client">Cancel</button>
            </div>
        </div>
    </div>
    <div class="modal" style="display:none;" data-modal="download_server">
        <div class="modal-content">
            <span class="close" data-modal-close="download_server">×</span>
            <span>Download Server</span>
            <hr>
            <span>You can not download the server <b>yet</b>. Stay updated in our Discord server.</span>
            <div class="modal-buttons">
                <button type="button" class="cancel-button" data-modal-close="download_server">Cancel</button>
            </div>
        </div>
    </div>
@endsection
