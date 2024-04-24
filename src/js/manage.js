const overlay = document.querySelector('.overlay');
const editDialog = document.querySelector('#edit-dialog');
const deleteDialog = document.querySelector('#delete-dialog');
const form = document.querySelector('form.dialog-bottom');
const searchBar = document.querySelector('#search-bar');
const cancelBtn = document.querySelector('#cancel-btn');
const deleteBtn = document.querySelector('#delete-btn');
const closeBtns = document.querySelectorAll('.close-btn');
const searchInput = document.querySelector('#search-input');
const resultCountSpan = document.querySelector('#result-count');
const table = document.querySelector('table');

let oldCodeValue = null;
let currentData = null;

if (form.id === 'edit-users') {
  var usernameInput = form.querySelector('#username');
  var emailInput = form.querySelector('#email');
  var phoneInput = form.querySelector('#phone');
  var userPointsInput = form.querySelector('#user-points');
} else {
  var usernameInput = form.querySelector('#username');
  var rewardPointsInput = form.querySelector('#reward-points');
  var codeInput = form.querySelector('#reward-code');
  var dateInput = form.querySelector('#date-redeemed');
}

function toggleOverlay() {
  overlay.style.display = overlay.style.display === 'block' ? 'none' : 'block';
}

function editUser(username, phone, userPoints) {
  const xhr = new XMLHttpRequest();
  xhr.open('POST', 'php/util/requestHandler.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function () {
    if (xhr.status >= 200 && xhr.status < 300) {
      const data = JSON.parse(xhr.responseText);

      if (data.status === 'success') {
        window.location.reload();
      }
    } else {
      console.error('Error:', xhr.status, xhr.statusText);
    }
  };

  xhr.onerror = function () {
    console.error('Network error');
  };

  const formData = new URLSearchParams({
    action: 'edit_user',
    username: username,
    phone_number: phone,
    user_points: userPoints,
  });

  xhr.send(formData);
}

function editRedemption(oldCode, newCode, date) {
  const xhr = new XMLHttpRequest();
  xhr.open('POST', 'php/util/requestHandler.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function () {
    if (xhr.status >= 200 && xhr.status < 300) {
      const data = JSON.parse(xhr.responseText);

      if (data.status === 'success') {
        window.location.reload();
      }
    } else {
      console.error('Error:', xhr.status, xhr.statusText);
    }
  };

  xhr.onerror = function () {
    console.error('Network error');
  };

  const formData = new URLSearchParams({
    action: 'edit_redemption',
    old_redemption_code: oldCode,
    new_redemption_code: newCode,
    date_redeemed: date,
  });

  xhr.send(formData);
}

function deleteUser(username) {
  const xhr = new XMLHttpRequest();
  xhr.open('POST', 'php/util/requestHandler.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function () {
    if (xhr.status >= 200 && xhr.status < 300) {
      const data = JSON.parse(xhr.responseText);

      if (data.status === 'success') {
        window.location.reload();
      }
    } else {
      console.error('Error:', xhr.status, xhr.statusText);
    }
  };

  xhr.onerror = function () {
    console.error('Network error');
  };

  const formData = new URLSearchParams({
    action: 'delete_user',
    username: username,
  });

  xhr.send(formData);
}

function deleteRedemption(code) {
  const xhr = new XMLHttpRequest();
  xhr.open('POST', 'php/util/requestHandler.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function () {
    if (xhr.status >= 200 && xhr.status < 300) {
      const data = JSON.parse(xhr.responseText);

      if (data.status === 'success') {
        window.location.reload();
      }
    } else {
      console.error('Error:', xhr.status, xhr.statusText);
    }
  };

  xhr.onerror = function () {
    console.error('Network error');
  };

  const formData = new URLSearchParams({
    action: 'delete_redemption',
    redemption_code: code,
  });

  xhr.send(formData);
}

function findUsers(searchValue) {
  const xhr = new XMLHttpRequest();
  xhr.open('POST', 'php/util/requestHandler.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function () {
    if (xhr.status >= 200 && xhr.status < 300) {
      const data = JSON.parse(xhr.responseText);

      if (data.status === 'success') {
        updateTable(data.users);
      }
    } else {
      console.error('Error:', xhr.status, xhr.statusText);
    }
  };

  xhr.onerror = function () {
    console.error('Network error');
  }

  const formData = new URLSearchParams({
    action: 'find_users',
    search_value: searchValue,
  });

  xhr.send(formData);
}

function findRedemptions(searchValue) {
  const xhr = new XMLHttpRequest();
  xhr.open('POST', 'php/util/requestHandler.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function () {
    if (xhr.status >= 200 && xhr.status < 300) {
      const data = JSON.parse(xhr.responseText);

      if (data.status === 'success') {
        updateTable(data.redemptions);
      }
    } else {
      console.error('Error:', xhr.status, xhr.statusText);
    }
  };

  xhr.onerror = function () {
    console.error('Network error');
  }

  const formData = new URLSearchParams({
    action: 'find_redemptions',
    search_value: searchValue,
  });

  xhr.send(formData);
}

function updateTable(data) {
  table.removeChild(table.querySelector('tbody'));

  const tbody = document.createElement('tbody');
  const allTr = [];

  if (data.length > 0) {
    data.forEach((row) => {
      allTr.push(createTr(row));
    });
  } else {
    allTr.push(createEmptyTr());
  }

  tbody.append(...allTr);

  table.append(tbody);

  addActionEditBtnListener();
  addActionDeleteBtnListener();

  resultCountSpan.textContent = data.length;
}

function createTr(row) {
  if (form.id === 'edit-users') {
    const tr = document.createElement('tr');
    tr.className = 'user-row';

    const usernameTd = document.createElement('td');
    usernameTd.className = 'user-username';
    usernameTd.textContent = row.username;

    const emailTd = document.createElement('td');
    emailTd.className = 'user-email';
    emailTd.textContent = row.email;

    const phoneTd = document.createElement('td');
    phoneTd.className = 'user-phone';
    if (row.phone_number === '') {
      phoneTd.textContent = '-';
    } else {
      phoneTd.textContent = row.phone_number;
    }

    const pointsTd = document.createElement('td');
    pointsTd.className = 'user-points';
    pointsTd.textContent = row.user_points;

    const editDeleteTd = document.createElement('td');
    editDeleteTd.className = 'edit-delete';

    const editBtn = createActionBtn('edit');
    const deleteBtn = createActionBtn('delete');

    editDeleteTd.append(editBtn, deleteBtn);

    tr.append(usernameTd, emailTd, phoneTd, pointsTd, editDeleteTd);

    return tr;
  } else {
    const tr = document.createElement('tr');
    tr.className = 'redemption-row';

    const usernameTd = document.createElement('td');
    usernameTd.className = 'redemption-username';
    usernameTd.textContent = row.username;

    const pointsTd = document.createElement('td');
    pointsTd.className = 'redemption-points';
    pointsTd.textContent = row.reward_points;

    const codeTd = document.createElement('td');
    codeTd.className = 'redemption-code';
    codeTd.textContent = row.redemption_code;

    const dateTd = document.createElement('td');
    dateTd.className = 'redemption-date';
    dateTd.textContent = row.date_redeemed;

    const editDeleteTd = document.createElement('td');
    editDeleteTd.className = 'edit-delete';

    const editBtn = createActionBtn('edit');
    const deleteBtn = createActionBtn('delete');

    editDeleteTd.append(editBtn, deleteBtn);

    tr.append(usernameTd, pointsTd, codeTd, dateTd, editDeleteTd);

    return tr;
  }
}

function createEmptyTr() {
  const tr = document.createElement('tr');
  const td = document.createElement('td');
  td.colSpan = 5;
  td.textContent = 'No results found';
  tr.append(td);

  return tr;
}

function createActionBtn(action) {
  const button = document.createElement('button');
  button.className = `action-btn ${action}-btn`;

  const img = document.createElement('img');
  img.src = `assets/icons/${action}/${action}.svg`;
  img.alt = action.charAt(0).toUpperCase() + action.slice(1);
  img.className = 'icon';

  button.append(img);

  return button;
}

function addActionEditBtnListener() {
  const actionEditBtns = document.querySelectorAll('.edit-btn');
  actionEditBtns.forEach((btn) => {
    btn.addEventListener('click', () => {
      if (form.id === 'edit-users') {
        usernameInput.value = btn.parentElement.parentElement.querySelector('.user-username').textContent;
        emailInput.value = btn.parentElement.parentElement.querySelector('.user-email').textContent;
        phoneInput.value = btn.parentElement.parentElement.querySelector('.user-phone').textContent;
        userPointsInput.value = btn.parentElement.parentElement.querySelector('.user-points').textContent;
      } else {
        usernameInput.value = btn.parentElement.parentElement.querySelector('.redemption-username').textContent;
        rewardPointsInput.value = btn.parentElement.parentElement.querySelector('.redemption-points').textContent;
        codeInput.value = btn.parentElement.parentElement.querySelector('.redemption-code').textContent;
        dateInput.value = btn.parentElement.parentElement.querySelector('.redemption-date').textContent;

        oldCodeValue = codeInput.value;
      }
      editDialog.showModal();
      toggleOverlay();
    });
  });
}

function addActionDeleteBtnListener() {
  const actionDeleteBtns = document.querySelectorAll('.delete-btn');
  actionDeleteBtns.forEach((btn) => {
    btn.addEventListener('click', () => {
      currentData = form.id === 'edit-users'
        ? btn.parentElement.parentElement.querySelector('.user-username').textContent
        : btn.parentElement.parentElement.querySelector('.redemption-code').textContent;
      deleteDialog.showModal();
      toggleOverlay();
    });
  });
}

closeBtns.forEach((btn) => {
  btn.addEventListener('click', () => {
    btn.closest('dialog').close();
    toggleOverlay();
  });
});

cancelBtn.addEventListener('click', () => {
  deleteDialog.close();
  toggleOverlay();
});

form.addEventListener('submit', (e) => {
  e.preventDefault();

  if (form.id === 'edit-users') {
    if (phoneInput.value === '-') {
      phoneInput.value = '';
    }

    editUser(usernameInput.value, phoneInput.value, userPointsInput.value);
  } else {
    editRedemption(oldCodeValue, codeInput.value, dateInput.value);
  }
  editDialog.close();
  toggleOverlay();
})

deleteBtn.addEventListener('click', () => {
  if (currentData) {
    form.id === 'edit-users'
      ? deleteUser(currentData)
      : deleteRedemption(currentData);
    deleteDialog.close();
    toggleOverlay();
    currentData = null;
  }
});

searchInput.addEventListener('input', e => {
  e.preventDefault();

  const searchValue = searchInput.value;

  form.id === 'edit-users'
    ? findUsers(searchValue)
    : findRedemptions(searchValue);
});

addActionEditBtnListener();
addActionDeleteBtnListener();
