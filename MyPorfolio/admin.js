// Function to refresh main page if it's open
function refreshMainPage() {
    try {
        if (window.opener && !window.opener.closed) {
            window.opener.location.reload();
        }
    } catch (e) {
        console.log('Main page not available to refresh');
    }
}

// Load Skills
async function loadSkills() {
    try {
        const response = await fetch('skills-crud.php');
        const skills = await response.json();
        const skillsList = document.getElementById('skills-list');
        skillsList.innerHTML = '';
        skills.forEach(skill => {
            skillsList.innerHTML += `
                <tr>
                    <td>${skill.name}</td>
                    <td>${skill.category}</td>
                    <td>${skill.progress}%</td>
                    <td>
                        <button class="pixel-button action-btn edit-skill" data-id="${skill.id}">EDIT</button>
                        <button class="pixel-button action-btn delete-skill" data-id="${skill.id}">DELETE</button>
                    </td>
                </tr>
            `;
        });
        // Refresh main page after skills are updated
        refreshMainPage();
    } catch (error) {
        alert('Error loading skills: ' + error.message);
    }
}

// Load Projects
async function loadProjects() {
    try {
        const response = await fetch('projects-crud.php');
        const projects = await response.json();
        const projectsList = document.getElementById('projects-list');
        projectsList.innerHTML = '';
        projects.forEach(project => {
            projectsList.innerHTML += `
                <tr>
                    <td>${project.title}</td>
                    <td>${project.description}</td>
                    <td><img src="${project.image}" alt="${project.title}"></td>
                    <td>${project.tags}</td>
                    <td><a href="${project.link}" target="_blank">${project.link}</a></td>
                    <td>
                        <button class="pixel-button action-btn edit-project" data-id="${project.id}">EDIT</button>
                        <button class="pixel-button action-btn delete-project" data-id="${project.id}">DELETE</button>
                    </td>
                </tr>
            `;
        });
    } catch (error) {
        alert('Error loading projects: ' + error.message);
    }
}

// Load Messages
async function loadMessages() {
    try {
        const response = await fetch('messages-crud.php');
        const messages = await response.json();
        const messagesList = document.getElementById('messages-list');
        messagesList.innerHTML = '';
        
        messages.forEach(message => {
            // Format the date nicely
            const date = new Date(message.created_at).toLocaleString();
            
            // Truncate long message text
            const truncatedMessage = message.message.length > 50 
                ? message.message.substring(0, 50) + '...' 
                : message.message;
            
            messagesList.innerHTML += `
                <tr>
                    <td>${date}</td>
                    <td>${message.name}</td>
                    <td><a href="mailto:${message.email}">${message.email}</a></td>
                    <td>${message.subject}</td>
                    <td title="${message.message}">${truncatedMessage}</td>
                    <td>
                        <button class="pixel-button action-btn view-message" data-id="${message.id}" 
                            data-message="${encodeURIComponent(message.message)}">VIEW</button>
                        <button class="pixel-button action-btn delete-message" data-id="${message.id}">DELETE</button>
                    </td>
                </tr>
            `;
        });
    } catch (error) {
        console.error('Error loading messages:', error);
        alert('Error loading messages: ' + error.message);
    }
}

document.addEventListener('DOMContentLoaded', () => {
    // Load skills and projects on page load
    loadSkills();
    loadProjects();
    loadMessages();

    // Smooth scrolling for navigation
    document.querySelectorAll('.nav-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            if (btn.hash) {
                e.preventDefault();
                const target = document.querySelector(btn.hash);
                window.scrollTo({
                    top: target.offsetTop - 50,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Skill Modal Handling
    const skillModal = document.getElementById('skillModal');
    const skillForm = document.getElementById('skill-form');
    const addSkillBtn = document.getElementById('add-skill-btn');

    addSkillBtn.addEventListener('click', () => {
        document.getElementById('skill-modal-title').textContent = 'Add Skill';
        skillForm.reset();
        document.getElementById('skill-id').value = '';
        skillModal.style.display = 'flex';
    });

    document.querySelectorAll('.close, .cancel-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            skillModal.style.display = 'none';
            document.getElementById('projectModal').style.display = 'none';
        });
    });

    window.addEventListener('click', (e) => {
        if (e.target === skillModal) skillModal.style.display = 'none';
        if (e.target === document.getElementById('projectModal')) {
            document.getElementById('projectModal').style.display = 'none';
        }
    });    skillForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const skillId = document.getElementById('skill-id').value;
        const data = {
            id: skillId,
            name: document.getElementById('skill-name').value,
            category: document.getElementById('skill-category').value,
            progress: document.getElementById('skill-progress').value
        };

        try {
            const response = await fetch('skills-crud.php', {
                method: skillId ? 'PUT' : 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });
            const result = await response.json();            if (response.ok) {
                alert(result.message);
                skillModal.style.display = 'none';
                loadSkills(); // loadSkills() already includes refreshMainPage()
            } else {
                throw new Error(result.message);
            }
        } catch (error) {
            alert('Error: ' + error.message);
        }
    });

    // Edit Skill
    document.addEventListener('click', async (e) => {
        if (e.target.classList.contains('edit-skill')) {
            const id = e.target.dataset.id;
            try {
                const response = await fetch(`skills-crud.php?id=${id}`);
                const skill = await response.json();
                document.getElementById('skill-id').value = skill.id;
                document.getElementById('skill-name').value = skill.name;
                document.getElementById('skill-category').value = skill.category;
                document.getElementById('skill-progress').value = skill.progress;
                document.getElementById('skill-modal-title').textContent = 'Edit Skill';
                skillModal.style.display = 'flex';
            } catch (error) {
                alert('Error: ' + error.message);
            }
        }
    });

    // Delete Skill
    document.addEventListener('click', async (e) => {
        if (e.target.classList.contains('delete-skill')) {
            if (confirm('Are you sure you want to delete this skill?')) {
                const id = e.target.dataset.id;
                try {
                    const response = await fetch(`skills-crud.php?id=${id}`, {
                        method: 'DELETE'
                    });
                    const result = await response.json();
                    if (response.ok) {
                        alert(result.message);
                        loadSkills();
                    } else {
                        throw new Error(result.message);
                    }
                } catch (error) {
                    alert('Error: ' + error.message);
                }
            }
        }
    });

    // Project Modal Handling
    const projectModal = document.getElementById('projectModal');
    const projectForm = document.getElementById('project-form');
    const addProjectBtn = document.getElementById('add-project-btn');

    addProjectBtn.addEventListener('click', () => {
        document.getElementById('project-modal-title').textContent = 'Add Project';
        projectForm.reset();
        document.getElementById('project-id').value = '';
        projectModal.style.display = 'flex';
    });

    projectForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(projectForm);
        try {
            const response = await fetch('projects-crud.php', {
                method: 'POST',
                body: formData
            });
            const result = await response.json();
            if (response.ok) {
                alert(result.message);
                projectModal.style.display = 'none';
                loadProjects();
            } else {
                throw new Error(result.message);
            }
        } catch (error) {
            alert('Error: ' + error.message);
        }
    });

    // Edit Project
    document.addEventListener('click', async (e) => {
        if (e.target.classList.contains('edit-project')) {
            const id = e.target.dataset.id;
            try {
                const response = await fetch(`projects-crud.php?id=${id}`);
                const project = await response.json();
                document.getElementById('project-id').value = project.id;
                document.getElementById('project-title').value = project.title;
                document.getElementById('project-description').value = project.description;
                document.getElementById('project-tags').value = project.tags;
                document.getElementById('project-link').value = project.link;
                document.getElementById('project-modal-title').textContent = 'Edit Project';
                projectModal.style.display = 'flex';
            } catch (error) {
                alert('Error: ' + error.message);
            }
        }
    });

    // Delete Project
    document.addEventListener('click', async (e) => {
        if (e.target.classList.contains('delete-project')) {
            if (confirm('Are you sure you want to delete this project?')) {
                const id = e.target.dataset.id;
                try {
                    const response = await fetch(`projects-crud.php?id=${id}`, {
                        method: 'DELETE'
                    });
                    const result = await response.json();
                    if (response.ok) {
                        alert(result.message);
                        loadProjects();
                    } else {
                        throw new Error(result.message);
                    }
                } catch (error) {
                    alert('Error: ' + error.message);
                }
            }
        }
    });

    // Delete Message
    document.addEventListener('click', async (e) => {
        if (e.target.classList.contains('delete-message')) {
            if (confirm('Are you sure you want to delete this message?')) {
                const id = e.target.dataset.id;
                try {
                    const response = await fetch(`messages-crud.php?id=${id}`, {
                        method: 'DELETE'
                    });
                    const result = await response.json();
                    if (response.ok) {
                        alert(result.message);
                        loadMessages();
                    } else {
                        throw new Error(result.message);
                    }
                } catch (error) {
                    alert('Error: ' + error.message);
                }
            }
        }
    });

    // Handle message actions
    document.addEventListener('click', async (e) => {
        // View message
        if (e.target.classList.contains('view-message')) {
            const message = decodeURIComponent(e.target.dataset.message);
            alert(message); // Simple way to show full message
        }
    });
});