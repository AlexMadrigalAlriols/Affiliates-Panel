<h5><i class='bx bx-cog'></i> General</h5>
<hr>
<form action="{{ route('dashboard.shop.update',  ['shop' => $shop->subdomain]) }}" method="POST" class="p-3" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="name-input" name="name" placeholder="Shop Name" value="{{$shop->name}}">
        <label for="name-input">Name <span class="text-danger">*</span></label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="subdomain-input" name="subdomain" placeholder="Shop Subdomain" value="{{$shop->subdomain}}">
        <label for="subdomain-input">Subdomain <span class="text-danger">*</span></label>
    </div>
    <div class="form-floating mb-3">
        <select class="form-select" name="currency_id" id="currency-select" aria-label="Floating label select example" >
          <option selected>Choose a Currency</option>
          @foreach ($currencies as $currency)
            <option value="{{$currency->id}}" {{($currency->id === $shop->currency_id ? 'selected' : '')}}>{{ ucfirst($currency->name) }} ({{$currency->symbol}})  </option>
          @endforeach
        </select>
        <label for="floatingSelect">Currency</label>
    </div>
    <div class="form-floating mb-3">
        <textarea class="form-control" placeholder="Description" id="description-input" name="description" style="height: 100px">{{ $shop->description ?? '' }}</textarea>
        <label for="floatingTextarea2">Description</label>
    </div>
    <div class="mb-3">
        <label for="image-input" class="form-label">Shop Logo</label>
        <input type="file" class="form-control" id="image-input">
    </div>

    <button class="btn btn-success" style="float: right;" type="submit"><i class='bx bx-save'></i> Save</button>
</form>
