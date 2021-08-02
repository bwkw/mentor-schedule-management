var $ = jQuery.noConflict();

$(function() {
    $(".chosen-select").chosen({  
        search_contains: true,
        no_results_text: "検索に該当する候補はありません"
    });
});
