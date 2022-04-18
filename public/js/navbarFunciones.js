function cerrarNavbar() {
    const mediaQuery = window.matchMedia('(max-width: 900px)')
    if (mediaQuery.matches) {
        $('.collapse').addClass('collapsing').collapse("hide")
    }
}
