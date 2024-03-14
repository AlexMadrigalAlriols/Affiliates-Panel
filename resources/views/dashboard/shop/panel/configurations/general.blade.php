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
                        <h5><i class='bx bx-cog'></i> General</h5>
                        <hr>
                        <form action="{{ route('dashboard.shop.update', ['shop' => $shop->subdomain]) }}" method="POST"
                            class="p-3" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="name-input" name="name"
                                    placeholder="Shop Name" value="{{ $shop->name }}">
                                <label for="name-input">Name <span class="text-danger">*</span></label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="subdomain-input" name="subdomain"
                                    placeholder="Shop Subdomain" value="{{ $shop->subdomain }}">
                                <label for="subdomain-input">Subdomain <span class="text-danger">*</span></label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" name="currency_id" id="currency-select"
                                    aria-label="Floating label select example">
                                    <option selected>Choose a Currency</option>
                                    @foreach ($currencies as $currency)
                                        <option value="{{ $currency->id }}"
                                            {{ $currency->id === $shop->currency_id ? 'selected' : '' }}>
                                            {{ ucfirst($currency->name) }} ({{ $currency->symbol }}) </option>
                                    @endforeach
                                </select>
                                <label for="floatingSelect">Currency</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Description" id="description-input" name="description"
                                    style="height: 100px">{{ $shop->description ?? '' }}</textarea>
                                <label for="floatingTextarea2">Description</label>
                            </div>

                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="shop_banner">Actual Banner:</label>
                                    <img src="{{ isset($shop->config['banner_img']) ? asset($shop->config['banner_img']) : asset('img/errors/404.png') }}" alt="shop_banner" id="shop_banner" width="200px">
                                </div>
                                <div class="col-md-9 mb-3">
                                    <label for="bannerDropzone">Upload Banner:</label>
                                    <div class="dropzone" id="bannerDropzone">
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
@endsection

@section('scripts')
    <script>
        Dropzone.autoDiscover = false;

        $(document).ready(function() {
            new Dropzone("#bannerDropzone", {
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
