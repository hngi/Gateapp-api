   //Get the Modal DOM Values
let estateId    = document.querySelector('#estateId');
let estateName  = document.querySelector('#estateName');
let estateLocation = document.querySelector('#estateLocation');
let estateImage = document.querySelector('#estateImage');
let estateCreated = document.querySelector('#estateCreated');

console.log(estateId)

const displayEstateInfoToModal = (event, viewEstateBtn) => {
   const id            = viewEstateBtn.dataset.estateId;
   const estate_name   = viewEstateBtn.dataset.estateName;
   const estate_img    = viewEstateBtn.dataset.estateImg;
   const location      = viewEstateBtn.dataset.estateLocation;
   const created_at    = viewEstateBtn.dataset.estateCreated;

   // Check your console to see the estate info
   console.log(id,  estate_name, location, created_at, estate_img )

   //Throw it in to the Modal
   //Throw the estate id into the modal get (for simplicity to use the id for other purpose api)\
   estateId.innerHTML       = id;
   estateName.innerHTML     = estate_name;
   estateLocation.innerHTML = location;
   estateCreated.innerHTML  = created_at;

   //Setting the Image
   if(estate_img != 'gateguard-logo.png'){
      estateImage.innerHTML = `<img class="estate-img-view-sty" src="https://res.cloudinary.com/getfiledata/image/upload/${estate_img}">`;
   }
}








