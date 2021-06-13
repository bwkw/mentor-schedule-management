@extends('layouts.no_app')

@section('create')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
       
        
    
      
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js" 
        integrity="sha256-AdQN98MVZs44Eq2yTwtoKufhnU+uZ7v2kXnD5vqzZVo=" crossorigin="anonymous"></script>
    
    
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
    
    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js" 
        integrity="sha256-MAgcygDRahs+F/Nk5Vz387whB4kSK9NXlDN3w58LLq0=" crossorigin="anonymous"></script>
        
        <style type="text/css">
            .datepicker-days th.dow:first-child,
            .datepicker-days td:first-child {
                color: #f00;
            }
            .datepicker-days th.dow:last-child,
            .datepicker-days td:last-child {
                color: #00f;
            }
        </style>
        
    </head>
    
    <body>
        <div>
            
            <!-- 切り替えタブ部分 -->
            <ul class="nav nav-tabs nav-justified" role="tablist">
                <!-- 1つ目のタブ -->
                <li class="nav-item">
                    <a class="nav-link active" href="#meeting"
                        data-toggle="tab" role="tab">面談</a>
                </li>
                <!-- 2つ目のタブ -->
                <li class="nav-item">
                    <a class="nav-link" href="#event" 
                    data-toggle="tab" role="tab">イベント</a>
                </li>
            </ul>
            
            <div class="tab-content mt-4">
                <div class="tab-pane fade show active" id="meeting" role="tabpanel">
                    <div class="row">
                      
                        <div class="col-md-1">
                        </div>
                        
                        <div class="col-md-4 border">
                            <br>
                            <h2>面談予約</h2>
                            <br>
                            <div class="row">
                                <div class="col-md">
                                    <form action="/posts" method="POST">
                                        <div class="form-group">
                                            <label>氏名：</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>生徒氏名：</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>日程：</label>
                                            <div class="input-group date" id="datePicker" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" data-target="#atePicker"/>
                                                <div class="input-group-append" data-target="#datePicker" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center mt-8 mb-4">
                                            <button type="button" class="btn btn-secondary">送信</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-1">
                        </div>
                          
                        <div class="col-md-5" id="calendar">
                                
                        </div>
                        
                    </div>
                  </div>

                <div class="tab-pane fade" id="event"
                     role="tabpanel">
                    さようなら
                </div>
            </div>
        </div>
        
        <script src="{{ mix('js/Calendar/TimeGridView.js') }}"></script>
      
        <script type="text/javascript">
            $(function ()
                {
                    $('#datePicker').datetimepicker({
                        dayViewHeaderFormat: 'YYYY年 MM月',
                        format: 'YYYY/MM/DD',
                        locale: 'ja',
                        showClose: true
                });
            });
        </script>
      
    </body>
</html>
@endsection

@section('back')
<div class="col text-center mt-4 mb-4">
    <a href="/">
        <button type="button" class="btn btn-secondary">戻る</button>
    </a>
</div>
@endsection