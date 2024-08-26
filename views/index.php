<?php
session_start();
 require base_path('views/partials/head.php');
require base_path('views/partials/nav.php');
?>
<style>
    .rating {
        display: flex;
    }

    .rating svg {
        cursor: pointer;
        transition: color 0.3s;
        margin-right: 5px;
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .selected {
        background-color: yellow;
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>
<div class="d-flex flex-column gap-3">
 <?php if (isset($products)):?>
  <?php foreach ($products as $product): ?>

   <div class="border container p-3 rounded-3">

       <p><?= $product['name'] ?> (Average Rating: <?= round($averageRatings[$product['id']], 2) ?>)</p>

       <?php if (isset($success['comment'])): ?>

           <p class="text-green"><?=$success['comment']?></p>
       <?php endif;?>
    <hr>
    <div class="d-flex gap-3 w-auto">
     <div class="d-flex gap-1 align-items-center">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat" viewBox="0 0 16 16">
       <path d="M2.678 11.894a1 1 0 0 1 .287.801 11 11 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8 8 0 0 0 8 14c3.996 0 7-2.807 7-6s-3.004-6-7-6-7 2.808-7 6c0 1.468.617 2.83 1.678 3.894m-.493 3.905a22 22 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a10 10 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105"/>
      </svg>
         <?php
         // Count the comments for the current post
         $post_comments_count = 0;
         foreach ($comments as $comment) {
             if ($comment['product_id'] == $product['id']) {
                 $post_comments_count++;
             }
         }
         echo $post_comments_count;
         ?>
     </div>

    </div>


    <hr>
    <ul>
     <?php foreach ($comments as $comment):?>
      <?php if ($comment['product_id'] == $product['id']): ?>
       <li><?= htmlspecialchars($comment['body']); ?>
           <?php if ($_SESSION['user']['id'] == 6): ?>
               <a href="#" class="edit-comment">Edit</a>
               <form  method="post" action="/comment/delete">
                   <input type="hidden" value="delete" name="_method">
                    <button class="text-danger" style="all: unset;cursor: pointer;">Delete</button>
               </form>
           <?php endif; ?>
       </li>
      <?php endif; ?>
     <?php endforeach; ?>
    </ul>
       <div class="modal" id="editCommentModal" tabindex="-1" role="dialog" data-comment-id="">
           <div class="modal-dialog" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title">Edit Comment</h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                       </button>
                   </div>
                   <div class="modal-body">
                       <!-- Form for editing the comment -->
                       <form id="editCommentForm">
                           <textarea class="form-control" id="editedComment"></textarea>
                           <button type="submit" class="btn btn-primary">Save Changes</button>
                       </form>
                   </div>
               </div>
           </div>
       </div>
    <form method="post" action="/comment/store">
     <input type="hidden" name="post_id" value="<?=$product['id'] ?>">
     <input type="text" name="comment" class="form-control w-50" placeholder="comment">
     <?php if (isset($errors['comment'])): ?>
      <p class="text-danger"><?=$errors['comment']?></p>
     <?php endif;?>
        <div class="form-group">
            <label for="rating">Rating</label>
            <div class="rating">
                <svg xmlns="http://www.w3.org/2000/svg" data-rating="1" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" data-rating="2" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" data-rating="3" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" data-rating="4" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" data-rating="5" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                </svg>
            </div>
            <input type="hidden" name="rating" id="rating" value="0">
            <?php if (isset($errors['rating'])): ?>
                <p class="text-danger"><?=$errors['rating']?></p>
            <?php endif;?>
        </div>
        <button type="submit" class="btn btn-primary mt-4">Submit</button>
    </form>
       <script>
           $(document).ready(function() {
               $('.edit-comment').on('click', function(e) {
                   e.preventDefault();
                   var commentText = $(this).closest('.comment').find('p').text();
                   $('#editedComment').val(commentText);
                   $('#editCommentModal').modal('show');
               });

               $('#editCommentForm').on('submit', function(e) {
                   e.preventDefault();
                   // Perform AJAX request to update the comment
                   // Close the modal after successful update
                   $('#editCommentModal').modal('hide');
               });
           });
           $(document).ready(function() {
               $('.rating svg').on('click', function() {
                   var rating = $(this).data('rating');
                   $('#rating').val(rating);
                   $('.rating svg').removeClass('selected').css('fill', '#ddd');
                   $(this).prevAll().addBack().addClass('selected').css('fill', '#ffd700');
               });
           });
           $(document).ready(function() {
               // Click event for Edit link to open modal
               $('.edit-comment').on('click', function(e) {
                   e.preventDefault();

                   // Fetch the comment ID from the comment container
                   var commentId = $(this).closest('.comment').data('comment-id');

                   // Set the comment ID in the modal data attribute
                   $('#editCommentModal').attr('data-comment-id', commentId);

                   // Make an AJAX request to fetch the comment
                   $.ajax({
                       url: '/comment',
                       type: 'POST',
                       data: { id: commentId },
                       success: function(response) {
                           $('#editedComment').val(response);
                           $('#editCommentModal').modal('show');
                       }
                   });
               });

               // Form submission to update the comment
               $('#editCommentForm').on('submit', function(e) {
                   e.preventDefault();

                   // Extract updated comment text
                   var updatedComment = $('#editedComment').val();

                   // Extract the comment ID from the modal data attribute
                   var commentId = $('#editCommentModal').data('comment-id');

                   // Make an AJAX request to update the comment
                   $.ajax({
                       url: 'update_comment.php',
                       type: 'POST',
                       data: { id: commentId, text: updatedComment },
                       success: function(response) {
                           // Handle success response here
                           // For example, close the modal
                           $('#editCommentModal').modal('hide');
                       }
                   });
               });
           });
       </script>

   </div>
  <?php endforeach;?>
 <?php endif; ?>
</div>

