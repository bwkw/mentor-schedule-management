import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import MeetingDate from './MeetingScheduleGet';
import EventDate from './EventScheduleGet';
import $ from 'jquery';

document.addEventListener('DOMContentLoaded', function(){
  var calendarEl = document.getElementById('month_view');
  
  var calendar = new Calendar(calendarEl, {
    //初期設定
    plugins: [ dayGridPlugin ],
    initialView: 'dayGridMonth',
    
    //イベントの編集可能に可能に
    editable: true,
    
    // カレンダーに表示する文字の言語選択
    locale: 'ja',
    
    // カレンダー上のツールバーのボタン配置
    headerToolbar: {
      left: 'prev',
      center: 'title',
      right: 'today next',
    },
    
    //カレンダーの表示から"日"を削除
    dayCellContent: function(e) {
        e.dayNumberText = e.dayNumberText.replace('日', '');
      },
      
    // 面談・イベント日程の追加（配列を合体）
    events:
      MeetingDate.concat(EventDate),
    
    // イベントがクリックされた時、Modal関数を呼ぶ
    eventClick: function(info) {
      info.jsEvent.preventDefault();
      Modal(info);
    },
    
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