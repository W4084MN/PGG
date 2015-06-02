<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Passage Grading</title>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/remodel.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>
        <div class="container">
            <div class="jumbotron">
                <h1 class="form-signin-heading text-center">Passage Grading</h1>
                <div class="form-signin">
                    <h2 class="form-signin-heading text-center">Log In</h2>
                    <div class="alert alert-danger">
                        <a href="#" class="close">
                            &times;
                        </a>
                        <span id="alert-message"></span>
                    </div>
                    <label for="userinput" class="sr-only">Email address</label>
                    <input type="text" id="userinput" class="form-control" placeholder="Username" name="username_inp" required autofocus>
                    <label for="passwordinput" class="sr-only">Password</label>
                    <input type="password" id="passwordinput" class="form-control" placeholder="Password" name="password_inp" required>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="chkremem" value="remember-me"> Remember me
                        </label>
                    </div>
                    <button id="submit_login" class="btn btn-lg btn-primary btn-block" type="submit">Log In</button>                    
                    <div class="checkbox text-center">
                        <a data-toggle="modal" data-target="#regis_data">Create New Account</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Register Modal -->
        <div class="modal fade" id="regis_data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title text-center" id="myModalLabel">Registration</h3>
                    </div>
                    <div class="modal-body">
                        <div class="form-signin">                            
                            <label for="userinput" class="sr-only">Username</label>
                            <div class="form-group">
                                <label>Username</label>
                                <input min="8" maxlength="25" type="text" id="r-userinput" class="form-control" placeholder="(8-25, ตัวอักษรภาษาอังกฤษ)" name="r_username_inp" required>
                            </div>                            
                            <label for="passwordinput" class="sr-only">Password</label>
                            <div class="form-group">
                                <label>Password</label>
                                <input min="8" maxlength="20" type="password" id="r-passwordinput" class="form-control" placeholder="(8-20, ตัวอักษรภาษาอังกฤษ)" name="r_password_inp" required>
                            </div>
                            <div class="form-group">
                                <p class="help-block text-center">(ใช้ Username และ Password เพื่อเข้าสู่ระบบ)</p>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label>Firstname</label>
                                <input type="text" id="r-firstname" class="form-control" name="r_first_name" placeholder="ชื่อจริง" required>
                            </div>
                            <div class="form-group">
                                <label>Lastname</label>
                                <input type="text" id="r-lastname" class="form-control" name="r_last_name" placeholder="นามสกุล" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" id="r-email" class="form-control" name="r_email_" placeholder="example@someone" required>
                            </div>
                            <div class="form-group">
                                <label>Birthday</label>
                                <input type="date" id="r-birthday" class="form-control" name="r_birthday_" required>
                            </div>
                            <div class="form-group">
                                <label>Phone number</label>
                                <input min="9" maxlength="10" type="tel" id="r-phonenumber" class="form-control" name="r_phonenumber_" placeholder="เบอร์โทรศัพท์บ้าน หรือ เบอร์โทรศัพท์มือถือ" required>
                            </div>
                            <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="6LcgAgYTAAAAAE9oteHTf-fnhiBaei5izSGkzG0S"></div>
                            </div>
                            <div id="r-alert-recapt" class="alert alert-info">
                                <a href="#" class="close">
                                    &times;
                                </a>
                                <span id="r-alert-message"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                        <button id="submit_register" type="button" class="btn btn-primary">ตกลง</button>
                    </div>
                </div>
            </div>
        </div>       
    </body>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="js/jquery-1.11.2.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript" language="javascript">
        $(document).ready(function () {
            //SET EVENT CHK
            $("#submit_login").click(function (e) {
                var username = $("#userinput").val();
                var password = $("#passwordinput").val();
                var rememchk = $("#chkremem").val();
                if (username != "" && password != "") {
                    $.post("api/api_login_user.php", {
                        username_inp: username,
                        password_inp: password,
                        rem_inp: rememchk
                    },
                    function (data) {
                        var obj = data;
                        var msg = obj.msg;
                        if (msg == "0x0c00fe9") {
                            window.location = "overall.php"
                        }
                        else if (msg == "0x1d5ef03") {
                            msg = "กรุณาตรวจสอบ Username และ Password ให้ถูกต้อง!";
                            $("#alert-message").empty().append(msg);
                            $('.alert-danger').fadeIn("fast");
                        }
                    }, 'json');
                }
                else {
                    msg = "กรุณากรอกข้อมูลให้ครบถ้วน! <br/>ต้องการ <a data-toggle=\"modal\" data-target=\"#regis_data\">Create New Account</a> หรือไม่?";
                    $("#alert-message").empty().append(msg);
                    $('.alert-danger').fadeIn("fast");
                }
            });
            // SET HIDE 1ST
            $(".alert").hide();
            $('.close').on("click", function () {
                $('.alert').hide();
            });
        });
    </script>
    <script type="text/javascript" language="javascript">
        $(document).ready(function () {
            $("#submit_register").on('click', function () {
                if (grecaptcha.getResponse() == "") {
                    msg = "กรุณายืนยันความปลอดภัย โดยการติ๊กช่อง I'm not a robot และใส่ตัวอักษรตามภาพที่เห็นให้ถูกต้อง";
                    $("#r-alert-message").empty().append(msg);
                    $("#r-alert-recapt").fadeIn("fast");
                }
                else {
                    var r_username = $("#r-userinput").val();
                    var r_password = $("#r-passwordinput").val();
                    var r_firstname = $("#r-firstname").val();
                    var r_lasttname = $("#r-lastname").val();
                    var r_email = $("#r-email").val();
                    var r_birthday = $("#r-birthday").val();
                    var r_phonenumber = $("#r-phonenumber").val();
                    if (r_username != "" &&
                            r_password != "" &&
                            r_firstname != "" &&
                            r_lasttname != "" &&
                            r_email != "" &&
                            r_birthday != "" &&
                            r_phonenumber != "") {
                        $.post("api/api_register_user.php", {
                            r_username_inp: r_username,
                            r_password_inp: r_password,
                            r_first_name: r_firstname,
                            r_last_name: r_lasttname,
                            r_email_: r_email,
                            r_birthday_: r_birthday,
                            r_phonenumber_: r_phonenumber
                        },
                        function (data) {
                            var obj = data;
                            var msg = obj.msg;
                            if (msg == "0x4b0fd08") {
                                window.location = "redirect.php";
                            }
                            else if (msg == "0x00000f002") {
                                msg = "ระบบลงทะเบียนกำลังปรับปรุง กรุณาลองอีกครั้งเมื่อพร้อมให้บริการ";
                                $("#r-alert-message").empty().append(msg);
                                $("#r-alert-recapt").fadeIn("fast");
                            }
                            else if (msg == "0x2007c") {
                                msg = "มี Username นี้ในระบบแล้ว! กรุณาเปลี่ยนใหม่เพื่อไม่ให้ซ้ำ";
                                $("#r-alert-message").empty().append(msg);
                                $("#r-alert-recapt").fadeIn("fast");
                            }
                            else if (msg == "0x0a") {
                                msg = "Username และ Password ต้องเป็นตัวอักษรภาษาอังกฤษและตัวเลขเท่านั้น<br/>*มีความยาวอย่างน้อย 8 ตัวอักษร และมากที่สุด 25 ตัวอักษร";
                                $("#r-alert-message").empty().append(msg);
                                $("#r-alert-recapt").fadeIn("fast");
                            }
                        }, 'json');
                    }
                    else {
                        msg = "กรุณาตรวจสอบและกรอกข้อมูลให้ครบถ้วน!</p>";
                        $("#r-alert-message").empty().append(msg);
                        $("#r-alert-recapt").fadeIn("fast");
                    }
                }
            });
        });
    </script>
</html>

