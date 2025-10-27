fetch('/api/users')
  .then(response => response.json())
  .then(users => {
    const list = document.getElementById('user-list');
    users.forEach(user => {
      const li = document.createElement('li');
      li.textContent = `${user.name} (${user.email})`;
      list.appendChild(li);
    });
  })
  .catch(err => console.error('Error fetching users:', err));
