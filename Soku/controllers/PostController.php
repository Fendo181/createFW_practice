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


    // DBへ投稿する
    public function postAction()
    {
        // POSTでのアクションでなければ404を返す
        if(!$this->request->isPost())
        {
            $this->forward404();
        }

        // バリデーション処理
        $errors = [];


        $comment = $this->request->getPost('comment');
        $name = $this->request->getPost('name');

        if (!strlen($comment)) {
            $errors[] = 'ひとことを入力してください';
        } else if (mb_strlen($comment) > 200) {
            $errors[] = 'ひとことは200 文字以内で入力してください';
        }

        if (!strlen($name)) {
            $errors[] = '名前を入力して下さい';
        }

        // エラーがなかったら
        if (count($errors) === 0) {
            $this->db_manager->get('Post')->insert($name, $comment);

            return $this->redirect('/posts');
        }

        return $this->render([
            'errors'   => $errors,
            'commnet'  => $comment,
            'commnet'  => $name,
            ]);

    }
}