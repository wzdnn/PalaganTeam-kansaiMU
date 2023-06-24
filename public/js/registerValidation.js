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
    setErrorFor(nama, 'Name Cannot Be Blank !');
  } else {
    setSuccessFor(nama);
  }

  if (emailValue === '') {
    setErrorFor(email, 'Email Cannot Be Blank !');
  } else if (!isEmail(emailValue)) {
    setErrorFor(email, 'Email Is Not Valid !');
  } else {
    setSuccessFor(email);
  }

  if (passwordValue === '') {
    setErrorFor(password, 'Password Cannot Be Blank !');
  } else {
    setSuccessFor(password);
  }

  if (password2Value === '') {
    setErrorFor(password2, 'Password Cannot Be Blank !');
  } else if (passwordValue !== password2Value) {
    setErrorFor(password2, 'Password Do Not Match !');
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
