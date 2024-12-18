const commentForm = document.getElementById("comment-form");
const commentsList = document.getElementById("comments-list");

function fetchComments() {
  fetch("fetch_comments.php")
    .then((response) => response.json())
    .then((comments) => {
      commentsList.innerHTML = "";
      comments.forEach((comment) => {
        const commentItem = document.createElement("li");
        commentItem.textContent = `${comment.name} (${comment.email}): ${
          comment.comment
        } (Posted on: ${new Date(comment.timestamp).toLocaleString()})`;
        commentsList.appendChild(commentItem);
      });
    });
}

commentForm.addEventListener("submit", function (e) {
  e.preventDefault();

  const formData = new FormData(this);

  fetch("save_comment.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.status === "success") {
        const newComment = document.createElement("li");
        newComment.textContent = `${data.name} (${data.email}): ${data.comment} (Posted just now)`;
        commentsList.prepend(newComment);
        commentForm.reset();
      } else {
        alert("Failed to submit comment");
      }
    });
});

fetchComments();
