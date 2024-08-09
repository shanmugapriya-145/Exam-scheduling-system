document.addEventListener("DOMContentLoaded", function () {
    function getUrlParameter(name) {
        name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        var results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    }
    var startNumber = getUrlParameter('startNumber');
    var endNumber = getUrlParameter('endNumber');
    var batchNumber = getUrlParameter('batchNumber');
    var dataAdded = sessionStorage.getItem('dataAdded');
    if (!dataAdded) {
        sessionStorage.setItem('dataAdded', true);
    }
    document.getElementById('startNumber').value = startNumber;
    document.getElementById('endNumber').value = endNumber;
    document.getElementById('batchNumber').value = batchNumber;
    var preservedValues = {
        startNumber: startNumber,
        endNumber: endNumber,
        batchNumber: batchNumber
    };
    document.getElementById("submit").addEventListener("click", function (event) {
        event.preventDefault(); 
        document.getElementById('startNumber').value = preservedValues.startNumber;
        document.getElementById('endNumber').value = preservedValues.endNumber;
        document.getElementById('batchNumber').value = preservedValues.batchNumber;
    });
    
    function viewSchedule() {
        var semester = document.getElementById("semester").value;
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "view_schedule.php?semester=" + semester, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.querySelector(".content table").innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    }
});
