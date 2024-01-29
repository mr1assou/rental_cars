

// javascript 
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
    if(calendar.classList.contains('hidden')){
        calendar.classList.remove('hidden');
        calendar.classList.add('block');
        if(calendar2.classList.contains('block')){
            calendar2.classList.remove('block');
            calendar2.classList.add('hidden');
        }
    }
    else{
        calendar.classList.remove('block');
        calendar.classList.add('hidden');
    }
})

// logic of calendar
const currentDate=document.querySelector('.current-date');
const days=document.querySelector('.days');
const prev=document.querySelector('.prev');
const next=document.querySelector('.next');
// getting new date,current year and month
let date=new Date();
let currYear=date.getFullYear();
let grapYear=currYear;
let currMonth=date.getMonth();
let grapMonth=currMonth;
let currDay=date.getDate();
let currMonth2=currMonth;
let currYear2=currYear;
// months
const months=["january","February","March","April","May","June","July","August","September","October","November","December"];
let day="";
const renderCalendar=(currYear,currMonth,currDay,grapYear,days,customClass,currentDate)=>{
    // get last date of months
    let lastDateofMonth=new Date(currYear,currMonth+1,0).getDate();
    for(let i=1;i<=lastDateofMonth;i++){
        if((i<currDay && currMonth==grapMonth && currYear<=grapYear) || (currMonth<grapMonth && currYear<=grapYear) || (currYear<grapYear)){
            day+=`<p class=" font-black w-[3rem] text-center bg-white  flex items-center justify-center rounded-full hover:bg-orange hover:text-white cursor-pointer py-3 line-through text-grey ${customClass} text-sm">${i}</p>`
        }
        else{
            day+=`<p class=" text-black font-black w-[3rem] text-center bg-white  flex items-center justify-center rounded-full hover:bg-orange hover:text-white cursor-pointer py-3 ${customClass} text-sm">${i}</p>`
        }
    }
    days.innerHTML=day;
    // appear the current date
    currentDate.textContent=`${months[currMonth]} ${currYear}`;
    day="";
}
const currentDate2=document.querySelector('.current-date2');
const startDateAll=document.querySelectorAll('.start_date'); 
const endDateAll=document.querySelectorAll('.end_date');
renderCalendar(currYear,currMonth,currDay,grapYear,days,'day',currentDate);
// preventUserSelect();
startDateAll.forEach((startDate,index)=>{
    preventUserSelect(startDate,endDateAll[index]);
})
function preventUserSelect(startDate,endDate){
// add text-grey that they are reserved
if(startDate!==null && endDate!==null){
    let date1=new Date(startDate.textContent);
    let date2=new Date(endDate.textContent);
    // time difference in millisecondes
    let date1Operation=new Date(startDate.textContent);
    let timeDifference=date2-date1;
    let secondsDifference = timeDifference / 1000;
    let minutesDifference = secondsDifference / 60;
    let hoursDifference = minutesDifference / 60;
    let daysDifference = Math.ceil(hoursDifference / 24);
    const Days=document.querySelectorAll('.day');
    const Days2=document.querySelectorAll('.day2');
    let currentDate3=document.querySelector('.current-date');
    let currentDate4=document.querySelector('.current-date2');
    let count=0;
    for(let i=0;i<=daysDifference;i++){
        date1Operation.setDate(date1Operation.getDate()+count);
        year=date1Operation.getFullYear();
        actualMonth=months[date1Operation.getMonth()];
        day=date1Operation.getDate();
        currentDate3=currentDate.textContent.split(" ");
        currentDate4=currentDate2.textContent.split(" ");
        Days.forEach(DAY=>{
        if(DAY.textContent==day && currentDate3[0]==actualMonth && currentDate3[1]==year){
                DAY.classList.add('text-grey');
            }
        })
        Days2.forEach(DAY=>{
                if(DAY.textContent==day && currentDate4[0]==actualMonth && currentDate4[1]==year){
                    console.log(DAY);
                    DAY.classList.add('text-grey');
                }
            })
        if(count==0){
            count++;
            }
        }
    }
}
// global varibale select days each time user click prev or next && and select input
const inputDate=document.querySelector('.input-date');
const outputDate=document.querySelector('.output-date');
let selectDays=document.querySelectorAll('.day');
const alert=document.querySelector('.alert');
clickDays(selectDays,inputDate,outputDate,alert);
// prev Btn
prev.addEventListener('click',(e)=>{
    day="";
    currMonth=currMonth-1;
    if(currMonth===-1){
        currYear-=1;
        currMonth=11;
    }
    renderCalendar(currYear,currMonth,currDay,grapYear,days,'day',currentDate);
    // preventUserSelect();
    startDateAll.forEach((startDate,index)=>{
    preventUserSelect(startDate,endDateAll[index]);
    })
    selectDays=document.querySelectorAll('.day');
    clickDays(selectDays,inputDate,outputDate,alert);
})
// next Btn
next.addEventListener('click',()=>{
    day="";
    currMonth=currMonth+1;
    if(currMonth===12){
        currYear+=1;
        currMonth=0;
    }
    renderCalendar(currYear,currMonth,currDay,grapYear,days,'day',currentDate);
    // preventUserSelect();
    startDateAll.forEach((startDate,index)=>{
        preventUserSelect(startDate,endDateAll[index]);
    })
    selectDays=document.querySelectorAll('.day');
    clickDays(selectDays,inputDate,outputDate,alert);
})
// fill input calendar
function clickDays(selectDays,inputDate,outputDate,alert){
    selectDays.forEach(day=>{
            day.addEventListener('click',()=>{
            const check=day.classList.contains('text-grey');
            if(!check){
                inputDate.value=`${currYear}-${currMonth+1}-${day.textContent}`;
                outputDate.textContent=`${currYear}-${currMonth+1}-${day.textContent}`;
            }
            else{
                alertDanger(alert);        
            }
        })    
    })
}
function clickDays2(selectDays,inputDate,outputDate,alert){
    selectDays.forEach(day=>{
            day.addEventListener('click',()=>{
            const check=day.classList.contains('text-grey');
            if(!check){
                inputDate.value=`${currYear2}-${currMonth2+1}-${day.textContent}`;
                outputDate.textContent=`${currYear2}-${currMonth2+1}-${day.textContent}`;
            }
            else{
                alertDanger(alert);        
            }
        })    
    })
}
function alertDanger(alert){
    alert.classList.remove('hidden');
        alert.classList.add('block');
        setTimeout(()=>{
        alert.classList.remove('block');
        alert.classList.add('hidden');
    },2000)
}
// fill input time
const selectOptions = document.querySelector('.select-options');
const outputTime = document.querySelector('.output-time');
const inputTime = document.querySelector('.input-time');

selectOptions.addEventListener('change', function () {
    const selectedOption = this.options[this.selectedIndex];
    outputTime.textContent = selectedOption.textContent;
    inputTime.value = selectedOption.value;
});

// choose return date and return time
const inputDate2=document.querySelector('.input-date2');
const outputDate2=document.querySelector('.output-date2');
const calendar2=document.querySelector('.calendar2');

const days2=document.querySelector('.days2');
const prev2=document.querySelector('.prev2');
const next2=document.querySelector('.next2');
const toggleCalendar2=document.querySelector('.toggle-calendar2');
const alert2=document.querySelector('.alert2');
day="";
renderCalendar(currYear,currMonth,currDay,grapYear,days2,'day2',currentDate2);
// preventUserSelect();
startDateAll.forEach((startDate,index)=>{
        preventUserSelect(startDate,endDateAll[index]);
})
let selectDays2=document.querySelectorAll('.day2');
clickDays2(selectDays2,inputDate2,outputDate2,alert2);
prev2.addEventListener('click',(e)=>{
    day="";
    currMonth2=currMonth2-1;
    if(currMonth2===-1){
        currYear2-=1;
        currMonth2=11;
    }
    renderCalendar(currYear2,currMonth2,currDay,grapYear,days2,'day2',currentDate2);
    // preventUserSelect();
    startDateAll.forEach((startDate,index)=>{
        preventUserSelect(startDate,endDateAll[index]);
    })
    selectDays2=document.querySelectorAll('.day2');
    clickDays2(selectDays2,inputDate2,outputDate2,alert2);
})
// // next Btn
next2.addEventListener('click',()=>{
    day="";
    currMonth2=currMonth2+1;
    if(currMonth2===12){
        currYear2+=1;
        currMonth2=0;
    }
    renderCalendar(currYear2,currMonth2,currDay,grapYear,days2,'day2',currentDate2);
    // preventUserSelect();
    startDateAll.forEach((startDate,index)=>{
        preventUserSelect(startDate,endDateAll[index]);
    })
    selectDays2=document.querySelectorAll('.day2');
    clickDays2(selectDays2,inputDate2,outputDate2,alert2);
})
toggleCalendar2.addEventListener('click',()=>{
    if(calendar2.classList.contains('hidden')){
        calendar2.classList.remove('hidden');
        calendar2.classList.add('block');
        if(calendar.classList.contains('block')){
            calendar.classList.remove('block');
            calendar.classList.add('hidden');
        }
    }
    else{
        calendar2.classList.remove('block');
        calendar2.classList.add('hidden');
    }
})
// fill input time
const selectOptions2 = document.querySelector('.select-options2');
const outputTime2 = document.querySelector('.output-time2');
const inputTime2 = document.querySelector('.input-time2');

selectOptions2.addEventListener('change', function () {
    const selectedOption2 = this.options[this.selectedIndex];
    outputTime2.textContent = selectedOption2.textContent;
    inputTime2.value = selectedOption2.value;
});

outputTime2.textContent ="8:00";
inputTime2.value ="8:00";
outputTime.textContent ="8:00";
inputTime.value ="8:00";