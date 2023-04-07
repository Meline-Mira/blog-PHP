<?php

$comment_model = createCommentModel();

$errors = [];
$id_user = 1; // TODO : $user_id = $_SESSION...
$updated_at = date("Y-m-d");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content_input = filter_input(INPUT_POST, 'content', FILTER_UNSAFE_RAW);
    $id_post_input = filter_input(INPUT_POST, 'id_post', FILTER_SANITIZE_NUMBER_INT);
    $current_page_input = filter_input(INPUT_POST, 'current_page', FILTER_SANITIZE_NUMBER_INT);

    if ($content_input === '' || $content_input === false) {
        $errors[] = 'Un commentaire est demandé.';
    }

    if (empty($errors)) {
        $comment_model->addComment($content_input, $id_user, $updated_at, $id_post_input);

        header("Location: /posts/read?id=" . $id_post_input . "&current_page=" . $current_page_input . "#comments");
        die;
    }
}