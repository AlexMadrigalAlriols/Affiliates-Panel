$(document).ready(function() {
    $('.select2').select2();

    const showNavbar = (toggleId, navId, bodyId, headerId) => {
        const toggle = $(`#${toggleId}`),
            nav = $(`#${navId}`),
            bodypd = $(`#${bodyId}`),
            headerpd = $(`#${headerId}`);

        // Validate that all variables exist
        if (toggle.length && nav.length && bodypd.length && headerpd.length) {
            toggle.on('click', () => {
                // show navbar
                nav.toggleClass('show');
                // change icon
                toggle.toggleClass('bx-x');
                // add padding to body
                bodypd.toggleClass('body-pd');
                // add padding to header
                headerpd.toggleClass('header-pd');
                headerpd.toggleClass('body-pd');
            });
        }
    };

    showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header');
});

function parseSelect2Results(results) {
    return Array.isArray(results) ? results : Object.values(results);
}
