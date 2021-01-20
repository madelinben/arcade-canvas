$(document).ready(function() {
    $(document).click(function(e) {
        const targetElement = e.target.className;
        //alert(targetElement.toString());
        const dropdownContent = $(".dropdown-visibility");
        if (targetElement === 'dropdown-action') {
            $('.dropdown-visibility').toggle();
        } else if (dropdownContent.is(":visible") && (!dropdownContent.is(e.target) && dropdownContent.has(e.target).length===0)) {
            dropdownContent.hide();
        }
    });
});