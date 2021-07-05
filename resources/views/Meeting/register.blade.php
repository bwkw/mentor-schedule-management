@extends('layouts.app')

@section('content')

<link rel='stylesheet' href="{{asset('css/modal.css')}}">

<!-- jquery chosen用のファイル読み込み -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>

<script>
    $(function() {
        $(".chosen-select").chosen({  
            search_contains: true  ,
            no_results_text:"検索に該当する候補はありません"
        })  
    }); 
</script>

    <div class="mt-5">
        <div class="row">
            <div class="col-md-1">
            </div>  
            <div class="col-md-4 border">
                <br>
                <h2>面談予約</h2>
                <br>
                <div class="row">
                    <div class="col-md">
                        <form action="/meetings" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group mb-4">
                                <label>メンター氏名(slack)：</label>
                                <input type="input" class="form-control" name="meeting[mentor_name]" value="{{ $your_name }}" readonly>
                            </div>
                            <div class="form-group mb-4">
                                <label>生徒氏名(slack)：</label>
                                <select data-placeholder="選択してください" class="form-control chosen-select" name="meeting[student_name]" value="{{ old('meeting.student_name') }}">
                                    <option value="">選択してください</option>
                                    @foreach($students as $student)
                                        <option value="{{ $student->slack_name }}">{{ $student->slack_name }}</option>
                                    @endforeach
                                </select>
                                <p class="student_name__error" style="color:red">{{ $errors->first('meeting.student_name') }}</p>
                            </div>
                            <div class="form-group mb-4">
                                <label>面談形式：</label>
                                <select class="form-control" name="meeting[how_to]" value="{{ old('meeting.how_to') }}">
                                    <option value="">選択してください</option>
                                    <option value="対面">対面</option>
                                    <option value="オンライン">オンライン</option>
                                </select>
                                <p class="how_to__error" style="color:red">{{ $errors->first('meeting.how_to') }}</p>
                            </div>
                            <div class="form-group mb-4">
                                <label for="date" class="col-form-label">日付</label>
                                <input type="date" class="form-control" name="meeting[date]" value="{{ old('meeting.date') }}" id="date">
                                <p class="date__error" style="color:red">{{ $errors->first('meeting.date') }}</p>
                            </div>
                            <div class="form-group mb-4">
                                <label for="beginning_time" class="col-form-label">開始時間</label>
                                <input type="time" class="form-control" name="meeting[beginning_time]" value="{{ old('meeting.beginning_time') }}" id="beginning_time">
                                <p class="beginning_time__error" style="color:red">{{ $errors->first('meeting.beginning_time') }}</p>
                            </div>
                            <div class="form-group mb-4">
                                <label for="ending_time" class="col-form-label">終了時間</label>
                                <input type="time" class="form-control" name="meeting[ending_time]" value="{{ old('meeting.ending_time') }}" id="ending_time">
                                <p class="ending_time__error" style="color:red">{{ $errors->first('meeting.ending_time') }}</p>
                            </div>
                            
                            <!-- ユーザーidをリレーション用に格納 -->
                            <input type="hidden" name="meeting[user_id]" value="{{ Auth::user()->id }}">
                            
                            <div class="text-center mt-3 mb-2">
                                <button type="submit" class="btn btn-secondary">送信</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-md-1">
            </div>
              
            <div class="col-md-5" id="time_grid_view">
                    
            </div>
            
            <div class="col-md-1">
            </div>
        </div>
    
    <!-- モーダル表示部分 -->
    <div class="modal modal-background">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">イベント情報</h5>
            </div>
            <div class="modal-body">
          　     <div class="modal-body-time"></div>
          　     <div class="modal-body-title"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary modal-close" data-dismiss="modal">閉じる</button>
            </div>
        </div>
    </div>
    
    
    <div class="col text-center mt-4 mb-4">
        <a href="/">
            <button type="button" class="btn btn-secondary">戻る</button>
        </a>
    </div>
    
    <script src="{{ mix('js/Calendar/TimeGridView.js') }}"></script>
    <script src="{{ mix('js/Calendar/FetchMeetingSchedule.js') }}"></script>
    <script src="{{ mix('js/Calendar/FetchEventSchedule.js') }}"></script>
    
    
    
@endsection