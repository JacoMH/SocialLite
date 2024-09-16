const fileSelector = document.getElementById('image');
fileSelector.addEventListener('change', (event) => {
  const fileList = event.target.files;
  console.log(fileList);
  const reader = new FileReader();
reader.addEventListener('load', (event) => {
  img.src = event.target.result;
})
});