<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Pixel Portfolio</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="admin-container">
        <header class="admin-header">
            <div class="pixel-logo">ADMIN DASHBOARD</div>            <nav class="admin-nav">
                <ul>
                    <li><a href="#skills-management" class="nav-btn">SKILLS</a></li>
                    <li><a href="#projects-management" class="nav-btn">PROJECTS</a></li>
                    <li><a href="#messages-management" class="nav-btn">MESSAGES</a></li>
                    <li><a href="index.php" class="nav-btn special">BACK TO PORTFOLIO</a></li>
                </ul>
            </nav>
        </header>

        <main class="admin-content">
            <!-- Skills Management -->
            <section id="skills-management" class="admin-section">
                <div class="section-header">
                    <h2 class="pixel-font">SKILLS MANAGEMENT</h2>
                    <div class="pixel-divider"></div>
                </div>
                <div class="management-controls">
                    <button class="pixel-button" id="add-skill-btn">ADD NEW SKILL</button>
                </div>
                <div class="skills-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Progress</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="skills-list"></tbody>
                    </table>
                </div>
            </section>

            <!-- Projects Management -->
            <section id="projects-management" class="admin-section">
                <div class="section-header">
                    <h2 class="pixel-font">PROJECTS MANAGEMENT</h2>
                    <div class="pixel-divider"></div>
                </div>
                <div class="management-controls">
                    <button class="pixel-button" id="add-project-btn">ADD NEW PROJECT</button>
                </div>
                <div class="projects-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Tags</th>
                                <th>Link</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="projects-list"></tbody>
                    </table>
                </div>
            </section>

            <!-- Messages Management -->
            <section id="messages-management" class="admin-section">
                <div class="section-header">
                    <h2 class="pixel-font">MESSAGES MANAGEMENT</h2>
                    <div class="pixel-divider"></div>
                </div>
                <div class="messages-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="messages-list"></tbody>
                    </table>
                </div>
            </section>
        </main>

        <!-- Skill Modal -->
        <div id="skillModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="skill-modal-title">Add Skill</h2>
                    <span class="close">×</span>
                </div>
                <form class="modal-form" id="skill-form">
                    <input type="hidden" id="skill-id" name="skill-id">
                    <div class="form-group">
                        <label for="skill-name">Skill Name</label>
                        <input type="text" id="skill-name" name="skill-name" required>
                    </div>
                    <div class="form-group">
                        <label for="skill-category">Category</label>
                        <select id="skill-category" name="skill-category" required>
                            <option value="Programming">Programming</option>
                            <option value="Design">Design</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="skill-progress">Progress (%)</label>
                        <input type="number" id="skill-progress" name="skill-progress" min="0" max="100" required>
                    </div>
                    <div class="form-buttons">
                        <button type="submit" class="pixel-button">SAVE</button>
                        <button type="button" class="pixel-button cancel-btn">CANCEL</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Project Modal -->
        <div id="projectModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="project-modal-title">Add Project</h2>
                    <span class="close">×</span>
                </div>
                <form class="modal-form" id="project-form" enctype="multipart/form-data">
                    <input type="hidden" id="project-id" name="project-id">
                    <div class="form-group">
                        <label for="project-title">Project Title</label>
                        <input type="text" id="project-title" name="project-title" required>
                    </div>
                    <div class="form-group">
                        <label for="project-description">Description</label>
                        <textarea id="project-description" name="project-description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="project-image">Image</label>
                        <input type="file" id="project-image" name="project-image" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="project-tags">Tags (comma-separated)</label>
                        <input type="text" id="project-tags" name="project-tags">
                    </div>
                    <div class="form-group">
                        <label for="project-link">Project Link</label>
                        <input type="url" id="project-link" name="project-link">
                    </div>
                    <div class="form-buttons">
                        <button type="submit" class="pixel-button">SAVE</button>
                        <button type="button" class="pixel-button cancel-btn">CANCEL</button>
                    </div>
                </form>
            </div>
        </div>
    </div>    
    <script src="admin.js"></script>
</body>
</html>

