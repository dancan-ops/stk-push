// Step 1: Get the username from the hidden input
const username = document.getElementById("username").value || "Guest";

// Step 2: Set the iframe to load user.php with the username on page load
document.getElementById("content-frame").src = "user.php?user=" + encodeURIComponent(username);

// Step 3: Make sure clicking "Users" also adds the username to the iframe link
document.getElementById("usersLink").addEventListener("click", function(event) {
    event.preventDefault();
    document.getElementById("content-frame").src = "user.php?user=" + encodeURIComponent(username);
});

// Sidebar toggle
const menuBtn = document.getElementById('menu-btn');
const sidebar = document.getElementById('sidebar');
const page = document.getElementById('page');

menuBtn.addEventListener('click', () => {
    sidebar.classList.toggle('open');
    page.classList.toggle('menu-open');
});

// Sidebar link active class logic
const links = document.querySelectorAll('.sidebar-link');

links.forEach(link => {
    link.addEventListener('click', function(event) {
        event.preventDefault();

        // Remove active from all
        links.forEach(l => l.classList.remove('active'));

        // Add to current
        this.classList.add('active');

        const href = this.getAttribute('href');
        const contentFrame = document.getElementById('content-frame');

        if (this.id === "usersLink") {
            contentFrame.src = "user.php?user=" + encodeURIComponent(username);
        } else {
            contentFrame.src = href;
        }
    });
});
