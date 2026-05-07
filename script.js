function confirmDelete(postId) {
    const result = confirm("Are you sure you want to delete this post?");

    if (result) {
        location.href = "delete_process.php?post_id=" + postId;
    }
}

function checkSignupForm() {
    const userId = document.getElementById("user_id").value;
    const password = document.getElementById("password").value;
    const passwordConfirm = document.getElementById("password_confirm").value;
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;

    if (
        userId.trim() === "" ||
        password.trim() === "" ||
        passwordConfirm.trim() === "" ||
        name.trim() === "" ||
        email.trim() === ""
    ) {
        alert("Please fill in all fields.");
        return false;
    }

    if (password !== passwordConfirm) {
        alert("Passwords do not match.");
        return false;
    }

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailPattern.test(email)) {
        alert("Please enter a valid email address.");
        return false;
    }

    return true;
}

function checkPostForm() {
    const title = document.getElementById("title").value;
    const content = document.getElementById("content").value;

    if (title.trim() === "") {
        alert("Please enter a title.");
        return false;
    }

    if (content.trim() === "") {
        alert("Please enter content.");
        return false;
    }

    return true;
}

function checkDuplicate() {
    const userId = document.getElementById("user_id").value;

    if (userId.trim() === "") {
        alert("Please enter a User ID.");
        return;
    }

    location.href = "duplicate_check.php?user_id=" + encodeURIComponent(userId);
}
