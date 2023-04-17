// Function to dynamically change attributes based on selected type
function changeAttributes() {
    var type = document.getElementById('productType').value;
    var attributesContainer = document.getElementById('attributesContainer');
    attributesContainer.innerHTML = '';

    if (type === 'Furniture') {
        attributesContainer.innerHTML = '<label for="height">Height ' +
            '<input id="height" name="height" aria-label="height" type="number"  step="any" required min="0" oninput="validity.valid||(value=\'\');" >\n'+
            '</label>'+
            '<label for="width">Width '+
            '<input id="width" name="width" aria-label="width" type="number" step="any" required min="0" oninput="validity.valid||(value=\'\');" >\n'+
            '</label>'+
            '<label for="length">Length '+
            '<input id="length" name="length" aria-label="length" type="number" step="any" required min="0" oninput="validity.valid||(value=\'\');" >\n'+
            '</label>'+
            '<div><span>Please provide dimensions in HxWxL.</span></div>';
    } else if (type === 'Book') {
        attributesContainer.innerHTML = '<label for="weight">Weight ' +
            '<input name="weight" id="weight" aria-label="weight" type="number" step="any" required min="0" oninput="validity.valid||(value=\'\');" >'+
            '</label>'+
            '<div><span>Please provide weight in KG.</span></div>';

    } else if (type === 'DVD') {
        attributesContainer.innerHTML = '<label for="size">Size ' +
            '<input name="size" id="size" aria-label="size" type="number"  step="any" required  min="0" oninput="validity.valid||(value=\'\');" >' +
            '</label>'+
            '<div><span>Please provide size in MB.</span></div>';

    }
}

function saveFormValidation(){
    let allAreFilled = true;
    document.getElementById("product_form").querySelectorAll("[required]").forEach(function(i) {
        if (!allAreFilled) return;
        if (!i.value) { allAreFilled = false;  return; }
    })
    if (!allAreFilled) {
        document.getElementById("error").style.display="block";

    }
}

$('#product_form').submit(function(event) {
    event.preventDefault();
    var formData = $(this).serialize();

    $.ajax({
        url: 'http://127.0.0.1/scandiweb/src/backend/Classes/AddProduct.php',
        type: 'post',
        dataType: 'json',
        data: formData,
        success: function(response) {
            // Parse the JSON response
            var result = JSON.parse(response);
        },
        error: function(xhr, textStatus, errorThrown) {

            if(xhr.statusText==="OK" || xhr.responseText.includes("success"))
            {
                window.location.href = "/";
            }
            else {
                $('#error-result').text('Error occurred. Please try again later.');

            }
        }
    });
});