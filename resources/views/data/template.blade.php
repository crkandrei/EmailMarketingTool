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
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h1>Template</h1>

                            <div class="form-row">
                                <div class="col-md-3">
                                    <label for="exampleInputEmail1">Select the placeholder</label>
                                </div>
                                <div class="col-md-7">
                                    <select class="form-control" style="width: 100%" id="form_add_placeholder" name="form_add_placeholder">
                                        <option value="" disabled>Select Placeholder..</option>
                                        <option value="first_name">First Name</option>
                                        <option value="last_name">Last Name</option>
                                        <option value="email">Email</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-success d-block float-right" id="form_add_button">Add</button>
                                </div>
                            </div>
                            <div class="alert alert-primary mt-2" role="alert">
                                Press the ADD button and the selected placeholder will be added on your cursor position.
                            </div>
                            <form class="clearfix pt-3" id="form_add" novalidate>
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <div class="input-group">
                                            <input onkeypress="return event.keyCode != 13;" type="text" class="form-control" id="form_add_name" name="form_add_name" placeholder="Template Name" value="" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <div class="input-group">
                                          <textarea class="form-control" id="form_add_subject" name="form_add_subject" rows="2" cols="50">Complete the subject !</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <div class="input-group">
                                          <textarea class="form-control" id="form_add_message" name="form_add_message" rows="15" cols="50">Complete the text!</textarea>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <button class="btn btn-success d-block float-right" id="form_add_submit">Submit template</button>

                        </div>

                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="modal-10">
                <div class="modal-dialog modal-dialog-centered modal-min" role="document">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h1>Template</h1>
                            <form class="clearfix pt-4" id="form_delete" action="#" novalidate>
                                @csrf

                                <input onkeypress="return event.keyCode != 13;" type="hidden" name="form_delete_id" id="form_delete_id" />

                                <p><span class="icon icon-warning-sign"></span>
                                    <?php echo "The template will be deleted. Are you sure?"; ?>
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
    <script src="{{ asset('scripts/pages/script-template.js') }}"></script>
    <script src="{{ asset('scripts/libs/template.js') }}"></script>
@endsection
