// Icon Optimizer JavaScript
// Ensures proper icon loading and fallbacks

document.addEventListener('DOMContentLoaded', function() {
    // Optimize icon loading
    const icons = document.querySelectorAll('.fas, .far, .fab');
    
    icons.forEach(icon => {
        // Add loading optimization
        icon.style.fontDisplay = 'swap';
        
        // Ensure proper alignment
        if (icon.closest('.btn')) {
            icon.style.marginRight = '4px';
        }
        
        if (icon.closest('.nav-link')) {
            icon.style.width = '16px';
            icon.style.textAlign = 'center';
        }
    });
    
    // Logo optimization
    const logos = document.querySelectorAll('.navbar-logo');
    logos.forEach(logo => {
        logo.addEventListener('error', function() {
            // Fallback if logo fails to load
            this.style.display = 'none';
            console.warn('Logo failed to load, hiding element');
        });
        
        logo.addEventListener('load', function() {
            // Optimize loaded logo
            this.style.imageRendering = 'crisp-edges';
        });
    });
    
    // Icon hover optimization
    const hoverIcons = document.querySelectorAll('.nav-link .fas, .btn .fas');
    hoverIcons.forEach(icon => {
        icon.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.1)';
            this.style.transition = 'transform 0.2s ease';
        });
        
        icon.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });
});

// Utility function to check icon loading
function checkIconsLoaded() {
    const fontAwesome = document.querySelector('link[href*="font-awesome"]');
    if (fontAwesome) {
        fontAwesome.addEventListener('load', function() {
            document.body.classList.add('icons-loaded');
        });
    }
}

checkIconsLoaded();