import { Calendar } from '@fullcalendar/core';
import timeGridPlugin from '@fullcalendar/timegrid';
import MeetingDate from './MeetingScheduleGet';
import EventDate from './EventScheduleGet';
import $ from 'jquery';

document.addEventListener('DOMContentLoaded', function(){
  var calendarEl = document.getElementById('time_grid_view');
  
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
        titleFormat: function (date) {
          const startMonth = date.start.month + 1;
          const endMonth = date.end.month + 1;
    
          // 1週間のうちに月をまたぐかどうかの分岐処理
          if (startMonth === endMonth) {
             return startMonth + '月';
          } else {
             return startMonth + '月～' + endMonth + '月'; 
          }
        },
        
        // カレンダーの日付と曜日部分をカスタム
        dayHeaderFormat: function (date) {
          const day = date.date.day;
          const weekNum = date.date.marker.getDay();
          const week = ['(日)', '(月)', '(火)', '(水)', '(木)', '(金)', '(土)'][weekNum];
    
          return day + ' ' + week;
        },
        
        //表示時間を10:00:00〜22:00:00にする
        slotMinTime: '10:00:00',
        slotMaxTime: '22:00:00'
  
      }
    },
    
    // 現在時刻を可視化
    nowIndicator: true,
    
    // 表示の時間区切りを10分毎にする
    slotDuration: '00:10:00',

    // 面談・イベント日程の追加（配列を合体）
    events:
      MeetingDate.concat(EventDate),
    
    // イベントがクリックされた時、Modal関数を呼ぶ
    eventClick: function(info) {
      info.jsEvent.preventDefault();
      Modal(info);
    },
    
    // 面談と他のイベントの色を区別する
    eventDidMount: function (info) {
      if (info.event.title.match(/面談/)){
        info.el.style.background='#6699FF';
        info.el.style.border='#6699FF';
      }else{
        info.el.style.background='#FFCC00';
        info.el.style.border='#FFCC00';
      }
    }
  });
  
  // イベントクリック時にモーダルを表示する
  function Modal(info) {
      $('.modal').fadeIn();
      $('.modal-body-title').html(info.event.title);
  };
    
  // モーダルのCloseボタンを押した時に、モーダルを非表示にする
  $('.modal-close').on('click',function(){
      $('.modal').fadeOut();
  });
  
  

  //キャンバスにレンダリング
  calendar.render();
});

