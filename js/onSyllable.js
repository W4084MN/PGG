function saveData() {
    var parasrc = $("#src-paragraph").val();
    $.post("api/api_anonymous_w.php", {
        src_p: parasrc
    },
    function (data) {
        var obj = data;
        var msg = obj.msg;
        if (msg == "0xd0a") {
            $("#level-paragraph").slideDown('fast');
            var gotolvl = $("#level-paragraph");
            // $('html,body').animate({scrollTop: gotolvl.offset().top}, 'slow');
            $("#empty-para").fadeOut('fast');
        }
        else {
            $("#empty-para").fadeIn('fast');
        }
    }, 'json');
}

function callWordsSyllable() {
    function countWords() { //Show Words
        $("#cntwords").empty(true);
        var chkSyllable = $("#hdnValueSyllable").val();
        $.post("api/api_words_count.php", {
            hdnValueSyllable_: chkSyllable
        },
        function (data) {
            var obj = data;
            var msg = obj.msg;
            var default_data = 0;
//            syllableWords: the future can fixible for another condition
            if (msg === parseInt(msg)) {
                $("#cntwords").empty(true).append(msg);
            }
            else {
                $("#cntwords").empty(true).append(default_data);
            }
        }, 'json');
    }
    function countSyllables() { //Show Syllable
        var content = $("#src-paragraph").val();
        $.post("api/api_syllable_counter.php", {src_p: content},
        function (data) {
            var return_array = data.split("|");
            if (return_array[0] == "success") {
                // Populate syllable counter div
                $("#cntsyllable").empty(true).append(return_array[1]);
            }
        });
    }
    countWords();
    countSyllables();
}

function calAverage() { //Show SComS
    var calaverage = $("#src-paragraph").val();
    $.post("config/syllable_sylla_count.php", {src_p: calaverage},
    function (data) {
        var msg = data.split("|");
        if (msg[0] == "success") {
            $("#averageboth").empty(true).append(msg[1]);
        }
    });
}

function readWordslist() {
    var readwslist = $("#hdnValueSyllable").val();
    $.post("api/api_words_eachcount.php", {
            hdnValueSyllable_: readwslist
        },
        function (data) {
            var obj = data;
            var msg = obj.msg;
            if (msg != "") {
                $("#syllaExam").empty(true).append(msg);
            }            
        }, 'json');
}

function syllableToggle() {
    $("#syllable-line2").slideToggle('fast');
    $("#syllable-line3").slideToggle('fast');
    $("#syllable-line2-temp1").slideToggle('fast');
    $("#syllable-line2-temp2").slideToggle('fast');
}