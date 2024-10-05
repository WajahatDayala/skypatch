@extends('customer.quotes.base')
@section('action-content')


<div class=" container-fluid py-4 px-4">
                <div class="row g-4 d-flex align-items-center justify-content-center">
                    <div class="col-8">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Send Quotation</h6>
                            <form>
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-4 col-form-label text-end">Name/PO *</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" id="inputEmail3" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword3" class="col-sm-4 col-form-label text-end">Required Format
                                        *</label>
                                    <div class="col-sm-8">
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected class='text-gray'>Select Format</option>
                                            <option value="1">Sales</option>
                                            <option value="2">Support</option>
                                            <option value="3">Accounts</option>
                                            <option value="4">Degitizer Leader</option>
                                            <option value="5">Degitizer</option>
                                            <option value="6">Vector Artist Leader</option>
                                            <option value="7">Vector Artist</option>
                                            <option value="8">Quote Degitizer Leader</option>
                                            <option value="9">Quote Degitizer</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-4 col-form-label text-end">Height</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" id="inputEmail3">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-4 col-form-label text-end">Width</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" id="inputEmail3">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword3" class="col-sm-4 col-form-label text-end">Febric
                                        *</label>
                                    <div class="col-sm-8">
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected class='text-gray'>Select Febric</option>
                                            <option value="1">Sales</option>
                                            <option value="2">Support</option>
                                            <option value="3">Accounts</option>
                                            <option value="4">Degitizer Leader</option>
                                            <option value="5">Degitizer</option>
                                            <option value="6">Vector Artist Leader</option>
                                            <option value="7">Vector Artist</option>
                                            <option value="8">Quote Degitizer Leader</option>
                                            <option value="9">Quote Degitizer</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword3" class="col-sm-4 col-form-label text-end">Placement
                                        *</label>
                                    <div class="col-sm-8">
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected class='text-gray'>Select Placement</option>
                                            <option value="1">Sales</option>
                                            <option value="2">Support</option>
                                            <option value="3">Accounts</option>
                                            <option value="4">Degitizer Leader</option>
                                            <option value="5">Degitizer</option>
                                            <option value="6">Vector Artist Leader</option>
                                            <option value="7">Vector Artist</option>
                                            <option value="8">Quote Degitizer Leader</option>
                                            <option value="9">Quote Degitizer</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword3" class="col-sm-4 col-form-label text-end">Number of
                                        Colors</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" id="inputPassword3">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword3" class="col-sm-4 col-form-label text-end">Additional
                                        Instruction</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" placeholder="Leave a comment here"
                                            id="floatingTextarea" style="height: 150px;"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-4 col-form-label text-end">Select
                                        Files</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="file" id="formFileMultiple" multiple>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <legend class="col-form-label col-sm-4 pt-0 text-end">Super Urgent</legend>
                                    <div class="col-sm-8">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="gridCheck1">
                                            <label class="form-check-label" for="gridCheck1">
                                                Let us know if your order is super urgent!
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                    </div>
                                    <div class="col-sm-8">
                                        <button type="submit" class="btn btn-primary">Send Quote</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
 
 
@endsection