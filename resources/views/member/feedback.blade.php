
@extends('member.template.member_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                {{-- <div class="col-md-2"></div> --}}
                <div class="col-md-12" style="margin-top:50px;">
                  {{ Helper::Status() }}
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Feedback/Complaint</h2>
                            <div class="clearfix"></div>
                        </div>
                    <div>
                    </div>
                        <div>
                            <div class="x_content">
                                
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-2"></div> --}}
        </div>
</div>
<!-- /page content -->
@endsection



