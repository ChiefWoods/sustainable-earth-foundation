const overlay = document.querySelector('.overlay');
const createPostBtn = document.querySelector('#create-post-btn');
const createDialog = document.querySelector('#create-dialog');
const closeBtn = document.querySelector('.close-btn');
const form = document.querySelector('form.dialog-bottom');
const postTitleInput = document.querySelector('#post-title');
const postTextInput = document.querySelector('#post-text');
const postBtn = document.querySelector('#post-btn');

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

function clearForm() {
  postTitleInput.value = '';
  postTextInput.value = '';
}

createPostBtn.addEventListener('click', () => {
  createDialog.showModal();
  toggleOverlay();
});

closeBtn.addEventListener('click', () => {
  createDialog.close();
  toggleOverlay();
  clearForm();
});

if (form) {
  form.addEventListener('submit', (e) => {
    e.preventDefault();
    createPost(postTitleInput.value, postTextInput.value);
    createDialog.close();
    toggleOverlay();
    clearForm();
  });
}
