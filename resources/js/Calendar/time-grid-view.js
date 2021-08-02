import $ from 'jquery';
import { Calendar } from '@fullcalendar/core';
import timeGridPlugin from '@fullcalendar/timegrid';
import eventDetails from './fetch-event-schedule';
import meetingDetails from './fetch-meeting-schedule';


var beginningDatetime = "";
var endingDatetime = "";
var beginningTime = "";
var endingTime = "";
var time = "";

/**
 * タイムグリッド形式のカレンダー作成
 */
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('timeGridView');
  
    var calendar = new Calendar(calendarEl, {
      
        // 初期設定
        plugins: [ timeGridPlugin ],
        initialView: 'timeGridWeek',
    
        // イベントの編集可能に可能に
        editable: true,
    
        // カレンダーに表示する文字の言語選択
        locale: 'ja',
    
        // カレンダー上のツールバーのボタン配置
        headerToolbar: {
            left: 'prev',
            center: 'title',
            right: 'today next',
        },
    
        // カレンダーの見出しの文言から月を削除し、日にちだけに
        views: {
            timeGridWeek: {
                titleFormat: function(date) {
                    var startMonth = date.start.month + 1;
                    var endMonth = date.end.month + 1;
        
                    // 1週間のうちに月をまたぐかどうかの分岐処理
                    if (startMonth === endMonth) {
                        return startMonth + '月';
                    } else {
                        return startMonth + '月～' + endMonth + '月'; 
                    }
                },
            
                // カレンダーの日付と曜日部分をカスタム
                dayHeaderFormat: function(date) {
                    var day = date.date.day;
                    var weekNum = date.date.marker.getDay();
                    var week = ['(日)', '(月)', '(火)', '(水)', '(木)', '(金)', '(土)'][weekNum];
            
                    return day + ' ' + week;
                },
            
                // カレンダーの表示時間を12:00:00〜22:00:00にする
                slotMinTime: '12:00:00',
                slotMaxTime: '22:00:00'
            }
        },
    
        // 現在時刻を可視化
        nowIndicator: true,
        
        // 表示の時間区切りを10分毎にする
        slotDuration: '00:10:00',
    
        // 面談・イベント日程の追加
        events:
            meetingDetails.concat(eventDetails),
        
        /**
         * イベントがクリックされた時、Modal関数を呼ぶ
         */ 
        eventClick: function(info) {
            info.jsEvent.preventDefault();
            Modal(info);
        },
        
        /**
         * 面談と他のイベントの色を区別する
         */
        eventDidMount: function (info) {
            if (info.event.title.match(/面談/)){
              info.el.style.background='#6699FF';
              info.el.style.border='#6699FF';
            } else {
              info.el.style.background='#FFCC00';
              info.el.style.border='#FFCC00';
            }
        }
    });
  
    /**
     * イベントクリック時にモーダルを表示する
     */
    function Modal(info) {
        $('.modal').fadeIn();
      
        // イベントの時間とタイトルを取得
        beginningDatetime = info.event.start.toString();
        endingDatetime = info.event.end.toString();
        beginningTime = beginningDatetime.match(/\d{2}:\d{2}:\d{2}/)[0];
        endingTime = endingDatetime.match(/\d{2}:\d{2}:\d{2}/)[0];
        time = beginningTime + "~" + endingTime;
        $('.modal-body-time').html(time);
        $('.modal-body-title').html(info.event.title);
    };
    
    /**
     * モーダルのCloseボタンを押した時に、モーダルを非表示にする
     */ 
    $('.modal-close').on('click', function() {
        $('.modal').fadeOut();
    });

    //キャンバスにレンダリング
    calendar.render();
});
