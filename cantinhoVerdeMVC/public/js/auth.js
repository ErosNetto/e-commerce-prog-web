document.addEventListener('DOMContentLoaded', function () {
  const loginForm = document.getElementById('loginForm');
  const registerForm = document.getElementById('registerForm');

  const togglePasswordButtons = document.querySelectorAll('.toggle-password');
  togglePasswordButtons.forEach((button) => {
    button.addEventListener('click', function () {
      const input = this.parentElement.querySelector('input');
      const icon = this.querySelector('i');

      if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
      } else {
        input.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
      }
    });
  });

  const phoneInput = document.getElementById('telefone');
  if (phoneInput) {
    phoneInput.addEventListener('input', function () {
      this.value = formatPhone(this.value);
    });

    phoneInput.addEventListener('blur', function () {
      validatePhone(this.value);
    });
  }

  const emailInput = document.getElementById('email');
  if (emailInput) {
    emailInput.addEventListener('blur', function () {
      validateEmailField(this.value);
    });
  }

  const confirmPasswordInput = document.getElementById('confirmar_senha');
  if (confirmPasswordInput) {
    confirmPasswordInput.addEventListener('blur', validatePasswordMatch);
  }

  if (loginForm) {
    loginForm.addEventListener('submit', function (e) {
      const formData = {
        email: document.getElementById('email').value.trim(),
        senha: document.getElementById('senha').value,
      };

      const errors = validateForm(formData);

      if (Object.keys(errors).length > 0) {
        e.preventDefault();
        showFormErrors(errors);
      }
    });
  }

  if (registerForm) {
    registerForm.addEventListener('submit', function (e) {
      const formData = {
        nome: document.getElementById('nome').value.trim(),
        sobrenome: document.getElementById('sobrenome').value.trim(),
        email: document.getElementById('email').value.trim(),
        telefone: document.getElementById('telefone').value,
        data_nascimento: document.getElementById('data_nascimento').value,
        senha: document.getElementById('senha').value,
        confirmar_senha: document.getElementById('confirmar_senha').value,
      };

      const errors = validateForm(formData, true);

      if (Object.keys(errors).length > 0) {
        e.preventDefault();
        showFormErrors(errors);
      }
    });
  }
});

function validatePasswordMatch() {
  const password = document.getElementById('senha').value;
  const confirmPassword = document.getElementById('confirmar_senha').value;
  const confirmGroup = document
    .getElementById('confirmar_senha')
    .closest('.form-group');

  clearFieldError(confirmGroup);

  if (confirmPassword && password !== confirmPassword) {
    showFieldError(confirmGroup, 'As senhas não coincidem');
    return false;
  } else if (confirmPassword && password === confirmPassword) {
    showFieldSuccess(confirmGroup);
    return true;
  }

  return true;
}

function formatPhone(value) {
  value = value.replace(/\D/g, '');

  value = value.substring(0, 11);

  if (value.length <= 10) {
    value = value.replace(/(\d{2})(\d{4})(\d{0,4})/, '($1) $2-$3');
  } else {
    value = value.replace(/(\d{2})(\d{5})(\d{0,4})/, '($1) $2-$3');
  }

  return value;
}

function validatePhone(phone) {
  const phoneGroup = document.getElementById('telefone').closest('.form-group');
  const cleanPhone = phone.replace(/\D/g, '');

  clearFieldError(phoneGroup);

  if (cleanPhone.length > 0 && cleanPhone.length < 10) {
    showFieldError(phoneGroup, 'Telefone deve ter pelo menos 10 dígitos');
    return false;
  } else if (cleanPhone.length === 10 || cleanPhone.length === 11) {
    showFieldSuccess(phoneGroup);
    return true;
  } else if (cleanPhone.length > 11) {
    showFieldError(phoneGroup, 'Formato de telefone inválido');
    return false;
  }
  return true;
}

function validateEmail(email) {
  const re = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  return re.test(email);
}

function validateEmailField(email) {
  const emailGroup = document.getElementById('email').closest('.form-group');

  clearFieldError(emailGroup);

  if (!email) {
    showFieldError(emailGroup, 'O e-mail é obrigatório');
    return false;
  }

  if (!validateEmail(email)) {
    showFieldError(emailGroup, 'Por favor, digite um email válido');
    return false;
  } else {
    showFieldSuccess(emailGroup);
    return true;
  }
}

function validateBirthDate(birthDate) {
  const birthGroup = document
    .getElementById('data_nascimento')
    .closest('.form-group');
  clearFieldError(birthGroup);

  if (!birthDate) {
    showFieldError(birthGroup, 'A data de nascimento é obrigatória');
    return false;
  }

  const dateObj = new Date(birthDate);
  if (isNaN(dateObj.getTime())) {
    showFieldError(birthGroup, 'Data inválida');
    return false;
  }

  showFieldSuccess(birthGroup);
  return true;
}

function showFieldError(formGroup, message) {
  formGroup.classList.remove('success');
  formGroup.classList.add('error');

  let errorMsg = formGroup.querySelector('.error-message');
  if (!errorMsg) {
    errorMsg = document.createElement('div');
    errorMsg.className = 'error-message';
    formGroup.appendChild(errorMsg);
  }

  errorMsg.textContent = message;
}

function showFieldSuccess(formGroup) {
  formGroup.classList.remove('error');
  formGroup.classList.add('success');

  const errorMsg = formGroup.querySelector('.error-message');
  if (errorMsg) {
    errorMsg.remove();
  }
}

function clearFieldError(formGroup) {
  formGroup.classList.remove('error', 'success');

  const errorMsg = formGroup.querySelector('.error-message');
  if (errorMsg) {
    errorMsg.remove();
  }
}

function validateForm(formData, isRegister = false) {
  const errors = {};

  if (!validateEmailField(formData.email)) {
    errors.email = 'Por favor, digite um email válido';
  }

  if (!formData.senha || formData.senha.length < 6) {
    errors.senha = 'A senha deve ter no mínimo 6 caracteres';
  }

  if (isRegister) {
    if (!formData.nome || formData.nome.trim().length < 2) {
      errors.nome = 'Nome deve ter pelo menos 2 caracteres';
    }

    if (!formData.sobrenome || formData.sobrenome.trim().length < 2) {
      errors.sobrenome = 'Sobrenome deve ter pelo menos 2 caracteres';
    }

    if (!validatePhone(formData.telefone)) {
      errors.telefone = 'Por favor, digite um telefone válido';
    }

    if (!validateBirthDate(formData.data_nascimento)) {
      errors.data_nascimento = 'Por favor, insira uma data válida';
    }

    if (formData.senha !== formData.confirmar_senha) {
      errors.confirmar_senha = 'As senhas não coincidem';
    }
  }

  return errors;
}

function showFormErrors(errors) {
  document.querySelectorAll('.form-group').forEach((group) => {
    clearFieldError(group);
  });

  Object.keys(errors).forEach((field) => {
    const input =
      document.getElementById(field) ||
      document.querySelector(`[name="${field}"]`);
    if (input) {
      const formGroup = input.closest('.form-group');
      showFieldError(formGroup, errors[field]);
    }
  });

  const firstError = document.querySelector(
    '.form-group.error input, .form-group.error select'
  );
  if (firstError) {
    firstError.focus();
  }
}
