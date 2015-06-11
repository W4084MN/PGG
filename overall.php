<?php
session_start();
if (!isset($_SESSION['uSname'])) {

    function non_bypass() {
        header("Location: http://localhost/PGG/index.php");
    }

} else {
    $e = $_SESSION['uSname'];
}
?>
<!DOCTYPE html>
<html lang="en">    
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Passage Grading</title>

        <script src="js/onSyllable.js" type="text/javascript"></script>

        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/remodel_overall.css" rel="stylesheet" type="text/css"/>  
    </head>

    <body id="a-tracked">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Passage Grading</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a id="home_link" href="#">Home</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a id="mem-menu" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $e; ?> <span class="caret"></span></a>
                            <ul id="sub-mem-menu" class="dropdown-menu" role="menu">
                                <li><a href="#">Profile</a></li>
                                <li class="divider"></li>
                                <li><a href="api/api_logout.php">Log Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>


        <div class="jumbotron">
            <div class="container">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <div class="text-center">
                        <h2>Readability index calculator</h2>
                        <h3>โปรดใส่เนื้อความที่ต้องการประเมินลงในช่องว่างข้างล่าง</h3>
                        <textarea id="src-paragraph" name="src_p" class="form-control non-overflow" placeholder="กรอกเนื้อความที่ต้องการลงภายในช่องว่างนี้..." required autofocus="" onkeyup="callWordsSyllable();calAverage();" oninput="saveData();" onpaste="saveData();"></textarea>
                    </div>
                    <div class="help-block">
                        <!--<a id="exam_para1" class="btn btn-default">ตัวอย่าง Paragraph....</a>-->
                        <div id="show_para1" class="well-sm">

                        </div>
                    </div>

                </div>
                <div class="col-lg-2"></div>
            </div>
            <div id="level-paragraph" class="container">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <div class="well">
                        <div class="text-center"><h2>ระดับความยากของเนื้อความ = มัธยมศึกษาปีที่ 2</h2></div>
                        <hr>
                        <div class="tabbable" id="tabs-53845">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#01-Syllable" data-toggle="tab">Syllable</a>
                                </li>
                                <li>
                                    <a href="#02-Vocabulary" data-toggle="tab">Vocabulary</a>
                                </li>
                                <li>
                                    <a href="#03-Sentence" data-toggle="tab">Sentence</a>
                                </li>
                                <li>
                                    <a href="#04-Tense" data-toggle="tab">Tense</a>
                                </li>
                                <li class="pull-right">
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane tab-full-div active" id="01-Syllable">
                                    <div class="container well-lg">
                                        <div class="col-lg-4">Syllable complexity socre</div>
                                        <div class="col-lg-4">
                                            <div class="text-center">
                                                = <b id="averageboth"></b>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div id="magnifier-f1">
                                                <img id="magnifier-syllable" onclick="syllableToggle()" class="pull-right magnifier-resize magnifier-syllable" src="img/for_F_magnifier.png" alt=""/>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="syllable-line2-temp1" class="container well-lg">
                                        <div class="col-lg-4">จำนวน Words</div>
                                        <div class="col-lg-8">
                                            <div class="text-center">
                                                = <b id="cntwords"></b>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="syllable-line2-temp2" class="container well-lg">
                                        <div class="col-lg-4">จำนวน Syllable</div>
                                        <div class="col-lg-8">
                                            <div class="text-center">
                                                = <b id="cntsyllable"></b>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="syllable-line3" class="container well-lg">
                                        <div class="col-lg-12">
                                            <div class="thumbnail">
                                                <div class="container">
                                                    <div class="col-lg-6">1 พยางค์</div>
                                                    <div class="col-lg-6">มี N คำ</div>
                                                </div>
                                                <div class="container">
                                                    <div class="col-lg-6">2 พยางค์</div>
                                                    <div class="col-lg-6">มี N คำ</div>
                                                </div>
                                                <div class="container">
                                                    <div class="col-lg-6">3 พยางค์</div>
                                                    <div class="col-lg-6">มี N คำ</div>
                                                </div>
                                                <div class="container">
                                                    <div class="col-lg-6">4 พยางค์</div>
                                                    <div class="col-lg-6">มี N คำ</div>
                                                </div>
                                                <div class="container">
                                                    <div class="col-lg-6">5 พยางค์</div>
                                                    <div class="col-lg-6">มี N คำ</div>
                                                </div>
                                                <hr>
                                                <div><button onclick="readWordslist()">Sub_Syllable</button><a class="btn" href="api/api_words_eachcount.php">DEBUG</a></div>
                                                <div class="container">
                                                    <div class="col-lg-12">
                                                        <div id="syllaExam"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="02-Vocabulary">
                                    <p>
                                        Wait insert table Vocabulary
                                    </p>
                                </div>
                                <div class="tab-pane tab-full-div" id="03-Sentence">
                                    <p>
                                        Wait insert table Sentence
                                    </p>
                                </div>
                                <div class="tab-pane tab-full-div" id="04-Tense">
                                    <p>
                                        Wait insert table Tense
                                    </p>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
                <div class="col-lg-2"></div>
            </div>            
        </div>
        <input id="hdnValueSyllable" name="hdnValueSyllable_" type="hidden" value="0">
    </body>
    <script src="js/jquery-1.11.2.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript" language="javascript">
        $(document).ready(function () {
            $("#level-paragraph").hide(true);
            $("#mem-menu").on('click', function () {
                $("#sub-mem-menu").slideToggle('fast');
            });
        });        
        
        $("#syllable-line2").hide();
        $("#syllable-line2-temp1").hide();
        $("#syllable-line2-temp2").hide();
        $("#syllable-line3").hide();
    </script>
</html>
