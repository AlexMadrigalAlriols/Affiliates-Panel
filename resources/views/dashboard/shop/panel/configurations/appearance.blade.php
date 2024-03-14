@extends('layouts.panel', ['section' => 'Configuration', 'shop' => $shop])
@section('content')
    <div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        {{ view('dashboard.shop.panel.configurations.menu', compact('shop', 'section')) }}
                    </div>
                    <div class="col-sm-9 p-3">
                        <h5><i class='bx bx-palette'></i> Appearance</h5>
                        <hr>
                        <form action="{{ route('dashboard.shop.update.data', ['shop' => $shop->subdomain]) }}" method="POST"
                            class="p-3" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row mb-3">
                                <p class="h4 mb-4">
                                    Your colours
                                    <button class="btn btn-primary pull-right" data-bs-toggle="modal" data-bs-target="#assistantModal" type="button">
                                        <i class='bx bx-color'></i>
                                        Colour Assistant
                                    </button>
                                </p>
                                <div class="col-md-2 col-sm-12 p-2">
                                    <label for="colorInput" class="form-label">Primary</label>
                                    <input type="color" id="colorInput" value="{{ $shop->config['colors']['primary'] ?? "#000000" }}"
                                    class="form-control form-control-color" name="colors[primary]">
                                </div>
                                <div class="col-md-2 col-sm-12 p-2">
                                    <label for="colorInput" class="form-label">Secondary</label>
                                    <input type="color" id="colorInput" value="{{ $shop->config['colors']['secondary'] ?? "#000000" }}"
                                        class="form-control form-control-color" name="colors[secondary]">
                                </div>
                                <div class="col-md-2 col-sm-12 p-2">
                                    <label for="colorInput" class="form-label">Reward Card</label>
                                    <input type="color" id="colorInput" value="{{ $shop->config['colors']['reward_card'] ?? "#000000" }}"
                                        class="form-control form-control-color" name="colors[reward_card]">
                                </div>
                                <div class="col-md-2 col-sm-12 p-2">
                                    <label for="colorInput" class="form-label">Texts</label>
                                    <input type="color" id="colorInput" value="{{ $shop->config['colors']['texts'] ?? "#000000" }}"
                                        class="form-control form-control-color" name="colors[texts]">
                                </div>
                                <div class="col-md-2 col-sm-12 p-2">
                                    <label for="colorInput" class="form-label">Buttons</label>
                                    <input type="color" id="colorInput" value="{{ $shop->config['colors']['button'] ?? "#000000" }}"
                                        class="form-control form-control-color" name="colors[button]">
                                </div>
                                <div class="col-md-2 col-sm-12 p-2">
                                    <label for="colorInput" class="form-label">Button Text</label>
                                    <input type="color" id="colorInput" value="{{ $shop->config['colors']['button_text'] ?? "#000000" }}"
                                        class="form-control form-control-color" name="colors[button_text]">
                                </div>
                            </div>

                            <div class="row">
                                <p class="h4 mb-4 mt-3">
                                    Images
                                </p>
                                <div class="col-md-3 col-sm-12 mb-3">
                                    <label for="shop_banner">Actual Logo:</label>
                                    <img src="{{ isset($shop->config['shop_logo']) ? asset($shop->config['shop_logo']) : asset('img/errors/404.png') }}" alt="shop_logo" id="shop_logo" width="200px">
                                </div>
                                <div class="col-md-9 col-sm-12 mb-3">
                                    <label for="bannerDropzone">Upload Logo:</label>
                                    <div class="dropzone" id="logoDropzone">
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-success" style="float: right;" type="submit"><i class='bx bx-save'></i>
                                Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="assistantModal" tabindex="-1" aria-labelledby="assitantModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assitantModalLabel"><i class='bx bx-color'></i> Colour Assistant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 container text-center">
                                <div class="p-2 me-5 d-inline-block">
                                    <label for="colorInput" class="form-label text-start">Primary</label>
                                    <input type="color" id="colorInput"
                                    class="form-control form-control-color" name="colors[primary]">
                                </div>
                                <div class="p-2 d-inline-block">
                                    <label for="colorInput" class="form-label">Secondary</label>
                                    <input type="color" id="colorInput"
                                        class="form-control form-control-color" name="colors[secondary]">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="submitAssitant">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        Dropzone.autoDiscover = false;

        $(document).ready(function() {
            new Dropzone("#logoDropzone", {
                url: "{{ route('dashboard.upload_file') }}", // Ruta donde manejarás la carga de archivos
                paramName: "dropzone_image", // Nombre del campo de formulario para el archivo
                maxFilesize: 2, // Tamaño máximo en MB
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                uploadMultiple: false,
                maxFiles: 1,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
        });
    </script>
@endsection
