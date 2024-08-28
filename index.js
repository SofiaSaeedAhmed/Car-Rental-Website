// events that occur when the buttons in car_index.php are clicked
const cars = document.querySelector('.cars');
const luxury = document.querySelector('.luxury');
const sports = document.querySelector('.sports');
const classic = document.querySelector('.classic');
const luxurySection = document.querySelector('.luxury-section');
const sportsSection = document.querySelector('.sports-section');
const classicSection = document.querySelector('.classic-section');
const carsBox = document.querySelector('.cars-box');
const updateContainer = document.querySelector('.update-container');
const cancelContainer = document.querySelector('.cancel-container');

luxury.addEventListener('click', function(){
    luxury.classList.add('true');
    sports.classList.remove('true');
    classic.classList.remove('true');
    luxurySection.style.display = 'block';
    sportsSection.style.display = 'none';
    classicSection.style.display = 'none';
});

sports.addEventListener('click', function(){
    sports.classList.add('true');
    luxury.classList.remove('true');
    classic.classList.remove('true');
    sportsSection.style.display = 'block';
    luxurySection.style.display = 'none';
    classicSection.style.display = 'none';
});

classic.addEventListener('click', function(){
    classic.classList.add('true');
    luxury.classList.remove('true');
    sports.classList.remove('true');
    classicSection.style.display = 'block';
    luxurySection.style.display = 'none';
    sportsSection.style.display = 'none';
});