<div class="modal fade" id="addPartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-darkLaravel">
            <div class="modal-header laravelRed">
                <h5 class="modal-title" id="exampleModalLabel">Add new {{ $parttype }}</h5>
                </button>
            </div>
            <div class="modal-body">
                @php
                    //get the first product of the current parttype
                    $product = \App\Models\Parts::where('FKPartTypeID', $c->FKPartTypeID)->first();
                @endphp
                        <!-- echo the name of the product, brand and price and stock of the product as a text field -->
                <div class="form-group">
                    <label for="partName">Part name</label>
                    <input type="text" class="form-control" id="partName" name="partName" value="">
                </div>
                <div class="form-group">
                    <label for="partBrand">Part brand</label>
                    <!-- make a dropdown with all the brands -->
                    <select class="form-control" id="partBrand" name="partBrand">
                        @foreach($brands as $b)
                            <option value="{{$brand->Name}}">{{$brand->Name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="partPrice">Part price</label>
                    <input type="text" class="form-control" id="partPrice" name="partPrice" value="">
                </div>
                <div class="form-group">
                    <label for="partStock">Part stock</label>
                    @php if ($c->FKPartTypeID == 10) $c->Stock = 'N/A';
                    $disabled = ($c->Stock == 'N/A') ? 'disabled' : '';
                    @endphp
                            <!-- make input type text disabled if the stock is N/A -->
                    <input type="text" class="form-control" id="partStock" name="partStock"
                           value="N/A" <?php echo $disabled ?>>
                </div>
                @php
                    $specs = $product->Specifications;
                    $specs = json_decode($specs);
                    foreach ($specs as $key => $value) { @endphp
                <div class="form-group">
                    <label for="partSpecs">{{$key}}</label>
                    <input type="text" class="form-control" id="partSpecs" name="partSpecs" value="">
                </div>
                @php } @endphp
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
