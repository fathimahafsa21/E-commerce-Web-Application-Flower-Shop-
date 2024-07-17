//user box section

const userBtn = document.querySelector('#user-btn');
userBtn.addEventListener('click', function(){
    const userBox = document.querySelector('.profile');
    userBox.classList.toggle('active');
})

//navbar section

const toggle = document.querySelector('#menu-btn');
toggle.addEventListener('click', function(){
    const navbar = document.querySelector('.navbar');
    navbar.classList.toggle('active');
})

//search section

let searchForm = document.querySelector('.search-form');
document.querySelector('#search-btn').onclick = () =>{
    searchForm.classList.toggle('active');
    userBox.classList.remove('active');
}

//slider section
let slider = document.querySelectorAll('.slider-item');
let index = 0;

function nextSlide(){
    slider[index].classList.remove('active');
    index = (index + 1) % slider.length;
    slider[index].classList.add('active');
}

function prevSlide(){
    slider[index].classList.remove('active');
    index = (index - 1 + slider.length) % slider.length;
    slider[index].classList.add('active');
}

//timer

(function () {
    const second = 1000,
        minute = second * 60,
        hour = minute * 60,
        day = hour * 24;

        let today = new Date(),
            dd = String(today.getDate()).padStart(2,"0"),
            mm = String(today.getMonth() + 1).padStart(2,"0"),
            yyyy = today.getFullYear(),
            nextYear = yyyy + 1,
            dayMonth = "09/30/",
            birthday = dayMonth + yyyy;

            today = mm + "/" + dd + "/" + yyyy;
            if(today > birthday) {
                birthday = dayMonth + nextYear;
            }

            //end

            const countDown = new Date(birthday).getTime(),
            x = setInterval(function () {
                const now = new Date().getTime(),
                distance = countDown - now;

                document.getElementById("days").innerText = Math.floor(distance / (day));
                document.getElementById("hours").innerText = Math.floor(distance % (day) / (hour));
                document.getElementById("minutes").innerText = Math.floor(distance % (hour) / (minute));
                document.getElementById("seconds").innerText = Math.floor(distance % (minute) / (second));
            }, 0)



}());