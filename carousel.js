const carouselSlide = document.querySelector('.carousel-slide');
const carouselImages = document.querySelectorAll('.carousel-slide img');

// buttons
const prevBtn = document.querySelector('#prevBtn');
const nextBtn = document.querySelector('#nextBtn');

// Counter
let counter = 1;

// width of picture
// const size = carouselImages[1].clientWidth;
const size = 500;
carouselSlide.style.transform = 'translateX(' + (-size * counter) + 'px)';

nextBtn.addEventListener('click',()=>{
    if (counter >= carouselImages.length -1) return;
carouselSlide.style.transition = "2.0s";
counter++;
carouselSlide.style.transform = 'translateX(' + (-size * counter) + 'px)';

});

prevBtn.addEventListener('click',()=>{
    if (counter <= 0) return;
    carouselSlide.style.transition = "2.0s";
    counter--;
    carouselSlide.style.transform = 'translateX(' + (-size * counter) + 'px)';
    
    });

// Carousel transition
carouselSlide.addEventListener('webkitTransitionEnd', () => {
   
if (carouselImages[counter].id === 'la'){
    carouselSlide.style.transition = "none";
    counter = carouselImages.length-2;
    carouselSlide.style.transform = 'translateX(' + (-size * counter) + 'px)';
}

if (carouselImages[counter].id === 'fi'){
    carouselSlide.style.transition = "none";
    counter = carouselImages.length-counter;
    carouselSlide.style.transform = 'translateX(' + (-size * counter) + 'px)';
}
});
setInterval(function(){
    document.getElementById('nextBtn').click();
}, 5000);