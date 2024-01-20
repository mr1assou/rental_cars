 document.getElementById('countryDropdown').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var link = selectedOption.getAttribute('data-link');

        if (link) {
            window.location.href = link;
        }
    });