

// javascript
const carBrands = ['Bmw',"Acura","Alfa Romeo","Aston Martin","Audi","Bentley","Bugatti","Buick","Cadillac","Chevrolet","Chrysler","Citroën","Dodge","Ferrari","Fiat","Ford","Genesis","GMC","Honda","Hyundai","Infiniti","Jaguar","Jeep","Kia","Lamborghini","Land Rover","Lexus","Lincoln","Lotus","Maserati","Mazda","McLaren","Mercedes-Benz","MINI","Mitsubishi","Nissan","Porsche","Ram","Rolls-Royce","Subaru","Tesla","Toyota","Volkswagen","Volvo"];

// Accessing a specific brand
brands=document.querySelector('.brands');
let accumulator="";
carBrands.forEach(brand=>{
    console.log('@@@');
    accumulator+=` <option value="${brand}" class="cursor-pointer text-orange">${brand}</option>`;
})
brands.innerHTML=accumulator;
