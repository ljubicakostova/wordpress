// Java Document

jQuery(function () {

      // Slideshow
      jQuery("#slider4").responsiveSlides({
        namespace: "callbacks",
        auto: true,
        pager: true,
        speed: 500,
      });

      // Responsive menu TinyNav.js
      jQuery('#nav').tinyNav({
        active: 'selected',
        header: 'Menu'
      });
      jQuery('#nav2').tinyNav({
        header: 'Navigation' // Writing any title with this option triggers the header
      });

    });

