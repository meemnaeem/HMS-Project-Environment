@extends('layouts.admin.app')

{{--  popper.js CSS example  --}}
<style>
    body {
        background-color: #30263d;
        font-family: -apple-system, Helvetica Neue, Segoe UI, Roboto, Oxygen, Ubuntu,
            Cantarell, Open Sans, sans-serif;
        text-transform: uppercase;
        padding: 100px;
    }

    #button {
        display: inline-block;
        width: 134px;
        height: 320px;
        background-image: url('https://popper.js.org/images/popcorn-box.svg');
    }

    #tooltip {
        background: rgb(3, 206, 87);
        color: white;
        font-weight: bold;
        padding: 4px 8px;
        font-size: 13px;
        border-radius: 4px;
    }

    #arrow,
    #arrow::before {
        position: absolute;
        width: 8px;
        height: 8px;
        background: inherit;
    }

    #arrow {
        visibility: hidden;
    }

    #arrow::before {
        visibility: visible;
        content: '';
        transform: rotate(45deg);
    }

    #tooltip[data-popper-placement^='top']>#arrow {
        bottom: -4px;
    }

    #tooltip[data-popper-placement^='bottom']>#arrow {
        top: -4px;
    }

    #tooltip[data-popper-placement^='left']>#arrow {
        right: -4px;
    }

    #tooltip[data-popper-placement^='right']>#arrow {
        left: -4px;
    }
</style>

@section('content')
    <h1>
        <p>Body text</p>
    </h1>
    <p>The quick brown fox ...</p>
    <p class="text-sm ...">The quick brown fox ...</p>
    <p class="text-base ...">The quick brown fox ...</p>
    <p class="text-lg ...">The quick brown fox ...</p>
    <p class="text-xl ...">The quick brown fox ...</p>
    <p class="text-2xl ...">The quick brown fox ...</p>

    <x-flatpickr name="dob" value="" />


    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Bootstrap modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Bootstrap Modal..... Success!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <br>

    {{-- <livewire:edit-user /> --}}

    {{-- <button class="btn btn-primary" onclick="Livewire.emit('openModal', 'edit-user')">Open livewire-ui/Modal</button> --}}
    <p class="text-sm"> Set up previous URL on View with Blade: </p>
    <div>
        <a href="{{ url()->previous() }}">
            <i class="fa fa-arrow-circle-o-left"></i>
            <span>Back</span>
        </a>
    </div>
    {{--  Test Bootstrap css  --}}
    <div class="alert alert-success mt-5" role="alert">
        Boostrap 5 is working using laravel 9 mix!
    </div>

    {{--  popper.js HTML example  --}}
    <button class="btn btn-primary" id="button" aria-describedby="tooltip">My button</button>
    <div id="tooltip" role="tooltip">My tooltip
        <div id="arrow" data-popper-arrow></div>
    </div>

    {{--    Load compiled Javascript    --}}
    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        //Test jQuery
        $(document).ready(function() {
            console.log('Test');
            console.log('jQuery works!');

            //Test bootstrap Javascript
            console.log('bootstrap.Tooltip.VERSION:', bootstrap.Tooltip.VERSION, 'works!');
        });

        //Test popper.js
        const button = document.querySelector('#button');
        const tooltip = document.querySelector('#tooltip');
        const popperInstance = Popper.createPopper(button, tooltip, {
            placement: 'right',
        });
    </script>


    <!-- /Main Wrapper -->
@endsection
