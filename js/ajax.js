window.onload = function () {
    document.getElementById('convertBtn').onclick = function() {
        inputText = document.getElementById('targetInput').value;
        number = document.getElementById('targetNumber').value;
        operation = document.getElementById('targetOperation').value;
        if (inputText) {
            fetch('/temp/main/convert?text=' + encodeURIComponent(inputText) + 
                  '&operation=' + encodeURIComponent(operation) +
                  '&number=' + encodeURIComponent(number), {
                method: "GET",
            })
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                document.getElementById('targetOutput').value = data['text'];
            })
        }
    }
}