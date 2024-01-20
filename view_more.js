const images=document.querySelectorAll('.images');
const parentImage=document.querySelector('.parent_image');
images.forEach(image=>{
    image.addEventListener('click',(e)=>{
        const src=e.currentTarget.firstElementChild;
        parentImage.src=src.src;
    })
})
// display calendar
const calendar=document.querySelector('.calendar');
const toggleCalendar=document.querySelector('.toggle-calendar');
toggleCalendar.addEventListener('click',()=>{
    calendar.classList.toggle('hidden');
})