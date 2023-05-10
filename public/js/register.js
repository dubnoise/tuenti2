const inputs = document.querySelectorAll('.input-registro');

inputs.forEach(input => {
  if (!input.value) { // si el input está vacío, no le agrega la clase
    input.classList.remove('placeholder-effect');
  }

  input.addEventListener('focus', () => {
    input.classList.add('placeholder-effect');
  });

  input.addEventListener('blur', () => {
    if (!input.value) { // solo remueve la clase si el input está vacío
      input.classList.remove('placeholder-effect');
    }
  });
});


