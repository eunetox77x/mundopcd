document.addEventListener("DOMContentLoaded", function() {
    const animatedText = document.getElementById('animated-text');
    setTimeout(function() {
        animatedText.style.opacity = 1;
        animatedText.style.transform = 'translateY(0)';
    }, 500); 
});

const button = document.getElementById('animated-button');

button.addEventListener('mouseover', function() {
    button.style.backgroundColor = '#065fc4';  
});

button.addEventListener('mouseout', function() {
    button.style.backgroundColor = '#0e81fd'; 
});
