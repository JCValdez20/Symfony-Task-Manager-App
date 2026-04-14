<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Task;
use App\Enum\TaskStatus;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $task = new Task;
        $task->setTitle('Learn Symfony');
        $task->setDescription('Learn Symfony to build amazing web applications');
        $task->setStatus(TaskStatus::PENDING);
        $task->setCreatedAt(new \DateTimeImmutable());

        $manager->persist($task);

        $task = new Task;
        $task->setTitle('Play League of Legends');
        $task->setDescription('Play League of Legends with friends');
        $task->setStatus(TaskStatus::IN_PROGRESS);
        $task->setCreatedAt(new \DateTimeImmutable());

        $manager->persist($task);

        $manager->flush();
    }
}
