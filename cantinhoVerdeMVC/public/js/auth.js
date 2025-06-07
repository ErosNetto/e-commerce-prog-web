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
  const phoneInput = document.getElementById('phone');
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

  // Validação de data de nascimento
  const birthDateInput = document.getElementById('birthDate');
  if (birthDateInput) {
    // Definir data máxima (18 anos atrás)
    const today = new Date();
    const maxDate = new Date(
      today.getFullYear() - 18,
      today.getMonth(),
      today.getDate()
    );
    birthDateInput.max = maxDate.toISOString().split('T')[0];

    birthDateInput.addEventListener('change', function () {
      validateAge(this.value);
    });
  }

  // Formulário de login - Alterado para AJAX
  if (loginForm) {
    loginForm.addEventListener('submit', async function (e) {
      e.preventDefault();

      const formData = {
        email: document.getElementById('email').value.trim(),
        password: document.getElementById('password').value,
      };

      const errors = validateForm(formData);

      if (Object.keys(errors).length > 0) {
        showFormErrors(errors);
        return;
      }

      const submitBtn = loginForm.querySelector('button[type="submit"]');
      const originalText = submitBtn.innerHTML;

      submitBtn.disabled = true;
      submitBtn.innerHTML =
        '<i class="fas fa-spinner fa-spin"></i> Entrando...';

      try {
        const response = await fetch(`${BASE_URL}/login/autenticar`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: new URLSearchParams({
            email: formData.email,
            password: formData.password,
          }),
        });

        if (response.redirected) {
          window.location.href = response.url;
        } else {
          const result = await response.json();
          if (result.erro) {
            showNotification(result.erro, 'error');
          }
        }
      } catch (error) {
        showNotification('Erro na comunicação com o servidor', 'error');
        console.error('Error:', error);
      } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
      }
    });
  }

  // Formulário de cadastro - Alterado para AJAX
  if (registerForm) {
    registerForm.addEventListener('submit', async function (e) {
      e.preventDefault();

      const formData = {
        firstName: document.getElementById('firstName').value.trim(),
        lastName: document.getElementById('lastName').value.trim(),
        email: document.getElementById('email').value.trim(),
        phone: document.getElementById('phone').value,
        birthDate: document.getElementById('birthDate').value,
        password: document.getElementById('password').value,
        confirmPassword: document.getElementById('confirmPassword').value,
      };

      const errors = validateForm(formData, true);

      if (Object.keys(errors).length > 0) {
        showFormErrors(errors);
        return;
      }

      const submitBtn = registerForm.querySelector('button[type="submit"]');
      const originalText = submitBtn.innerHTML;

      submitBtn.disabled = true;
      submitBtn.innerHTML =
        '<i class="fas fa-spinner fa-spin"></i> Criando conta...';

      try {
        const response = await fetch(`${BASE_URL}/cadastro/registrar`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: new URLSearchParams({
            firstName: formData.firstName,
            lastName: formData.lastName,
            email: formData.email,
            phone: formData.phone,
            birthDate: formData.birthDate,
            password: formData.password,
          }),
        });

        if (response.redirected) {
          window.location.href = response.url;
        } else {
          const result = await response.json();
          if (result.erro) {
            showNotification(result.erro, 'error');
            showFormErrors(result.erros || {});
          }
        }
      } catch (error) {
        showNotification('Erro na comunicação com o servidor', 'error');
        console.error('Error:', error);
      } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
      }
    });
  }
});

// Função para verificar sessão do usuário
function checkUserSession() {
  const user = JSON.parse(localStorage.getItem('user'));

  if (user && user.loggedIn) {
    // Se estiver na página de login ou cadastro, redirecionar
    const currentPage = window.location.pathname;
    if (
      currentPage.includes('login.html') ||
      currentPage.includes('cadastro.html')
    ) {
      window.location.href = 'index.html';
    }
  }
}

// Função para validar confirmação de senha
function validatePasswordMatch() {
  const password = document.getElementById('password').value;
  const confirmPassword = document.getElementById('confirmPassword').value;
  const confirmGroup = document
    .getElementById('confirmPassword')
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
  const phoneGroup = document.getElementById('phone').closest('.form-group');
  const cleanPhone = phone.replace(/\D/g, '');

  clearFieldError(phoneGroup);

  if (cleanPhone.length < 10) {
    showFieldError(phoneGroup, 'Telefone deve ter pelo menos 10 dígitos');
    return false;
  } else if (cleanPhone.length === 10 || cleanPhone.length === 11) {
    showFieldSuccess(phoneGroup);
    return true;
  } else {
    showFieldError(phoneGroup, 'Formato de telefone inválido');
    return false;
  }
}

// Função para validar email
function validateEmail(email) {
  const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return re.test(email);
}

// Função para validar campo de email
function validateEmailField(email) {
  const emailGroup = document.getElementById('email').closest('.form-group');

  clearFieldError(emailGroup);

  if (!email) {
    return true; // Campo vazio é válido para validação em tempo real
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
function validateAge(birthDate) {
  const birthGroup = document
    .getElementById('birthDate')
    .closest('.form-group');

  clearFieldError(birthGroup);

  if (!birthDate) {
    return true;
  }

  const today = new Date();
  const birth = new Date(birthDate);
  const age = today.getFullYear() - birth.getFullYear();
  const monthDiff = today.getMonth() - birth.getMonth();

  if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birth.getDate())) {
    age--;
  }

  if (age < 18) {
    showFieldError(birthGroup, 'Você deve ter pelo menos 18 anos');
    return false;
  } else {
    showFieldSuccess(birthGroup);
    return true;
  }
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

// Função para validar formulário
function validateForm(formData, isRegister = false) {
  const errors = {};

  // Validar email
  if (!formData.email || !validateEmail(formData.email)) {
    errors.email = 'Por favor, digite um email válido';
  }

  // Validar senha
  if (!formData.password || formData.password.length < 8) {
    errors.password = 'A senha deve ter pelo menos 8 caracteres';
  }

  if (isRegister) {
    // Validações específicas do cadastro
    if (!formData.firstName || formData.firstName.trim().length < 2) {
      errors.firstName = 'Nome deve ter pelo menos 2 caracteres';
    }

    if (!formData.lastName || formData.lastName.trim().length < 2) {
      errors.lastName = 'Sobrenome deve ter pelo menos 2 caracteres';
    }

    if (!formData.phone || formData.phone.replace(/\D/g, '').length < 10) {
      errors.phone = 'Por favor, digite um telefone válido';
    }

    if (!formData.birthDate) {
      errors.birthDate = 'Por favor, digite sua data de nascimento';
    } else {
      // Validar idade
      const today = new Date();
      const birth = new Date(formData.birthDate);
      let age = today.getFullYear() - birth.getFullYear();
      const monthDiff = today.getMonth() - birth.getMonth();

      if (
        monthDiff < 0 ||
        (monthDiff === 0 && today.getDate() < birth.getDate())
      ) {
        age--;
      }

      if (age < 18) {
        errors.birthDate = 'Você deve ter pelo menos 18 anos';
      }
    }

    if (!formData.gender) {
      errors.gender = 'Por favor, selecione seu gênero';
    }

    if (formData.password !== formData.confirmPassword) {
      errors.confirmPassword = 'As senhas não coincidem';
    }

    if (!formData.terms) {
      errors.terms = 'Você deve aceitar os termos de uso';
    }

    // Validar força da senha
    let passwordScore = 0;
    if (formData.password.length >= 8) passwordScore++;
    if (/[a-z]/.test(formData.password)) passwordScore++;
    if (/[A-Z]/.test(formData.password)) passwordScore++;
    if (/[0-9]/.test(formData.password)) passwordScore++;
    if (/[^A-Za-z0-9]/.test(formData.password)) passwordScore++;

    if (passwordScore < 3) {
      errors.password =
        'Senha muito fraca. Use letras maiúsculas, minúsculas, números e símbolos';
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

// Função para lidar com login
function handleLogin() {
  const formData = {
    email: document.getElementById('email').value.trim(),
    password: document.getElementById('password').value,
    rememberMe: document.getElementById('rememberMe').checked,
  };

  const errors = validateForm(formData);

  if (Object.keys(errors).length > 0) {
    showFormErrors(errors);
    return;
  }

  // Simular login
  const submitBtn = document.querySelector('button[type="submit"]');
  const originalText = submitBtn.innerHTML;

  submitBtn.classList.add('loading');
  submitBtn.disabled = true;
  submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Entrando...';

  setTimeout(() => {
    // Simular usuários cadastrados
    const users = JSON.parse(localStorage.getItem('users')) || [];
    const user = users.find(
      (u) => u.email === formData.email && u.password === formData.password
    );

    if (user) {
      // Login bem-sucedido
      const userData = {
        id: user.id,
        name: `${user.firstName} ${user.lastName}`,
        email: user.email,
        phone: user.phone,
        loggedIn: true,
        loginTime: new Date().toISOString(),
      };

      localStorage.setItem('user', JSON.stringify(userData));

      // Salvar email se "lembrar de mim" estiver marcado
      if (formData.rememberMe) {
        localStorage.setItem('savedEmail', formData.email);
        localStorage.setItem('rememberMe', 'true');
      } else {
        localStorage.removeItem('savedEmail');
        localStorage.removeItem('rememberMe');
      }

      showNotification('Login realizado com sucesso!', 'success');

      // Redirecionar após 1 segundo
      setTimeout(() => {
        const redirectUrl = getUrlParameter('redirect') || 'index.html';
        window.location.href = redirectUrl;
      }, 1000);
    } else {
      showNotification('Email ou senha incorretos', 'error');
      submitBtn.classList.remove('loading');
      submitBtn.disabled = false;
      submitBtn.innerHTML = originalText;

      // Focar no campo de senha
      document.getElementById('password').focus();
      document.getElementById('password').select();
    }
  }, 1500);
}

// Função para lidar com cadastro
function handleRegister() {
  const formData = {
    firstName: document.getElementById('firstName').value.trim(),
    lastName: document.getElementById('lastName').value.trim(),
    email: document.getElementById('email').value.trim(),
    phone: document.getElementById('phone').value,
    birthDate: document.getElementById('birthDate').value,
    password: document.getElementById('password').value,
    confirmPassword: document.getElementById('confirmPassword').value,
    gender: document.getElementById('gender').value,
    newsletter: document.getElementById('newsletter').checked,
    terms: document.getElementById('terms').checked,
  };

  const errors = validateForm(formData, true);

  if (Object.keys(errors).length > 0) {
    showFormErrors(errors);
    return;
  }

  // Simular cadastro
  const submitBtn = document.querySelector('button[type="submit"]');
  const originalText = submitBtn.innerHTML;

  submitBtn.classList.add('loading');
  submitBtn.disabled = true;
  submitBtn.innerHTML =
    '<i class="fas fa-spinner fa-spin"></i> Criando conta...';

  setTimeout(() => {
    // Verificar se o email já existe
    const users = JSON.parse(localStorage.getItem('users')) || [];
    const existingUser = users.find((u) => u.email === formData.email);

    if (existingUser) {
      showNotification('Este email já está cadastrado', 'error');
      showFormErrors({ email: 'Este email já está cadastrado' });
      submitBtn.classList.remove('loading');
      submitBtn.disabled = false;
      submitBtn.innerHTML = originalText;
      return;
    }

    // Criar novo usuário
    const newUser = {
      id: Date.now().toString(),
      firstName: formData.firstName,
      lastName: formData.lastName,
      email: formData.email,
      phone: formData.phone,
      birthDate: formData.birthDate,
      password: formData.password,
      gender: formData.gender,
      newsletter: formData.newsletter,
      createdAt: new Date().toISOString(),
      isActive: true,
    };

    users.push(newUser);
    localStorage.setItem('users', JSON.stringify(users));

    // Fazer login automático
    const userData = {
      id: newUser.id,
      name: `${newUser.firstName} ${newUser.lastName}`,
      email: newUser.email,
      phone: newUser.phone,
      loggedIn: true,
      loginTime: new Date().toISOString(),
    };

    localStorage.setItem('user', JSON.stringify(userData));

    showNotification('Cadastro realizado com sucesso! Bem-vindo!', 'success');

    // Enviar email de boas-vindas (simulado)
    if (formData.newsletter) {
      console.log('Email de boas-vindas enviado para:', formData.email);
    }

    // Redirecionar após 1.5 segundos
    setTimeout(() => {
      window.location.href = 'index.html';
    }, 1500);
  }, 2000);
}

// Função para obter parâmetros da URL
function getUrlParameter(name) {
  name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
  const regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
  const results = regex.exec(location.search);
  return results === null
    ? ''
    : decodeURIComponent(results[1].replace(/\+/g, ' '));
}

// Função para mostrar notificações
function showNotification(message, type = 'info') {
  // Remover notificação existente
  const existingNotification = document.querySelector('.notification');
  if (existingNotification) {
    existingNotification.remove();
  }

  const notification = document.createElement('div');
  notification.className = `notification notification-${type}`;

  // Adicionar ícone baseado no tipo
  let icon = '';
  switch (type) {
    case 'success':
      icon = '<i class="fas fa-check-circle"></i>';
      notification.style.backgroundColor = '#4caf50';
      break;
    case 'error':
      icon = '<i class="fas fa-exclamation-circle"></i>';
      notification.style.backgroundColor = '#d32f2f';
      break;
    case 'warning':
      icon = '<i class="fas fa-exclamation-triangle"></i>';
      notification.style.backgroundColor = '#ff9800';
      break;
    case 'info':
    default:
      icon = '<i class="fas fa-info-circle"></i>';
      notification.style.backgroundColor = '#2196f3';
      break;
  }

  notification.innerHTML = `${icon} <span>${message}</span>`;

  // Adicionar estilos
  notification.style.cssText = `
        position: fixed;
        bottom: 20px;
        right: 20px;
        color: white;
        padding: 15px 20px;
        border-radius: 4px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        z-index: 10000;
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.3s ease, transform 0.3s ease;
        display: flex;
        align-items: center;
        gap: 10px;
        max-width: 400px;
        font-size: 14px;
        font-weight: 500;
    `;

  document.body.appendChild(notification);

  // Mostrar notificação
  setTimeout(() => {
    notification.style.opacity = '1';
    notification.style.transform = 'translateY(0)';
  }, 100);

  // Remover notificação após 4 segundos
  setTimeout(() => {
    notification.style.opacity = '0';
    notification.style.transform = 'translateY(20px)';
    setTimeout(() => {
      if (notification.parentNode) {
        notification.remove();
      }
    }, 300);
  }, 4000);

  // Permitir fechar clicando na notificação
  notification.addEventListener('click', function () {
    this.style.opacity = '0';
    this.style.transform = 'translateY(20px)';
    setTimeout(() => {
      if (this.parentNode) {
        this.remove();
      }
    }, 300);
  });
}

// Função para logout (pode ser chamada de outras páginas)
function logout() {
  fetch(`${BASE_URL}/login/logout`, {
    method: 'POST',
  })
    .then((response) => {
      if (response.redirected) {
        window.location.href = response.url;
      }
    })
    .catch((error) => {
      console.error('Error:', error);
      showNotification('Erro ao fazer logout', 'error');
    });
}

// Exportar funções para uso global
window.logout = logout;
window.showNotification = showNotification;
