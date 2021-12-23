( function() {
    const target = document.getElementById( 'h_wrap' ),
    height = 56;
    let offset = 0,
    lastPosition = 0,
    ticking = false;

    target.classList.add( 'h_wrap_fixed' );

    function onScroll() {
        if( lastPosition > height ) {
            if( lastPosition > offset ) {
                target.classList.add( 'h_wrap_down' );
            } else {
                target.classList.remove( 'h_wrap_down' );
            }
            offset = lastPosition;
        }
    }

    window.addEventListener( 'scroll', function(e) {
        lastPosition = window.pageYOffset;;

        if( !ticking ) {
            window.requestAnimationFrame( function() {
                onScroll( lastPosition );
                ticking = false;
            });
            ticking = true;
        }
    });
})();