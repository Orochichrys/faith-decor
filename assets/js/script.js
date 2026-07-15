document.addEventListener('DOMContentLoaded', () => {
  let count = 0;
  const button = document.querySelector('#counter');
  const countVal = document.querySelector('#count-val');

  const updateCounter = () => {
    count++;
    if (countVal) {
        countVal.textContent = count;
    } else {
        button.innerHTML = `Le compteur est à ${count}`;
    }
  };

  button.addEventListener('click', updateCounter);

  console.log("🚀 Create My Site v1.4.0 chargé avec succès !");
});