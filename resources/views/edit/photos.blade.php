@extends('handytravelers')
@section('content')
<section class="section">
    <div class="container">
        <div class="columns">
            @include('edit._menu')

            <div class="column">
                <div class="card">

                    <header class="card-header">
                        <p class="card-header-title">
                            {{ trans('common.photos') }}
                        </p>
                    </header>

                    <div id="menuPhotos" class="column is-12" >
                            <div id="upload-button">
                                <span id="upload-button" class="button is-warning is-medium fileinput-button">
                                    <span>{{ trans('edit.addPhoto') }}</span>
                                    <input id="fileupload" type="file" name="files[]" data-url="{{ route("edit.photos") }}" >
                                </span>

                            </div>
                        </div>

                    <div class="card-content">


                        @include('edit._photos_list', ['images' => $images])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@stop
@section('javascript')
<script src="{{ asset('js/upload.js') }}"></script>
@include('edit._photos_js')
@stop
