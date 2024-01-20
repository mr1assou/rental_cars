



// javascript
const container=document.querySelector('.container');
// filter cart
const brand=document.querySelector('.brand');
const kindOfVehicle=document.querySelector('.kind_of_vehicle');
const minPrice=document.querySelector('.min_price');
const maxPrice=document.querySelector('.max_price');
const intervalId = setInterval(()=>{
    if(brand.value!=='Choose Brand' &&  kindOfVehicle.value==='kind of Vehicle' && minPrice.value=="0" && maxPrice.value=="0"){
        const parent=document.querySelectorAll('.parent');
        parent.forEach(parent=>{
            const kind=parent.querySelector('.kind');
            const price=parent.querySelector('.price');
            const brandCar=parent.querySelector('.brandCar');
            if(brand.value!==brandCar.textContent){
                if(parent.classList.contains('block')){
                    parent.classList.remove('block');
                    parent.classList.add('hidden');
                }
            }
            if(brand.value===brandCar.textContent){
                if(parent.classList.contains('hidden')){
                    parent.classList.remove('hidden');
                    parent.classList.add('block');
                }
            }
        });
    }
    if(brand.value!=='Choose Brand' &&  kindOfVehicle.value!=='kind of Vehicle' && minPrice.value=="0" && maxPrice.value=="0"){
        console.log('xxxxxxxxxxxxxx');
        const parent=document.querySelectorAll('.parent');
        parent.forEach(parent=>{
            const kind=parent.querySelector('.kind');
            const price=parent.querySelector('.price');
            const brandCar=parent.querySelector('.brandCar');
            if (brand.value === brandCar.textContent && kindOfVehicle.value === kind.textContent) {
    // Show the element if conditions are met
        if (parent.classList.contains('hidden')) {
                parent.classList.remove('hidden');
                parent.classList.add('block');
            }
        }
        else {
                if (parent.classList.contains('block')) {
                    parent.classList.remove('block');
                    parent.classList.add('hidden');
                }
            }
        });
    }
    if(kindOfVehicle.value!=='kind of Vehicle' &&  brand.value==='Choose Brand' && minPrice.value=="0" && maxPrice.value=="0"){
        const parent=document.querySelectorAll('.parent');
        parent.forEach(parent=>{
            const kind=parent.querySelector('.kind');
            const price=parent.querySelector('.price');
            const brandCar=parent.querySelector('.brandCar');
            if(kindOfVehicle.value!==kind.textContent){
                if(parent.classList.contains('block')){
                    parent.classList.remove('block');
                    parent.classList.add('hidden');
                }
            }
            if(kindOfVehicle.value===kind.textContent){
                if(parent.classList.contains('hidden')){
                    parent.classList.remove('hidden');
                    parent.classList.add('block');
                }
            }
        });
    }
    if (kindOfVehicle.value === 'kind of Vehicle' && brand.value === 'Choose Brand' && minPrice.value !== "0" && maxPrice.value !== "0") {
    const parent = document.querySelectorAll('.parent');
    const minPriceInteger = parseInt(minPrice.value);
    const maxPriceInteger = parseInt(maxPrice.value); 

    parent.forEach(parent => {
        const price = parseInt(parent.querySelector('.price').textContent);
        const brandCar = parent.querySelector('.brandCar');

        if (price >= minPriceInteger && price <= maxPriceInteger) {
            if (parent.classList.contains('hidden')) {
                parent.classList.remove('hidden');
                parent.classList.add('block');
            }
        } else {
            if (parent.classList.contains('block')) {
                parent.classList.remove('block');
                parent.classList.add('hidden');
            }
        }
    });
}
    if (kindOfVehicle.value === 'kind of Vehicle' && brand.value !== 'Choose Brand' && minPrice.value !== "0" && maxPrice.value !== "0") {
    const parent = document.querySelectorAll('.parent');
    const minPriceInteger = parseInt(minPrice.value);
    const maxPriceInteger = parseInt(maxPrice.value);
    parent.forEach(parent => {
            const price = parseInt(parent.querySelector('.price').textContent); 
            const brandCar = parent.querySelector('.brandCar');
            if (price >= minPriceInteger && price <= maxPriceInteger && brand.value===brandCar.textContent) {
                if (parent.classList.contains('hidden')) {
                    parent.classList.remove('hidden');
                    parent.classList.add('block');
                }
            } else {
                if (parent.classList.contains('block')) {
                    parent.classList.remove('block');
                    parent.classList.add('hidden');
                }
            }
        });
    }
    if (kindOfVehicle.value !== 'kind of Vehicle' && brand.value === 'Choose Brand' && minPrice.value !== "0" && maxPrice.value !== "0") {
    const parent = document.querySelectorAll('.parent');
    const minPriceInteger = parseInt(minPrice.value);
    const maxPriceInteger = parseInt(maxPrice.value);
    const kindOfVehicleValue = kindOfVehicle.value;
    parent.forEach(parent => {
            const kind = parent.querySelector('.kind').textContent;
            const price = parseInt(parent.querySelector('.price').textContent);
            const brandCar = parent.querySelector('.brandCar');
            if (price >= minPriceInteger && price <= maxPriceInteger && kindOfVehicleValue === kind) {
                if (parent.classList.contains('hidden')) {
                    parent.classList.remove('hidden');
                    parent.classList.add('block');
                }
            } else {
                if (parent.classList.contains('block')) {
                    parent.classList.remove('block');
                    parent.classList.add('hidden');
                }
            }
        });
    }
    if (kindOfVehicle.value !== 'kind of Vehicle' && brand.value !== 'Choose Brand' && minPrice.value !== "0" && maxPrice.value !== "0") {
        const parent = document.querySelectorAll('.parent');
        const minPriceInteger = parseInt(minPrice.value);
        const maxPriceInteger = parseInt(maxPrice.value);
        const kindOfVehicleValue = kindOfVehicle.value;
        const brandValue = brand.value;
        parent.forEach(parent => {
        const kind = parent.querySelector('.kind').textContent;
        const price = parseInt(parent.querySelector('.price').textContent);
        const brandCar = parent.querySelector('.brandCar');
            if (price >= minPriceInteger && price <= maxPriceInteger && kindOfVehicleValue === kind && brandValue === brandCar.textContent) {
                if (parent.classList.contains('hidden')) {
                    parent.classList.remove('hidden');
                    parent.classList.add('block');
                }
            } else {
                if (parent.classList.contains('block')) {
                    parent.classList.remove('block');
                    parent.classList.add('hidden');
                }
            }
        });
    }
}, 1000);

