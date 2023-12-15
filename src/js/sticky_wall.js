const overlay = document.querySelector('.overlay');
const createDialog = document.querySelector('#create-dialog');
const editDialog = document.querySelector('#edit-dialog');
const deleteDialog = document.querySelector('#delete-dialog');
const form = document.querySelector('form.dialog-bottom');
const createPostBtn = document.querySelector('#create-post-btn');
const cancelBtn = document.querySelector('#cancel-btn');
const postBtn = document.querySelector('#post-btn');
const deleteBtn = document.querySelector('#delete-btn');
const closeBtns = document.querySelectorAll('.close-btn');
const actionEditBtns = document.querySelectorAll('.edit-btn');
const actionDeleteBtns = document.querySelectorAll('.delete-btn');
const upvoteBtns = document.querySelectorAll('.upvote-btn');
const downvoteBtns = document.querySelectorAll('.downvote-btn');
const postTitleInput = document.querySelector('#post-title');
const postTextInput = document.querySelector('#post-content');

let oldPostTitle = null;
let oldPostText = null;
let currentData = null;

function toggleOverlay() {
  overlay.style.display = overlay.style.display === 'block' ? 'none' : 'block';
}

function createPost(title, postText) {
  const xhr = new XMLHttpRequest();
  xhr.open('POST', '../components/requestHandler.php', true);
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
    action: 'create_post',
    title: title,
    post_text: postText,
  });

  xhr.send(formData);
}

function editPost(oldTitle, oldText, title, postText) {
  const xhr = new XMLHttpRequest();
  xhr.open('POST', '../components/requestHandler.php', true);
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
    action: 'edit_post',
    old_title: oldTitle,
    old_post_text: oldText,
    new_title: title,
    new_post_text: postText,
  });

  xhr.send(formData);
}

function deletePost(title, postText) {
  const xhr = new XMLHttpRequest();
  xhr.open('POST', '../components/requestHandler.php', true);
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
    action: 'delete_post',
    title: title,
    post_text: postText,
  });

  xhr.send(formData);
}

function clearForm() {
  postTitleInput.value = '';
  postTextInput.value = '';
}

if (createPostBtn) {
  createPostBtn.addEventListener('click', () => {
    createDialog.showModal();
    toggleOverlay();
  });
}

actionEditBtns.forEach((btn) => {
  btn.addEventListener('click', () => {
    postTitleInput.value = btn.parentElement.parentElement.querySelector('.post-title').textContent;
    postTextInput.value = btn.parentElement.parentElement.querySelector('.post-content').textContent;

    oldPostTitle = postTitleInput.value;
    oldPostText = postTextInput.value;
    editDialog.showModal();
    toggleOverlay();
  });
});

actionDeleteBtns.forEach((btn) => {
  btn.addEventListener('click', () => {
    currentData = [
      btn.parentElement.parentElement.querySelector('.post-title').textContent,
      btn.parentElement.parentElement.querySelector('.post-content').textContent,
    ]
    deleteDialog.showModal();
    toggleOverlay();
  });
});

closeBtns.forEach((btn) => {
  btn.addEventListener('click', () => {
    btn.closest('dialog').close();
    toggleOverlay();
  });
});

if (cancelBtn) {
  cancelBtn.addEventListener('click', () => {
    deleteDialog.close();
    toggleOverlay();
  });
}

if (form) {
  form.addEventListener('submit', (e) => {
    e.preventDefault();
    if (createPostBtn) {
      createPost(postTitleInput.value, postTextInput.value);
      createDialog.close();
    } else {
      editPost(oldPostTitle, oldPostText, postTitleInput.value, postTextInput.value);
      editDialog.close();
    }
    toggleOverlay();
    clearForm();
  });
}

deleteBtn.addEventListener('click', () => {
  if (currentData) {
    deletePost(currentData[0], currentData[1]);
    deleteDialog.close();
    toggleOverlay();
    currentData = null;
  }
});
