
//Werte aus der Scanner-Ausgabe in Eingabefelder übertragen

function scannerTransfer() {

    var scanner_string = document.getElementById("scanner_content").innerHTML.split("|");
    
    var protocol = scanner_string[0];
    var pulselength = scanner_string[1];
    var value = scanner_string[2];  

    protocol = parseInt(protocol.replace(/\D/g, ""));
    pulselength = parseInt(pulselength.replace(/\D/g, ""));
    value = parseInt(value.replace(/\D/g, ""));
    
    document.getElementById("form_protocol").value = protocol;
    document.getElementById("form_pulselength").value = pulselength;
    document.getElementById("form_value").value = value;
}