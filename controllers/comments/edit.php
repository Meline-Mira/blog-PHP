<?php

$comment_model = createCommentModel();
$idComment = filter_input(INPUT_GET, 'id_comment', FILTER_SANITIZE_NUMBER_INT);
$id_post_input = filter_input(INPUT_GET, 'id_post', FILTER_SANITIZE_NUMBER_INT);
$currentPage = filter_input(INPUT_GET, 'current_page', FILTER_SANITIZE_NUMBER_INT);
$comment = $comment_model->getOneComment($idComment);

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content_input = filter_input(INPUT_POST, 'content', FILTER_UNSAFE_RAW);
    $idComment = filter_input(INPUT_POST, 'id_comment', FILTER_SANITIZE_NUMBER_INT);

    if ($content_input === '' || $content_input === false) {
        $error = 'Un commentaire est demandé.';
    }

    if ($error === null) {
        $comment_model->editCommentByAdmin($content_input, $idComment);

        header("Location: /posts/read?id=" . $id_post_input . "&current_page=" . $currentPage . "#comments");
    } else {
        $_SESSION['add_comment_form_error'] = $error;

        header("Location: /posts/read?id=" . $id_post_input . "&current_page=" . $currentPage . "&id_comment=" . $idComment);
    }
}

$twig = create_twig();

echo $twig->render('/comments/edit.html.twig', [
    'page' => "Édition d'un commentaire",
    'comment' => $comment,
    'current_page' => $currentPage,
    'error' => $error
]);