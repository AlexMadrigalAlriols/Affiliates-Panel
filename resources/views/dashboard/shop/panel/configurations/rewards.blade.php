<h5><i class='bx bx-gift'></i> Rewards</h5>
<hr>
<form action="" class="p-3">
    <div class="form-floating mb-3">
        <select class="form-select" name="type" id="type-select" aria-label="Reward System" required>
          <option selected>Choose a Type</option>
          @foreach ($types as $type)
            <option value="{{$type}}" {{($type === $shop->currency_id ? 'selected' : '')}}>{{$type}}</option>
          @endforeach
        </select>
        <label for="floatingSelect">Reward System <span class="required">*</span></label>
    </div>
    <div class="form-floating mb-3">
        <input type="number" class="form-control" name="required_exp" id="required_exp" value="1" min="1" placeholder="1" autofocus required>
        <label for="ticket_import">Required Exp Each Level <span class="required">*</span></label>
    </div>

    <button class="btn btn-success" style="float: right;"><i class='bx bx-save'></i> Save</button>
</form>
