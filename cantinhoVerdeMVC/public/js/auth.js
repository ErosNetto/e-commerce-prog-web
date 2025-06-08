document.addEventListener('DOMContentLoaded', function () {
  // Elementos do formulário
  const loginForm = document.getElementById('loginForm');
  const registerForm = document.getElementById('registerForm');

  // Toggle de senha (mantido igual)
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

  // Máscara para telefone
  const phoneInput = document.getElementById('telefone');
  if (phoneInput) {
    phoneInput.addEventListener('input', function () {
      this.value = formatPhone(this.value);
    });

    phoneInput.addEventListener('blur', function () {
      validatePhone(this.value);
    });
  }

  // Validação de email em tempo real
  const emailInput = document.getElementById('email');
  if (emailInput) {
    emailInput.addEventListener('blur', function () {
      validateEmailField(this.value);
    });
  }

  // Validação de confirmação de senha em tempo real para cadastro
  const confirmPasswordInput = document.getElementById('confirmar_senha');
  if (confirmPasswordInput) {
    confirmPasswordInput.addEventListener('blur', validatePasswordMatch);
  }

  // Formulário de login - Adiciona validação no submit
  if (loginForm) {
    loginForm.addEventListener('submit', function (e) {
      const formData = {
        email: document.getElementById('email').value.trim(),
        senha: document.getElementById('senha').value,
      };

      const errors = validateForm(formData);

      if (Object.keys(errors).length > 0) {
        e.preventDefault(); // Impede a submissão do formulário
        showFormErrors(errors);
      } else {
        // Se não houver erros, o formulário será submetido normalmente
        // O PHP no backend fará a validação final
      }
    });
  }

  // Formulário de cadastro - Adiciona validação no submit
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
        e.preventDefault(); // Impede a submissão do formulário
        showFormErrors(errors);
      } else {
        // Se não houver erros, o formulário será submetido normalmente
        // O PHP no backend fará a validação final
      }
    });
  }
});

// Função para validar confirmação de senha
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

// Função para formatar telefone
function formatPhone(value) {
  // Remove tudo que não é dígito
  value = value.replace(/\D/g, '');

  // Limita a 11 dígitos
  value = value.substring(0, 11);

  // Aplica a máscara
  if (value.length <= 10) {
    value = value.replace(/(\d{2})(\d{4})(\d{0,4})/, '($1) $2-$3');
  } else {
    value = value.replace(/(\d{2})(\d{5})(\d{0,4})/, '($1) $2-$3');
  }

  return value;
}

// Função para validar telefone
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

// Função para validar email
function validateEmail(email) {
  const re = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  return re.test(email);
}

// Função para validar campo de email
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

// Função para validar idade
function validateBirthDate(birthDate) {
  const birthGroup = document
    .getElementById('data_nascimento')
    .closest('.form-group');
  clearFieldError(birthGroup);

  if (!birthDate) {
    showFieldError(birthGroup, 'A data de nascimento é obrigatória');
    return false;
  }

  // Verifica se a data é válida (evita 31/02/2000, etc.)
  const dateObj = new Date(birthDate);
  if (isNaN(dateObj.getTime())) {
    showFieldError(birthGroup, 'Data inválida');
    return false;
  }

  showFieldSuccess(birthGroup);
  return true;
}

// Função para mostrar erro em campo específico
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

// Função para mostrar sucesso em campo específico
function showFieldSuccess(formGroup) {
  formGroup.classList.remove('error');
  formGroup.classList.add('success');

  const errorMsg = formGroup.querySelector('.error-message');
  if (errorMsg) {
    errorMsg.remove();
  }
}

// Função para limpar erro de campo
function clearFieldError(formGroup) {
  formGroup.classList.remove('error', 'success');

  const errorMsg = formGroup.querySelector('.error-message');
  if (errorMsg) {
    errorMsg.remove();
  }
}

// Função para validar formulário completo
function validateForm(formData, isRegister = false) {
  const errors = {};

  // Validar email
  if (!validateEmailField(formData.email)) {
    errors.email = 'Por favor, digite um email válido';
  }

  // Validar senha
  if (!formData.senha || formData.senha.length < 6) {
    errors.senha = 'A senha deve ter no mínimo 6 caracteres';
  }

  if (isRegister) {
    // Validações específicas do cadastro
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

// Função para mostrar erros no formulário
function showFormErrors(errors) {
  // Limpar erros anteriores
  document.querySelectorAll('.form-group').forEach((group) => {
    clearFieldError(group);
  });

  // Mostrar novos erros
  Object.keys(errors).forEach((field) => {
    const input =
      document.getElementById(field) ||
      document.querySelector(`[name="${field}"]`);
    if (input) {
      const formGroup = input.closest('.form-group');
      showFieldError(formGroup, errors[field]);
    }
  });

  // Focar no primeiro campo com erro
  const firstError = document.querySelector(
    '.form-group.error input, .form-group.error select'
  );
  if (firstError) {
    firstError.focus();
  }
}
