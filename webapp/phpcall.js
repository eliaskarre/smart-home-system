var refresh = false; //Scanner inaktiv 


//Sende Funksignal mit Gerätenamen als Parameter -> sendsignal.php

function sendsignal() {

    for (var i = 0; i < arguments.length; i++) {
    
        var codename = arguments[i];

        $.ajax({
            url: 'sendsignal.php',
            type: 'get',
            async: false, 
            data: { "codename": codename},
            success: function(response) { 
                

                    //alert(response);

                    if (response == "1") {

                        $('#'+ codename).addClass("on");

                    }

                    if (response == "0") {

                        $('#'+ codename).removeClass("on");

                    }

                    if (response !== "1" && response !== "0") {



                    } 

            }
        });
    
    }
}


//Aktualisiere Werte im Scanner -> scanner_refresh.php

function refreshScanner() {


        if (refresh == true) {
            
            var blink= document.getElementById("scanner_content").innerHTML;
          
            $.ajax({
                url: 'scanner_refresh.php',
                success: function(response) { 

                    $("#scanner_content").replaceWith("<div id='scanner_content'>"+response+"</div>");
                    
                    //Scanner leuchtet auf bei neuen Wert

                    if (blink != document.getElementById("scanner_content").innerHTML) {

                        $(function () {
                                $("#scanner").addClass('highlighted');
                                setTimeout(function () {
                                    $("#scanner").removeClass('highlighted');
                                }, 2000);
                            });
                       
                        blink = document.getElementById("scanner_content").innerHTML; 

                    }
                }
            });

        }
}

setInterval(refreshScanner, 1000); //Aktualisiere Scanner jede Sekunde


//Entferne Gruppe von Funkgerät mit Gerätenamen als Parameter -> device_remove.php

function removeDevice(codename) {

    $.ajax({
                url: 'device_remove.php',
                type: 'get',
                async: false, 
                data: { "codename": codename},
                success: function(response) { 
                    alert(response);
                    reloadTab();
                }
            });
}


//Füge Funkgerätesignal hinzu -> device_add.php

function addDevice() {

    var codename = document.getElementById("form_codename").value;
    var protocol = document.getElementById("form_protocol").value;
    var pulselength = document.getElementById("form_pulselength").value;
    var value = document.getElementById("form_value").value;
    
    var action = document.querySelector('input[name="action"]:checked').value;
    var type = document.querySelector('input[name="type"]:checked').value;

    $.ajax({
                url: 'device_add.php',
                type: 'get',
                async: false, 
                data: { "codename": codename, "protocol": protocol, "pulselength": pulselength, "value": value, "action": action, "type":type},
                success: function(response) { 
                    alert(response);
                    reloadTab("3");
                }
            });
}


//Füge Gruppe hinzu -> group_add.php

function addGroup() {

    var groupname = document.getElementById("groupname").value;

    $.ajax({
                url: 'group_add.php',
                type: 'get',
                async: false, 
                data: { "groupname": groupname},
                success: function(response) { 
                    alert(response);
                    reloadTab("3");

                }
            });

}


//Entferne Gruppe -> group_remove.php

function removeGroup(groupname) {

    $.ajax({
                url: 'group_remove.php',
                type: 'get',
                async: false, 
                data: { "groupname": groupname},
                success: function(response) { 
                    alert(response);
                    reloadTab("1");
                }
            });

}


//Füge Funkgerät einer Gruppe hinzu -> group_manage_add.php

function manageAddGroup(codename) {

    var selectGroup = document.getElementById("group_manage_group");
    var groupname = selectGroup.options[selectGroup.selectedIndex].text;

    $.ajax({
                url: 'group_manage_add.php',
                type: 'get',
                async: false, 
                data: { "groupname": groupname, "codename": codename},
                success: function(response) { 
                    //alert(response);
                    reloadTab("1");
                }
            });
}


//Entferne Funkgerät aus aktueller Gruppe mit Gerätename als Parameter -> group_manage_remove.php

function manageRemoveGroup(codename) {

    $.ajax({
                url: 'group_manage_remove.php',
                type: 'get',
                async: false, 
                data: {"codename": codename},
                success: function(response) { 
                    alert(response);
                    reloadTab("1");
                }
            });
}


//Gibt Geräte in Gruppe (Parameter) in Popupfenster aus

function showGroups(groupname) {

    $.ajax({
                url: 'group_show.php',
                type: 'get',
                async: false, 
                data: {"groupname": groupname},
                success: function(response) { 

                     $('#group_show_group').replaceWith("<div id='group_show_group' class='modal-head'>"+groupname+"<a class='btn-close trigger' onclick='showGroups()'></a></div>");
                     
                     $('#group_show_groups').replaceWith("<div id='group_show_groups' class='modal-content'>"+response+"</div>");
                     
                     $('#groups_show').toggleClass('open');
                }
            });
}