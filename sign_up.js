
// Function to get a list of cities in Morocco
const moroccoCities = [
  'Casablanca', 'Rabat', 'Marrakech', 'Fes', 'Tangier', 'Agadir', 'Meknes', 'Oujda', 'Kenitra', 'Tetouan',
  'Essaouira', 'Nador', 'Safi', 'El Jadida', 'Beni Mellal', 'Taza', 'Khouribga', 'Mohammedia', 'Larache', 'Guelmim',
  'Khenifra', 'Berkane', 'Taourirt', 'Ouarzazate', 'Errachidia', 'Oued Zem', 'Taroudant', 'Temara', 'Souq Larb’a al Gharb','Sidi Slimane', 'Zagora', 'Taounate', 'Sidi Kacem', 'Midelt', 'Azrou', 'Chefchaouen', 'Tinghir', 'Al Hoceima', 'Settat','Sefrou', 'Youssoufia', 'Tan-Tan', 'Taourirte', 'Sidi Bennour', 'Skhirat', 'Sidi Yahia El Gharb', 'Sidi Ifni', 'Sid El Aidi','Sidi Qacem', 'Sidi Bennour', 'Setti Fatma', 'Sefrou', 'Sidi Bennour', 'Skoura', 'Smara', 'Souq Larbaa al Gharb','Sidi Slimane', 'Sidi Qacem', 'Settat', 'Sidi Bennour', 'Taounate', 'Tafraout', 'Tanger', 'Tan-Tan', 'Taourirt', 'Taourirte','Taroudant', 'Taza', 'Temara', 'Tetouan', 'Tiflet', 'Tinghir', 'Tiznit', 'Tiznit', 'Tlemcen', 'Tétouan', 'Zagora', 'Zaida','Zagora', 'Zaio', 'Zawyat an Nwaçer', 'Zemamra', 'Zerhoun', 'Zerkten', 'Zerhoun', 'Zinat', 'Ziz', 'Zoumi', 'Zrouila','Zug', 'Zeghanghane', 'Zerarda', 'Zirara', 'Zirh', 'Ziyad', 'Znada', 'Zougala', 'Zraibia', 'Zragta', 'Zuaghaia'];
// next and prev btn
const nextBtn=document.querySelector('.next-btn');
const prevBtn=document.querySelector('.prev-btn');
const formSections=document.querySelectorAll('.form-section');
let count = 0; 

nextBtn.addEventListener('click', () => {
    nextBtn.classList.add('hidden');
    prevBtn.classList.remove('hidden');
    count++;
    if (count >= formSections.length) {
        count = 1;
    }
    updateSlider();
});
prevBtn.addEventListener('click', (e) => {
    prevBtn.classList.add('hidden');
    nextBtn.classList.remove('hidden');
    count--;
    if (count < 0) {
        count = 0;
    }
    updateSlider();
});
function updateSlider() {
    formSections.forEach((section, index) => {
        section.style.transform = `translateX(${-count * 100}%)`;
    });
}
// function generate form if user choose role
function addCities(checkBoxCities){
    let blockCity="";
    moroccoCities.forEach((city)=>{
        blockCity+=`<label class="flex items-center py-2 px-4 z-50">
                    <input type="checkbox" name="cities[]" class="form-checkbox h-5 w-5 text-blue-500" value="${city}">
                    <span class="ml-2">${city}</span>
                </label>`;
    })
    checkBoxCities.innerHTML=blockCity;
}
function toggleDropdown() {
        const dropdownContent = document.getElementById("cityDropdown");
        dropdownContent.style.display = (dropdownContent.style.display === "block") ? "none" : "block";
}
const roles=document.querySelectorAll('.role');
const part2=document.querySelector('.part-2');
nextBtn.classList.add('hidden');
prevBtn.classList.add('hidden');
roles.forEach(role=>{
    role.addEventListener('click',(e)=>{
        const roleContent=e.currentTarget.previousElementSibling.textContent;
        if(roleContent==='Rental agency'){
            nextBtn.classList.remove('hidden');
            prevBtn.classList.add('hidden');
            nextBtn.classList.add('inline-block');
            prevBtn.classList.add('inline-block');
            part2.innerHTML=`<div class="relative z-0 w-full mb-5 group">
                        <input type="text" name="agency_name" id="agency_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  required/>
                        <label for="agency_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">agency name</label>
                    </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="business_registarion_number" id="business_registarion_number" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  required/>
                    <label for="business_registarion_number" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">business registarion number</label>
                </div>
                <div class="relative inline-block  text-center w-full mb-5 z-50 flex justify-between items-center gap-3">
                    <div class="basis-[30%]">
                    <div>
                        <button type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring focus:border-blue-300" id="options-menu" aria-haspopup="true" aria-expanded="true" onclick="toggleDropdown()">
                    Select Cities 
                        </button>
                    </div>
                    <div id="cityDropdown" class="  absolute left-0 mt-[20px] w-56 m rounded-md shadow-lg ring-1  ring-opacity-5 divide-y  overflow-y-auto max-h-60 bg-black opacity-70 text-white" style="display: none;">
                        <div class="py-1 checkbox-cities ">
                            <label class="flex items-center py-2 px-4">
                                    <input type="checkbox" name="cities[]" class="form-checkbox h-5 w-5 text-blue-500" value="">
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="relative z-0 w-full group basis-[70%] adresses">
                       
                    </div>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="file" name="articles_of_incorporation" id="articles_of_incorporation" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required/>
                    <label for="articles_of_incorporation" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">article of incorporation</label>
                </div>
                <div class="relative z-0 w-full  group mb-5">
                    <input type="file" name="registration_certificate" id="registration_certificate" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                        <label for="registration_certificate" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">registarion certificate</label>
                </div>
                
                <div class="relative z-0 w-full  group mb-5">
                    <input type="file" name="business_liability_inssurance" id="business_liability_inssurance" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required/>
                    <label for="username" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Business liability insurance</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="file"  name="credit_application" id="credit_application" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="credit_application" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Credit application</label>
                </div>
                <div class="relative z-0 w-full group mb-5">
                    <input type="file"  name="billing_information" id="billing_information" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  required/>
                    <label for="billing_information" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Billing information</label>
                </div>`;
                const checkBoxCities=document.querySelector('.checkbox-cities');
            addCities(checkBoxCities);
            const formCheckBoxes=document.querySelectorAll('.form-checkbox');
            formCheckBoxes.forEach(checkbox=>{
                checkbox.addEventListener('click',()=>{
                    const citiesChecked=document.querySelectorAll('.form-checkbox:checked');
                    const adresses=document.querySelector('.adresses');
                    let inputs="";
                    for(let i=0;i<citiesChecked.length;i++){
                        inputs+=`<input type="text" name="adress-${i+1}" id="business_registarion_number" class="block  w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="adress of city ${i+1}"  required/>`;
                    }
                    adresses.innerHTML=inputs;
                })
            })
        }
        if(roleContent==='Customer'){
            nextBtn.classList.remove('inline-block');
            prevBtn.classList.remove('inline-block');
            nextBtn.classList.add('hidden');
            prevBtn.classList.add('hidden');
            part2.innerHTML=`<div class="relative z-0 w-full mb-5 group">
                        nothing here
                    </div>
                `;
        }
        if(roleContent==='Entreprise'){
            nextBtn.classList.remove('hidden');
            nextBtn.classList.add('inline-block');
            prevBtn.classList.add('hidden');
            part2.innerHTML=`<div class="relative z-0 w-full mb-5 group">
                        <input type="text" name="entreprise_name" id="entreprise_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  required/>
                        <label for="entreprise_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">agency name</label>
                    </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="business_registarion_number_entreprise" id="business_registarion_number_entreprise" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  required/>
                    <label for="business_registarion_number_entreprise" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">business registarion number</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="file" name="articles_of_incorporation_entreprise" id="articles_of_incorporation_entreprise" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"required/>
                    <label for="articles_of_incorporation_entreprise" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">article of incorporation</label>
                </div>
                <div class="relative z-0 w-full  group mb-5">
                    <input type="file" name="registration_certificate_entreprise" id="registration_certificate_entreprise" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  required/>
                        <label for="registration_certificate_entreprise" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">registarion certificate</label>
                </div>
                
                <div class="relative z-0 w-full  group mb-5">
                    <input type="file" name="business_liability_inssurance_entreprise" id="business_liability_inssurance_entreprise" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required/>
                    <label for="business_liability_inssurance_entreprise" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Business liability insurance</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="file"  name="credit_application_entreprise" id="credit_application_entreprise" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  required/>
                    <label for="credit_application_entreprise" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Credit application</label>
                </div>
                <div class="relative z-0 w-full group mb-5">
                    <input type="file"  name="billing_information_entreprise" id="billing_information_entreprise" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  required/>
                    <label for="billing_information_entreprise" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Billing information</label>
                </div>`;
        }
    })
})
