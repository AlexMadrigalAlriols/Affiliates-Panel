<h5><i class='bx bx-palette'></i> Apparence</h5>
<hr>
<form action="" class="p-3">
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="name-input" placeholder="Shop Name" value="{{$shop->name}}">
        <label for="name-input">Name <span class="text-danger">*</span></label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="subdomain-input" placeholder="Shop Subdomain" value="{{$shop->subdomain}}">
        <label for="subdomain-input">Subdomain <span class="text-danger">*</span></label>
    </div>
    <div class="form-floating mb-3">
        <textarea class="form-control" placeholder="Description" id="description-input" style="height: 100px"></textarea>
        <label for="floatingTextarea2">Description</label>
    </div>
    <div class="mb-3">
        <label for="image-input" class="form-label">Shop Logo</label>
        <input type="file" class="form-control" id="image-input">
    </div>


    <button class="btn btn-success" style="float: right;"><i class='bx bx-save'></i> Save</button>
</form>
