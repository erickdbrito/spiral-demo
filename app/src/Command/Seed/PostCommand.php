<?php
/**
 * {project-name}
 *
 * @author {author-name}
 */
declare(strict_types=1);

namespace App\Command\Seed;

use App\Database\Post;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Cycle\ORM\TransactionInterface;
use Faker\Generator;
use Spiral\Console\Command;

class PostCommand extends Command
{
    protected const NAME = 'seed:post';

    public function __construct(UserRepository $usersRepository, PostRepository $postRepository, ?string $name = null)
    {
        parent::__construct($name);
        $this->postRepo = $postRepository;
        $this->usersRepo = $usersRepository;
    }

    protected function perform(TransactionInterface $tr, Generator $faker): void
    {
        $users = $this->usersRepo->findAll();

        for ($i = 0; $i < 1000; $i++) {
            $user = $users[array_rand($users)];

            $post = new Post();
            $post->author = $user;
            $post->title = $faker->sentence(12);
            $post->content = $faker->text(900);
            $tr->persist($post);

            $this->sprintf("New post: <info>%s</info>\n", $post->title);
        }
        $tr->run();

    }
}
