$(document).ready(function() {
    // Typed text effect
    const texts = ["2nd Year IT Student", "Game Enthusiast", "UI/UX Designer", "Future Developer"];
    let count = 0;
    let index = 0;
    let currentText = "";
    let letter = "";
    
    function type() {
        if (count === texts.length) {
            count = 0;
        }
        currentText = texts[count];
        letter = currentText.slice(0, ++index);
        
        $(".typed-text").text(letter);
        
        if (letter.length === currentText.length) {
            setTimeout(function() {
                erase();
            }, 1500);
            return;
        }
        
        setTimeout(type, 100);
    }
    
    function erase() {
        letter = currentText.slice(0, --index);
        $(".typed-text").text(letter);
        
        if (letter.length === 0) {
            count++;
            index = 0;
            setTimeout(type, 500);
            return;
        }
        
        setTimeout(erase, 50);
    }
    
    // Start the typing effect
    setTimeout(type, 1000);
    
    // Smooth scrolling for navigation
    $(".nav-btn").on("click", function(e) {
        if (this.hash !== "") {
            e.preventDefault();
            const hash = this.hash;
            
            $("html, body").animate({
                scrollTop: $(hash).offset().top - 50
            }, 800);
        }
    });
    
    // Modal functionality for login form
    const $loginBtn = $('a.nav-btn.special');
    const $modal = $('#loginModal');
    const $closeBtn = $('.close');
    const $loginForm = $('#login-form');
    const $errorMsg = $('<div class="error-message"></div>').insertBefore($loginForm.find('.form-buttons'));

    // Open the modal when the login button is clicked
    $loginBtn.on('click', function(e) {
        e.preventDefault();
        $errorMsg.text(''); // Clear any previous error messages
        $loginForm[0].reset(); // Reset form fields
        $modal.css('display', 'flex');
    });

    // Close the modal when the close button is clicked
    $closeBtn.on('click', function() {
        $modal.css('display', 'none');
        $errorMsg.text('');
    });

    // Close the modal when clicking outside the modal content
    $(window).on('click', function(event) {
        if (event.target === $modal[0]) {
            $modal.css('display', 'none');
            $errorMsg.text('');
        }
    });

    // Handle login form submission
    $loginForm.on('submit', async function(e) {
    e.preventDefault();
    $errorMsg.text(''); // Clear previous errors

    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value;

    if (!username || !password) {
        $errorMsg.text('Please enter both username and password.');
        return;
    }

    const formData = { username, password };

    try {
        const response = await fetch('login.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(formData)
        });

        const result = await response.json();

        if (result.success) {
            alert('Login successful!');
            $modal.css('display', 'none');
            window.location.href = 'admin.php';
        } else {
            // Show server-provided error message or default one
            $errorMsg.text(result.message);
        }
    } catch (error) {
        $errorMsg.text('An error occurred. Please try again.');
        console.error('Login error:', error.message);
        alert('Login error: ' + error.message);
    }
});



    // Handle register button (placeholder for future implementation)
    $('#register-btn').on('click', function() {
        alert('Registration is not implemented yet. Contact the administrator to create an account.');
    });

    // Handle forgot password link (placeholder)
    $('#forgot-password-link').on('click', function(e) {
        e.preventDefault();
        alert('Password reset is not implemented yet. Contact the administrator for assistance.');
    });
      // Function to load skills
async function loadSkills() {
    try {
        const response = await fetch('skills-crud.php');
        const skills = await response.json();
        
        const programmingSkills = document.getElementById('programming-skills');
        const designSkills = document.getElementById('design-skills');
        
        // Clear existing skills
        programmingSkills.innerHTML = '';
        designSkills.innerHTML = '';
        
        // Sort and display skills
        skills.forEach(skill => {
            const skillHtml = `
                <div class="skill">
                    <span class="skill-name">${skill.name}</span>
                    <div class="skill-bar">
                        <div class="skill-progress" style="width: ${skill.progress}%"></div>
                    </div>
                    <span class="skill-percentage">${skill.progress}%</span>
                </div>
            `;
            
            if (skill.category === 'Programming') {
                programmingSkills.insertAdjacentHTML('beforeend', skillHtml);
            } else if (skill.category === 'Design') {
                designSkills.insertAdjacentHTML('beforeend', skillHtml);
            }
        });
    } catch (error) {
        console.error('Error loading skills:', error);
    }
}

// Function to load projects
async function loadProjects() {
    try {
        const response = await fetch('projects-crud.php');
        const projects = await response.json();
        
        const projectsContainer = document.getElementById('projects-container');
        projectsContainer.innerHTML = ''; // Clear existing projects
        
        projects.forEach(project => {
            const tags = project.tags.split(',').map(tag => 
                `<span class="project-tag">${tag.trim()}</span>`
            ).join('');
            
            // Handle image path - check if it's a full path or just filename
            const imagePath = project.image.startsWith('uploads/') ? project.image : `uploads/${project.image}`;
            
            const projectHtml = `
                <div class="project-card">
                    <div class="project-image">
                        <img src="${imagePath}" alt="${project.title}" onerror="this.src='images/firstproj.png'">
                    </div>
                    <div class="project-info">
                        <h3>${project.title}</h3>
                        <p>${project.description}</p>
                        <div class="project-tags">
                            ${tags}
                        </div>
                        <div class="pixel-button">
                            <a target="_blank" href="${project.link}">VIEW PROJECT</a>
                        </div>
                    </div>
                </div>
            `;
            
            projectsContainer.insertAdjacentHTML('beforeend', projectHtml);
        });    } catch (error) {
        console.error('Error loading projects:', error);
    }
}

// Load skills and projects when the page loads
loadSkills();
loadProjects();

// Set up contact form submission
document.getElementById('contact-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch('contact-handler.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // Create a notification element
        const notification = document.createElement('div');
        notification.className = `notification ${data.success ? 'success' : 'error'}`;
        notification.textContent = data.message;
        
        // Add it to the form
        const form = document.getElementById('contact-form');
        form.insertBefore(notification, form.firstChild);
        
        // If successful, clear the form
        if (data.success) {
            form.reset();
        }
        
        // Remove notification after 5 seconds
        setTimeout(() => {
            notification.remove();
        }, 5000);
    })
    .catch(error => {
        console.error('Error:', error);
        // Show error notification
        const notification = document.createElement('div');
        notification.className = 'notification error';
        notification.textContent = 'An error occurred. Please try again later.';
        
        const form = document.getElementById('contact-form');
        form.insertBefore(notification, form.firstChild);          setTimeout(() => {
            notification.remove();
        }, 5000);
    });
}); // End of contact form submission

}); // End of document ready