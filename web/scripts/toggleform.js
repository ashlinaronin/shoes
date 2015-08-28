var toggleBtn = document.getElementById('togglebtn');
var updateFormDiv = document.getElementById('update_form');

toggleBtn.onclick = function() {
    updateFormDiv.style.display = (
        (updateFormDiv.style.display != 'block') ? 'block' : 'none'
    );
    toggleBtn.innerHTML = (
        (toggleBtn.innerHTML != 'Hide') ? 'Hide' : 'Edit'
    );
};
