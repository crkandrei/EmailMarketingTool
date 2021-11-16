@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="ms-content-wrapper">
        <div class="row">

            <div class="col-md-12">
                <div class="ms-panel">
                    <div class="row pl-4 pt-4 pr-4">

                        <div class="col-md-6">
                            <h6>Templates</h6>
                            <p class="text-black"> Add, Edit, Delete Templates </p>
                        </div>

                        <div class="col-md-6">
                            <button type="button" class="btn btn-outline-success ms-graph-metrics float-right"  data-toggle="modal" data-target="#modal_add" name="button">
                                Add
                            </button>
                        </div>

                    </div>
                    <div class="ms-panel-body pl-4 pt-4 pr-4">
                        <div class="table-responsive">
                            <table id="table_templates" class="table w-100 thead-primary"></table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="modal-10">
                <div class="modal-dialog modal-dialog-centered modal-min" role="document">
                    <div class="modal-content">

                        <div class="modal-body text-center">

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                            <h1>Template</h1>

                            <form class="clearfix pt-4" id="form_add" novalidate>
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <div class="input-group">
                                            <input onkeypress="return event.keyCode != 13;" type="text" class="form-control" id="form_add_first_name" name="form_add_first_name" placeholder="First Name" value="" required>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <button class="btn btn-success d-block float-right" id="form_add_submit">Add</button>

                        </div>

                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="modal-10">
                <div class="modal-dialog modal-dialog-centered modal-min" role="document">
                    <div class="modal-content">

                        <div class="modal-body text-center">

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                            <h1>Template</h1>

                            <form class="clearfix pt-4" id="form_edit" action="#" novalidate>
                                @csrf
                                <input onkeypress="return event.keyCode != 13;" type="hidden" name="form_edit_id" id="form_edit_id" />
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <div class="input-group">
                                            <input onkeypress="return event.keyCode != 13;" type="text" class="form-control" id="form_edit_first_name" name="form_edit_first_name" placeholder="First Name" value="" required>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <button class="btn btn-warning d-block float-right" id="form_edit_submit">Edit</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="modal-10">
                <div class="modal-dialog modal-dialog-centered modal-min" role="document">
                    <div class="modal-content">

                        <div class="modal-body text-center">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h1>Customer</h1>
                            <form class="clearfix pt-4" id="form_delete" action="#" novalidate>
                                @csrf

                                <input onkeypress="return event.keyCode != 13;" type="hidden" name="form_delete_id" id="form_delete_id" />

                                <p><span class="icon icon-warning-sign"></span>
                                    <?php echo "The customer will be deleted. Are you sure?"; ?>
                                </p>

                            </form>

                            <button class="btn btn-danger d-block float-right" id="form_delete_submit">Delete</button>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('scripts/pages/script-customer.js') }}"></script>
    <script src="{{ asset('scripts/libs/customer.js') }}"></script>
@endsection
