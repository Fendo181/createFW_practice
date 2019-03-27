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

    public function postsAction()
    {
        //DBから投稿先一覧を取得する
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