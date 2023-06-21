const form = document.getElementById('form');
const nama = document.getElementById('nama');
const email = document.getElementById('email');
const password = document.getElementById('password');
const password2 = document.getElementById('password2');

form.addEventListener('submit', (e) => {
  e.preventDefault();

  checkInputs();
});

function checkInputs() {
  const namaValue = nama.value.trim();
  const emailValue = email.value.trim();
  const passwordValue = password.value.trim();
  const password2Value = password2.value.trim();

  if (namaValue === '') {
    setErrorFor(nama, 'Nama tidak boleh kosong !');
  } else {
    setSuccessFor(nama);
  }

  if (emailValue === '') {
    setErrorFor(email, 'Email tidak boleh kosong !');
  } else if (!isEmail(emailValue)) {
    setErrorFor(email, 'Email tidak valid !');
  } else {
    setSuccessFor(email);
  }

  if (passwordValue === '') {
    setErrorFor(password, 'Password tidak boleh kosong !');
  } else {
    setSuccessFor(password);
  }

  if (password2Value === '') {
    setErrorFor(password2, 'Password tidak boleh kosong !');
  } else if (passwordValue !== password2Value) {
    setErrorFor(password2, 'Password tidak sama !');
  } else {
    setSuccessFor(password2);
  }
}

function setErrorFor(input, message) {
  const formFloating = input.parentElement;
  const small = formFloating.querySelector('small');

  small.innerText = message;

  formFloating.className = 'form-floating error';
}

function setSuccessFor(input) {
  const formFloating = input.parentElement;
  formFloating.className = 'form-floating success';
}

function isEmail(email) {
  return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}
