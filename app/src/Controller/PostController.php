<?php
/**
 * {project-name}
 *
 * @author {author-name}
 */
declare(strict_types=1);

namespace App\Controller;

use App\Repository\PostRepository;
use Spiral\Prototype\Traits\PrototypeTrait;
use Spiral\Http\Exception\ClientException\NotFoundException;
use Spiral\Router\Annotation\Route;

class PostController
{
    use PrototypeTrait;

    private $postRepo;

    public function __construct(PostRepository $postRepository){
        $this->postRepo = $postRepository;
    }

    /**
     * @Route(route="/api/post/<id:\d+>", name="post.get", methods="GET")
     * @param string $id
     * @return array
     */
    public function get(string $id)
    {
        /** @var Post $post */
        $post = $this->postRepo->findByPK($id);
        if ($post === null) {
            throw new NotFoundException("post not found");
        }

        return [
            'post' => [
                'id'      => $post->id,
                'author'  => [
                    'id'   => $post->author->id,
                    'name' => $post->author->name
                ],
                'title'   => $post->title,
                'content' => $post->content,
            ]
        ];
    }
}
