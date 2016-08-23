// 復習ページのJavaScript

var selected = [];
$('.check').click(function() {
    if ($(this).prop('checked') == false) {
        selected.splice(selected.indexOf($(this).siblings('.id').text() - 0), 1);
        console.log(selected);
    } else {
        selected.push($(this).siblings('.id').text() - 0);
        console.log(selected);
    }
});

$('.deleteSelectedProblems').click(function() {
    $.ajax({
        type: "POST",
        url: "index.php?controller=session&action=deleteSelectedProblems",
        timeout: 10000,
        data: {
            selected: JSON.stringify(selected)
        }
    }).fail(function(){
        alert("削除に失敗しました");
    });
    $('.problem').each(function() {
        if (selected.indexOf($(this).data('id')) != -1) {
            $(this).css('display', 'none');
        }
    });
    selected = [];
});

$('.deleteIncorrectProblems').click(function() {
    $.ajax({
        type: "POST",
        url: "index.php?controller=session&action=deleteIncorrectProblems",
        timeout: 10000,
        data: {
            incorrect: JSON.stringify(selected)
        }
    }).done(function(){
        alert("削除しました");
    }).fail(function(){
        alert("削除に失敗しました");
    });
    $('.problem').each(function() {
        if (selected.indexOf($(this).data('id')) != -1) {
            $(this).css('display', 'none');
        }
    });
    selected = [];
});
