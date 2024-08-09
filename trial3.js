document.getElementById("batchForm").addEventListener("submit", function(event) {
  event.preventDefault();
  generateBatches();
});

function generateBatches() {
  var department = document.getElementById("department").value;
  var semester = document.getElementById("semester").value;
  var totalStudents = parseInt(document.getElementById("totalStudents").value);
  var studentsPerBatch = parseInt(document.getElementById("studentsPerBatch").value);

  var startingNumber = 211721104125;
  var numBatches = Math.ceil(totalStudents / studentsPerBatch);
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "trial3.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4) {
      console.log("Response status:", xhr.status);
      console.log("Response text:", xhr.responseText);
      if (xhr.status == 200) {
        try {
          var batches = JSON.parse(xhr.responseText);
          displayBatches(batches);
        } catch (e) {
          console.error("Error parsing JSON response: ", e);
          console.log("Full response text:", xhr.responseText);
          alert("There was an error processing the response from the server.");
        }
      } else {
        console.error("Request failed. Status:", xhr.status);
        alert("There was an error with the request. Please try again.");
      }
    }
  };
  xhr.send("department=" + department + "&semester=" + semester + "&totalStudents=" + totalStudents + "&studentsPerBatch=" + studentsPerBatch);
}

function displayBatches(batches) {
  var result = "<h3>Generated Batches:</h3>";
  result += "<table>"; 
  result += "<tr><th>Batch</th><th>Starting Number</th><th>Ending Number</th><th>Total Students</th><th>Hostellers</th><th>Day Scholars</th><th>Male</th><th>Female</th></tr>";

  batches.forEach(function(batch) {
    result += "<tr>";
    result += "<td>Batch " + batch.batch_number + "</td>";
    result += "<td>" + batch.starting_number + "</td>";
    result += "<td>" + batch.ending_number + "</td>";
    result += "<td>" + batch.total_students + "</td>";
    result += "<td>" + batch.hostellers + "</td>";
    result += "<td>" + batch.dayscholars + "</td>";
    result += "<td>" + batch.males + "</td>";
    result += "<td>" + batch.females + "</td>";
    result += "</tr>";
  });

  result += "</table>"; 
  document.getElementById("result").innerHTML = result;
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
