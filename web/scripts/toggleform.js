var toggleBtn = document.getElementById('togglebtn');
var updateFormDiv = document.getElementById('update_form');

toggleBtn.onclick = function() {
    if (updateFormDiv.style.display == 'none') {
        toggleBtn.innerHTML = "Hide update form";
        updateFormDiv.style.display = 'block';

    } else {
        toggleBtn.innerHTML = "Update store info";
        updateFormDiv.style.display = 'none';

    };
};
