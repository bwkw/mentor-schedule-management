import $ from 'jquery';

$(function() {
    /* 面談を削除する */
    $('.meetingDeleteButton').click(function() {
        var meetingId = $(this).attr('id');
        if (confirm('削除すると復元が出来ません。\n本当に削除しますか？')) {
            $("#meetingDelete" + meetingId).submit();
        } else {
            return false;
        }
    });
    
    /* イベントを削除する */
    $('.eventDeleteButton').click(function() {
        var eventId = $(this).attr('id');
        if (confirm('削除すると復元が出来ません。\n本当に削除しますか？')) {
            $("#eventDelete" + eventId).submit();
        } else {
            return false;
        }
    });
});
