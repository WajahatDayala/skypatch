@extends('customer.quotes.base')
@section('action-content')

       <!-- All Content Goes inside this div -->
       <div class=" container-fluid py-4 px-4">
                <div class="row g-4 d-flex align-items-center justify-content-center">
                    <div class="col-12">
                        <div class="bg-table rounded h-100 p-4">
                            <div class="row mb-4">
                                <div class="col-6 d-flex justify-content-start align-items-center">
                                    <h6 class="h6 mb-0">Quote Details</h6>
                                </div>
                                <div class="col-6 d-flex align-items-center justify-content-end">
                                    <button type="button"
                                        class="btn btn-sm btn-primary rounded-pill me-2">Print</button>
                                    <button type="button" class="btn btn-sm btn-dark rounded-pill ">Process</button>
                                </div>
                            </div>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr class="row">
                                        <td class="col-3">
                                            <strong>Quote Number</strong><br>
                                            <span>QT-{{$quote->order_id}}</span>
                                        </td>
                                        <td class="col-3">
                                            <strong>Status</strong><br>
                                            <span>Processing</span>
                                        </td>
                                        <td class="col-3">
                                            <strong>Release Date</strong><br>
                                            <span>25-12-2023</span>
                                        </td>
                                        <td class="col-3">
                                            <strong>Received Date</strong><br>
                                            <span>22-12-2023</span>
                                        </td>
                                    </tr>
                                    <tr class="row">
                                        <td class="col-3">
                                            <strong>Design Name/PO</strong><br>
                                            <span>Name of the design</span>
                                        </td>
                                        <td class="col-3">
                                            <strong>Height</strong><br>
                                            <span>12"</span>
                                        </td>
                                        <td class="col-3">
                                            <strong>Width</strong><br>
                                            <span>8"</span>
                                        </td>
                                        <td class="col-3">
                                            <strong>Price</strong><br>
                                            <span>$1234</span>
                                        </td>
                                    </tr>
                                    <tr class="row">
                                        <td class="col-3">
                                            <strong>Format</strong><br>
                                            <span>psd</span>
                                        </td>
                                        <td class="col-3">
                                            <strong>Fabric</strong><br>
                                            <span>Cotton</span>
                                        </td>
                                        <td class="col-3">
                                            <strong>Number of Colors</strong><br>
                                            <span>3</span>
                                        </td>
                                        <td class="col-3">
                                            <strong>Placement</strong><br>
                                            <span>Chest</span>
                                        </td>
                                    </tr>
                                    <tr class="row">
                                        <td class="col-3">
                                            <strong>Stitches</strong><br>
                                            <span>psd</span>
                                        </td>
                                        <td class="col-3">
                                            <strong>Customer Nick</strong><br>
                                            <span>John Doe</span>
                                        </td>
                                    </tr>
                                    <tr class="row">
                                        <td class="col-6">
                                            <strong class="">Customer Instruction</strong><br>
                                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Asperiores,
                                                obcaecati provident, ipsam doloribus rem sit minima magni, enim
                                                reprehenderit et quam nulla quisquam similique unde sed quod at debitis
                                                iure. <button type="button"
                                                    class="btn btn-sm rounded-pill btn-primary m-2">Update</button></p>
                                        </td>
                                        <td class="col-6">
                                            <strong>Admin Instruction</strong><br>
                                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Asperiores,
                                                obcaecati provident, ipsam doloribus rem sit minima magni, enim
                                                reprehenderit et quam nulla quisquam similique unde sed quod at debitis
                                                iure.
                                                <button type="button"
                                                    class="btn btn-sm rounded-pill btn-primary m-2">Update</button>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr class="row">
                                        <td class="col-3">
                                            <h6>
                                                <strong><a href="" class="text-danger" data-bs-toggle="modal"
                                                        data-bs-target="#Designer">Not Assigned</a></strong><br>
                                                <strong class="text-info"><a href="" data-bs-toggle="modal"
                                                        data-bs-target="#Designer">Assigned</a></strong><br>
                                            </h6>
                                            <p>John Doe</p>
                                        </td>
                                        <td class="col-3">
                                            <h6>
                                                <strong>Order Status</strong><br>
                                            </h6>
                                            <p class="mb-2">New |
                                                <button type="button"
                                                    class="btn btn-sm rounded-pill btn-dark ms-2">Update</button>
                                            </p>
                                            <p class="mb-0">Reason |
                                                <button type="button" class="btn btn-sm rounded-pill btn-primary"
                                                    data-bs-toggle="modal" data-bs-target="#Reason">
                                                    Reason Not Specified
                                                </button>
                                            </p>
                                        </td>
                                        <td class="col-6">
                                            <strong>Files</strong><br>
                                            <span class="text-info">QT-54325-filename.psd | <button type="button"
                                                    class="btn btn-sm rounded-pill btn-danger m-2">Delete</button></span><br>
                                            <span class="text-info">QT-54325-filename.psd | <button type="button"
                                                    class="btn btn-sm rounded-pill btn-danger m-2">Delete</button></span><br>
                                            <span class="text-info">QT-54325-filename.psd | <button type="button"
                                                    class="btn btn-sm rounded-pill btn-danger m-2">Delete</button></span><br>
                                            <button type="button" class="btn btn-sm rounded-pill btn-primary m-2">Attech
                                                Files</button>
                                        </td>
                                    </tr>
                                    <tr class="row">
                                        <td class="col-6">
                                            <strong class="">Option A</strong><br>
                                        </td>
                                        <td class="col-6">
                                            <strong>Option B</strong><br>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- Modal for Reason -->
                            <div class="modal fade" id="Reason" tabindex="-1" aria-labelledby="ReasonLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ReasonLabel">Reasons</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="">
                                                <div class="row mb-3">
                                                    <label for="reasonSelect"
                                                        class="col-sm-4 col-form-label text-end">Select Reason *</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-select" id="reasonSelect"
                                                            aria-label="Default select example">
                                                            <option selected class='text-gray'>Select Format</option>
                                                            <option value="1">Sales</option>
                                                            <option value="2">Support</option>
                                                            <option value="3">Accounts</option>
                                                            <option value="4">Digitizer Leader</option>
                                                            <option value="5">Digitizer</option>
                                                            <option value="6">Vector Artist Leader</option>
                                                            <option value="7">Vector Artist</option>
                                                            <option value="8">Quote Digitizer Leader</option>
                                                            <option value="9">Quote Digitizer</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal for Edit Reason Ends Here -->

                            <!-- Modal for Edit Designer Start Here -->
                            <div class="modal fade" id="Designer" tabindex="-1" aria-labelledby="DesignerLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="DesignerLabel">Designer Assignment</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="">
                                                <div class="row mb-3">
                                                    <label for="designerSelect"
                                                        class="col-sm-4 col-form-label text-end">Select Designer
                                                        *</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-select" id="designerSelect"
                                                            aria-label="Default select example">
                                                            <option selected class='text-gray'>Select Designer</option>
                                                            <option value="1">Designer 1</option>
                                                            <option value="2">Designer 2</option>
                                                            <option value="3">Designer 3</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal for Edit Designer Ends Here -->

                        </div>

                        <div class="bg-table rounded h-100 p-4 mt-4">
                            <div class="row bg-info p-2">
                                <h6 class="text-secondary text-center mb-0">For Digitzer's/Vector Teams</h1>
                            </div>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr class="row">
                                        <td class="col-4">
                                            <strong># of Machine(s)</strong><br>
                                            <span>Lorem</span>
                                        </td>
                                        <td class="col-4">
                                            <strong>Condition</strong><br>
                                            <span>Lorem</span>
                                        </td>
                                        <td class="col-4">
                                            <strong># of Needles</strong><br>
                                            <span>Lorem</span>
                                        </td>
                                    </tr>
                                    <tr class="row">
                                        <td class="col-4">
                                            <strong>Thread</strong><br>
                                            <span>Lorem</span>
                                        </td>
                                        <td class="col-4">
                                            <strong>Needle Brand</strong><br>
                                            <span>Lorem</span>
                                        </td>
                                        <td class="col-4">
                                            <strong>Backing(Pique / Jersey)</strong><br>
                                            <span>lorem</span>
                                        </td>
                                    </tr>
                                    <tr class="row">
                                        <td class="col-4">
                                            <strong>Brand</strong><br>
                                            <span>psd</span>
                                        </td>
                                        <td class="col-4">
                                            <strong>Backing (Cotton / Twill)</strong><br>
                                            <span>Lorem</span>
                                        </td>
                                        <td class="col-4">
                                            <strong>Backing (Cap)</strong><br>
                                            <span>Lorem</span>
                                        </td>
                                    </tr>
                                    <tr class="row">
                                        <td class="col-4">
                                            <strong>Backing</strong><br>
                                            <span>Lorem</span>
                                        </td>
                                        <td class="col-4">
                                            <strong>Needle Number</strong><br>
                                            <span>Lorem</span>
                                        </td>
                                        <td class="col-4">
                                            <strong># of Heads</strong><br>
                                            <span>Lorem</span>
                                        </td>
                                    </tr>
                                    <tr class="row">
                                        <td class="col-4">
                                            <strong>Comments</strong><br>
                                            <span>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Magni
                                                possimus perspiciatis ad dicta, incidunt accusamus. Voluptatibus, veniam
                                                laboriosam! Vitae, iure.</span>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>

                            <!-- Modal for Reason -->
                            <div class="modal fade" id="Reason" tabindex="-1" aria-labelledby="ReasonLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ReasonLabel">Reasons</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="">
                                                <div class="row mb-3">
                                                    <label for="reasonSelect"
                                                        class="col-sm-4 col-form-label text-end">Select Reason *</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-select" id="reasonSelect"
                                                            aria-label="Default select example">
                                                            <option selected class='text-gray'>Select Format</option>
                                                            <option value="1">Sales</option>
                                                            <option value="2">Support</option>
                                                            <option value="3">Accounts</option>
                                                            <option value="4">Digitizer Leader</option>
                                                            <option value="5">Digitizer</option>
                                                            <option value="6">Vector Artist Leader</option>
                                                            <option value="7">Vector Artist</option>
                                                            <option value="8">Quote Digitizer Leader</option>
                                                            <option value="9">Quote Digitizer</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal for Edit Reason Ends Here -->

                            <!-- Modal for Edit Designer Start Here -->
                            <div class="modal fade" id="Designer" tabindex="-1" aria-labelledby="DesignerLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="DesignerLabel">Designer Assignment</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="">
                                                <div class="row mb-3">
                                                    <label for="designerSelect"
                                                        class="col-sm-4 col-form-label text-end">Select Designer
                                                        *</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-select" id="designerSelect"
                                                            aria-label="Default select example">
                                                            <option selected class='text-gray'>Select Designer</option>
                                                            <option value="1">Designer 1</option>
                                                            <option value="2">Designer 2</option>
                                                            <option value="3">Designer 3</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal for Edit Designer Ends Here -->

                        </div>
                    </div>
                </div>
            </div>
            <!-- Content Div Ends here End -->

 
 
@endsection