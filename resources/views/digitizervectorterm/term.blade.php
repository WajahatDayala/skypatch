<div class="bg-table rounded h-100 p-4 mt-4">
    <div class="row bg-info p-2">
        <h6 class="text-secondary text-center mb-0">For Digitzer's/Vector Teams</h1>
    </div>
    <table class="table table-bordered">
        <tbody>
            <tr class="row">
                <td class="col-4">
                    <strong># of Machine(s)</strong><br>
                    <span> {{ old('machine', $vectordetails->machine ?? '') }}</span>
                </td>
                <td class="col-4">
                    <strong>Condition</strong><br>
                    <span> {{ old('condition', $vectordetails->condition ?? '') }}</span>
                </td>
                <td class="col-4">
                    <strong># of Needles</strong><br>
                    <span> {{ old('needles', $vectordetails->needles ?? '') }}</span>
                </td>
            </tr>
            <tr class="row">
                <td class="col-4">
                    <strong>Thread</strong><br>
                    <span> {{ old('thread', $vectordetails->thread ?? '') }}</span>
                </td>
                <td class="col-4">
                    <strong>Needle Brand</strong><br>
                    <span> {{ old('needle_brand', $vectordetails->needle_brand ?? '') }}</span>
                </td>
                <td class="col-4">
                    <strong>Backing(Pique / Jersey)</strong><br>
                    <span> {{ old('backing_pique_jersey', $vectordetails->backing_pique_jersey ?? '') }}</span>
                </td>
            </tr>
            <tr class="row">
                <td class="col-4">
                    <strong>Brand</strong><br>
                    <span> {{ old('brand', $vectordetails->brand ?? '') }}</span>
                </td>
                <td class="col-4">
                    <strong>Backing (Cotton / Twill)</strong><br>
                    <span> {{ old('backing_cotton_twill', $vectordetails->backing_cotton_twill ?? '') }}</span>
                </td>
                <td class="col-4">
                    <strong>Backing (Cap)</strong><br>
                    <span> {{ old('backing_cap', $vectordetails->backing_cap ?? '') }}</span>
                </td>
            </tr>
            <tr class="row">
                <td class="col-4">
                    <strong>Model</strong><br>
                    <span> {{ old('model', $vectordetails->model ?? '') }}</span>
                </td>
                <td class="col-4">
                    <strong>Needle Number</strong><br>
                    <span> {{ old('needle_number', $vectordetails->needle_number ?? '') }}</span>
                </td>
                <td class="col-4">
                    <strong># of Heads</strong><br>
                    <span> {{ old('heads', $vectordetails->head ?? '') }}</span>
                </td>
            </tr>
            <tr class="row">
                <td class="col-4">
                    <strong>Comments</strong><br>
                    <span> {{ old('comments', $vectordetails->comment_box ?? '') }}</span>
                </td>

            </tr>
        </tbody>
    </table>    

  


</div>

</div>