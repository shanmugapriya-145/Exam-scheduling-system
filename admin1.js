function generateBatch() {
    var department = document.getElementById('department').value;
    var semester = document.getElementById('semester').value;
    var totalStudents = parseInt(document.getElementById('totalStudents').value);
    var studentsPerBatch = parseInt(document.getElementById('studentsPerBatch').value);
    if (!department) {
        department = 'CSE' + (211721104124+ Math.floor(Math.random() * 10));
    }
    var numberOfBatches = Math.ceil(totalStudents / studentsPerBatch);
    var tableHtml = '<table border="1">';
    tableHtml += '<tr><th>Batch No</th><th>Start Number</th><th>End Number</th><th>Actions</th></tr>';
    
    for (var i = 1; i <= numberOfBatches; i++) {
        var startNumber = 211721104100 + (i - 1) * studentsPerBatch + 1;
        var endNumber = Math.min(startNumber + studentsPerBatch - 1, 211721104100 + totalStudents);

        tableHtml += '<tr>';
        tableHtml += '<td>Batch ' + i + '</td>';
        tableHtml += '<td>' + startNumber + '</td>';
        tableHtml += '<td>' + endNumber + '</td>';
        tableHtml += '<td><button onclick="showBatchDetails(' + i + ', ' + startNumber + ', ' + endNumber + ')">Details</button></td>';
        tableHtml += '</tr>';
    }
    tableHtml += '</table>';
    document.getElementById('batchTableContainer').innerHTML = tableHtml;
    var batchInfoHtml = '<p>Department: ' + department + '</p>';
    batchInfoHtml += '<p>Semester: ' + semester + '</p>';
    batchInfoHtml += '<p>Total Students: ' + totalStudents + '</p>';
    batchInfoHtml += '<p>Students Per Batch: ' + studentsPerBatch + '</p>';
    document.getElementById('batchInfoContainer').innerHTML = batchInfoHtml;
}
function showBatchDetails(batchNumber, startNumber, endNumber) {
    var url = 'varsh.php?batchNumber=' + batchNumber + '&startNumber=' + startNumber + '&endNumber=' + endNumber;
    window.location.href = url;
}
document.addEventListener("DOMContentLoaded", () => {
    let menuicn = document.querySelector(".menuicn");
    let nav = document.querySelector(".navcontainer");

    menuicn.addEventListener("click", () => {
        nav.classList.toggle("navclose");
    });
    document.addEventListener("click", (event) => {
        const isNavcontainer = event.target.closest(".navcontainer");
        const isMenuicn = event.target.closest(".menuicn");

        if (!isNavcontainer && !isMenuicn) {
            nav.classList.add("navclose");
        }
    });
});