document.addEventListener('DOMContentLoaded', function() {
    // Toggle comments section
    const commentButtons = document.querySelectorAll('.toggle-comments');

    commentButtons.forEach(button => {
        button.addEventListener('click', function() {
            const commentsSection = this.closest('.osahan-post').querySelector('.comments-section');
            commentsSection.style.display = commentsSection.style.display === 'none' || commentsSection.style.display === '' ? 'block' : 'none';
        });
    });

    // AJAX to handle comment form submission
    $('form[id^="commentForm-"]').on('submit', function(event) {
        event.preventDefault(); // Prevent form from refreshing the page
        const form = $(this);
        const postId = form.attr('id').split('-')[1]; // Extract post ID from form ID
        const formData = form.serialize(); // Serialize the form data for submission
    
        $.ajax({
            url: form.attr('action'), // The form action URL
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    const newComment = `
                        <div class="comments p-3 border rounded mb-2 shadow-sm">
                            <div class="d-flex align-items-center mb-2">
                                <div class="comment-author mr-2 font-weight-bold text-primary">
                                    ${response.user}
                                </div>
                                <small class="text-muted">${response.comment.created_at}</small>
                            </div>
                            <p class="comment-content text-secondary mb-0">
                                ${response.comment.content}
                            </p>
                        </div>
                    `;
                    // Insert the new comment before the form
                    $(`#commentForm-${postId}`).before(newComment);
                    
                    // Clear the textarea
                    form.find('textarea').val('');
                }
            },
            error: function(xhr) {
                console.log('Error:', xhr.responseText); // Log errors for debugging
            }
        });
        
    });
    
    
});
