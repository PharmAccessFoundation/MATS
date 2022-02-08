$(document).ready(function () {
    // var url = "http://localhost/mobilecity/newtest/server/auth.php?callback=?";
    var url = "http://matslagos.com.ng/pharm/auth.php?callback=?";

    //Login Function
    $("#login").click(function () {

        var email = $("#email").val();
        var password = $("#password").val();
        var dataString = "email=" + email + "&password=" + password + "&login=";

        if (($.trim(email).length > 0) & !validateEmail(email)) {
            alert("Email is not valid");
            return false;
        } else if ($.trim(password).length == 0 || $.trim(email).length == 0) {
            alert("All Fields must be filled");
            return false;
        }

        if ($.trim(email).length > 0 & $.trim(password).length > 0)
        {
            $.ajax({
                type: "POST",
                url: url,
                data: dataString,
                crossDomain: true,
                cache: false,
                beforeSend: function () {
                    $("#login").html('Connecting...');
                },
                success: function (datay) {
                    // alert(data);
                    var myarr = datay.split(":");
                    var data = myarr[0];
                    var facility = myarr[1];
                    var healthname = myarr[2];
                    if (data == "success")
                    {
                        localStorage.login = "true";
                        localStorage.email = email;
                        localStorage.facility = facility;
                        localStorage.healthname = healthname;
                        window.location.href = "dash.html";
                    }
                    else if (data == "failed")
                    {
                        alert("Login error");
                        $("#login").html('Login');
                    }
                }
            });
        }
        return false;

    });

    function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }
    //signup function
    $("#signup").click(function () {
        var fullname = $("#fullname").val();
        var email = $("#email").val();
        var phone = $("#phone").val();
        var password = $("#password").val();
        var cpassword = $("#cpassword").val();
        var dataString = "phone=" + phone + "&fullname=" + fullname + "&email=" + email + "&password=" + password + "&signup=";

        if (cpassword != password) {
            alert("Confirm Password is not the same as Password");
            return false;
        } else if (($.trim(phone).length > 11 & $.trim(phone).length > 0) || isNaN($.trim(phone))) {
            alert("Check Phone Number Field");
            return false;
        } else if (($.trim(email).length > 0) & !validateEmail(email)) {
            alert("Email is not valid");
            return false;
        }

        if ($.trim(fullname).length > 0 & $.trim(email).length > 0 & $.trim(password).length > 0)
        {
            $.ajax({
                type: "POST",
                url: url,
                data: dataString,
                crossDomain: true,
                cache: false,
                beforeSend: function () {
                    $("#signup").html('Connecting...');
                },
                success: function (data) {
                    //alert(data);
                    if (data == "success")
                    {
                        alert("Thank you for Registering with us! you can login now");
                    }
                    else if (data == "exist")
                    {
                        alert("Hey! You already have account! you can login with it");
                    }
                    else if (data == "failed")
                    {
                        alert("Something Went wrong");
                    }
                    $("#signup").html('Create an Account');
                }
            });
        } else {
            alert('Fields are not filled correctly');
        }
        return false;

    });

    //Change Password
    $("#change_password").click(function () {
        var email = localStorage.email;
        var old_password = $("#old_password").val();
        var new_password = $("#new_password").val();
        var cnew_password = $("#cnew_password").val();

        if (cnew_password != new_password) {
            alert("Confirm Password is not the same as New Password");
            return false;
        }

        var dataString = "old_password=" + old_password + "&new_password=" + new_password + "&email=" + email + "&change_password=";
        if ($.trim(old_password).length > 0 & $.trim(new_password).length > 0)
        {
            $.ajax({
                type: "POST",
                url: url,
                data: dataString,
                crossDomain: true,
                cache: false,
                beforeSend: function () {
                    $("#change_password").val('Connecting...');
                },
                success: function (data) {
                    // alert(data);
                    if (data == "incorrect")
                    {
                        alert("Your old password is incorrect");
                    }
                    else if (data == "success")
                    {
                        alert("Password Changed successfully");
                    }
                    else if (data == "failed")
                    {
                        alert("Something Went wrong");
                    }
                }
            });
        }
        return false;

    });

    //Forget Password
    $("#forget_password").click(function () {
        var email = $("#email").val();
        var dataString = "email=" + email + "&forget_password=";
        if ($.trim(email).length > 0)
        {
            $.ajax({
                type: "POST",
                url: url,
                data: dataString,
                crossDomain: true,
                cache: false,
                beforeSend: function () {
                    $("#forget_password").val('Connecting...');
                },
                success: function (data) {
                    if (data == "invalid")
                    {
                        alert("Your have not registered with us");
                    }
                    else if (data == "success")
                    {
                        alert("we have sent password to your email address, please check");
                    }
                }
            });
        }
        return false;

    });


    //logout function
    $("#logout").click(function () {
        localStorage.login = "false";
        localStorage.facility = "0";
        localStorage.healthname = "";
        window.location.href = "index.html";
        localStorage.clear();
    });

    //logout function
    $("#logouty").click(function () {
        localStorage.login = "false";
        localStorage.facility = "0";
        localStorage.healthname = "";
        window.location.href = "index.html";
        localStorage.clear();
    });

    //Post form.....

    $("#supost").click(function () {
        var name = $("#name").val();
        var status = $("#status").val();
        var mobile = $("#mobile").val();
        var respondent = $("#respondent").val();
        var cough = $("#cough").val();
        var more = $("#more").val();
        var growth = $("#growth").val();
        var details = $("#details").val();
        var details2 = '';

        var weightloss = '0';
        var nightsweat = '0'
        var fever = '0'

        if (document.getElementById("weightloss").checked == true) {
            weightloss = '1';
        }
        if (document.getElementById("nightsweat").checked == true) {
            nightsweat = '1';
        }
        if (document.getElementById("fever").checked == true) {
            fever = '1';
        }

        var facility = localStorage.facility;
        //alert(facility);
        if (!details) {
            details2 = '0';
        } else {
            details2 = details;
        }

        if (($.trim(mobile).length > 11 & $.trim(mobile).length > 0) || isNaN($.trim(mobile))) {
            alert("Check Phone Number Field");
            return false;
        }

        var d = new Date();
        //var utc = d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + d.getDate();
        var utc = (d.getMonth() + 1) + '/' +  d.getDate() + '/' + d.getFullYear();

        var dataString = "status=" + status + "&facility=" + facility + "&datescreened=" + utc + "&weightloss=" + weightloss + "&nightsweat=" + nightsweat + "&fever=" + fever + "&name=" + name + "&mobile=" + mobile + "&respondent=" + respondent + "&cough=" + cough + "&more=" + more + "&growth=" + growth + "&details=" + details2 + "&supost=";
        '"name":"John", "mobile":30, "city":"New York"';
        var jsonData = '"datescreened":"' + utc + '","status":"' + status + '","facility":' + facility + ',"weightloss":"' + weightloss + '","nightsweat":"' + nightsweat + '","fever":"' + fever + '","name":"' + name + '","mobile":"' + mobile + '","respondent":' + respondent + ',"cough":' + cough + ',"more":' + more + ',"growth":' + growth + ',"details":"' + details2 + '"';
        if ($.trim(mobile).length > 0 & respondent != '0' & $.trim(name).length > 0 & respondent != '0' & cough != '0') //& mobile.match(/^\d+$/)
        {
            if (!navigator.onLine) {
                //no network create offline db
                for (i = 0; i < 99999; i++) {
                    if (localStorage.getItem(i)) {
                        continue;
                    }
                    //var value = localStorage.getItem(key); // Pass a key name to get its value.
                    var value = jsonData;
                    var key = i;
                    localStorage.setItem(key, value); // Pass a key name and its value to add or update that key.
                    //localStorage.removeItem(key) // Pass a key name to remove that key from storage.
                    break;
                }


                var elements = document.getElementsByTagName("input");
                for (var ii = 0; ii < elements.length; ii++) {
                    if (elements[ii].type == "text") {
                        elements[ii].value = "";
                    }

                }
                $("#respondent").val('0');
                $("#cough").val('0');
                $("#more").val('0');
                $("#growth").val('0');
                $("#details").val('');

                alert('Survey data saved in offline mode')
                return false;
            }

            $.ajax({
                type: "POST",
                url: url,
                data: dataString,
                crossDomain: true,
                cache: false,
                beforeSend: function () {
                    $("#supost").html('Connecting...');
                },
                success: function (datay) {
                    //alert(data);
                    var myarr = datay.split(":");
                    var data = myarr[0];
                    if (data == "success")
                    {
                        alert("Survey data taken successfully");
                    }
                    else if (data == "exist")
                    {
                        alert("Hey! This Survey has been taken before and flag status was " + myarr[1]);


                        var elementss = document.getElementsByTagName("input");
                        for (var ii = 0; ii < elementss.length; ii++) {
                            if (elementss[ii].type == "text") {
                                elementss[ii].value = "";
                            }

                        }
                        $("#respondent").val('0');
                        $("#cough").val('0');
                        $("#more").val('0');
                        $("#growth").val('0');
                        $("#details").val('');

                    }
                    else if (data == "failed")
                    {
                        alert("Something Went wrong");
                    }
                    $("#supost").html('End Survey');


                    var elements = document.getElementsByTagName("input");
                    for (var ii = 0; ii < elements.length; ii++) {
                        if (elements[ii].type == "text") {
                            elements[ii].value = "";
                        }

                    }
                    $("#respondent").val('0');
                    $("#cough").val('0');
                    $("#more").val('0');
                    $("#growth").val('0');
                    $("#details").val('');


                },
                error: function (request, status, error) {
                    //create offline db

                    for (i = 0; i < 99999; i++) {
                        if (localStorage.getItem(i)) {
                            continue;
                        }
                        //var value = localStorage.getItem(key); // Pass a key name to get its value.
                        var value = jsonData;
                        var key = i;
                        localStorage.setItem(key, value); // Pass a key name and its value to add or update that key.
                        //localStorage.removeItem(key) // Pass a key name to remove that key from storage.
                        break;
                    }

                    alert('Survey data saved in offline mode')
                }
            });
        } else {
            alert('Ensure that all fields have been filled correctly')
            return false;
        }
    });

    //Displaying user email on home page
    $("#email1").html(localStorage.email);
    var imageHash = "http://www.gravatar.com/avatar/" + md5(localStorage.email);
    $("#profilepic").attr('src', imageHash);

    //Check Offline to notify
    document.addEventListener("offline", offNotify, false);
    function offNotify() {
        alert('You are now in Offline Mode!');
    }

    //Check Online to send data
    document.addEventListener("online", onSend, false);
    function onSend() {
        for (var i = 0; i < 99999; i++) {
            var gwt = localStorage.getItem(i);
            var ii = i;
            if (!gwt) {
                break;
            }
            var getii = JSON.parse("{" + gwt + "}");
            var dataString = '';

            for (var property in getii) {
                dataString += $.trim(property) + "=" + $.trim(getii[property]) + "&";
            }

            dataString += "supost=";
            //dataString = "status=" + status + "&facility=" + facility + "&name=" + name + "&mobile=" + mobile + "&respondent=" + respondent + "&cough=" + cough + "&more=" + more + "&growth=" + growth + "&details=" + details2 + "&supost=";

            //alert(dataString); return false;

            $.ajax({
                type: "POST",
                url: url,
                data: dataString,
                crossDomain: true,
                cache: false,
                beforeSend: function () {
                    //$("#supost").val('Connecting...');
                },
                success: function (datay) {
                    //alert(data);
                    var myarr = datay.split(":");
                    var data = myarr[0];

                    if (data == "success")
                    {
                        localStorage.removeItem(ii);
                        delete window.localStorage[ii];
                        //alert("Survey data taken successfully");
                    }
                    else if (data == "exist")
                    {
                        localStorage.removeItem(ii);
                        delete window.localStorage[ii];
                        //alert("Hey! This Survey has been taken before and flag status was " + myarr[1]);
                    }
                    else if (data == "failed")
                    {
                        //alert("Something Went wrong");
                    }
                },
                error: function (request, status, error) {
                    //still continue in offline mode
                }
            });
            localStorage.removeItem(ii);
            delete window.localStorage[ii];
        }
    }
});