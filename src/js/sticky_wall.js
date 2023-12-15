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

function upvotePost(title, postText) {
  const xhr = new XMLHttpRequest();
  xhr.open('POST', '../components/requestHandler.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function () {
    if (xhr.status >= 200 && xhr.status < 300) {
      const data = JSON.parse(xhr.responseText);
      console.log(data);
    } else {
      console.error('Error:', xhr.status, xhr.statusText);
    }
  };

  xhr.onerror = function () {
    console.error('Network error');
  };

  const formData = new URLSearchParams({
    action: 'upvote_post',
    title: title,
    post_text: postText
  });

  xhr.send(formData);
}

function downvotePost(title, postText) {
  const xhr = new XMLHttpRequest();
  xhr.open('POST', '../components/requestHandler.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function () {
    if (xhr.status >= 200 && xhr.status < 300) {
      const data = JSON.parse(xhr.responseText);
      console.log(data);
    } else {
      console.error('Error:', xhr.status, xhr.statusText);
    }
  };

  xhr.onerror = function () {
    console.error('Network error');
  };

  const formData = new URLSearchParams({
    action: 'downvote_post',
    title: title,
    post_text: postText
  });

  xhr.send(formData);
}

function removeUpvote(title, postText) {
  const xhr = new XMLHttpRequest();
  xhr.open('POST', '../components/requestHandler.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function () {
    if (xhr.status >= 200 && xhr.status < 300) {
      const data = JSON.parse(xhr.responseText);
      console.log(data);
    }
    else {
      console.error('Error:', xhr.status, xhr.statusText);
    }
  };

  xhr.onerror = function () {
    console.error('Network error');
  };

  const formData = new URLSearchParams({
    action: 'remove_upvote',
    title: title,
    post_text: postText
  });

  xhr.send(formData);
}

function removeDownvote(title, postText) {
  const xhr = new XMLHttpRequest();
  xhr.open('POST', '../components/requestHandler.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function () {
    if (xhr.status >= 200 && xhr.status < 300) {
      const data = JSON.parse(xhr.responseText);
      console.log(data);
    }
    else {
      console.error('Error:', xhr.status, xhr.statusText);
    }
  };

  xhr.onerror = function () {
    console.error('Network error');
  };

  const formData = new URLSearchParams({
    action: 'remove_downvote',
    title: title,
    post_text: postText
  });

  xhr.send(formData);
}

function handleVoteClick(btn, img) {
  const postTitle = btn.parentElement.parentElement.querySelector('.post-title').textContent;
  const postText = btn.parentElement.parentElement.querySelector('.post-content').textContent;

  if (img.alt === 'Upvote') {
    upvotePost(postTitle, postText);
  } else if (img.alt === 'Downvote') {
    downvotePost(postTitle, postText);
  } else if (img.alt === 'Upvote-selected') {
    removeUpvote(postTitle, postText);
  } else if (img.alt === 'Downvote-selected') {
    removeDownvote(postTitle, postText);
  }
  replaceVoteIcon(btn, img);
}

function replaceVoteIcon(btn, img) {
  btn.removeChild(img);

  let iconType = null;

  if (img.alt === 'Upvote') {
    iconType = 'Upvote-selected';
  } else if (img.alt === 'Upvote-selected') {
    iconType = 'Upvote';
  } else if (img.alt === 'Downvote') {
    iconType = 'Downvote-selected';
  } else if (img.alt === 'Downvote-selected') {
    iconType = 'Downvote';
  }

  const parentFolder = iconType === 'Upvote' || iconType === 'Upvote-selected'
    ? 'upvote'
    : 'downvote';

  const newImg = document.createElement('img');
  newImg.src = `../../assets/icons/${parentFolder}/${getFilePath(iconType)}.svg`;
  newImg.alt = capitalize(iconType);
  newImg.className = 'action-icon';

  btn.append(newImg);
}

function clearForm() {
  postTitleInput.value = '';
  postTextInput.value = '';
}

function capitalize(str) {
  return str.charAt(0).toUpperCase() + str.slice(1);
}

function getFilePath(str) {
  return str.toLowerCase().replace(/-/g, '_');
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

if (deleteBtn) {
  deleteBtn.addEventListener('click', () => {
    if (currentData) {
      deletePost(currentData[0], currentData[1]);
      deleteDialog.close();
      toggleOverlay();
      currentData = null;
    }
  });
}

upvoteBtns.forEach((btn) => {
  btn.addEventListener('click', () => {
    const img = btn.querySelector('img');
    handleVoteClick(btn, img);
  });
});

downvoteBtns.forEach((btn) => {
  btn.addEventListener('click', () => {
    const img = btn.querySelector('img');
    handleVoteClick(btn, img);
  });
});
