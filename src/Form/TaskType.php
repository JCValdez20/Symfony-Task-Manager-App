<?php

namespace App\Form;

use App\Entity\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use App\Enum\TaskStatus;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $task = $options['data'] ?? null;

        $builder
            ->add('title', null, [
                'label_attr' => [
                    'class' => 'block text-sm font-semibold text-gray-700 mb-1'
                ],
                'attr' => [
                    'class' => 'w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none transition-all',
                    'placeholder' => 'What needs to be done?'
                ]
            ])
            ->add('description', TextareaType::class, [
                'required' => false,
                'label_attr' => [
                    'class' => 'block text-sm font-semibold text-gray-700 mb-1 mt-4'
                ],
                'attr' => [
                    'class' => 'w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 outline-none transition-all',
                    'rows' => 5,
                    'placeholder' => 'Add some extra details here...'
                ]
            ]);

        if ($task && $task->getId() !== null) {
            $builder->add('status', EnumType::class, [
                'class' => TaskStatus::class,
                'choice_label' => fn ($choice) => ucwords(str_replace('_', ' ', $choice->value)),
                'label_attr' => [
                    'class' => 'block text-sm font-semibold text-gray-700 mb-1 mt-4'
                ],
                'expanded' => true, 
            ]);
        }

        $builder->add('save', SubmitType::class, [
            'label' => 'Create Task',
            'attr' => [
                'class' => 'bg-gray-900 hover:bg-gray-800 text-white font-semibold py-2.5 px-7 rounded-lg transition-colors duration-200 '
            ]
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
