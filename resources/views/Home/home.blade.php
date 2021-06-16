@extends('layouts.app')

@section('content')
    <link rel='stylesheet' href="{{asset('css/home.css')}}">
    <link rel='stylesheet' href="{{asset('css/modal.css')}}">

    <div>
        <div class="row mt-5">
            <div class="col-md-1">
            </div>
            
            <div class="col-md-4">
                <h3><a href="/meetings/register">面談の登録</a></h3>
                <h3><a href="/events/register">イベントの登録</a></h3>
            </div>
            
            <div class="col-md-1">
            </div>
            
            <div class="col-md-5" id="month_view">
                
            </div>
            
            <div class="col-md-1">
            </div>
        </div>
    </div>
    
    <div class="modal modal-background">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">面談予約</h5>
            </div>
            <div class="modal-body">
          　    <div class="modal-body-start-time"></div>
          　    <div class="modal-body-end-time"></div>
          　    <div class="modal-body-title"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary modal-close" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>

    <script src="{{ mix('js/Calendar/MonthView.js') }}"></script>

@endsection
