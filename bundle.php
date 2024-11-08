<?php 
    include 'header.php'; 
    include 'INCLUDE/db_con.php';

    $query = mysqli_query($conn, "SELECT * FROM event");
    $query1 = mysqli_query($conn, "SELECT * FROM event");
?>
<title>Bundle Event</title>
<link rel="stylesheet" href="CSS/bundlex1sx.css">
<section>
    <div class="bundleContainer shadow border rounded" >
        <div class="type">
            <select name="typeSelect" id="typeSelect" onchange="selected()">
                <option value="">Type of Event</option>
                <?php while($data = mysqli_fetch_assoc($query)) { ?>
                    <option value="<?= $data['type_event'] ?>"><?= $data['type_event'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="eventRow border rounded" id="eventRowContainer">
            <?php while($data = mysqli_fetch_assoc($query1)) { ?>
            <div class="eventData" onclick="dataSelected(<?= $data['id'] ?>)">
                <img src="IMAGE/<?= $data['image'] ?>" alt="" width="100%" height="100%">
            </div>
            <?php } ?>
        </div>
    </div>
    <div class="eventContainer">
        <div class="title">
            <p>No Selected Event</p>
        </div>
        <div class="eventDescription">
            <p style="text-align: justify; padding: 2.5% 5% 5% 5%; font-family: Arial; font-size: 1.25vw">No selected event</p>
        <div class="d-flex align-items-center" style="border-top: solid 0.15vw black; position: absolute; top: 72.5%; height: 10.5%; width: 90%; display: flex">
            <p style="font-family: arial; font-size: 1.25vw; margin-left: 2.5%"><b>Pax:</b> <span id="quantity">25</span></p>
            <div class="ms-2 mt-1 h-100 d-flex gap-2" style="user-select: none">
                <i onclick="decrementQuantity()" class="bi bi-dash-square" style="cursor: pointer; font-size: 24px"></i>
                <i onclick="incrementQuantity()" class="bi bi-plus-square" style="cursor: pointer; font-size: 24px"></i>
            </div>
        </div>
        </div>
        <div class="eventButton">
            <button>Cancel</button>
            <button onclick="continueToSchedule()">Continue to Schedule</button>
        </div>
    </div>
</section>
<?php include 'footer.php'; ?>
<script>
    function selected() {
        var selectedValue = document.getElementById("typeSelect").value;
        var eventRowContainer = document.getElementById("eventRowContainer");
        if (selectedValue !== "") {
            var xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    eventRowContainer.innerHTML = this.responseText;
                }
            };

            xmlhttp.open("GET", "PHP/fetchEventData.php?type=" + selectedValue, true);
            xmlhttp.send();
        } else {
            eventRowContainer.innerHTML = "";
        }
    }

    function dataSelected(id) {
        var xmlhttp2 = new XMLHttpRequest();

        xmlhttp2.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var title = this.responseText;
                updateEventContainerTitleAndDescription(id, title);
            }
        };

        xmlhttp2.open("GET", "PHP/fetchEventDetails.php?id=" + id, true);
        xmlhttp2.send();
    }

    function updateEventContainerTitleAndDescription(id, title) {
        var eventContainerTitle = document.querySelector(".eventContainer .title p");
        var eventContainerDescription = document.querySelector(".eventContainer .eventDescription p");
        var quantityElement = document.getElementById("quantity");

        if (eventContainerTitle && eventContainerDescription && quantityElement) {
            eventContainerTitle.textContent = title;

            var xmlhttp3 = new XMLHttpRequest();

            xmlhttp3.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var data = JSON.parse(this.responseText);
                    eventContainerTitle.textContent = data.name;
                    eventContainerDescription.textContent = "Description:";
                    var descriptionParagraph = document.createElement('p');
                    descriptionParagraph.textContent = data.description;
                    eventContainerDescription.appendChild(descriptionParagraph);
                }
            };

            xmlhttp3.open("GET", "PHP/fetchEventDetails.php?id=" + id, true);
            xmlhttp3.send();
        }
    }

    function incrementQuantity() {
        var quantityElement = document.getElementById("quantity");
        var currentQuantity = parseInt(quantityElement.textContent);
        quantityElement.textContent = currentQuantity + 25;
    }

    function decrementQuantity() {
        var quantityElement = document.getElementById("quantity");
        var currentQuantity = parseInt(quantityElement.textContent);
        if (currentQuantity > 25) {
            quantityElement.textContent = currentQuantity - 25;
        }
    }
    function continueToSchedule() {
        var eventContainerTitle = document.querySelector(".eventContainer .title p").textContent;
        var quantityElement = document.getElementById("quantity").textContent;

        if (eventContainerTitle.trim() === "No Selected Event") {
            return;
        }

        var xmlhttp4 = new XMLHttpRequest();

        xmlhttp4.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                window.location.href = 'calendar.php';
            }
        };

        xmlhttp4.open("GET", "PHP/storeDataInSession.php?eventTitle=" + encodeURIComponent(eventContainerTitle) + "&quantity=" + encodeURIComponent(quantityElement), true);
        xmlhttp4.send();
    }
</script>
