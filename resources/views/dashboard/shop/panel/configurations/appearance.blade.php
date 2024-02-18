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
                                <p class="h4">Your colours</p>
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
                                <div class="col-md-6">
                                    <select id="fontSelector" class="form-select mb-3 font-selector">
                                        <option value="Arial, sans-serif" data-font="Arial, sans-serif">Arial</option>
                                        <option value="Times New Roman, Times, serif" data-font="Times New Roman, Times, serif">Times New Roman</option>
                                        <option value="Verdana, Geneva, sans-serif" data-font="Verdana, Geneva, sans-serif">Verdana</option>
                                        <!-- Agrega más opciones según sea necesario -->
                                      </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="image-input" class="form-label">Logo</label>
                                <input type="file" class="form-control" id="image-input">
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
