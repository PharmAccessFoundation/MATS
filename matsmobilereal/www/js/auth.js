$(document).ready(function () {
    //var url = "http://localhost/mobilecity/newtest/server/auth.php?callback=?";
    //var url = "http://matslagos.com.ng/pharm/auth_new.php?callback=?";
    var url = "http://197.159.69.199:8000/pharm/auth_new.php?callback=?";


    function sendSMS(phone, subject, text) {
        var sender = "MATS";
        var gsm = '';
        var sen = subject;

        if (phone.substring(0, 3) == "234") {
            gsm = phone;
        } else {
            gsm = "234" + phone.substring(1);
        }

        var smsurl = "http://api.infobip.com/api/v3/sendsms/plain?";
        var smsdata = "user=mats&password=Pharmaccess123&type=longSMS&sender=" + sender + "&SMSText=" + text + "&GSM=" + gsm;
        $.ajax({
            type: "GET",
            url: smsurl,
            data: smsdata,
            crossDomain: true,
            cache: false,
            beforeSend: function () {

            },
            success: function (data) {
                // alert(data);
            }
        });
    }

    function sendSmartSMS(phone, subject, text) {
        var sender = "MATS";
        var gsm = '';
        var sen = subject;

        if (phone.substring(0, 3) == "234") {
            gsm = phone;
        } else {
            gsm = "234" + phone.substring(1);
        }
        
        var smsurl = "https://smartsmssolutions.com/api/json.php?";
        var smsdata = "user=mats&token=Pharmaccess123&type=0&routing=3&sender=" + sender + "&message=" + text + "&to=" + gsm;
        $.ajax({
            type: "GET",
            url: smsurl,
            data: smsdata,
            crossDomain: true,
            cache: false,
            beforeSend: function () {

            },
            success: function (data) {
                // alert(data);
            }
        });
        /*
        $message = urlencode('Test message');
        $sender = urlencode('Test Sender ID');
        $to = '080*********';
        $token = 'ACCESS_TOKEN';
        $routing = 3;
        $type = 0;
        $baseurl = 'https://smartsmssolutions.com/api/json.php?';
                $sendsms = $baseurl.'message='.$message.'&to='.$to.'&sender='.$sender.'&type='.$type.'&routing='.$routing.'&token='.$token;
                $response = file_get_contents($sendsms);

        echo
        $response;*/
    }

    function getfac(id) {
        var url = "http://197.159.69.199:8000/pharm/auth_new.php?callback=?";
        var dataString = "facid=" + id + "&facname=";
        $.ajax({
            type: "POST",
            url: url,
            data: dataString,
            crossDomain: true,
            cache: false,
            beforeSend: function () {

            },
            success: function (data) {
                // alert(data);
            }
        });
    }
    function checklogin() {
        if (!localStorage.regid || $.trim(localStorage.regid) == '') {
            localStorage.login = "false";
            localStorage.facility = "0";
            localStorage.healthname = "";
            localStorage.clear();
            window.location.href = "index.html";
        }
    }
    //Login Function
    $("#login").click(function () {

        var email = $("#email").val();
        var password = $("#password").val();
        var loc = $("#loc").val();
        var dataString = "email=" + email + "&password=" + password + "&loc=" + loc + "&login=";
        // alert(loc);

        if (($.trim(email).length > 0) & !validateEmail(email)) {
            alert("Email is not valid");
            return false;
        } else if ($.trim(password).length == 0 || $.trim(email).length == 0) {
            alert("All Fields must be filled");
            return false;
        }

        // if ($.trim(email).length > 0 & $.trim(password).length > 0 & $.trim(loc).length > 0)
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
                    // console.log(data); 
                    var myarr = datay.split(":");
                    var data = myarr[0];
                    var facility = myarr[1];
                    var healthname = myarr[2];
                    var name = myarr[3];
                    var regid = myarr[4];
                    var pix = myarr[5];

                    if (data == "success")
                    {
                        localStorage.login = "true";
                        localStorage.email = email;
                        localStorage.facility = facility;
                        localStorage.facilityname = name;
                        localStorage.healthname = healthname.replace('.', '');
                        localStorage.regid = regid;
                        localStorage.pix = pix;

//alert(localStorage.healthname);
                        $.ajax({
                            url: "http://geoip-db.com/jsonp",
                            jsonpCallback: "callback",
                            dataType: "jsonp",
                            success: function (location) {
                                localStorage.currentstate = location.state;
                                var dataString2 = "state=" + localStorage.currentstate + "&stateload=";
                                // alert(dataString2);
                                $.ajax({
                                    type: "POST",
                                    url: url,
                                    data: dataString2,
                                    crossDomain: true,
                                    cache: false,
                                    success: function (jsonn) {
                                        localStorage.jsonn = jsonn;
                                    }
                                });
                            }
                        });
                        //die();
                        window.location.href = "dash.html";
                    }
                    else if (data == "failed")
                    {
                        alert("Login error");
                        $("#login").html('Login');
                    }
                },
                error: function (xhr, status, error) {
                    var acc = []
                    $.each(xhr, function (index, value) {
                        acc.push(index + ': ' + value);
                    });
                    //alert(JSON.stringify(acc));
                    alert('Internet Error, Contact The Admin');
                }

            });
        } else {
            alert('Fields are not filled correctly and ensure your location service is on');
        }
    });



    window.onload = function () {
        var progdp = 'yes';
        var dataString = "progdp=" + progdp + "&progdp=";
        $.ajax({
            type: "POST",
            url: url,
            data: dataString,
            crossDomain: true,
            cache: false,
            beforeSend: function () {
                //$("#login").html('Connecting...');
            },
            success: function (datay) {
                //alert(datay);
                var dp = datay;
                document.getElementById("getprogs").innerHTML = dp;
            }
        });
    };





    function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }
//signup function
    $("#signup").click(function () {
        var fullnam = $("#fullname").val();
        var lname = '';
        var fullname = fullnam + ' ' + lname;
        var email = $("#email").val();
        var phone = $("#phone").val();
        var password = $("#password").val();
        var cpassword = $("#cpassword").val();
        var state = $("#state").val();
        var lga = $("#lga").val();
        var facility = $("#facility").val();
        var gender = '.';
        var address = 'abc';
        var type = $("#type").val();
        var dataString = "phone=" + phone + "&fullname=" + fullname + "&address=" + address + "&type=" + type + "&email=" + email + "&state=" + state + "&lga=" + lga + "&facility=" + facility + "&password=" + password + "&gender=" + gender + "&signup=";

        if ($.trim(fullname) == '') {
            alert("Check Name Field");
            return false;
        } else if (cpassword != password) {
            alert("Confirm Password is not the same as Password");
            return false;
        } else if (($.trim(phone).length != 11) || isNaN($.trim(phone))) {
            alert("Check Phone Number Field");
            return false;
        } else if (($.trim(email).length > 0) & !validateEmail(email)) {
            alert("Email is not valid");
            return false;
        } else if ($.trim(state) == '') {
            alert("Check Facility State Field");
            return false;
        } else if ($.trim(lga) == '') {
            alert("Check Facility LGA Field");
            return false;
        } else if ($.trim(facility) == '') {
            alert("Select Desired Facility");
            return false;
        } else if ($.trim(gender) == '') {
            alert("Select Gender Type");
            return false;
        }

        if ($.trim(fullname).length > 0 & $.trim(email).length > 0 & $.trim(password).length > 0 & $.trim(state).length > 0 & $.trim(lga).length > 0 & $.trim(facility).length > 0)
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
                    alert(data);
                    /*if (data == "success")
                     {
                     alert(data);
                     alert("Thank you for Registering with us! you can login now");
                     }
                     else if (data == "exist")
                     {
                     alert("Hey! You already have account! you can login with it");
                     }
                     else if (data == "failed")
                     {
                     alert("Something Went wrong");
                     }else
                     {
                     alert("Something Went wrong real");
                     }*/


                    $("#signup").html('Create an Account');
                }
            });
        } else {
            alert('Fields are not filled correctly');
        }
        return false;

    });


//add facility function
    $("#addfacility").click(function () {
        var name = $("#name").val();
        var email = $("#email").val();
        var phone = $("#phone").val();
        var programme = $("#programme").val();
        var state = $("#state").val();
        var lga = $("#lga").val();
        var address = $("#address").val();
        var type = $("#type").val();
        var dataString = "phone=" + phone + "&name=" + name + "&email=" + email + "&programme=" + programme + "&state=" + state + "&lga=" + lga + "&address=" + address + "&type=" + type + "&addfacility=";

        if ($.trim(state).length == '') {
            alert("Choose Facility State");
            return false;
        } else if ($.trim(lga) == 'Select item...') {
            alert("Choose Facility LGA");
            return false;
        } else if ($.trim(name) == '') {
            alert("Facility Name Cant Be Empty");
            return false;
        } else if (($.trim(phone).length != 11) || isNaN($.trim(phone))) {
            alert("Check Phone Number Field");
            return false;
        } else if (($.trim(email).length > 0) & !validateEmail(email)) {
            alert("Email is not valid");
            return false;
        } else if ($.trim(programme) == '') {
            alert("Choose Medical Programme For The Facility");
            return false;
        } else if ($.trim(type) == '') {
            alert("Choose Type Of The Facility");
            return false;
        } else if ($.trim(address) == '') {
            alert("Facility Address Cannot Be Empty");
            return false;
        }

        if ($.trim(name).length > 0 & $.trim(email).length > 0 & $.trim(lga).length > 0 & $.trim(state).length > 0 & $.trim(phone).length >= 11 & $.trim(programme).length > 0)
        {
            $.ajax({
                type: "POST",
                url: url,
                data: dataString,
                crossDomain: true,
                cache: false,
                beforeSend: function () {
                    $("#addfacility").html('Connecting...');
                },
                success: function (data) {
                    alert(data);
                    /*if (data == "success")
                     {
                     alert(data);
                     alert("Thank you for Registering with us! you can login now");
                     }
                     else if (data == "exist")
                     {
                     alert("Hey! You already have account! you can login with it");
                     }
                     else if (data == "failed")
                     {
                     alert("Something Went wrong");
                     }else
                     {
                     alert("Something Went wrong real");
                     }*/


                    $("#addfacility").html('Request To Add Facility');
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
                    alert(data);
                    /*if (data == "incorrect")
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
                     }*/
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
                    alert(data);
                    /*if (data == "invalid")
                     {
                     alert("Your have not registered with us");
                     }
                     else if (data == "success")
                     {
                     alert("we have sent password to your email address, please check");
                     }*/
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
    $("#logoutt").click(function () {
        localStorage.login = "false";
        localStorage.facility = "0";
        localStorage.healthname = "";
        window.location.href = "index.html";
        localStorage.clear();
    });
    $("#logouttt").click(function () {
        localStorage.login = "false";
        localStorage.facility = "0";
        localStorage.healthname = "";
        window.location.href = "index.html";
        localStorage.clear();
    });

//Post form.....
    $("#supost").click(function () {
        var status = ($("#status").val()) ? $("#status").val() : 'nil';
        var mode = $("#mode").val() ? $("#mode").val() : 'nil';
        var respondent = $("#respondent").val() ? $("#respondent").val() : '0';
        var hiv = $("#hiv").val() ? $("#hiv").val() : 'nil';
        var cough = $("#cough").val() ? $("#cough").val() : 'nil';
        var more = $("#more").val() ? $("#more").val() : 'nil';
        var growth = $("#growth").val() ? $("#growth").val() : 'nil';
        var weightloss = '0'
        var fever = '0';
        var sweat = '0'
        var doc = $("#doc").val() ? $("#doc").val() : 'nil';
        var details2 = '';

        var antitb_ad = $("#antitb").val() ? $("#antitb").val() : 'nil';
        var antitb_ch = $("#antitb2").val() ? $("#antitb2").val() : 'nil';
        var antitb = (respondent == '3' || respondent == '4') ? antitb_ch : antitb_ad;
        var firstnam = $("#nameme").val() ? $("#nameme").val() : 'nil';
        var lname = $("#nameme2").val() ? $("#nameme2").val() : 'nil';
        var firstname = firstnam + ' ' + lname;
        var mobile = $("#phone").val() ? $("#phone").val() : 'nil';
        var age = $("#age").val() ? $("#age").val() : 'nil';
        var gender = $("#gender").val() ? $("#gender").val() : 'nil';
        var address = $("#address").val() ? $("#address").val() : 'nil';
        var occupation = $("#occupation").val() ? $("#occupation").val() : 'nil';
        var marital = $("#marital").val() ? $("#marital").val() : 'nil';
        var state = $("#state").val() ? $("#state").val() : 'nil';
        var lga = $("#lga").val() ? $("#lga").val() : 'nil';
        var facility = $("#facility").val() ? $("#facility").val() : 'nil';
        var regid = localStorage.regid;
        var longlat = localStorage.longlat;
        var jsonData;
        var dataString;
        //alert(regid);

        if (document.getElementById("weightloss").checked == true) {
            weightloss = '1'; //yes
        } else if (document.getElementById("noweightloss").checked == true) {
            weightloss = '2'; // no
        } else {
            weightloss = '0'; // nil
        }

        if (document.getElementById("sweat").checked == true) {
            sweat = '1'; //yes
        } else if (document.getElementById("nosweat").checked == true) {
            sweat = '2'; //no
        } else {
            sweat = '0'; // nil
        }

        if (document.getElementById("fever").checked == true) {
            fever = '1'; //yes
        } else if (document.getElementById("nofever").checked == true) {
            fever = '2';// no
        } else {
            fever = '0'; // nil
        }

        if ($.trim(respondent) == '0') {
            alert("Check Respondent Field");
            return false;
        }

        var d = new Date();
        var utc = (d.getMonth() + 1) + '/' + d.getDate() + '/' + d.getFullYear();
        var screenfac = $.trim(localStorage.facility);
        //alert(facility);
        if (!doc) {
            details2 = '0';
        } else {
            details2 = doc;
        }

        if (status == 'no') {
            var preString = "antitb=" + antitb + "&regid=" + regid + "&firstname=" + firstname + "&mobile=" + mobile + "&age=" + age + "&gender=" + gender + "&address=" + address + "&occupation=" + occupation + "&marital=" + marital + "&state=" + state + "&lga=" + lga + "&reffacility=" + facility + "&longlat=" + longlat + "&";
            var mainString = "status=" + status + "&screenfacility=" + screenfac + "&datescreened=" + utc + "&weightloss=" + weightloss + "&nightsweat=" + sweat + "&fever=" + fever + "&hiv=" + hiv + "&respondent=" + respondent + "&cough=" + cough + "&more=" + more + "&growth=" + growth + "&details=" + details2 + "&mode=" + mode + "&supost=";
            dataString = preString + mainString;

            var preJsonData = '"antitb":"' + antitb + '","regid":' + regid + ',"firstname":"' + firstname + '","mobile":"' + mobile + '","age":"' + age + '","gender":"' + gender + '","address":"' + address + '","occupation":"' + occupation + '","marital":"' + marital + '","state":"' + state + '","lga":"' + lga + '","reffacility":"' + facility + '",';
            var mainJsonData = '"status":"' + status + '","screenfacility":"' + screenfac + '","datescreened":"' + utc + '","weightloss":"' + weightloss + '","nightsweat":"' + sweat + '","fever":"' + fever + '","hiv":"' + hiv + '","respondent":' + respondent + ',"cough":' + cough + ',"more":' + more + ',"growth":' + growth + ',"details":"' + details2 + '","mode":"' + mode + '"';
            jsonData = preJsonData + mainJsonData;
            //alert(dataString);
        } else if (status == 'yes') {
            //validation
            if (($.trim(mobile).length != 11) || isNaN($.trim(mobile))) {
                alert("Check Phone Number Field");
                return false;
            }

            if (isNaN($.trim(age))) {
                alert("Check Age Field");
                return false;
            }
            if ($.trim(respondent) == '1' && ($.trim(age) < 15 || $.trim(age) > 130)) {
                alert("Self Respondent Age Range Error, Please Input New Age")
                return false;
            }
            if ($.trim(respondent) == '2' && ($.trim(age) < 15 || $.trim(age) > 130)) {
                alert("Adult Respondent Age Range Error, Please Input New Age")
                return false;
            }
            if ($.trim(respondent) == '3' && ($.trim(age) < 5 || $.trim(age) > 14)) {
                alert("Child Respondent Age Range Error, Please Input New Age")
                return false;
            }
            if ($.trim(respondent) == '4' && ($.trim(age) > 4)) {
                alert("Child Respondent Age Range Error, Please Input New Age")
                return false;
            }


            if (mode == 'online') {
                if ($.trim(antitb) == 'nil' || $.trim(firstname) == 'nil' || $.trim(mobile) == 'nil' || $.trim(age) == 'nil' || $.trim(gender) == 'nil' || $.trim(address) == 'nil' || $.trim(occupation) == 'nil' || $.trim(marital) == 'nil' || $.trim(state) == 'nil' || $.trim(lga) == 'nil' || $.trim(facility) == 'nil') {
                    alert("All Contact Fields Must Be Filled");
                    return false;
                }
            } else {
                if (document.getElementById('selfrefer').checked == 'falsee') { // false before change
                    if ($.trim(antitb) == 'nil' || $.trim(firstname) == 'nil' || $.trim(mobile) == 'nil' || $.trim(age) == 'nil' || $.trim(gender) == 'nil' || $.trim(address) == 'nil' || $.trim(occupation) == 'nil' || $.trim(marital) == 'nil' || $.trim(state) == 'nil' || $.trim(lga) == 'nil' || $.trim(facility) == 'nil') {
                        alert("All Contact Fields Must Be Filled");
                        return false;
                    }
                } else if (document.getElementById('selfrefer').checked = true) {//true before change to constant true
                    state = 'self';
                    lga = 'self';
                    facility = screenfac;

                    if ($.trim(antitb) == 'nil' || $.trim(firstname) == 'nil' || $.trim(mobile) == 'nil' || $.trim(age) == 'nil' || $.trim(gender) == 'nil' || $.trim(address) == 'nil' || $.trim(occupation) == 'nil' || $.trim(marital) == 'nil' || $.trim(facility) == 'nil') {
                        alert("All Contact Fields Must Be Filled");
                        return false;
                    }
                }
            }

            //validation ends

            var preString = "antitb=" + antitb + "&regid=" + regid + "&firstname=" + firstname + "&mobile=" + mobile + "&age=" + age + "&gender=" + gender + "&address=" + address + "&occupation=" + occupation + "&marital=" + marital + "&state=" + state + "&lga=" + lga + "&reffacility=" + facility + "&longlat=" + longlat + "&";
            var mainString = "status=" + status + "&screenfacility=" + screenfac + "&datescreened=" + utc + "&weightloss=" + weightloss + "&nightsweat=" + sweat + "&fever=" + fever + "&hiv=" + hiv + "&respondent=" + respondent + "&cough=" + cough + "&more=" + more + "&growth=" + growth + "&details=" + details2 + "&mode=" + mode + "&supost=";
            dataString = preString + mainString;

            var preJsonData = '"antitb":"' + antitb + '","regid":' + regid + ',"firstname":"' + firstname + '","mobile":"' + mobile + '","age":"' + age + '","gender":"' + gender + '","address":"' + address + '","occupation":"' + occupation + '","marital":"' + marital + '","state":"' + state + '","lga":"' + lga + '","reffacility":' + facility + ',';
            var mainJsonData = '"status":"' + status + '","screenfacility":"' + screenfac + '","datescreened":"' + utc + '","weightloss":"' + weightloss + '","nightsweat":"' + sweat + '","fever":"' + fever + '","hiv":"' + hiv + '","respondent":' + respondent + ',"cough":' + cough + ',"more":' + more + ',"growth":' + growth + ',"details":"' + details2 + '","mode":"' + mode + '"';
            jsonData = preJsonData + mainJsonData;

            //alert(dataString);
            //Send SMS To Patient
            var facilityname = getfac(facility);
            var smsphone = mobile;
            var smssubject = "MATS Alert";
            var smsfacility = facilityname + ", " + lga + ", " + state;
            var smsname = firstname;
            var smstext = "Dear " + smsname + ", You have been referred as a TB presumptive to this hospital (" + smsfacility + "). Please endeavour to go for treatment. Thanks. MATS Admin";

            sendSMS(smsphone, smssubject, smstext);

        } else {
            alert("Error In Form Fields");
            return false;
        }

        // console.log(dataString);
        if (!navigator.onLine) {
            //no network create offline db
            for (i = 0; i < 99999; i++) {
                if (localStorage.getItem(i)) {
                    continue;
                }
                //var value = localStorage.getItem(key); // Pass a key name to get its value.
                var value = jsonData;
                //alert(value);
                var key = i;
                localStorage.setItem(key, value); // Pass a key name and its value to add or update that key.
                //localStorage.removeItem(key) // Pass a key name to remove that key from storage.
                break;
            }
            // alert(localStorage.getItem(0))

            var elements = document.getElementsByTagName("input");
            for (var ii = 0; ii < elements.length; ii++) {
                if (elements[ii].type == "text") {
                    elements[ii].value = "";
                }
                if (elements[ii].type == "select") {
                    elements[ii].value = "nil";
                }
            }

            $("#respondent").val('0');
            $("#hiv").val('0');
            $("#cough").val('0');
            $("#more").val('0');
            $("#growth").val('0');
            $("#antitb").val('nil');
            $("#marital").val('nil');
            $("#gender").val('nil');
            $("#doc").val('');
            document.getElementById('lantitb').style.display = "none";
            document.getElementById('contact').style.display = "none";
            document.getElementById('lsupost').style.display = "none";
            document.getElementById('ldoc').style.display = "none";
            document.getElementById('lfever').style.display = "none";
            document.getElementById('lsweat').style.display = "none";
            document.getElementById('lweight').style.display = "none";
            document.getElementById('lmore').style.display = "none";
            document.getElementById('lgrowth').style.display = "none";
            document.getElementById('first').style.display = "none";
            document.getElementById("agree").checked = false;
            // hide and reset fields 

            alert('Survey data saved in offline mode')
            return false;
        }

        $.ajax({
            type: "POST",
            url: url,
            data: dataString,
            crossDomain: true,
            cache: false,
            timeout: 9000,
            beforeSend: function () {
                $("#supost").html('Connecting...');
                localStorage.setItem("supp", 1);
            },
            success: function (datay) {
                //alert(data);
                localStorage.setItem("supp", 0);
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
                        if (elementss[ii].type == "select") {
                            elementss[ii].value = "";
                        }

                    }
                    $("#respondent").val('0');
                    $("#hiv").val('0');
                    $("#cough").val('0');
                    $("#more").val('0');
                    $("#growth").val('0');
                    $("#antitb").val('nil');
                    $("#marital").val('nil');
                    $("#gender").val('nil');
                    $("#doc").val('');
                    document.getElementById('lantitb').style.display = "none";
                    document.getElementById('contact').style.display = "none";
                    document.getElementById('lsupost').style.display = "none";
                    document.getElementById('ldoc').style.display = "none";
                    document.getElementById('lfever').style.display = "none";
                    document.getElementById('lsweat').style.display = "none";
                    document.getElementById('lweight').style.display = "none";
                    document.getElementById('lmore').style.display = "none";
                    document.getElementById('lgrowth').style.display = "none";
                    document.getElementById('contact').style.display = "none";
                    document.getElementById('first').style.display = "none";
                    document.getElementById("agree").checked = false;
                    // hide and reset fields 

                }
                else if (data == "failed")
                {
                    alert("Something Went wrong " + myarr[1]);
                }
                $("#supost").html('End Survey');

                var elements = document.getElementsByTagName("input");
                for (var ii = 0; ii < elements.length; ii++) {
                    if (elements[ii].type == "text") {
                        elements[ii].value = "";
                    }
                    if (elements[ii].type == "select") {
                        elements[ii].value = "";
                    }

                }
                $("#respondent").val('0');
                $("#hiv").val('0');
                $("#cough").val('0');
                $("#more").val('0');
                $("#growth").val('0');
                $("#antitb").val('nil');
                $("#marital").val('nil');
                $("#gender").val('nil');
                $("#doc").val('');
                document.getElementById('lantitb').style.display = "none";
                document.getElementById('contact').style.display = "none";
                document.getElementById('lsupost').style.display = "none";
                document.getElementById('ldoc').style.display = "none";
                document.getElementById('lfever').style.display = "none";
                document.getElementById('lsweat').style.display = "none";
                document.getElementById('lweight').style.display = "none";
                document.getElementById('lmore').style.display = "none";
                document.getElementById('lgrowth').style.display = "none";
                document.getElementById('contact').style.display = "none";
                document.getElementById('first').style.display = "none";
                document.getElementById("agree").checked = false;
                // hide and reset fields 
            },
            error: function (request, status, error) {
                //create offline db
                //alert('Survey data saved in offline mode2')

                if (localStorage.supp == 1) {
                    $("#supost").click();
                } else {
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
                    //alert(error.responseText);
                    //alert(status.responseText);
                    //alert(request.responseText);
                    alert('Something went wrong, please contact admin');

                }
                localStorage.setItem("supp", 0);
            }
        });

        //document.getElementById('status').value = 'no';
        return false;

    });
//$(document).on("click", "#supost", function(){
    $("#2supost").click(function () {
        var form = document.getElementById("screener").elements;
        //alert('yes');
        //console.log(form);
        //return false;
        var name = $("#name").val();
        var status = $("#status").val();
        var mobile = $("#mobile").val();
        var respondent = $("#respondent").val();
        var cough = $("#cough").val();
        var more = $("#more").val();
        var growth = $("#growth").val();
        var details = $("#details").val();
        var details2 = '';
        var longlat = localStorage.longlat;

        var weightloss = '0';
        var sweat = '0'
        var fever = '0'

        if (document.getElementById("weightloss").checked == true) {
            weightloss = '1';
        }
        if (document.getElementById("sweat").checked == true) {
            sweat = '1';
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

        if (($.trim(mobile).length != 11) || isNaN($.trim(mobile))) {
            alert("Check Phone Number Field");
            return false;
        }

        var d = new Date();
        //var utc = d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + d.getDate();
        var utc = (d.getMonth() + 1) + '/' + d.getDate() + '/' + d.getFullYear();

        var dataString = "status=" + status + "&facility=" + facility + "&longlat=" + longlat + "&datescreened=" + utc + "&weightloss=" + weightloss + "&nightsweat=" + sweat + "&fever=" + fever + "&name=" + name + "&mobile=" + mobile + "&respondent=" + respondent + "&cough=" + cough + "&more=" + more + "&growth=" + growth + "&details=" + details2 + "&supost=";
        '"name":"John", "mobile":30, "city":"New York"';
        var jsonData = '"datescreened":"' + utc + '","status":"' + status + '","facility":' + facility + ',"weightloss":"' + weightloss + '","nightsweat":"' + sweat + '","fever":"' + fever + '","name":"' + name + '","mobile":"' + mobile + '","respondent":' + respondent + ',"cough":' + cough + ',"more":' + more + ',"growth":' + growth + ',"details":"' + details2 + '"';
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
                timeout: 9000,
                beforeSend: function () {
                    $("#supost").html('Connecting...');
                    localStorage.setItem("supp", 1);
                },
                success: function (datay) {
                    //alert(data);
                    localStorage.setItem("supp", 0);
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


                    //alert('Survey data saved in offline mode2')

                    if (localStorage.supp == 1) {
                        $("#supost").click();
                    } else {
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
                        alert('Response Time Too Long, Data Saved Offline')

                    }
                    localStorage.setItem("supp", 0);
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
            //var getii = JSON.parse("{" + gwt + "}");
            if (gwt) {
                try {
                    var b = gwt.replace(/(\r\n\t|\n|\r\t)/gm, "");
                    var a = JSON.stringify(b);
                    var getii = JSON.parse('{' + gwt + '}');
                } catch (e) {
                    //  alert(e); // error in the above string (in this case, yes)!
                }
            }

            var dataString = '';

            for (var property in getii) {
                dataString += $.trim(property) + "=" + $.trim(getii[property]) + "&";
            }

            dataString += "supost=";
            //dataString = "status=" + status + "&facility=" + facility + "&name=" + name + "&mobile=" + mobile + "&respondent=" + respondent + "&cough=" + cough + "&more=" + more + "&growth=" + growth + "&details=" + details2 + "&supost=";

            // alert(dataString);
            return false;

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
}
);
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
        //var getii = JSON.parse("{" + gwt + "}");
        if (gwt) {
            try {
                var b = gwt.replace(/(\r\n\t|\n|\r\t)/gm, "");
                var a = JSON.stringify(b);
                var getii = JSON.parse('{' + gwt + '}');
            } catch (e) {
                // alert(e); // error in the above string (in this case, yes)!
            }
        }

        var dataString = '';

        for (var property in getii) {
            dataString += $.trim(property) + "=" + $.trim(getii[property]) + "&";
        }

        dataString += "supost=";
        //dataString = "status=" + status + "&facility=" + facility + "&name=" + name + "&mobile=" + mobile + "&respondent=" + respondent + "&cough=" + cough + "&more=" + more + "&growth=" + growth + "&details=" + details2 + "&supost=";

        // alert(dataString);
        //return false;

        $.ajax({
            type: "POST",
            url: "http://197.159.69.199:8000/pharm/auth_new.php?callback=?",
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