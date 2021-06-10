import $ from 'jquery';

/*
$(function()
{
    let MeetingData = "";
    $
    .ajax({
        url: '/meeting/data',
        type: 'get',
    })
    .then(// 1つめは通信成功時のコールバック
    function (data) {
        MeetingData = data;
    },
    function () {
        console.error("読み込み失敗");
    });

});
*/


const day=
{
    title: '打ち合わせ',
    start: '2021-06-09T15:15:00',
    end: '2021-06-09T16:00:00'
    
}

export default day;