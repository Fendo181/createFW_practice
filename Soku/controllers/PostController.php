<?php


class PostController extends Controller
{

    public function helloAction()
    {
        return $this->render();
    }

    public function homeAction()
    {
        return $this->render();
    }

    // 投稿先一覧を取得する
    public function postsAction()
    {
        $posts = $this->db_manager
                        ->get('Post')
                        ->fetchAllPosts();

        return $this->render(
            [
                'posts' => $posts
            ]
        );
    }
}