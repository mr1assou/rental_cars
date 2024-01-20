

// javascript
console.log('@@@@');
// section 2
oneDay=24*60*60*1000
oneHour=60*60*1000;
oneMinute=60*1000;
oneSecond=1000;

const parents=document.querySelectorAll('.parent');
if(parents!==null){
    parents.forEach(parent=>{
        const startDate=parent.querySelector('.start-date');
        const difference=parent.querySelector('.difference');
        value=parseInt(difference.textContent);
        const days=parent.querySelector('.days');
        const hours=parent.querySelector('.hours');
        const minutes=parent.querySelector('.minutes');
        const seconds=parent.querySelector('.secondes');
        const message=document.querySelector('.message');
        console.log(startDate);
        console.log(difference.textContent);
        if(value<=15){
            let deadlineStartDate=new Date(startDate.textContent).getTime();
            let deadlineReservationDate=new Date().getTime();
            let intervalId=setInterval(()=>{
                t=deadlineStartDate-deadlineReservationDate;
                restDays=Math.floor(t/oneDay)
                restHours=Math.floor((t%oneDay)/oneHour)
                restMinutes=Math.floor((t%oneHour)/oneMinute)
                restSeconds=Math.floor((t%oneMinute)/1000)
                days.textContent=restDays;
                hours.textContent=restHours;
                minutes.textContent=restMinutes;
                seconds.textContent=restSeconds;
                deadlineReservationDate+=1000;
                if (t <= 0) {
                    clearInterval(intervalId); 
                    days.textContent='00';
                    hours.textContent='00';
                    minutes.textContent='00';
                    seconds.textContent='00';
                    message.innerHTML='<p  class="font-black text-blue">Reservation will be deleted. Please go to the agency now</p>';
                }
            },1000)
        }
        else{
            let reservationDate=parent.querySelector('.reservation-date');
            reservationDate=new Date(reservationDate.textContent);
            reservationDate.setDate(reservationDate.getDate() + 16);
            let deadlineReservationDate=new Date().getTime();
            let intervalId=setInterval(()=>{
                t=reservationDate-deadlineReservationDate;
                restDays=Math.floor(t/oneDay)
                restHours=Math.floor((t%oneDay)/oneHour)
                restMinutes=Math.floor((t%oneHour)/oneMinute)
                restSeconds=Math.floor((t%oneMinute)/1000)
                days.textContent=restDays;
                hours.textContent=restHours;
                minutes.textContent=restMinutes;
                seconds.textContent=restSeconds;
                deadlineReservationDate+=1000;
                if (t <= 0) {
                    clearInterval(intervalId); 
                    days.textContent='00';
                    hours.textContent='00';
                    minutes.textContent='00';
                    seconds.textContent='00';
                    days.addc
                    message.innerHTML='<p  class="font-black text-blue">Reservation will be deleted. Please go to the agency now</p>';
                }
            },1000)
        }
    })
}
