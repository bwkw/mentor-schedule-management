import $ from 'jquery';


// dataにイベント日を格納する(ajaxでデータを取得する)
let data = "";

// ajaxで取得したデータを加工するための変数定義
let EventDate =[];
let event_name = "";
let date = "";
let starting_time = "";
let ending_time = "";
let event_date = "";

//ajaxで取得したデータをグローバル変数として使うための関数を定義
function set_event_data(x){
    data = x;
}

//ajaxでデータを取得する
$.ajax({
    type: "GET",
    url: "/events",
    async: false,
    success : function(data) {
        set_event_data(data)
    }
});

//ajaxで取得したデータを加工する
for (let i = 0; i < data.length; i++) {
    event_name = data[i]["event_name"];
    date = data[i]["date"];
    starting_time = data[i]["starting_time"];
    ending_time = data[i]["ending_time"];
    event_date = 
        {
            title:`${event_name}`,
            start: `${date}T${starting_time}`,
            end: `${date}T${ending_time}`
        }
    EventDate.push(event_date);
 }
 

export default EventDate;