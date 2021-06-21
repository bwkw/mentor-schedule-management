import $ from 'jquery';


//dataに面談日を格納する(ajaxでデータを取得する)
let data = "";

//ajaxで取得したデータを加工するための変数定義
let MeetingDate =[];
let student_name = "";
let date = "";
let beginning_time = "";
let ending_time = "";
let meeting_date = "";

//ajaxで取得したデータをグローバル変数として使うための関数を定義
function set_meeting_data(x){
    data = x;
}

//ajaxでデータを取得する
$.ajax({
    type: "GET",
    url: "/meetings",
    async: false,
    success : function(data) {
        set_meeting_data(data)
    }
});

//ajaxで取得したデータを加工する
for (let i = 0; i < data.length; i++) {
    student_name = data[i]["student_name"];
    date = data[i]["date"];
    beginning_time = data[i]["beginning_time"];
    ending_time = data[i]["ending_time"];
    meeting_date = 
        {
            title:`${student_name}との面談`,
            start: `${date}T${beginning_time}`,
            end: `${date}T${ending_time}`
        }
    MeetingDate.push(meeting_date);
 }
 

export default MeetingDate;

/*
const day=
[{
    title: '打ち合わせ',
    start: '2021-06-09T15:15:00',
    end: '2021-06-09T16:00:00'
},
{
    title: '打ち合わせ',
    start: '2021-06-09T15:15:00',
    end: '2021-06-09T16:00:00'
}]

export default day;
*/