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
                            <h2>Dashboard :</h2>
                        </div>

                    </div>
                    <div class="ms-panel-body pl-4 pt-4 pr-4 row">
                        <div class="col-md-4">
                            <div class="input-group">
                                <select class="form-control" id="form_group_id" name="form_group_id">
                                    @php
                                        echo("<option value='' disabled selected>Select Group</option>");
                                        foreach ($groups as $group) {
                                            echo("<option value='".$group->id."'>".$group->name."</option>");
                                        }

                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <select class="form-control" id="form_template_id" name="form_template_id">
                                    @php
                                        echo("<option value='' disabled selected>Select Template</option>");
                                        foreach ($templates as $template) {
                                            echo("<option value='".$template->id."'>".$template->name."</option>");
                                        }

                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-outline-success ms-graph-metrics" id="send_mass_email" name="send_mass_email">
                                Send Mass Email
                            </button>
                        </div>
                    </div>

                    <div class="ms-panel-body pl-4 pt-4 pr-4 row">
                        <div class="col-md-4">
                            <label class="mr-3">Select Birth Date : </label>
                            <input type="datetime-local" id="form_date" name="form_date"
                                   value=""
                                   min="2021-10-10">
                        </div>

                        <div class="col-md-4">
                        </div>

                        <div class="col-md-4">
                            <button type="button" class="btn btn-outline-success ms-graph-metrics" id="schedule_mass_email" name="schedule_mass_email">
                                Schedule Mass Email
                            </button>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('scripts/pages/script-dashboard.js') }}"></script>
    <script src="{{ asset('scripts/libs/dashboard.js') }}"></script>
@endsection
