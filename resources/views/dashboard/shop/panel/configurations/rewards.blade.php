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
                        <h5><i class='bx bx-gift'></i> Rewards</h5>
                        <hr>
                        <form id="rewards-frm"
                            action="{{ route('dashboard.shop.panel.configuration.rewards', ['shop' => $shop->subdomain]) }}"
                            class="p-3" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="mb-4">
                                <div class="form-floating mb-3">
                                    <select class="form-select" name="type" id="type-select" aria-label="Reward System"
                                        required>
                                        @foreach ($types as $type)
                                            <option value="{{ $type }}"
                                                {{ $type === $shop->type ? 'selected' : '' }}>{{ ucfirst($type) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="floatingSelect">Reward System <span class="required">*</span></label>
                                </div>

                                @if ($shop->type === 'level')
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" name="required_exp" id="required_exp"
                                            value="{{ $shop->config['required_exp'] ?? 1 }}" min="1" placeholder="1"
                                            required>
                                        <label for="required_exp">Required Exp Each Level <span
                                                class="required">*</span></label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" name="point_multiplier"
                                            id="point_multiplier" value="{{ $shop->config['point_multiplier'] ?? 1 }}"
                                            min="1" placeholder="1" autofocus required>
                                        <label for="point_multiplier">Points Multiplier <span
                                                class="required">*</span></label>
                                    </div>
                                @else
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" name="times_for_reward"
                                            id="times_for_reward" value="{{ $shop->config['times_for_reward'] ?? 5 }}"
                                            min="1" placeholder="5" required>
                                        <label for="times_for_reward">Times For Reward <span
                                                class="required">*</span></label>
                                    </div>
                                @endif
                            </div>

                            <div>
                                @if ($shop->type === 'level')
                                    <h5>Levels</h5>
                                    <div id="app">
                                        <table-component
                                            :shop-subdomain="{{ json_encode($shop->subdomain) }}"></table-component>
                                    </div>
                                @else
                                    <h5>Reward</h5>
                                    <div>
                                        <table class="table">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">Icon</th>
                                                    <th scope="col">Recompensa</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="form-floating mb-3">
                                                            <select class="form-select" aria-label="Loop Icon" name="loop_icon" id="loop_icon"
                                                                required>
                                                                <option value="bx bx-home">
                                                                    Home
                                                                </option>
                                                            </select>
                                                            <label for="floatingSelect">Loop Icon <span
                                                                    class="required">*</span></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-floating mb-3">
                                                            <input class="form-control" name="loop_reward"
                                                                id="loop_reward" placeholder="Coffe" required
                                                                value="{{ isset($shop->config['loop_reward']) ? $shop->config['loop_reward'] : '' }}">
                                                            <label for="loop_reward">Reward Name <span
                                                                    class="required">*</span></label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                @endif

                            </div>

                            <button class="btn btn-success" style="float: right;"><i class='bx bx-save'></i>
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
    $(document).ready(function() {
        $('#type-select').on('change', function () {
            $('#rewards-frm').submit();
        });
    });
</script>
@endsection
